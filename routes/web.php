<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
@include('adminWeb.php');
Route::get('/','HomeController@index');
Route::get('/register','RegisterController@index');
Route::post('/register','RegisterController@register');
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');
Route::get('/tag/{id}',"TagController@show");//专题页面
Route::post('/tag/{id}/submit',"TagController@submit");//专题页面
Route::group(['middleware'=>'auth:web'],function(){
    Route::resource('/tasks','TaskController');
    Route::post('/tasks/image/upload',"TaskController@imageUpload");//编辑器图片上传
    Route::get('/tasks/{id}/apply',"TaskController@apply");//申请
    Route::get('/tasks/{id}/unApply',"TaskController@unApply");//取消申请
    Route::post('/tasks/{id}/comment',"TaskController@comment");//留言

    Route::get('/users/{id}',"UserController@index");//个人主页
    Route::post('/user/{id}/fan',"UserController@fan");//个人关注
    Route::post('/user/{id}/unfan',"UserController@unfan");//个人取消关注
    Route::get('/user/me/setting',"UserController@setting");//个人设置页面
    Route::post('/user/me/setting',"UserController@settingStore");//个人设置操作

    Route::get('/studio/apply','StudioController@apply');//工作室申请
    Route::get('/studio/applyTo','StudioController@applyTo');
    Route::post('/studio/store','StudioController@store');
    //消息管理
    Route::get('/notices','NoticeController@index');


});

