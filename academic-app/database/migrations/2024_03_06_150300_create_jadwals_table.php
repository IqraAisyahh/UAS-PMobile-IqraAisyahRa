<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_kelas')->references('id_kelas')->on('kelas');
            $table->foreignId('id_mapel')->references('id_mapel')->on('mapels');
            $table->string('hari');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->string('semester');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
