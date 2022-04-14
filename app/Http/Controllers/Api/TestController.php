<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use App\College;
use Illuminate\Support\Str;
use DB;


class TestController extends Controller
{


    #region college

    public function insert_college(Request $request)
    {
        $college=new College;
        $college->college_name=$request->college_name;
        $college->save();
    }

    public function update_college(Request $request)
    {
        $college=College::find($request->id);
        $college->college_name=$request->college_name;
        $college->save();
    }

    #endregion

    public function get_connection(Request $request)
    {
        

        if($request->key==12345678)//this will happen on the very first time for creating new connection id
			{
				//we will create new random string for connection id
				$str=Str::random(20);
				DB::table('connection_request')->insert(['connection_id'=>$str]);
				$response=$this->response('connection_id',$str,'1000');
			}

            return $response;
    }

    public function send_otp(Request $request)
    {
        $valid=$this->check_connection($request->connection_id);
        if($valid)
        {
            //mobile
            //otp 
            //phone number (exist)
            $mobile=$request->mobile;
            $otp=rand(1111,9999);
            DB::table('otp')->insert(['mobile'=>$mobile,'otp_number'=>$otp]);
            
            $employee=Employee::where('mobile',$mobile)->first();

            return $this->response('Employee',$employee,'1000');
            
        }
        else{
            return $this->response('invalid user',null,'1000');
        }
        
    }


    public function verify_otp(Request $request)
    {
        
        $valid=$this->check_connection($request->connection_id);
        if($valid)
        {
            $mobile=$request->mobile;
            $otp=$request->otp;

            $otp_valid=DB::table('otp')->where('mobile',$mobile)->where('otp_number',$otp)->first();
            if($otp_valid)
            {
                $user=Employee::where('mobile',$mobile)->first();
                if($user)
                {
                    //login
                    $auth_code=Str::random(20);
                    DB::table('connection_request')->where('connection_id',$request->connection_id)->update(['auth_code'=>$auth_code,'user_id'=>$user->id]);
                    $connection= DB::table('connection_request')->where('connection_id',$request->connection_id)->first();
                    return $this->response('user verified',$connection,'1000');
                }
                else
                {
                    //register

                    return $this->response('user dosent exist',null,'1000');
                }
            }
            else
            {
                return $this->response('invalid otp',$otp_valid,'1000');
            }

        }
        else{
            return $this->response('invalid user',null,'1000');
        }
    }





    public function index(Request $request)
    {
        $employee=Employee::all();
		$response=$this->response('EmployeeList',$employee,'1000');
		return $response;
    }


    private function response($msg,$data=null,$code)
    {
        if($data){
            $status='success';
            
        }
        else
        {
        $status='failed';
        
        }
        return ['status'=>$status,'message'=>$msg,'data'=>$data,'code'=>$code];
    }

    public function check_connection($connection)
    {
        $valid=DB::table('connection_request')->where('connection_id',$connection)->first();
        if($valid)
        return true;
        else
        return false;
    }
}
