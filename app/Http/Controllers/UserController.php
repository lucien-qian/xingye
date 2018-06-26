<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    //
    public function index($id){
        $user=User::withCount(['tasks','stars','fans'])->find($id);
        $tasks=$user->tasks()->paginate(10);
        $applies=$user->applies;
        $stars=$user->stars;
        $susers=User::whereIn("id",$stars->pluck("star_id"))->withCount(["tasks",'stars','fans'])->get();
        $fans=$user->fans;
        $fusers=User::whereIn("id",$fans->pluck("fan_id"))->withCount(["tasks",'stars','fans'])->get();

        return view('user.index',compact('user','tasks','applies','susers','fusers'));
    }

    public function fan($id){

        $me=\Auth::user();

        $me->doFan($id);
        return [
            'error'=>0,
            'msg'=>'',
        ];
    }
    public function unfan($id){

        $me=\Auth::user();
        $me->doUnfan($id);
        return [
            'error'=>0,
            'msg'=>'',
        ];
    }
    public function setting(){
        return view('user.setting');
    }
}
