<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('subbab_materis', 'pengantar')) {
            Schema::table('subbab_materis', function (Blueprint $table) {
                $table->text('pengantar')->nullable();
            });
        }

        if (!Schema::hasColumn('subbab_materis', 'contoh')) {
            Schema::table('subbab_materis', function (Blueprint $table) {
                $table->text('contoh')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('subbab_materis', 'pengantar')) {
            Schema::table('subbab_materis', function (Blueprint $table) {
                $table->dropColumn('pengantar');
            });
        }

        if (Schema::hasColumn('subbab_materis', 'contoh')) {
            Schema::table('subbab_materis', function (Blueprint $table) {
                $table->dropColumn('contoh');
            });
        }
    }
};
