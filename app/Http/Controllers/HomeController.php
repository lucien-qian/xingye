<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class HomeController extends Controller
{
    //
    public function index(){
        return view('home')->withTasks(Task::orderBy('id','desc')->withCount('applies','comments')->paginate(10));
    }
}
