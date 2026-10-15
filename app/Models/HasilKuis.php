<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    // Nama tabel database
    protected $table = 'hasil_kuis';

    // Kolom yang boleh disimpan
    protected $fillable = [
        'siswa_id',
        'jumlah_benar',
        'jumlah_soal',
        'nilai'
    ];
}
