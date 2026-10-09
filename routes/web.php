
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

// BERANDA SISWA

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');



// AKTIVITAS SISWA

// Daftar Aktivitas
Route::get('/aktivitas', [
    AktivitasController::class, 'index'
])->name('aktivitas');


// Aktivitas 1
Route::get('/aktivitas/klasifikasi-biotik-abiotik', [
    AktivitasController::class, 'aktivitasSatu'
])->name('aktivitas.satu');


// Aktivitas 2
Route::get('/aktivitas/hubungan-dalam-ekosistem', [
    AktivitasController::class, 'aktivitasDua'
])->name('aktivitas.dua');


// Aktivitas Mencocokkan
Route::get('/aktivitas/mencocokkan', function () {
    return view('aktivitas.mencocokkan');
})->name('aktivitas.mencocokkan');



/* MATERI SISWA */

// DAFTAR MATERI SISWA

Route::get('/materi-siswa', function () {

    // Mengambil semua materi dari database
    $materi = Materi::latest()->get();

    // Menampilkan kartu materi siswa
    return view('materi', compact('materi'));

})->name('materi.siswa');


// DETAIL MATERI SISWA

Route::get('/materi-siswa/{materi}', function (Materi $materi) {

    // Mengambil seluruh subbab dari materi
    $materi->load('subbab');

    $semuaSubbab = $materi->subbab;

    // Mengambil ID subbab yang dipilih siswa
    $idSubbab = request()->query('subbab');

    // Jika belum memilih, tampilkan subbab pertama
    $subbabAktif = $semuaSubbab->first();

    // Jika siswa mengklik salah satu subbab
    if ($idSubbab !== null) {

        $subbabAktif = $semuaSubbab->first(function ($item) use ($idSubbab) {

            return (string) $item->id === (string) $idSubbab;

        });

        // Jika subbab tidak ditemukan
        if (!$subbabAktif) {
            abort(404);
        }
    }

    // Mencari posisi subbab yang sedang dibaca
    $posisi = $subbabAktif
        ? $semuaSubbab->search(function ($item) use ($subbabAktif) {

            return $item->id === $subbabAktif->id;

        })
        : false;

    // Menentukan subbab sebelumnya
    $sebelumnya = $posisi !== false && $posisi > 0
        ? $semuaSubbab->get($posisi - 1)
        : null;

    // Menentukan subbab selanjutnya
    $selanjutnya = $posisi !== false
        ? $semuaSubbab->get($posisi + 1)
        : null;

    // Mengirim seluruh data ke halaman siswa
    return view('materi-detail-siswa', compact(
        'materi',
        'semuaSubbab',
        'subbabAktif',
        'sebelumnya',
        'selanjutnya'
    ));

})->name('materi.siswa.show');


// MATERI BIOTIK LAMA

// Tetap dipertahankan agar route lama tidak error
Route::get('/materi/biotik-abiotik', function () {

    return view('materi-biotik');

})->name('materi.biotik');



// EVALUASI SISWA
Route::get('/evaluasi', function () {

    return view('evaluasi');

})->name('evaluasi');



// TENTANG BAKAWAN
Route::get('/tentang', function () {

    return view('tentang');

})->name('tentang');



// LOGIN GURU
Route::get('/login-guru', function () {

    return view('login-guru');

})->name('login.guru');



/* HALAMAN GURU */

// DASHBOARD GURU
Route::get('/dashboard', [
    DashboardGuruController::class, 'index'
])->name('dashboard');



/* CRUD MATERI GURU */

// 1. Menampilkan daftar materi
Route::get('/materi', [
    KelolaMateriGuruController::class, 'index'
])->name('materi');


// 2. Membuka form tambah materi
Route::get('/materi/tambah', [
    KelolaMateriGuruController::class, 'create'
])->name('materi.create');


// 3. Menyimpan materi baru
Route::post('/materi', [
    KelolaMateriGuruController::class, 'store'
])->name('materi.store');


// 4. Melihat detail materi guru
Route::get('/materi/detail/{materi}', [
    KelolaMateriGuruController::class, 'show'
])->name('materi.show');


// 5. Membuka form edit materi
Route::get('/materi/{materi}/edit', [
    KelolaMateriGuruController::class, 'edit'
])->name('materi.edit');


// 6. Menyimpan perubahan materi
Route::put('/materi/{materi}', [
    KelolaMateriGuruController::class, 'update'
])->name('materi.update');


// 7. Menghapus materi
Route::delete('/materi/{materi}', [
    KelolaMateriGuruController::class, 'destroy'
])->name('materi.destroy');



/* KELOLA GAME GURU */

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


// SOAL KUIS

/* =====================================
   CRUD SOAL KUIS GURU
===================================== */

// Menampilkan daftar soal
Route::get('/soal-kuis', [
    KelolaKuisController::class, 'index'
])->name('soal.kuis');


// Menyimpan soal baru
Route::post('/soal-kuis', [
    KelolaKuisController::class, 'store'
])->name('soal.kuis.store');


// Memperbarui soal
Route::put('/soal-kuis/{soalKuis}', [
    KelolaKuisController::class, 'update'
])->name('soal.kuis.update');


// Menghapus soal
Route::delete('/soal-kuis/{soalKuis}', [
    KelolaKuisController::class, 'destroy'
])->name('soal.kuis.destroy');




// HASIL EVALUASI
Route::get('/hasil-evaluasi', [
    HasilEvaluasiController::class, 'index'
])->name('hasil.evaluasi');



// PROFIL GURU
Route::get('/profil', [
    ProfilGuruController::class, 'index'
])->name('profil');
