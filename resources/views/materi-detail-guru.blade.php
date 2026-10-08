@extends('layouts.app-guru')

@section('content')

    <div class="detail-materi">

        <!-- TOMBOL KEMBALI -->
        <a href="{{ route('materi') }}" class="btn-kembali">
            ← Kembali ke Daftar Materi
        </a>

        <!-- KONTEN DETAIL -->
        <div class="detail-card">

            <!-- GAMBAR -->
            <div class="detail-gambar">
                @if($materi->gambar)
                    <img src="{{ asset('storage/' . $materi->gambar) }}" alt="{{ $materi->judul }}">
                @else
                    <img src="{{ asset('images/ekosistem.jpeg') }}" alt="Gambar Materi">
                @endif
            </div>

            <div class="detail-content">

                <span class="detail-label">
                    📚 IPAS Kelas V
                </span>

                <!-- JUDUL -->
                <h1>{{ $materi->judul }}</h1>

                <!-- DESKRIPSI -->
                <p class="detail-deskripsi">
                    {{ $materi->deskripsi }}
                </p>

                <div class="detail-info">
                    <span>
                        ⏱️ {{ $materi->durasi ?: '20 Menit' }}
                    </span>
                </div>

                <!-- ISI MATERI -->
                <h2>Isi Materi Pembelajaran</h2>

                <div class="isi-materi">
                    {{ $materi->konten }}
                </div>

            </div>
        </div>

    </div>


    <style>
        .detail-materi {
            padding: 10px 0 30px;
        }

        .btn-kembali {
            display: inline-block;
            text-decoration: none;
            color: #2d6a4f;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-kembali:hover {
            color: #1b4332;
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .detail-gambar {
            width: 100%;
            height: 320px;
            background: #d8f3dc;
        }

        .detail-gambar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-content {
            padding: 30px;
        }

        .detail-label {
            display: inline-block;
            background: #d8f3dc;
            color: #2d6a4f;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .detail-content h1 {
            color: #1b4332;
            font-size: 28px;
            margin: 20px 0 10px;
        }

        .detail-deskripsi {
            color: #666;
            line-height: 1.7;
        }

        .detail-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            color: #52796f;
            font-size: 14px;
            margin: 20px 0;
        }

        .detail-content hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 25px 0;
        }

        .detail-content h2 {
            color: #2d6a4f;
            font-size: 21px;
        }

        .isi-materi {
            color: #444;
            font-size: 15px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        @media (max-width: 768px) {
            .detail-gambar {
                height: 220px;
            }

            .detail-content {
                padding: 20px;
            }
        }
    </style>

@endsection