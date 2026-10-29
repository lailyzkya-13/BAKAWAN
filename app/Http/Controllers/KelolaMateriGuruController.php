<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class KelolaMateriGuruController extends Controller
{
    // ========================================
    // 1. MENAMPILKAN DAFTAR MATERI
    // ========================================

    public function index()
    {
        // Mengambil semua materi dari database
        $materi = Materi::latest()->get();

        // Menampilkan halaman guru
        return view('materi-guru', compact('materi'));
    }


    // ========================================
    // 2. MENAMPILKAN FORM TAMBAH MATERI
    // ========================================

    public function create()
    {
        return view('materi-form-guru', [
            'materi' => new Materi()
        ]);
    }


    // ========================================
    // 3. MENYIMPAN MATERI BARU
    // ========================================

    public function store(Request $request)
    {
        // Memeriksa data yang diisi guru
        $data = $this->validasi($request);

        // Gambar awal belum ada
        $gambar = null;

        // Jika guru mengunggah gambar
        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                ->store('materi', 'public');
        }

        // Menyimpan materi dan subbab
        DB::transaction(function () use ($data, $gambar) {

            // Simpan materi utama
            $materi = Materi::create([
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'] ?? null,
                'konten' => $data['subbab'][0]['isi'],
                'gambar' => $gambar,
                'durasi' => $data['durasi'] ?? null,
                'ringkasan' => $data['ringkasan'] ?? null,
            ]);

            // Simpan semua subbab
            $this->simpanSubbab(
                $materi,
                $data['subbab']
            );
        });

        // Kembali ke halaman daftar materi
        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil ditambahkan!');
    }


    // ========================================
    // 4. MELIHAT DETAIL MATERI
    // ========================================

    public function show(Materi $materi)
    {
        // Mengambil subbab secara berurutan
        $materi->load([
            'subbab' => function ($query) {
                $query->orderBy('urutan');
            }
        ]);

        return view(
            'materi-detail-guru',
            compact('materi')
        );
    }


    // ========================================
    // 5. MENAMPILKAN FORM EDIT
    // ========================================

    public function edit(Materi $materi)
    {
        // Memuat subbab untuk ditampilkan di form
        $materi->load([
            'subbab' => function ($query) {
                $query->orderBy('urutan');
            }
        ]);

        return view(
            'materi-form-guru',
            compact('materi')
        );
    }


    // ========================================
    // 6. MENYIMPAN PERUBAHAN MATERI
    // ========================================

    public function update(
        Request $request,
        Materi $materi
    ) {
        // Memeriksa data form
        $data = $this->validasi($request);

        // Simpan lokasi gambar lama
        $gambarLama = $materi->gambar;

        // Gunakan gambar lama terlebih dahulu
        $gambar = $gambarLama;

        // Penanda apakah guru mengunggah gambar baru
        $adaGambarBaru = $request->hasFile('gambar');

        // Jika ada gambar baru, simpan
        if ($adaGambarBaru) {

            $gambar = $request->file('gambar')
                ->store('materi', 'public');
        }

        // Simpan perubahan ke database
        DB::transaction(function () use ($materi, $data, $gambar) {

            // Perbarui materi utama
            $materi->update([
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'] ?? null,
                'konten' => $data['subbab'][0]['isi'],
                'gambar' => $gambar,
                'durasi' => $data['durasi'] ?? null,
                'ringkasan' => $data['ringkasan'] ?? null,
            ]);

            // Hapus data subbab lama
            $materi->subbab()->delete();

            // Simpan kembali subbab hasil edit
            $this->simpanSubbab(
                $materi,
                $data['subbab']
            );
        });

        // Hapus file gambar lama jika diganti
        if ($adaGambarBaru && $gambarLama) {

            Storage::disk('public')
                ->delete($gambarLama);
        }

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil diperbarui!');
    }


    // ========================================
    // 7. MENGHAPUS MATERI
    // ========================================

    public function destroy(Materi $materi)
    {
        // Menyimpan lokasi gambar
        $gambar = $materi->gambar;

        try {

            DB::transaction(function () use ($materi) {

                // Pertama: hapus soal kuis terkait
                DB::table('soal_kuis')
                    ->where('materi_id', $materi->id)
                    ->delete();

                // Kedua: hapus seluruh subbab
                $materi->subbab()->delete();

                // Ketiga: hapus materi utama
                $materi->delete();

            });

        } catch (QueryException $e) {

            // Mencatat kesalahan database
            report($e);

            // Menampilkan pesan kesalahan
            return redirect()
                ->route('materi')
                ->with(
                    'error',
                    'Materi gagal dihapus karena masih terhubung dengan data lain.'
                );
        }

        // Hapus gambar setelah database berhasil
        if ($gambar) {

            Storage::disk('public')
                ->delete($gambar);
        }

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil dihapus!');
    }


    // ========================================
    // 8. VALIDASI FORM MATERI
    // ========================================

    private function validasi(Request $request)
    {
        return $request->validate([

            // Informasi utama
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'nullable|string|max:100',
            'ringkasan' => 'nullable|string',

            // Gambar
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Daftar subbab
            'subbab' => 'required|array|min:1',

            // Informasi setiap subbab
            'subbab.*.judul' => 'required|string|max:255',
            'subbab.*.pengantar' => 'required|string',
            'subbab.*.isi' => 'required|string',
            'subbab.*.contoh' => 'nullable|string',

        ]);
    }


    // ========================================
    // 9. MENYIMPAN SELURUH SUBBAB
    // ========================================

    private function simpanSubbab(
        Materi $materi,
        array $daftarSubbab
    ) {
        // Mengulang setiap subbab
        foreach (array_values($daftarSubbab) as $index => $subbab) {

            // Simpan subbab melalui relasi materi
            $materi->subbab()->create([

                'judul' => $subbab['judul'],

                'pengantar' => $subbab['pengantar'],

                'isi' => $subbab['isi'],

                'contoh' => $subbab['contoh'] ?? null,

                // Urutan dimulai dari 1
                'urutan' => $index + 1,

            ]);
        }
    }
}
