
@extends('layouts.app-guru')

@section('content')

<style>
    .kelola-objek {
        max-width: 1100px;
        margin: auto;
        color: #1b4332;
    }

    .kelola-objek .kotak {
        background: white;
        padding: 25px;
        border-radius: 12px;
        margin-top: 25px;
        border: 1px solid #ddd;
    }

    .kelola-objek .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .kelola-objek label {
        display: block;
        font-weight: bold;
        margin-bottom: 6px;
    }

    .kelola-objek input:not([type="checkbox"]),
    .kelola-objek select,
    .kelola-objek textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    .kelola-objek .full {
        grid-column: 1 / -1;
    }

    .kelola-objek button {
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        background: #2d6a4f;
        color: white;
        cursor: pointer;
    }

    .kelola-objek .hapus {
        background: #dc3545;
    }

    .kelola-objek .item {
        padding: 20px 0;
        border-bottom: 1px solid #ddd;
    }

    .kelola-objek .item img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
    }

    .kelola-objek details {
        background: #f1f8f4;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
    }

    .kelola-objek summary {
        cursor: pointer;
        font-weight: bold;
    }

    .kelola-objek .pesan {
        padding: 12px;
        background: #d8f3dc;
        margin-top: 15px;
        border-radius: 8px;
    }

    @media(max-width: 650px) {
        .kelola-objek .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="kelola-objek">

    <h1>Kelola Aktivitas 1</h1>

    <p>
        Klasifikasi Biotik & Abiotik
    </p>

    <p>
        Tambahkan, edit, atau hapus objek yang
        akan digunakan siswa dalam permainan.
    </p>

    <!-- PESAN BERHASIL -->
    @if(session('success'))
        <div class="pesan">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if($errors->any())
        <div class="pesan" style="background:#ffe5e5;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <!-- CREATE: TAMBAH OBJEK -->

    <div class="kotak">

        <h2>Tambah Objek Baru</h2>

        <form
            action="{{ route('guru.aktivitas.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="form-grid">

                <div>
                    <label>Nama Objek</label>

                    <input
                        type="text"
                        name="nama_objek"
                        placeholder="Contoh: Katak"
                        value="{{ old('nama_objek') }}"
                        required
                    >
                </div>

                <div>
                    <label>Kategori</label>

                    <select name="kategori" required>

                        <option value="biotik">
                            Biotik
                        </option>

                        <option value="abiotik">
                            Abiotik
                        </option>

                    </select>
                </div>

                <div class="full">

                    <label>Penjelasan Jawaban</label>

                    <textarea
                        name="penjelasan"
                        rows="3"
                        required
                    >{{ old('penjelasan') }}</textarea>

                </div>

                <div>

                    <label>Gambar Objek</label>

                    <input
                        type="file"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                        required
                    >

                </div>

                <div>

                    <label>Status</label>

                    <label>
                        <input
                            type="checkbox"
                            name="aktif"
                            value="1"
                            checked
                        >
                        Aktif
                    </label>

                </div>

                <div class="full">

                    <button type="submit">
                        + Tambah Objek
                    </button>

                </div>

            </div>

        </form>

    </div>


    <!-- READ: DAFTAR OBJEK -->

    <div class="kotak">

        <h2>Daftar Objek Aktivitas</h2>

        @forelse($daftarObjek as $objek)

            <div class="item">

                <img
                    src="{{ asset('images/aktivitas/' . $objek->gambar) }}"
                    alt="{{ $objek->nama_objek }}"
                >

                <h3>{{ $objek->nama_objek }}</h3>

                <p>
                    Kategori:
                    {{ ucfirst($objek->kategori) }}
                </p>

                <p>
                    Penjelasan:
                    {{ $objek->penjelasan }}
                </p>

                <p>
                    Status:
                    {{ $objek->aktif ? 'Aktif' : 'Nonaktif' }}
                </p>


                <!-- UPDATE: EDIT OBJEK -->

                <details>

                    <summary>Edit Objek</summary>

                    <form
                        action="{{ route('guru.aktivitas.update', $objek->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')

                        <div class="form-grid" style="margin-top:15px;">

                            <div>

                                <label>Nama Objek</label>

                                <input
                                    type="text"
                                    name="nama_objek"
                                    value="{{ $objek->nama_objek }}"
                                    required
                                >

                            </div>

                            <div>

                                <label>Kategori</label>

                                <select name="kategori">

                                    <option
                                        value="biotik"
                                        @selected($objek->kategori == 'biotik')
                                    >
                                        Biotik
                                    </option>

                                    <option
                                        value="abiotik"
                                        @selected($objek->kategori == 'abiotik')
                                    >
                                        Abiotik
                                    </option>

                                </select>

                            </div>

                            <div class="full">

                                <label>Penjelasan</label>

                                <textarea
                                    name="penjelasan"
                                    rows="3"
                                    required
                                >{{ $objek->penjelasan }}</textarea>

                            </div>

                            <div>

                                <label>Ganti Gambar</label>

                                <input
                                    type="file"
                                    name="gambar"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                            </div>

                            <div>

                                <label>Status</label>

                                <label>
                                    <input
                                        type="checkbox"
                                        name="aktif"
                                        value="1"
                                        @checked($objek->aktif)
                                    >
                                    Aktif
                                </label>

                            </div>

                            <div class="full">

                                <button type="submit">
                                    Simpan Perubahan
                                </button>

                            </div>

                        </div>

                    </form>

                </details>


                <!-- DELETE: HAPUS OBJEK -->

                <form
                    action="{{ route('guru.aktivitas.destroy', $objek->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus objek ini?')"
                >

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="hapus">
                        Hapus Objek
                    </button>

                </form>

            </div>

        @empty

            <p>
                Belum ada objek yang ditambahkan guru.
            </p>

        @endforelse

    </div>

</div>

@endsection
    