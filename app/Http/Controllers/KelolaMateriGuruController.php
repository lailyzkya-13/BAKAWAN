<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelolaMateriGuruController extends Controller
{
    // Menampilkan daftar materi
    public function index()
    {
        $materi = Materi::latest()->get();

        return view('materi-guru', compact('materi'));
    }

    // Membuka form tambah
    public function create()
    {
        return view('materi-form-guru');
    }

    // Menyimpan materi baru
    public function store(Request $request)
    {
        $data = $this->validasi($request);

        DB::transaction(function () use ($request, $data) {
            $materi = Materi::create([
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'] ?? null,
                'konten' => $data['subbab_isi'][0],
                'durasi' => $data['durasi'] ?? null,
                'ringkasan' => $data['ringkasan'] ?? null,
                'gambar' => $request->hasFile('gambar')
                    ? $request->file('gambar')->store('materi', 'public')
                    : null,
            ]);

            $this->simpanSubbab($materi, $data);
        });

        return redirect()->route('materi')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    // Menampilkan detail guru
    public function show(Materi $materi)
    {
        $materi->load('subbab');

        return view('materi-detail-guru', compact('materi'));
    }

    // Membuka form edit
    public function edit(Materi $materi)
    {
        $materi->load('subbab');

        return view('materi-form-guru', compact('materi'));
    }

    // Menyimpan perubahan
    public function update(Request $request, Materi $materi)
    {
        $data = $this->validasi($request);

        DB::transaction(function () use ($request, $materi, $data) {
            $perubahan = [
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'] ?? null,
                'konten' => $data['subbab_isi'][0],
                'durasi' => $data['durasi'] ?? null,
                'ringkasan' => $data['ringkasan'] ?? null,
            ];

            if ($request->hasFile('gambar')) {
                $gambarLama = $materi->gambar;

                $perubahan['gambar'] = $request
                    ->file('gambar')
                    ->store('materi', 'public');
            }

            $materi->update($perubahan);

            $materi->subbab()->delete();
            $this->simpanSubbab($materi, $data);

            if (isset($gambarLama)) {
                Storage::disk('public')->delete($gambarLama);
            }
        });

        return redirect()->route('materi')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    // Menghapus materi
    public function destroy(Materi $materi)
    {
        $gambar = $materi->gambar;

        $materi->delete();

        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()->route('materi')
            ->with('success', 'Materi berhasil dihapus!');
    }

    // Validasi form
    private function validasi(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'nullable|string|max:100',
            'ringkasan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'subbab_judul' => 'required|array|min:1',
            'subbab_judul.*' => 'required|string|max:255',
            'subbab_isi' => 'required|array|min:1',
            'subbab_isi.*' => 'required|string',
        ]);
    }

    // Menyimpan setiap subbab
    private function simpanSubbab(Materi $materi, array $data)
    {
        foreach ($data['subbab_judul'] as $nomor => $judul) {
            $materi->subbab()->create([
                'judul' => $judul,
                'isi' => $data['subbab_isi'][$nomor],
                'urutan' => $nomor + 1,
            ]);
        }
    }
}
