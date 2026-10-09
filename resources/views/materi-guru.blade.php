@extends('layouts.app-guru')

@section('content')

    <div class="materi-page">

        <!-- HEADER -->
        <div class="page-header">
            <div>
                <h1>Materi Pembelajaran</h1>
                <p>Kelola materi pembelajaran IPAS untuk siswa kelas V.</p>
            </div>

            <!-- TOMBOL TAMBAH MATERI -->
            <a href="{{ route('materi.create') }}" class="btn-tambah">
                + Tambah Materi
            </a>
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
                <strong>Terjadi kesalahan:</strong>
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

                    <!-- GAMBAR MATERI -->
                    <div class="materi-image">

                        @if($item->gambar)

                            <!-- Jika guru mengunggah gambar -->
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">

                        @else

                            <!-- Jika guru tidak mengunggah gambar -->
                            <div class="materi-no-image">
                                <p>Tidak Ada Gambar</p>
                            </div>

                        @endif

                    </div>


                    <!-- KONTEN KARTU -->
                    <div class="materi-content">

                        <span class="materi-label">
                            Materi {{ $loop->iteration }}
                        </span>

                        <h2>{{ $item->judul }}</h2>

                        <p>{{ $item->deskripsi }}</p>

                        <!-- INFORMASI MATERI -->
                        <div class="materi-info">
                            <span>📚 IPAS Kelas V</span>

                            <span>
                                ⏱️ {{ $item->durasi ?: '20 Menit' }}
                            </span>
                        </div>


                        <!-- TOMBOL AKSI -->
                        <div class="materi-action">

                            <!-- LIHAT -->
                            <a href="{{ route('materi.show', $item->id) }}" class="btn-lihat">
                                Lihat
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('materi.edit', $item->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <!-- HAPUS -->
                            <form action="{{ route('materi.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus materi ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-hapus">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <!-- JIKA BELUM ADA MATERI -->
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


    <style>
        /* HALAMAN UTAMA */
        .materi-page {
            padding-bottom: 30px;
        }


        /* HEADER */
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


        /* TOMBOL TAMBAH */
        .btn-tambah {
            display: inline-block;
            flex-shrink: 0;
            border: none;
            background: #2d6a4f;
            color: white;
            padding: 12px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-tambah:hover {
            background: #1b4332;
            color: white;
        }


        /* PESAN */
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


        /* GRID MATERI */
        .materi-container {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }


        /* CARD MATERI */
        .materi-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            transition: 0.2s;
            min-width: 0;
        }

        .materi-card:hover {
            transform: translateY(-3px);
        }


        /* GAMBAR */
        .materi-image {
            height: 300px;
            background: #d8f3dc;
        }

        .materi-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* KONTEN */
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
            overflow-wrap: anywhere;
        }

        .materi-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }


        /* INFORMASI */
        .materi-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 15px;
            color: #777;
            font-size: 12px;
        }


        /* TOMBOL LIHAT, EDIT, HAPUS */
        .materi-action {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 18px;
        }

        .materi-action form {
            margin: 0;
        }

        .btn-lihat,
        .btn-edit,
        .btn-hapus {
            display: inline-block;
            padding: 9px 15px;
            border-radius: 7px;
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-lihat {
            background: #e8f5e9;
            color: #2d6a4f;
        }

        .btn-lihat:hover {
            background: #d8f3dc;
            color: #1b4332;
        }

        .btn-edit {
            background: #fff1d6;
            color: #946200;
        }

        .btn-edit:hover {
            background: #ffe3a4;
            color: #805400;
        }

        .btn-hapus {
            background: #ffe0e5;
            color: #b42342;
        }

        .btn-hapus:hover {
            background: #ffc7d1;
            color: #9c1733;
        }


        /* KONDISI KOSONG */
        .materi-kosong {
            grid-column: 1 / -1;
            background: white;
            padding: 35px;
            border-radius: 15px;
            text-align: center;
            color: #52796f;
        }

        .materi-kosong h3 {
            color: #1b4332;
            font-size: 20px;
        }


        /* RESPONSIVE TABLET */
        @media (max-width: 900px) {

            .materi-container {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-wrap: wrap;
            }

            .materi-image {
                height: 260px;
            }
        }


        /* RESPONSIVE HP */
        @media (max-width: 480px) {

            .page-header h1 {
                font-size: 23px;
            }

            .page-header p {
                font-size: 13px;
            }

            .btn-tambah {
                width: 100%;
                text-align: center;
            }

            .materi-image {
                height: 210px;
            }

            .materi-content {
                padding: 16px;
            }

            .materi-content h2 {
                font-size: 18px;
            }

            .materi-info {
                gap: 10px;
            }
        }
    </style>

@endsection