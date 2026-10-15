<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\KelolaGameController;
use App\Http\Controllers\KelolaKuisController;
use App\Http\Controllers\KelolaMateriGuruController;
use App\Http\Controllers\HasilEvaluasiController;
use App\Http\Controllers\ProfilGuruController;

use App\Models\Materi;


/* ==========================================
   HALAMAN UTAMA
========================================== */

Route::get('/', function () {
    return redirect()->route('beranda');
});


/* ==========================================
   HALAMAN SISWA
========================================== */

// BERANDA SISWA
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');


/* ==========================================
   AKTIVITAS SISWA
========================================== */

// Daftar Aktivitas
Route::get('/aktivitas', [
    AktivitasController::class,
    'index'
])->name('aktivitas');


// Aktivitas 1
Route::get('/aktivitas/klasifikasi-biotik-abiotik', [
    AktivitasController::class,
    'aktivitasSatu'
])->name('aktivitas.satu');


// Aktivitas 2
Route::get('/aktivitas/hubungan-dalam-ekosistem', [
    AktivitasController::class,
    'aktivitasDua'
])->name('aktivitas.dua');


// Aktivitas Mencocokkan
Route::get('/aktivitas/mencocokkan', function () {
    return view('aktivitas.mencocokkan');
})->name('aktivitas.mencocokkan');


/* ==========================================
   MATERI SISWA
========================================== */

// Daftar Materi Siswa
Route::get('/materi-siswa', function () {

    $materi = Materi::latest()->get();

    return view('materi', compact('materi'));

})->name('materi.siswa');


// Detail Materi Siswa
Route::get('/materi-siswa/{materi}', function (Materi $materi) {

    // Mengambil seluruh subbab dari materi
    $materi->load('subbab');

    $semuaSubbab = $materi->subbab;

    // Mengambil ID subbab yang dipilih siswa
    $idSubbab = request()->query('subbab');

    // Menampilkan subbab pertama
    $subbabAktif = $semuaSubbab->first();

    // Jika siswa memilih subbab tertentu
    if ($idSubbab !== null) {

        $subbabAktif = $semuaSubbab->first(function ($item) use ($idSubbab) {

            return (string) $item->id === (string) $idSubbab;

        });

        if (!$subbabAktif) {
            abort(404);
        }
    }

    // Mencari posisi subbab aktif
    $posisi = $subbabAktif
        ? $semuaSubbab->search(function ($item) use ($subbabAktif) {

            return $item->id === $subbabAktif->id;

        })
        : false;

    // Subbab sebelumnya
    $sebelumnya = $posisi !== false && $posisi > 0
        ? $semuaSubbab->get($posisi - 1)
        : null;

    // Subbab selanjutnya
    $selanjutnya = $posisi !== false
        ? $semuaSubbab->get($posisi + 1)
        : null;

    // Menampilkan detail materi siswa
    return view('materi-detail-siswa', compact(
        'materi',
        'semuaSubbab',
        'subbabAktif',
        'sebelumnya',
        'selanjutnya'
    ));

})->name('materi.siswa.show');


// Materi Biotik Lama
Route::get('/materi/biotik-abiotik', function () {

    return view('materi-biotik');

})->name('materi.biotik');


/* ==========================================
   EVALUASI SISWA
========================================== */

// Halaman Identitas
Route::get('/evaluasi', function () {

    return view('evaluasi');

})->name('evaluasi');


// Memulai Evaluasi
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


// Petunjuk Evaluasi
Route::get('/evaluasi/petunjuk', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-petunjuk');

})->name('evaluasi.petunjuk');


// Soal Evaluasi
Route::get('/evaluasi/soal', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-soal');

})->name('evaluasi.soal');


// Hasil Evaluasi Siswa
Route::get('/evaluasi/hasil', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-hasil');

})->name('evaluasi.hasil');


// Pembahasan Evaluasi Siswa
Route::get('/evaluasi/pembahasan', function () {

    if (
        !session()->has('evaluasi_nama') ||
        !session()->has('evaluasi_kelas')
    ) {
        return redirect()->route('evaluasi');
    }

    return view('evaluasi-pembahasan');

})->name('evaluasi.pembahasan');


/* ==========================================
   TENTANG BAKAWAN
========================================== */

Route::get('/tentang', function () {

    return view('tentang');

})->name('tentang');


/* ==========================================
   HALAMAN GURU
========================================== */

// Login Guru
Route::get('/login-guru', function () {

    return view('login-guru');

})->name('login.guru');


// Dashboard Guru
Route::get('/dashboard', [
    DashboardGuruController::class,
    'index'
])->name('dashboard');


/* ==========================================
   CRUD MATERI GURU
========================================== */

// Daftar Materi
Route::get('/materi', [
    KelolaMateriGuruController::class,
    'index'
])->name('materi');


// Tambah Materi
Route::get('/materi/tambah', [
    KelolaMateriGuruController::class,
    'create'
])->name('materi.create');


// Simpan Materi
Route::post('/materi', [
    KelolaMateriGuruController::class,
    'store'
])->name('materi.store');


// Detail Materi
Route::get('/materi/detail/{materi}', [
    KelolaMateriGuruController::class,
    'show'
])->name('materi.show');


// Edit Materi
Route::get('/materi/{materi}/edit', [
    KelolaMateriGuruController::class,
    'edit'
])->name('materi.edit');


// Update Materi
Route::put('/materi/{materi}', [
    KelolaMateriGuruController::class,
    'update'
])->name('materi.update');


// Hapus Materi
Route::delete('/materi/{materi}', [
    KelolaMateriGuruController::class,
    'destroy'
])->name('materi.destroy');


/* ==========================================
   KELOLA GAME GURU
========================================== */

// Daftar Game
Route::get('/game', [
    KelolaGameController::class,
    'index'
])->name('game');


// Tambah Game
Route::post('/game', [
    KelolaGameController::class,
    'store'
])->name('game.store');


// Update Game
Route::put('/game/{game}', [
    KelolaGameController::class,
    'update'
])->name('game.update');


// Hapus Game
Route::delete('/game/{game}', [
    KelolaGameController::class,
    'destroy'
])->name('game.destroy');


// Mainkan Game
Route::get('/game/{game}/play', [
    KelolaGameController::class,
    'play'
])->name('game.play');


/* ==========================================
   CRUD SOAL KUIS GURU
========================================== */

// Daftar Soal
Route::get('/soal-kuis', [
    KelolaKuisController::class,
    'index'
])->name('soal.kuis');


// Tambah Soal
Route::post('/soal-kuis', [
    KelolaKuisController::class,
    'store'
])->name('soal.kuis.store');


// Update Soal
Route::put('/soal-kuis/{soalKuis}', [
    KelolaKuisController::class,
    'update'
])->name('soal.kuis.update');


// Hapus Soal
Route::delete('/soal-kuis/{soalKuis}', [
    KelolaKuisController::class,
    'destroy'
])->name('soal.kuis.destroy');


/* ==========================================
   HASIL EVALUASI GURU
========================================== */

// Halaman Hasil Evaluasi Guru
Route::get('/hasil-evaluasi', function () {

    return view('evaluasi-guru');

})->name('hasil-evaluasi');


// Hasil Evaluasi Melalui Controller
Route::get('/hasil-evaluasi/kelola', [
    HasilEvaluasiController::class,
    'index'
])->name('hasil.evaluasi');


/* ==========================================
   PROFIL GURU
========================================== */

Route::get('/profil', function () {

    return view('profil-guru');

})->name('profil');