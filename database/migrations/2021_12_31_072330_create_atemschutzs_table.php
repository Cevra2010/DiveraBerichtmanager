<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtemschutzsTable extends Migration
{
    public function up()
    {
        Schema::create('atemschutzs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bericht_id');
            $table->bigInteger('personal_id');
            $table->string('geraet_nr')->nullable();
            $table->integer('minutes')->nullable();
            $table->text('tatigkeit')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atemschutzs');
    }
}
