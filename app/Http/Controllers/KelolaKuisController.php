<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\SoalKuis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelolaKuisController extends Controller
{
    // 1. MENAMPILKAN DAFTAR SOAL
    public function index()
    {
        // Mengambil semua materi dari database
        $daftarMateri = Materi::orderBy('judul', 'asc')->get();

        // Mengambil semua soal beserta materinya
        $daftarSoal = SoalKuis::with('materi')
            ->latest()
            ->get();

        // Mengirim kedua data ke halaman kuis
        return view('kuis-guru', compact(
            'daftarMateri',
            'daftarSoal'
        ));
    }

    // 2. MENYIMPAN SOAL BARU
    public function store(Request $request)
    {
        $data = $this->validasi($request);

        SoalKuis::create($data);

        return redirect()
            ->route('soal.kuis')
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    // 3. MENGEDIT SOAL
    public function update(Request $request, SoalKuis $soalKuis)
    {
        $data = $this->validasi($request);

        $soalKuis->update($data);

        return redirect()
            ->route('soal.kuis')
            ->with('success', 'Soal berhasil diperbarui!');
    }

    // 4. MENGHAPUS SOAL
    public function destroy(SoalKuis $soalKuis)
    {
        $soalKuis->delete();

        return redirect()
            ->route('soal.kuis')
            ->with('success', 'Soal berhasil dihapus!');
    }

    // 5. VALIDASI DATA
    private function validasi(Request $request)
    {
        return $request->validate([
            'materi_id' => 'required|exists:materis,id',
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