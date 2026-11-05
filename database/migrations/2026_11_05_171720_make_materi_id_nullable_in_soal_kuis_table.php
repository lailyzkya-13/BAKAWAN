<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {

            // Materi tidak wajib dipilih untuk evaluasi akhir
            $table->unsignedBigInteger('materi_id')
                ->nullable()
                ->change();

        });
    }

    public function down(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {

            // Mengembalikan materi menjadi wajib
            // Rollback hanya aman jika tidak ada materi_id NULL.
            $table->unsignedBigInteger('materi_id')
                ->nullable(false)
                ->change();

        });
    }
};
