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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id('id_mapel');
            // $table->foreignId('nip')->references('nip')->on('gurus');
            $table->string('nama_mapel');
            $table->foreignId('nip')->references('nip')->on('gurus');
            $table->timestamps();

            // $table->foreign('nip')->references('nip')->on('gurus');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};
