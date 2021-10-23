<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Matrial extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'ma_id';
    public $timestamps = false;

    public function assignment_details()
    {
        return $this->hasOne('App\Model\Assignment', 'ma_id', 'ma_id');
    }
}
