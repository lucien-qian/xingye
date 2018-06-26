<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\AdminPermission;
class PermissionController extends Controller
{
    //
    public function index(){

        return view('admin.permission.index')->withPermissions(AdminPermission::all());
    }
    public function create(){

        return view('admin.permission.create');
    }
    public function store(Request $request){
            $this->validate($request,[
            'name'=>"required|min:3|max:20",
            'description'=>"required",
        ]);
        if(AdminPermission::create($request->all())){
            return redirect("/admin/permissions");
        }else{
            return redirect()->back()->withInput()->withErrors('添加失败!!');
        }

    }
}
