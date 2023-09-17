<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
 use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\nominee;
use App\Models\state;
use App\Models\country;
use Mail;
 use App\Mail\OtpMail;
 use AfricasTalking\SDK\AfricasTalking;

class UserApiController extends Controller
{


    public function register(Request $req)
        
    {
           
           $rules = [
                    'full_name' => 'required',
                    'phone_number' => 'required',
                    'email_id' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'password'=>'required|min:6',
                    'device_type'=>'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                   
                    $ca=time();
                    if (User::where('phone_number', $req->phone_number)->exists()) 
                    {
                        return response()->json(['message'=>"Phone number already exists",'status_code'=>'00'],400);
                    }
                    else if (User::where('email_id', $req->email_id)->exists()) 
                    {
                        return response()->json(['message'=>"Email id already exists",'status_code'=>'00'],400);
                    }
                    else if (User::where('ca_id', $ca)->exists()) 
                    {
                        
                        $ca=time();
                    }
                    else
                    {
                         $cn=country::where('id',$req->country)->first();
                         //$otp=rand(100001,999999);

                        User::create([
                        'ca_id'=>$ca,
                        'code'=>$cn->code,
                        'full_name'=>$req->full_name,    
                        'phone_number'=>$req->phone_number,
                        'email_id'=>$req->email_id,
                        'country_id'=>$req->country,
                        'state_id'=>$req->state,
                        'password'=>bcrypt($req->password),
                        'device_type'=>$req->device_type,
                        'status'=>'Active',
                        //'otp'=>$otp                        

                        ]);

                        return response()->json([

                            'message'=>'Registration completed successfully.',
                            'full_name'=>$req->full_name,
                            'phone_number'=>$req->phone_number,
                            'email_id'=>$req->email_id,
                            //'otp'=>$otp, 
                            'status_code'=>'01'
                            ],200);
                            }
                          
                    }
    }



    public function check(Request $req)
        
    {
           
           $rules = [                    
                    'phone_number' => 'required',
                    'email_id' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $user=User::where('phone_number', $req->phone_number)->first(); 
                    
                       if($user)
                            {
                            
                                return response()->json([
  
                                'message'=>'Phone number exists',
                                'status_code'=>'00'
                                ],400);
                            }
                            else
                            {
                                $usermail=User::where('email_id', $req->email_id)->first();
                                if($usermail)
                                {
                                     return response()->json([
                                    'message'=>'Mail id exists',
                                    'status_code'=>'00'
                                    ],400); 
                                }
                                else
                                {
                                    $otp=rand(100001,999999);
                                    $username = 'austinCANigeria';
                                    $apiKey = 'af8ad6b0147e2777eca042640a9807f3209c9975df4577e3aace6ce07cb87956';
                                    $mob='+'.$req->phone_number;
                                    $AT = new AfricasTalking($username, $apiKey);

                                    $sms = $AT->sms();

                                    // Send an SMS
                                    $result = $sms->send([
                                        'to'      => $mob, // Recipient's phone number
                                        'message' => 'Hello! Your CrowdAfrik OTP is: '.$otp.' Please enter this code within the app to complete your verification process. Keep your account secure and do not share this code with anyone. Thank you!',
                                    ]);

                                    //return $result;

                                    return response()->json([
                                    'message'=>'Phone number and Email id  verified successfully',
                                    'otp'=>$otp, 
                                    'status_code'=>'01',
                                    'result'=>$result
                                    ],200);
                                }

                            }
                          
                        }
                        
                }




    public function login(Request $req)
        
    {
           
           $rules = [                    
                    'phone_number' => 'required',
                    'password'=>'required|min:6',
                    'device_type'=>'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $user=User::where('phone_number', $req->phone_number)->where('device_type', $req->device_type)->first(); 
                    
                       if($user)
                        {
                            if(Hash::check($req->password,$user->password))
                            {
                                $token=$user->createToken('user-app')->plainTextToken;

                                return response()->json([

                                'user_id'=>$user->id,    
                                'token'=>$token,    
                                'full_name'=>$user->full_name,
                                'email_id'=>$user->email_id,    
                                'message'=>'Login Success',
                                'status_code'=>'01'
                                ],200);
                            }
                            else
                            {
                                return response()->json([

                                'message'=>'Incorrect password ',
                                'status_code'=>'00'
                                ],400);
                            }
                          
                        }
                        else
                            {
                                return response()->json([

                                'message'=>'Invalid user ',
                                'status_code'=>'00'
                                ],400);
                            }
                }

        }



