<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.login.index');
    }
    public function login(Request $request){
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required|max:20|min:3',
        ]);
        $data['name']=$request->name;
        $data['password']=$request->password;
        if(\Auth::guard('admin')->attempt($data)){
            return redirect("/admin");
        }else{
            return redirect()->back()->withInput()->withErrors("邮箱密码不匹配");
        }
    }
    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect("/admin/login");
    }
}
