
@extends('layouts.app-guru')

@section('content')

<style>
    .kelola-aktivitas {
        max-width: 1100px;
        margin: 30px auto;
        padding: 20px;
        font-family: 'Poppins', sans-serif;
        color: #185543;
    }

    .kelola-aktivitas h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .kelola-aktivitas h2 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .kotak {
        background: white;
        border: 1px solid #dce8e1;
        border-radius: 15px;
        padding: 25px;
        margin-top: 25px;
    }

    .form-aktivitas {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-aktivitas label {
        display: block;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-aktivitas input:not([type="checkbox"]),
    .form-aktivitas select,
    .form-aktivitas textarea {
        width: 100%;
        padding: 11px;
        border: 1px solid #cadbd3;
        border-radius: 8px;
        font-family: inherit;
    }

    .full {
        grid-column: 1 / -1;
    }

    .tombol {
        border: none;
        border-radius: 8px;
        padding: 11px 18px;
        color: white;
        background: #287558;
        font-weight: 600;
        cursor: pointer;
    }

    .tombol-hapus {
        background: #d34c55;
    }

    .pesan {
        padding: 14px;
        border-radius: 8px;
        margin-top: 15px;
        background: #e3f5e9;
    }

    .pesan-error {
        background: #ffe8e8;
        color: #a42d2d;
    }

    .item-aktivitas {
        border-bottom: 1px solid #e0e9e3;
        padding: 20px 0;
    }

    .info-aktivitas {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 15px;
    }

    .info-aktivitas img {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
    }

    .info-aktivitas p {
        margin: 5px 0;
    }

    .edit-form {
        background: #f6faf7;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 12px;
    }

    .edit-form summary {
        cursor: pointer;
        font-weight: 600;
    }

    @media (max-width: 650px) {
        .form-aktivitas {
            grid-template-columns: 1fr;
        }

        .info-aktivitas {
            align-items: flex-start;
        }
    }
</style>

<div class="kelola-aktivitas">

    <h1>Kelola Aktivitas Pembelajaran</h1>
    <p>Tambah, edit, dan hapus aktivitas yang akan ditampilkan kepada siswa.</p>

    <!-- PESAN BERHASIL -->
    @if(session('success'))
        <div class="pesan">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if(session('error'))
        <div class="pesan pesan-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="pesan pesan-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <!-- ===================================
         CREATE - TAMBAH AKTIVITAS
    =================================== -->

    <div class="kotak">

        <h2>Tambah Aktivitas Baru</h2>

        <form
            action="{{ route('guru.kelola-aktivitas.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="form-aktivitas">

                <div>
                    <label>Judul Aktivitas</label>
                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: Mengenal Rantai Makanan"
                        required>
                </div>

                <div>
                    <label>Jenis Aktivitas</label>
                    <select name="jenis" required>

                        <option value="drag_drop"
                            @selected(old('jenis') == 'drag_drop')>
                            Drag & Drop
                        </option>

                        <option value="mencocokkan"
                            @selected(old('jenis') == 'mencocokkan')>
                            Mencocokkan
                        </option>

                    </select>
                </div>

                <div class="full">
                    <label>Deskripsi Aktivitas</label>
                    <textarea
                        name="deskripsi"
                        rows="3"
                        placeholder="Tuliskan penjelasan singkat aktivitas">{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <label>Gambar Aktivitas</label>
                    <input
                        type="file"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp">
                </div>

                <div>
                    <label>Status Aktivitas</label>
                    <label>
                        <input
                            type="checkbox"
                            name="aktif"
                            value="1"
                            @checked(old('aktif', false))>
                        Aktif
                    </label>
                    <small>Aktifkan setelah isi permainan siap.</small>
                </div>

                <div class="full">
                    <button type="submit" class="tombol">
                        + Tambah Aktivitas
                    </button>
                </div>

            </div>
        </form>
    </div>


    <!-- ===================================
         READ - DAFTAR AKTIVITAS
    =================================== -->

    <div class="kotak">

        <h2>Daftar Aktivitas Pembelajaran</h2>

        @forelse($daftarAktivitas as $aktivitas)

            <div class="item-aktivitas">

                <div class="info-aktivitas">

                    @if($aktivitas->gambar)
                        <img
                            src="{{ asset('images/aktivitas/' . $aktivitas->gambar) }}"
                            alt="{{ $aktivitas->judul }}">
                    @endif

                    <div>
                        <strong>{{ $aktivitas->judul }}</strong>

                        <p>
                            Jenis:
                            {{ $aktivitas->jenis == 'drag_drop'
                                ? 'Drag & Drop'
                                : 'Mencocokkan' }}
                        </p>

                        <p>
                            {{ $aktivitas->deskripsi }}
                        </p>

                        <p>
                            Status:
                            <strong>
                                {{ $aktivitas->aktif
                                    ? 'Aktif'
                                    : 'Nonaktif' }}
                            </strong>
                        </p>
                    </div>

                </div>


                <!-- ===================================
                     UPDATE - EDIT AKTIVITAS
                =================================== -->

                <details class="edit-form">

                    <summary>Edit Aktivitas</summary>

                    <form
                        action="{{ route('guru.kelola-aktivitas.update', $aktivitas->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-aktivitas"
                             style="margin-top: 15px;">

                            <div>
                                <label>Judul Aktivitas</label>
                                <input
                                    type="text"
                                    name="judul"
                                    value="{{ $aktivitas->judul }}"
                                    required>
                            </div>

                            <div>
                                <label>Jenis Aktivitas</label>
                                <select name="jenis">

                                    <option value="drag_drop"
                                        @selected($aktivitas->jenis == 'drag_drop')>
                                        Drag & Drop
                                    </option>

                                    <option value="mencocokkan"
                                        @selected($aktivitas->jenis == 'mencocokkan')>
                                        Mencocokkan
                                    </option>

                                </select>
                            </div>

                            <div class="full">
                                <label>Deskripsi Aktivitas</label>
                                <textarea
                                    name="deskripsi"
                                    rows="3">{{ $aktivitas->deskripsi }}</textarea>
                            </div>

                            <div>
                                <label>Ganti Gambar (Opsional)</label>
                                <input
                                    type="file"
                                    name="gambar"
                                    accept=".jpg,.jpeg,.png,.webp">
                            </div>

                            <div>
                                <label>Status</label>
                                <label>
                                    <input
                                        type="checkbox"
                                        name="aktif"
                                        value="1"
                                        @checked($aktivitas->aktif)>
                                    Aktif
                                </label>
                            </div>

                            <div class="full">
                                <button type="submit" class="tombol">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </form>
                </details>


                <!-- ===================================
                     DELETE - HAPUS AKTIVITAS
                =================================== -->

                <form
                    action="{{ route('guru.kelola-aktivitas.destroy', $aktivitas->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="tombol tombol-hapus">
                        Hapus Aktivitas
                    </button>
                </form>

            </div>

        @empty

            <p>Belum ada aktivitas yang dibuat oleh guru.</p>

        @endforelse

    </div>

</div>

@endsection
