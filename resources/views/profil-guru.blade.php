
@extends('layouts.app-guru')

@section('content')

<style>
    /* ================= JUDUL ================= */

    .judul-profil {
        color: #2d6a4f;
        margin-bottom: 10px;
    }

    .deskripsi-profil {
        color: #666;
        margin-bottom: 25px;
    }

    /* ================= KOTAK PROFIL ================= */

    .kotak-profil {
        background-color: #FFFAF3;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* ================= HEADER PROFIL ================= */

    .profil-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 25px;
        border-bottom: 1px solid #ddd;
    }

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

    .profil-nama h2 {
        color: #2d6a4f;
        margin: 0 0 8px;
    }

    .profil-nama p {
        color: #666;
        margin: 0;
    }

    .status-guru {
        display: inline-block;
        background-color: #FF788D;
        color: white;
        padding: 7px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        margin-top: 12px;
    }

    /* ================= INFORMASI PROFIL ================= */

    .judul-bagian {
        color: #2d6a4f;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 20px;
    }

    .baris-profil {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        gap: 15px;
    }

    .label-profil {
        width: 180px;
        color: #555;
        font-weight: bold;
        flex-shrink: 0;
    }

    .isi-profil {
        color: #333;
        overflow-wrap: anywhere;
    }

    /* ================= FORM CRUD ================= */

    .form-profil {
        margin-top: 30px;
        padding: 25px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 12px;
    }

    /* Tombol membuka form */
    .form-profil summary {
        display: inline-block;
        background-color: #2d6a4f;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
    }

    .form-profil summary:hover {
        background-color: #1b4332;
    }

    /* Kolom input */
    .input-profil {
        margin-top: 20px;
    }

    .input-profil label {
        display: block;
        margin-bottom: 8px;
        color: #2d6a4f;
        font-weight: bold;
    }

    .input-profil input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .input-profil input:focus {
        outline: none;
        border-color: #2d6a4f;
    }

    /* ================= TOMBOL ================= */

    .btn-simpan {
        background-color: #2d6a4f;
        color: white;
        padding: 12px 22px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
    }

    .btn-simpan:hover {
        background-color: #1b4332;
    }

    .btn-hapus {
        background-color: #e63946;
        color: white;
        padding: 12px 22px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 15px;
    }

    .btn-hapus:hover {
        background-color: #b71c1c;
    }

    /* ================= NOTIFIKASI ================= */

    .pesan-sukses {
        background-color: #d8f3dc;
        color: #1b4332;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .pesan-error {
        background-color: #ffe5e5;
        color: #b71c1c;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 600px) {

        .kotak-profil {
            padding: 20px;
        }

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

        .form-profil {
            padding: 15px;
        }
    }
</style>


<!-- ================= JUDUL HALAMAN ================= -->

<h1 class="judul-profil">Profil Guru</h1>

<p class="deskripsi-profil">
    Informasi identitas guru pada media pembelajaran BAKAWAN.
</p>


<!-- ================= NOTIFIKASI ================= -->

@if (session('success'))
    <div class="pesan-sukses">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="pesan-error">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="pesan-error">
        {{ $errors->first() }}
    </div>
@endif


<!-- ================= MENGAMBIL DATA GURU ================= -->

@php
    // Mengambil akun guru yang sedang login
    $guru = auth()->user();

    // Nama dan email dari tabel users
    $nama = $guru->name;
    $email = $guru->email;

    // Identitas dari tabel guru_profiles
    $nip = $profil?->nip_nuptk ?: 'Belum diisi';
    $sekolah = $profil?->sekolah ?: 'Belum diisi';
    $mataPelajaran = $profil?->mata_pelajaran ?: 'Belum diisi';
    $kelas = $profil?->kelas ?: 'Belum diisi';
@endphp


<!-- ================= KOTAK PROFIL ================= -->

<div class="kotak-profil">

    <!-- HEADER PROFIL -->

    <div class="profil-header">

        <div class="foto-profil">
            G
        </div>

        <div class="profil-nama">

            <h2>{{ $nama }}</h2>

            <p>{{ $email }}</p>

            <span class="status-guru">
                Guru BAKAWAN
            </span>

        </div>

    </div>


    <!-- ================= INFORMASI PRIBADI ================= -->

    <h3 class="judul-bagian">Informasi Pribadi</h3>

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


    <!-- ================= INFORMASI MENGAJAR ================= -->

    <h3 class="judul-bagian">Informasi Mengajar</h3>

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


    <!-- ================= FORM TAMBAH / EDIT PROFIL ================= -->

    <details class="form-profil"
        @if ($errors->any()) open @endif>

        <summary>
            {{ $profil ? 'Edit Profil' : 'Isi Profil Guru' }}
        </summary>

        <!-- Menyimpan atau mengubah profil -->
        <form
            action="{{ $profil ? route('profil.update') : route('profil.store') }}"
            method="POST">

            @csrf

            <!-- Jika profil sudah ada, gunakan UPDATE -->
            @if ($profil)
                @method('PUT')
            @endif


            <!-- NIP / NUPTK -->
            <div class="input-profil">

                <label for="nip_nuptk">
                    NIP / NUPTK
                </label>

                <input
                    type="text"
                    id="nip_nuptk"
                    name="nip_nuptk"
                    value="{{ old('nip_nuptk', $profil?->nip_nuptk) }}"
                    placeholder="Masukkan NIP atau NUPTK"
                    maxlength="50">

            </div>


            <!-- NAMA SEKOLAH -->
            <div class="input-profil">

                <label for="sekolah">
                    Nama Sekolah
                </label>

                <input
                    type="text"
                    id="sekolah"
                    name="sekolah"
                    value="{{ old('sekolah', $profil?->sekolah) }}"
                    placeholder="Masukkan nama sekolah"
                    maxlength="255">

            </div>


            <!-- MATA PELAJARAN -->
            <div class="input-profil">

                <label for="mata_pelajaran">
                    Mata Pelajaran
                </label>

                <input
                    type="text"
                    id="mata_pelajaran"
                    name="mata_pelajaran"
                    value="{{ old('mata_pelajaran', $profil?->mata_pelajaran) }}"
                    placeholder="Contoh: IPAS"
                    maxlength="100">

            </div>


            <!-- KELAS -->
            <div class="input-profil">

                <label for="kelas">
                    Kelas yang Diajar
                </label>

                <input
                    type="text"
                    id="kelas"
                    name="kelas"
                    value="{{ old('kelas', $profil?->kelas) }}"
                    placeholder="Contoh: V (Lima)"
                    maxlength="100">

            </div>


            <!-- TOMBOL SIMPAN -->

            <button type="submit" class="btn-simpan">
                {{ $profil ? 'Simpan Perubahan' : 'Simpan Profil' }}
            </button>

        </form>


        <!-- ================= HAPUS PROFIL ================= -->

        @if ($profil)

            <form
                action="{{ route('profil.destroy') }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus profil guru?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn-hapus">
                    Hapus Profil
                </button>

            </form>

        @endif

    </details>

</div>

@endsection
