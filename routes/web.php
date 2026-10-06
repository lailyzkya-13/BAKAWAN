<?php

use App\Http\Controllers\KelolaGameController;
use App\Http\Controllers\KelolaKuisController;
use App\Http\Controllers\KelolaMateriGuruController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\hasilEvaluasiController;
use App\Http\Controllers\ProfilGuruController;


/* Route Awal */
Route::get('/', function () {
    return redirect()->route('beranda');
});


/* Halaman Siswa */
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');


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


Route::get('/materi-siswa', function () {
    return view('materi');
})->name('materi.siswa');


Route::get('/materi/biotik-abiotik', function () {
    return view('materi-biotik');
})->name('materi.biotik');


Route::get('/evaluasi', function () {
    return view('evaluasi');
})->name('evaluasi');


Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


Route::get('/login-guru', function () {
    return view('login-guru');
})->name('login.guru');



/* Halaman Guru / Dashboard */
Route::get('/dashboard', [
    DashboardGuruController::class,
    'index'
])->name('dashboard');


Route::get('/materi', [
    KelolaMateriGuruController::class,
    'index'
])->name('materi');


Route::get('/game', [
    KelolaGameController::class,
    'index'
])->name('game');


Route::get('/soal-kuis', [
    KelolaKuisController::class,
    'index'
])->name('soal.kuis');


Route::get('/hasil-evaluasi', [
    HasilEvaluasiController::class,
    'index'
])->name('hasil.evaluasi');


Route::get('/profil', [
    ProfilGuruController::class,
    'index'
])->name('profil');