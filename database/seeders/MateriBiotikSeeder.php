<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriBiotikSeeder extends Seeder
{
    public function run(): void
    {
        // Judul materi utama
        $judul = 'Komponen Biotik dan Abiotik';

        // Cegah materi dengan judul sama dibuat dua kali
        if (Materi::where('judul', $judul)->exists()) {
            $this->command->warn(
                'Materi sudah ada di database.'
            );
            return;
        }

        // =====================================
        // DATA ENAM SUBBAB
        // =====================================

        $subbab = [

            // SUBBAB 1
            [
                'judul' => 'Pengertian Ekosistem',

                'pengantar' => 'Sebelum mengenal komponen biotik dan abiotik, mari kita pahami terlebih dahulu apa itu ekosistem melalui lingkungan yang dekat dengan kehidupan kita di Banjarmasin.',

                'isi' => 'Ekosistem adalah hubungan antara makhluk hidup dan lingkungan tidak hidup yang berada di suatu tempat. Semua bagian dalam ekosistem saling berinteraksi dan saling memengaruhi.',

                'contoh' => 'Contoh di Banjarmasin: Banjarmasin dikenal dengan lingkungan sungai dan lahan basah. Di sekitar sungai atau rawa, kita dapat menemukan ikan, burung, tumbuhan air, air sungai, tanah berlumpur, dan cahaya matahari. Semua bagian tersebut membentuk suatu ekosistem.',
            ],

            // SUBBAB 2
            [
                'judul' => 'Komponen Biotik',

                'pengantar' => 'Komponen biotik adalah semua makhluk hidup yang terdapat di dalam ekosistem, termasuk makhluk hidup yang dapat kita temukan di lingkungan lahan basah Banjarmasin.',

                'isi' => 'Komponen biotik merupakan bagian ekosistem yang berupa makhluk hidup. Makhluk hidup dapat tumbuh, membutuhkan makanan, dan berkembang biak. Contohnya adalah ikan, tumbuhan air, katak, burung, serangga, dan manusia.',

                'contoh' => implode("\n\n", [
                    'Ikan: Ikan hidup di perairan seperti sungai dan rawa. Ikan membutuhkan air dan oksigen untuk bertahan hidup.',

                    'Katak: Katak dapat ditemukan di lingkungan yang lembap atau dekat perairan. Katak memakan serangga dan membutuhkan air untuk berkembang biak.',

                    'Teratai: Teratai merupakan tumbuhan air yang dapat hidup di perairan tenang. Tumbuhan ini membutuhkan air dan cahaya matahari.',

                    'Burung Bangau: Bangau merupakan salah satu contoh burung yang dapat hidup di kawasan lahan basah. Bangau mencari makanan seperti ikan dan hewan kecil di sekitar perairan.',

                    'Perhatikan! Ikan, katak, teratai, dan bangau termasuk komponen biotik karena semuanya merupakan makhluk hidup. Masing-masing memiliki peran dalam ekosistem lahan basah.',
                ]),
            ],

            // SUBBAB 3
            [
                'judul' => 'Komponen Abiotik',

                'pengantar' => 'Selain makhluk hidup, ekosistem lahan basah Banjarmasin juga memiliki unsur tidak hidup yang mendukung kehidupan ikan, tumbuhan, burung, dan makhluk hidup lainnya.',

                'isi' => 'Komponen abiotik adalah unsur tidak hidup yang terdapat dalam suatu ekosistem. Walaupun tidak hidup, komponen ini sangat penting karena memengaruhi kehidupan makhluk hidup. Contohnya adalah air, tanah, cahaya matahari, udara, suhu, batu, dan mineral.',

                'contoh' => implode("\n\n", [
                    'Air Sungai dan Rawa: Air menjadi tempat hidup ikan dan berbagai organisme perairan. Air juga dibutuhkan tumbuhan dan hewan untuk bertahan hidup.',

                    'Tanah dan Lumpur: Tanah atau lumpur di sekitar lahan basah menjadi tempat tumbuh beberapa jenis tumbuhan serta tempat hidup organisme tertentu.',

                    'Cahaya Matahari: Cahaya matahari membantu tumbuhan air melakukan fotosintesis, yaitu proses membuat makanan dengan bantuan cahaya.',

                    'Udara: Udara mengandung oksigen yang dibutuhkan manusia dan hewan untuk bernapas. Tumbuhan juga membutuhkan gas dari udara.',

                    'Suhu: Suhu lingkungan memengaruhi aktivitas dan pertumbuhan makhluk hidup, termasuk organisme yang hidup di sungai dan rawa.',

                    'Batu dan Mineral: Batu dan mineral merupakan unsur tidak hidup. Mineral tertentu menjadi unsur hara yang dibutuhkan tumbuhan.',

                    'Contoh sederhana: Ikan membutuhkan air sebagai tempat hidup, sedangkan teratai membutuhkan air, cahaya matahari, dan unsur hara untuk tumbuh.',
                ]),
            ],

            // SUBBAB 4
            [
                'judul' => 'Hubungan Keduanya',

                'pengantar' => 'Di lingkungan sungai dan rawa Banjarmasin, komponen biotik dan abiotik saling membutuhkan. Makhluk hidup memanfaatkan air, tanah, udara, dan cahaya matahari untuk mendukung kehidupannya.',

                'isi' => 'Komponen biotik membutuhkan komponen abiotik untuk hidup. Contohnya, ikan membutuhkan air sebagai tempat hidup, sedangkan teratai membutuhkan air dan cahaya matahari untuk tumbuh. Kondisi air, tanah, dan suhu juga memengaruhi makhluk hidup yang dapat tinggal di suatu tempat.',

                'contoh' => implode("\n\n", [
                    'Komponen Biotik: Ikan, teratai, katak, dan bangau.',

                    'Komponen Abiotik: Air, tanah, udara, dan cahaya matahari.',

                    'Contoh hubungan di lahan basah: Di sebuah rawa, teratai menggunakan cahaya matahari untuk membuat makanan. Ikan hidup di dalam air, sedangkan bangau dapat mencari ikan sebagai makanannya. Jika kondisi air berubah, kehidupan ikan dan makhluk hidup lainnya juga dapat terpengaruh.',

                    'Setelah menonton video: Apa yang terjadi pada ikan jika air sungai menjadi sangat kotor? Mengapa tumbuhan air membutuhkan cahaya matahari?',

                    'Video pembelajaran: https://www.youtube.com/watch?v=msXml9wII8A',
                ]),
            ],

            // SUBBAB 5
            [
                'judul' => 'Contoh Ekosistem',

                'pengantar' => 'Ekosistem dapat ditemukan di berbagai tempat. Di Banjarmasin, lingkungan sungai dan rawa menjadi contoh ekosistem yang dekat dengan kehidupan masyarakat.',

                'isi' => 'Ekosistem dapat ditemukan di berbagai tempat seperti sungai, rawa, kolam, dan kebun. Setiap ekosistem memiliki komponen biotik dan abiotik yang saling berhubungan.',

                'contoh' => implode("\n\n", [
                    'Sungai: Sungai menjadi tempat hidup ikan dan berbagai organisme air. Di dalamnya terdapat komponen biotik seperti ikan serta komponen abiotik seperti air dan cahaya matahari.',

                    'Rawa: Rawa merupakan ekosistem lahan basah yang memiliki tanah jenuh air atau tergenang. Lingkungan ini dapat menjadi tempat hidup tumbuhan air, serangga, ikan, dan burung.',

                    'Kolam: Kolam memiliki air, ikan, tumbuhan air, dan berbagai organisme lainnya yang saling berhubungan.',

                    'Kebun: Kebun memiliki tumbuhan, serangga, tanah, udara, dan cahaya matahari. Semua komponen tersebut membentuk suatu ekosistem.',

                    'Ayo bandingkan! Sungai dan rawa memiliki banyak air, sedangkan kebun umumnya memiliki permukaan tanah yang lebih kering. Perbedaan kondisi lingkungan menyebabkan jenis makhluk hidup yang ditemukan juga dapat berbeda.',
                ]),
            ],

            // SUBBAB 6
            [
                'judul' => 'Ekosistem Lahan Basah',

                'pengantar' => 'Banjarmasin memiliki lingkungan yang erat kaitannya dengan sungai dan lahan basah. Lingkungan ini dapat digunakan untuk memahami hubungan antara komponen biotik dan abiotik secara langsung.',

                'isi' => 'Lahan basah adalah lingkungan yang tanahnya tergenang air atau memiliki kandungan air yang tinggi, baik sepanjang waktu maupun pada periode tertentu. Contohnya adalah rawa. Di lingkungan lahan basah, air menjadi salah satu unsur penting yang memengaruhi kehidupan makhluk hidup.',

                'contoh' => implode("\n\n", [
                    'Makhluk Hidup: Ikan, katak, tumbuhan air, serangga, dan burung merupakan contoh komponen biotik yang dapat ditemukan pada berbagai lingkungan lahan basah.',

                    'Lingkungan Tidak Hidup: Air, tanah berlumpur, udara, suhu, dan cahaya matahari merupakan komponen abiotik yang memengaruhi kehidupan di lahan basah.',

                    'Contoh di lingkungan Banjarmasin: Ketika mengamati sungai atau rawa, kita dapat melihat air yang menjadi tempat hidup ikan, tumbuhan yang memanfaatkan cahaya matahari, serta burung yang mencari makanan di sekitar perairan.',

                    'Mengapa lahan basah penting? Lahan basah menyediakan habitat bagi berbagai makhluk hidup, membantu menyimpan air, dan mendukung keseimbangan lingkungan. Menjaga kebersihan sungai dan rawa merupakan salah satu cara menjaga ekosistem.',
                ]),
            ],

        ];

        // =====================================
        // RINGKASAN MATERI
        // =====================================

        $ringkasan = implode("\n\n", [
            'Ekosistem merupakan hubungan antara makhluk hidup dan lingkungan tidak hidup yang saling memengaruhi.',

            'Komponen biotik adalah semua makhluk hidup, contohnya ikan, katak, teratai, dan bangau.',

            'Komponen abiotik adalah unsur tidak hidup, contohnya air, tanah, udara, cahaya matahari, dan suhu.',

            'Komponen biotik membutuhkan komponen abiotik. Contohnya ikan membutuhkan air dan teratai membutuhkan cahaya matahari.',

            'Sungai dan rawa di Banjarmasin merupakan contoh lingkungan lahan basah yang memiliki hubungan antara komponen biotik dan abiotik.',
        ]);

        // =====================================
        // SIMPAN KE DATABASE
        // =====================================

        DB::transaction(function () use (
            $judul,
            $subbab,
            $ringkasan
        ) {

            // Simpan materi utama
            $materi = Materi::create([
                'judul' => $judul,

                'deskripsi' => 'Pembelajaran IPAS Kelas V tentang komponen biotik dan abiotik dalam ekosistem lahan basah Banjarmasin.',

                'konten' => $subbab[0]['isi'],

                'gambar' => null,

                'durasi' => null,

                'ringkasan' => $ringkasan,
            ]);

            // Simpan semua subbab
            foreach ($subbab as $nomor => $item) {

                $materi->subbab()->create([
                    'judul' => $item['judul'],

                    'pengantar' => $item['pengantar'],

                    'isi' => $item['isi'],

                    'contoh' => $item['contoh'],

                    'urutan' => $nomor + 1,
                ]);
            }

        });

        $this->command->info(
            'Materi Biotik dan Abiotik berhasil ditambahkan!'
        );
    }
}
