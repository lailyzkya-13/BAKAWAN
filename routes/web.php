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
use App\Http\Controllers\AuthGuruController;

use App\Models\SoalKuis;
use Illuminate\Validation\Rule;


use App\Models\Materi;
use App\Models\Siswa;
use App\Models\HasilKuis;


/* ==========================================
   HALAMAN UTAMA
========================================== */

Route::get('/', function () {
    return redirect()->route('beranda');
});


/* ==========================================
   HALAMAN SISWA
========================================== */

// Beranda Siswa
Route::get('/beranda', function () {

    // Mengambil materi dengan ID 7 dari database
    $materiBiotik = Materi::find(7);

    // Mengirim data ke halaman Beranda Siswa
    return view('beranda', compact('materiBiotik'));

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

Route::get(
    '/aktivitas/petualangan-bangau',
    [AktivitasController::class, 'petualanganBangau']
)->name('aktivitas.bangau');


// ==========================================
// MATERI
// ==========================================


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

    // Mengambil semua materi dari database
    $materi = Materi::latest()->get();

    // Mengirim data ke halaman siswa
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

    return view('materi-biotik', compact(
        'materi',
        'semuaSubbab',
        'subbabAktif',
        'sebelumnya',
        'selanjutnya'
    ));


})->name('materi.siswa.show');



/* MATERI BIOTIK DARI DATABASE */

Route::get('/materi/biotik-abiotik', function () {

    // Mencari materi yang tersimpan di database
    $materi = Materi::where(
        'judul',
        'Komponen Biotik dan Abiotik'
    )->firstOrFail();

    // Membuka halaman detail materi siswa
    return redirect()->route(
        'materi.siswa.show',
        $materi
    );

})->name('materi.biotik');



/* ==========================================
   EVALUASI SISWA
========================================== */

// Halaman Identitas Siswa
Route::get('/evaluasi', function () {

    return view('evaluasi');

})->name('evaluasi');


// Memulai Evaluasi
Route::post('/evaluasi/mulai', function (Request $request) {

    // 1. Memeriksa nama dan kelas siswa
    $data = $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'kelas' => 'required|string|max:30',
    ], [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
        'kelas.required' => 'Kelas wajib diisi.',
    ]);

    // 2. Menyimpan data siswa ke database
    $siswa = Siswa::firstOrCreate([
        'nama_lengkap' => $data['nama_lengkap'],
        'kelas' => $data['kelas'],
    ]);

    // 3. Menyimpan identitas siswa ke session
    session([
        'evaluasi_siswa_id' => $siswa->id,
        'evaluasi_nama' => $siswa->nama_lengkap,
        'evaluasi_kelas' => $siswa->kelas,
    ]);

    // 4. Mengarahkan siswa ke halaman petunjuk
    return redirect()->route('evaluasi.petunjuk');

})->name('evaluasi.mulai');


/* ==========================================
   MENYIMPAN HASIL EVALUASI SISWA
========================================== */


// ==========================================
// MENYIMPAN HASIL EVALUASI SISWA
// ==========================================

