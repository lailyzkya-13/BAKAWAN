
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\KelolaGameController;
use App\Http\Controllers\KelolaKuisController;
use App\Http\Controllers\KelolaMateriGuruController;
use App\Http\Controllers\HasilEvaluasiController;
use App\Http\Controllers\ProfilGuruController;

use App\Models\Materi;


/* ROUTE AWAL */

Route::get('/', function () {
    return redirect()->route('beranda');
});


/* HALAMAN SISWA */

// Beranda Siswa
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');


// Aktivitas Siswa
Route::get('/aktivitas', [
    AktivitasController::class, 'index'
])->name('aktivitas');

Route::get('/aktivitas/klasifikasi-biotik-abiotik', [
    AktivitasController::class, 'aktivitasSatu'
])->name('aktivitas.satu');

Route::get('/aktivitas/hubungan-dalam-ekosistem', [
    AktivitasController::class, 'aktivitasDua'
])->name('aktivitas.dua');

Route::get('/aktivitas/mencocokkan', function () {
    return view('aktivitas.mencocokkan');
})->name('aktivitas.mencocokkan');



// MATERI SISWA

// Daftar Materi Siswa
Route::get('/materi-siswa', function () {

    $materi = Materi::latest()->get();

    return view('materi', compact('materi'));

})->name('materi.siswa');


// Detail Materi Siswa
Route::get('/materi-siswa/{materi}', function (Materi $materi) {

    $materi->load('subbab');

    return view('materi-detail-siswa', compact('materi'));

})->name('materi.siswa.show');


// Materi Biotik dan Abiotik Lama
Route::get('/materi/biotik-abiotik', function () {
    return view('materi-biotik');
})->name('materi.biotik');


// Evaluasi Siswa
Route::get('/evaluasi', function () {
    return view('evaluasi');
})->name('evaluasi');


// Tentang BAKAWAN
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


// Login Guru
Route::get('/login-guru', function () {
    return view('login-guru');
})->name('login.guru');


/* HALAMAN GURU */

// Dashboard Guru
Route::get('/dashboard', [
    DashboardGuruController::class, 'index'
])->name('dashboard');



// KELOLA MATERI GURU

// Daftar Materi
Route::get('/materi', [
    KelolaMateriGuruController::class, 'index'
])->name('materi');


// Form Tambah Materi
Route::get('/materi/tambah', [
    KelolaMateriGuruController::class, 'create'
])->name('materi.create');


// Simpan Materi Baru
Route::post('/materi', [
    KelolaMateriGuruController::class, 'store'
])->name('materi.store');


// Lihat Detail Materi Guru
Route::get('/materi/detail/{materi}', [
    KelolaMateriGuruController::class, 'show'
])->name('materi.show');


// Form Edit Materi
Route::get('/materi/{materi}/edit', [
    KelolaMateriGuruController::class, 'edit'
])->name('materi.edit');


// Simpan Perubahan Materi
Route::put('/materi/{materi}', [
    KelolaMateriGuruController::class, 'update'
])->name('materi.update');


// Hapus Materi
Route::delete('/materi/{materi}', [
    KelolaMateriGuruController::class, 'destroy'
])->name('materi.destroy');


// ==========================
// KELOLA GAME GURU
// ==========================

// Daftar Game
Route::get('/game', [
    KelolaGameController::class, 'index'
])->name('game');


// Tambah Game
Route::post('/game', [
    KelolaGameController::class, 'store'
])->name('game.store');


// Edit Game
Route::put('/game/{game}', [
    KelolaGameController::class, 'update'
])->name('game.update');


// Hapus Game
Route::delete('/game/{game}', [
    KelolaGameController::class, 'destroy'
])->name('game.destroy');


// Guru Mencoba Game
Route::get('/game/{game}/play', [
    KelolaGameController::class, 'play'
])->name('game.play');


/* FITUR GURU LAINNYA */

// Soal Kuis
Route::get('/soal-kuis', [
    KelolaKuisController::class, 'index'
])->name('soal.kuis');


// Hasil Evaluasi
Route::get('/hasil-evaluasi', [
    HasilEvaluasiController::class, 'index'
])->name('hasil.evaluasi');


// Profil Guru
Route::get('/profil', [
    ProfilGuruController::class, 'index'
])->name('profil');
