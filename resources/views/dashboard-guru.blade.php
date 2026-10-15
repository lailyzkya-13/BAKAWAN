
@extends('layouts.app-guru')

@section('content')

<!-- ==========================================
     1. HEADER DASHBOARD
========================================== -->

<div class="dashboard-background">

    <div class="dashboard-header">
        <h1>Dashboard Guru</h1>
        <p>Selamat datang kembali di Portal Guru BAKAWAN</p>
    </div>

</div>


<!-- ==========================================
     2. RINGKASAN DATA
========================================== -->

<div class="summary-container">

    <!-- Jumlah Kelas -->
    <div class="summary-card">

        <div class="summary-icon">
            <i data-lucide="book-open"></i>
        </div>

        <div>
            <p>Jumlah Kelas</p>

            <!-- Data kelas dari database -->
            <h2>{{ $jumlahKelas }}</h2>

            <span>Kelas yang terdaftar</span>
        </div>

    </div>


    <!-- Jumlah Murid -->
    <div class="summary-card">

        <div class="summary-icon">
            <i data-lucide="users"></i>
        </div>

        <div>
            <p>Jumlah Murid</p>

            <!-- Data siswa dari database -->
            <h2>{{ $jumlahMurid }}</h2>

            <span>Total siswa yang terdaftar</span>
        </div>

    </div>


    <!-- Rata-rata Nilai -->
    <div class="summary-card">

        <div class="summary-icon">
            <i data-lucide="star"></i>
        </div>

        <div>
            <p>Rata-rata Nilai</p>

            <!-- Rata-rata nilai dari database -->
            <h2>
                @if ($rataRataNilai !== null)

                    {{ number_format(
                        (float) $rataRataNilai,
                        1,
                        ',',
                        '.'
                    ) }}

                @else

                    0

                @endif
            </h2>

            <span>Rata-rata seluruh hasil kuis</span>
        </div>

    </div>

</div>


<!-- ==========================================
     3. BAGIAN BAWAH DASHBOARD
========================================== -->

<div class="dashboard-grid">


    <!-- ======================================
         AKTIVITAS MURID
    ======================================= -->

    <div class="dashboard-box">

        <div class="box-header">
            <h2>Aktivitas Murid</h2>
            <p>Aktivitas evaluasi terbaru siswa</p>
        </div>


        <div class="activity-list">

            <!-- Menampilkan data kuis terbaru -->
            @forelse ($aktivitasTerbaru as $aktivitas)

                <div class="activity-item">

                    <!-- Ikon Aktivitas -->
                    <div class="activity-icon">
                        <i data-lucide="file-check"></i>
                    </div>


                    <!-- Informasi Siswa -->
                    <div class="activity-content">

                        <!-- Nama dan kelas siswa -->
                        <strong>
                            {{ $aktivitas->nama_lengkap }}
                            - Kelas {{ $aktivitas->kelas }}
                        </strong>

                        <!-- Nilai evaluasi -->
                        <p>
                            Menyelesaikan Kuis Ekosistem
                            dengan nilai
                            <b>{{ $aktivitas->nilai }}</b>
                        </p>

                        <!-- Waktu pengerjaan -->
                        <span>
                            {{ $aktivitas->created_at->locale('id')->diffForHumans() }}
                        </span>

                    </div>

                </div>

            @empty

                <!-- Jika belum ada siswa mengerjakan kuis -->
                <p class="empty-message">
                    Belum ada aktivitas evaluasi siswa.
                </p>

            @endforelse

        </div>

    </div>



    <!-- ======================================
         REKAP NILAI KUIS PER KELAS
    ======================================= -->

    <div class="dashboard-box">

        <div class="box-header">
            <h2>Rekap Nilai Kuis</h2>
            <p>Rata-rata nilai setiap kelas</p>
        </div>


        <div class="score-list">

            <!-- Mengambil data setiap kelas -->
            @forelse ($rekapNilaiPerKelas as $rekap)

                @php
                    // Mengambil rata-rata nilai kelas
                    $nilaiKelas = $rekap->rata_rata_nilai;

                    // Nilai untuk lebar progress bar
                    $persentase = $nilaiKelas === null
                        ? 0
                        : min(100, max(0, (float) $nilaiKelas));
                @endphp


                <div class="score-item">

                    <!-- Nama Kelas dan Nilai -->
                    <div class="score-info">

                        <strong>
                            Kelas {{ $rekap->kelas }}
                        </strong>

                        <span>

                            @if ($nilaiKelas !== null)

                                {{ number_format(
                                    (float) $nilaiKelas,
                                    1,
                                    ',',
                                    '.'
                                ) }}

                            @else

                                Belum ada nilai

                            @endif

                        </span>

                    </div>


                    <!-- Progress Bar Nilai -->
                    <div class="progress">

                        <div
                            class="progress-bar"
                            style="width: {{ $persentase }}%;"
                        ></div>

                    </div>

                </div>


            @empty

                <!-- Jika belum ada data kelas -->
                <p class="empty-message">
                    Belum ada data kelas yang terdaftar.
                </p>

            @endforelse

        </div>

    </div>

