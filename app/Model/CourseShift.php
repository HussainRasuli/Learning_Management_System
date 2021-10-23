<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseShift extends Model
{
    protected $table = 'courses_shifts';
    protected $primaryKey = 'sh_id';
    public $timestamps = false;
}
