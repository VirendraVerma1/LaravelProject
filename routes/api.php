<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('get_connection','API\TestController@get_connection');//for connection id
Route::post('get_otp','API\TestController@send_otp');//for validation of mobile number
Route::post('verify_otp','API\TestController@verify_otp');//for verify otp
Route::post('employee','API\TestController@index');
Route::post('insert_college','API\TestController@insert_college');
Route::post('update_college','API\TestController@update_college');