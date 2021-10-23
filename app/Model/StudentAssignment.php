<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    protected $table = 'students_assignments';
    protected $primaryKey = 'sg_id';
    public $timestamps = false;


    public function material()
    {
        return $this->hasMany('App\Model\Matrial', 'ma_id', 'ma_id');
    }

    public function assignment(){
        return $this->hasOne('App\Model\Assignment', 'as_id', 'assignment_id');
    }
}
