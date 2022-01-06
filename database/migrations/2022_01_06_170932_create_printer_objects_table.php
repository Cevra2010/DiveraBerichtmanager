<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterObjectsTable extends Migration
{
    public function up()
    {
        Schema::create('printer_objects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->string('title');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('printer_objects');
    }
}
