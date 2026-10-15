
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_kuis', function (Blueprint $table) {

            $table->id();

            // Menghubungkan nilai dengan siswa
            $table->foreignId('siswa_id')
                ->constrained('siswa')
                ->cascadeOnDelete();

            // Menyimpan hasil evaluasi
            $table->unsignedTinyInteger('jumlah_benar');
            $table->unsignedTinyInteger('jumlah_soal');
            $table->unsignedTinyInteger('nilai');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_kuis');
    }
};
