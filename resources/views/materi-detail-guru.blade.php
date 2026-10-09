
@extends('layouts.app-guru')

@section('content')

<div class="detail-materi">

    <!-- TOMBOL KEMBALI -->
    <a href="{{ route('materi') }}" class="btn-kembali">
        <== Kembali ke Daftar Materi
    </a>


    <!-- KARTU DETAIL MATERI -->
    <div class="detail-card">

        <!-- GAMBAR MATERI -->
        <div class="detail-gambar">

            @if($materi->gambar)

                <!-- Gambar yang diunggah guru -->
                <img
                    src="{{ asset('storage/' . $materi->gambar) }}"
                    alt="{{ $materi->judul }}">

            @else

                <!-- Jika tidak ada gambar -->
                <div class="detail-tanpa-gambar">
                    Tidak Ada Gambar
                </div>

            @endif

        </div>


        <!-- INFORMASI MATERI -->
        <div class="detail-content">

            <span class="detail-label">
                📚 IPAS Kelas V
            </span>

            <!-- JUDUL MATERI -->
            <h1>{{ $materi->judul }}</h1>

            <!-- DESKRIPSI MATERI -->
            @if($materi->deskripsi)
                <p class="detail-deskripsi">
                    {{ $materi->deskripsi }}
                </p>
            @endif

            <!-- DURASI MATERI -->
            <div class="detail-info">
                <span>
                    ⏱️ {{ $materi->durasi ?: '20 Menit' }}
                </span>
            </div>


            <!-- DAFTAR SUBBAB -->
            <h2>Subbab Materi Pembelajaran</h2>

            <div class="daftar-subbab">

                @forelse($materi->subbab->sortBy('urutan') as $subbab)

                    <div class="subbab-card">

                        <!-- NOMOR SUBBAB -->
                        <span class="subbab-label">
                            Subbab {{ $loop->iteration }}
                        </span>

                        <!-- JUDUL SUBBAB -->
                        <h3>{{ $subbab->judul }}</h3>


                        <!-- PENGANTAR SUBBAB -->
                        @if($subbab->pengantar)

                            <div class="subbab-pengantar">
                                {{ $subbab->pengantar }}
                            </div>

                        @endif


                        <!-- ISI SUBBAB -->
                        <div class="subbab-isi">
                            {{ $subbab->isi }}
                        </div>


                        <!-- CONTOH SEDERHANA -->
                        @if($subbab->contoh)

                            <div class="subbab-contoh">

                                <strong>Contoh Sederhana</strong>

                                <p>{{ $subbab->contoh }}</p>

                            </div>

                        @endif

                    </div>

                @empty

                    <!-- JIKA BELUM ADA SUBBAB -->
                    <div class="subbab-kosong">
                        Belum ada subbab pada materi ini.
                    </div>

                @endforelse

            </div>


            <!-- RINGKASAN MATERI -->
            @if($materi->ringkasan)

                <div class="ringkasan-materi">

                    <h2>Ringkasan Materi</h2>

                    <p>{{ $materi->ringkasan }}</p>

                </div>

            @endif

        </div>

    </div>

</div>


<style>

/*  HALAMAN DETAIL MATERI */

.detail-materi {
    padding: 10px 0 30px;
}


/* TOMBOL KEMBALI */
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


/* KARTU DETAIL */
.detail-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
}


/* GAMBAR MATERI */

.detail-gambar {
    width: 100%;
    height: 320px;
    background: #d8f3dc;
}

.detail-gambar img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* TAMPILAN JIKA TIDAK ADA GAMBAR */
.detail-tanpa-gambar {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f5e9;
    color: #2d6a4f;
    font-size: 16px;
    font-weight: 600;
}


/* INFORMASI MATERI */

.detail-content {
    padding: 30px;
}

/* LABEL KELAS */
.detail-label {
    display: inline-block;
    background: #d8f3dc;
    color: #2d6a4f;
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}

/* JUDUL MATERI */
.detail-content h1 {
    color: #1b4332;
    font-size: 28px;
    margin: 20px 0 10px;
}

/* DESKRIPSI */
.detail-deskripsi {
    color: #666;
    line-height: 1.7;
    white-space: pre-line;
    overflow-wrap: anywhere;
}

/* DURASI */
.detail-info {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    color: #52796f;
    font-size: 14px;
    margin: 20px 0;
}

/* JUDUL BAGIAN */
.detail-content h2 {
    color: #2d6a4f;
    font-size: 21px;
}


/* DAFTAR SUBBAB MATERI */

.daftar-subbab {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}


/* KARTU SETIAP SUBBAB */
.subbab-card {
    background: #f8fbf8;
    border: 1px solid #dce7df;
    border-radius: 12px;
    padding: 25px;
}


/* NOMOR SUBBAB */
.subbab-label {
    display: inline-block;
    background: #d8f3dc;
    color: #2d6a4f;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 12px;
}


/* JUDUL SUBBAB */
.subbab-card h3 {
    color: #1b4332;
    font-size: 20px;
    margin: 5px 0 15px;
    overflow-wrap: anywhere;
}


/* PENGANTAR SUBBAB */
.subbab-pengantar {
    color: #52796f;
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 18px;
    white-space: pre-line;
    overflow-wrap: anywhere;
}


/* ISI SUBBAB */
.subbab-isi {
    color: #444;
    font-size: 15px;
    line-height: 1.9;
    white-space: pre-line;
    overflow-wrap: anywhere;
}


/* CONTOH SEDERHANA */

.subbab-contoh {
    background: #e8f5e9;
    padding: 18px;
    border-left: 4px solid #2d6a4f;
    border-radius: 8px;
    margin-top: 20px;
}

.subbab-contoh strong {
    color: #1b4332;
    font-size: 14px;
}

.subbab-contoh p {
    margin: 10px 0 0;
    color: #444;
    line-height: 1.8;
    white-space: pre-line;
    overflow-wrap: anywhere;
}


/* RINGKASAN MATERI */

.ringkasan-materi {
    margin-top: 30px;
    padding: 25px;
    background: #f0f8f1;
    border-radius: 12px;
}

.ringkasan-materi h2 {
    margin-top: 0;
}

.ringkasan-materi p {
    color: #444;
    line-height: 1.8;
    white-space: pre-line;
    overflow-wrap: anywhere;
}


/* KONDISI BELUM ADA SUBBAB */

.subbab-kosong {
    padding: 20px;
    background: #f8faf9;
    border-radius: 10px;
    color: #777;
    text-align: center;
}


/* RESPONSIVE HP DAN TABLET */

@media (max-width: 768px) {

    .detail-gambar {
        height: 220px;
    }

    .detail-content {
        padding: 20px;
    }

    .detail-content h1 {
        font-size: 23px;
    }

    .detail-content h2 {
        font-size: 19px;
    }

    .subbab-card {
        padding: 18px;
    }

    .subbab-card h3 {
        font-size: 18px;
    }

    .ringkasan-materi {
        padding: 18px;
    }

}

</style>

@endsection
