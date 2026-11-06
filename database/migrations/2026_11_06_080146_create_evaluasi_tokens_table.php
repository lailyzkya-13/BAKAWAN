<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluasi_tokens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sekolah_id')
                ->constrained('sekolahs');

            $table->foreignId('user_id')
                ->constrained('users');

            $table->string('kode')->unique();
            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });

        Schema::table('hasil_kuis', function (Blueprint $table) {
            $table->foreignId('evaluasi_token_id')
                ->nullable()
                ->constrained('evaluasi_tokens')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('hasil_kuis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('evaluasi_token_id');
        });

        Schema::dropIfExists('evaluasi_tokens');
    }
};