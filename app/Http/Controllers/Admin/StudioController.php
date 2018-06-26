<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Studio;
class StudioController extends Controller
{
    //
    public function index(){
        $studios=Studio::where('status',0)->orderBy('created_at','desc')->paginate(10);
        return view('admin.studio.index')->withStudios($studios);
    }
    public function status(Request $request ,$id){
        $this->validate($request,[
            'status'=>'required|in:-1,1',
        ]);
        $studio=Studio::find($id);
        $studio->status=$request->status;
        $studio->save();
        return [
            'error'=>0,
            'msg'=>''
        ];

    }
}
