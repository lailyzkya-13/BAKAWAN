
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AktivitasController;

// ==========================================
// HALAMAN UTAMA
// ==========================================

Route::get('/', function () {
    return redirect()->route('beranda');
});

// ==========================================
// BERANDA
// ==========================================

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

// ==========================================
// AKTIVITAS
// ==========================================

Route::get(
    '/aktivitas',
    [AktivitasController::class, 'index']
)->name('aktivitas');

Route::get(
    '/aktivitas/klasifikasi-biotik-abiotik',
    [AktivitasController::class, 'aktivitasSatu']
)->name('aktivitas.satu');

Route::get(
    '/aktivitas/hubungan-dalam-ekosistem',
    [AktivitasController::class, 'aktivitasDua']
)->name('aktivitas.dua');

// ==========================================
// MATERI
// ==========================================

Route::get('/materi', function () {
    return view('materi');
})->name('materi');

Route::get('/materi/biotik-abiotik', function () {
    return view('materi-biotik');
})->name('materi.biotik');

// ==========================================
// EVALUASI
// ==========================================

// Form identitas
Route::get('/evaluasi', function () {
    return view('evaluasi');
})->name('evaluasi');

// Memulai evaluasi
Route::post('/evaluasi/mulai', function (Request $request) {

    $data = $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'kelas' => 'required|string|max:30',
    ], [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
        'kelas.required' => 'Kelas wajib diisi.',
    ]);

    session([
        'evaluasi_nama' => $data['nama_lengkap'],
        'evaluasi_kelas' => $data['kelas'],
    ]);

    return redirect()->route('evaluasi.petunjuk');

})->name('evaluasi.mulai');

// Petunjuk evaluasi
Route::get('/evaluasi/petunjuk', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-petunjuk');

})->name('evaluasi.petunjuk');

// Soal evaluasi
Route::get('/evaluasi/soal', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-soal');

})->name('evaluasi.soal');

// Hasil evaluasi
Route::get('/evaluasi/hasil', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-hasil');

})->name('evaluasi.hasil');

// Pembahasan evaluasi
Route::get('/evaluasi/pembahasan', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-pembahasan');

})->name('evaluasi.pembahasan');

// ==========================================
// TENTANG
// ==========================================

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// ==========================================
// LOGIN GURU
// ==========================================

Route::get('/login-guru', function () {
    return view('login-guru');
})->name('login.guru');