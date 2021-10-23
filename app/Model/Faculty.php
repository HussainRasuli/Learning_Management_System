<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';
    protected $primaryKey = 'fac_id';
    public $timestamps = false;

    public function departments()
    {
        return $this->hasMany('App\Model\Department', 'fac_id', 'fac_id');
    }

    public function dep()
    {
        return $this->hasMany('App\Model\Department','fac_id' ,'fac_id');
    }

    public function dep_name()
    {
        return $this->hasOne('App\Model\Department', 'dep_id', 'dep_id');
    }
}
