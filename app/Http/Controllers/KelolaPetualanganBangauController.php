<?php

namespace App\Http\Controllers;

use App\Models\MisiPetualangan;
use App\Models\ItemPetualangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class KelolaPetualanganBangauController extends Controller
{
    // ==========================================
    // READ: MENAMPILKAN SELURUH MISI
    // ==========================================

    public function index()
    {
        $daftarMisi = MisiPetualangan::with([
            'items.pertanyaan'
        ])
            ->orderBy('urutan')
            ->get();

        return view(
            'kelola-petualangan-bangau',
            compact('daftarMisi')
        );
    }


    // ==========================================
    // CREATE: MENAMBAHKAN MISI
    // ==========================================

    public function storeMisi(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'tutorial' => 'required|string',
            'fakta' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'background_index' => 'required|integer|min:0|max:10',
            'platform_layout' => 'required|integer|min:0|max:10',
        ]);

        $data['aktif'] = $request->boolean('aktif');

        MisiPetualangan::create($data);

        return back()->with(
            'success',
            'Misi berhasil ditambahkan.'
        );
    }


    // ==========================================
    // UPDATE: MENGEDIT MISI
    // ==========================================

    public function updateMisi(
        Request $request,
        MisiPetualangan $misi
    ) {
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'tutorial' => 'required|string',
            'fakta' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'background_index' => 'required|integer|min:0|max:10',
            'platform_layout' => 'required|integer|min:0|max:10',
        ]);

        $data['aktif'] = $request->boolean('aktif');

        $misi->update($data);

        return back()->with(
            'success',
            'Misi berhasil diperbarui.'
        );
    }


    // ==========================================
    // DELETE: MENGHAPUS MISI
    // Beserta seluruh item dan pertanyaannya
    // ==========================================

    public function destroyMisi(MisiPetualangan $misi)
    {
        DB::transaction(function () use ($misi) {

            $items = $misi->items()->get();

            foreach ($items as $item) {

                $item->pertanyaan()->delete();

                $item->delete();
            }

            $misi->delete();
        });

        return back()->with(
            'success',
            'Misi dan seluruh item serta pertanyaannya berhasil dihapus.'
        );
    }


    // ==========================================
    // VALIDASI DATA ITEM DAN PERTANYAAN
    // ==========================================

    private function validasiItem(
        Request $request,
        MisiPetualangan $misi,
        ?ItemPetualangan $item = null
    ) {

        // Memastikan kode item unik dalam satu misi
        $aturanKode = Rule::unique(
            'item_petualangan',
            'kode'
        )->where(function ($query) use ($misi) {

            return $query->where(
                'misi_petualangan_id',
                $misi->id
            );

        });

        // Saat edit, kode milik item sendiri tetap boleh digunakan
        if ($item) {
            $aturanKode->ignore($item->id);
        }


        // Validasi input
        $data = $request->validate([

            'kode' => [
                'required',
                'string',
                'max:60',
                $aturanKode,
            ],

            'jenis' => [
                'required',
                Rule::in([
                    'fish',
                    'quiz',
                    'hazard',
                    'goal',
                    'trash',
                    'animal',
                    'post',
                ]),
            ],

            'label' => 'required|string|max:150',

            'asset_key' => 'required|string|max:50',

            'posisi_x' => 'required|integer|min:0|max:100',

            'posisi_y' => 'required|integer|min:0|max:100',

            'poin' => 'nullable|integer|min:0',

            'urutan' => 'required|integer|min:1',

            'aktif' => 'nullable|boolean',

            'pertanyaan' => 'required_if:jenis,quiz|nullable|string',

            'pilihan_jawaban_text' => 'required_if:jenis,quiz|nullable|string',

            'jawaban_benar' => 'required_if:jenis,quiz|nullable|integer|min:0|max:3',

            'penjelasan' => 'nullable|string',

        ]);


        // Menyiapkan data item permainan
        $dataItem = [

            'kode' => $data['kode'],

            'jenis' => $data['jenis'],

            'label' => $data['label'],

            'asset_key' => $data['asset_key'],

            'posisi_x' => $data['posisi_x'],

            'posisi_y' => $data['posisi_y'],

            'poin' => $data['poin'] ?? 0,

            'urutan' => $data['urutan'],

            'aktif' => $request->boolean('aktif'),

        ];


        // Menyiapkan data pertanyaan
        $dataPertanyaan = null;


        if ($data['jenis'] === 'quiz') {

            // Memisahkan pilihan jawaban berdasarkan baris
            $pilihan = preg_split(
                '/\r\n|\r|\n/',
                trim($data['pilihan_jawaban_text'])
            );


            // Menghapus pilihan kosong
            $pilihan = array_values(
                array_filter(
                    array_map('trim', $pilihan),
                    fn($value) => $value !== ''
                )
            );


            // Minimal 2 dan maksimal 4 pilihan
            if (count($pilihan) < 2 || count($pilihan) > 4) {

                throw ValidationException::withMessages([
                    'pilihan_jawaban_text' =>
                        'Pertanyaan harus memiliki 2 sampai 4 pilihan jawaban.'
                ]);

            }


            // Memastikan indeks jawaban benar tersedia
            $jawabanBenar = (int) $data['jawaban_benar'];

            if (!array_key_exists($jawabanBenar, $pilihan)) {

                throw ValidationException::withMessages([
                    'jawaban_benar' =>
                        'Nomor jawaban benar tidak sesuai dengan pilihan yang tersedia.'
                ]);

            }


            // Data pertanyaan yang akan disimpan
            $dataPertanyaan = [

                'pertanyaan' => $data['pertanyaan'],

                'pilihan_jawaban' => $pilihan,

                'jawaban_benar' => $jawabanBenar,

                'penjelasan' => $data['penjelasan'] ?? null,

            ];

        }


        return [
            'item' => $dataItem,
            'pertanyaan' => $dataPertanyaan,
        ];
    }


    // ==========================================
    // CREATE: MENAMBAHKAN ITEM PERMAINAN
    // ==========================================

    public function storeItem(
        Request $request,
        MisiPetualangan $misi
    ) {

        $data = $this->validasiItem(
            $request,
            $misi
        );


        DB::transaction(function () use ($misi, $data) {

            // Menyimpan item ke database
            $item = $misi->items()->create(
                $data['item']
            );


            // Menyimpan pertanyaan jika jenisnya quiz
            if ($data['pertanyaan']) {

                $item->pertanyaan()->create(
                    $data['pertanyaan']
                );

            }

        });


        return back()->with(
            'success',
            'Item permainan berhasil ditambahkan.'
        );
    }


    // ==========================================
    // UPDATE: MENGEDIT ITEM PERMAINAN
    // ==========================================

    public function updateItem(
        Request $request,
        ItemPetualangan $item
    ) {

        $misi = $item->misi;

        $data = $this->validasiItem(
            $request,
            $misi,
            $item
        );


        DB::transaction(function () use ($item, $data) {

            // Memperbarui data item
            $item->update($data['item']);


            if ($data['pertanyaan']) {

                // Memperbarui atau membuat pertanyaan
                $item->pertanyaan()->updateOrCreate(
                    [],
                    $data['pertanyaan']
                );

            } else {

                // Menghapus pertanyaan jika bukan jenis quiz
                $item->pertanyaan()->delete();

            }

        });


        return back()->with(
            'success',
            'Item permainan berhasil diperbarui.'
        );
    }


    // ==========================================
    // DELETE: MENGHAPUS ITEM PERMAINAN
    // Beserta pertanyaannya
    // ==========================================

    public function destroyItem(ItemPetualangan $item)
    {

        DB::transaction(function () use ($item) {

            // Menghapus pertanyaan terlebih dahulu
            $item->pertanyaan()->delete();

            // Menghapus item permainan
            $item->delete();

        });


        return back()->with(
            'success',
            'Item permainan berhasil dihapus.'
        );
    }

}
