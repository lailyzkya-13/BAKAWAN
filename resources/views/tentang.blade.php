
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tentang BAKAWAN | BAKAWAN</title>

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- FONT POPPINS -->
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

    <!-- CSS HEADER LAMA -->
    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}"
    >

    <!-- CSS HALAMAN TENTANG -->
    <link
        rel="stylesheet"
        href="{{ asset('css/tentang.css') }}"
    >

</head>

<body>

    <!-- HEADER TETAP -->
    @include('components.header')

    <!-- HALAMAN TENTANG -->

    <main class="tentang-page">

        <!-- BACKGROUND DENGAN EFEK BLUR -->
        <div
            class="tentang-background"
            aria-hidden="true"
        ></div>

        <!-- LAPISAN PUTIH TRANSPARAN -->
        <div
            class="tentang-overlay"
            aria-hidden="true"
        ></div>

        <!-- KONTEN -->
        <div class="tentang-container">

            <section class="tentang-content">

                <h1 class="tentang-title">
                    Tentang
                    <span>BAKAWAN</span>
                </h1>

                <p class="tentang-description">
                    BAKAWAN adalah media pembelajaran
                    interaktif berbasis web yang mengajak
                    siswa kelas V SD untuk mengenal
                    ekosistem lahan basah Banua melalui
                    materi, permainan, dan kuis yang
                    menyenangkan.
                </p>

            </section>

        </div>

    </main>

    <!-- BOOTSTRAP JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>
