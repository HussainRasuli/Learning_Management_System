<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'co_id';
    public $timestamps = false;

    public function semesters()
    {
        return $this->hasOne('App\Model\Semester', 'sem_id', 'sem_id');
    }
}