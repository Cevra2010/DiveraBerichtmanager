<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $table = 'alarms';
    protected $dates = [
        'alarm_at',
    ];

    public function bericht() {
        return $this->hasOne(Bericht::class,'alarm_id','id');
    }
}
