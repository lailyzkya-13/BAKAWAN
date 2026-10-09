<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalKuis extends Model
{
    protected $table = 'soal_kuis';

    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar',
    ];

    // Setiap soal terhubung dengan satu materi
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}