
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('misi_petualangan', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 150);
            $table->text('tutorial');
            $table->text('fakta')->nullable();

            // Urutan misi
            $table->unsignedSmallInteger('urutan')->default(1);

            // Pilihan background dan layout platform
            $table->unsignedTinyInteger('background_index')->default(0);
            $table->unsignedTinyInteger('platform_layout')->default(0);

            // Status misi
            $table->boolean('aktif')->default(true);

            $table->timestamps();

            $table->index(['aktif', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('misi_petualangan');
    }
};
