<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aktivitas | BAKAWAN</title>

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
    <link rel="stylesheet" href="{{ asset('css/aktivitas.css') }}">
</head>

<body>

    @include('components.header')


    <main class="aktivitas-page">

        <!-- DEKORASI BACKGROUND -->
        <div class="dekorasi dekorasi-kiri"></div>
        <div class="dekorasi dekorasi-kanan"></div>


        <div class="container-aktivitas">

            <!-- =====================================
                 JUDUL
            ====================================== -->
            <section class="aktivitas-heading">

                <span class="label-halaman">
                    Aktivitas Interaktif
                </span>

                <h1>
                    Pilih Aktivitas
                    <span>Belajarmu!</span>
                </h1>

                <p>
                    Yuk, belajar tentang ekosistem melalui
                    aktivitas yang seru dan menyenangkan.
                </p>

            </section>


            <!-- =====================================
                 DAFTAR AKTIVITAS
            ====================================== -->
            <section class="aktivitas-grid">


                <!-- =================================
                     AKTIVITAS 1
                ================================== -->
                <article class="aktivitas-card card-hijau">

                    <div class="nomor-card">
                        01
                    </div>

                    <div class="icon-card icon-hijau">
                        🌿
                    </div>

                    <span class="jenis-aktivitas">
                        Drag & Drop
                    </span>

                    <h2>
                        Klasifikasi Biotik
                        & Abiotik
                    </h2>

                    <p>
                        Kelompokkan berbagai objek ke dalam
                        komponen biotik atau abiotik dengan tepat.
                    </p>

                    <div class="contoh-mini">
                        <span>🐟</span>
                        <span>🌿</span>
                        <span>💧</span>
                        <span>☀️</span>
                    </div>

                    <a
                        href="{{ route('aktivitas.satu') }}"
                        class="btn-aktivitas btn-hijau"
                    >
                        Mulai Aktivitas
                        <span>→</span>
                    </a>

                </article>


                <!-- =================================
                     AKTIVITAS 2
                ================================== -->
                <article class="aktivitas-card card-biru">

                    <div class="nomor-card">
                        02
                    </div>

                    <div class="icon-card icon-biru">
                        🔗
                    </div>

                    <span class="jenis-aktivitas">
                        Mencocokkan
                    </span>

                    <h2>
                        Hubungan dalam
                        Ekosistem
                    </h2>

                    <p>
                        Cocokkan makhluk hidup dengan komponen
                        lingkungan yang memiliki hubungan dengannya.
                    </p>

                    <div class="contoh-mini">
                        <span>🐟</span>
                        <span>+</span>
                        <span>💧</span>
                        <span>✓</span>
                    </div>

                    <a
                        href="{{ route('aktivitas.dua') }}"
                        class="btn-aktivitas btn-biru"
                    >
                        Mulai Aktivitas
                        <span>→</span>
                    </a>

                </article>


                <!-- =================================
                     GAME UTAMA
                ================================== -->
                <article class="aktivitas-card card-pink">

                    <div class="nomor-card">
                        03
                    </div>

                    <div class="icon-card icon-pink">
                        🐦
                    </div>

                    <span class="jenis-aktivitas">
                        Game Utama
                    </span>

                    <h2>
                        Petualangan
                        Si Bangau
                    </h2>

                    <p>
                        Ikuti petualangan Si Bangau sambil
                        mengenali ekosistem lahan basah Banua.
                    </p>

                    <div class="contoh-mini">
                        <span>🐦</span>
                        <span>🌾</span>
                        <span>🐟</span>
                        <span>🌊</span>
                    </div>

                    <button
                        type="button"
                        class="btn-aktivitas btn-pink"
                        onclick="tampilkanPesan('Petualangan Si Bangau')"
                    >
                        Mulai Bermain
                        <span>→</span>
                    </button>

                </article>

            </section>


            <!-- =====================================
                 PETUNJUK
            ====================================== -->
            <section class="petunjuk-section">

                <div class="petunjuk-icon">
                    💡
                </div>

                <div>
                    <strong>
                        Yuk, belajar sambil bermain!
                    </strong>

                    <p>
                        Kamu bisa memilih aktivitas yang ingin
                        dimainkan. Baca petunjuk pada setiap
                        aktivitas dan selesaikan tantangannya.
                    </p>
                </div>

            </section>

        </div>

    </main>


    <!-- =====================================
         MODAL AKTIVITAS BELUM TERSEDIA
    ====================================== -->
    <div
        class="modal fade"
        id="modalBelumTersedia"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content modal-bakawan">

                <div class="modal-body text-center">

                    <div class="modal-icon">
                        🌱
                    </div>

                    <h3 id="modalJudul">
                        Aktivitas
                    </h3>

                    <p>
                        Aktivitas ini sedang dalam tahap
                        pengembangan.
                    </p>

                    <button
                        type="button"
                        class="btn-modal"
                        data-bs-dismiss="modal"
                    >
                        Oke
                    </button>

                </div>

            </div>

        </div>
    </div>


    <!-- Bootstrap -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


    <script>
        function tampilkanPesan(namaAktivitas) {

            document.getElementById('modalJudul')
                .textContent = namaAktivitas;

            const modal = new bootstrap.Modal(
                document.getElementById(
                    'modalBelumTersedia'
                )
            );

            modal.show();
        }
    </script>

</body>

</html>