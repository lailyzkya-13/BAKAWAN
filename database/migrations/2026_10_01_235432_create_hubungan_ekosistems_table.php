<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hubungan_ekosistem', function (Blueprint $table) {
            $table->id();
            $table->string('objek_kiri');
            $table->string('gambar_kiri');
            $table->string('objek_kanan');
            $table->string('gambar_kanan');
            $table->text('hubungan');
            $table->text('clue');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hubungan_ekosistem');
    }
};