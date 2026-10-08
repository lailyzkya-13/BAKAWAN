<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'konten',
        'gambar',
        'durasi',
        'ringkasan',
    ];

    public function subbab()
    {
        return $this->hasMany(
            SubbabMateri::class,
            'materi_id'
        )->orderBy('urutan');
    }
}
