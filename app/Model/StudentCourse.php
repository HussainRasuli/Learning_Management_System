<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = 'students_courses';
    protected $primaryKey = 'sc_id';
    public $timestamps = false;

    public function student(){
        return $this->hasOne('App\Model\Student', 'stu_id', 'stu_id');
    }

    public function semester(){
        return $this->hasOne('App\Model\TeacherCourse', 'tc_id', 'tc_id');
    }

    
}
