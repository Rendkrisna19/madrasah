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
    $table->foreignId('kelas_id')->constrained('kelas', 'id_kelas');
    $table->foreignId('guru_id')->constrained('gurus', 'id_guru');
    $table->string('nama_mapel');
    $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad']);
    $table->time('jam_mulai');
    $table->time('jam_selesai');
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
