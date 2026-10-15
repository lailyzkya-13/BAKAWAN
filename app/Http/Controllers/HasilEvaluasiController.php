<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\HasilKuis;

class HasilEvaluasiController extends Controller

{
    public function index()
    {
        // Mengambil semua nama siswa dari database
        $daftarSiswa = Siswa::orderBy('nama_lengkap')->get();

        // Mengambil seluruh hasil kuis, dari yang terbaru
        // Kemudian mengelompokkannya berdasarkan ID siswa
        $hasilPerSiswa = HasilKuis::orderByDesc('id')
            ->get()
            ->groupBy('siswa_id');

        // Mengirim data ke halaman Hasil Evaluasi Guru
        return view('evaluasi-guru', compact(
            'daftarSiswa',
            'hasilPerSiswa'
        ));
    }
}
