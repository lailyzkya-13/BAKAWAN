<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\HasilKuis;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilEvaluasiController extends Controller
{
    // 1. MENAMPILKAN HASIL EVALUASI GURU
    public function index()
    {
        // Mengambil daftar siswa
        $daftarSiswa = Siswa::orderBy('nama_lengkap')->get();

        // Mengambil riwayat hasil kuis
        $hasilPerSiswa = HasilKuis::orderByDesc('id')
            ->get()
            ->groupBy('siswa_id');

        // Menampilkan halaman hasil evaluasi guru
        return view('evaluasi-guru', compact(
            'daftarSiswa',
            'hasilPerSiswa'
        ));
    }

    // 2. EXPORT HASIL EVALUASI KE PDF
    public function exportPdf()
    {
        // Mengambil daftar siswa
        $daftarSiswa = Siswa::orderBy('nama_lengkap')->get();

        // Mengambil riwayat hasil kuis
        $hasilPerSiswa = HasilKuis::orderByDesc('id')
            ->get()
            ->groupBy('siswa_id');

        // Membuat PDF dari view khusus

        $pdf = Pdf::loadView('export-pdf', [
            'daftarSiswa' => $daftarSiswa,
            'hasilPerSiswa' => $hasilPerSiswa,
        ]);


        // Menggunakan kertas A4 mendatar
        $pdf->setPaper('a4', 'landscape');

        // Mengunduh PDF
        return $pdf->download('hasil-evaluasi-bakawan.pdf');
    }
}
