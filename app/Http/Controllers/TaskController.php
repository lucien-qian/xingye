<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Apply;
use App\Comment;
use App\Studio;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use App\Notice;
use App\jobs\SendNotice;
class TaskController extends Controller
{
    //
    public function show($id){
        $task=Task::find($id);
        $task->load('comments');
        $task->load('applies');
        $task->comments=$task->comments()->paginate(10);
        return view('task.show')->withTask($task);
    }
    public function create(){
        $studio=User::find(\Auth::id())->studio;

        if(empty($studio)){
            return view('studio.toApply');

        }else{
            if($studio->status==0){
                return view('studio.ApplyTo');
            }elseif($studio->status==1){
                return view('task.create')->withTags(Tag::all());
            }
        }

    }
    public function store(Request $request){

        $this->validate($request,[
            'title'=>'required|string|max:100',
            'price'=>'required|integer',
            'requireContent'=>'required|string',
            'taskContent'=>'required|string',
        ]);
        $data=$request->except('tags');
        $data['user_id']=\Auth::id();
        if($task=Task::create($data)){

            $tags=Tag::findMany($request->tags);
            foreach($tags as $tag){
                $task->grantTag($tag);
            }
            return redirect("/");
        }else{
            return back()->withErrors("任务发布失败");
        }
    }
    public function imageUpload(Request $request){
        $pic=$request->file('wangEditorH5File');
        $name=$pic->getClientOriginalName();//得到图片名；
        $ext=$pic->getClientOriginalExtension();//得到图片后缀；
        $fileName=md5(uniqid($name));
        $fileName=$fileName.'.'.$ext;//生成新的的文件名
        $bool=Storage::disk('public')->put($fileName,file_get_contents($pic->getRealPath()));//
        //$path='/upload/avatar/'.$fileName;//返回文件路径存贮在数据库
       // $path=$request->file('wangEditorH5File')->storePublicly(md5(time()));
        return  asset('storage/'.$fileName);
    }
    public function edit($id){
        $task=Task::find($id);
        $tags=Tag::all();
        $myTags=$task->tags;
        return view('task.edit',compact('task','tags','myTags'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|string|max:100',
            'price'=>'required|integer',
            'requireContent'=>'required|string',
            'taskContent'=>'required|string',
        ]);
        $task=Task::find($id);
        $this->authorize('update',$task);
        $data=$request->except('tags');
        if($task->update($data)){
            $tags=Tag::findMany($request->tags);
            $myTags=$task->tags;
            $addTags=$tags->diff($myTags);
            $deleteTags=$myTags->diff($tags);
            foreach($addTags as $tag){
                $task->grantTag($tag);
            }
            foreach($deleteTags as $tag){
                $task->deleteTag($tag);
            }
            return redirect("/tasks/".$id);
        }



    }
    public function destroy($id){
        $task=Task::find($id);
        $this->authorize('delete',$task);
        $task->delete();
        return redirect('/');
    }

    public function apply($id){
        $data['user_id']=\Auth::id();
        $data['task_id']=$id;
        if(Apply::firstOrCreate($data)){
            $task=Task::find($id);
            $arr['title']='用户任务申请';
            $arr['content']="申请人：<a href='/users/".$data['user_id']."'>".\Auth::user()->name."</a><br>申请任务：<a href='/tasks/".$id."'>".$task->title."</a>";
            $notice=Notice::create($arr);
            dispatch(new SendNotice($notice,$task->user));
            return back();
        }
    }
    public function unApply($id){
        $task=Task::find($id);
        if($task->apply(\Auth::id())->delete()){

            return back();
        }
    }
    public function comment(Request $request,$id){
        $this->validate($request,[
            'content'=>"required|min:3",
        ]);
        $data=$request->all();
        $data['user_id']=\Auth::id();
        $data['task_id']=$id;
        if(Comment::create($data)){
            return back();
        }

    }

}
