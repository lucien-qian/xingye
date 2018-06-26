<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\AdminRole;
use App\AdminPermission;
class RoleController extends Controller
{
    //
    public function index(){

        return view('admin.role.index')->withRoles(AdminRole::all());
    }
    public function create(){
        return view('admin.role.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>"required|min:3|max:20",
            'description'=>"required",
        ]);
        if(AdminRole::create($request->all())){
            return redirect("/admin/roles");
        }else{
            return redirect()->back()->withInput()->withErrors('添加失败!!');
        }
    }
    public function permission($id){
        $role=AdminRole::find($id);
        $permissions=AdminPermission::all();
        $myPermissions=$role->permissions;
        return view('admin.role.permission' ,compact('permissions','myPermissions','role'));
    }
    public function storePermission(Request $request,$id){
        $this->validate($request,[
            'permissions'=>"required|array",
        ]);

        $role=AdminRole::find($id);
        $permissions=AdminPermission::findMany($request->permissions);
        //$permissions=AdminPermission::whereIn('id',$request->permissions)->get();
        $myPermissions=$role->permissions;
        $addPermissions=$permissions->diff($myPermissions);
        foreach($addPermissions as $permission){
            $role->grantPermission($permission);
        }
        $deletePermissions=$myPermissions->diff($permissions);
        foreach($deletePermissions as $permission){
            $role->deletePermission($permission);
        }
        return redirect("/admin/roles");
    }

}
