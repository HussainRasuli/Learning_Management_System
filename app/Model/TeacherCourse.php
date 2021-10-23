<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $table = 'teachers_courses';
    protected $primaryKey = 'tc_id';
    public $timestamps = false;

    public function course()
    {
        return $this->hasOne('App\Model\Course', 'co_id', 'co_id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Model\Teacher', 'tea_id', 'tea_id');
    }

    public function days()
    {
        return $this->hasOne('App\Model\Day', 'day_id', 'day');
    }

    public function semester(){
        return $this->hasOne('App\Model\Semester', 'sem_id', 'sem_id');
    }

    public function department()
    {
        return $this->hasOne('App\Model\Department', 'dep_id', 'dep_id');
    }

    public function approve_or_dismiss()
    {
        return $this->hasOne('App\Model\StudentCourse', 'tc_id', 'tc_id');
    }
}
