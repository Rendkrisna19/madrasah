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
        Schema::create('absensis', function (Blueprint $table) {
            // Primary Key menggunakan id_absensi agar konsisten dengan style kamu
            $table->id('id_absensi');

            // Relasi ke tabel santris (Foreign Key: santri_id -> id_santri)
            $table->unsignedBigInteger('santri_id');
            $table->foreign('santri_id')->references('id_santri')->on('santris')->onDelete('cascade');

            // Relasi ke tabel kelas (Foreign Key: kelas_id -> id_kelas)
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->onDelete('cascade');

            // Relasi ke tabel users (Guru yang melakukan absen)
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references('id')->on('users');

            // Data Absensi
            $table->date('tanggal');
            $table->enum('status', ['H', 'S', 'I', 'A'])->comment('H=Hadir, S=Sakit, I=Izin, A=Alpha');
            $table->string('keterangan')->nullable(); // Opsional untuk catatan tambahan

            $table->timestamps();

            // Index unik agar satu santri tidak bisa diabsen 2 kali di tanggal yang sama
            $table->unique(['santri_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};