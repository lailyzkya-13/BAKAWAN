
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembahasan Soal | BAKAWAN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/evaluasi-pembahasan.css') }}">
</head>
<body>

    @include('components.header')

    <main class="pembahasan-page">

        <div class="pembahasan-container">

            <div class="pembahasan-heading">
                <h1>Pembahasan Soal</h1>
                <p>
                    Yuk, pelajari jawaban yang benar
                    agar kamu semakin memahami materi!
                </p>
            </div>

            <div class="pembahasan-layout">

                <!-- NOMOR PEMBAHASAN -->
                <aside class="pembahasan-sidebar">

                    <h2>Nomor Soal</h2>

                    <div class="pembahasan-nomor-grid"
                         id="nomorPembahasan">
                    </div>

                    <div class="pembahasan-legenda">
                        <span>
                            <i class="warna-benar"></i>
                            Benar
                        </span>

                        <span>
                            <i class="warna-salah"></i>
                            Salah
                        </span>

                        <span>
                            <i class="warna-aktif"></i>
                            Aktif
                        </span>
                    </div>

                </aside>

                <!-- CARD PEMBAHASAN -->
                <section class="pembahasan-card">

                    <div class="pembahasan-soal-nomor"
                         id="nomorAktif">
                        Soal 1
                    </div>

                    <h2 id="pertanyaanPembahasan"></h2>

                    <div class="jawaban-siswa-box">

                        <span>Jawaban Kamu</span>

                        <strong id="jawabanSiswa"></strong>

                        <span class="status-jawaban"
                              id="statusJawaban">
                        </span>

                    </div>

                    <div class="jawaban-benar-box">

                        <h3>Jawaban Benar</h3>

                        <strong id="jawabanBenar"></strong>

                    </div>

                    <div class="penjelasan-box">

                        <h3>Penjelasan</h3>

                        <p id="penjelasanSoal"></p>

                    </div>

                </section>

            </div>

            <!-- TOMBOL -->
            <div class="pembahasan-actions">

                <button type="button"
                        class="btn-pembahasan-sebelumnya"
                        id="btnPembahasanSebelumnya">
                    ← Pembahasan Sebelumnya
                </button>

                <button type="button"
                        class="btn-pembahasan-berikutnya"
                        id="btnPembahasanBerikutnya">
                    Pembahasan Berikutnya →
                </button>

            </div>

        </div>

    </main>

    <script>
        window.bakawanEvaluasiUrls = {
            soal: @json(route('evaluasi.soal')),
            hasil: @json(route('evaluasi.hasil'))
        };
    </script>

    <script src="{{ asset('js/evaluasi-pembahasan.js') }}"></script>

</body>
</html>