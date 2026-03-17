<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            // Menambahkan user_id yang terhubung ke tabel users (Wali Santri)
            $table->foreignId('user_id')
                  ->nullable() 
                  ->after('id_santri') // Menempatkan kolom setelah ID
                  ->constrained('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};