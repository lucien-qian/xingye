<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUser extends Authenticatable
{
    //
    protected $rememberTokenName='';
    protected $fillable=['name','password'];


    //     用户有哪些角色
    public function roles(){
        return $this->belongsToMany("App\AdminRole",'admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    //     用户是否有某些角色
    public function isInRoles($roles){

        return !!$roles->intersect($this->roles)->count();//取两个集合的交集
    }

    //     给用户分配角色
    public function assignRole($role){
        return $this->roles()->save($role);
    }

    //     删除用户某个角色
    public function deleteRole($role){
        return $this->roles()->detach($role);
    }

    //     用户是否有某些权限
    public function hasPermission($permission){
        return  $this->isInRoles($permission->roles);
    }

}
