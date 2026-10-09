
@extends('layouts.app-guru')

@section('content')

@php
    // Menentukan apakah halaman sedang Tambah atau Edit
    $edit = $materi->exists;

    // Mengambil data subbab ketika mengedit materi
    $subbabAwal = old(
        'subbab',
        $edit ? $materi->subbab->toArray() : []
    );

    // Jika materi baru, tampilkan satu subbab kosong
    if (empty($subbabAwal)) {
        $subbabAwal = [
            [
                'judul' => '',
                'pengantar' => '',
                'isi' => '',
                'contoh' => ''
            ]
        ];
    }
@endphp

<div class="form-materi-page">

    <!-- TOMBOL KEMBALI -->
    <a href="{{ route('materi') }}" class="btn-kembali">
        Kembali ke Daftar Materi
    </a>

    <!-- JUDUL HALAMAN -->
    <div class="page-header">
        <h1>
            {{ $edit ? 'Edit Materi' : 'Tambah Materi' }}
        </h1>

        <p>
            Lengkapi informasi materi pembelajaran IPAS kelas V.
        </p>
    </div>

    <!-- PESAN ERROR -->
    @if($errors->any())
        <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM MATERI -->
    <form
        action="{{ $edit
            ? route('materi.update', $materi->id)
            : route('materi.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @if($edit)
            @method('PUT')
        @endif

        <!-- ==========================
             INFORMASI MATERI
        =========================== -->
        <div class="form-card">

            <h2>Informasi Materi</h2>

            <!-- JUDUL MATERI -->
            <div class="form-group">
                <label for="judul">
                    Judul Materi
                </label>

                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{ old('judul', $materi->judul) }}"
                    placeholder="Contoh: Komponen Biotik dan Abiotik"
                    required
                >
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label for="deskripsi">
                    Deskripsi Materi
                </label>

                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="3"
                    placeholder="Tuliskan deskripsi singkat materi..."
                >{{ old('deskripsi', $materi->deskripsi) }}</textarea>
            </div>

            <!-- GAMBAR -->
            <div class="form-group">
                <label for="gambar">
                    Gambar Sampul Materi
                </label>

                @if($edit && $materi->gambar)
                    <div class="gambar-lama">
                        <img
                            src="{{ asset('storage/' . $materi->gambar) }}"
                            alt="{{ $materi->judul }}"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept=".jpg,.jpeg,.png"
                >

                <small>
                    Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                </small>
            </div>

            <!-- DURASI -->
            <div class="form-group">
                <label for="durasi">
                    Estimasi Durasi
                </label>

                <input
                    type="text"
                    id="durasi"
                    name="durasi"
                    value="{{ old('durasi', $materi->durasi) }}"
                    placeholder="Contoh: 20 Menit"
                >
            </div>

        </div>


        <!-- ==========================
             SUBBAB MATERI
        =========================== -->
        <div class="form-card">

            <div class="section-header">
                <div>
                    <h2>Subbab Materi</h2>

                    <p>
                        Tambahkan bagian pembelajaran yang
                        akan ditampilkan pada halaman siswa.
                    </p>
                </div>
            </div>

            <!-- TEMPAT SUBBAB -->
            <div id="daftar-subbab"></div>

            <!-- TOMBOL TAMBAH SUBBAB -->
            <button
                type="button"
                id="tambah-subbab"
                class="btn-tambah-subbab"
            >
                + Tambah Subbab
            </button>

        </div>


        <!-- ==========================
             RINGKASAN
        =========================== -->
        <div class="form-card">

            <h2>Ringkasan Materi</h2>

            <p class="keterangan">
                Tuliskan poin-poin penting dari materi
                yang telah dipelajari siswa.
            </p>

            <div class="form-group">
                <textarea
                    name="ringkasan"
                    rows="5"
                    placeholder="Tuliskan ringkasan materi..."
                >{{ old('ringkasan', $materi->ringkasan) }}</textarea>
            </div>

        </div>


        <!-- ==========================
             TOMBOL AKSI
        =========================== -->
        <div class="form-actions">

            <a
                href="{{ route('materi') }}"
                class="btn-batal"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn-simpan"
            >
                {{ $edit ? 'Simpan Perubahan' : 'Simpan Materi' }}
            </button>

        </div>

    </form>

</div>


<!-- ==================================
     TEMPLATE SUBBAB
=================================== -->
<template id="template-subbab">

    <div class="subbab-item">

        <div class="subbab-header">

            <h3 class="nomor-subbab">
                Subbab
            </h3>

            <button
                type="button"
                class="btn-hapus-subbab"
            >
                Hapus
            </button>

        </div>

        <!-- JUDUL SUBBAB -->
        <div class="form-group">
            <label>Judul Subbab</label>

            <input
                type="text"
                data-field="judul"
                placeholder="Contoh: Pengertian Ekosistem"
                required
            >
        </div>

        <!-- PENGANTAR -->
        <div class="form-group">
            <label>Pengantar Subbab</label>

            <textarea
                data-field="pengantar"
                rows="3"
                placeholder="Tuliskan kalimat pembuka subbab..."
            ></textarea>
        </div>

        <!-- ISI SUBBAB -->
        <div class="form-group">
            <label>Isi Subbab</label>

            <textarea
                data-field="isi"
                rows="6"
                placeholder="Tuliskan penjelasan materi pembelajaran..."
                required
            ></textarea>
        </div>

        <!-- CONTOH SEDERHANA -->
        <div class="form-group">
            <label>Contoh Sederhana</label>

            <textarea
                data-field="contoh"
                rows="3"
                placeholder="Tuliskan contoh sederhana agar mudah dipahami siswa..."
            ></textarea>
        </div>

    </div>

