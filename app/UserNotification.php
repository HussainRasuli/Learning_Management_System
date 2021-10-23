<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';
    protected $primaryKey = 'user_noti_id';
    public $timestamps = false;

    public function notification()
    {
        return $this->hasOne('App\Notification', 'noti_id', 'noti_id');
    }
}
