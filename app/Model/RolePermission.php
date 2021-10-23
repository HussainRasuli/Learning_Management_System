<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'roles_permissions';
    protected $primaryKey = 'rp_id';
    public $timestamps = false;
}
