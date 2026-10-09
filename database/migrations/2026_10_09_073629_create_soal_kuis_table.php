<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soal_kuis', function (Blueprint $table) {

            $table->id();

            // Menghubungkan soal dengan materi
            $table->foreignId('materi_id')
                ->constrained('materis')
                ->restrictOnDelete();

            // Pertanyaan kuis
            $table->text('pertanyaan');

            // Empat pilihan jawaban
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');

            // Jawaban yang benar: A, B, C, atau D
            $table->string('jawaban_benar', 1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal_kuis');
    }
};