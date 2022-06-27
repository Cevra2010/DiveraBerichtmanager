<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerichtsTable extends Migration
{
    public function up()
    {
        Schema::create('berichts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('alarm_id');
            $table->integer('hauptbericht')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
            $table->text('text_4')->nullable();
            $table->text('text_5')->nullable();
            $table->text('text_6')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berichts');
    }
}
