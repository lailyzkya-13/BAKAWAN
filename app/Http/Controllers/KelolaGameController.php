<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelolaGameController extends Controller
{
    // READ: Menampilkan daftar game
    public function index()
    {
        $games = Game::latest()->get();

        return view('game-guru', compact('games'));
    }

    // CREATE: Menambahkan game
    public function store(Request $request)
    {
        $data = $this->validasiGame($request);

        Game::create($data);

        return redirect()
            ->route('game')
            ->with('success', 'Game berhasil ditambahkan!');
    }

    // UPDATE: Memperbarui game
    public function update(Request $request, Game $game)
    {
        $data = $this->validasiGame($request);

        $game->update($data);

        return redirect()
            ->route('game')
            ->with('success', 'Game berhasil diperbarui!');
    }

    // DELETE: Menghapus game
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()
            ->route('game')
            ->with('success', 'Game berhasil dihapus!');
    }

    // Menampilkan halaman bermain
    public function play(Game $game)
    {
        $pasangan = collect(
            preg_split('/\r\n|\r|\n/', trim($game->pasangan))
        )->map(function ($baris) {
            $bagian = explode('|', $baris, 2);

            return [
                'soal' => trim($bagian[0]),
                'jawaban' => trim($bagian[1]),
            ];
        })->values();

        return view('game-play', compact('game', 'pasangan'));
    }

    // Validasi form
    private function validasiGame(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => [
                'required',
                Rule::in(['memory', 'pasangkan', 'dragdrop'])
            ],
            'deskripsi' => 'nullable|string',
            'pasangan' => 'required|string',
        ]);

        $baris = preg_split(
            '/\r\n|\r|\n/',
            trim($data['pasangan'])
        );

        // Minimal dua pasangan dan setiap baris harus valid
        if (count($baris) < 2) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'pasangan' => 'Masukkan minimal 2 pasangan soal.',
            ]);
        }

        $soal = [];

        foreach ($baris as $isi) {
            $bagian = explode('|', $isi);

            if (
                count($bagian) !== 2 ||
                trim($bagian[0]) === '' ||
                trim($bagian[1]) === ''
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'pasangan' => 'Gunakan format Soal|Jawaban pada setiap baris.',
                ]);
            }

            $soal[] = trim($bagian[0]);
        }

        if (count($soal) !== count(array_unique($soal))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'pasangan' => 'Setiap soal harus memiliki nama yang berbeda.',
            ]);
        }

        $data['pasangan'] = implode("\n", array_map(
            fn ($isi) => trim($isi),
            $baris
        ));

        return $data;
    }
}
