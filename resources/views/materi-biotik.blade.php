<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Komponen Biotik dan Abiotik | BAKAWAN</title>

    <!-- GOOGLE FONT -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- HEADER -->
    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}"
    >

    <!-- DETAIL MATERI -->
    <link
        rel="stylesheet"
        href="{{ asset('css/materi-biotik.css') }}"
    >
</head>


<body>

    @include('components.header')


    <main class="materi-detail">


        <!-- =====================================
             SIDEBAR
        ====================================== -->

        <aside class="sidebar-materi">

            <div class="sidebar-content">


                <!-- KEMBALI -->

                <a
                    href="{{ route('materi') }}"
                    class="btn-kembali-materi"
                >
                    <span class="back-arrow">←</span>
                    <span>Kembali</span>
                </a>


                <!-- JUDUL -->

                <div class="sidebar-title">

                    <span class="sidebar-label">
                        MATERI 1
                    </span>

                    <h2>
                        Komponen Biotik dan Abiotik
                    </h2>

                </div>


                <!-- MENU -->

                <nav class="sidebar-menu">


                    <!-- =========================
                         MATERI
                    ========================== -->

                    <div class="menu-group">

                        <button
                            type="button"
                            class="menu-item menu-materi active"
                            id="menuMateri"
                        >

                            <span>
                                Materi
                            </span>

                            <span
                                class="menu-arrow open"
                                id="materiArrow"
                            >
                                ▾
                            </span>

                        </button>


                        <!-- SUBBAB -->

                        <div
                            class="submenu-materi show"
                            id="submenuMateri"
                        >

                            <button
                                type="button"
                                class="submenu-item active"
                                data-target="pengertian"
                            >
                                <span class="submenu-number">
                                    1
                                </span>

                                <span>
                                    Pengertian
                                </span>
                            </button>


                            <button
                                type="button"
                                class="submenu-item"
                                data-target="biotik"
                            >
                                <span class="submenu-number">
                                    2
                                </span>

                                <span>
                                    Komponen Biotik
                                </span>
                            </button>


                            <button
                                type="button"
                                class="submenu-item"
                                data-target="abiotik"
                            >
                                <span class="submenu-number">
                                    3
                                </span>

                                <span>
                                    Komponen Abiotik
                                </span>
                            </button>


                            <button
                                type="button"
                                class="submenu-item"
                                data-target="hubungan"
                            >
                                <span class="submenu-number">
                                    4
                                </span>

                                <span>
                                    Hubungan Keduanya
                                </span>
                            </button>


                            <button
                                type="button"
                                class="submenu-item"
                                data-target="contoh"
                            >
                                <span class="submenu-number">
                                    5
                                </span>

                                <span>
                                    Contoh Ekosistem
                                </span>
                            </button>


                            <button
                                type="button"
                                class="submenu-item"
                                data-target="lahan-basah"
                            >
                                <span class="submenu-number">
                                    6
                                </span>

                                <span>
                                    Ekosistem Lahan Basah
                                </span>
                            </button>

                        </div>

                    </div>


                    <!-- =========================
                         RINGKASAN
                    ========================== -->

                    <button
                        type="button"
                        class="menu-item"
                        id="menuRingkasan"
                        data-target="ringkasan"
                    >
                        <span>
                            Ringkasan
                        </span>
                    </button>


                    <!-- =========================
                         LATIHAN
                    ========================== -->

                    <button
                        type="button"
                        class="menu-item"
                        id="menuLatihan"
                        data-target="latihan"
                    >
                        <span>
                            Latihan
                        </span>
                    </button>

                </nav>

            </div>

        </aside>


        <!-- =====================================
             KONTEN MATERI
        ====================================== -->

        <section
            class="materi-content"
            id="materiContent"
        >

            <div class="content-wrapper">


                <!-- =================================
                     1. PENGERTIAN
                ================================== -->

                <section
                    class="content-section active"
                    id="pengertian"
                >

                    <span class="materi-label">
                        Materi 1 • Bagian 1
                    </span>

                    <h1>
                        Apa itu
                        <span>Ekosistem?</span>
                    </h1>

                    <p class="materi-description">
                        Sebelum mengenal komponen biotik dan abiotik,
                        kita perlu mengetahui terlebih dahulu apa yang
                        dimaksud dengan ekosistem.
                    </p>


                    <div class="materi-box">

                        <div>

                            <h2>
                                Ekosistem
                            </h2>

                            <p>
                                Ekosistem merupakan suatu lingkungan
                                yang di dalamnya terdapat makhluk hidup
                                dan benda tidak hidup yang saling
                                berhubungan. Kedua komponen tersebut
                                saling berinteraksi sehingga membentuk
                                suatu kesatuan.
                            </p>

                        </div>

                    </div>


                    <div class="contoh-box">

                        <strong>
                            Contoh sederhana
                        </strong>

                        <p>
                            Di sebuah rawa terdapat ikan, tumbuhan air,
                            burung, air, tanah, dan cahaya matahari.
                            Semua bagian tersebut berada dalam satu
                            lingkungan dan saling berhubungan.
                        </p>

                    </div>


                    <div class="navigasi-materi">

                        <span></span>

                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="biotik"
                        >
                            Selanjutnya
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     2. BIOTIK
                ================================== -->

                <section
                    class="content-section"
                    id="biotik"
                >

                    <span class="materi-label">
                        Materi 1 • Bagian 2
                    </span>

                    <h1>
                        Komponen
                        <span>Biotik</span>
                    </h1>

                    <p class="materi-description">
                        Komponen biotik adalah semua makhluk hidup
                        yang terdapat di dalam suatu ekosistem.
                    </p>


                    <div class="materi-box">

                        <div>

                            <h2>
                                Apa itu komponen biotik?
                            </h2>

                            <p>
                                Komponen biotik merupakan bagian
                                ekosistem yang berupa makhluk hidup.
                                Contohnya adalah manusia, ikan,
                                tumbuhan, serangga, burung, katak,
                                dan jamur.
                            </p>

                        </div>

                    </div>


                    <div class="contoh-grid">

                        <div class="contoh-card">
                            <strong>Ikan</strong>

                            <p>
                                Ikan merupakan makhluk hidup yang
                                dapat ditemukan pada ekosistem
                                perairan.
                            </p>
                        </div>


                        <div class="contoh-card">
                            <strong>Katak</strong>

                            <p>
                                Katak termasuk makhluk hidup yang
                                dapat ditemukan di lingkungan basah.
                            </p>
                        </div>


                        <div class="contoh-card">
                            <strong>Tumbuhan</strong>

                            <p>
                                Tumbuhan merupakan bagian hidup
                                dalam suatu ekosistem.
                            </p>
                        </div>


                        <div class="contoh-card">
                            <strong>Burung</strong>

                            <p>
                                Burung termasuk komponen biotik
                                karena merupakan makhluk hidup.
                            </p>
                        </div>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="pengertian"
                        >
                            <span>←</span>
                            Sebelumnya
                        </button>


                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="abiotik"
                        >
                            Selanjutnya
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     3. ABIOTIK
                ================================== -->

                <section
                    class="content-section"
                    id="abiotik"
                >

                    <span class="materi-label">
                        Materi 1 • Bagian 3
                    </span>

                    <h1>
                        Komponen
                        <span>Abiotik</span>
                    </h1>

                    <p class="materi-description">
                        Komponen abiotik adalah unsur tidak hidup
                        yang terdapat di lingkungan dan memengaruhi
                        kehidupan makhluk hidup.
                    </p>


                    <div class="materi-box">

                        <div>

                            <h2>
                                Apa itu komponen abiotik?
                            </h2>

                            <p>
                                Komponen abiotik merupakan bagian
                                ekosistem yang tidak hidup.
                                Contohnya adalah air, tanah,
                                cahaya matahari, udara, suhu,
                                dan mineral.
                            </p>

                        </div>

                    </div>


                    <div class="contoh-grid">

                        <div class="contoh-card">
                            <strong>Air</strong>

                            <p>
                                Air menjadi bagian penting dalam
                                berbagai ekosistem.
                            </p>
                        </div>


                        <div class="contoh-card">
                            <strong>Cahaya Matahari</strong>

                            <p>
                                Cahaya matahari dibutuhkan tumbuhan
                                untuk mendukung kehidupannya.
                            </p>
                        </div>


                        <div class="contoh-card">
                            <strong>Tanah</strong>

                            <p>
                                Tanah merupakan unsur tidak hidup
                                yang mendukung kehidupan.
                            </p>
                        </div>


                        <div class="contoh-card">
                            <strong>Udara</strong>

                            <p>
                                Udara termasuk unsur tidak hidup
                                yang terdapat di lingkungan.
                            </p>
                        </div>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="biotik"
                        >
                            <span>←</span>
                            Sebelumnya
                        </button>


                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="hubungan"
                        >
                            Selanjutnya
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     4. HUBUNGAN
                ================================== -->

                <section
                    class="content-section"
                    id="hubungan"
                >

                    <span class="materi-label">
                        Materi 1 • Bagian 4
                    </span>

                    <h1>
                        Hubungan Biotik dan
                        <span>Abiotik</span>
                    </h1>

                    <p class="materi-description">
                        Komponen biotik dan abiotik tidak berdiri
                        sendiri. Keduanya saling berhubungan
                        di dalam suatu ekosistem.
                    </p>


                    <div class="materi-box">

                        <div>

                            <h2>
                                Saling Membutuhkan
                            </h2>

                            <p>
                                Tumbuhan membutuhkan cahaya matahari,
                                air, udara, tanah, dan mineral untuk
                                mendukung kehidupannya. Ikan juga
                                membutuhkan air sebagai tempat hidup.
                            </p>

                        </div>

                    </div>


                    <div class="hubungan-box">

                        <div class="hubungan-item">

                            <strong>
                                Komponen Biotik
                            </strong>

                            <p>
                                Tumbuhan dan ikan
                            </p>

                        </div>


                        <div class="hubungan-panah">
                            ↔
                        </div>


                        <div class="hubungan-item">

                            <strong>
                                Komponen Abiotik
                            </strong>

                            <p>
                                Air dan cahaya matahari
                            </p>

                        </div>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="abiotik"
                        >
                            <span>←</span>
                            Sebelumnya
                        </button>


                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="contoh"
                        >
                            Selanjutnya
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     5. CONTOH EKOSISTEM
                ================================== -->

                <section
                    class="content-section"
                    id="contoh"
                >

                    <span class="materi-label">
                        Materi 1 • Bagian 5
                    </span>

                    <h1>
                        Contoh
                        <span>Ekosistem</span>
                    </h1>

                    <p class="materi-description">
                        Ekosistem dapat ditemukan di berbagai
                        tempat di sekitar kita.
                    </p>


                    <div class="contoh-grid">

                        <div class="contoh-card">

                            <strong>
                                Taman
                            </strong>

                            <p>
                                Memiliki tumbuhan, hewan kecil,
                                tanah, air, dan cahaya matahari.
                            </p>

                        </div>


                        <div class="contoh-card">

                            <strong>
                                Kebun
                            </strong>

                            <p>
                                Terdapat tumbuhan, serangga,
                                tanah, air, dan udara.
                            </p>

                        </div>


                        <div class="contoh-card">

                            <strong>
                                Kolam
                            </strong>

                            <p>
                                Memiliki ikan, tumbuhan air,
                                air, dan berbagai unsur lainnya.
                            </p>

                        </div>


                        <div class="contoh-card">

                            <strong>
                                Rawa
                            </strong>

                            <p>
                                Salah satu ekosistem lahan basah
                                yang dapat ditemukan di Banua.
                            </p>

                        </div>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="hubungan"
                        >
                            <span>←</span>
                            Sebelumnya
                        </button>


                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="lahan-basah"
                        >
                            Selanjutnya
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     6. LAHAN BASAH
                ================================== -->

                <section
                    class="content-section"
                    id="lahan-basah"
                >

                    <span class="materi-label">
                        Materi 1 • Bagian 6
                    </span>

                    <h1>
                        Ekosistem
                        <span>Lahan Basah</span>
                    </h1>

                    <p class="materi-description">
                        Lahan basah merupakan contoh lingkungan
                        yang menunjukkan hubungan antara komponen
                        biotik dan abiotik dengan jelas.
                    </p>


                    <div class="materi-box">

                        <div>

                            <h2>
                                Lahan Basah Banua
                            </h2>

                            <p>
                                Dalam ekosistem lahan basah,
                                air memiliki peranan penting.
                                Ikan, tumbuhan air, serangga,
                                burung, dan organisme lainnya
                                berinteraksi dengan air,
                                tanah atau lumpur, cahaya matahari,
                                serta udara.
                            </p>

                        </div>

                    </div>


                    <div class="contoh-box">

                        <strong>
                            Perhatikan lingkungan sekitar
                        </strong>

                        <p>
                            Ketika melihat rawa, sungai,
                            atau lingkungan perairan lainnya,
                            kita dapat menemukan berbagai
                            komponen hidup dan tidak hidup
                            yang saling berhubungan.
                        </p>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="contoh"
                        >
                            <span>←</span>
                            Sebelumnya
                        </button>


                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="ringkasan"
                        >
                            Ringkasan
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     RINGKASAN
                ================================== -->

                <section
                    class="content-section"
                    id="ringkasan"
                >

                    <span class="materi-label">
                        Ringkasan Materi
                    </span>

                    <h1>
                        Ingat
                        <span>Kembali Materinya</span>
                    </h1>

                    <p class="materi-description">
                        Berikut adalah inti dari materi
                        komponen biotik dan abiotik yang
                        telah dipelajari.
                    </p>


                    <div class="ringkasan-box">

                        <div class="ringkasan-item">

                            <div>

                                <strong>
                                    Ekosistem
                                </strong>

                                <p>
                                    Ekosistem tersusun atas komponen
                                    hidup dan tidak hidup yang
                                    saling berhubungan.
                                </p>

                            </div>

                        </div>


                        <div class="ringkasan-item">

                            <div>

                                <strong>
                                    Komponen Biotik
                                </strong>

                                <p>
                                    Komponen biotik adalah semua
                                    makhluk hidup dalam ekosistem.
                                </p>

                            </div>

                        </div>


                        <div class="ringkasan-item">

                            <div>

                                <strong>
                                    Komponen Abiotik
                                </strong>

                                <p>
                                    Komponen abiotik adalah unsur
                                    tidak hidup yang memengaruhi
                                    kehidupan.
                                </p>

                            </div>

                        </div>


                        <div class="ringkasan-item">

                            <div>

                                <strong>
                                    Hubungan Keduanya
                                </strong>

                                <p>
                                    Komponen biotik dan abiotik
                                    saling berhubungan dalam
                                    suatu ekosistem.
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
                            <span>←</span>
                            Sebelumnya
                        </button>


                        <button
                            type="button"
                            class="btn-selanjutnya"
                            data-next="latihan"
                        >
                            Latihan
                            <span>→</span>
                        </button>

                    </div>

                </section>


                <!-- =================================
                     LATIHAN
                ================================== -->

                <section
                    class="content-section"
                    id="latihan"
                >

                    <span class="materi-label">
                        Latihan
                    </span>

                    <h1>
                        Coba
                        <span>Latihan Interaktif</span>
                    </h1>

                    <p class="materi-description">
                        Setelah memahami materi, sekarang
                        kelompokkan komponen biotik dan abiotik
                        melalui aktivitas interaktif BAKAWAN.
                    </p>


                    <div class="latihan-card">

                        <span class="latihan-label">
                            AKTIVITAS INTERAKTIF
                        </span>

                        <h2>
                            Klasifikasi Biotik dan Abiotik
                        </h2>

                        <p>
                            Kelompokkan berbagai objek ke dalam
                            kategori biotik atau abiotik
                            dengan tepat.
                        </p>


                        <a
                            href="{{ route('aktivitas.satu') }}"
                            class="btn-mulai-latihan"
                        >
                            Mulai Aktivitas
                            <span>→</span>
                        </a>

                    </div>


                    <div class="navigasi-materi">

                        <button
                            type="button"
                            class="btn-sebelumnya"
                            data-prev="ringkasan"
                        >
                            <span>←</span>
                            Sebelumnya
                        </button>

                        <span></span>

                    </div>

                </section>

            </div>

        </section>

    </main>


    <!-- BOOTSTRAP -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- =====================================
         SIDEBAR & NAVIGASI MATERI
    ====================================== -->

    <script>

        document.addEventListener(
            "DOMContentLoaded",
            function () {

                const menuMateri =
                    document.getElementById(
                        "menuMateri"
                    );

                const menuRingkasan =
                    document.getElementById(
                        "menuRingkasan"
                    );

                const menuLatihan =
                    document.getElementById(
                        "menuLatihan"
                    );

                const submenuMateri =
                    document.getElementById(
                        "submenuMateri"
                    );

                const materiArrow =
                    document.getElementById(
                        "materiArrow"
                    );

                const submenuItems =
                    document.querySelectorAll(
                        ".submenu-item"
                    );

                const sections =
                    document.querySelectorAll(
                        ".content-section"
                    );

                const nextButtons =
                    document.querySelectorAll(
                        "[data-next]"
                    );

                const prevButtons =
                    document.querySelectorAll(
                        "[data-prev]"
                    );

                const materiContent =
                    document.getElementById(
                        "materiContent"
                    );


                /* =============================
                   BUKA SUBMENU MATERI
                ============================== */

                function bukaSubmenuMateri() {

                    submenuMateri.classList.add(
                        "show"
                    );

                    materiArrow.classList.add(
                        "open"
                    );

                }


                /* =============================
                   TUTUP SUBMENU MATERI
                ============================== */

                function tutupSubmenuMateri() {

                    submenuMateri.classList.remove(
                        "show"
                    );

                    materiArrow.classList.remove(
                        "open"
                    );

                }


                /* =============================
                   MENU AKTIF
                ============================== */

                function hapusMenuAktif() {

                    menuMateri.classList.remove(
                        "active"
                    );

                    menuRingkasan.classList.remove(
                        "active"
                    );

                    menuLatihan.classList.remove(
                        "active"
                    );

                }


                /* =============================
                   TAMPILKAN SECTION
                ============================== */

                function tampilkanSection(target) {

                    sections.forEach(
                        function (section) {

                            section.classList.remove(
                                "active"
                            );

                        }
                    );


                    const sectionTarget =
                        document.getElementById(
                            target
                        );


                    if (!sectionTarget) {
                        return;
                    }


                    sectionTarget.classList.add(
                        "active"
                    );


                    /* =========================
                       JIKA SUBBAB MATERI
                    ========================== */

                    const daftarSubbab = [
                        "pengertian",
                        "biotik",
                        "abiotik",
                        "hubungan",
                        "contoh",
                        "lahan-basah"
                    ];


                    if (
                        daftarSubbab.includes(
                            target
                        )
                    ) {

                        hapusMenuAktif();

                        menuMateri.classList.add(
                            "active"
                        );

                        bukaSubmenuMateri();


                        submenuItems.forEach(
                            function (item) {

                                item.classList.toggle(
                                    "active",
                                    item.dataset.target ===
                                        target
                                );

                            }
                        );

                    }


                    /* =========================
                       JIKA RINGKASAN
                    ========================== */

                    if (
                        target === "ringkasan"
                    ) {

                        hapusMenuAktif();

                        menuRingkasan.classList.add(
                            "active"
                        );

                        tutupSubmenuMateri();


                        submenuItems.forEach(
                            function (item) {

                                item.classList.remove(
                                    "active"
                                );

                            }
                        );

                    }


                    /* =========================
                       JIKA LATIHAN
                    ========================== */

                    if (
                        target === "latihan"
                    ) {

                        hapusMenuAktif();

                        menuLatihan.classList.add(
                            "active"
                        );

                        tutupSubmenuMateri();


                        submenuItems.forEach(
                            function (item) {

                                item.classList.remove(
                                    "active"
                                );

                            }
                        );

                    }


                    /* =========================
                       SCROLL ATAS
                    ========================== */

                    if (
                        window.innerWidth > 991
                    ) {

                        materiContent.scrollTo({
                            top: 0,
                            behavior: "smooth"
                        });

                    } else {

                        const posisi =
                            document
                                .querySelector(
                                    ".materi-detail"
                                )
                                .offsetTop;


                        window.scrollTo({
                            top: posisi,
                            behavior: "smooth"
                        });

                    }

                }


                /* =============================
                   KLIK MATERI
                ============================== */

                menuMateri.addEventListener(
                    "click",
                    function () {

                        const terbuka =
                            submenuMateri.classList.contains(
                                "show"
                            );


                        if (terbuka) {

                            tutupSubmenuMateri();

                        } else {

                            hapusMenuAktif();

                            menuMateri.classList.add(
                                "active"
                            );

                            bukaSubmenuMateri();

                        }

                    }
                );


                /* =============================
                   KLIK SUBBAB
                ============================== */

                submenuItems.forEach(
                    function (item) {

                        item.addEventListener(
                            "click",
                            function () {

                                tampilkanSection(
                                    item.dataset.target
                                );

                            }
                        );

                    }
                );


                /* =============================
                   RINGKASAN
                ============================== */

                menuRingkasan.addEventListener(
                    "click",
                    function () {

                        tampilkanSection(
                            "ringkasan"
                        );

                    }
                );


                /* =============================
                   LATIHAN
                ============================== */

                menuLatihan.addEventListener(
                    "click",
                    function () {

                        tampilkanSection(
                            "latihan"
                        );

                    }
                );


                /* =============================
                   SELANJUTNYA
                ============================== */

                nextButtons.forEach(
                    function (button) {

                        button.addEventListener(
                            "click",
                            function () {

                                tampilkanSection(
                                    button.dataset.next
                                );

                            }
                        );

                    }
                );


                /* =============================
                   SEBELUMNYA
                ============================== */

                prevButtons.forEach(
                    function (button) {

                        button.addEventListener(
                            "click",
                            function () {

                                tampilkanSection(
                                    button.dataset.prev
                                );

                            }
                        );

                    }
                );

            }
        );

    </script>

</body>

</html>