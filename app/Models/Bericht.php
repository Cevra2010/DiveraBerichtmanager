<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bericht extends Model
{

    protected $dates = [
        'finished_at',
    ];

    protected $casts = [
        'finished_at' => 'date:d.m.Y H:i'
    ];

    public function alarm() {
        return $this->hasOne(Alarm::class,'id','alarm_id');
    }

    public function personal() {
        return $this->belongsToMany(Personal::class,'bericht_personal');
    }
}
