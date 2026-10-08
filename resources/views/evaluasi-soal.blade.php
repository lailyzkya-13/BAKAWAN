
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Soal Evaluasi | BAKAWAN</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/evaluasi-soal.css') }}">

    <style>
        /* MODAL KONFIRMASI */

        .konfirmasi-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;

            background: rgba(20, 45, 37, 0.55);

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        .konfirmasi-overlay[hidden] {
            display: none;
        }

        .konfirmasi-card {
            width: 100%;
            max-width: 530px;

            background: #fffaf4;
            border-radius: 28px;

            padding: 42px 35px;
            text-align: center;

            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.16);
        }

        .konfirmasi-icon {
            width: 75px;
            height: 75px;

            margin: 0 auto 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: #f9e3e9;

            color: #e95b7c;
            font-size: 36px;
            font-weight: 800;
        }

        .konfirmasi-card h2 {
            color: #214b40;
            font-family: 'Poppins', sans-serif;
            font-size: 25px;
            font-weight: 800;
            line-height: 1.5;

            margin-bottom: 15px;
        }

        .konfirmasi-card p {
            color: #53675f;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 0;
        }

        .konfirmasi-peringatan {
            margin-top: 18px;

            padding: 13px 15px;

            background: #fff0d9;
            color: #855a22;

            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .konfirmasi-peringatan[hidden] {
            display: none;
        }

        .konfirmasi-actions {
            display: flex;
            justify-content: center;
            gap: 13px;

            margin-top: 30px;
        }

        .btn-batal-kirim,
        .btn-ya-kirim {
            flex: 1;
            min-height: 55px;

            border-radius: 13px;

            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;

            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-batal-kirim {
            background: #ffffff;
            border: 1.5px solid #e5b9c4;
            color: #e95b7c;
        }

        .btn-batal-kirim:hover {
            background: #fff0f4;
        }

        .btn-ya-kirim {
            background: #e95b7c;
            border: 1.5px solid #e95b7c;
            color: #ffffff;
        }

        .btn-ya-kirim:hover {
            background: #d94c6e;
        }

        body.modal-terbuka {
            overflow: hidden;
        }

        @media (max-width: 576px) {

            .konfirmasi-card {
                padding: 32px 22px;
            }

            .konfirmasi-card h2 {
                font-size: 21px;
            }

            .konfirmasi-actions {
                flex-direction: column;
            }

            .btn-batal-kirim,
            .btn-ya-kirim {
                width: 100%;
                flex: none;
            }
        }
    </style>
</head>

<body>

    {{-- HEADER LAMA TETAP DIGUNAKAN --}}
    @include('components.header')

    <main class="soal-page">

        <div class="soal-container">

            <div class="soal-heading">

                <h1>Evaluasi Akhir</h1>

                <p>
                    Selamat mengerjakan,
                    <strong>
                        {{ session('evaluasi_nama', 'Siswa') }}
                    </strong>!
                </p>

            </div>

            <div class="soal-layout">

                <!-- NAVIGASI NOMOR SOAL -->

                <aside class="nomor-panel">

                    <h2>Nomor Soal</h2>

                    <div
                        class="nomor-grid"
                        id="nomorGrid"
                    ></div>

                    <p
                        class="jumlah-terjawab"
                        id="jumlahTerjawab"
                    >
                        0/5 terjawab
                    </p>

                    <div class="legenda">

                        <div>
                            <span class="legenda-warna aktif"></span>
                            Aktif
                        </div>

                        <div>
                            <span class="legenda-warna terjawab"></span>
                            Terjawab
                        </div>

                        <div>
                            <span class="legenda-warna kosong"></span>
                            Belum
                        </div>

                    </div>

                </aside>

                <!-- CARD SOAL -->

                <section class="soal-card">

                    <div
                        class="soal-progress"
                        id="soalProgress"
                    >
                        Soal 1 dari 5
                    </div>

                    <h2 id="pertanyaan"></h2>

                    <div
                        class="pilihan-list"
                        id="pilihanList"
                    ></div>

                </section>

            </div>

            <!-- TOMBOL NAVIGASI -->

            <div class="soal-actions">

                <button
                    type="button"
                    class="btn-sebelumnya"
                    id="btnSebelumnya"
                >
                    <span>←</span>
                    Soal Sebelumnya
                </button>

                <button
                    type="button"
                    class="btn-selanjutnya"
                    id="btnSelanjutnya"
                >
                    Soal Selanjutnya
                    <span>→</span>
                </button>

            </div>

        </div>

    </main>

    <!-- =====================================
         MODAL KONFIRMASI PENGIRIMAN
    ====================================== -->

    <div
        class="konfirmasi-overlay"
        id="modalKonfirmasi"
        role="dialog"
        aria-modal="true"
        aria-labelledby="judulKonfirmasi"
        aria-describedby="deskripsiKonfirmasi"
        hidden
    >

        <div class="konfirmasi-card">

            <div class="konfirmasi-icon">
                ?
            </div>

            <h2 id="judulKonfirmasi">
                Yakin ingin mengirimkan jawaban?
            </h2>

            <p id="deskripsiKonfirmasi">
                Pastikan semua jawaban sudah diperiksa.
                Setelah dikirim, jawaban tidak dapat
                diubah lagi.
            </p>

            <div
                class="konfirmasi-peringatan"
                id="peringatanBelumLengkap"
                hidden
            ></div>

            <div class="konfirmasi-actions">

                <button
                    type="button"
                    class="btn-batal-kirim"
                    id="btnBatalKirim"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="btn-ya-kirim"
                    id="btnYaKirim"
                >
                    Ya, Kirim Jawaban
                </button>

            </div>

        </div>

    </div>

    <!-- DATA DARI LARAVEL KE JAVASCRIPT -->

    <script>
        window.bakawanEvaluasiUrls = {
            hasil: @json(route('evaluasi.hasil'))
        };

        window.bakawanNamaSiswa =
            @json(session('evaluasi_nama', 'Siswa'));
    </script>

    <script src="{{ asset('js/evaluasi-soal.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>