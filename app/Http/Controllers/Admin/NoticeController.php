<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Notice;
use App\jobs\SendMessage;
class NoticeController extends Controller
{
    //
    public function index(){
        return view('admin.notice.index')->withNotices(Notice::all());
    }
    public function create(){
        return view("admin.notice.create");
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|string',
            'content'=>"required|string",
        ]);
        $notice=Notice::create($request->all());
        dispatch(new SendMessage($notice));
        return redirect('/admin/notices');
        // nohup php artisan queue:work >>/dev/null &
    }
}
