<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObjekAktivitas;

class ObjekAktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objek = [
            [
                'nama_objek' => 'Ikan',
                'gambar' => 'ikan.png',
                'kategori' => 'biotik',
                'penjelasan' => 'Ikan termasuk komponen biotik karena merupakan makhluk hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Katak',
                'gambar' => 'katak.png',
                'kategori' => 'biotik',
                'penjelasan' => 'Katak termasuk komponen biotik karena merupakan makhluk hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Teratai',
                'gambar' => 'teratai.png',
                'kategori' => 'biotik',
                'penjelasan' => 'Teratai termasuk komponen biotik karena merupakan tumbuhan hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Bangau',
                'gambar' => 'bangau.png',
                'kategori' => 'biotik',
                'penjelasan' => 'Bangau termasuk komponen biotik karena merupakan makhluk hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Matahari',
                'gambar' => 'matahari.png',
                'kategori' => 'abiotik',
                'penjelasan' => 'Cahaya matahari termasuk komponen abiotik karena merupakan benda tidak hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Air',
                'gambar' => 'air.png',
                'kategori' => 'abiotik',
                'penjelasan' => 'Air termasuk komponen abiotik karena merupakan benda tidak hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Batu',
                'gambar' => 'batu.png',
                'kategori' => 'abiotik',
                'penjelasan' => 'Batu termasuk komponen abiotik karena merupakan benda tidak hidup.',
                'aktif' => true,
            ],
            [
                'nama_objek' => 'Tanah',
                'gambar' => 'tanah.png',
                'kategori' => 'abiotik',
                'penjelasan' => 'Tanah termasuk komponen abiotik karena merupakan benda tidak hidup.',
                'aktif' => true,
            ],
        ];

        foreach ($objek as $item) {
            ObjekAktivitas::create($item);
        }
    }
}