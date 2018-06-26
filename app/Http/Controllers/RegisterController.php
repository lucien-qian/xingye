<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Code;
class RegisterController extends Controller
{
    //
    public function index(){
      return  view('register.index');
    }
    public function register(Request $request){
//数据验证

        $this->validate($request,[
            'name'=>'required|min:3|max:20|unique:users',
            'password'=>'required|min:3|max:20|confirmed',
            'email'=>'required|unique:users|email',
            'vCode'=>'required|string|exists:codes,vCode,status,1',

        ]);
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=bcrypt($request->password);
        if(User::create($data)){
            Code::where('vCode',$request->vCode)->delete();
            return redirect("/login");
        }else{
            return redirect()->back()->withInput()->withErrors("修改失败");
        }
    }
}
