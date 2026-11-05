<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoalKuis;

class EvaluasiAkhirSeeder extends Seeder
{
    public function run(): void
    {
        $daftarSoal = [

            // SOAL 1
            [
                'materi_id' => null,
                'pertanyaan' => 'Manakah yang termasuk komponen biotik di lingkungan lahan basah?',
                'pilihan_a' => 'Air sungai',
                'pilihan_b' => 'Ikan gabus',
                'pilihan_c' => 'Cahaya matahari',
                'pilihan_d' => 'Tanah',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Ikan gabus termasuk komponen biotik karena merupakan makhluk hidup yang dapat bergerak, tumbuh, dan berkembang biak. Air, cahaya matahari, dan tanah termasuk komponen abiotik.',
            ],

            // SOAL 2
            [
                'materi_id' => null,
                'pertanyaan' => 'Manakah yang termasuk komponen abiotik dalam ekosistem?',
                'pilihan_a' => 'Katak',
                'pilihan_b' => 'Bangau',
                'pilihan_c' => 'Air',
                'pilihan_d' => 'Teratai',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Air merupakan komponen abiotik karena termasuk benda tak hidup. Katak, bangau, dan teratai termasuk komponen biotik karena merupakan makhluk hidup.',
            ],

            // SOAL 3
            [
                'materi_id' => null,
                'pertanyaan' => 'Manakah yang termasuk contoh hubungan predasi di lahan basah?',
                'pilihan_a' => 'Lebah dan bunga',
                'pilihan_b' => 'Katak dan serangga',
                'pilihan_c' => 'Bangau dan pohon',
                'pilihan_d' => 'Pohon dan tanah',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Katak memangsa serangga, sehingga termasuk hubungan predasi antara makhluk hidup. Predasi adalah hubungan ketika satu hewan menangkap dan memakan hewan lainnya.',
            ],

            // SOAL 4
            [
                'materi_id' => null,
                'pertanyaan' => 'Mengapa tumbuhan teratai membutuhkan cahaya matahari?',
                'pilihan_a' => 'Untuk berpindah tempat',
                'pilihan_b' => 'Untuk melakukan fotosintesis',
                'pilihan_c' => 'Untuk mencari mangsa',
                'pilihan_d' => 'Untuk menghindari ikan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Teratai membutuhkan cahaya matahari untuk melakukan fotosintesis, yaitu proses tumbuhan membuat makanannya sendiri. Cahaya matahari merupakan komponen abiotik yang membantu kehidupan tumbuhan.',
            ],

            // SOAL 5
            [
                'materi_id' => null,
                'pertanyaan' => 'Apa peran air bagi ikan yang hidup di sungai?',
                'pilihan_a' => 'Sebagai tempat hidup',
                'pilihan_b' => 'Sebagai pemangsa',
                'pilihan_c' => 'Sebagai produsen',
                'pilihan_d' => 'Sebagai pengurai',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Air merupakan tempat hidup atau habitat ikan. Ikan membutuhkan air untuk bernapas melalui insang, bergerak, dan menjalankan aktivitas kehidupannya.',
            ],

        ];

        foreach ($daftarSoal as $soal) {

            SoalKuis::updateOrCreate(
                [
                    'pertanyaan' => $soal['pertanyaan'],
                ],
                $soal
            );

        }
    }
}
