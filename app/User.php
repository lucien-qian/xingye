<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Fan;
class User extends Authenticatable
{
    //
    protected $fillable=['name','email','password'];
    //获取用户发布的任务
    public function tasks(){
        return $this->hasMany("App\Task")->orderBy('created_at','desc');
    }
    public function applies(){
        return $this->belongsToMany("App\Task",'applies','user_id','task_id')->withPivot(['user_id','task_id']);
    }
    //关联工作室
    public function studio(){
        return $this->hasOne("App\Studio");
    }


    //获取某用户关注用户列表（该用户关注了谁,该用户是粉丝）
    public function stars(){
        return $this->hasMany('App\Fan','fan_id','id');
    }

    //获取用户粉丝数（该用户被多少人关注了）

    //获取用户粉丝用户列表（该用户被谁关注了，该用户是明星）

    public function fans(){
        return $this->hasMany('App\Fan','star_id','id');
    }

    //当前是否关注某个用户
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }

    //当前是否被某个用户关注
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //增加我对某个用户关注
    public function doFan($uid){
        $fan=new Fan;
        $fan->star_id=$uid;
        return $this->stars()->save($fan);

    }
    //取消我对某个用户关注
    public function doUnfan($uid){
        $fan=new Fan;
        $fan->star_id=$uid;
        return $this->stars()->delete($fan);

    }

    //用户收到的通知
    public function notices(){
        return $this->belongsToMany('App\Notice','user_notice','user_id','notice_id')->withPivot(['user_id','notice_id']);
    }

    //给用户添加通知
    public function addNotice($notice){
        return $this->notices()->save($notice);//detach
    }

}
