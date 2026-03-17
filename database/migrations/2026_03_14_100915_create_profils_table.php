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
     Schema::create('profils', function (Blueprint $table) {
    $table->id('id_profil');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->text('sejarah');
    $table->text('visi_misi');
    $table->string('struktur_organisasi'); // Bisa string (path gambar) atau text
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
