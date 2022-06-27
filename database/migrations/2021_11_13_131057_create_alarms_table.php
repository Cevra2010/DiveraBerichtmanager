<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlarmsTable extends Migration
{
    public function up()
    {
        Schema::create('alarms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('alarm_id')->nullable();
            $table->string('einsatz_nr')->nullable();
            $table->string("stichwort")->nullable();
            $table->string("bemerkung")->nullable();
            $table->string('address')->nullable();
            $table->dateTime('alarm_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alarms');
    }
}
