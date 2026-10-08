
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aktivitas - BAKAWAN</title>

    <!-- GOOGLE FONT -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- HEADER CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #fffaf4;
            color: #124f43;
        }

        /* =====================================
           SECTION AKTIVITAS
        ===================================== */

        .aktivitas-section {
            padding: 65px 24px 90px;
        }

        .aktivitas-container {
            max-width: 1328px;
            margin: 0 auto;
        }

        .aktivitas-heading {
            text-align: center;
            margin-bottom: 48px;
        }

        .aktivitas-heading h1 {
            font-size: 36px;
            font-weight: 800;
            color: #145545;
            margin-bottom: 12px;
        }

        .aktivitas-heading p {
            font-size: 16px;
            color: #65807b;
            margin: 0;
        }

        /* =====================================
           GRID CARD
        ===================================== */

        .aktivitas-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
            align-items: stretch;
        }

        .aktivitas-card {
            background: #ffffff;
            border: 1px solid #dce8e4;
            border-top: 5px solid var(--accent);
            border-radius: 26px;
            padding: 34px 30px 28px;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 540px;
            box-shadow: 0 10px 30px rgba(28, 70, 58, 0.04);
        }

        .aktivitas-card.green {
            --accent: #2b7b61;
            --icon-bg: #e5f4eb;
        }

        .aktivitas-card.blue {
            --accent: #50a4bf;
            --icon-bg: #e6f5f9;
        }

        .aktivitas-card.pink {
            --accent: #ef5b7f;
            --icon-bg: #fde9ef;
        }

        /* =====================================
           IKON UTAMA CARD
        ===================================== */

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 22px;
        }

        .card-icon {
            width: 74px;
            height: 74px;
            border-radius: 21px;
            background: var(--icon-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }

        .card-icon img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .card-number {
            font-size: 30px;
            font-weight: 800;
            color: #d2dfdc;
            line-height: 1;
        }

        .card-type {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #718b84;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        /* =====================================
           JUDUL DAN DESKRIPSI SEJAJAR
        ===================================== */

        .aktivitas-card h2 {
            font-size: 23px;
            font-weight: 800;
            line-height: 1.4;
            color: #105244;
            min-height: 65px;
            margin-bottom: 12px;
        }

        .card-description {
            font-size: 16px;
            line-height: 1.85;
            color: #67827d;
            min-height: 100px;
            margin-bottom: 16px;
        }

        /* =====================================
           KOTAK IKON KECIL
        ===================================== */

        .preview-icons {
            width: 100%;
            min-height: 70px;
            background: #f7f9f8;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 14px;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .preview-icons img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .preview-icons .symbol {
            color: #165446;
            font-size: 22px;
            font-weight: 600;
            line-height: 1;
        }

        /* =====================================
           TOMBOL AKTIVITAS
        ===================================== */

        .aktivitas-button {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: auto;
            padding: 17px 22px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 13px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-align: left;
            cursor: pointer;
            transition: transform 0.2s, opacity 0.2s;
        }

        .aktivitas-button:hover {
            color: white;
            opacity: 0.92;
            transform: translateY(-2px);
        }

        .button-arrow {
            font-size: 23px;
            font-weight: 400;
        }

        /* =====================================
           POP-UP PENGEMBANGAN
        ===================================== */

        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(12, 47, 40, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
        }

        .popup-overlay.active {
            display: flex;
        }

        .popup-box {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 24px;
            padding: 36px 30px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .popup-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #fde9ef;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-icon img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .popup-box h3 {
            font-size: 23px;
            font-weight: 800;
            color: #145545;
            margin-bottom: 12px;
        }

        .popup-box p {
            font-size: 15px;
            line-height: 1.8;
            color: #67827d;
            margin-bottom: 24px;
        }

        .popup-close {
            background: #ef5b7f;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 35px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .popup-close:hover {
            background: #dc496d;
        }

        /* =====================================
           RESPONSIF TABLET
        ===================================== */

        @media (max-width: 1050px) {
            .aktivitas-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* =====================================
           RESPONSIF HP
        ===================================== */

        @media (max-width: 700px) {
            .aktivitas-section {
                padding: 42px 16px 65px;
            }

            .aktivitas-heading h1 {
                font-size: 27px;
            }

            .aktivitas-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .aktivitas-card {
                min-height: 0;
                padding: 26px 24px;
            }

            .aktivitas-card h2 {
                font-size: 21px;
                min-height: auto;
            }

            .card-description {
                min-height: auto;
            }

            .preview-icons {
                gap: 16px;
            }

            .popup-box {
                padding: 30px 22px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    @include('components.header')

    <!-- HALAMAN AKTIVITAS -->
    <main class="aktivitas-section">
        <div class="aktivitas-container">

            <div class="aktivitas-heading">
                <h1>Aktivitas Seru BAKAWAN</h1>
                <p>
                    Yuk, belajar tentang ekosistem melalui
                    aktivitas yang seru dan menyenangkan.
                </p>
            </div>

            <div class="aktivitas-grid">

                <!-- =====================================
                     CARD 1: KLASIFIKASI
                ===================================== -->

                <article class="aktivitas-card green">

                    <div class="card-top">
                        <div class="card-icon">
                            <img
                                src="{{ asset('images/icons/drag-and-drop.png') }}"
                                alt="Ikon klasifikasi"
                            >
                        </div>

                        <span class="card-number">01</span>
                    </div>

                    <div class="card-type">
                        Drag & Drop
                    </div>

                    <h2>Klasifikasi Biotik & Abiotik</h2>

                    <p class="card-description">
                        Kelompokkan berbagai objek ke dalam
                        komponen biotik atau abiotik dengan tepat.
                    </p>

                    <div class="preview-icons">
                        <img
                            src="{{ asset('images/icons/fish.png') }}"
                            alt="Ikan"
                        >

                        <img
                            src="{{ asset('images/icons/plant.png') }}"
                            alt="Tumbuhan"
                        >

                        <img
                            src="{{ asset('images/icons/drop.png') }}"
                            alt="Air"
                        >

                        <img
                            src="{{ asset('images/icons/sun.png') }}"
                            alt="Matahari"
                        >
                    </div>

                    <a
                        href="{{ route('aktivitas.satu') }}"
                        class="aktivitas-button"
                    >
                        <span>Mulai Aktivitas</span>
                        <span class="button-arrow">→</span>
                    </a>

                </article>

                <!-- =====================================
                     CARD 2: HUBUNGAN EKOSISTEM
                ===================================== -->

                <article class="aktivitas-card blue">

                    <div class="card-top">
                        <div class="card-icon">
                            <img
                                src="{{ asset('images/icons/game.png') }}"
                                alt="Ikon mencocokkan"
                            >
                        </div>

                        <span class="card-number">02</span>
                    </div>

                    <div class="card-type">
                        Mencocokkan
                    </div>

                    <h2>Hubungan dalam Ekosistem</h2>

                    <p class="card-description">
                        Cocokkan makhluk hidup dengan komponen
                        lingkungan yang memiliki hubungan dengannya.
                    </p>

                    <div class="preview-icons">
                        <img
                            src="{{ asset('images/icons/fish.png') }}"
                            alt="Ikan"
                        >

                        <span class="symbol">+</span>

                        <img
                            src="{{ asset('images/icons/drop.png') }}"
                            alt="Air"
                        >

                        <img
                            src="{{ asset('images/icons/check.png') }}"
                            alt="Benar"
                        >
                    </div>

                    <a
                        href="{{ route('aktivitas.dua') }}"
                        class="aktivitas-button"
                    >
                        <span>Mulai Aktivitas</span>
                        <span class="button-arrow">→</span>
                    </a>

                </article>

                <!-- =====================================
                     CARD 3: PETUALANGAN SI BANGAU
                ===================================== -->

                <article class="aktivitas-card pink">

                    <div class="card-top">
                        <div class="card-icon">
                            <img
                                src="{{ asset('images/icons/stork.png') }}"
                                alt="Ikon petualangan Si Bangau"
                            >
                        </div>

                        <span class="card-number">03</span>
                    </div>

                    <div class="card-type">
                        Game Utama
                    </div>

                    <h2>Petualangan Si Bangau</h2>

                    <p class="card-description">
                        Ikuti petualangan Si Bangau sambil
                        mengenali ekosistem lahan basah Banua.
                    </p>

                    <div class="preview-icons">
                        <img
                            src="{{ asset('images/icons/stork.png') }}"
                            alt="Bangau"
                        >

                        <img
                            src="{{ asset('images/icons/wetland.png') }}"
                            alt="Tumbuhan rawa"
                        >

                        <img
                            src="{{ asset('images/icons/fish.png') }}"
                            alt="Ikan"
                        >

                        <img
                            src="{{ asset('images/icons/flag.png') }}"
                            alt="Bendera selesai"
                        >
                    </div>

                    <button
                        type="button"
                        class="aktivitas-button"
                        onclick="tampilkanPengembangan()"
                    >
                        <span>Mulai Bermain</span>
                        <span class="button-arrow">→</span>
                    </button>

                </article>

            </div>
        </div>
    </main>

    <!-- =====================================
         POP-UP MASIH DALAM PENGEMBANGAN
    ===================================== -->

    <div
        class="popup-overlay"
        id="popupPengembangan"
        role="dialog"
        aria-modal="true"
        aria-labelledby="judulPopup"
        aria-hidden="true"
        onclick="tutupJikaKlikLuar(event)"
    >
        <div class="popup-box">

            <div class="popup-icon">
                <img
                    src="{{ asset('images/icons/stork.png') }}"
                    alt="Si Bangau"
                >
            </div>

            <h3 id="judulPopup">
                Petualangan Si Bangau
            </h3>

            <p>
                Masih dalam tahap pengembangan.
                Nantikan petualangan seru Si Bangau
                di BAKAWAN!
            </p>

            <button
                type="button"
                class="popup-close"
                onclick="tutupPengembangan()"
            >
                Mengerti
            </button>

        </div>
    </div>

    <!-- JAVASCRIPT POP-UP -->
    <script>
        const popupPengembangan =
            document.getElementById('popupPengembangan');

        function tampilkanPengembangan() {
            popupPengembangan.classList.add('active');
            popupPengembangan.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            popupPengembangan.querySelector('.popup-close').focus();
        }

        function tutupPengembangan() {
            popupPengembangan.classList.remove('active');
            popupPengembangan.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function tutupJikaKlikLuar(event) {
            if (event.target === popupPengembangan) {
                tutupPengembangan();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (
                event.key === 'Escape' &&
                popupPengembangan.classList.contains('active')
            ) {
                tutupPengembangan();
            }
        });
    </script>

</body>
</html>