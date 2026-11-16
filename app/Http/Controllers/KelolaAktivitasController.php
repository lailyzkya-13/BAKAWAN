<?php

namespace App\Http\Controllers;

use App\Models\AktivitasPembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class KelolaAktivitasController extends Controller
{
    // Mengambil ID sekolah dari akun guru
    private function sekolahId()
    {
        return auth()->user()->guruProfile?->sekolah_id;
    }

    // 1. READ - Menampilkan daftar aktivitas
    public function index()
    {
        $sekolahId = $this->sekolahId();

        if (!$sekolahId) {
            return redirect()->route('dashboard')
                ->with('error', 'Akun guru belum terhubung dengan sekolah.');
        }

        $daftarAktivitas = AktivitasPembelajaran::where(
            'sekolah_id',
            $sekolahId
        )->latest()->get();

        return view('kelola-aktivitas', compact('daftarAktivitas'));
    }

    // 2. CREATE - Menambahkan aktivitas
    public function store(Request $request)
    {
        $sekolahId = $this->sekolahId();

        if (!$sekolahId) {
            return back()->with('error', 'Sekolah guru belum terdaftar.');
        }

        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:drag_drop,mencocokkan',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Jika guru mengunggah gambar
        if ($request->hasFile('gambar')) {
            File::ensureDirectoryExists(
                public_path('images/aktivitas')
            );

            $namaGambar = Str::uuid() . '.' .
                $request->file('gambar')->extension();

            $request->file('gambar')->move(
                public_path('images/aktivitas'),
                $namaGambar
            );

            $data['gambar'] = $namaGambar;
        }

        $data['sekolah_id'] = $sekolahId;
        $data['aktif'] = $request->boolean('aktif');

        AktivitasPembelajaran::create($data);

        return back()->with(
            'success',
            'Aktivitas berhasil ditambahkan.'
        );
    }

    // 3. UPDATE - Mengedit aktivitas
    public function update(Request $request, $id)
    {
        $sekolahId = $this->sekolahId();

        $aktivitas = AktivitasPembelajaran::where(
            'sekolah_id',
            $sekolahId
        )->findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:drag_drop,mencocokkan',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            File::ensureDirectoryExists(
                public_path('images/aktivitas')
            );

            $namaGambar = Str::uuid() . '.' .
                $request->file('gambar')->extension();

            $request->file('gambar')->move(
                public_path('images/aktivitas'),
                $namaGambar
            );

            $data['gambar'] = $namaGambar;
        }

        $data['aktif'] = $request->boolean('aktif');

        $aktivitas->update($data);

        return back()->with(
            'success',
            'Aktivitas berhasil diperbarui.'
        );
    }

    // 4. DELETE - Menghapus aktivitas
    public function destroy($id)
    {
        $aktivitas = AktivitasPembelajaran::where(
            'sekolah_id',
            $this->sekolahId()
        )->findOrFail($id);

        $aktivitas->delete();

        return back()->with(
            'success',
            'Aktivitas berhasil dihapus.'
        );
    }
}
