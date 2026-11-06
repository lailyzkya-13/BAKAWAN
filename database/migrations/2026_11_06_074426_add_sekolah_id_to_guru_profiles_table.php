<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guru_profiles', function (Blueprint $table) {
            $table->foreignId('sekolah_id')
                ->nullable()
                ->constrained('sekolahs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('guru_profiles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('sekolah_id');
        });
    }
};