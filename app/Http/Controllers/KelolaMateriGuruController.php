<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelolaMateriGuruController extends Controller
{
    // 1. MENAMPILKAN DAFTAR MATERI
    public function index()
    {
        $materi = Materi::latest()->get();

        return view('materi-guru', compact('materi'));
    }

    // 2. MEMBUKA FORM TAMBAH
    public function create()
    {
        return view('materi-form-guru', [
            'materi' => new Materi()
        ]);
    }

    // 3. MENYIMPAN MATERI BARU
    public function store(Request $request)
    {
        $data = $this->validasi($request);

        $gambar = null;

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')
                ->store('materi', 'public');
        }

        try {
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

        } catch (\Throwable $e) {

            // Hapus gambar baru jika database gagal disimpan
            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            throw $e;
        }

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    // 4. MELIHAT DETAIL MATERI GURU
    public function show(Materi $materi)
    {
        $materi->load('subbab');

        return view('materi-detail-guru', compact('materi'));
    }

    // 5. MEMBUKA FORM EDIT
    public function edit(Materi $materi)
    {
        $materi->load('subbab');

        return view('materi-form-guru', compact('materi'));
    }

    // 6. MENYIMPAN PERUBAHAN
    public function update(Request $request, Materi $materi)
    {
        $data = $this->validasi($request);

        $gambarLama = $materi->gambar;
        $gambarBaru = null;

        // Upload gambar baru jika guru memilih gambar
        if ($request->hasFile('gambar')) {
            $gambarBaru = $request->file('gambar')
                ->store('materi', 'public');
        }

        try {
            DB::transaction(function () use (
                $materi,
                $data,
                $gambarBaru
            ) {

                // Memperbarui data materi utama
                $materi->update([
                    'judul' => $data['judul'],
                    'deskripsi' => $data['deskripsi'] ?? null,
                    'konten' => $data['subbab'][0]['isi'],
                    'gambar' => $gambarBaru ?? $materi->gambar,
                    'durasi' => $data['durasi'] ?? null,
                    'ringkasan' => $data['ringkasan'] ?? null,
                ]);

                // Untuk versi sederhana:
                // hapus subbab lama, kemudian simpan data terbaru
                $materi->subbab()->delete();

                $this->simpanSubbab(
                    $materi,
                    $data['subbab']
                );
            });

        } catch (\Throwable $e) {

            if ($gambarBaru) {
                Storage::disk('public')->delete($gambarBaru);
            }

            throw $e;
        }

        // Hapus gambar lama hanya setelah update berhasil
        if ($gambarBaru && $gambarLama) {
            Storage::disk('public')->delete($gambarLama);
        }

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    // 7. MENGHAPUS MATERI
    public function destroy(Materi $materi)
    {
        $gambar = $materi->gambar;

        DB::transaction(function () use ($materi) {

            // Hapus semua subbab
            $materi->subbab()->delete();

            // Hapus materi utama
            $materi->delete();
        });

        // Hapus gambar setelah database berhasil diperbarui
        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil dihapus!');
    }

    // 8. MEMERIKSA DATA DARI FORM
    private function validasi(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'nullable|string|max:100',
            'ringkasan' => 'nullable|string',

            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'subbab' => 'required|array|min:1',
            'subbab.*.judul' => 'required|string|max:255',
            'subbab.*.pengantar' => 'nullable|string',
            'subbab.*.isi' => 'required|string',
            'subbab.*.contoh' => 'nullable|string',
        ]);
    }

    // 9. FUNGSI MENYIMPAN SUBBAB
    private function simpanSubbab(Materi $materi, array $semuaSubbab)
    {
        foreach (array_values($semuaSubbab) as $nomor => $subbab) {

            $materi->subbab()->create([
                'judul' => $subbab['judul'],
                'pengantar' => $subbab['pengantar'] ?? null,
                'isi' => $subbab['isi'],
                'contoh' => $subbab['contoh'] ?? null,
                'urutan' => $nomor + 1,
            ]);
        }
    }
}
