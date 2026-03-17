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
            Schema::create('beritas', function (Blueprint $table) {
        $table->id('id_berita');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('judul_berita'); // Ditambahkan agar lebih logis
        $table->text('isi_berita');
        $table->date('tanggal');
        $table->text('deskripsi'); // Bisa untuk ringkasan
        $table->string('gambar')->nullable(); // Opsional untuk cover berita
        $table->timestamps();
    });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('beritas');
        }
    };
