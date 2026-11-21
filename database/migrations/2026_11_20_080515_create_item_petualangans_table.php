
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_petualangan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('misi_petualangan_id')
                ->constrained('misi_petualangan')
                ->cascadeOnDelete();

            // Identitas objek dalam permainan
            $table->string('kode', 60);
            $table->string('jenis', 20);

            // Informasi objek
            $table->string('label', 150);
            $table->string('asset_key', 50);

            // Posisi objek dalam permainan (%)
            $table->unsignedTinyInteger('posisi_x');
            $table->unsignedTinyInteger('posisi_y');

            // Poin ketika objek berhasil diselesaikan
            $table->unsignedSmallInteger('poin')->default(0);

            $table->unsignedSmallInteger('urutan')->default(1);
            $table->boolean('aktif')->default(true);

            $table->timestamps();

            $table->unique([
                'misi_petualangan_id',
                'kode'
            ]);

            $table->index([
                'misi_petualangan_id',
                'jenis',
                'aktif'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_petualangan');
    }
};
