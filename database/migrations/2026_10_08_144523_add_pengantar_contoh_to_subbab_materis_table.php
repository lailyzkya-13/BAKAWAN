
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambahkan kolom pengantar
        if (!Schema::hasColumn('subbab_materis', 'pengantar')) {

            Schema::table('subbab_materis', function (Blueprint $table) {
                $table->text('pengantar')->nullable();
            });

        }

        // Menambahkan kolom contoh
        if (!Schema::hasColumn('subbab_materis', 'contoh')) {

            Schema::table('subbab_materis', function (Blueprint $table) {
                $table->text('contoh')->nullable();
            });

        }
    }

    public function down(): void
    {
        Schema::table('subbab_materis', function (Blueprint $table) {
            $table->dropColumn(['pengantar', 'contoh']);
        });
    }
};
