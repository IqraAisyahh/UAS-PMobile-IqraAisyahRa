<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKelasColumnTypeInKelasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->enum('kelas', ['X', 'XI', 'XII'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->string('kelas')->change();
        });
    }
}

