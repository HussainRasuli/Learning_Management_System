<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PeriodYear extends Model
{
    protected $table = 'period_years';
    protected $primaryKey = 'log_id';
    public $timestamps = false;
}
