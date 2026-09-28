<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AktivitasController;


/*
|--------------------------------------------------------------------------
| BERANDA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');


/*
|--------------------------------------------------------------------------
| AKTIVITAS
|--------------------------------------------------------------------------
*/

Route::get(
    '/aktivitas',
    [AktivitasController::class, 'index']
)->name('aktivitas');


Route::get(
    '/aktivitas/klasifikasi-biotik-abiotik',
    [AktivitasController::class, 'aktivitasSatu']
)->name('aktivitas.satu');


/*
|--------------------------------------------------------------------------
| MATERI
|--------------------------------------------------------------------------
*/

Route::get('/materi', function () {
    return view('materi');
})->name('materi');


Route::get('/materi/biotik-abiotik', function () {
    return view('materi-biotik');
})->name('materi.biotik');


/*
|--------------------------------------------------------------------------
| EVALUASI
|--------------------------------------------------------------------------
*/

Route::get('/evaluasi', function () {
    return view('evaluasi');
})->name('evaluasi');


/*
|--------------------------------------------------------------------------
| TENTANG
|--------------------------------------------------------------------------
*/

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


/*
|--------------------------------------------------------------------------
| LOGIN GURU
|--------------------------------------------------------------------------
*/

Route::get('/login-guru', function () {
    return view('login-guru');
})->name('login.guru');