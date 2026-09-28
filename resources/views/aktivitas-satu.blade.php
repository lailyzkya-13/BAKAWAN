<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Klasifikasi Biotik dan Abiotik | BAKAWAN</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aktivitas-satu.css') }}">
</head>

<body>

    @include('components.header')


    <main class="aktivitas-page">

        <div class="container-aktivitas">


            <!-- =====================================
                 KEMBALI
            ====================================== -->

            <a
                href="{{ route('aktivitas') }}"
                class="btn-kembali-atas"
            >
                ← Kembali
            </a>


            <!-- =====================================
                 JUDUL
            ====================================== -->

            <section class="aktivitas-heading">

                <span class="label-aktivitas">
                    Aktivitas 1 • Drag & Drop
                </span>

                <h1>
                    Klasifikasi
                    <span>Biotik & Abiotik</span>
                </h1>

                <p>
                    Seret setiap objek ke kelompok yang tepat.
                    Jika belum tepat, kamu akan mendapatkan clue
                    untuk membantu menemukan jawabannya.
                </p>

            </section>


            <!-- =====================================
                 PETUNJUK
            ====================================== -->

            <section class="petunjuk-box">

                <div class="petunjuk-icon">
                    💡
                </div>

                <div>
                    <strong>Cara Bermain</strong>

                    <p>
                        Seret kartu objek ke kotak
                        <b>Biotik</b> atau <b>Abiotik</b>.
                        Setelah semua objek berhasil dikelompokkan,
                        tekan tombol <b>Cek Jawaban</b>.
                    </p>
                </div>

            </section>


            <!-- =====================================
                 PROGRESS
            ====================================== -->

            <section class="progress-section">

                <div class="progress-info">

                    <span>
                        Progress
                    </span>

                    <strong id="progressText">
                        0 / {{ $objekAktivitas->count() }}
                    </strong>

                </div>

                <div class="progress-track">

                    <div
                        class="progress-fill"
                        id="progressFill"
                    ></div>

                </div>

            </section>


            <!-- =====================================
                 OBJEK YANG HARUS DIPINDAHKAN
            ====================================== -->

            <section class="objek-section">

                <div class="section-title">

                    <div>
                        <span class="section-number">
                            1
                        </span>

                        <div>
                            <h2>
                                Pilih Objek
                            </h2>

                            <p>
                                Seret satu per satu objek di bawah ini.
                            </p>
                        </div>
                    </div>

                </div>


                <div
                    class="objek-list"
                    id="objekList"
                >

                    @forelse ($objekAktivitas as $objek)

                        <div
                            class="objek-card"
                            draggable="true"

                            data-id="{{ $objek->id }}"
                            data-kategori="{{ $objek->kategori }}"
                            data-nama="{{ $objek->nama_objek }}"
                            data-penjelasan="{{ $objek->penjelasan }}"
                        >

                            <div class="objek-image">

                                <img
                                    src="{{ asset('images/aktivitas/' . $objek->gambar) }}"
                                    alt="{{ $objek->nama_objek }}"
                                >

                            </div>

                            <p class="nama-objek">
                                {{ $objek->nama_objek }}
                            </p>

                            <span class="drag-text">
                                ⋮⋮ Seret
                            </span>

                        </div>

                    @empty

                        <div class="objek-kosong">

                            <p>
                                Belum ada objek aktivitas yang tersedia.
                            </p>

                        </div>

                    @endforelse

                </div>

            </section>


            <!-- =====================================
                 TEMPAT DROP
            ====================================== -->

            <section class="drop-section">


                <!-- BIOTIK -->

                <div
                    class="drop-box drop-biotik"
                    data-kategori="biotik"
                >

                    <div class="drop-title">

                        <div class="drop-icon">
                            🌿
                        </div>

                        <div>

                            <h2>
                                Biotik
                            </h2>

                            <p>
                                Makhluk hidup
                            </p>

                        </div>

                    </div>


                    <div
                        class="drop-area"
                        id="dropBiotik"
                    >

                        <div class="drop-placeholder">

                            <span>↓</span>

                            <p>
                                Letakkan objek biotik di sini
                            </p>

                        </div>

                    </div>

                </div>


                <!-- ABIOTIK -->

                <div
                    class="drop-box drop-abiotik"
                    data-kategori="abiotik"
                >

                    <div class="drop-title">

                        <div class="drop-icon">
                            💧
                        </div>

                        <div>

                            <h2>
                                Abiotik
                            </h2>

                            <p>
                                Unsur tidak hidup
                            </p>

                        </div>

                    </div>


                    <div
                        class="drop-area"
                        id="dropAbiotik"
                    >

                        <div class="drop-placeholder">

                            <span>↓</span>

                            <p>
                                Letakkan objek abiotik di sini
                            </p>

                        </div>

                    </div>

                </div>


            </section>


            <!-- =====================================
                 FEEDBACK / CLUE
            ====================================== -->

            <section
                class="feedback-area"
                id="feedbackArea"
            >

                <div
                    class="feedback-icon"
                    id="feedbackIcon"
                >
                    🌱
                </div>


                <div class="feedback-content">

                    <h3 id="feedbackTitle">
                        Yuk, mulai!
                    </h3>

                    <p id="feedbackText">
                        Pilih satu objek lalu seret ke kelompok
                        Biotik atau Abiotik.
                    </p>

                </div>

            </section>


            <!-- =====================================
                 TOMBOL CEK
            ====================================== -->

            <section class="button-area">

                <button
                    type="button"
                    class="btn-reset"
                    id="btnReset"
                >
                    ↻ Ulangi
                </button>


                <button
                    type="button"
                    class="btn-cek"
                    id="btnCek"
                    disabled
                >
                    Cek Jawaban
                </button>

            </section>


            <!-- =====================================
                 HASIL AKHIR
            ====================================== -->

            <section
                class="hasil-section"
                id="hasilSection"
            >

                <div class="hasil-header">

                    <div class="hasil-icon">
                        🎉
                    </div>

                    <div>

                        <span class="hasil-label">
                            Hasil Aktivitas
                        </span>

                        <h2>
                            Hebat! Kamu berhasil!
                        </h2>

                        <p>
                            Semua objek sudah dikelompokkan dengan tepat.
                            Sekarang, yuk pahami alasan dari setiap jawaban.
                        </p>

                    </div>

                </div>


                <div
                    class="penjelasan-list"
                    id="penjelasanList"
                ></div>


                <div class="kesimpulan-box">

                    <div class="kesimpulan-icon">
                        💡
                    </div>

                    <div>

                        <strong>
                            Ingat!
                        </strong>

                        <p>
                            Komponen biotik adalah semua makhluk hidup
                            dalam ekosistem, sedangkan komponen abiotik
                            adalah unsur tidak hidup yang memengaruhi
                            kehidupan. Keduanya saling berkaitan di dalam
                            suatu ekosistem.
                        </p>

                    </div>

                </div>


                <div class="hasil-button">

                    <button
                        type="button"
                        class="btn-main-lagi"
                        id="btnMainLagi"
                    >
                        ↻ Main Lagi
                    </button>


                    <a
                        href="{{ route('aktivitas') }}"
                        class="btn-aktivitas-lain"
                    >
                        Aktivitas Lain →
                    </a>

                </div>

            </section>


        </div>

    </main>


    <!-- Bootstrap -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- JS Aktivitas -->
    <script src="{{ asset('js/aktivitas-satu.js') }}"></script>

</body>

</html>