<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class MyController extends Controller
{
    
    function viewpage()
    {
      
        //$data['data'] =   DB::select("select * from users");
        $data['data']=User::all();
        return view('tableview',$data);

    }


}
