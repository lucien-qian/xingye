<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
       return view('login.index');
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|max:20|min:3',
            'is_remember'=>'integer',
        ]);
        $data['email']=$request->email;
        $data['password']=$request->password;
        if(\Auth::guard('web')->attempt($data,boolval($request->is_remember))){
            return redirect("/");
        }else{
            return redirect()->back()->withInput()->withErrors("邮箱密码不匹配");
        }
    }
    //登出行为
    public function logout(){
        \Auth::guard('web')->logout();
        return redirect("/login");
    }
}
