<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Task;
class TaskController extends Controller
{
    //
    public function index(){
        $tasks=Task::withoutGlobalScope('avaiable')->where('status',0)->orderBy('created_at','desc')->paginate(10);
        return view('admin.task.index')->withTasks($tasks);
    }

}
