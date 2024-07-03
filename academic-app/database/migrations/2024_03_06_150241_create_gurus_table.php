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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id('nip');
            $table->string('nama_guru');
            $table->string('tempatlahir_guru');
            $table->date('tanggallahir_guru');
            $table->string('jk_guru');
            $table->string('pendidikan');
            $table->string('alamat_guru');
            $table->string('agama_guru');
            $table->string('notelp_guru');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
