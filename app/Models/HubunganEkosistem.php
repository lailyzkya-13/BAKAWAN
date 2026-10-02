<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganEkosistem extends Model
{
    use HasFactory;

    protected $table = 'hubungan_ekosistem';

    protected $fillable = [
        'objek_kiri',
        'gambar_kiri',
        'objek_kanan',
        'gambar_kanan',
        'hubungan',
        'clue',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}