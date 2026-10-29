
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Beranda | BAKAWAN</title>

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
    <link rel="stylesheet"
          href="{{ asset('css/header.css') }}">

    <!-- CSS BERANDA -->
    <link rel="stylesheet"
          href="{{ asset('css/beranda.css') }}">

</head>

<body>

    <!-- HEADER -->
    @include('components.header')


    <!-- ========================================
         HERO
    ======================================== -->

    <section class="hero">

        <div class="hero-overlay"></div>

        <div class="container hero-container">

            <div class="hero-content">

                <h1>
                    Yuk, Jelajahi

                    <span>
                        Lahan Basah Banua!
                    </span>
                </h1>

                <p>
                    Belajar sambil bermain,<br>
                    kenali alam dan jaga warisan kita.
                </p>

                <!-- MENUJU DAFTAR MATERI SISWA -->
                <a
                    href="{{ route('materi.siswa') }}"
                    class="btn-mulai">

                    <span>Mulai Belajar</span>

                    <span class="panah">→</span>

                </a>

            </div>

        </div>

    </section>


    <!-- ========================================
         MATERI PEMBELAJARAN
    ======================================== -->

    <section class="materi-section">

        <div class="container materi-container">

            <!-- JUDUL SECTION -->
            <div class="judul-section">

                <h2>
                    Apa yang Akan Kamu Pelajari?
                </h2>

                <p>
                    Dua topik seru tentang ekosistem
                    lahan basah yang ada di sekitar kita.
                </p>

            </div>


            <!-- DAFTAR KARTU -->
            <div class="row justify-content-center g-4 materi-row">


                <!-- =================================
                     MATERI 1
                     DATA DARI DATABASE
                ================================= -->

                <div class="col-lg-5 col-md-6 col-12">

                    <div class="materi-card card-hijau">

                        <!-- GAMBAR -->
                        <div class="materi-image">

                            <img
                                src="{{ $materiBiotik?->gambar
                                    ? asset('storage/' . $materiBiotik->gambar)
                                    : asset('images/materi-biotik.png') }}"

                                alt="{{ $materiBiotik?->judul ?? 'Komponen Biotik dan Abiotik' }}"
                            >

                        </div>


                        <!-- ISI KARTU -->
                        <div class="materi-content">

                            <!-- NOMOR -->
                            <span class="nomor nomor-hijau">
                                1
                            </span>


                            <!-- JUDUL DATABASE -->
                            <h3>
                                {{ $materiBiotik?->judul ?? 'Materi belum tersedia' }}
                            </h3>


                            <!-- DESKRIPSI DATABASE -->
                            <p>
                                {{ $materiBiotik?->deskripsi
                                    ?: 'Kenali makhluk hidup dan benda tidak hidup di lahan basah.' }}
                            </p>


                            <!-- TOMBOL DETAIL MATERI -->
                            @if ($materiBiotik)

                                <a
                                    href="{{ route('materi.biotik') }}"
                                    class="btn-materi">

                                    Pelajari Materi

                                </a>

                            @endif

                        </div>

                    </div>

                </div>


                <!-- =================================
                     MATERI 2
                     KONTEN BAWAAN
                ================================= -->

                <div class="col-lg-5 col-md-6 col-12">

                    <div class="materi-card card-pink">

                        <!-- GAMBAR -->
                        <div class="materi-image">

                            <img
                                src="{{ asset('images/materi-ekosistem.png') }}"
                                alt="Hubungan dalam Ekosistem"
                            >

                        </div>


                        <!-- ISI KARTU -->
                        <div class="materi-content">

                            <!-- NOMOR -->
                            <span class="nomor nomor-pink">
                                2
                            </span>


                            <!-- JUDUL -->
                            <h3>
                                Hubungan dalam Ekosistem
                            </h3>


                            <!-- DESKRIPSI -->
                            <p>
                                Pelajari bagaimana komponen ekosistem
                                saling berhubungan.
                            </p>


                            <!-- MENUJU DAFTAR MATERI SISWA -->
                            <a
                                href="{{ route('materi.siswa') }}"
                                class="btn-materi">

                                Pelajari Materi

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ========================================
         FOOTER
    ======================================== -->

    <footer class="footer">

        <div class="container">

            <p>@Pilkom2026</p>

        </div>

    </footer>


    <!-- BOOTSTRAP JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
