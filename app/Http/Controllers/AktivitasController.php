<?php

namespace App\Http\Controllers;

use App\Models\ObjekAktivitas;
use App\Models\HubunganEkosistem;

class AktivitasController extends Controller
{
    public function index()
    {
        return view('aktivitas');
    }

    public function aktivitasSatu()
    {
        $objekAktivitas = ObjekAktivitas::where('aktif', true)
            ->get()
            ->shuffle();

        return view('aktivitas-satu', compact('objekAktivitas'));
    }

    public function aktivitasDua()
    {
        $hubunganEkosistem = HubunganEkosistem::where('aktif', true)
            ->get();

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

        return view(
            'aktivitas-dua',
            compact('hubunganEkosistem', 'pasanganKanan')
        );
    }
}