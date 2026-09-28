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
        Schema::create('objek_aktivitas', function (Blueprint $table) {
            $table->id();

            $table->string('nama_objek');

            $table->string('gambar');

            $table->enum('kategori', [
                'biotik',
                'abiotik'
            ]);

            $table->text('penjelasan');

            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objek_aktivitas');
    }
};