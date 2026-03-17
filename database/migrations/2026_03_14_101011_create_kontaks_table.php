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
        Schema::create('kontaks', function (Blueprint $table) {
    $table->id('id_kontak');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->string('alamat');
    $table->string('no_hp');
    $table->string('email');
    $table->string('lokasi_maps')->nullable(); // Biasanya link iframe gmaps
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
