<?php

namespace App\Http\Controllers;

use App\Models\ObjekAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class KelolaObjekAktivitasController extends Controller
{
    // 1. MENAMPILKAN SEMUA OBJEK
    public function index()
    {
        $daftarObjek = ObjekAktivitas::orderBy('id')->get();

        return view('kelola-aktivitas-satu', compact('daftarObjek'));
    }

    // 2. MENAMBAH OBJEK
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_objek' => 'required|string|max:100',
            'kategori' => 'required|in:biotik,abiotik',
            'penjelasan' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Menyimpan gambar ke folder aktivitas
        File::ensureDirectoryExists(public_path('images/aktivitas'));

        $namaGambar = Str::uuid() . '.' . $request->file('gambar')->extension();

        $request->file('gambar')->move(
            public_path('images/aktivitas'),
            $namaGambar
        );

        $data['gambar'] = $namaGambar;
        $data['aktif'] = $request->boolean('aktif');

        ObjekAktivitas::create($data);

        return back()->with('success', 'Objek berhasil ditambahkan.');
    }

    // 3. MENGEDIT OBJEK
    public function update(Request $request, ObjekAktivitas $objekAktivitas)
    {
        $data = $request->validate([
            'nama_objek' => 'required|string|max:100',
            'kategori' => 'required|in:biotik,abiotik',
            'penjelasan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Ganti gambar hanya jika guru mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            File::ensureDirectoryExists(public_path('images/aktivitas'));

            $namaGambar = Str::uuid() . '.' . $request->file('gambar')->extension();

            $request->file('gambar')->move(
                public_path('images/aktivitas'),
                $namaGambar
            );

            $data['gambar'] = $namaGambar;
        }

        $data['aktif'] = $request->boolean('aktif');

        $objekAktivitas->update($data);

        return back()->with('success', 'Objek berhasil diperbarui.');
    }

    // 4. MENGHAPUS OBJEK
    public function destroy(ObjekAktivitas $objekAktivitas)
    {
        $objekAktivitas->delete();

        return back()->with('success', 'Objek berhasil dihapus.');
    }
}
