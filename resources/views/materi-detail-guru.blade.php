
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>{{ $materi->judul }} | BAKAWAN</title>

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- GOOGLE FONT -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS HEADER BAKAWAN -->
    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}">

    <style>

        /* HALAMAN UTAMA */
        body {
            margin: 0;
            background: #fffaf4;
            font-family: 'Poppins', sans-serif;
        }

        .detail-page {
            min-height: 100vh;
            padding: 40px 20px 70px;
        }

        .detail-container {
            max-width: 1150px;
            margin: auto;
        }


        /* TOMBOL KEMBALI */
        .detail-kembali {
            display: inline-block;
            margin-bottom: 25px;
            color: #247259;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .detail-kembali:hover {
            color: #174e40;
        }


        /* JUDUL HALAMAN */
        .detail-header {
            margin-bottom: 30px;
        }

        .detail-header h1 {
            color: #214b40;
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .detail-header p {
            color: #64776c;
            font-size: 14px;
            line-height: 1.8;
        }


        /* GAMBAR SAMPUL */
        .detail-cover {
            margin-bottom: 30px;
            border-radius: 18px;
            overflow: hidden;
        }

        .detail-cover img {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            display: block;
        }


        /* LAYOUT SIDEBAR DAN KONTEN */
        .detail-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 25px;
            align-items: start;
        }


        /* SIDEBAR */
        .detail-sidebar {
            background: #dceee2;
            border-radius: 18px;
            padding: 24px;
            position: sticky;
            top: 20px;
        }

        .detail-sidebar h2 {
            color: #214b40;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .detail-sidebar a {
            display: block;
            padding: 12px 14px;
            margin-bottom: 10px;
            border-radius: 10px;

            background: white;
            color: #247259;

            font-size: 13px;
            font-weight: 500;
            line-height: 1.6;

            text-decoration: none;
            transition: 0.2s;
        }

        .detail-sidebar a:hover {
            background: #c4e7d1;
        }

        .detail-sidebar a.active {
            background: #247259;
            color: white;
            font-weight: 600;
        }


        /* KONTEN UTAMA */
        .detail-content {
            background: white;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 3px 14px rgba(0, 0, 0, 0.05);
            min-width: 0;
        }

        .detail-label {
            display: inline-block;
            padding: 7px 14px;
            margin-bottom: 18px;

            border-radius: 20px;

            background: #dceee2;
            color: #247259;

            font-size: 12px;
            font-weight: 700;
        }

        .detail-content h2 {
            color: #214b40;
            font-size: 25px;
            font-weight: 800;
            line-height: 1.5;
            margin-bottom: 20px;
            overflow-wrap: anywhere;
        }


        /* PENGANTAR */
        .detail-pengantar {
            color: #64776c;
            font-size: 14px;
            line-height: 1.9;
            margin-bottom: 25px;
            white-space: pre-line;
        }


        /* KOTAK ISI MATERI */
        .detail-materi-box {
            background: #f1faf3;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .detail-materi-box h3 {
            color: #214b40;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .detail-materi-box p {
            color: #455b4e;
            font-size: 14px;
            line-height: 2;
            margin-bottom: 0;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }


        /* KOTAK CONTOH */
        .detail-contoh-box {
            background: #fff0f3;
            border-left: 5px solid #e95b7c;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 25px;
        }

        .detail-contoh-box h3 {
            color: #b93d60;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .detail-contoh-box p {
            color: #5c5155;
            font-size: 14px;
            line-height: 1.9;
            margin-bottom: 0;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }


        /* RINGKASAN */
        .detail-ringkasan {
            background: #fff8e8;
            border-radius: 12px;
            padding: 22px;
            margin-top: 25px;
        }

        .detail-ringkasan h3 {
            color: #805d24;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .detail-ringkasan p {
            color: #66583e;
            font-size: 14px;
            line-height: 1.9;
            white-space: pre-line;
            margin-bottom: 0;
        }


        /* TOMBOL NAVIGASI */
        .detail-navigasi {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 35px;
        }

        .detail-btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 9px;

            background: #247259;
            color: white;

            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .detail-btn:hover {
            background: #174e40;
            color: white;
        }

        .detail-btn-pink {
            background: #e95b7c;
        }

        .detail-btn-pink:hover {
            background: #d94c6e;
        }


        /* JIKA MATERI KOSONG */
        .detail-kosong {
            text-align: center;
            padding: 50px 20px;
            color: #64776c;
        }


        /* RESPONSIVE TABLET */
        @media (max-width: 900px) {

            .detail-layout {
                grid-template-columns: 1fr;
            }

            .detail-sidebar {
                position: static;
            }
        }


        /* RESPONSIVE HP */
        @media (max-width: 480px) {

            .detail-page {
                padding: 25px 15px 50px;
            }

            .detail-header h1 {
                font-size: 24px;
            }

            .detail-content {
                padding: 22px;
            }

            .detail-content h2 {
                font-size: 21px;
            }

            .detail-materi-box,
            .detail-contoh-box {
                padding: 18px;
            }

            .detail-btn {
                font-size: 12px;
            }
        }

    </style>
