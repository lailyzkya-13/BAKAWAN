
@extends('layouts.app-guru')

@section('content')

<div class="materi-page">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h1>Materi Pembelajaran</h1>
            <p>Kelola materi pembelajaran IPAS untuk siswa kelas V.</p>
        </div>

        <button type="button" class="btn-tambah" onclick="openModal()">
            + Tambah Materi
        </button>
    </div>

    <!-- PESAN BERHASIL -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if($errors->any())
        <div class="alert-error">
            <strong>Materi gagal disimpan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- DAFTAR MATERI -->
    <div class="materi-container">

        @forelse($materi as $item)

            <div class="materi-card">

                <div class="materi-image">
                    @if($item->gambar)
                        <img
                            src="{{ asset('storage/' . $item->gambar) }}"
                            alt="{{ $item->judul }}">
                    @else
                        <img
                            src="{{ asset('images/ekosistem.jpeg') }}"
                            alt="Gambar Materi">
                    @endif
                </div>

                <div class="materi-content">

                    <span class="materi-label">
                        Materi {{ $loop->iteration }}
                    </span>

                    <h2>{{ $item->judul }}</h2>

                    <p>{{ $item->deskripsi }}</p>

                    <div class="materi-info">
                        <span>📚 IPAS Kelas V</span>

                        <span>
                            ⏱️ {{ $item->durasi ?: '20 Menit' }}
                        </span>
                    </div>

                    <div class="materi-action">

                        <a
                            href="{{ route('materi.show', $item->id) }}"
                            class="btn-lihat">
                            Lihat
                        </a>

                    </div>
                </div>
            </div>

        @empty

            <div class="materi-kosong">
                <h3>Belum ada materi</h3>
                <p>
                    Klik tombol Tambah Materi
                    untuk membuat materi pembelajaran.
                </p>
            </div>

        @endforelse

    </div>

</div>


<!-- MODAL TAMBAH MATERI -->
<div class="modal" id="materiModal">

    <form
        action="{{ route('materi.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="modal-content">

        @csrf

        <div class="modal-header">
            <div>
                <h2>Tambah Materi</h2>
                <p>Masukkan informasi materi pembelajaran.</p>
            </div>

            <button
                type="button"
                class="btn-close"
                onclick="closeModal()">
                &times;
            </button>
        </div>

        <!-- JUDUL -->
        <div class="form-group">
            <label for="judulMateri">Judul Materi</label>

            <input
                type="text"
                id="judulMateri"
                name="judul"
                value="{{ old('judul') }}"
                placeholder="Contoh: Mengenal Ekosistem"
                required>
        </div>

        <!-- DESKRIPSI -->
        <div class="form-group">
            <label for="deskripsiMateri">Deskripsi Materi</label>

            <textarea
                id="deskripsiMateri"
                name="deskripsi"
                placeholder="Masukkan deskripsi materi">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- ISI MATERI -->
        <div class="form-group">
            <label for="kontenMateri">Isi Materi</label>

            <textarea
                id="kontenMateri"
                name="konten"
                rows="6"
                placeholder="Tuliskan isi materi pembelajaran"
                required>{{ old('konten') }}</textarea>
        </div>

        <!-- GAMBAR -->
        <div class="form-group">
            <label for="gambarMateri">Gambar Materi</label>

            <input
                type="file"
                id="gambarMateri"
                name="gambar"
                accept=".jpg,.jpeg,.png">

            <small>
                Format JPG, JPEG atau PNG. Maksimal 2 MB.
            </small>
        </div>

        <!-- DURASI -->
        <div class="form-group">
            <label for="durasiMateri">Durasi Materi</label>

            <input
                type="text"
                id="durasiMateri"
                name="durasi"
                value="{{ old('durasi') }}"
                placeholder="Contoh: 20 Menit">
        </div>

        <!-- TOMBOL -->
        <div class="modal-footer">

            <button
                type="button"
                class="btn-batal"
                onclick="closeModal()">
                Batal
            </button>

            <button
                type="submit"
                class="btn-simpan">
                Simpan Materi
            </button>

        </div>
    </form>
</div>


<style>
    .materi-page {
        padding-bottom: 30px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 5px;
        color: #1b4332;
        font-size: 28px;
    }

    .page-header p {
        margin: 0;
        color: #777;
        font-size: 14px;
    }

    .btn-tambah {
        border: none;
        background: #2d6a4f;
        color: white;
        padding: 12px 18px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-tambah:hover {
        background: #1b4332;
    }

    .alert-success {
        background: #d8f3dc;
        color: #1b4332;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-error {
        background: #f8d7da;
        color: #842029;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .materi-container {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .materi-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        transition: 0.2s;
    }

    .materi-card:hover {
        transform: translateY(-3px);
    }

    .materi-image {
        height: 300px;
        background: #d8f3dc;
    }

    .materi-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .materi-content {
        padding: 20px;
    }

    .materi-label {
        display: inline-block;
        background: #d8f3dc;
        color: #2d6a4f;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .materi-content h2 {
        color: #1b4332;
        font-size: 20px;
        margin: 12px 0 8px;
    }

    .materi-content p {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
    }

    .materi-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 15px;
        color: #777;
        font-size: 12px;
    }

    .materi-action {
        display: flex;
        gap: 8px;
        margin-top: 18px;
    }

    .btn-lihat {
        display: inline-block;
        background: #e8f5e9;
        color: #2d6a4f;
        padding: 9px 15px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 13px;
    }

    .materi-kosong {
        grid-column: 1 / -1;
        background: white;
        padding: 35px;
        border-radius: 15px;
        text-align: center;
        color: #52796f;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        inset: 0;
        background: rgba(0,0,0,0.4);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-content {
        width: 500px;
        max-width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.15);
    }

    .modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 25px;
    }

    .modal-header h2 {
        margin: 0;
        color: #1b4332;
    }

    .modal-header p {
        margin: 5px 0 0;
        color: #999;
        font-size: 13px;
    }

    .btn-close {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #777;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        color: #374151;
        margin-bottom: 7px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #ddd;
        border-radius: 9px;
        outline: none;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #2d6a4f;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group small {
        display: block;
        margin-top: 5px;
        color: #999;
        font-size: 11px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-batal,
    .btn-simpan {
        border: none;
        padding: 11px 18px;
        border-radius: 9px;
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

    @media (max-width: 900px) {
        .materi-container {
            grid-template-columns: 1fr;
        }

        .page-header {
            flex-wrap: wrap;
        }
    }
</style>


<script>
    function openModal() {
        document.getElementById('materiModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('materiModal').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const adaError = @json($errors->any());

        if (adaError) {
            openModal();
        }
    });
</script>

@endsection
