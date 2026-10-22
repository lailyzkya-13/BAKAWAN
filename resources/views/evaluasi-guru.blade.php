@extends('layouts.app-guru')

@section('content')

    <!-- =====================================
                                     1. CSS HALAMAN EVALUASI GURU
                                ===================================== -->

    <style>
        /* Judul halaman */
        .judul-halaman {
            color: #2d6a4f;
            margin-bottom: 10px;
        }

        .deskripsi {
            color: #666;
            margin-bottom: 25px;
        }

        /* Kotak tabel */
        .kotak-evaluasi {
            background-color: #FFFAF3;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        /* Agar tabel bisa digeser di layar kecil */
        .tabel-wrapper {
            overflow-x: auto;
        }

        /* Tabel evaluasi */
        .tabel-evaluasi {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        /* Kepala tabel */
        .tabel-evaluasi th {
            background-color: #b7e4c7;
            color: #1b4332;
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Isi tabel */
        .tabel-evaluasi td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            color: #333;
        }

        /* Efek hover */
        .tabel-evaluasi tr:hover td {
            background-color: #f1f8f3;
        }

        /* Tombol Lihat Detail */
        .btn-detail {
            background-color: #FF788D;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-detail:hover {
            background-color: #e85d75;
        }

        /* Jendela detail */
        .modal-detail {
            border: none;
            border-radius: 12px;
            padding: 25px;
            width: 90%;
            max-width: 450px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-detail::backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-detail h2 {
            color: #2d6a4f;
            margin-top: 0;
        }

        .modal-detail h3 {
            color: #2d6a4f;
            font-size: 17px;
        }

        .modal-detail p {
            color: #444;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        /* Tombol Tutup */
        .btn-tutup {
            background-color: #2d6a4f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-tutup:hover {
            background-color: #1b4332;
        }

        /* Pesan jika data kosong */
        .pesan-kosong {
            text-align: center;
            color: #888;
            padding: 20px;
        }

        /* Tombol Export PDF */
        .btn-export-pdf {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            padding: 11px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-export-pdf:hover {
            background-color: #b02a37;
            color: white;
        }

        .btn-export-excel {
            display: inline-block;
            background-color: #198754;
            color: white;
            padding: 11px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-export-excel:hover {
            background-color: #146c43;
            color: white;
        }


        /* Judul sebelah kiri, tombol sebelah kanan */
        /* Header judul dan tombol export */
        .header-evaluasi {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .header-evaluasi h2 {
            margin: 0;
            color: #2d6a4f;
        }

        /* Tombol berada di sebelah kanan */
        .tombol-export {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        /* Responsif untuk HP */
        @media (max-width: 600px) {
            .header-evaluasi {
                flex-direction: column;
                align-items: flex-start;
            }

            .tombol-export {
                margin-left: 0;
                flex-wrap: wrap;
            }
        }

        /* Tampilan responsif untuk HP */
        @media (max-width: 600px) {
            .header-evaluasi {
                flex-direction: column;
                align-items: flex-start;
            }

            .tombol-export {
                margin-left: 0;
                flex-wrap: wrap;
                justify-content: flex-start;
            }
        }
    </style>


    <!-- =====================================
                                     2. JUDUL HALAMAN
                                ===================================== -->

    <h1 class="judul-halaman">
        Hasil Evaluasi Siswa
    </h1>

    <p class="deskripsi">
        Berikut adalah hasil evaluasi pembelajaran siswa BAKAWAN.
    </p>


    <!-- =====================================
                                     3. TABEL NILAI SISWA
                                ===================================== -->



    <div class="kotak-evaluasi">

        <!-- Header judul dan tombol export -->
        <div class="header-evaluasi">

            <h2>Daftar Nilai Siswa</h2>

            <div class="tombol-export">

                <a href="{{ route('hasil.evaluasi.pdf') }}" class="btn-export-pdf">
                    Export PDF
                </a>

                <a href="{{ route('hasil.evaluasi.excel') }}" class="btn-export-excel">
                    Export Excel
                </a>

            </div>

        </div>


        <!-- TABEL NILAI SISWA -->
        <div class="tabel-wrapper">


            <table class="tabel-evaluasi">

                <!-- Kepala tabel -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nilai Rata-Rata</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <!-- Isi tabel -->
                <tbody>

                    <!-- Mengambil semua siswa dari database -->
                    @forelse ($daftarSiswa as $siswa)

                        @php

                            // Mengambil seluruh hasil evaluasi siswa
                            $riwayat = $hasilPerSiswa->get(
                                $siswa->id,
                                collect()
                            );

                            // Menghitung rata-rata nilai siswa
                            $rataRata = $riwayat->avg('nilai');

                        @endphp


                        <tr>

                            <!-- Nomor urut -->
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <!-- Nama siswa -->
                            <td>
                                {{ $siswa->nama_lengkap }}
                            </td>


                            <!-- Kelas siswa -->
                            <td>
                                {{ $siswa->kelas }}
                            </td>


                            <!-- Rata-rata nilai -->
                            <td>

                                @if ($rataRata !== null)
                                    {{ number_format($rataRata, 1, ',', '.') }}
                                @else
                                    Belum ada nilai
                                @endif

                            </td>


                            <!-- Tombol Lihat Detail -->
                            <td>

                                <button type="button" class="btn-detail"
                                    onclick="document.getElementById('detail-{{ $siswa->id }}').showModal()">
                                    Lihat Detail
                                </button>


                                <!-- =====================================
                                                                                                 4. DETAIL NILAI SETIAP SISWA
                                                                                            ===================================== -->

                                <dialog id="detail-{{ $siswa->id }}" class="modal-detail">

                                    <h2>Detail Hasil Evaluasi</h2>


                                    <!-- Identitas siswa -->
                                    <p>
                                        <strong>Nama Siswa:</strong>
                                        {{ $siswa->nama_lengkap }}
                                    </p>

                                    <p>
                                        <strong>Kelas:</strong>
                                        {{ $siswa->kelas }}
                                    </p>


                                    <!-- Jumlah pengerjaan -->
                                    <p>
                                        <strong>Jumlah Pengerjaan:</strong>
                                        {{ $riwayat->count() }}
                                    </p>


                                    <!-- Rata-rata nilai -->
                                    <p>
                                        <strong>Nilai Rata-Rata:</strong>

                                        @if ($rataRata !== null)

                                                                    {{ number_format(
                                                $rataRata,
                                                1,
                                                ',',
                                                '.'
                                            ) }}

                                        @else

                                            Belum ada nilai

                                        @endif

                                    </p>


                                    <hr>


                                    <!-- Riwayat evaluasi -->
                                    <h3>Riwayat Nilai Kuis</h3>


                                    @forelse ($riwayat as $hasil)

                                        <p>

                                            <strong>
                                                Pengerjaan
                                                {{ $riwayat->count() - $loop->index }}
                                            </strong>

                                            <br>

                                            Nilai:
                                            {{ $hasil->nilai }}

                                            <br>

                                            Jawaban Benar:
                                            {{ $hasil->jumlah_benar }}
                                            dari
                                            {{ $hasil->jumlah_soal }} soal

                                            <br>

                                            Waktu:
                                            {{ $hasil->created_at?->format('d/m/Y H:i') ?? '-' }}

                                        </p>

                                        <hr>


                                    @empty

                                        <!-- Siswa belum mengerjakan -->
                                        <p>
                                            Siswa belum mengerjakan evaluasi.
                                        </p>

                                    @endforelse


                                    <!-- Tombol menutup detail -->
                                    <button type="button" class="btn-tutup" onclick="this.closest('dialog').close()">
                                        Tutup
                                    </button>

                                </dialog>

                            </td>

                        </tr>


                    @empty

                        <!-- Jika belum ada siswa di database -->
                        <tr>
                            <td colspan="5" class="pesan-kosong">
                                Belum ada siswa yang terdaftar.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection