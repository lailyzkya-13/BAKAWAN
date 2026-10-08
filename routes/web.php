
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\KelolaGameController;
use App\Http\Controllers\KelolaKuisController;
use App\Http\Controllers\KelolaMateriGuruController;
use App\Http\Controllers\HasilEvaluasiController;
use App\Http\Controllers\ProfilGuruController;


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


// Materi Siswa
Route::get('/materi-siswa', function () {
    return view('materi');
})->name('materi.siswa');


// Detail Materi Biotik dan Abiotik Siswa
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

// Tambah Materi
Route::post('/materi', [
    KelolaMateriGuruController::class, 'store'
])->name('materi.store');

// Detail Materi
Route::get('/materi/detail/{materi}', [
    KelolaMateriGuruController::class, 'show'
])->name('materi.show');



// KELOLA GAME GURU

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




// FITUR GURU LAINNYA

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
