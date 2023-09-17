<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\admin_detail;
use App\Models\application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\Hash;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\gym;

class AdminController extends Controller
{
    public function home()
    {


        return view('admin.LoginPage');

       // print_r(bcrypt("admin"));
    }

    public function forgot_password()
    {
        return view('admin.forgot_password.ForgotPassword');
       // print_r(bcrypt("admin"));
    }

     public function admin_mail_chk(Request $req)
    {

        $email=$req->email;

      $cnt=admin_detail::where('mail_id',$email)->count();
      if($cnt==0)
      {
        $data['err']='Invalid Mail Id';
      }
       else
      {
        $token=Str::random(64);

        $pswcnt=DB::table('password_resets')->where('email',$email)->count();
        if($pswcnt==0)
        {

             DB::table('password_resets')->insert([

            'email'=>$email,
            'token'=>$token,
            'created_at'=>date('Y-m-d H:i:s'),

            ]);
        }
        else
        {
            DB::table('password_resets')->where('email',$email)->update([

            'token'=>$token,
            'created_at'=>date('Y-m-d H:i:s'),

            ]);
        }

        $details=[
            'email'=>$email,
            'token'=>$token
        ];

        Mail::to($email)->send(new ForgotPasswordMail($details));
        $data['success']='We have sent a password reset link to your email.';

      }


        echo json_encode($data);
    }


    public function admin_password_reset($tok,$em)
    {
        $cnt=DB::table('password_resets')->where('email',$em)->where('token',$tok)->count();
        if($cnt==0)
        {
            return view('admin.forgot_password.AdminResetPasswordExpired');
        }
        else
        {
             $psw=DB::table('password_resets')->where('email',$em)->where('token',$tok)->first();

            $dt = date('Y-m-d H:i:s');
            $date = $psw->created_at;
            $currentDate = strtotime($date);
            $futureDate = $currentDate+(60*5);
            $formatDate = date("Y-m-d H:i:s", $futureDate);
            if($dt<=$formatDate)
            {
            return view('admin.forgot_password.AdminResetPassword',['token'=>$tok,'email'=>$em]);
            }
            else
            {
               return view('admin.forgot_password.AdminResetPasswordExpired');
            }
         }
       // print_r(bcrypt("admin"));
    }

    public function adminpsw_reset(Request $req)
    {
//$currentpass=auth()->guard('admin')->user()->password;
       // $oldpass=$req->oldpass;
        $newpass=$req->newpass;

        // if(Hash::check($oldpass, $currentpass))
        // {
            admin_detail::where('id',1)->update([
                'password'=>bcrypt($newpass)
            ]) ;
            $data['success']="success";
        // }
        // else{
        //     $data['err']="err";
        // }
        echo json_encode($data);

    }

    public function login(Request $req)
    {
        $rememberStatus=$req->rememberStatus;
        $uname=$req->username;
        $psw=$req->password;
        if($rememberStatus==0)
        {
            if(Auth::guard('admin')->attempt(['username' => $uname, 'password' => $psw]))
                {
                    $data['success']='Login success.Please wait...';
                }
            else
                {
                    $data['err']='Invalid user !';
                }
        }
        else if($rememberStatus==1)
        {

            if(Auth::guard('admin')->attempt(['username' => $req->username, 'password' => $req->password],true))
                {
                    $data['success']='Login success.Please wait...';
                }
            else
                {
                    $data['err']='Invalid user !';
                }

        }

        echo json_encode($data);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.home');
    }

    public function dashboard()
    {

       $header="Dashboard";
       $currentdate = date('d-m-y');
       
       $expiredcustomers = gym::where('validto','<=',$currentdate)->count();

        return view('admin.Dashboard',['header'=>$header,'expiredcustomers'=>$expiredcustomers]);
    }

    public function admin_profile()
    {
        $adid=Auth::guard('admin')->user()->id;
        $adm=admin_detail::where('id',$adid)->first();
           $header="Dashboard";
        return view('admin.AdminProfile',['adm'=>$adm,'header'=>$header]);
    }
    public function edit_admin_profile()
    {
        $adid=Auth::guard('admin')->user()->id;
        $adm=admin_detail::where('id',$adid)->first();
        $header="Dashboard";
        return view('admin.AdminProfileEdit',['adm'=>$adm,'header'=>$header]);
    }

     public function admin_profile_update(Request $req)
    {
       $adid=Auth::guard('admin')->user()->id;
           $adm=admin_detail::where('id',$adid)->first();
         $img = $req->file('img');
        if($img=='')
        {
            $new_name=$adm->profile_image;
        }
        else{
             $imgWillDelete = public_path() . '/admin/img/' . $adm->profile_image;
            File::delete($imgWillDelete);
          $image = $req->file('img');
             $new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/img'), $new_name);
            //$ins['Photo']=$new_name;
        }

            admin_detail::where('id',$adid)->update([
                'name'=>$req->cname,
                'mobile'=>$req->cmobile,
                'mail_id'=>$req->cmail,
                'profile_image'=>$new_name,
                'facebook'=>$req->cfb,
                'instagram'=>$req->cins,
                'twitter'=>$req->ctwitter,
            ]) ;
            $data['success']="success";

        echo json_encode($data);

    }

    public function change_password()
    {
        $header="Settings";
        return view('admin.ChangePassword',['header'=>$header]);

    }
    public function password_update(Request $req)
    {
        $adid=Auth::guard('admin')->user()->id;
        $currentpass=auth()->guard('admin')->user()->password;
        $oldpass=$req->oldpass;
        $newpass=$req->newpass;

        if(Hash::check($oldpass, $currentpass))
        {
            admin_detail::where('id',$adid)->update([
                'password'=>bcrypt($newpass)
            ]) ;
            $data['success']="success";
        }
        else{
            $data['err']="err";
        }
        echo json_encode($data);

    }





}
