<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('aktivitas_pembelajaran', function (Blueprint $table) {
            $table->id();

            // Sekolah pemilik aktivitas (kosong untuk aktivitas umum)
            $table->foreignId('sekolah_id')
                ->nullable()
                ->constrained('sekolahs')
                ->nullOnDelete();

            // Informasi aktivitas
            $table->string('judul');
            $table->text('deskripsi')->nullable();

            // Jenis permainan
            $table->string('jenis');

            // Gambar aktivitas
            $table->string('gambar')->nullable();

            // Aktif atau tidak aktif
            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_pembelajaran');
    }
};