</head>

<body>

    <!-- HEADER BAKAWAN -->
    @include('components.header')


    <!-- HALAMAN DETAIL MATERI -->
    <main class="detail-page">

        <div class="detail-container">


            <!-- TOMBOL KEMBALI -->
            <a
                href="{{ route('materi.siswa') }}"
                class="detail-kembali">

                ← Kembali ke Daftar Materi

            </a>


            <!-- JUDUL MATERI -->
            <div class="detail-header">

                <h1>
                    {{ $materi->judul }}
                </h1>

                <p>
                    {{ $materi->deskripsi
                        ?: 'Materi pembelajaran IPAS untuk siswa kelas V.' }}
                </p>

            </div>


            <!-- GAMBAR MATERI -->
            @if ($materi->gambar)

                <div class="detail-cover">

                    <img
                        src="{{ asset('storage/' . $materi->gambar) }}"
                        alt="{{ $materi->judul }}">

                </div>

            @endif


            <!-- SIDEBAR DAN ISI -->
            <div class="detail-layout">


                <!-- =========================
                     SIDEBAR SUBBAB
                ========================== -->
                <aside class="detail-sidebar">

                    <h2>Daftar Subbab</h2>

                    @forelse ($semuaSubbab as $index => $item)

                        <a
                            href="{{ route('materi.siswa.show', [
                                'materi' => $materi->id,
                                'subbab' => $item->id
                            ]) }}"

                            class="{{ $subbabAktif && $subbabAktif->id == $item->id
                                ? 'active'
                                : '' }}">

                            {{ $index + 1 }}.
                            {{ $item->judul }}

                        </a>

                    @empty

                        <p>
                            Belum ada subbab.
                        </p>

                    @endforelse

                </aside>


                <!-- =========================
                     KONTEN PEMBELAJARAN
                ========================== -->
                <section class="detail-content">

                    @if ($subbabAktif)


                        <!-- NOMOR SUBBAB -->
                        <span class="detail-label">

                            Subbab Pembelajaran

                        </span>


                        <!-- JUDUL SUBBAB -->
                        <h2>
                            {{ $subbabAktif->judul }}
                        </h2>


                        <!-- PENGANTAR SUBBAB -->
                        @if ($subbabAktif->pengantar)

                            <p class="detail-pengantar">
                                {{ $subbabAktif->pengantar }}
                            </p>

                        @endif


                        <!-- ISI SUBBAB -->
                        <div class="detail-materi-box">

                            <h3>
                                Materi Pembelajaran
                            </h3>

                            <p>
                                {{ $subbabAktif->isi }}
                            </p>

                        </div>


                        <!-- CONTOH SUBBAB -->
                        @if ($subbabAktif->contoh)

                            <div class="detail-contoh-box">

                                <h3>
                                    Contoh Materi
                                </h3>

                                <p>
                                    {{ $subbabAktif->contoh }}
                                </p>

                            </div>

                        @endif


                        <!-- RINGKASAN DI AKHIR MATERI -->
                        @if (
                            !$selanjutnya &&
                            $materi->ringkasan
                        )

                            <div class="detail-ringkasan">

                                <h3>
                                    Ringkasan Materi
                                </h3>

                                <p>
                                    {{ $materi->ringkasan }}
                                </p>

                            </div>

                        @endif


                        <!-- NAVIGASI SUBBAB -->
                        <div class="detail-navigasi">


                            <!-- TOMBOL SEBELUMNYA -->
                            @if ($sebelumnya)

                                <a
                                    href="{{ route('materi.siswa.show', [
                                        'materi' => $materi->id,
                                        'subbab' => $sebelumnya->id
                                    ]) }}"
                                    class="detail-btn">

                                    ← Sebelumnya

                                </a>

                            @else

                                <span></span>

                            @endif


                            <!-- TOMBOL SELANJUTNYA -->
                            @if ($selanjutnya)

                                <a
                                    href="{{ route('materi.siswa.show', [
                                        'materi' => $materi->id,
                                        'subbab' => $selanjutnya->id
                                    ]) }}"
                                    class="detail-btn detail-btn-pink">

                                    Selanjutnya →

                                </a>

                            @else

                                <a
                                    href="{{ route('materi.siswa') }}"
                                    class="detail-btn detail-btn-pink">

                                    Selesai →

                                </a>

                            @endif

                        </div>


                    @else

                        <!-- JIKA BELUM ADA SUBBAB -->
                        <div class="detail-kosong">

                            <h2>
                                Belum Ada Subbab
                            </h2>

                            <p>
                                Guru belum menambahkan isi
                                untuk materi ini.
                            </p>

                            <a
                                href="{{ route('materi.siswa') }}"
                                class="detail-btn">

                                Kembali ke Materi

                            </a>

                        </div>

                    @endif

                </section>

            </div>

        </div>

    </main>


    <!-- BOOTSTRAP JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
