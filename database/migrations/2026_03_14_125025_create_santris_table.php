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
       Schema::create('santris', function (Blueprint $table) {
    $table->id('id_santri');
    $table->string('nis')->unique();
    $table->string('nama_santri');
    $table->enum('jk', ['L', 'P']);
    $table->foreignId('kelas_id')->constrained('kelas', 'id_kelas');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
