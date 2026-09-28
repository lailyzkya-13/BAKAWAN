<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Materi | BAKAWAN</title>

    <!-- BOOTSTRAP CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- GOOGLE FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- CSS HEADER -->
    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}"
    >

    <!-- CSS KHUSUS HALAMAN MATERI -->
    <link
        rel="stylesheet"
        href="{{ asset('css/materi.css') }}"
    >
</head>

<body>

    <!-- ==================================
         HEADER
    =================================== -->
    @include('components.header')


    <!-- ==================================
         HALAMAN MATERI
    =================================== -->
    <main class="materi-page">

        <div class="container">

            <!-- JUDUL -->
            <div class="materi-heading">

                <h1>
                    Materi
                    <span>Pembelajaran</span>
                </h1>

                <p>
                    Pilih materi yang ingin kamu pelajari.
                </p>

            </div>


            <!-- ==================================
                 CARD MATERI
            =================================== -->
            <div class="row justify-content-center materi-row">


                <!-- =============================
                     MATERI 1
                ============================== -->
                <div class="col-lg-5 col-md-6">

                    <div class="materi-card">

                        <!-- GAMBAR -->
                        <div class="materi-card-image">

                            <img
                                src="{{ asset('images/materi-1.jpg') }}"
                                alt="Komponen Biotik dan Abiotik"
                            >

                        </div>


                        <!-- CONTENT -->
                        <div class="materi-card-content">

                            <span class="nomor nomor-hijau">
                                1
                            </span>

                            <h2>
                                Komponen Biotik dan Abiotik
                            </h2>

                            <p>
                                Kenali makhluk hidup dan benda
                                tidak hidup di lahan basah.
                            </p>


                            <div class="button-area">

                                <a
                                    href="{{ route('materi.biotik') }}"
                                    class="btn-pelajari"
                                >
                                    Pelajari Materi
                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =============================
                     MATERI 2
                ============================== -->
                <div class="col-lg-5 col-md-6">

                    <div class="materi-card">

                        <!-- GAMBAR -->
                        <div class="materi-card-image">

                            <img
                                src="{{ asset('images/materi-2.jpg') }}"
                                alt="Hubungan dalam Ekosistem"
                            >

                        </div>


                        <!-- CONTENT -->
                        <div class="materi-card-content">

                            <span class="nomor nomor-pink">
                                2
                            </span>

                            <h2>
                                Hubungan dalam Ekosistem
                            </h2>

                            <p>
                                Pelajari bagaimana komponen
                                ekosistem saling berhubungan.
                            </p>


                            <div class="button-area">

                                <a
                                    href="#"
                                    class="btn-pelajari"
                                >
                                    Pelajari Materi
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>


    <!-- BOOTSTRAP JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>