<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Beranda | BAKAWAN</title>

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- GOOGLE FONT -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- HEADER -->
    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}"
    >

    <!-- BERANDA -->
    <link
        rel="stylesheet"
        href="{{ asset('css/beranda.css') }}"
    >
</head>

<body>

    <!-- =========================================
         HEADER
    ========================================== -->

    @include('components.header')


    <!-- =========================================
         HERO
    ========================================== -->

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

                <a
                    href="{{ route('materi') }}"
                    class="btn-mulai"
                >
                    <span>
                        Mulai Belajar
                    </span>

                    <span class="panah">
                        →
                    </span>
                </a>

            </div>

        </div>

    </section>


    <!-- =========================================
         MATERI
    ========================================== -->

    <section class="materi-section">

        <div class="container materi-container">

            <!-- JUDUL -->

            <div class="judul-section">

                <h2>
                    Apa yang Akan Kamu Pelajari?
                </h2>

                <p>
                    Dua topik seru tentang ekosistem lahan basah
                    yang ada di sekitar kita.
                </p>

            </div>


            <!-- CARD -->

            <div class="row justify-content-center g-4 materi-row">


                <!-- =================================
                     MATERI 1
                ================================== -->

                <div class="col-lg-5 col-md-6 col-12">

                    <div class="materi-card card-hijau">

                        <div class="materi-image">

                            <img
                                src="{{ asset('images/materi-biotik.jpg') }}"
                                alt="Komponen Biotik dan Abiotik"
                            >

                        </div>


                        <div class="materi-content">

                            <span class="nomor nomor-hijau">
                                1
                            </span>

                            <h3>
                                Komponen Biotik dan Abiotik
                            </h3>

                            <p>
                                Kenali makhluk hidup dan benda tidak
                                hidup di lahan basah.
                            </p>

                            <a
                                href="{{ route('materi.biotik') }}"
                                class="btn-materi"
                            >
                                Pelajari Materi
                            </a>

                        </div>

                    </div>

                </div>


                <!-- =================================
                     MATERI 2
                ================================== -->

                <div class="col-lg-5 col-md-6 col-12">

                    <div class="materi-card card-pink">

                        <div class="materi-image">

                            <img
                                src="{{ asset('images/materi-ekosistem.jpg') }}"
                                alt="Hubungan dalam Ekosistem"
                            >

                        </div>


                        <div class="materi-content">

                            <span class="nomor nomor-pink">
                                2
                            </span>

                            <h3>
                                Hubungan dalam Ekosistem
                            </h3>

                            <p>
                                Pelajari bagaimana komponen ekosistem
                                saling berhubungan.
                            </p>

                            <a
                                href="{{ route('materi') }}"
                                class="btn-materi"
                            >
                                Pelajari Materi
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer class="footer">

        <div class="container">

            <p>
                @Pilkom2026
            </p>

        </div>

    </footer>


    <!-- BOOTSTRAP JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>