Route::post('/evaluasi/simpan', function (Request $request) {

    // 1. Memeriksa identitas siswa
    $siswaId = session('evaluasi_siswa_id');

    if (!$siswaId || !Siswa::whereKey($siswaId)->exists()) {

        return response()->json([
            'message' => 'Identitas siswa tidak ditemukan.'
        ], 401);
    }

    // 2. Mengambil ID soal yang diberikan kepada siswa
    $idsSoal = session('evaluasi_daftar_soal_ids', []);

    if (empty($idsSoal)) {

        return response()->json([
            'message' => 'Daftar soal evaluasi tidak ditemukan.'
        ], 422);
    }

    $jumlahSoal = count($idsSoal);

    // 3. Validasi jawaban secara dinamis
    $data = $request->validate([

        'jawaban' => [
            'required',
            'array',
            'size:' . $jumlahSoal
        ],

        'jawaban.*.id' => [
            'required',
            'integer',
            'distinct',
            Rule::in($idsSoal)
        ],

        'jawaban.*.pilihan' => [
            'nullable',
            'string',
            'max:255'
        ],

    ]);

    // 4. Memastikan semua soal dijawab sesuai daftar
    $idDikirim = array_map(
        'intval',
        array_column($data['jawaban'], 'id')
    );

    $idSeharusnya = array_map('intval', $idsSoal);

    sort($idDikirim);
    sort($idSeharusnya);

    if ($idDikirim !== $idSeharusnya) {

        return response()->json([
            'message' => 'Daftar jawaban tidak sesuai.'
        ], 422);
    }

    // 5. Mengambil soal dari database
    $daftarSoal = SoalKuis::whereIn('id', $idsSoal)
        ->get()
        ->keyBy('id');

    if ($daftarSoal->count() !== $jumlahSoal) {

        return response()->json([
            'message' => 'Ada soal yang sudah tidak tersedia.'
        ], 422);
    }

    // 6. Menghitung jawaban benar
    $jumlahBenar = 0;

    foreach ($data['jawaban'] as $jawaban) {

        $soal = $daftarSoal->get(
            (int) $jawaban['id']
        );

        $kolomJawabanBenar = 'pilihan_' .
            strtolower($soal->jawaban_benar);

        if (
            !in_array($kolomJawabanBenar, [
                'pilihan_a',
                'pilihan_b',
                'pilihan_c',
                'pilihan_d'
            ], true)
        ) {
            continue;
        }

        $jawabanBenar = $soal->{$kolomJawabanBenar};

        $jawabanSiswa = $jawaban['pilihan'] ?? null;

        if (
            $jawabanSiswa !== null &&
            $jawabanSiswa === $jawabanBenar
        ) {
            $jumlahBenar++;
        }
    }

    // 7. Menghitung nilai
    $nilai = round(
        ($jumlahBenar / $jumlahSoal) * 100
    );

    // 8. Menyimpan hasil ke database
    $hasil = HasilKuis::create([

        'siswa_id' => $siswaId,
        'jumlah_benar' => $jumlahBenar,
        'jumlah_soal' => $jumlahSoal,
        'nilai' => $nilai

    ]);

    // 9. Menyimpan ID hasil ke session
    session([
        'evaluasi_hasil_id' => $hasil->id
    ]);

    // 10. Mengirim hasil ke JavaScript
    return response()->json([

        'nilai' => $hasil->nilai,
        'jumlahBenar' => $hasil->jumlah_benar,
        'jumlahSoal' => $hasil->jumlah_soal

    ]);

})->name('evaluasi.simpan');



/* ==========================================
   HALAMAN EVALUASI SISWA
========================================== */

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

// ==========================================
// SOAL EVALUASI SISWA
// ==========================================


// ==========================================
// MENAMPILKAN SOAL EVALUASI SISWA
// ==========================================

Route::get('/evaluasi/soal', function () {

    // Mengambil semua soal dari database
    $daftarSoal = \App\Models\SoalKuis::orderBy('id', 'asc')
        ->get();

    // Memeriksa apakah soal tersedia
    if ($daftarSoal->isEmpty()) {
        return redirect()
            ->route('evaluasi')
            ->with('error', 'Belum ada soal evaluasi.');
    }

    // Menyimpan daftar ID soal untuk proses penilaian
    session([
        'evaluasi_daftar_soal_ids' => $daftarSoal->pluck('id')->all()
    ]);

    // Mengirim data soal ke halaman siswa
    return view('evaluasi-soal', compact('daftarSoal'));

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

// Menampilkan halaman login guru
Route::get('/login-guru', [
    AuthGuruController::class,
    'showLogin'
])->name('login.guru');

// Memproses login guru
Route::post('/login-guru', [
    AuthGuruController::class,
    'login'
])->name('login.guru.proses');

// Logout guru
Route::post('/logout-guru', [
    AuthGuruController::class,
    'logout'
])->middleware('auth')->name('logout.guru');


// Dashboard Guru - Wajib Login
Route::get('/dashboard', [
    DashboardGuruController::class,
    'index'
])->middleware('auth')->name('dashboard');


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

// Menampilkan halaman hasil evaluasi guru
Route::get('/hasil-evaluasi', [
    HasilEvaluasiController::class,
    'index'
])->name('hasil-evaluasi');


// Menampilkan halaman pengelolaan evaluasi
Route::get('/hasil-evaluasi/kelola', [
    HasilEvaluasiController::class,
    'index'
])->name('hasil.evaluasi');


// Mengekspor hasil evaluasi siswa ke PDF
Route::get('/hasil-evaluasi/export/pdf', [
    HasilEvaluasiController::class,
    'exportPdf'
])->name('hasil.evaluasi.pdf');


// Export Excel Hasil Evaluasi
Route::get('/hasil-evaluasi/export/excel', [
    HasilEvaluasiController::class,
    'exportExcel'
])->name('hasil.evaluasi.excel');



/* ==========================================
   PROFIL GURU
========================================== */

// READ - Menampilkan profil
Route::get('/profil', [
    ProfilGuruController::class,
    'index'
])->name('profil');

// CREATE - Menyimpan profil
Route::post('/profil', [
    ProfilGuruController::class,
    'store'
])->name('profil.store');

// UPDATE - Mengubah profil
Route::put('/profil', [
    ProfilGuruController::class,
    'update'
])->name('profil.update');

// DELETE - Menghapus profil
Route::delete('/profil', [
    ProfilGuruController::class,
    'destroy'
])->name('profil.destroy');