        public function get_otp(Request $req)
        
    {
           
           $rules = [                    
                    'phone_number' => 'required',
                    //'email_id' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    //$user=User::where('phone_number', $req->phone_number)->where('email_id', $req->email_id)->first(); 
                    $user=User::where('phone_number', $req->phone_number)->first();
                       if($user)
                            {
                                $otp=rand(100001,999999);

                                $username = 'austinCANigeria';
                                    $apiKey = 'af8ad6b0147e2777eca042640a9807f3209c9975df4577e3aace6ce07cb87956';

                                    $AT = new AfricasTalking($username, $apiKey);

                                    $sms = $AT->sms();

                                    // Send an SMS
                                    $result = $sms->send([
                                        'to'      => $req->phone_number, // Recipient's phone number
                                        'message' => 'Hello! Your CrowdAfrik OTP is: '.$otp.' Please enter this code within the app to complete your verification process. Keep your account secure and do not share this code with anyone. Thank you!',
                                    ]);
                            
                                return response()->json([
  
                                'message'=>'Otp generated successfully',
                                'otp'=>$otp,
                                'status_code'=>'01'
                                ],200);
                            }
                            else
                            {
                                return response()->json([

                                'message'=>'Invalid phone number',
                                'status_code'=>'00'
                                ],400);
                            }
                          
                        }
                        
                }


     public function get_mailotp(Request $req)
        
    {
           
           $rules = [                    
                    'email_id' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $user=User::where('email_id', $req->email_id)->first(); 
                    
                       if($user)
                            {
                                $otp=rand(100001,999999);

                                User::where('id',$user->id)->update([

                                    'otp'=>$otp

                                ]);
                            
                                return response()->json([
  
                                'message'=>'Otp generated successfully',
                                'otp'=>$otp,
                                'status_code'=>'01'
                                ],200);
                            }
                            else
                            {
                                return response()->json([

                                'message'=>'Invalid email idr',
                                'status_code'=>'00'
                                ],400);
                            }
                          
                        }
                        
                }               



        public function check_otp(Request $req)
        
    {
           
           $rules = [                    
                    'phone_number' => 'required',
                    'otp' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $user=User::where('phone_number', $req->phone_number)->where('otp', $req->otp)->first(); 
                    
                       if($user)
                            {
                                

                                User::where('id',$user->id)->update([

                                    'otp'=>''

                                ]);
                            
                                return response()->json([
  
                                'message'=>'Otp validated successfully.',
                                'status_code'=>'01'
                                ],200);
                            }
                            else
                            {
                                return response()->json([

                                'message'=>'Invalid otp',
                                'status_code'=>'00'
                                ],400);
                            }
                          
                        }
                        
                }


    public function reset_password(Request $req)
        
    {
           
           $rules = [                    
                    'phone_number' => 'required',
                    'password' => 'required|min:6',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $user=User::where('phone_number', $req->phone_number)->first(); 
                    
                       if($user)
                            {
                                

                                User::where('id',$user->id)->update([

                                    'password'=>bcrypt($req->password)

                                ]);
                            
                                return response()->json([
  
                                'message'=>'Password changed successfully.',
                                'status_code'=>'01'
                                ],200);
                            }
                            else
                            {
                                return response()->json([

                                'message'=>'Invalid phone number',
                                'status_code'=>'00'
                                ],400);
                            }
                          
                        }
                        
                }


    //              public function reset_password(Request $req)
        
    // {
           
    //        $rules = [                    
    //                 'email_id' => 'required',
    //                 'password' => 'required|min:6',
    //                 ];
                
    //         $validator = Validator::make($req->all(), $rules);  

    //          if ($validator->fails()) 
    //             {
    //                return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
    //             } 
    //         else 
    //             {
    //                 $user=User::where('email_id', $req->email_id)->first(); 
                    
    //                    if($user)
    //                         {
                                

    //                             User::where('id',$user->id)->update([

    //                                 'password'=>bcrypt($req->password)

    //                             ]);
                            
    //                             return response()->json([
  
    //                             'message'=>'Password changed successfully.',
    //                             'status_code'=>'01'
    //                             ],200);
    //                         }
    //                         else
    //                         {
    //                             return response()->json([

    //                             'message'=>'Invalid email id',
    //                             'status_code'=>'00'
    //                             ],400);
    //                         }
                          
    //                     }
                        
    //             }








        public function user_details()
        
