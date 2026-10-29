<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilGuruController extends Controller
{
    // 1. READ - Menampilkan profil guru
    public function index(Request $request)
    {
        $profil = $request->user()->guruProfile;

        return view('profil-guru', compact('profil'));
    }

    // 2. CREATE - Menyimpan profil baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nip_nuptk' => 'nullable|string|max:50',
            'sekolah' => 'nullable|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
        ]);

        $guru = $request->user();

        // Memastikan guru belum memiliki profil
        if ($guru->guruProfile()->exists()) {
            return redirect()->route('profil')
                ->with('error', 'Profil sudah tersedia.');
        }

        // Menyimpan profil sesuai akun yang login
        $guru->guruProfile()->create($data);

        return redirect()->route('profil')
            ->with('success', 'Profil berhasil disimpan!');
    }

    // 3. UPDATE - Mengubah profil guru
    public function update(Request $request)
    {
        $data = $request->validate([
            'nip_nuptk' => 'nullable|string|max:50',
            'sekolah' => 'nullable|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
        ]);

        $profil = $request->user()->guruProfile;

        if (!$profil) {
            return redirect()->route('profil')
                ->with('error', 'Profil belum dibuat.');
        }

        $profil->update($data);

        return redirect()->route('profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    // 4. DELETE - Menghapus profil guru
    public function destroy(Request $request)
    {
        $profil = $request->user()->guruProfile;

        if ($profil) {
            $profil->delete();
        }

        return redirect()->route('profil')
            ->with('success', 'Profil berhasil dihapus!');
    }
}
