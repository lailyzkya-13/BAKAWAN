<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class KelolaMateriGuruController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->get();

        return view('materi-guru', compact('materi'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'required|string',
            'durasi' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('materi', 'public');
        }

        Materi::create($data);

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function show(Materi $materi)
    {
        return view('materi-detail-guru', compact('materi'));
    }
}
