<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiToken extends Model
{
    protected $fillable = [
        'sekolah_id',
        'user_id',
        'kode',
        'aktif',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}