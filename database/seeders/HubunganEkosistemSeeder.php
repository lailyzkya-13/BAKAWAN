<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HubunganEkosistem;

class HubunganEkosistemSeeder extends Seeder
{
    public function run(): void
    {
        HubunganEkosistem::updateOrCreate(
            ['objek_kiri' => 'Ikan'],
            [
                'gambar_kiri' => 'ikan.png',
                'objek_kanan' => 'Air',
                'gambar_kanan' => 'air.png',
                'hubungan' => 'Ikan membutuhkan air sebagai habitat atau tempat hidupnya.',
                'clue' => 'Coba pikirkan, di manakah ikan hidup dan bergerak?',
                'aktif' => true,
            ]
        );

        HubunganEkosistem::updateOrCreate(
            ['objek_kiri' => 'Teratai'],
            [
                'gambar_kiri' => 'teratai.png',
                'objek_kanan' => 'Cahaya Matahari',
                'gambar_kanan' => 'matahari.png',
                'hubungan' => 'Teratai membutuhkan cahaya matahari untuk membantu proses membuat makanan.',
                'clue' => 'Tumbuhan membutuhkan sesuatu yang bersinar pada siang hari.',
                'aktif' => true,
            ]
        );

        HubunganEkosistem::updateOrCreate(
            ['objek_kiri' => 'Katak'],
            [
                'gambar_kiri' => 'katak.png',
                'objek_kanan' => 'Serangga',
                'gambar_kanan' => 'serangga.png',
                'hubungan' => 'Katak memakan serangga sebagai salah satu sumber makanannya.',
                'clue' => 'Coba pikirkan hewan kecil apa yang dapat menjadi makanan katak.',
                'aktif' => true,
            ]
        );

        HubunganEkosistem::updateOrCreate(
            ['objek_kiri' => 'Bangau'],
            [
                'gambar_kiri' => 'bangau.png',
                'objek_kanan' => 'Ikan',
                'gambar_kanan' => 'ikan.png',
                'hubungan' => 'Bangau dapat memakan ikan yang hidup di lingkungan perairan.',
                'clue' => 'Bangau mencari salah satu makanannya di dalam air.',
                'aktif' => true,
            ]
        );
    }
}