    {
        $user=auth()->user()->id;
        $det=User::where('id',$user)->first();
        if($det->country_id=='')
        {
            $con='';
        }
        else
        {
            $con=$det->GetCon->name;
        }
        if($det->state_id=='')
        {
            $st='';
        }
        else
        {
           $st=$det->GetSt->name;
        }
        if($det)
        {
        return response()->json([

                'full_name'=>$det->full_name,
                'phone_number'=>$det->phone_number,
                'email_id'=>$det->email_id,
                'device_type'=>$det->device_type,
                'status'=>$det->status,
                'age'=>$det->age,
                'address'=>$det->address,
                'country'=>$con,
                'state'=>$st,
                'town'=>$det->town,
                'post_code'=>$det->post_code,

                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);
        }
        else
        {
            return response()->json([

                'message'=>'Invalid user',
                'status_code'=>'00',
                

                ],400);
        }
    } 


     public function get_countries()
        
    {
        //$user=auth()->user()->id;
        $con=country::where('status','Active')->orderBy('name','ASC')->get();

        return response()->json([

                'countries'=>$con,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    }

     public function get_states($conid)
        
    {
        //$user=auth()->user()->id;
        $st=state::where('country_id',$conid)->where('status','Active')->orderBy('name','ASC')->get();

        return response()->json([

                'states'=>$st,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    }  


     public function edit_profile(Request $req)
        
    {
           
           $rules = [
                    'age' => 'required',
                    'address' => 'required',
                    'country_id' => 'required',
                    'state_id'=>'required',
                    'town'=>'required',
                    'post_code'=>'required',
                    'community'=>'required',

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                   
                        $user=auth()->user()->id;

                        User::where('id',$user)->update([
                        'age'=>$req->age,    
                        'address'=>$req->address,
                        'country_id'=>$req->country_id,
                        'state_id'=>$req->state_id,
                        'town'=>$req->town,
                        'post_code'=>$req->post_code,
                        'community'=>$req->community,                        

                        ]);

                        return response()->json([

                            'message'=>'Profile updated successfully.',
                            'status_code'=>'01'
                            ],200);
                            
                          
                    }
    }   




        public function add_nominee(Request $req)
        
    {
           
           $rules = [
                    'nominee_name' => 'required',
                    'nominee_mobile' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    // if (User::where('phone_number', $req->phone_number)->exists()) 
                    // {
                    //     return response()->json(['message'=>"Phone number already exists",'status_code'=>'00'],400);
                    // }
                    
                    // else
                    // {
                        
                        nominee::create([
                        'name'=>$req->nominee_name,    
                        'mobile'=>$req->nominee_mobile,
                        'user_id'=>auth()->user()->id,
                        'status'=>'Active',                        

                        ]);

                        return response()->json([

                            'message'=>'Nominee added successfully.',
                            'status_code'=>'01'
                            ],200);
                    }
                          
                    // }
    }


 public function nominees()
        
    {
        $user=auth()->user()->id;
        $nominees=nominee::where('user_id',$user)->get();

        return response()->json([

                'nominees'=>$nominees,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    } 

            public function edit_nominee(Request $req)
        
    {
        $user=auth()->user()->id;
           
           $rules = [
                    'id' => 'required',
                    'nominee_name' => 'required',
                    'nominee_mobile' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    if (nominee::where('id', $req->id)->where('user_id', $user)->doesntExist()) 
                    {
                        return response()->json(['message'=>"Invalid nominee",'status_code'=>'00'],400);
                    }
                    
                    else
                    {
                        
                        nominee::where('id',$req->id)->update([
                        'name'=>$req->nominee_name,    
                        'mobile'=>$req->nominee_mobile,                       
                        ]);

                        return response()->json([

                            'message'=>'Nominee updated successfully.',
                            'status_code'=>'01'
                            ],200);
                    }
                          
                 }
    }  

     public function delete_nominee(Request $req)
        
    {
         $user=auth()->user()->id;  
           $rules = [
                    'id' => 'required',

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    if (nominee::where('id', $req->id)->where('user_id', $user)->doesntExist()) 
                    {
                        return response()->json(['message'=>"Invalid nominee",'status_code'=>'00'],400);
                    }
                    
                    else
                    {
                        
                        nominee::where('id',$req->id)->update([
                        'status'=>'Deleted',                           
                        ]);

                        return response()->json([

                            'message'=>'Nominee deleted successfully.',
                            'status_code'=>'01'
                            ],200);
                    }
                          
                 }
    }



     public function get_country()
        
    {

        $countries=country::where('status','Active')->get();

        return response()->json([

                'countries'=>$countries,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    }
   

    
}
