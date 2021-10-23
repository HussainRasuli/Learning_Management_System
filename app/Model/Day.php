<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';
    protected $primaryKey = 'day_id';
    public $timestamps = false;
}
