<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'tea_id';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\User', 'record_id', 'tea_id')->where('table_name', 1);
    }

    public function dep()
    {
        return $this->hasOne('App\Model\Department', 'dep_id', 'dep_id');
    }
}
