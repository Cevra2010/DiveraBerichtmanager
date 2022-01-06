<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterJobsTable extends Migration
{
    public function up()
    {
        Schema::create('printer_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file');
            $table->integer('isDone')->default(null)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('printer_jobs');
    }
}
