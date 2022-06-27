<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerichtRelationship extends Model
{
    use HasFactory;

    protected $table = 'bericht_personal';

    public function personal() {
        return $this->hasOne(Personal::class,'id','personal_id')->orderBy('lastname');
    }

    public function position() {
        return $this->hasOne(Position::class,'id','position_id');
    }
}
