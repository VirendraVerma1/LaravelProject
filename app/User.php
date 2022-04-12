<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = ['id','name', 'mobile', 'email', 'password','address', 'created_at', 'updated_at'];

    protected  $table="users";


}
