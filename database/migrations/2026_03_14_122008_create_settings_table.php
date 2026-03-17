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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        // Konten Home
        $table->string('hero_title')->nullable();
        $table->text('hero_subtitle')->nullable();
        
        // Konten Profil
        $table->text('sejarah')->nullable();
        $table->text('visi')->nullable();
        $table->text('misi')->nullable();
        
        // Tambahan (Opsional)
        $table->string('logo')->nullable();
        $table->string('email_kontak')->nullable();
        $table->string('telepon')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
