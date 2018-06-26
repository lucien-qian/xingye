<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
class NoticeController extends Controller
{
    //
    public function index(){
        $user=\Auth::user();
        $notices=$user->notices()->paginate(10);
        return view('notice.index')->withNotices($notices);
    }
}
