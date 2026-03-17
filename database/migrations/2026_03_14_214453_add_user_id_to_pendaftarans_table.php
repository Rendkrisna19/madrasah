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
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Kita tambahkan nullable() agar tidak error jika di tabelmu sudah ada data pendaftar sebelumnya.
            // after() gunanya agar posisi kolomnya rapi di sebelah kanan id_pendaftaran.
            $table->foreignId('user_id')
                  ->nullable()
                  ->after('id_pendaftaran')
                  ->constrained('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Wajib drop foreign key-nya dulu sebelum drop kolomnya
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};