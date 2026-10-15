
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel siswa
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {

            $table->id();

            // Nama lengkap siswa
            $table->string('nama_lengkap', 100);

            // Kelas siswa
            $table->string('kelas', 30);

            // Waktu data dibuat dan diperbarui
            $table->timestamps();

        });
    }

    // Menghapus tabel jika migration dibatalkan
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
