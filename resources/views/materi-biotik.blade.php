
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Komponen Biotik dan Abiotik | BAKAWAN</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS WEBSITE -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi-biotik.css') }}">

    <!-- CSS TAMBAHAN VIDEO -->
    <style>
        .video-pembelajaran {
            margin: 30px 0;
        }

        .video-judul {
            font-family: 'Poppins', sans-serif;
            font-size: 21px;
            font-weight: 700;
            color: #245c43;
            margin-bottom: 12px;
        }

        .video-deskripsi {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            line-height: 1.8;
            color: #5d6a60;
            margin-bottom: 18px;
        }

        .video-card {
            width: 100%;
            background: #ffffff;
            padding: 12px;
            border: 1px solid #e1eae3;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(35, 80, 50, 0.07);
        }

        .youtube-player {
            width: 100%;
            aspect-ratio: 16 / 9;
            position: relative;
            overflow: hidden;
            background: #193c2b;
            border-radius: 12px;
        }

        .youtube-thumbnail {
            display: block;
            width: 100%;
            height: 100%;
            position: relative;
            padding: 0;
            border: none;
            cursor: pointer;
            background: #193c2b;
        }

        .youtube-thumbnail img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .youtube-thumbnail:hover img {
            transform: scale(1.04);
        }

        .youtube-thumbnail::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.12);
            pointer-events: none;
        }

        .youtube-play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 76px;
            height: 54px;
            border-radius: 15px;
            background: #ff0033;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            transition: 0.2s;
        }

        .youtube-play::before {
            content: "";
            width: 0;
            height: 0;
            border-top: 11px solid transparent;
            border-bottom: 11px solid transparent;
            border-left: 19px solid #ffffff;
            margin-left: 4px;
        }

        .youtube-thumbnail:hover .youtube-play {
            background: #d9002b;
            transform: translate(-50%, -50%) scale(1.07);
        }

        .youtube-player iframe {
            display: block;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-info {
            padding: 16px 8px 6px;
        }

        .video-info h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #244b38;
            margin-bottom: 7px;
        }

        .video-info p {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: #758278;
            margin: 0;
        }

        @media (max-width: 768px) {
            .video-card {
                padding: 8px;
            }

            .video-judul {
                font-size: 18px;
            }

            .youtube-play {
                width: 62px;
                height: 44px;
            }

            .video-info h3 {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    @include('components.header')

    <main class="materi-detail">

        <!-- =====================================
             SIDEBAR MATERI
        ====================================== -->

        <aside class="sidebar-materi">
            <div class="sidebar-content">

                <a href="{{ route('materi') }}" class="btn-kembali-materi">
                    <span class="back-arrow">←</span>
                    <span>Kembali</span>
                </a>

                <div class="sidebar-title">
                    <span class="sidebar-label">MATERI 1</span>
                    <h2>Komponen Biotik dan Abiotik</h2>
                </div>

                <nav class="sidebar-menu">

                    <div class="menu-group">

                        <button
                            type="button"
                            class="menu-item menu-materi active"
                            id="menuMateri"
                        >
                            <span>Materi</span>
                            <span class="menu-arrow open" id="materiArrow">▾</span>
                        </button>

                        <div class="submenu-materi show" id="submenuMateri">

                            <button
                                type="button"
                                class="submenu-item active"
                                data-target="pengertian"
                            >
                                <span class="submenu-number">1</span>
                                <span>Pengertian</span>
                            </button>

                            <button
                                type="button"
                                class="submenu-item"
                                data-target="biotik"
                            >
                                <span class="submenu-number">2</span>
                                <span>Komponen Biotik</span>
                            </button>

                            <button
                                type="button"
                                class="submenu-item"
                                data-target="abiotik"
                            >
                                <span class="submenu-number">3</span>
                                <span>Komponen Abiotik</span>
                            </button>

                            <button
                                type="button"
                                class="submenu-item"
                                data-target="hubungan"
                            >
                                <span class="submenu-number">4</span>
                                <span>Hubungan Keduanya</span>
                            </button>

                            <button
                                type="button"
                                class="submenu-item"
                                data-target="contoh"
                            >
                                <span class="submenu-number">5</span>
                                <span>Contoh Ekosistem</span>
                            </button>

                            <button
                                type="button"
                                class="submenu-item"
                                data-target="lahan-basah"
                            >
                                <span class="submenu-number">6</span>
                                <span>Ekosistem Lahan Basah</span>
                            </button>

                        </div>
                    </div>

                    <button
                        type="button"
                        class="menu-item"
                        id="menuRingkasan"
                        data-target="ringkasan"
                    >
                        <span>Ringkasan</span>
                    </button>

                    <button
                        type="button"
                        class="menu-item"
                        id="menuLatihan"
                        data-target="latihan"
                    >
                        <span>Latihan</span>
                    </button>

                </nav>

            </div>
        </aside>


        <!-- =====================================
             KONTEN MATERI
        ====================================== -->

        <section class="materi-content" id="materiContent">

            <div class="content-wrapper">

                <!-- =================================
                     1. PENGERTIAN EKOSISTEM
                ================================== -->

                <section class="content-section active" id="pengertian">

                    <span class="materi-label">
                        Materi 1 • Bagian 1
                    </span>

                    <h1>
                        Apa itu <span>Ekosistem?</span>
                    </h1>

                    <p class="materi-description">
                        Sebelum mengenal komponen biotik dan abiotik,
                        mari kita pahami terlebih dahulu apa itu
                        ekosistem melalui lingkungan yang dekat
                        dengan kehidupan kita di Banjarmasin.
                    </p>

                    <div class="materi-box">
                        <div>
                            <h2>Pengertian Ekosistem</h2>

                            <p>
                                Ekosistem adalah hubungan antara
                                makhluk hidup dan lingkungan tidak
                                hidup yang berada di suatu tempat.
                                Semua bagian dalam ekosistem saling
                                berinteraksi dan saling memengaruhi.
                            </p>
                        </div>
                    </div>

                    <div class="contoh-box">
                        <strong>Contoh di Banjarmasin</strong>

                        <p>
                            Banjarmasin dikenal dengan lingkungan
                            sungai dan lahan basah. Di sekitar
                            sungai atau rawa, kita dapat menemukan
                            ikan, burung, tumbuhan air, air sungai,
                            tanah berlumpur, dan cahaya matahari.
                            Semua bagian tersebut membentuk
                            suatu ekosistem.
                        </p>
                    </div>

                    <div class="navigasi-materi">
                        <span></span>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="biotik"
                        >
                            Selanjutnya <span>→</span>
                        </button>
                    </div>

                </section>


                <!-- =================================
                     2. KOMPONEN BIOTIK
                ================================== -->

                <section class="content-section" id="biotik">

                    <span class="materi-label">
                        Materi 1 • Bagian 2
                    </span>

                    <h1>
                        Komponen <span>Biotik</span>
                    </h1>

                    <p class="materi-description">
                        Komponen biotik adalah semua makhluk hidup
                        yang terdapat di dalam ekosistem, termasuk
                        makhluk hidup yang dapat kita temukan
                        di lingkungan lahan basah Banjarmasin.
                    </p>

                    <div class="materi-box">
                        <div>
                            <h2>Apa itu Komponen Biotik?</h2>

                            <p>
                                Komponen biotik merupakan bagian
                                ekosistem yang berupa makhluk hidup.
                                Makhluk hidup dapat tumbuh,
                                membutuhkan makanan, dan berkembang
                                biak. Contohnya adalah ikan,
                                tumbuhan air, katak, burung,
                                serangga, dan manusia.
                            </p>
                        </div>
                    </div>

                    <div class="contoh-grid">

                        <div class="contoh-card">
                            <strong>Ikan</strong>

                            <p>
                                Ikan hidup di perairan seperti
                                sungai dan rawa. Ikan membutuhkan
                                air dan oksigen untuk bertahan hidup.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Katak</strong>

                            <p>
                                Katak dapat ditemukan di lingkungan
                                yang lembap atau dekat perairan.
                                Katak memakan serangga dan
                                membutuhkan air untuk berkembang biak.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Teratai</strong>

                            <p>
                                Teratai merupakan tumbuhan air
                                yang dapat hidup di perairan tenang.
                                Tumbuhan ini membutuhkan air
                                dan cahaya matahari.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Burung Bangau</strong>

                            <p>
                                Bangau merupakan salah satu contoh
                                burung yang dapat hidup di kawasan
                                lahan basah. Bangau mencari makanan
                                seperti ikan dan hewan kecil
                                di sekitar perairan.
                            </p>
                        </div>

                    </div>

                    <div class="contoh-box">
                        <strong>Perhatikan!</strong>

                        <p>
                            Ikan, katak, teratai, dan bangau
                            termasuk komponen biotik karena
                            semuanya merupakan makhluk hidup.
                            Masing-masing memiliki peran
                            dalam ekosistem lahan basah.
                        </p>
                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="pengertian"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="abiotik"
                        >
                            Selanjutnya <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     3. KOMPONEN ABIOTIK
                ================================== -->

                <section class="content-section" id="abiotik">

                    <span class="materi-label">
                        Materi 1 • Bagian 3
                    </span>

                    <h1>
                        Komponen <span>Abiotik</span>
                    </h1>

                    <p class="materi-description">
                        Selain makhluk hidup, ekosistem lahan basah
                        Banjarmasin juga memiliki unsur tidak hidup
                        yang mendukung kehidupan ikan, tumbuhan,
                        burung, dan makhluk hidup lainnya.
                    </p>

                    <div class="materi-box">
                        <div>
                            <h2>Apa itu Komponen Abiotik?</h2>

                            <p>
                                Komponen abiotik adalah unsur
                                tidak hidup yang terdapat dalam
                                suatu ekosistem. Walaupun tidak hidup,
                                komponen ini sangat penting karena
                                memengaruhi kehidupan makhluk hidup.
                                Contohnya adalah air, tanah,
                                cahaya matahari, udara, suhu,
                                batu, dan mineral.
                            </p>
                        </div>
                    </div>

                    <div class="contoh-grid">

                        <div class="contoh-card">
                            <strong>Air Sungai dan Rawa</strong>

                            <p>
                                Air menjadi tempat hidup ikan
                                dan berbagai organisme perairan.
                                Air juga dibutuhkan tumbuhan
                                dan hewan untuk bertahan hidup.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Tanah dan Lumpur</strong>

                            <p>
                                Tanah atau lumpur di sekitar
                                lahan basah menjadi tempat tumbuh
                                beberapa jenis tumbuhan serta
                                tempat hidup organisme tertentu.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Cahaya Matahari</strong>

                            <p>
                                Cahaya matahari membantu tumbuhan
                                air melakukan fotosintesis,
                                yaitu proses membuat makanan
                                dengan bantuan cahaya.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Udara</strong>

                            <p>
                                Udara mengandung oksigen
                                yang dibutuhkan manusia dan hewan
                                untuk bernapas. Tumbuhan juga
                                membutuhkan gas dari udara.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Suhu</strong>

                            <p>
                                Suhu lingkungan memengaruhi
                                aktivitas dan pertumbuhan
                                makhluk hidup, termasuk organisme
                                yang hidup di sungai dan rawa.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Batu dan Mineral</strong>

                            <p>
                                Batu dan mineral merupakan
                                unsur tidak hidup. Mineral
                                tertentu menjadi unsur hara
                                yang dibutuhkan tumbuhan.
                            </p>
                        </div>

                    </div>

                    <div class="contoh-box">
                        <strong>Contoh sederhana</strong>

                        <p>
                            Ikan membutuhkan air sebagai
                            tempat hidup, sedangkan teratai
                            membutuhkan air, cahaya matahari,
                            dan unsur hara untuk tumbuh.
                            Jadi, komponen abiotik membantu
                            mendukung kehidupan komponen biotik.
                        </p>
                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="biotik"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="hubungan"
                        >
                            Selanjutnya <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     4. HUBUNGAN KEDUANYA
                     VIDEO ADA DI BAGIAN INI
                ================================== -->

                <section class="content-section" id="hubungan">

                    <span class="materi-label">
                        Materi 1 • Bagian 4
                    </span>

                    <h1>
                        Hubungan Biotik dan <span>Abiotik</span>
                    </h1>

                    <p class="materi-description">
                        Di lingkungan sungai dan rawa Banjarmasin,
                        komponen biotik dan abiotik saling
                        membutuhkan. Makhluk hidup memanfaatkan
                        air, tanah, udara, dan cahaya matahari
                        untuk mendukung kehidupannya.
                    </p>

                    <div class="materi-box">
                        <div>
                            <h2>Bagaimana Keduanya Berhubungan?</h2>

                            <p>
                                Komponen biotik membutuhkan
                                komponen abiotik untuk hidup.
                                Contohnya, ikan membutuhkan air
                                sebagai tempat hidup, sedangkan
                                teratai membutuhkan air dan
                                cahaya matahari untuk tumbuh.
                                Kondisi air, tanah, dan suhu
                                juga memengaruhi makhluk hidup
                                yang dapat tinggal di suatu tempat.
                            </p>
                        </div>
                    </div>

                    <div class="hubungan-box">

                        <div class="hubungan-item">
                            <strong>Komponen Biotik</strong>
                            <p>Ikan, teratai, katak, dan bangau</p>
                        </div>

                        <div class="hubungan-panah">↔</div>

                        <div class="hubungan-item">
                            <strong>Komponen Abiotik</strong>
                            <p>Air, tanah, udara, dan cahaya matahari</p>
                        </div>

                    </div>

                    <div class="contoh-box">
                        <strong>Contoh hubungan di lahan basah</strong>

                        <p>
                            Di sebuah rawa, teratai menggunakan
                            cahaya matahari untuk membuat makanan.
                            Ikan hidup di dalam air, sedangkan
                            bangau dapat mencari ikan sebagai
                            makanannya. Jika kondisi air berubah,
                            kehidupan ikan dan makhluk hidup
                            lainnya juga dapat terpengaruh.
                        </p>
                    </div>


                    <!-- =================================
                         VIDEO YOUTUBE TERBARU
                         E0jbWRmGOvg
                    ================================== -->

                    <div class="video-pembelajaran">

                        <h2 class="video-judul">
                            Yuk, Tonton Video Pembelajaran!
                        </h2>

                        <p class="video-deskripsi">
                            Setelah mempelajari hubungan antara
                            komponen biotik dan abiotik, mari
                            kita tonton video berikut untuk
                            memperkuat pemahaman. Perhatikan
                            bagaimana makhluk hidup berhubungan
                            dengan lingkungan tidak hidup.
                        </p>

                        <div class="video-card">

                            <div
                                class="youtube-player"
                                id="videoHubungan"
                                data-video-id="msXml9wII8A"
                            >

                                <button
                                    type="button"
                                    class="youtube-thumbnail"
                                    aria-label="Putar video pembelajaran hubungan biotik dan abiotik"
                                >

                                    <img
                                        src="https://img.youtube.com/vi/msXml9wII8A/hqdefault.jpg""
                                        alt="Thumbnail video pembelajaran"
                                        loading="lazy"
                                    >

                                    <span class="youtube-play"></span>

                                </button>

                            </div>

                            <div class="video-info">
                                <h3>
                                    Video Pembelajaran Hubungan Biotik dan Abiotik
                                </h3>

                                <p>
                                    Video Pembelajaran IPAS • Kelas V SD
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- AKHIR VIDEO YOUTUBE -->


                    <div class="contoh-box">
                        <strong>Setelah menonton video</strong>

                        <p>
                            Coba pikirkan: apa yang terjadi
                            pada ikan jika air sungai
                            menjadi sangat kotor?
                            Mengapa tumbuhan air
                            membutuhkan cahaya matahari?
                            Pertanyaan ini membantu kita
                            memahami pentingnya hubungan
                            biotik dan abiotik.
                        </p>
                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="abiotik"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="contoh"
                        >
                            Selanjutnya <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     5. CONTOH EKOSISTEM
                ================================== -->

                <section class="content-section" id="contoh">

                    <span class="materi-label">
                        Materi 1 • Bagian 5
                    </span>

                    <h1>
                        Contoh <span>Ekosistem</span>
                    </h1>

                    <p class="materi-description">
                        Ekosistem dapat ditemukan di berbagai
                        tempat. Di Banjarmasin, lingkungan
                        sungai dan rawa menjadi contoh
                        ekosistem yang dekat dengan
                        kehidupan masyarakat.
                    </p>

                    <div class="contoh-grid">

                        <div class="contoh-card">
                            <strong>Sungai</strong>

                            <p>
                                Sungai menjadi tempat hidup
                                ikan dan berbagai organisme air.
                                Di dalamnya terdapat komponen
                                biotik seperti ikan serta
                                komponen abiotik seperti air
                                dan cahaya matahari.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Rawa</strong>

                            <p>
                                Rawa merupakan ekosistem
                                lahan basah yang memiliki
                                tanah jenuh air atau tergenang.
                                Lingkungan ini dapat menjadi
                                tempat hidup tumbuhan air,
                                serangga, ikan, dan burung.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Kolam</strong>

                            <p>
                                Kolam memiliki air, ikan,
                                tumbuhan air, dan berbagai
                                organisme lainnya yang
                                saling berhubungan.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Kebun</strong>

                            <p>
                                Kebun memiliki tumbuhan,
                                serangga, tanah, udara,
                                dan cahaya matahari.
                                Semua komponen tersebut
                                membentuk suatu ekosistem.
                            </p>
                        </div>

                    </div>

                    <div class="contoh-box">
                        <strong>Ayo bandingkan!</strong>

                        <p>
                            Sungai dan rawa memiliki
                            banyak air, sedangkan kebun
                            umumnya memiliki permukaan tanah
                            yang lebih kering. Perbedaan
                            kondisi lingkungan menyebabkan
                            jenis makhluk hidup yang ditemukan
                            juga dapat berbeda.
                        </p>
                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="hubungan"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="lahan-basah"
                        >
                            Selanjutnya <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     6. EKOSISTEM LAHAN BASAH
                ================================== -->

                <section class="content-section" id="lahan-basah">

                    <span class="materi-label">
                        Materi 1 • Bagian 6
                    </span>

                    <h1>
                        Ekosistem <span>Lahan Basah</span>
                    </h1>

                    <p class="materi-description">
                        Banjarmasin memiliki lingkungan
                        yang erat kaitannya dengan sungai
                        dan lahan basah. Lingkungan ini
                        dapat digunakan untuk memahami
                        hubungan antara komponen biotik
                        dan abiotik secara langsung.
                    </p>

                    <div class="materi-box">
                        <div>
                            <h2>Lahan Basah Banua</h2>

                            <p>
                                Lahan basah adalah lingkungan
                                yang tanahnya tergenang air
                                atau memiliki kandungan air
                                yang tinggi, baik sepanjang
                                waktu maupun pada periode tertentu.
                                Contohnya adalah rawa.
                                Di lingkungan lahan basah,
                                air menjadi salah satu unsur
                                penting yang memengaruhi
                                kehidupan makhluk hidup.
                            </p>
                        </div>
                    </div>

                    <div class="contoh-grid">

                        <div class="contoh-card">
                            <strong>Makhluk Hidup</strong>

                            <p>
                                Ikan, katak, tumbuhan air,
                                serangga, dan burung merupakan
                                contoh komponen biotik yang
                                dapat ditemukan pada berbagai
                                lingkungan lahan basah.
                            </p>
                        </div>

                        <div class="contoh-card">
                            <strong>Lingkungan Tidak Hidup</strong>

                            <p>
                                Air, tanah berlumpur, udara,
                                suhu, dan cahaya matahari
                                merupakan komponen abiotik
                                yang memengaruhi kehidupan
                                di lahan basah.
                            </p>
                        </div>

                    </div>

                    <div class="contoh-box">
                        <strong>Contoh di lingkungan Banjarmasin</strong>

                        <p>
                            Ketika mengamati sungai atau rawa,
                            kita dapat melihat air yang menjadi
                            tempat hidup ikan, tumbuhan yang
                            memanfaatkan cahaya matahari,
                            serta burung yang mencari makanan
                            di sekitar perairan.
                            Hal ini menunjukkan bahwa
                            komponen biotik dan abiotik
                            saling berhubungan.
                        </p>
                    </div>

                    <div class="contoh-box">
                        <strong>Mengapa lahan basah penting?</strong>

                        <p>
                            Lahan basah menyediakan habitat
                            bagi berbagai makhluk hidup,
                            membantu menyimpan air,
                            dan mendukung keseimbangan
                            lingkungan. Oleh karena itu,
                            menjaga kebersihan sungai
                            dan rawa merupakan salah satu
                            cara menjaga ekosistem.
                        </p>
                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="contoh"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="ringkasan"
                        >
                            Ringkasan <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     RINGKASAN
                ================================== -->

                <section class="content-section" id="ringkasan">

                    <span class="materi-label">
                        Ringkasan Materi
                    </span>

                    <h1>
                        Ingat <span>Kembali Materinya</span>
                    </h1>

                    <p class="materi-description">
                        Berikut adalah inti pembelajaran
                        tentang komponen biotik dan abiotik
                        dalam ekosistem lahan basah Banjarmasin.
                    </p>

                    <div class="ringkasan-box">

                        <div class="ringkasan-item">
                            <div>
                                <strong>Ekosistem</strong>

                                <p>
                                    Ekosistem merupakan hubungan
                                    antara makhluk hidup dan
                                    lingkungan tidak hidup
                                    yang saling memengaruhi.
                                </p>
                            </div>
                        </div>

                        <div class="ringkasan-item">
                            <div>
                                <strong>Komponen Biotik</strong>

                                <p>
                                    Komponen biotik adalah
                                    semua makhluk hidup.
                                    Contohnya ikan, katak,
                                    teratai, dan bangau.
                                </p>
                            </div>
                        </div>

                        <div class="ringkasan-item">
                            <div>
                                <strong>Komponen Abiotik</strong>

                                <p>
                                    Komponen abiotik adalah
                                    unsur tidak hidup.
                                    Contohnya air, tanah,
                                    udara, cahaya matahari,
                                    dan suhu.
                                </p>
                            </div>
                        </div>

                        <div class="ringkasan-item">
                            <div>
                                <strong>Hubungan Keduanya</strong>

                                <p>
                                    Komponen biotik membutuhkan
                                    komponen abiotik.
                                    Contohnya ikan membutuhkan
                                    air dan teratai membutuhkan
                                    cahaya matahari.
                                </p>
                            </div>
                        </div>

                        <div class="ringkasan-item">
                            <div>
                                <strong>Lahan Basah Banjarmasin</strong>

                                <p>
                                    Sungai dan rawa merupakan
                                    lingkungan yang membantu
                                    kita memahami hubungan
                                    makhluk hidup dengan
                                    air, tanah, dan unsur
                                    tidak hidup lainnya.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="lahan-basah"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="latihan"
                        >
                            Latihan <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     LATIHAN
                ================================== -->

                <section class="content-section" id="latihan">

                    <span class="materi-label">
                        Latihan
                    </span>

                    <h1>
                        Coba <span>Latihan Interaktif</span>
                    </h1>

                    <p class="materi-description">
                        Setelah mempelajari komponen biotik
                        dan abiotik di lingkungan lahan basah
                        Banjarmasin, sekarang saatnya
                        menguji pemahaman melalui aktivitas
                        interaktif BAKAWAN.
                    </p>

                    <div class="latihan-card">

                        <span class="latihan-label">
                            AKTIVITAS INTERAKTIF
                        </span>

                        <h2>
                            Klasifikasi Biotik dan Abiotik
                        </h2>

                        <p>
                            Kelompokkan berbagai objek
                            seperti ikan, bangau, teratai,
                            air, tanah, dan cahaya matahari
                            ke dalam kategori biotik
                            atau abiotik dengan tepat.
                        </p>

                        <a
                            href="{{ route('aktivitas.satu') }}"
                            class="btn-mulai-latihan"
                        >
                            Mulai Aktivitas <span>→</span>
                        </a>

                    </div>

                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="ringkasan"
                        >
                            <span>←</span> Sebelumnya
                        </button>

                        <span></span>

                    </div>

                </section>

            </div>
        </section>

    </main>


    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <!-- =====================================
         JAVASCRIPT NAVIGASI DAN VIDEO
    ====================================== -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const menuMateri =
                document.getElementById("menuMateri");

            const menuRingkasan =
                document.getElementById("menuRingkasan");

            const menuLatihan =
                document.getElementById("menuLatihan");

            const submenuMateri =
                document.getElementById("submenuMateri");

            const materiArrow =
                document.getElementById("materiArrow");

            const submenuItems =
                document.querySelectorAll(".submenu-item");

            const sections =
                document.querySelectorAll(".content-section");

            const nextButtons =
                document.querySelectorAll("[data-next]");

            const prevButtons =
                document.querySelectorAll("[data-prev]");

            const materiContent =
                document.getElementById("materiContent");


            // =====================================
            // VIDEO YOUTUBE
            // =====================================

            const youtubePlayer =
                document.getElementById("videoHubungan");

            let thumbnailAsli = "";

            if (youtubePlayer) {

                thumbnailAsli = youtubePlayer.innerHTML;

                youtubePlayer.addEventListener("click", function (event) {

                    const tombolPlay =
                        event.target.closest(".youtube-thumbnail");

                    if (!tombolPlay) {
                        return;
                    }

                    const videoId = youtubePlayer.dataset.videoId;

                    // Pastikan ID video valid
                    if (!/^[a-zA-Z0-9_-]{11}$/.test(videoId)) {
                        return;
                    }

                    const iframe = document.createElement("iframe");

                    iframe.src =
                        "https://www.youtube-nocookie.com/embed/" +
                        videoId +
                        "?autoplay=1&rel=0&playsinline=1";

                    iframe.title =
                        "Video Pembelajaran Hubungan Biotik dan Abiotik BAKAWAN";

                    iframe.setAttribute(
                        "allow",
                        "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    );

                    iframe.setAttribute("allowfullscreen", "");

                    iframe.referrerPolicy =
                        "strict-origin-when-cross-origin";

                    youtubePlayer.replaceChildren(iframe);

                });
            }


            // =====================================
            // HENTIKAN VIDEO SAAT PINDAH SUBBAB
            // =====================================

            function hentikanVideo() {

                if (!youtubePlayer) {
                    return;
                }

                const iframe = youtubePlayer.querySelector("iframe");

                if (iframe) {
                    youtubePlayer.innerHTML = thumbnailAsli;
                }
            }


            // =====================================
            // BUKA SUBMENU
            // =====================================

            function bukaSubmenuMateri() {

                submenuMateri.classList.add("show");
                materiArrow.classList.add("open");

            }


            // =====================================
            // TUTUP SUBMENU
            // =====================================

            function tutupSubmenuMateri() {

                submenuMateri.classList.remove("show");
                materiArrow.classList.remove("open");

            }


            // =====================================
            // HAPUS MENU AKTIF
            // =====================================

            function hapusMenuAktif() {

                menuMateri.classList.remove("active");
                menuRingkasan.classList.remove("active");
                menuLatihan.classList.remove("active");

            }


            // =====================================
            // TAMPILKAN BAGIAN MATERI
            // =====================================

            function tampilkanSection(target) {

                const sectionTarget =
                    document.getElementById(target);

                if (!sectionTarget) {
                    return;
                }

                // Hentikan video saat keluar dari bagian Hubungan
                if (target !== "hubungan") {
                    hentikanVideo();
                }

                sections.forEach(function (section) {
                    section.classList.remove("active");
                });

                sectionTarget.classList.add("active");

                const daftarSubbab = [
                    "pengertian",
                    "biotik",
                    "abiotik",
                    "hubungan",
                    "contoh",
                    "lahan-basah"
                ];

                if (daftarSubbab.includes(target)) {

                    hapusMenuAktif();

                    menuMateri.classList.add("active");

                    bukaSubmenuMateri();

                    submenuItems.forEach(function (item) {

                        item.classList.toggle(
                            "active",
                            item.dataset.target === target
                        );

                    });

                } else if (target === "ringkasan") {

                    hapusMenuAktif();

                    menuRingkasan.classList.add("active");

                    tutupSubmenuMateri();

                    submenuItems.forEach(function (item) {
                        item.classList.remove("active");
                    });

                } else if (target === "latihan") {

                    hapusMenuAktif();

                    menuLatihan.classList.add("active");

                    tutupSubmenuMateri();

                    submenuItems.forEach(function (item) {
                        item.classList.remove("active");
                    });

                }


                // =====================================
                // SCROLL KE ATAS
                // =====================================

                if (window.innerWidth > 991) {

                    materiContent.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });

                } else {

                    const materiDetail =
                        document.querySelector(".materi-detail");

                    if (materiDetail) {

                        window.scrollTo({
                            top: materiDetail.offsetTop,
                            behavior: "smooth"
                        });

                    }
                }
            }


            // =====================================
            // MENU MATERI
            // =====================================

            menuMateri.addEventListener("click", function () {

                const terbuka =
                    submenuMateri.classList.contains("show");

                if (terbuka) {

                    tutupSubmenuMateri();

                } else {

                    hapusMenuAktif();

                    menuMateri.classList.add("active");

                    bukaSubmenuMateri();

                }

            });


            // =====================================
            // KLIK SUBBAB
            // =====================================

            submenuItems.forEach(function (item) {

                item.addEventListener("click", function () {

                    tampilkanSection(item.dataset.target);

                });

            });


            // =====================================
            // RINGKASAN
            // =====================================

            menuRingkasan.addEventListener("click", function () {

                tampilkanSection("ringkasan");

            });


            // =====================================
            // LATIHAN
            // =====================================

            menuLatihan.addEventListener("click", function () {

                tampilkanSection("latihan");

            });


            // =====================================
            // TOMBOL SELANJUTNYA
            // =====================================

            nextButtons.forEach(function (button) {

                button.addEventListener("click", function () {

                    tampilkanSection(button.dataset.next);

                });

            });


            // =====================================
            // TOMBOL SEBELUMNYA
            // =====================================

            prevButtons.forEach(function (button) {

                button.addEventListener("click", function () {

                    tampilkanSection(button.dataset.prev);

                });

            });

        });
    </script>

</body>
</html>
