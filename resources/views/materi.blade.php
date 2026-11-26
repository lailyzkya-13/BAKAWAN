<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Materi Pembelajaran | BAKAWAN</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS HEADER -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

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
        }
    </style>
</head>

<body>

    <!-- HEADER BAKAWAN -->
    @include('components.header')



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

                @forelse ($materi as $item)

                    <article class="materi-card">

                        {{-- GAMBAR MATERI --}}
                        <div class="materi-card-image">

                            @if ($item->gambar)

                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">

                            @else

                                <div class="materi-no-image">
                                    Tidak Ada Gambar
                                </div>

                            @endif

                        </div>


                        {{-- ISI KARTU --}}
                        <div class="materi-card-content">

                            {{-- NOMOR MATERI OTOMATIS --}}
                            <div class="materi-number {{ $loop->iteration % 2 == 0 ? 'pink' : '' }}">

                                {{ $loop->iteration }}

                            </div>


                            {{-- JUDUL --}}
                            <h2>
                                {{ $item->judul }}
                            </h2>


                            {{-- DESKRIPSI --}}
                            <p>
                                {{ $item->deskripsi ?: 'Belum ada deskripsi materi.' }}
                            </p>


                            {{-- TOMBOL PELAJARI --}}
                            <div class="materi-card-action">

                                <a href="{{ route('materi.siswa.show', $item->id) }}" class="btn-pelajari-materi">

                                    Pelajari Materi

                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="materi-kosong">
                        <h3>Belum ada materi pembelajaran.</h3>
                        <p>Silakan tunggu guru menambahkan materi.</p>
                    </div>

                @endforelse

            </div>



        </div>

    </main>







    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>