<?php

namespace App;

use App\Model;

class Tag extends Model
{
    //属于这个标签的所有任务
    public function tasks(){
        return $this->belongsToMany('App\Task','task_tags','tag_id','task_id');
    }
    //属于这个标签的任务数
    public function taskTags(){
        return $this->hasMany('App\TaskTag','tag_id','id');
    }
}
