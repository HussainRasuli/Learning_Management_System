<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $primaryKey = 'staff_id';
    public $timestamps = false;

    public function position()
    {
        return $this->hasOne('App\Model\Position','position_id' ,'position_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'record_id', 'staff_id')->where('table_name', 3);
    }

    public function dep(){
        return $this->hasOne('App\Model\Department', 'dep_id', 'dep_id');
    }
}
