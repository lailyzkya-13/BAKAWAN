
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Petunjuk Evaluasi | BAKAWAN</title>

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
    <link rel="stylesheet" href="{{ asset('css/evaluasi-petunjuk.css') }}">
</head>

<body>

    {{-- HEADER LAMA, TIDAK DIUBAH --}}
    @include('components.header')

    <main class="petunjuk-page">

        <div class="petunjuk-container">

            <!-- JUDUL -->
            <section class="petunjuk-heading">

                <span class="petunjuk-label">
                    Evaluasi Akhir
                </span>

                <h1>Petunjuk Evaluasi</h1>

                <p>
                    Baca petunjuk berikut sebelum
                    mengerjakan soal, ya!
                </p>

            </section>

            <!-- KARTU PETUNJUK -->
            <section class="petunjuk-card">

                <div class="petunjuk-card-heading">

                    <div class="petunjuk-icon">
                        📋
                    </div>

                    <div>
                        <h2>Cara Mengerjakan</h2>

                        <p>
                            Halo, {{ session('evaluasi_nama') }}!
                            Sebelum mulai, perhatikan
                            petunjuk berikut.
                        </p>
                    </div>

                </div>

                <div class="petunjuk-list">

                    <div class="petunjuk-item">

                        <span class="petunjuk-number">1</span>

                        <p>
                            Evaluasi terdiri dari
                            <strong>10 soal pilihan ganda</strong>
                            tentang komponen biotik, abiotik,
                            dan hubungan dalam ekosistem.
                        </p>

                    </div>

                    <div class="petunjuk-item">

                        <span class="petunjuk-number">2</span>

                        <p>
                            Bacalah setiap pertanyaan
                            dengan teliti, kemudian pilih
                            <strong>satu jawaban</strong>
                            yang menurutmu paling tepat.
                        </p>

                    </div>

                    <div class="petunjuk-item">

                        <span class="petunjuk-number">3</span>

                        <p>
                            Gunakan tombol
                            <strong>Soal Sebelumnya</strong>
                            dan
                            <strong>Soal Selanjutnya</strong>
                            untuk berpindah soal.
                        </p>

                    </div>

                    <div class="petunjuk-item">

                        <span class="petunjuk-number">4</span>

                        <p>
                            Kamu boleh kembali ke soal
                            sebelumnya untuk memeriksa
                            atau mengganti jawaban.
                        </p>

                    </div>

                    <div class="petunjuk-item">

                        <span class="petunjuk-number">5</span>

                        <p>
                            Setelah menjawab seluruh soal,
                            tekan tombol
                            <strong>Selesai Evaluasi</strong>
                            untuk mengumpulkan jawaban
                            dan melihat hasilnya.
                        </p>

                    </div>

                </div>

                <!-- INFORMASI SISWA -->
                <div class="identitas-box">

                    <div>
                        <span>Nama Siswa</span>

                        <strong>
                            {{ session('evaluasi_nama') }}
                        </strong>
                    </div>

                    <div>
                        <span>Kelas</span>

                        <strong>
                            {{ session('evaluasi_kelas') }}
                        </strong>
                    </div>

                </div>

            </section>

            <!-- TOMBOL -->
            <div class="petunjuk-actions">

                <a
                    href="{{ route('evaluasi') }}"
                    class="btn-kembali"
                >
                    <span>←</span>
                    Kembali
                </a>

                <a
                    href="{{ route('evaluasi.soal') }}"
                    class="btn-mulai"
                >
                    Mulai Mengerjakan
                    <span>→</span>
                </a>

            </div>

        </div>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>