<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    // Nama tabel database
    protected $table = 'materis';

    // Data yang boleh disimpan
    protected $fillable = [
        'judul',
        'deskripsi',
        'konten',
        'gambar',
        'durasi',
        'ringkasan',
    ];

    // Satu materi memiliki banyak subbab
    public function subbab()
    {
        return $this->hasMany(
            SubbabMateri::class,
            'materi_id'
        )->orderBy('urutan');
    }
}
