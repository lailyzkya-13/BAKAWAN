<?php

namespace App\Http\Controllers;

use App\Models\Materi;

class KelolaKuisController extends Controller
{
    public function index()
    {
        // Mengambil seluruh materi dari database
        $daftarMateri = Materi::orderBy('judul')->get();

        // Mengirim data materi ke halaman soal kuis
        return view('kuis-guru', compact('daftarMateri'));
    }
}
