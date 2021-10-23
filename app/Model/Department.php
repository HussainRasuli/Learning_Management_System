<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'dep_id';
    public $timestamps = false;

    public function course()
    {
        return $this->hasMany('App\Model\Course', 'dep_id', 'dep_id');
    }

    public function fac()
    {
        return $this->hasOne('App\Model\Faculty', 'fac_id', 'fac_id');
    }

    public function staff()
    {
        return $this->hasOne('App\Model\Staff', 'dep_id', 'dep_id');
    }
}
