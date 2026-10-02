<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hubungan dalam Ekosistem | BAKAWAN</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aktivitas-dua.css') }}">
</head>

<body>

    @include('components.header')

    <main class="aktivitas-dua-page">

        <div class="aktivitas-container">

            <!-- KEMBALI -->
            <a href="{{ route('aktivitas') }}" class="btn-kembali">
                ← Kembali
            </a>


            <!-- JUDUL -->
            <section class="aktivitas-heading">

                <span class="label-aktivitas">
                    Aktivitas 2
                </span>

                <h1>
                    Hubungkan Pasangan
                    <span>yang Tepat!</span>
                </h1>

                <p>
                    Tarik garis dari objek di sebelah kiri menuju
                    pasangan yang memiliki hubungan dengannya
                    di sebelah kanan.
                </p>

            </section>


            <!-- PETUNJUK -->
            <section class="petunjuk-box">

                <div class="petunjuk-number">
                    1
                </div>

                <div>
                    <h2>Cara Bermain</h2>

                    <p>
                        Tekan titik pada objek sebelah kiri,
                        tarik garis menuju titik pasangan di sebelah kanan,
                        kemudian lepaskan. Jika belum tepat,
                        kamu akan mendapatkan clue.
                    </p>
                </div>

            </section>


            <!-- PROGRESS -->
            <section class="progress-wrapper">

                <div class="progress-info">

                    <span>
                        Pasangan ditemukan
                    </span>

                    <strong id="progressText">
                        0 / {{ $hubunganEkosistem->count() }}
                    </strong>

                </div>

                <div class="progress">

                    <div
                        class="progress-bar"
                        id="progressBar"
                        role="progressbar"
                        style="width: 0%">
                    </div>

                </div>

            </section>


            @if ($hubunganEkosistem->count() > 0)

                <!-- AREA PERMAINAN -->
                <section
                    class="matching-board"
                    id="matchingBoard"
                    data-total="{{ $hubunganEkosistem->count() }}"
                >

                    <!-- SVG UNTUK GARIS -->
                    <svg
                        class="connection-layer"
                        id="connectionLayer"
                        aria-hidden="true"
                    >
                    </svg>


                    <!-- KOLOM KIRI -->
                    <div class="matching-column column-left">

                        <div class="column-title">
                            <span>Objek</span>
                            <small>Tarik dari titik ini</small>
                        </div>


                        <div class="object-list">

                            @foreach ($hubunganEkosistem as $item)

                                <div
                                    class="match-card left-card"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->objek_kiri }}"
                                    data-target="{{ $item->objek_kanan }}"
                                    data-description="{{ $item->hubungan }}"
                                    data-clue="{{ $item->clue }}"
                                >

                                    <div class="card-picture">

                                        <img
                                            src="{{ asset('images/aktivitas/' . $item->gambar_kiri) }}"
                                            alt="{{ $item->objek_kiri }}"
                                            draggable="false"
                                        >

                                    </div>

                                    <span class="object-name">
                                        {{ $item->objek_kiri }}
                                    </span>


                                    <button
                                        type="button"
                                        class="connection-point point-left"
                                        aria-label="Hubungkan {{ $item->objek_kiri }}"
                                    ></button>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    <!-- AREA TENGAH -->
                    <div class="connection-space">

                        <span class="connection-instruction">
                            Tarik garis
                        </span>

                    </div>


                    <!-- KOLOM KANAN -->
                    <div class="matching-column column-right">

                        <div class="column-title">
                            <span>Pasangan</span>
                            <small>Lepaskan di titik ini</small>
                        </div>


                        <div class="object-list">

                            @foreach ($pasanganKanan as $item)

                                <div
                                    class="match-card right-card"
                                    data-id="{{ $item['id'] }}"
                                    data-name="{{ $item['nama'] }}"
                                >

                                    <button
                                        type="button"
                                        class="connection-point point-right"
                                        aria-label="Pasangan {{ $item['nama'] }}"
                                    ></button>


                                    <div class="card-picture">

                                        <img
                                            src="{{ asset('images/aktivitas/' . $item['gambar']) }}"
                                            alt="{{ $item['nama'] }}"
                                            draggable="false"
                                        >

                                    </div>

                                    <span class="object-name">
                                        {{ $item['nama'] }}
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </section>


                <!-- FEEDBACK -->
                <section
                    class="feedback-area"
                    id="feedbackArea"
                >

                    <div
                        class="feedback-icon"
                        id="feedbackIcon"
                    >
                        ?
                    </div>

                    <div class="feedback-content">

                        <h3 id="feedbackTitle">
                            Ayo mulai!
                        </h3>

                        <p id="feedbackText">
                            Tarik garis dari salah satu titik di sebelah kiri
                            menuju pasangan yang sesuai di sebelah kanan.
                        </p>

                    </div>

                </section>


                <!-- TOMBOL -->
                <div class="button-area">

                    <button
                        type="button"
                        class="btn-reset"
                        id="btnReset"
                    >
                        Ulangi
                    </button>

                    <button
                        type="button"
                        class="btn-result"
                        id="btnResult"
                        disabled
                    >
                        Lihat Hasil
                    </button>

                </div>


                <!-- HASIL -->
                <section
                    class="result-section"
                    id="resultSection"
                >

                    <div class="result-card">

                        <div class="result-check">
                            ✓
                        </div>

                        <h2>
                            Hebat! Semua pasangan berhasil ditemukan.
                        </h2>

                        <p class="result-description">
                            Kamu berhasil menemukan hubungan
                            antar komponen dalam ekosistem.
                        </p>


                        <div
                            class="explanation-list"
                            id="explanationList"
                        >
                        </div>


                        <div class="conclusion-box">

                            <h3>
                                Kesimpulan
                            </h3>

                            <p>
                                Komponen dalam ekosistem saling berhubungan.
                                Makhluk hidup membutuhkan komponen lain
                                untuk memperoleh tempat hidup, makanan,
                                dan kebutuhan lainnya.
                            </p>

                        </div>


                        <button
                            type="button"
                            class="btn-play-again"
                            id="btnPlayAgain"
                        >
                            Main Lagi
                        </button>

                    </div>

                </section>

            @else

                <section class="empty-data">

                    <h2>
                        Aktivitas belum tersedia
                    </h2>

                    <p>
                        Belum ada pasangan hubungan ekosistem
                        yang aktif.
                    </p>

                </section>

            @endif

        </div>

    </main>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    @if ($hubunganEkosistem->count() > 0)
        <script src="{{ asset('js/aktivitas-dua.js') }}"></script>
    @endif

</body>

</html>