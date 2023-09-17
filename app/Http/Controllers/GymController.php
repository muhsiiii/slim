<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\gym;
use App\Models\plan;
use App\Models\agent;

class GymController extends Controller
{
      public function plans()
    {
    
       $plans=plan::latest()->get();
          $header="Gym";
        return view('gym.Gym',['plans'=>$plans,'header'=>$header]);      
    }

    public function add_gym()
    {
        $plans=plan::where('status','Active')->get();
        $agents=agent::where('status','Active')->get();
          $header="Gym";
        return view('gym.AddGym',['header'=>$header,'agents'=>$agents,'plans'=>$plans]);      
    }

    public function gym_add(Request $req)
    {
        if(gym::where('mobile',$req->mobile)->exists())
        {
           $data['err']="error"; 
        }
        else
        {
        gym::create([

            'agent_id'=>$req->agent,
            'name'=>$req->name,
            'propriter'=>$req->pname,
            'mobile'=>$req->mobile,
            'mail_id'=>$req->mail,
            'pincode'=>$req->pincode,
            'state'=>$req->state,
            'district'=>$req->district,
            'area'=>$req->area,
            'address'=>$req->address,
            'password'=>bcrypt($req->pass),
            'plan'=>$req->plan,
            'fee'=>$req->fee,
            'validfrom'=>$req->validfrom,
            'validto'=>$req->validto,
            'status'=>'Active',

            ]);

            $data['success']="success";
          }  
            echo json_encode($data);

      } 


      public function active_gym()
    {
        $gym=gym::latest()->get();
          $header="Gym";
        return view('gym.ActiveGym',['header'=>$header,'gym'=>$gym]);      
    }
   

      public function edit_gym($gid)
    {
        $gymid=decrypt($gid);
        $gym=gym::where('id',$gymid)->first();
       $agents=agent::where('status','Active')->get();
          $header="Gym";
        return view('gym.EditGym',['header'=>$header,'agents'=>$agents,'gym'=>$gym]);      
    }

    public function plan_edit(Request $req)
    {
        if(plan::where('name',$req->name)->where('id','!=',$req->pid)->exists())
        {
           $data['err']="error"; 
        }
        else
        {
        plan::where('id',$req->pid)->update([

            'name'=>$req->name,
            'month'=>$req->month,
            'actual_fee'=>$req->afee,
            'minimum_fee'=>$req->mfee,

            ]);

            $data['success']="success";
         }   
            echo json_encode($data);

      }

    

     public function activate_gym(Request $req)
    {

        $uid=$req->body;

        gym::where('id',$uid)->update([

            'status'=>'Active'

            ]);

            $data['success']="success";
            echo json_encode($data);

      } 

       public function block_gym(Request $req)
    {
        

        gym::where('id',$req->body)->update([

            'status'=>'Blocked',

            ]);

            $data['success']="success";
            echo json_encode($data);

      }


      public function nominees($userid)
    {

        $uid=decrypt($userid);
    
       $nominees=nominee::where('user_id',$uid)->where('status','!=','Deleted')->oldest()->get();
       $usr=User::select('full_name','phone_number')->where('id',$uid)->first();
          $header="Users";
        return view('users.nominees',['nominees'=>$nominees,'usr'=>$usr,'header'=>$header]);   
       
    } 

 

}
