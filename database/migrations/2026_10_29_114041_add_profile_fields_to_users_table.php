<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip_nuptk')->nullable();
            $table->string('sekolah')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->string('kelas')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nip_nuptk',
                'sekolah',
                'mata_pelajaran',
                'kelas'
            ]);
        });
    }
};
