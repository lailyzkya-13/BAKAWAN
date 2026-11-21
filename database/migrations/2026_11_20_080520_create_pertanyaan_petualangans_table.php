
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanyaan_petualangan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_petualangan_id')
                ->unique()
                ->constrained('item_petualangan')
                ->cascadeOnDelete();

            $table->text('pertanyaan');

            // Menyimpan pilihan jawaban dalam bentuk JSON
            $table->json('pilihan_jawaban');

            // Indeks jawaban benar dimulai dari 0
            $table->unsignedTinyInteger('jawaban_benar');

            $table->text('penjelasan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_petualangan');
    }
};
