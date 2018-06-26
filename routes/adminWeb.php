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
//后台路由
Route::group([ 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');
    Route::group(['middleware'=>'auth:admin'],function(){
        Route::get('/', 'HomeController@index');
        Route::group(['middleware'=>'can:systems'],function(){
            Route::resource('users','UserController');
            Route::resource('roles','RoleController');
            Route::resource('permissions','PermissionController');
            Route::get("/users/{id}/role","UserController@role");//用户角色关联
            Route::post("/users/{id}/role","UserController@storeRole");//用户角色关联
            Route::get("/roles/{id}/permission","RoleController@permission");//角色关联权限
            Route::post("/roles/{id}/permission","RoleController@storePermission");//角色关联权限
            Route::resource('codes','CodeController');//生成邀请码
            Route::post("/codes/{id}/send","CodeController@send");

        });

        Route::group(['middleware'=>'can:tasks'],function(){
            Route::get('/tasks','TaskController@index');
        });

        Route::group(['middleware'=>'can:studios'],function(){
            Route::get('/studios','StudioController@index');
            Route::post('/studios/{id}/status','StudioController@status');
        });
        Route::group(['middleware'=>'can:tags'],function(){
            Route::resource('tags','TagController');
        });
        Route::group(['middleware'=>'can:notices'],function(){
            Route::resource('notices','NoticeController');
        });
    });
});


