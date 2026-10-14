@extends('layouts.app-guru')

@section('content')

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
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .kotak-evaluasi h2 {
        color: #2d6a4f;
        margin-top: 0;
        margin-bottom: 20px;
    }

    /* Agar tabel bisa digeser pada layar kecil */
    .tabel-wrapper {
        overflow-x: auto;
    }

    /* Tabel hasil evaluasi */
    .tabel-evaluasi {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    /* Judul kolom tabel */
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

    /* Efek ketika baris disentuh mouse */
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

    /* Kotak detail siswa */
    .modal-detail {
        border: none;
        border-radius: 12px;
        padding: 25px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }

    .modal-detail::backdrop {
        background-color: rgba(0,0,0,0.5);
    }

    .modal-detail h2 {
        color: #2d6a4f;
        margin-top: 0;
    }

    .modal-detail p {
        color: #444;
        line-height: 1.8;
    }

    /* Tombol Tutup */
    .btn-tutup {
        background-color: #2d6a4f;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn-tutup:hover {
        background-color: #1b4332;
    }
</style>


<!-- Judul Halaman -->
<h1 class="judul-halaman">Hasil Evaluasi Siswa</h1>

<p class="deskripsi">
    Berikut adalah hasil evaluasi pembelajaran siswa BAKAWAN.
</p>


<!-- Data contoh siswa -->
@php
    $daftarSiswa = [
        [
            'nama' => 'Aisyah',
            'kelas' => 'V A',
            'kuis1' => 80,
            'kuis2' => 90,
            'kuis3' => 85
        ],
        [
            'nama' => 'Budi',
            'kelas' => 'V A',
            'kuis1' => 90,
            'kuis2' => 90,
            'kuis3' => 90
        ],
        [
            'nama' => 'Citra',
            'kelas' => 'V B',
            'kuis1' => 70,
            'kuis2' => 80,
            'kuis3' => 90
        ],
        [
            'nama' => 'Dimas',
            'kelas' => 'V B',
            'kuis1' => 88,
            'kuis2' => 90,
            'kuis3' => 92
        ]
    ];
@endphp


<!-- Kotak Hasil Evaluasi -->
<div class="kotak-evaluasi">

    <h2>Daftar Nilai Siswa</h2>

    <div class="tabel-wrapper">

        <table class="tabel-evaluasi">

            <!-- Kepala Tabel -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nilai Rata-Rata</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <!-- Isi Tabel -->
            <tbody>

                @foreach ($daftarSiswa as $siswa)

                    @php
                        // Menghitung rata-rata dari 3 kuis
                        $rataRata = (
                            $siswa['kuis1'] +
                            $siswa['kuis2'] +
                            $siswa['kuis3']
                        ) / 3;
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $siswa['nama'] }}</td>

                        <td>{{ $siswa['kelas'] }}</td>

                        <td>{{ number_format($rataRata, 1) }}</td>

                        <td>
                            <button
                                type="button"
                                class="btn-detail"
                                data-nama="{{ $siswa['nama'] }}"
                                data-kelas="{{ $siswa['kelas'] }}"
                                data-kuis1="{{ $siswa['kuis1'] }}"
                                data-kuis2="{{ $siswa['kuis2'] }}"
                                data-kuis3="{{ $siswa['kuis3'] }}"
                                data-rata="{{ number_format($rataRata, 1) }}"
                                onclick="lihatDetail(this)"
                            >
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>


<!-- Jendela Detail Nilai Siswa -->
<dialog id="modalDetail" class="modal-detail">

    <h2>Detail Hasil Evaluasi</h2>

    <p>
        <strong>Nama Siswa:</strong>
        <span id="detailNama"></span>
    </p>

    <p>
        <strong>Kelas:</strong>
        <span id="detailKelas"></span>
    </p>

    <hr>

    <p>
        <strong>Nilai Kuis 1:</strong>
        <span id="detailKuis1"></span>
    </p>

    <p>
        <strong>Nilai Kuis 2:</strong>
        <span id="detailKuis2"></span>
    </p>

    <p>
        <strong>Nilai Kuis 3:</strong>
        <span id="detailKuis3"></span>
    </p>

    <hr>

    <p>
        <strong>Nilai Rata-Rata:</strong>
        <span id="detailRata"></span>
    </p>

    <button
        type="button"
        class="btn-tutup"
        onclick="document.getElementById('modalDetail').close()"
    >
        Tutup
    </button>

</dialog>


<!-- JavaScript untuk menampilkan detail -->
<script>
    function lihatDetail(tombol) {

        // Mengambil data siswa dari tombol
        let data = tombol.dataset;

        // Menampilkan data ke jendela detail
        document.getElementById('detailNama').textContent = data.nama;
        document.getElementById('detailKelas').textContent = data.kelas;

        document.getElementById('detailKuis1').textContent = data.kuis1;
        document.getElementById('detailKuis2').textContent = data.kuis2;
        document.getElementById('detailKuis3').textContent = data.kuis3;

        document.getElementById('detailRata').textContent = data.rata;

        // Membuka jendela detail
        document.getElementById('modalDetail').showModal();
    }
</script>

@endsection
