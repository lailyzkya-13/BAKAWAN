<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasPembelajaran extends Model
{
    protected $table = 'aktivitas_pembelajaran';

    protected $fillable = [
        'sekolah_id',
        'judul',
        'deskripsi',
        'jenis',
        'gambar',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
