<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\gym;
use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\plan;
use Redirect;

class PlanController extends Controller
{
        public function plans()
    {

       $plans=plan::latest()->get();
          $header="Plans";
        return view('plans.Plans',['plans'=>$plans,'header'=>$header]);
    }

    public function add_plan()
    {

          $header="Plans";
        return view('plans.AddPlans',['header'=>$header]);
    }

    public function plan_add(Request $req)
    {
        if(plan::where('name',$req->name)->exists())
        {
           $data['err']="error";
        }
        else
        {
        plan::create([

            'name'=>$req->name,
            'month'=>$req->month,
            'actual_fee'=>$req->afee,
            'minimum_fee'=>$req->mfee,
            'status'=>'Active',

            ]);

            $data['success']="success";
          }
            echo json_encode($data);

      }

      public function edit_plan($pid)
    {
        $planid=decrypt($pid);
        $plan=plan::where('id',$planid)->first();

          $header="Plans";
        return view('plans.EditPlan',['header'=>$header,'plan'=>$plan]);
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



     public function activate_plan(Request $req)
    {

        $uid=$req->body;

        plan::where('id',$uid)->update([

            'status'=>'Active'

            ]);

            $data['success']="success";
            echo json_encode($data);

      }

       public function block_plan(Request $req)
    {


        plan::where('id',$req->body)->update([

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


    public function planGyms($id)
    {
        $header="plans-gyms";
        $plangyms=gym::where('plan',$id)->get();
        return view('plans.plan_gyms',compact('header','plangyms'));
    }




}
