<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PositionType extends Model
{
    protected $table = 'position_types';
    protected $primaryKey = 'position_type_id';
    public $timestamps = false;
}
