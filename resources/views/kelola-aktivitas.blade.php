
@extends('layouts.app-guru')

@section('content')

<style>
    .guru-aktivitas {
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Poppins', Arial, sans-serif;
        color: #145545;
    }

    .guru-aktivitas .judul-halaman {
        text-align: center;
        margin-bottom: 38px;
    }

    .guru-aktivitas .judul-halaman h1 {
        font-size: 30px;
        font-weight: 800;
        color: #145545;
        margin-bottom: 12px;
    }

    .guru-aktivitas .judul-halaman p {
        color: #67827d;
        font-size: 14px;
    }

    .guru-aktivitas .aktivitas-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .guru-aktivitas .aktivitas-card {
        background: white;
        border: 1px solid #dce8e4;
        border-top: 4px solid var(--accent);
        border-radius: 22px;
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        min-height: 425px;
        box-shadow: 0 5px 20px rgba(28,70,58,0.04);
    }

    .guru-aktivitas .green {
        --accent: #2b7b61;
        --icon-bg: #e5f4eb;
    }

    .guru-aktivitas .blue {
        --accent: #50a4bf;
        --icon-bg: #e6f5f9;
    }

    .guru-aktivitas .pink {
        --accent: #ef5b7f;
        --icon-bg: #fde9ef;
    }

    .guru-aktivitas .card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .guru-aktivitas .card-icon {
        width: 64px;
        height: 64px;
        background: var(--icon-bg);
        border-radius: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .guru-aktivitas .card-icon img {
        width: 38px;
        height: 38px;
        object-fit: contain;
    }

    .guru-aktivitas .card-number {
        font-size: 27px;
        font-weight: 800;
        color: #d2dfdc;
    }

    .guru-aktivitas .card-type {
        font-size: 12px;
        font-weight: bold;
        color: #718b84;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .guru-aktivitas .aktivitas-card h2 {
        font-size: 19px;
        line-height: 1.5;
        font-weight: 800;
        color: #105244;
        min-height: 58px;
    }

    .guru-aktivitas .card-description {
        font-size: 13px;
        line-height: 1.8;
        color: #67827d;
        margin-top: 10px;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .guru-aktivitas .preview-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        background: #f7f9f8;
        padding: 14px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .guru-aktivitas .preview-icons img {
        width: 28px;
        height: 28px;
        object-fit: contain;
    }

    .guru-aktivitas .aktivitas-button {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--accent);
        padding: 15px;
        color: white;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
    }

    .guru-aktivitas .aktivitas-button:hover {
        filter: brightness(0.93);
        color: white;
    }

    .guru-aktivitas .button-disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }

    @media (max-width: 1100px) {
        .guru-aktivitas .aktivitas-grid {
            grid-template-columns: 1fr;
        }

        .guru-aktivitas .aktivitas-card {
            min-height: 0;
        }

        .guru-aktivitas .aktivitas-card h2 {
            min-height: 0;
        }
    }
</style>

<div class="guru-aktivitas">

    <!-- JUDUL -->
    <div class="judul-halaman">
        <h1>Kelola Aktivitas BAKAWAN</h1>
        <p>
            Pilih aktivitas yang ingin dikelola.
            Objek yang ditambahkan akan digunakan
            dalam permainan siswa.
        </p>
    </div>

    <!-- TIGA KARTU AKTIVITAS -->
    <div class="aktivitas-grid">

        <!-- AKTIVITAS 1 -->
        <article class="aktivitas-card green">

            <div class="card-top">
                <div class="card-icon">
                    <img
                        src="{{ asset('images/icons/drag-and-drop.png') }}"
                        alt="Drag and Drop"
                    >
                </div>

                <span class="card-number">01</span>
            </div>

            <div class="card-type">Drag & Drop</div>

            <h2>Klasifikasi Biotik & Abiotik</h2>

            <p class="card-description">
                Kelola objek biotik dan abiotik,
                gambar, kategori, serta penjelasan
                jawaban yang akan ditampilkan kepada siswa.
            </p>

            <div class="preview-icons">
                <img src="{{ asset('images/icons/fish.png') }}" alt="Ikan">
                <img src="{{ asset('images/icons/plant.png') }}" alt="Tumbuhan">
                <img src="{{ asset('images/icons/drop.png') }}" alt="Air">
                <img src="{{ asset('images/icons/sun.png') }}" alt="Matahari">
            </div>

            <a
                href="{{ route('guru.aktivitas.index') }}"
                class="aktivitas-button"
            >
                <span>Kelola Aktivitas 1</span>
                <span>→</span>
            </a>

        </article>


        <!-- AKTIVITAS 2 -->
        <article class="aktivitas-card blue">

            <div class="card-top">
                <div class="card-icon">
                    <img
                        src="{{ asset('images/icons/game.png') }}"
                        alt="Mencocokkan"
                    >
                </div>

                <span class="card-number">02</span>
            </div>

            <div class="card-type">Mencocokkan</div>

            <h2>Hubungan dalam Ekosistem</h2>

            <p class="card-description">
                Kelola pasangan objek, gambar,
                hubungan dalam ekosistem,
                serta petunjuk jawaban untuk siswa.
            </p>

            <div class="preview-icons">
                <img src="{{ asset('images/icons/fish.png') }}" alt="Ikan">
                <span>+</span>
                <img src="{{ asset('images/icons/drop.png') }}" alt="Air">
                <img src="{{ asset('images/icons/check.png') }}" alt="Benar">
            </div>

            <div class="aktivitas-button button-disabled">
                <span>CRUD belum dibuat</span>
                <span>02</span>
            </div>

        </article>


        <!-- AKTIVITAS 3 -->
        <article class="aktivitas-card pink">

            <div class="card-top">
                <div class="card-icon">
                    <img
                        src="{{ asset('images/icons/stork.png') }}"
                        alt="Si Bangau"
                    >
                </div>

                <span class="card-number">03</span>
            </div>

            <div class="card-type">Aktivitas Utama</div>

            <h2>Petualangan Si Bangau</h2>

            <p class="card-description">
                Kelola konten petualangan
                Si Bangau agar siswa dapat belajar
                tentang ekosistem lahan basah.
            </p>

            <div class="preview-icons">
                <img src="{{ asset('images/icons/stork.png') }}" alt="Bangau">
                <img src="{{ asset('images/icons/wetland.png') }}" alt="Rawa">
                <img src="{{ asset('images/icons/fish.png') }}" alt="Ikan">
                <img src="{{ asset('images/icons/flag.png') }}" alt="Selesai">
            </div>

            <div class="aktivitas-button button-disabled">
                <span>CRUD belum dibuat</span>
                <span>03</span>
            </div>

        </article>

    </div>

</div>

@endsection
