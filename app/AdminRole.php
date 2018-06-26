<?php

namespace App;

use App\Model;

class AdminRole extends Model
{
    //
    protected $table='admin_roles';
    //当前角色所有权限
    public function permissions(){
        return $this->belongsToMany('App\AdminPermission','admin_permission_role','role_id','permission_id')->withPivot(['permission_id','role_id']);
    }
    //给角色授予权限
    public function grantPermission($permission){
      return  $this->permissions()->save($permission);
    }
    //取消角色权限
    public function deletePermission($permission){
      return  $this->permissions()->detach($permission);//取消关联
    }
    //角色是否有权限
    public function hasPermission($permission){
        return !!$this->permissions->contains($permission);//是否包含
    }
}
