<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Code;

class CodeController extends Controller
{
    //
    public function index(){
        return view("admin.code.index")->withCodes(Code::where('status',0)->paginate(10));
    }
    public function create(){
        return view("admin.code.create");
    }
    public function store(Request $request){
        $this->validate($request,[
           'codeNum'=>'int|max:10|min:1',
        ]);
       for($i=0;$i<$request->codeNum;$i++){
            $data['vCode']=md5(bcrypt(md5(uniqid())));
           Code::create($data);
        }
        return redirect('admin/codes');

    }
    public function send(Request $request,$id){
        $this->validate($request,[]);
        $code=Code::find($id);
        $code->status=1;
        $code->save();
        return [
            'error'=>0,
            'msg'=>''
        ];
    }
}
