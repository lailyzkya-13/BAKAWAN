<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\SoalKuis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelolaKuisController extends Controller
{
    // 1. MENAMPILKAN DAFTAR SOAL EVALUASI
    public function index()
    {
        // Mengambil materi untuk ringkasan dashboard
        $daftarMateri = Materi::orderBy('judul', 'asc')->get();

        // Mengambil seluruh soal evaluasi
        $daftarSoal = SoalKuis::with('materi')
            ->latest()
            ->get();

        return view('kuis-guru', compact(
            'daftarMateri',
            'daftarSoal'
        ));
    }

    // 2. MENYIMPAN SOAL EVALUASI BARU
    public function store(Request $request)
    {
        $data = $this->validasi($request);

        SoalKuis::create($data);

        return redirect()
            ->route('soal.kuis')
            ->with('success', 'Soal evaluasi berhasil ditambahkan!');
    }

    // 3. MENGEDIT SOAL EVALUASI
    public function update(Request $request, SoalKuis $soalKuis)
    {
        $data = $this->validasi($request);

        $soalKuis->update($data);

        return redirect()
            ->route('soal.kuis')
            ->with('success', 'Soal evaluasi berhasil diperbarui!');
    }

    // 4. MENGHAPUS SOAL EVALUASI
    public function destroy(SoalKuis $soalKuis)
    {
        $soalKuis->delete();

        return redirect()
            ->route('soal.kuis')
            ->with('success', 'Soal evaluasi berhasil dihapus!');
    }

    // 5. VALIDASI DATA SOAL
    private function validasi(Request $request)
    {
        return $request->validate([
            'pertanyaan' => 'required|string',

            'pilihan_a' => 'required|string|max:255',
            'pilihan_b' => 'required|string|max:255',
            'pilihan_c' => 'required|string|max:255',
            'pilihan_d' => 'required|string|max:255',

            'jawaban_benar' => [
                'required',
                Rule::in(['A', 'B', 'C', 'D'])
            ],
        ]);
    }
}
