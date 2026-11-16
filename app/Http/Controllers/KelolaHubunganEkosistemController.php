<?php

namespace App\Http\Controllers;

use App\Models\HubunganEkosistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KelolaHubunganEkosistemController extends Controller
{
    // READ - Menampilkan seluruh pasangan
    public function index()
    {
        $daftarHubungan = HubunganEkosistem::orderBy('id')->get();

        return view('kelola-aktivitas-dua', compact('daftarHubungan'));
    }

    // CREATE - Menambah pasangan
    public function store(Request $request)
    {
        $data = $request->validate([
            'objek_kiri' => 'required|string|max:100',
            'gambar_kiri' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'objek_kanan' => 'required|string|max:100',
            'gambar_kanan' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hubungan' => 'required|string',
            'clue' => 'required|string',
        ]);

        File::ensureDirectoryExists(public_path('images/aktivitas'));

        foreach (['gambar_kiri', 'gambar_kanan'] as $kolom) {
            $file = $request->file($kolom);

            $namaFile = Str::uuid() . '.' . $file->extension();

            $file->move(
                public_path('images/aktivitas'),
                $namaFile
            );

            $data[$kolom] = $namaFile;
        }

        $data['aktif'] = $request->boolean('aktif');

        HubunganEkosistem::create($data);

        return back()->with('success', 'Pasangan berhasil ditambahkan.');
    }

    // UPDATE - Mengedit pasangan
    public function update(
        Request $request,
        HubunganEkosistem $hubunganEkosistem
    ) {
        $data = $request->validate([
            'objek_kiri' => 'required|string|max:100',
            'gambar_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'objek_kanan' => 'required|string|max:100',
            'gambar_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hubungan' => 'required|string',
            'clue' => 'required|string',
        ]);

        foreach (['gambar_kiri', 'gambar_kanan'] as $kolom) {
            if ($request->hasFile($kolom)) {
                File::ensureDirectoryExists(public_path('images/aktivitas'));

                $file = $request->file($kolom);
                $namaFile = Str::uuid() . '.' . $file->extension();

                $file->move(
                    public_path('images/aktivitas'),
                    $namaFile
                );

                $data[$kolom] = $namaFile;
            }
        }

        $data['aktif'] = $request->boolean('aktif');

        $hubunganEkosistem->update($data);

        return back()->with('success', 'Pasangan berhasil diperbarui.');
    }

    // DELETE - Menghapus pasangan
    public function destroy(HubunganEkosistem $hubunganEkosistem)
    {
        $hubunganEkosistem->delete();

        return back()->with('success', 'Pasangan berhasil dihapus.');
    }
}
