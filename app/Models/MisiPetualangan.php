<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiPetualangan extends Model
{
    protected $table = 'misi_petualangan';

    protected $fillable = [
        'nama',
        'tutorial',
        'fakta',
        'urutan',
        'background_index',
        'platform_layout',
        'aktif',
    ];

    protected $casts = [
        'urutan' => 'integer',
        'background_index' => 'integer',
        'platform_layout' => 'integer',
        'aktif' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(
            ItemPetualangan::class,
            'misi_petualangan_id'
        )->orderBy('urutan');
    }
}
