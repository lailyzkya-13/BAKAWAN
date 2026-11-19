@extends('layouts.app-guru')

@section('content')

    <style>
        .kelola-dua {
            max-width: 1100px;
            margin: 0 auto;
            color: #1b4332;
            font-family: 'Poppins', sans-serif;
        }


        .kelola-dua .kotak {
            background: white;
            border: 1px solid #dce8e1;
            border-radius: 14px;
            padding: 25px;
            margin-top: 22px;
        }

        .kelola-dua .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .kelola-dua .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .kelola-dua input:not([type="checkbox"]),
        .kelola-dua textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccdcd2;
            border-radius: 8px;
            font-family: inherit;
        }

        .kelola-dua .full {
            grid-column: 1 / -1;
        }


        .kelola-dua .tombol {
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            color: white;
            background: #2d6a4f;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            cursor: pointer;
        }


        .kelola-dua .hapus {
            background: #dc3545;
        }

        .kelola-dua .pesan {
            background: #d8f3dc;
            padding: 14px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .kelola-dua .pasangan-item {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
        }

        .kelola-dua .gambar-pasangan {
            display: flex;
            gap: 25px;
            align-items: center;
            margin-bottom: 15px;
        }

        .kelola-dua .gambar-pasangan img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .kelola-dua details {
            background: #f1f8f4;
            padding: 18px;
            border-radius: 10px;
            margin: 15px 0;
        }

        .kelola-dua summary {
            font-weight: bold;
            cursor: pointer;
        }

        @media(max-width: 700px) {
            .kelola-dua .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="kelola-dua">

        <a href="{{ route('guru.aktivitas.beranda') }}" style="color:#2d6a4f;text-decoration:none;font-weight:bold;">
            ← Kembali ke Daftar Aktivitas
        </a>

        <h1 style="margin-top:20px;">Kelola Aktivitas 2</h1>

        <p>Hubungan dalam Ekosistem</p>

        <p>
            Tambahkan pasangan objek yang akan digunakan
            siswa dalam permainan mencocokkan.
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

        <!-- CREATE -->
        <div class="kotak">

            <h2>Tambah Pasangan Baru</h2>

            <form action="{{ route('guru.aktivitas.dua.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Nama Objek Kiri</label>
                        <input type="text" name="objek_kiri" value="{{ old('objek_kiri') }}" placeholder="Contoh: Ikan"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Nama Pasangan Kanan</label>
                        <input type="text" name="objek_kanan" value="{{ old('objek_kanan') }}" placeholder="Contoh: Air"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Gambar Objek Kiri</label>
                        <input type="file" name="gambar_kiri" accept=".jpg,.jpeg,.png,.webp" required>
                    </div>

                    <div class="form-group">
                        <label>Gambar Pasangan Kanan</label>
                        <input type="file" name="gambar_kanan" accept=".jpg,.jpeg,.png,.webp" required>
                    </div>

                    <div class="form-group full">
                        <label>Penjelasan Hubungan</label>
                        <textarea name="hubungan" rows="3" placeholder="Contoh: Ikan membutuhkan air sebagai tempat hidup."
                            required>{{ old('hubungan') }}</textarea>
                    </div>

                    <div class="form-group full">
                        <label>Clue / Petunjuk Jawaban</label>
                        <textarea name="clue" rows="3" placeholder="Contoh: Di mana ikan biasanya hidup?"
                            required>{{ old('clue') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <label>
                            <input type="checkbox" name="aktif" value="1" @checked(old('aktif', '1') == '1')>
                            Aktif
                        </label>
                    </div>

                    <div class="full">
                        <button type="submit" class="tombol">
                            + Tambah Pasangan
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!-- READ -->
        <div class="kotak">

            <h2>Daftar Pasangan Ekosistem</h2>

            @forelse($daftarHubungan as $item)

                <div class="pasangan-item">

                    <div class="gambar-pasangan">

                        <div>
                            <img src="{{ asset('images/aktivitas/' . $item->gambar_kiri) }}" alt="{{ $item->objek_kiri }}">
                            <p><strong>{{ $item->objek_kiri }}</strong></p>
                        </div>

                        <strong>→</strong>

                        <div>
                            <img src="{{ asset('images/aktivitas/' . $item->gambar_kanan) }}" alt="{{ $item->objek_kanan }}">
                            <p><strong>{{ $item->objek_kanan }}</strong></p>
                        </div>

                    </div>

                    <p><strong>Hubungan:</strong> {{ $item->hubungan }}</p>
                    <p><strong>Clue:</strong> {{ $item->clue }}</p>
                    <p>
                        <strong>Status:</strong>
                        {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                    </p>

                    <!-- UPDATE -->
                    <details>
                        <summary>Edit Pasangan</summary>

                        <form action="{{ route('guru.aktivitas.dua.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="form-grid" style="margin-top:15px;">

                                <div class="form-group">
                                    <label>Objek Kiri</label>
                                    <input type="text" name="objek_kiri" value="{{ $item->objek_kiri }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Pasangan Kanan</label>
                                    <input type="text" name="objek_kanan" value="{{ $item->objek_kanan }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Ganti Gambar Kiri (Opsional)</label>
                                    <input type="file" name="gambar_kiri" accept=".jpg,.jpeg,.png,.webp">
                                </div>

                                <div class="form-group">
                                    <label>Ganti Gambar Kanan (Opsional)</label>
                                    <input type="file" name="gambar_kanan" accept=".jpg,.jpeg,.png,.webp">
                                </div>

                                <div class="form-group full">
                                    <label>Penjelasan Hubungan</label>
                                    <textarea name="hubungan" rows="3" required>{{ $item->hubungan }}</textarea>
                                </div>

                                <div class="form-group full">
                                    <label>Clue / Petunjuk</label>
                                    <textarea name="clue" rows="3" required>{{ $item->clue }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <label>
                                        <input type="checkbox" name="aktif" value="1" @checked($item->aktif)>
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

                    <!-- DELETE -->
                    <form action="{{ route('guru.aktivitas.dua.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus pasangan ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="tombol hapus">
                            Hapus Pasangan
                        </button>

                    </form>

                </div>

            @empty
                <p>Belum ada pasangan yang ditambahkan guru.</p>
            @endforelse

        </div>

    </div>

@endsection