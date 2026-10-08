
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah tabel subbab_materis sudah ada
        if (!Schema::hasTable('subbab_materis')) {

            Schema::create('subbab_materis', function (Blueprint $table) {
                $table->id();

                $table->foreignId('materi_id')
                    ->constrained('materis')
                    ->cascadeOnDelete();

                $table->string('judul');
                $table->longText('isi');
                $table->integer('urutan');

                $table->timestamps();
            });

        }
    }

    public function down(): void
    {
        // Tidak menghapus tabel yang mungkin sudah ada sebelumnya.
    }
};
