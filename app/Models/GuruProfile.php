<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruProfile extends Model
{
    protected $fillable = [
        'user_id',
        'sekolah_id',
        'nip_nuptk',
        'sekolah',
        'mata_pelajaran',
        'kelas',
    ];

    // Menghubungkan profil dengan akun guru
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Menghubungkan guru dengan sekolah
    public function sekolahData()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}