<?php

namespace App\Http\Controllers;

use App\Models\ObjekAktivitas;
use App\Models\HubunganEkosistem;

class AktivitasController extends Controller
{
    // Menampilkan 3 aktivitas utama siswa
    public function index()
    {
        return view('aktivitas');
    }

    // AKTIVITAS 1
    // Klasifikasi Biotik dan Abiotik
    public function aktivitasSatu()
    {
        // Mengambil objek aktif dari database
        $objekAktivitas = ObjekAktivitas::where('aktif', true)
            ->get()
            ->shuffle();

        // Mengirim objek ke halaman siswa
        return view('aktivitas-satu', compact('objekAktivitas'));
    }

    // AKTIVITAS 2
    // Hubungan dalam Ekosistem
    public function aktivitasDua()
    {
        // Mengambil pasangan aktif dari database
        $hubunganEkosistem = HubunganEkosistem::where('aktif', true)
            ->get();

        // Mengacak posisi pasangan sebelah kanan
        $pasanganKanan = $hubunganEkosistem
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->objek_kanan,
                    'gambar' => $item->gambar_kanan,
                ];
            })
            ->shuffle()
            ->values();

        // Mengirim data ke halaman siswa
        return view(
            'aktivitas-dua',
            compact('hubunganEkosistem', 'pasanganKanan')
        );
    }

    // AKTIVITAS 3
    // Petualangan Si Bangau
    public function petualanganBangau()
    {
        return view('petualangan-bangau');
    }
}