</template>


<!-- ==================================
     CSS FORM MATERI
=================================== -->
<style>

    .form-materi-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 10px 0 40px;
    }

    /* TOMBOL KEMBALI */
    .btn-kembali {
        display: inline-block;
        color: #2d6a4f;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-kembali:hover {
        color: #1b4332;
    }

    /* HEADER */
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        color: #1b4332;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .page-header p {
        color: #777;
        font-size: 14px;
        margin: 0;
    }

    /* KARTU FORM */
    .form-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 22px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
    }

    .form-card h2 {
        color: #1b4332;
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 20px;
    }

    .section-header p,
    .keterangan {
        color: #777;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    /* INPUT */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #344054;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ddd;
        border-radius: 9px;
        font-family: inherit;
        font-size: 13px;
        color: #344054;
        background: #fff;
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
        line-height: 1.7;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #2d6a4f;
    }

    .form-group small {
        display: block;
        color: #999;
        font-size: 11px;
        margin-top: 7px;
    }

    /* PREVIEW GAMBAR */
    .gambar-lama {
        margin-bottom: 12px;
    }

    .gambar-lama img {
        width: 200px;
        max-height: 150px;
        object-fit: cover;
        border-radius: 10px;
    }

    /* SUBBAB */
    .subbab-item {
        background: #f8fbf8;
        border: 1px solid #dce7df;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 18px;
    }

    .subbab-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .subbab-header h3 {
        color: #1b4332;
        font-size: 17px;
        font-weight: 700;
        margin: 0;
    }

    /* HAPUS SUBBAB */
    .btn-hapus-subbab {
        background: #ffe0e5;
        color: #b42342;
        border: none;
        border-radius: 8px;
        padding: 9px 14px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-hapus-subbab:hover {
        background: #ffc7d1;
    }

    /* TAMBAH SUBBAB */
    .btn-tambah-subbab {
        width: 100%;
        background: #e8f5e9;
        color: #2d6a4f;
        border: 1px dashed #2d6a4f;
        border-radius: 10px;
        padding: 14px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-tambah-subbab:hover {
        background: #d8f3dc;
    }

    /* TOMBOL AKSI */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-batal,
    .btn-simpan {
        display: inline-block;
        border: none;
        border-radius: 9px;
        padding: 13px 22px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-batal {
        background: #eee;
        color: #555;
    }

    .btn-simpan {
        background: #2d6a4f;
        color: white;
    }

    .btn-simpan:hover {
        background: #1b4332;
    }

    /* PESAN ERROR */
    .alert-error {
        background: #ffe0e5;
        color: #92263f;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .form-card {
            padding: 18px;
        }

        .page-header h1 {
            font-size: 23px;
        }

        .subbab-item {
            padding: 16px;
        }

        .form-actions {
            flex-wrap: wrap;
        }

        .btn-batal,
        .btn-simpan {
            flex: 1;
            text-align: center;
        }
    }

</style>


<!-- ==================================
     JAVASCRIPT TAMBAH / HAPUS SUBBAB
=================================== -->
<script>

document.addEventListener('DOMContentLoaded', function () {

    // Mengambil elemen dari HTML
    const daftar = document.getElementById('daftar-subbab');
    const template = document.getElementById('template-subbab');
    const tombolTambah = document.getElementById('tambah-subbab');

    // Data awal dari Laravel
    const dataAwal = @json(array_values($subbabAwal));


    // Mengatur nomor subbab
    function aturNomor() {

        const semuaSubbab = daftar.querySelectorAll('.subbab-item');

        semuaSubbab.forEach(function (item, index) {

            // Mengubah tulisan nomor subbab
            item.querySelector('.nomor-subbab').textContent =
                'Subbab ' + (index + 1);

            // Mengatur nama input untuk dikirim ke Laravel
            item.querySelectorAll('[data-field]').forEach(function (input) {

                const namaField = input.dataset.field;

                input.name = 'subbab[' + index + '][' + namaField + ']';

            });

        });

    }


    // Fungsi menambahkan subbab
    function tambahSubbab(data = {}) {

        // Menyalin template subbab
        const salinan = template.content.cloneNode(true);

        const item = salinan.querySelector('.subbab-item');

        // Mengisi data jika sedang edit
        item.querySelectorAll('[data-field]').forEach(function (input) {

            const namaField = input.dataset.field;

            input.value = data[namaField] ?? '';

        });


        // Tombol hapus subbab
        item.querySelector('.btn-hapus-subbab')
            .addEventListener('click', function () {

                // Minimal satu subbab
                if (daftar.children.length <= 1) {

                    alert('Minimal harus ada satu subbab.');
                    return;

                }

                item.remove();

                // Memperbarui nomor setelah dihapus
                aturNomor();

            });


        // Menambahkan subbab ke halaman
        daftar.appendChild(item);

        // Memperbarui nomor subbab
        aturNomor();

    }


    // Menampilkan subbab ketika halaman pertama dibuka
    dataAwal.forEach(function (data) {

        tambahSubbab(data);

    });


    // Ketika guru menekan tombol Tambah Subbab
    tombolTambah.addEventListener('click', function () {

        tambahSubbab();

    });

});

</script>

@endsection
