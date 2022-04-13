<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Employee;
use Hash;
use File;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Helpers\functions;

class StudyController extends Controller
{

    public function testFunction(Request $request)
    {
        $data['single_data'] = DB::table('employees')->where('id',$request->key_id)->first();
        $data['company_data'] = DB::table('companys')->get();
        // return view('editview',$data);
        return test_get_mul(2,3);
    }
    
    public function show()
    {
        $data['company_data'] = DB::table('companys')->get();
        $company=DB::table('companys')->get();
        
        
        $data['data'] = Employee::leftjoin('companys','companys.id','employees.company_id')
        ->select('employees.*','companys.name as companyname')->paginate(3);
        
        // dd($data);

        return view('studyview',$data);

    } 

    public function blog()
    {
        session()->flash('warning','Data updated');
        return view('blog');
    }


    public function viewform()
    {
        return view('viewform');
    }

    public function save_data(Request $request)
    {

       //  $employee = new Employee;
       //  $employee->name=$request->name;
       //  $employee->email = $request->email;
       //  $employee->mobile = $request->mobile;
       //  $employee->password = Hash::make($request->password);
       //  $res = $employee->save();
       //  if($res)
       //  {
       //   return redirect('viewform');
       //  }


        //   print_r($request->hobby);
        //   echo "<br/>";
        //    $aa = implode(',',$request->hobby);
        //    echo "<br/>";
        //    echo "<br/>";
        //      $bb =  explode(',',$aa);
        //      print_r($bb[0]);
        // dd();



        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'email' => 'required|unique:employees',
            'mobile' => 'required|numeric',
            'gender' => 'required',
            'profile' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ],
        [
            'name.required' => 'The :attribute field can not be blank.',
            'email.required' => 'The :attribute field can not be blank.',
            'email.unique' => 'Email Should be unique.',
            'mobile.numeric' => 'Mobile number Should be numeric.',
        ]);

        if($validator->fails()){
            return  redirect()->back()->withErrors($validator);
        }


        $image_name = null;
        if ($request->profile != null ) {
                $image      = $request->file('profile');
                $image_name = time().rand().'.'.$image->getClientOriginalExtension();
                $request->profile->move(public_path('upload'), $image_name);
              
        }
        $res = DB::table('employees')->insertGetID([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'gender'=>$request->gender,
            'city'=>$request->city,
            'address'=>$request->address,
            'hobby'=>implode(',', (array)$request->hobby),
            'password'=>Hash::make($request->password),
            'profile'=>$image_name,
            'company_id'=>$request->companyname
        ]);

       
        if($res)
        {
            return redirect('show');
        }



    }


    public function edit_data($id)
    {
        $data['single_data'] = DB::table('employees')->where('id',$id)->first();
        $data['company_data'] = DB::table('companys')->get();
        return view('editview',$data);

    }

    public function update_data(Request $request,$id)
    {

        // $update =    DB::table('employees')
        //    ->where('id',$id)
        //    ->update(['name'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile,'password'=>$request->password]);
        
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'email' => 'required|unique:employees,email,'.$id,
            'mobile' => 'required|numeric',
            'gender' => 'required',
            'profile' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ],
        [
            'required' => 'The :attribute field can not be blank.',
            'email.required' => 'The :attribute field can not be blank.',
            'email.unique' => 'Email Should be unique.',
            'mobile.numeric' => 'Mobile number Should be integer.',
        ]);

        if($validator->fails()){
            return  redirect()->back()->withErrors($validator)->withInput();
        }
            $emp = Employee::find($id);
            $emp->name=$request->name;
            $emp->email =$request->email;
            $emp->mobile=$request->mobile;
            $emp->gender=$request->gender;
            $emp->city=$request->city;
            $emp->address=$request->address;
            $emp->company_id=$request->company;
            $emp->hobby=implode(',', (array)$request->hobby);
            if ($request->profile != null ) {
            $image      = $request->file('profile');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $request->profile->move(public_path('upload'), $image_name);
            if($request->old_img!=null){
                $image_path = public_path("upload/".$request->old_img);
                 if(file_exists($image_path)){
                        File::delete( $image_path);
                }
            }

            $emp->profile=$image_name;     
        }
        $update = $emp->save();
        session()->flash('success','Data updated');
        session(['last_user' => $emp->name]);
        if($update)
           {
             return redirect('show');
           }
    }

    public function delete_data($id)
    {

        $emp = Employee::find($id);
        $image_path = public_path("upload/".$emp->profile);
         if(file_exists($image_path)){
                File::delete( $image_path);
        }
        $delete = $emp->delete();
        if($delete)
        {
            return redirect('show');
        }
    }

    public function force_delete_data($id)
    {

        $emp = Employee::find($id);
        $image_path = public_path("upload/".$emp->profile);
         if(file_exists($image_path)){
                File::delete( $image_path);
        }
        $delete = $emp->forcedelete();
        if($delete)
        {
            return redirect('show');
        }
    }

}
