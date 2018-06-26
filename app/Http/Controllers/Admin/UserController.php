<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\AdminUser;
use App\AdminRole;
class UserController extends Controller
{
    //
    public function index(){
        $users=AdminUser::paginate(10);
        return view('admin.user.index')->withUsers($users);
    }
    public function create(){
        return view('admin.user.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3',
            'password'=>'required|min:3',
        ]);
    $data['name']=$request->name;
    $data['password']=bcrypt($request->password);
    if(AdminUser::create($data)){
       return redirect("admin/users");
    }else{
        return redirect()->back()->withInput()->withErrors('添加失败');
    }

    }

    public function role($id){
        $user=AdminUser::find($id);
        $roles=AdminRole::all();
        $myRoles=$user->roles;
        return view('admin.user.role',compact('user','roles','myRoles'));
    }
    public function storeRole(Request $request,$id){
        $this->validate($request,[
            'roles'=>'array|required',
        ]);
        $user=AdminUser::find($id);
        $roles=AdminRole::findMany($request->roles);
        $myRoles=$user->roles;
        $addRoles=$roles->diff($myRoles);
           foreach($addRoles as $role){
               $user->assignRole($role);
           }

        $deleteRoles=$myRoles->diff($roles);
            foreach($deleteRoles as $role){
                $user->deleteRole($role);
            }
            return redirect('/admin/users');
    }
}
