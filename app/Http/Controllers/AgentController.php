<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\agent;
use App\Models\nominee;
use App\Models\application;
use App\Models\contact;
use App\Models\gym;

class AgentController extends Controller
{

    public function agents()
    {

       $agents=agent::latest()->get();
          $header="Agents";
        return view('agents.Agents',['agents'=>$agents,'header'=>$header]);
    }

    public function add_agent()
    {

          $header="Agents";
        return view('agents.AddAgent',['header'=>$header]);
    }

    public function agent_add(Request $req)
    {
        if(agent::where('mobile',$req->mobile)->exists())
        {
           $data['err']="error";
        }
        else
        {
        agent::create([

            'name'=>$req->name,
            'mobile'=>$req->mobile,
            'mail_id'=>$req->mail,
            'address'=>$req->address,
            'password'=>bcrypt($req->pass),
            'status'=>'Active',

            ]);

            $data['success']="success";
          }
            echo json_encode($data);

      }

      public function edit_agent($aid)
    {
        $agentid=decrypt($aid);
        $agent=agent::where('id',$agentid)->first();

          $header="Agents";
        return view('agents.EditAgent',['header'=>$header,'agent'=>$agent]);
    }

    public function agent_edit(Request $req)
    {
        if(agent::where('mobile',$req->mobile)->where('id','!=',$req->aid)->exists())
        {
           $data['err']="error";
        }
        else
        {
        agent::where('id',$req->aid)->update([

            'name'=>$req->name,
            'mobile'=>$req->mobile,
            'mail_id'=>$req->mail,
            'address'=>$req->address,
            'password'=>bcrypt($req->pass),
            'status'=>'Active',

            ]);

            $data['success']="success";
         }
            echo json_encode($data);

      }



     public function activate_agent(Request $req)
    {

        $uid=$req->body;

        agent::where('id',$uid)->update([

            'status'=>'Active'

            ]);

            $data['success']="success";
            echo json_encode($data);

      }

       public function block_agent(Request $req)
    {


        agent::where('id',$req->body)->update([

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
          $header="agent-gyms";
        return view('users.nominees',['nominees'=>$nominees,'usr'=>$usr,'header'=>$header]);

    }


    public function agentGyms($id)
    {
        $header="agents";
        $agentgyms=gym::where('agent_id',$id)->get();
        return view('agents.agent_gyms',compact('header','agentgyms'));
    }




}
