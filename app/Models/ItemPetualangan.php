<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPetualangan extends Model
{
    protected $table = 'item_petualangan';

    protected $fillable = [
        'misi_petualangan_id',
        'kode',
        'jenis',
        'label',
        'asset_key',
        'posisi_x',
        'posisi_y',
        'poin',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'posisi_x' => 'integer',
        'posisi_y' => 'integer',
        'poin' => 'integer',
        'urutan' => 'integer',
        'aktif' => 'boolean',
    ];

    public function misi()
    {
        return $this->belongsTo(
            MisiPetualangan::class,
            'misi_petualangan_id'
        );
    }

    public function pertanyaan()
    {
        return $this->hasOne(
            PertanyaanPetualangan::class,
            'item_petualangan_id'
        );
    }
}
