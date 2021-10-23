<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false; 

    public function permission(){
        return $this->belongsToMany('App\Model\Permission', 'roles_permissions', 'roles_id', 'permission_id');
    }   

    public function role_type(){
        return $this->hasMany('App\Model\RoleType', 'role_type_id' , 'role_type_id');
    }
}
