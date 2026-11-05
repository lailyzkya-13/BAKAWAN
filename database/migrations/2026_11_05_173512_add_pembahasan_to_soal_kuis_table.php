
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {

            // Materi tidak wajib dipilih untuk evaluasi gabungan.
            // Jika sudah nullable dari migration sebelumnya,
            // baris ini boleh dihapus.
            $table->unsignedBigInteger('materi_id')
                ->nullable()
                ->change();

            // Menyimpan pembahasan setiap soal.
            $table->text('pembahasan')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {
            $table->dropColumn('pembahasan');
        });
    }
};