</div>


<!-- ==========================================
     4. CSS DASHBOARD GURU
========================================== -->

<style>

    /* Background Bagian Atas */
    .dashboard-background {
        position: relative;
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;

        min-height: 350px;
        overflow: hidden;
    }

    .dashboard-background::before {
        content: "";
        position: absolute;

        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        background-color: rgba(255, 255, 255, 0.30);
    }

    .dashboard-background > * {
        position: relative;
        z-index: 1;
    }


    /* Judul Dashboard */
    .dashboard-header h1 {
        margin-bottom: 5px;
        color: #1b4332;
    }

    .dashboard-header p {
        margin: 0;
        color: #6b7280;
        font-size: 15px;
    }


    /* ======================================
       KARTU RINGKASAN
    ====================================== */

    .summary-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .summary-card {
        background-color: white;
        border-radius: 14px;
        padding: 20px;

        display: flex;
        align-items: center;
        gap: 15px;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        transition: 0.2s;
    }

    .summary-card:hover {
        transform: translateY(-3px);
    }

    .summary-icon {
        width: 50px;
        height: 50px;

        border-radius: 12px;
        background-color: #d8f3dc;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .summary-icon svg {
        width: 26px;
        height: 26px;

        color: #2d6a4f;
        stroke-width: 2;
    }

    .summary-card p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    .summary-card h2 {
        margin: 4px 0;
        color: #1b4332;
        font-size: 25px;
    }

    .summary-card span {
        font-size: 12px;
        color: #9ca3af;
    }


    /* ======================================
       BAGIAN BAWAH DASHBOARD
    ====================================== */

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 20px;
    }

    .dashboard-box {
        background-color: white;
        border-radius: 14px;
        padding: 22px;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    }

    .box-header {
        margin-bottom: 20px;
    }

    .box-header h2 {
        margin: 0;
        color: #1b4332;
        font-size: 20px;
    }

    .box-header p {
        margin: 5px 0 0;
        color: #9ca3af;
        font-size: 13px;
    }


    /* ======================================
       AKTIVITAS MURID
    ====================================== */

    .activity-item {
        display: flex;
        gap: 12px;
        padding: 14px 0;

        border-bottom: 1px solid #eeeeee;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 38px;
        height: 38px;

        border-radius: 10px;
        background-color: #d8f3dc;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .activity-icon svg {
        width: 21px;
        height: 21px;

        color: #2d6a4f;
        stroke-width: 2;
    }

    .activity-content strong {
        color: #2d6a4f;
        font-size: 14px;
    }

    .activity-content p {
        margin: 3px 0;
        color: #555;
        font-size: 13px;
    }

    .activity-content span {
        color: #9ca3af;
        font-size: 11px;
    }


    /* ======================================
       REKAP NILAI KUIS
    ====================================== */

    .score-item {
        margin-bottom: 20px;
    }

    .score-info {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 7px;
    }

    .score-info strong {
        color: #374151;
        font-size: 14px;
    }

    .score-info span {
        color: #2d6a4f;
        font-weight: bold;
    }

    /* Background Progress */
    .progress {
        width: 100%;
        height: 9px;

        background-color: #eeeeee;
        border-radius: 10px;

        overflow: hidden;
    }

    /* Warna Progress Nilai */
    .progress-bar {
        height: 100%;
        background-color: #2d6a4f;
        border-radius: 10px;
    }


    /* Jika belum ada data */
    .empty-message {
        color: #9ca3af;
        font-size: 13px;
        padding: 15px 0;
        text-align: center;
    }


    /* ======================================
       RESPONSIVE
    ====================================== */

    @media (max-width: 1000px) {

        .summary-container {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 600px) {

        .summary-container {
            grid-template-columns: 1fr;
        }

    }

</style>


<!-- ==========================================
     5. ICON DASHBOARD
========================================== -->

<script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (window.lucide) {
            lucide.createIcons();
        }

    });
</script>

@endsection
