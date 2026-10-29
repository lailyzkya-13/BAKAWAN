<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Materi Pembelajaran | BAKAWAN</title>

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- GOOGLE FONT -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS HEADER -->
    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}">

    <style>

        /* ==============================
           HALAMAN MATERI
        ============================== */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #fffaf4;
            font-family: 'Poppins', sans-serif;
        }

        .materi-page {
            min-height: calc(100vh - 80px);
            padding: 52px 20px 80px;
            background: #fffaf4;
        }

        .materi-container {
            max-width: 950px;
            margin: 0 auto;
        }


        /* ==============================
           JUDUL HALAMAN
        ============================== */

        .materi-heading {
            text-align: center;
            margin-bottom: 48px;
        }

        .materi-heading h1 {
            color: #214b40;
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .materi-heading h1 span {
            color: #e95b7c;
        }

        .materi-heading p {
            color: #64776c;
            font-size: 14px;
            margin: 0;
        }


        /* ==============================
           DAFTAR KARTU
        ============================== */

        .materi-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .materi-card {
            background: #dceee2;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }


        /* ==============================
           GAMBAR KARTU
        ============================== */

        .materi-card-image {
            width: 100%;
            height: 177px;
            overflow: hidden;
        }

        .materi-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .materi-no-image {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #c7e6d3;
            color: #52796f;
            font-size: 13px;
        }


        /* ==============================
           ISI KARTU
        ============================== */

        .materi-card-content {
            padding: 19px 33px 22px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .materi-number {
            width: 34px;
            height: 34px;
            border-radius: 5px;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #247259;
            color: white;

            font-size: 14px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .materi-number.pink {
            background: #e95b7c;
        }

        .materi-card h2 {
            color: #174e40;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.5;
            margin-bottom: 8px;
            overflow-wrap: anywhere;
        }

        .materi-card p {
            color: #64776c;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 18px;
            overflow-wrap: anywhere;
        }


        /* ==============================
           TOMBOL PELAJARI MATERI
        ============================== */

        .materi-card-action {
            display: flex;
            justify-content: center;
            margin-top: auto;
        }

        .btn-pelajari-materi {
            min-width: 137px;
            min-height: 40px;

            display: inline-flex;
            justify-content: center;
            align-items: center;

            padding: 10px 18px;

            background: #e95b7c;
            color: white;

            border: none;
            border-radius: 8px;

            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 700;

            text-decoration: none;
            cursor: pointer;

            transition: background 0.2s ease;
        }

        .btn-pelajari-materi:hover {
            background: #d94c6e;
            color: white;
        }


        /* ==============================
           POP-UP PENGEMBANGAN
        ============================== */

        .pengembangan-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(20, 45, 37, 0.55);
            padding: 20px;
        }

        .pengembangan-overlay[hidden] {
            display: none;
        }

        .pengembangan-modal {
            width: 100%;
            max-width: 480px;

            background: #fffaf4;
            border-radius: 26px;

            padding: 38px 32px;
            text-align: center;

            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .pengembangan-icon {
            width: 76px;
            height: 76px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 20px;

            background: #f9e3e9;
            border-radius: 50%;
            font-size: 34px;
        }

        .pengembangan-modal h2 {
            color: #214b40;
            font-size: 24px;
            font-weight: 800;
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .pengembangan-modal p {
            color: #64776c;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .btn-tutup-pengembangan {
            min-width: 170px;
            min-height: 52px;

            border: none;
            border-radius: 13px;

            background: #e95b7c;
            color: white;

            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;

            cursor: pointer;
        }

        .btn-tutup-pengembangan:hover {
            background: #d94c6e;
        }

        body.modal-terbuka {
            overflow: hidden;
        }


        /* ==============================
           RESPONSIVE TABLET
        ============================== */

        @media (max-width: 768px) {

            .materi-heading h1 {
                font-size: 29px;
            }

            .materi-grid {
                grid-template-columns: 1fr;
                max-width: 470px;
                margin: 0 auto;
            }

            .materi-card-image {
                height: 200px;
            }
        }


        /* ==============================
           RESPONSIVE HP
        ============================== */

        @media (max-width: 480px) {

            .materi-page {
                padding: 38px 16px 60px;
            }

            .materi-card-content {
                padding: 20px 23px;
            }

            .pengembangan-modal {
                padding: 32px 22px;
            }

            .pengembangan-modal h2 {
                font-size: 21px;
            }
        }

    </style>
</head>

<body>

    <!-- HEADER BAKAWAN -->
    @include('components.header')


    <!-- =====================================
         MENGAMBIL DATA DARI DATABASE
    ====================================== -->

    @php

        // Mengambil materi Biotik dan Abiotik
        // berdasarkan ID yang sudah diketahui
        $materiBiotik = $materi->firstWhere('id', 7);

        // Mengambil semua materi selain ID 7
        // supaya tidak ada kartu duplikat
        $materiLain = $materi
            ->where('id', '!=', 7)
            ->values();

    @endphp


    <!-- =====================================
         HALAMAN MATERI SISWA
    ====================================== -->

    <main class="materi-page">

        <div class="materi-container">


            <!-- JUDUL HALAMAN -->
            <section class="materi-heading">

                <h1>
                    Materi <span>Pembelajaran</span>
                </h1>

                <p>
                    Pilih materi yang ingin kamu pelajari.
                </p>

            </section>


            <!-- =================================
                 DAFTAR KARTU MATERI
            ================================== -->

            <div class="materi-grid">


                <!-- =============================
                     MATERI 1
                     BIOTIK DAN ABIOTIK
                ============================== -->

                @if ($materiBiotik)

                    <article class="materi-card">

                        <!-- GAMBAR DARI DATABASE -->
                        <div class="materi-card-image">

                            @if ($materiBiotik->gambar)

                                <img
                                    src="{{ asset('storage/' . $materiBiotik->gambar) }}"
                                    alt="{{ $materiBiotik->judul }}">

                            @else

                                <img
                                    src="{{ asset('images/materi-biotik.png') }}"
                                    alt="{{ $materiBiotik->judul }}">

                            @endif

                        </div>


                        <!-- ISI KARTU -->
                        <div class="materi-card-content">

                            <!-- NOMOR -->
                            <div class="materi-number">
                                1
                            </div>


                            <!-- JUDUL DATABASE -->
                            <h2>
                                {{ $materiBiotik->judul }}
                            </h2>


                            <!-- DESKRIPSI DATABASE -->
                            <p>
                                {{ $materiBiotik->deskripsi
                                    ?: 'Kenali makhluk hidup dan benda tidak hidup di lahan basah.' }}
                            </p>


                            <!-- TOMBOL MATERI -->
                            <div class="materi-card-action">

                                <a
                                    href="{{ route('materi.biotik') }}"
                                    class="btn-pelajari-materi">

                                    Pelajari Materi

                                </a>

                            </div>

                        </div>

                    </article>

                @endif


                <!-- =============================
                     MATERI 2
                     HUBUNGAN DALAM EKOSISTEM
                     MASIH DALAM PENGEMBANGAN
                ============================== -->

                <article class="materi-card">

                    <!-- GAMBAR -->
                    <div class="materi-card-image">

                        <img
                            src="{{ asset('images/materi-ekosistem.png') }}"
                            alt="Hubungan dalam Ekosistem">

                    </div>


                    <!-- ISI KARTU -->
                    <div class="materi-card-content">

                        <!-- NOMOR -->
                        <div class="materi-number pink">
                            2
                        </div>


                        <!-- JUDUL -->
                        <h2>
                            Hubungan dalam Ekosistem
                        </h2>


                        <!-- DESKRIPSI -->
                        <p>
                            Pelajari bagaimana komponen
                            ekosistem saling berhubungan.
                        </p>


                        <!-- TOMBOL POP-UP -->
                        <div class="materi-card-action">

                            <button
                                type="button"
                                class="btn-pelajari-materi"
                                id="btnMateriDua">

                                Pelajari Materi

                            </button>

                        </div>

                    </div>

                </article>


                <!-- =============================
                     MATERI TAMBAHAN DARI GURU
                     OTOMATIS DARI DATABASE
                ============================== -->

                @foreach ($materiLain as $item)

                    <article class="materi-card">

                        <!-- GAMBAR MATERI -->
                        <div class="materi-card-image">

                            @if ($item->gambar)

                                <!-- GAMBAR UPLOAD GURU -->
                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->judul }}">

                            @else

                                <!-- JIKA BELUM ADA GAMBAR -->
                                <div class="materi-no-image">

                                    Tidak Ada Gambar

                                </div>

                            @endif

                        </div>


                        <!-- ISI KARTU -->
                        <div class="materi-card-content">

                            <!-- NOMOR MATERI -->
                            <div
                                class="materi-number {{ $loop->iteration % 2 == 0 ? 'pink' : '' }}">

                                {{ $loop->iteration + 2 }}

                            </div>


                            <!-- JUDUL DARI DATABASE -->
                            <h2>
                                {{ $item->judul }}
                            </h2>


                            <!-- DESKRIPSI DARI DATABASE -->
                            <p>
                                {{ $item->deskripsi
                                    ?: 'Belum ada deskripsi materi.' }}
                            </p>


                            <!-- TOMBOL DETAIL MATERI -->
                            <div class="materi-card-action">

                                <a
                                    href="{{ route('materi.siswa.show', $item->id) }}"
                                    class="btn-pelajari-materi">

                                    Pelajari Materi

                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach


            </div>

        </div>

    </main>


    <!-- =====================================
         POP-UP MATERI 2
    ====================================== -->

    <div
        class="pengembangan-overlay"
        id="modalPengembangan"
        role="dialog"
        aria-modal="true"
        aria-labelledby="judulPengembangan"
        aria-describedby="deskripsiPengembangan"
        hidden>

        <div class="pengembangan-modal">

            <!-- ICON -->
            <div class="pengembangan-icon">
                🌱
            </div>


            <!-- JUDUL -->
            <h2 id="judulPengembangan">
                Masih dalam Tahap Pengembangan
            </h2>


            <!-- DESKRIPSI -->
            <p id="deskripsiPengembangan">

                Materi Hubungan dalam Ekosistem
                sedang kami siapkan.

                Nantikan pembelajaran seru
                berikutnya di BAKAWAN, ya!

            </p>


            <!-- TOMBOL TUTUP -->
            <button
                type="button"
                class="btn-tutup-pengembangan"
                id="btnTutupPengembangan">

                Mengerti

            </button>

        </div>

    </div>


    <!-- =====================================
         JAVASCRIPT POP-UP
    ====================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // Mengambil elemen pop-up
            const btnMateriDua =
                document.getElementById('btnMateriDua');

            const modalPengembangan =
                document.getElementById('modalPengembangan');

            const btnTutupPengembangan =
                document.getElementById('btnTutupPengembangan');


            // MEMBUKA POP-UP
            function bukaModal() {

                modalPengembangan.hidden = false;

                document.body.classList.add(
                    'modal-terbuka'
                );

                btnTutupPengembangan.focus();
            }


            // MENUTUP POP-UP
            function tutupModal() {

                modalPengembangan.hidden = true;

                document.body.classList.remove(
                    'modal-terbuka'
                );

                btnMateriDua.focus();
            }


            // KLIK TOMBOL MATERI 2
            btnMateriDua.addEventListener(
                'click',
                bukaModal
            );


            // KLIK TOMBOL MENGERTI
            btnTutupPengembangan.addEventListener(
                'click',
                tutupModal
            );


            // KLIK AREA GELAP DI LUAR POP-UP
            modalPengembangan.addEventListener(
                'click',
                function (event) {

                    if (event.target === modalPengembangan) {
                        tutupModal();
                    }

                }
            );


            // MENUTUP DENGAN TOMBOL ESCAPE
            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape' &&
                        !modalPengembangan.hidden
                    ) {
                        tutupModal();
                    }

                }
            );

        });

    </script>


    <!-- BOOTSTRAP JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
