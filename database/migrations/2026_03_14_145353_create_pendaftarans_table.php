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
      Schema::create('pendaftarans', function (Blueprint $table) {
    $table->id('id_pendaftaran');
    $table->string('no_pendaftaran')->unique(); // Contoh: PPDB-2026-001
    $table->string('nama_lengkap');
    $table->enum('jk', ['L', 'P']);
    $table->string('tempat_lahir');
    $table->date('tanggal_lahir');
    $table->string('asal_sekolah');
    $table->string('nama_ayah');
    $table->string('no_hp_orang_tua');
    $table->text('alamat_lengkap');
    $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
