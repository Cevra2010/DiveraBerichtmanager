<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBerichtToBerichts extends Migration
{
    public function up()
    {
        Schema::table('berichts', function (Blueprint $table) {
            $table->text('gesamtbericht')->nullable()->after("text_6");
        });
    }

    public function down()
    {
        Schema::table('berichts', function (Blueprint $table) {
            //
        });
    }
}
