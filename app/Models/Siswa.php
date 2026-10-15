<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // Nama tabel di database
    protected $table = 'siswa';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_lengkap',
        'kelas'
    ];
}
