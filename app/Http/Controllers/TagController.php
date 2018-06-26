<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Task;
use App\TaskTag;
class TagController extends Controller
{
    //
    public function show($id){
        //标签任务数
        $tag=Tag::withCount('taskTags')->find($id);
        //标签任务
        $tasks=$tag->tasks()->orderBy('created_at')->paginate(10);

        return view('tag/show',compact('tasks','tag'));
    }


}
