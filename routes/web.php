
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
// Beranda
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');


// Aktivitas
Route::get('/aktivitas', [
    AktivitasController::class,
    'index'
])->name('aktivitas');

Route::get('/aktivitas/klasifikasi-biotik-abiotik', [
    AktivitasController::class,
    'aktivitasSatu'
])->name('aktivitas.satu');

Route::get('/aktivitas/hubungan-dalam-ekosistem', [
    AktivitasController::class,
    'aktivitasDua'
])->name('aktivitas.dua');

Route::get('/aktivitas/mencocokkan', function () {
    return view('aktivitas.mencocokkan');
})->name('aktivitas.mencocokkan');


// Materi Siswa
Route::get('/materi-siswa', function () {
    $materi = Materi::latest()->get();

    return view('materi', compact('materi'));
})->name('materi.siswa');


// Materi Biotik dan Abiotik
Route::get('/materi/biotik-abiotik', function () {
    return view('materi-biotik');
})->name('materi.biotik');


// Evaluasi
Route::get('/evaluasi', function () {
    return view('evaluasi');
})->name('evaluasi');


// Tentang
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
    DashboardGuruController::class,
    'index'
])->name('dashboard');


// Kelola Materi Guru
Route::get('/materi', [
    KelolaMateriGuruController::class,
    'index'
])->name('materi');


// Simpan Materi Baru
Route::post('/materi', [
    KelolaMateriGuruController::class,
    'store'
])->name('materi.store');


// Lihat Detail Materi
Route::get('/materi/detail/{materi}', [
    KelolaMateriGuruController::class,
    'show'
])->name('materi.show');


// Kelola Game
Route::get('/game', [
    KelolaGameController::class,
    'index'
])->name('game');


// Kelola Soal Kuis
Route::get('/soal-kuis', [
    KelolaKuisController::class,
    'index'
])->name('soal.kuis');


// Hasil Evaluasi
Route::get('/hasil-evaluasi', [
    HasilEvaluasiController::class,
    'index'
])->name('hasil.evaluasi');


// Profil Guru
Route::get('/profil', [
    ProfilGuruController::class,
    'index'
])->name('profil');



/* KELOLA GAME GURU */

// Menampilkan semua game
Route::get('/game', [
    KelolaGameController::class, 'index'
])->name('game');

// Menyimpan game baru
Route::post('/game', [
    KelolaGameController::class, 'store'
])->name('game.store');

// Mengubah game
Route::put('/game/{game}', [
    KelolaGameController::class, 'update'
])->name('game.update');

// Menghapus game
Route::delete('/game/{game}', [
    KelolaGameController::class, 'destroy'
])->name('game.destroy');

// Memainkan game
Route::get('/game/{game}/play', [
    KelolaGameController::class, 'play'
])->name('game.play');
