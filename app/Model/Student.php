<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'stu_id';
    public $timestamps = false;

    public function faculties(){
        return $this->hasOne('App\Model\Faculty', 'fac_id', 'faculty_id');
    }

    public function dep(){
        return $this->hasOne('App\Model\Department', 'dep_id', 'dep_id');
    }

    public function semesters(){
        return $this->hasOne('App\Model\Semester', 'sem_id', 'semester_id');
    }

    public function shifts(){
        return $this->hasOne('App\Model\CourseShift', 'sh_id', 'shift_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'record_id', 'stu_id')->where('table_name', 2);
    }
}
