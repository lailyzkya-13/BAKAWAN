
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Menambahkan kolom ringkasan
    public function up(): void
    {
        if (!Schema::hasColumn('materis', 'ringkasan')) {

            Schema::table('materis', function (Blueprint $table) {

                $table->text('ringkasan')->nullable();

            });

        }
    }

    // Membatalkan penambahan kolom
    public function down(): void
    {
        if (Schema::hasColumn('materis', 'ringkasan')) {

            Schema::table('materis', function (Blueprint $table) {

                $table->dropColumn('ringkasan');

            });

        }
    }
};
