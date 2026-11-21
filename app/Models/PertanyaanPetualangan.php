<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanPetualangan extends Model
{
    protected $table = 'pertanyaan_petualangan';

    protected $fillable = [
        'item_petualangan_id',
        'pertanyaan',
        'pilihan_jawaban',
        'jawaban_benar',
        'penjelasan',
    ];

    protected $casts = [
        'pilihan_jawaban' => 'array',
        'jawaban_benar' => 'integer',
    ];

    public function item()
    {
        return $this->belongsTo(
            ItemPetualangan::class,
            'item_petualangan_id'
        );
    }
}
