<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;
use App\Models\Siswa;

class DashboardGuruController extends Controller
{
    public function index()
    {
        // 1. Menghitung jumlah siswa terdaftar
        $jumlahMurid = Siswa::count();
        // Mengambil seluruh siswa yang terdaftar

        $daftarSiswa = Siswa::query()
            ->select('siswa.*')
            ->addSelect([
                'nilai_terakhir' => HasilKuis::query()
                    ->select('nilai')
                    ->whereColumn('hasil_kuis.siswa_id', 'siswa.id')
                    ->orderByDesc('hasil_kuis.created_at')
                    ->orderByDesc('hasil_kuis.id')
                    ->limit(1)
            ])
            ->orderBy('kelas')
            ->orderBy('nama_lengkap')
            ->get();


        // 2. Menghitung jumlah kelas yang berbeda
        $jumlahKelas = Siswa::query()
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->count('kelas');

        // 3. Menghitung rata-rata nilai seluruh hasil kuis
        $rataRataNilai = HasilKuis::avg('nilai');


        // 5. Menghitung rata-rata nilai masing-masing kelas
        $rekapNilaiPerKelas = Siswa::query()
            ->leftJoin('hasil_kuis', 'siswa.id', '=', 'hasil_kuis.siswa_id')
            ->whereNotNull('siswa.kelas')
            ->where('siswa.kelas', '!=', '')
            ->select('siswa.kelas')
            ->selectRaw('AVG(hasil_kuis.nilai) AS rata_rata_nilai')
            ->selectRaw('COUNT(DISTINCT siswa.id) AS jumlah_murid')
            ->groupBy('siswa.kelas')
            ->orderBy('siswa.kelas')
            ->get();

        // 6. Mengirim data database ke halaman dashboard
        return view('dashboard-guru', compact(
            'jumlahMurid',
            'jumlahKelas',
            'rataRataNilai',
            'rekapNilaiPerKelas',
            'daftarSiswa'
        ));

    }
}
