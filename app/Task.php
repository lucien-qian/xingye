<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\Builder;
class Task extends Model
{
    //
    //全局scope
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('avaiable',function(Builder $builder){
            $builder->whereIn('status',[0,1]);
        });
    }
    //关联用户
    public function user(){
        return $this->belongsTo("App\User",'user_id','id');
    }
    //关联申请
    public function applies(){
        return $this->hasMany("App\Apply");
    }
    //关联用户申请
    public function apply($user_id){
        return $this->hasOne("App\Apply")->where('user_id',$user_id);
    }

    //关联评论
    public function comments(){
        return $this->hasMany("App\Comment")->orderBy("created_at",'desc');
    }
    //当前任务所有标签
    public function tags(){
        return $this->belongsToMany('App\Tag','task_tags','task_id','tag_id')->withPivot(['tag_id','task_id']);
    }
    //给任务授予标签
    public function grantTag($tag){
        return  $this->tags()->save($tag);
    }
    //取消任务标签
    public function deleteTag($tag){
        return  $this->tags()->detach($tag);
    }
}
