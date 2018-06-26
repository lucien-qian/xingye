<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Tag;
class TagController extends Controller
{
    //
    public function index(){
        return view('admin.tag.index')->withTags(Tag::all());
    }

    public function create(){
        return view('admin.tag.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        if(Tag::create($request->all())){
            return redirect('/admin/tags');
        }else{
            return redirect()->back()->withInput->withErrors('添加失败');
        }
    }
    public function destroy($id){

        Tag::find($id)->delete();
        return [
            'error'=>0,
            'msg'=>'',
        ];


    }
}
