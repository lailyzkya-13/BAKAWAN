<?php

namespace App\Http\Controllers;

use App\Models\ObjekAktivitas;

class AktivitasController extends Controller
{
    /**
     * Halaman daftar aktivitas.
     */
    public function index()
    {
        return view('aktivitas');
    }


    /**
     * Halaman Aktivitas 1
     * Klasifikasi Biotik dan Abiotik.
     */
    public function aktivitasSatu()
    {
        $objekAktivitas = ObjekAktivitas::where('aktif', true)
            ->get()
            ->shuffle();

        return view('aktivitas-satu', compact('objekAktivitas'));
    }
}