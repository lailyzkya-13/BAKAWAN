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

        // 2. Menghitung jumlah kelas yang berbeda
        $jumlahKelas = Siswa::query()
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->count('kelas');

        // 3. Menghitung rata-rata nilai seluruh hasil kuis
        $rataRataNilai = HasilKuis::avg('nilai');

        // 4. Mengambil lima aktivitas kuis terbaru
        $aktivitasTerbaru = HasilKuis::query()
            ->join('siswa', 'hasil_kuis.siswa_id', '=', 'siswa.id')
            ->select(
                'hasil_kuis.id',
                'hasil_kuis.nilai',
                'hasil_kuis.created_at',
                'siswa.nama_lengkap',
                'siswa.kelas'
            )
            ->orderByDesc('hasil_kuis.created_at')
            ->orderByDesc('hasil_kuis.id')
            ->limit(5)
            ->get();

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
            'aktivitasTerbaru',
            'rekapNilaiPerKelas'
        ));
    }
}
