<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekAktivitas extends Model
{
    use HasFactory;

    protected $table = 'objek_aktivitas';

    protected $fillable = [
        'nama_objek',
        'gambar',
        'kategori',
        'penjelasan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}