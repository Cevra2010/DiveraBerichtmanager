<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsUebungToAlarms extends Migration
{
    public function up()
    {
        Schema::table('alarms', function (Blueprint $table) {
            $table->integer('is_uebung')->nullable()->default(0)->after("address");
        });
    }

    public function down()
    {
        Schema::table('alarms', function (Blueprint $table) {
            //
        });
    }
}
