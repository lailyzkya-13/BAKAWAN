<?php

namespace Database\Seeders;

use App\Models\MisiPetualangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetualanganBangauSeeder extends Seeder
{
    public function run(): void
    {
        // Jangan memasukkan data awal berulang kali.
        if (MisiPetualangan::exists()) {
            return;
        }

        // Membuat data objek permainan.
        $buatItem = function (
            $kode,
            $jenis,
            $asset,
            $x,
            $y,
            $label,
            $poin = 0
        ) {
            return [
                'kode' => $kode,
                'jenis' => $jenis,
                'asset_key' => $asset,
                'posisi_x' => $x,
                'posisi_y' => $y,
                'label' => $label,
                'poin' => $poin,
                'aktif' => true,
            ];
        };

        // Membuat objek pertanyaan.
        $buatQuiz = function (
            $kode,
            $asset,
            $x,
            $label,
            $soal,
            $jawaban,
            $benar,
            $penjelasan
        ) use ($buatItem) {

            $item = $buatItem(
                $kode,
                'quiz',
                $asset,
                $x,
                59,
                $label,
                20
            );

            $item['soal'] = [
                'pertanyaan' => $soal,
                'pilihan_jawaban' => $jawaban,
                'jawaban_benar' => $benar,
                'penjelasan' => $penjelasan,
            ];

            return $item;
        };


        // =====================================
        // MISI 1: KENALI LINGKUNGAN
        // =====================================

        $items1 = [];

        foreach ([14, 29, 46, 65, 82] as $i => $x) {
            $items1[] = $buatItem(
                'fish' . $i,
                'fish',
                'ikan',
                $x,
                70,
                'Ikan',
                10
            );
        }

        $items1[] = $buatQuiz(
            'quiz1',
            'teratai',
            20,
            'Teratai',
            'Teratai termasuk komponen apa?',
            ['Biotik', 'Abiotik'],
            0,
            'Teratai termasuk biotik karena merupakan tumbuhan hidup.'
        );

        $items1[] = $buatQuiz(
            'quiz2',
            'air',
            39,
            'Air',
            'Air sungai termasuk komponen apa?',
            ['Biotik', 'Abiotik'],
            1,
            'Air termasuk abiotik karena bukan makhluk hidup.'
        );

        $items1[] = $buatQuiz(
            'quiz3',
            'batu',
            58,
            'Batu',
            'Batu termasuk komponen apa?',
            ['Biotik', 'Abiotik'],
            1,
            'Batu merupakan komponen abiotik.'
        );

        $items1[] = $buatQuiz(
            'quiz4',
            'ikan',
            76,
            'Ikan',
            'Mengapa ikan termasuk biotik?',
            [
                'Karena ikan bernapas dan tumbuh',
                'Karena ikan berada di air'
            ],
            0,
            'Ikan termasuk biotik karena memiliki ciri makhluk hidup.'
        );

        $items1[] = $buatItem(
            'haz1', 'hazard', 'sampah',
            35, 78, 'Plastik berbahaya'
        );

        $items1[] = $buatItem(
            'haz2', 'hazard', 'batu',
            70, 78, 'Batu rintangan'
        );

        $items1[] = $buatItem(
            'goal', 'goal', 'bendera',
            95, 76, 'Bendera akhir'
        );


        // =====================================
        // MISI 2: BANTU SI BANGAU
        // =====================================

        $items2 = [];

        $items2[] = $buatQuiz(
            'q1',
            'teratai',
            18,
            'Teka-teki 1',
            'Organisme yang berperan sebagai produsen adalah ...',
            ['Tumbuhan air', 'Bangau', 'Katak'],
            0,
            'Tumbuhan air membuat makanan sendiri sehingga menjadi produsen.'
        );

        $items2[] = $buatQuiz(
            'q2',
            'serangga',
            46,
            'Teka-teki 2',
            'Urutan rantai makanan yang benar adalah ...',
            [
                'Tumbuhan → serangga → katak → bangau',
                'Bangau → tumbuhan → serangga'
            ],
            0,
            'Rantai makanan dimulai dari produsen, kemudian konsumen.'
        );

        $items2[] = $buatQuiz(
            'q3',
            'ikan',
            75,
            'Teka-teki 3',
            'Bangau yang memakan ikan berperan sebagai ...',
            ['Produsen', 'Konsumen', 'Pengurai'],
            1,
            'Bangau merupakan konsumen karena memakan organisme lain.'
        );

        foreach ([25, 40, 62, 84] as $i => $x) {
            $items2[] = $buatItem(
                'post' . $i,
                'post',
                'papan',
                $x,
                70,
                'Pos ' . ($i + 1),
                10
            );
        }

        $items2[] = $buatItem(
            'haz1', 'hazard', 'batu',
            34, 78, 'Batu rintangan'
        );

        $items2[] = $buatItem(
            'haz2', 'hazard', 'sampah',
            68, 78, 'Rintangan'
        );

        $items2[] = $buatItem(
            'goal', 'goal', 'bendera',
            95, 76, 'Sarang bangau'
        );


        // =====================================
        // MISI 3: JAGA KESEIMBANGAN
        // =====================================

        $items3 = [];

        foreach ([13, 25, 37, 51, 67, 83] as $i => $x) {
            $items3[] = $buatItem(
                'trash' . $i,
                'trash',
                'sampah',
                $x,
                70,
                'Sampah untuk dibersihkan',
                10
            );
        }

        $items3[] = $buatItem(
            'animal1', 'animal', 'ikan',
            31, 59, 'Bantu ikan', 20
        );

        $items3[] = $buatItem(
            'animal2', 'animal', 'katak',
            72, 59, 'Bantu katak', 20
        );

        $items3[] = $buatQuiz(
            'q1',
            'papan',
            44,
            'Tantangan 1',
            'Mengapa plastik berbahaya bagi hewan air?',
            [
                'Dapat tertelan dan mencemari habitat',
                'Membuat sungai semakin bersih'
            ],
            0,
            'Sampah plastik dapat mencemari habitat dan membahayakan hewan.'
        );

        $items3[] = $buatQuiz(
            'q2',
            'papan',
            80,
            'Tantangan 2',
            'Cara terbaik menjaga sungai adalah ...',
            [
                'Membuang sampah ke sungai',
                'Mengurangi plastik dan membuang sampah dengan benar'
            ],
            1,
            'Menjaga kebersihan sungai membantu keseimbangan ekosistem.'
        );

        $items3[] = $buatItem(
            'haz1', 'hazard', 'batu',
            57, 78, 'Rintangan berbahaya'
        );

        $items3[] = $buatItem(
            'goal', 'goal', 'bendera',
            95, 76, 'Tujuan akhir'
        );


        // =====================================
        // MENYIMPAN SEMUA MISI
        // =====================================

        $daftarMisi = [

            [
                'nama' => 'Kenali Lingkungan',
                'tutorial' => 'Kumpulkan 5 ikan, kenali 4 objek biotik dan abiotik, hindari rintangan, lalu capai bendera.',
                'fakta' => 'Biotik adalah makhluk hidup, sedangkan abiotik adalah komponen tak hidup.',
                'urutan' => 1,
                'background_index' => 0,
                'platform_layout' => 0,
                'aktif' => true,
                'items' => $items1,
            ],

            [
                'nama' => 'Bantu Si Bangau',
                'tutorial' => 'Selesaikan 3 teka-teki hubungan ekosistem, lewati 4 pos, dan capai tujuan.',
                'fakta' => 'Rantai makanan menunjukkan perpindahan energi dari produsen ke konsumen.',
                'urutan' => 2,
                'background_index' => 1,
                'platform_layout' => 1,
                'aktif' => true,
                'items' => $items2,
            ],

            [
                'nama' => 'Jaga Keseimbangan',
                'tutorial' => 'Bersihkan 6 sampah, bantu 2 hewan, dan jawab 2 tantangan pelestarian.',
                'fakta' => 'Mengurangi sampah plastik membantu melindungi habitat hewan air.',
                'urutan' => 3,
                'background_index' => 2,
                'platform_layout' => 2,
                'aktif' => true,
                'items' => $items3,
            ],

        ];

        // Simpan seluruh data secara transaksional.
        DB::transaction(function () use ($daftarMisi) {

            foreach ($daftarMisi as $dataMisi) {

                $items = $dataMisi['items'];

                unset($dataMisi['items']);

                $misi = MisiPetualangan::create($dataMisi);

                foreach ($items as $index => $dataItem) {

                    $soal = $dataItem['soal'] ?? null;

                    unset($dataItem['soal']);

                    $dataItem['urutan'] = $index + 1;

                    $item = $misi->items()->create($dataItem);

                    if ($soal) {
                        $item->pertanyaan()->create($soal);
                    }
                }
            }
        });
    }
}
