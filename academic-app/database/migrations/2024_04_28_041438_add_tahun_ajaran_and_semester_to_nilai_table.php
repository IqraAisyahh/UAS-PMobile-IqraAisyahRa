<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->string('tahun_ajaran')->after('id_mapel')->nullable();
            $table->string('semester')->after('tahun_ajaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropColumn(['tahun_ajaran', 'semester']);
        });
    }
};
