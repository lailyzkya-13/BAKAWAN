@extends('layouts.app-guru')

@section('content')

<style>
    /* Judul halaman */
    .judul-profil {
        color: #2d6a4f;
        margin-bottom: 10px;
    }

    .deskripsi-profil {
        color: #666;
        margin-bottom: 25px;
    }

    /* Kotak utama profil */
    .kotak-profil {
        background-color: #FFFAF3;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Bagian foto dan nama guru */
    .profil-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 25px;
        border-bottom: 1px solid #ddd;
    }

    /* Foto profil sementara */
    .foto-profil {
        width: 90px;
        height: 90px;
        background-color: #b7e4c7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: bold;
        color: #2d6a4f;
        flex-shrink: 0;
    }

    /* Nama guru */
    .profil-nama h2 {
        color: #2d6a4f;
        margin: 0 0 8px;
    }

    .profil-nama p {
        color: #666;
        margin: 0;
    }

    /* Judul setiap bagian */
    .judul-bagian {
        color: #2d6a4f;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 20px;
    }

    /* Baris informasi profil */
    .baris-profil {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        gap: 15px;
    }

    /* Nama keterangan */
    .label-profil {
        width: 180px;
        color: #555;
        font-weight: bold;
        flex-shrink: 0;
    }

    /* Isi keterangan */
    .isi-profil {
        color: #333;
        overflow-wrap: anywhere;
    }

    /* Penanda status guru */
    .status-guru {
        background-color: #FF788D;
        color: white;
        padding: 7px 15px;
        border-radius: 20px;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        margin-top: 12px;
    }

    /* Tampilan pada layar kecil */
    @media (max-width: 600px) {
        .profil-header {
            flex-direction: column;
            text-align: center;
        }

        .baris-profil {
            flex-direction: column;
            gap: 5px;
        }

        .label-profil {
            width: 100%;
        }
    }
</style>


<!-- Judul halaman -->
<h1 class="judul-profil">Profil Guru</h1>

<p class="deskripsi-profil">
    Informasi identitas guru pada media pembelajaran BAKAWAN.
</p>


<!-- Data Guru -->
@php
    // Mengambil nama dan email jika guru sudah login
    $guru = auth()->user();

    // Data sementara jika belum tersedia
    $nama = $guru?->name ?? 'Nama Guru';
    $email = $guru?->email ?? 'Belum diisi';

    $nip = 'Belum diisi';
    $sekolah = 'Belum diisi';
    $mataPelajaran = 'IPAS';
    $kelas = 'V (Lima)';
@endphp


<!-- Kotak Profil -->
<div class="kotak-profil">

    <!-- Bagian atas profil -->
    <div class="profil-header">

        <!-- Foto profil sementara -->
        <div class="foto-profil">
            G
        </div>

        <!-- Nama dan status guru -->
        <div class="profil-nama">

            <h2>{{ $nama }}</h2>

            <p>{{ $email }}</p>

            <span class="status-guru">
                Guru BAKAWAN
            </span>

        </div>

    </div>


    <!-- Informasi Pribadi -->
    <h3 class="judul-bagian">
        Informasi Pribadi
    </h3>

    <div class="baris-profil">
        <div class="label-profil">
            Nama Lengkap
        </div>

        <div class="isi-profil">
            {{ $nama }}
        </div>
    </div>

    <div class="baris-profil">
        <div class="label-profil">
            NIP / NUPTK
        </div>

        <div class="isi-profil">
            {{ $nip }}
        </div>
    </div>

    <div class="baris-profil">
        <div class="label-profil">
            Email
        </div>

        <div class="isi-profil">
            {{ $email }}
        </div>
    </div>


    <!-- Informasi Mengajar -->
    <h3 class="judul-bagian">
        Informasi Mengajar
    </h3>

    <div class="baris-profil">
        <div class="label-profil">
            Nama Sekolah
        </div>

        <div class="isi-profil">
            {{ $sekolah }}
        </div>
    </div>

    <div class="baris-profil">
        <div class="label-profil">
            Mata Pelajaran
        </div>

        <div class="isi-profil">
            {{ $mataPelajaran }}
        </div>
    </div>

    <div class="baris-profil">
        <div class="label-profil">
            Kelas yang Diajar
        </div>

        <div class="isi-profil">
            {{ $kelas }}
        </div>
    </div>

</div>

@endsection
