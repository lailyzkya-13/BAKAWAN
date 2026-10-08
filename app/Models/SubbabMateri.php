<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubbabMateri extends Model
{
    protected $table = 'subbab_materis';

    protected $fillable = [
        'materi_id',
        'judul',
        'isi',
        'urutan',
    ];
}
