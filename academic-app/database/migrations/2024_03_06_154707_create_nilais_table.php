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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('nis');
            $table->unsignedBigInteger('nip');
            $table->unsignedBigInteger('id_mapel');
            $table->float('nilai_uh')->nullable();
            $table->float('nilai_uts')->nullable();
            $table->float('nilai_uas')->nullable();
            $table->float('nilai_praktek')->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas'); // Perbaikan referensi tabel siswa
            $table->foreign('nip')->references('nip')->on('gurus'); // Perbaikan referensi tabel guru
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels'); // Perbaikan referensi tabel mapel

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
