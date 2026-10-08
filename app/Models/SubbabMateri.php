<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubbabMateri extends Model
{
    protected $table = 'subbab_materis';

    protected $fillable = [
        'materi_id',
        'judul',
        'pengantar',
        'isi',
        'contoh',
        'urutan',
    ];

    // Subbab merupakan bagian dari satu materi
    public function materi()
    {
        return $this->belongsTo(
            Materi::class,
            'materi_id'
        );
    }
}
