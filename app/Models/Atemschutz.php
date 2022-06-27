<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atemschutz extends Model
{
    public function bericht() {
        return $this->hasOne(Bericht::class,'id','bericht_id');
    }

    public function personal() {
        return $this->hasOne(Personal::class,'id','personal_id');
    }
}
