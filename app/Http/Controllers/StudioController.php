<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studio;
use App\User;
use Illuminate\Support\Facades\Storage;
class StudioController extends Controller
{
    //
    public function apply(){
        $studio=User::find(\Auth::id())->studio;

        if(empty($studio)){
            return view('studio.apply');
        }else{
            if($studio->status==0){
                return view('studio.ApplyTo');
            }elseif($studio->status==1){
                return view('task.create');
            }
        }

    }
    public function store(Request $request){
        $this->validate($request,[
            //'avatar'=>'string|required',
            'name'=>'required|string|unique:studios',
        ]);
        $data=$request->all();
        $data['user_id']=\Auth::id();
        $pic=$request->file('avatar');
        $name=$pic->getClientOriginalName();//得到图片名；
        $ext=$pic->getClientOriginalExtension();//得到图片后缀；

        $fileName=md5(uniqid($name));
        $fileName=$fileName.'.'.$ext;//生成新的的文件名
        $bool=Storage::disk('avatar')->put($fileName,file_get_contents($pic->getRealPath()));//
        $data['avatar']='/upload/avatar/'.$fileName;//返回文件路径存贮在数据库
        if(!$bool){
            return false;
        }

        if(Studio::create($data)){
            return redirect('/studio/applyTo');
        }
    }
    public function applyTo(){
        $studio=User::find(\Auth::id())->studio;
        if(empty($studio)){
            return view('studio.apply');
        }else{
            if($studio->status==0){
                return view('studio.ApplyTo');
            }elseif($studio->status==1){
                return view('task.create');
            }
        }

    }
}
