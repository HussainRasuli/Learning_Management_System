<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleType extends Model
{
    protected $table = 'role_types';
    protected $primaryKey = 'role_type_id';
    public $timestamps = false; 
}
