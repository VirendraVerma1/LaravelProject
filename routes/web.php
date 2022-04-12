<?php

use App\Http\Controllers\FirstController;
use App\Http\Controllers\StudyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('show/{id}','FirstController@show');

//Route::get("show",[FirstController::class,"show"]);

Route::get('viewpage','MyController@viewpage');
Route::get('show','StudyController@show');
Route::get('blog/blog','StudyController@blog');
Route::get('viewform','StudyController@viewform');
Route::post('save_data','StudyController@save_data');
Route::get('edit_data/{id}','StudyController@edit_data');
Route::post('update_data/{id}','StudyController@update_data');
Route::get('delete_data/{id}','StudyController@delete_data');

include('auth.php');

Route::get('/home', 'HomeController@index')->name('home');
