<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerichtPersonalTable extends Migration
{
    public function up()
    {
        Schema::create('bericht_personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bericht_id');
            $table->bigInteger('personal_id');
            $table->integer('funktion_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bericht_user');
    }
}
