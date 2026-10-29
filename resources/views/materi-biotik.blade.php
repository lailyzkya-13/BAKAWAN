
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $materi->judul }} | BAKAWAN</title>

    <!-- Font -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- CSS BAKAWAN yang sudah ada -->
    <link rel="stylesheet"
          href="{{ asset('css/header.css') }}">

    <link rel="stylesheet"
          href="{{ asset('css/materi-biotik.css') }}">

    <style>
        /* Menampilkan baris baru pada teks database */
        .teks-materi {
            white-space: pre-line;
        }

        /* Video pembelajaran */
        .video-pembelajaran {
            margin: 30px 0;
        }

        .video-judul {
            color: #245c43;
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .video-deskripsi {
            color: #5d6a60;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 18px;
        }

        .video-card {
            background: white;
            padding: 12px;
            border: 1px solid #e1eae3;
            border-radius: 18px;
        }

        .youtube-player {
            width: 100%;
            aspect-ratio: 16 / 9;
            background: #193c2b;
            border-radius: 12px;
            overflow: hidden;
        }

        .youtube-thumbnail {
            width: 100%;
            height: 100%;
            border: none;
            padding: 0;
            position: relative;
            cursor: pointer;
            background: #193c2b;
        }

        .youtube-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .youtube-play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ff0033;
            width: 76px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .youtube-play::after {
            content: "";
            border-top: 11px solid transparent;
            border-bottom: 11px solid transparent;
            border-left: 19px solid white;
        }

        .youtube-player iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-info {
            padding: 16px 8px 6px;
        }

        .video-info h3 {
            font-size: 16px;
            color: #244b38;
            font-weight: bold;
        }

        .video-info p {
            font-size: 13px;
            color: #758278;
        }

        @media (max-width: 768px) {
            .video-judul {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <!-- Mengambil subbab dari database -->
    @php
        $daftarSubbab = $materi->subbab
            ->sortBy('urutan')
            ->values();
    @endphp


    <!-- HEADER BAKAWAN -->
    @include('components.header')


    <main class="materi-detail">

        <!-- ================= SIDEBAR ================= -->

        <aside class="sidebar-materi">

            <div class="sidebar-content">

                <!-- Kembali ke daftar materi siswa -->
                <a href="{{ route('materi.siswa') }}"
                   class="btn-kembali-materi">

                    <span class="back-arrow">←</span>
                    <span>Kembali</span>

                </a>


                <!-- Judul materi -->
                <div class="sidebar-title">

                    <span class="sidebar-label">
                        MATERI PEMBELAJARAN
                    </span>

                    <h2>{{ $materi->judul }}</h2>

                </div>


                <!-- Menu navigasi -->
                <nav class="sidebar-menu">

                    <div class="menu-group">

                        <button
                            type="button"
                            class="menu-item menu-materi active"
                            id="menuMateri">

                            <span>Materi</span>

                            <span
                                class="menu-arrow open"
                                id="materiArrow">▾</span>

                        </button>


                        <!-- DAFTAR SUBBAB OTOMATIS -->
                        <div class="submenu-materi show"
                             id="submenuMateri">

                            @foreach ($daftarSubbab as $index => $item)

                                <button
                                    type="button"
                                    class="submenu-item {{ $index === 0 ? 'active' : '' }}"
                                    data-target="subbab-{{ $item->id }}">

                                    <span class="submenu-number">
                                        {{ $index + 1 }}
                                    </span>

                                    <span>
                                        {{ $item->judul }}
                                    </span>

                                </button>

                            @endforeach

                        </div>

                    </div>


                    <!-- Menu Ringkasan -->
                    <button
                        type="button"
                        class="menu-item"
                        id="menuRingkasan"
                        data-target="ringkasan">

                        <span>Ringkasan</span>

                    </button>


                    <!-- Menu Latihan -->
                    <button
                        type="button"
                        class="menu-item"
                        id="menuLatihan"
                        data-target="latihan">

                        <span>Latihan</span>

                    </button>

                </nav>

            </div>

        </aside>


        <!-- ================= KONTEN MATERI ================= -->

        <section class="materi-content"
                 id="materiContent">

            <div class="content-wrapper">


                <!-- MENAMPILKAN SELURUH SUBBAB -->
                @forelse ($daftarSubbab as $index => $item)

                    <section
                        class="content-section {{ $index === 0 ? 'active' : '' }}"
                        id="subbab-{{ $item->id }}">


                        <!-- Nomor subbab -->
                        <span class="materi-label">

                            Materi • Bagian {{ $index + 1 }}

                        </span>


                        <!-- Judul dari database -->
                        <h1>
                            {{ $item->judul }}
                        </h1>


                        <!-- Pengantar dari database -->
                        @if ($item->pengantar)

                            <p class="materi-description teks-materi">

                                {{ $item->pengantar }}

                            </p>

                        @endif


                        <!-- ISI MATERI DARI DATABASE -->
                        <div class="materi-box">

                            <div>

                                <h2>{{ $item->judul }}</h2>

                                <p class="teks-materi">
                                    {{ $item->isi }}
                                </p>

                            </div>

                        </div>


                        <!-- CONTOH DARI DATABASE -->
                        @if ($item->contoh)

                            @php
                                // Memisahkan contoh berdasarkan
                                // baris kosong dalam database
                                $daftarContoh = preg_split(
                                    '/\r?\n\s*\r?\n/',
                                    trim($item->contoh)
                                );
                            @endphp


                            <!-- Jika hanya satu contoh -->
                            @if (count($daftarContoh) === 1)

                                @php
                                    $bagian = explode(
                                        ': ',
                                        $daftarContoh[0],
                                        2
                                    );
                                @endphp

                                <div class="contoh-box">

                                    <strong>
                                        {{ count($bagian) === 2
                                            ? $bagian[0]
                                            : 'Contoh Materi' }}
                                    </strong>

                                    <p class="teks-materi">
                                        {{ count($bagian) === 2
                                            ? $bagian[1]
                                            : $bagian[0] }}
                                    </p>

                                </div>


                            <!-- Jika ada banyak contoh -->
                            @else

                                <div class="contoh-grid">

                                    @foreach ($daftarContoh as $contoh)

                                        @php
                                            $bagian = explode(
                                                ': ',
                                                $contoh,
                                                2
                                            );
                                        @endphp

                                        <div class="contoh-card">

                                            <strong>
                                                {{ count($bagian) === 2
                                                    ? $bagian[0]
                                                    : 'Contoh Materi' }}
                                            </strong>

                                            <p class="teks-materi">
                                                {{ count($bagian) === 2
                                                    ? $bagian[1]
                                                    : $bagian[0] }}
                                            </p>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                        @endif


                        <!-- VIDEO PADA SUBBAB KEEMPAT -->
                        @if ($index === 3)

                            <div class="video-pembelajaran">

                                <h2 class="video-judul">
                                    Yuk, Tonton Video Pembelajaran!
                                </h2>

                                <p class="video-deskripsi">
                                    Tonton video berikut untuk
                                    memperkuat pemahaman tentang
                                    hubungan komponen biotik
                                    dan abiotik.
                                </p>

                                <div class="video-card">

                                    <div
                                        class="youtube-player"
                                        id="videoHubungan"
                                        data-video-id="msXml9wII8A">

                                        <button
                                            type="button"
                                            class="youtube-thumbnail"
                                            aria-label="Putar video pembelajaran">

                                            <img
                                                src="https://img.youtube.com/vi/msXml9wII8A/hqdefault.jpg"
                                                alt="Video Pembelajaran"
                                                loading="lazy">

                                            <span class="youtube-play"></span>

                                        </button>

                                    </div>

                                    <div class="video-info">

                                        <h3>
                                            Video Pembelajaran
                                            Hubungan Biotik dan Abiotik
                                        </h3>

                                        <p>
                                            IPAS • Kelas V SD
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endif


                        <!-- NAVIGASI SEBELUMNYA / SELANJUTNYA -->
                        <div class="navigasi-materi">

                            @if ($index > 0)

                                <button
                                    type="button"
                                    class="btn-sebelumnya"
                                    data-target="subbab-{{ $daftarSubbab[$index - 1]->id }}">

                                    ← Sebelumnya

                                </button>

                            @else

                                <span></span>

                            @endif


                            @if ($index < $daftarSubbab->count() - 1)

                                <button
                                    type="button"
                                    class="btn-selanjutnya"
                                    data-target="subbab-{{ $daftarSubbab[$index + 1]->id }}">

                                    Selanjutnya →

                                </button>

                            @else

                                <button
                                    type="button"
                                    class="btn-selanjutnya"
                                    data-target="ringkasan">

                                    Ringkasan →

                                </button>

                            @endif

                        </div>

                    </section>


                @empty

                    <section class="content-section active"
                             id="belum-ada-materi">

                        <h1>Materi Belum Tersedia</h1>

                        <p>
                            Guru belum menambahkan subbab
                            untuk materi ini.
                        </p>

                    </section>

                @endforelse


                <!-- ================= RINGKASAN ================= -->

                <section class="content-section"
                         id="ringkasan">

                    <span class="materi-label">
                        Ringkasan Materi
                    </span>

                    <h1>
                        Ingat <span>Kembali Materinya</span>
                    </h1>

                    <p class="materi-description">
                        Berikut ringkasan pembelajaran
                        {{ $materi->judul }}.
                    </p>


                    <div class="ringkasan-box">

                        @if ($materi->ringkasan)

                            @php
                                // Memecah ringkasan menjadi paragraf
                                $paragrafRingkasan = preg_split(
                                    '/\r?\n\s*\r?\n/',
                                    trim($materi->ringkasan)
                                );
                            @endphp

                            @foreach ($paragrafRingkasan as $paragraf)

                                <div class="ringkasan-item">

                                    <div>
                                        <p class="teks-materi">
                                            {{ $paragraf }}
                                        </p>
                                    </div>

                                </div>

                            @endforeach

                        @else

                            <p>Ringkasan belum tersedia.</p>

                        @endif

                    </div>


                    <div class="navigasi-materi">

                        @if ($daftarSubbab->isNotEmpty())

                            <button
                                type="button"
                                class="btn-sebelumnya"
                                data-target="subbab-{{ $daftarSubbab->last()->id }}">

                                ← Sebelumnya

                            </button>

                        @else

                            <span></span>

                        @endif

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-target="latihan">

                            Latihan →

                        </button>

                    </div>

                </section>


                <!-- ================= LATIHAN ================= -->

                <section class="content-section"
                         id="latihan">

                    <span class="materi-label">
                        Latihan
                    </span>

                    <h1>
                        Coba <span>Latihan Interaktif</span>
                    </h1>

                    <p class="materi-description">
                        Setelah mempelajari materi,
                        sekarang waktunya menguji
                        pemahaman melalui aktivitas BAKAWAN.
                    </p>


                    <div class="latihan-card">

                        <span class="latihan-label">
                            AKTIVITAS INTERAKTIF
                        </span>

                        <h2>
                            Klasifikasi Biotik dan Abiotik
                        </h2>

                        <p>
                            Kelompokkan ikan, bangau, teratai,
                            air, tanah, dan cahaya matahari
                            ke dalam kategori biotik atau
                            abiotik.
                        </p>

                        <a href="{{ route('aktivitas.satu') }}"
                           class="btn-mulai-latihan">

                            Mulai Aktivitas →

                        </a>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-target="ringkasan">

                            ← Sebelumnya

                        </button>

                        <span></span>

                    </div>

                </section>


            </div>

        </section>

    </main>


    <!-- ================= JAVASCRIPT ================= -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Mengambil elemen dari halaman
            const menuMateri =
                document.getElementById("menuMateri");

            const submenuMateri =
                document.getElementById("submenuMateri");

            const materiArrow =
                document.getElementById("materiArrow");

            const menuRingkasan =
                document.getElementById("menuRingkasan");

            const menuLatihan =
                document.getElementById("menuLatihan");

            const materiContent =
                document.getElementById("materiContent");

            const semuaBagian =
                document.querySelectorAll(".content-section");

            const semuaSubmenu =
                document.querySelectorAll(".submenu-item");


            // MENAMPILKAN BAGIAN YANG DIPILIH
            function tampilkanBagian(idBagian) {

                const bagianTujuan =
                    document.getElementById(idBagian);

                if (!bagianTujuan) {
                    return;
                }

                // Menyembunyikan semua bagian
                semuaBagian.forEach(function (bagian) {

                    bagian.classList.remove("active");

                });

                // Menampilkan bagian yang dipilih
                bagianTujuan.classList.add("active");


                // Memperbarui menu sidebar
                semuaSubmenu.forEach(function (menu) {

                    menu.classList.toggle(
                        "active",
                        menu.dataset.target === idBagian
                    );

                });


                const sedangMateri =
                    idBagian.startsWith("subbab-");

                menuMateri.classList.toggle(
                    "active",
                    sedangMateri
                );

                submenuMateri.classList.toggle(
                    "show",
                    sedangMateri
                );

                materiArrow.classList.toggle(
                    "open",
                    sedangMateri
                );

                menuRingkasan.classList.toggle(
                    "active",
                    idBagian === "ringkasan"
                );

                menuLatihan.classList.toggle(
                    "active",
                    idBagian === "latihan"
                );


                // Menghentikan video saat pindah bagian
                const video =
                    document.getElementById("videoHubungan");

                if (video && !bagianTujuan.contains(video)) {

                    const iframe =
                        video.querySelector("iframe");

                    if (iframe && videoAwal) {
                        video.innerHTML = videoAwal;
                    }
                }


                // Mengembalikan scroll ke atas
                if (window.innerWidth > 991) {

                    materiContent.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });

                } else {

                    document.querySelector(".materi-detail")
                        ?.scrollIntoView({
                            behavior: "smooth"
                        });

                }
            }


            // KLIK MENU SUBBAB DAN NAVIGASI
            document.querySelectorAll("[data-target]")
                .forEach(function (tombol) {

                    tombol.addEventListener("click", function () {

                        tampilkanBagian(
                            tombol.dataset.target
                        );

                    });

                });


            // MEMBUKA ATAU MENUTUP MENU MATERI
            menuMateri.addEventListener("click", function () {

                submenuMateri.classList.toggle("show");

                materiArrow.classList.toggle("open");

            });


            // VIDEO YOUTUBE
            const video =
                document.getElementById("videoHubungan");

            const videoAwal = video ? video.innerHTML : "";

            if (video) {

                video.addEventListener("click", function (event) {

                    const tombol =
                        event.target.closest(".youtube-thumbnail");

                    if (!tombol) {
                        return;
                    }

                    const videoId = video.dataset.videoId;

                    if (!/^[a-zA-Z0-9_-]{11}$/.test(videoId)) {
                        return;
                    }

                    const iframe =
                        document.createElement("iframe");

                    iframe.src =
                        "https://www.youtube-nocookie.com/embed/" +
                        videoId +
                        "?autoplay=1&rel=0&playsinline=1";

                    iframe.title =
                        "Video Pembelajaran BAKAWAN";

                    iframe.allow =
                        "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture";

                    iframe.allowFullscreen = true;

                    video.replaceChildren(iframe);

                });
            }

        });
    </script>

</body>
</html>
