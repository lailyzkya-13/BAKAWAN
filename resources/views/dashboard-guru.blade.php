@extends('layouts.app-guru')

@section('content')

<!-- Background Bagian Atas -->
<div class="dashboard-background">

<!-- Judul Dashboard -->
<div class="dashboard-header">
    <div>
        <h1>Dashboard Guru</h1>
        <p>Selamat datang kembali di Portal Guru BAKAWAN 👋</p>
    </div>
</div>

</div>

<!-- Ringkasan Data -->
<div class="summary-container">

<!-- Jumlah Kelas -->
<div class="summary-card">
    <div class="summary-icon">📚</div>

    <div>
        <p>Jumlah Kelas</p>
        <h2>4</h2>
        <span>Kelas yang diajar</span>
    </div>
</div>


<!-- Jumlah Murid -->
<div class="summary-card">
    <div class="summary-icon">👨‍🎓</div>

    <div>
        <p>Jumlah Murid</p>
        <h2>120</h2>
        <span>Total murid</span>
    </div>
</div>


<!-- Kuis Selesai -->
<div class="summary-card">
    <div class="summary-icon">📝</div>

    <div>
        <p>Kuis Selesai</p>
        <h2>86</h2>
        <span>Minggu ini</span>
    </div>
</div>


<!-- Rata-rata Nilai -->
<div class="summary-card">
    <div class="summary-icon">⭐</div>

    <div>
        <p>Rata-rata Nilai</p>
        <h2>84</h2>
        <span>Nilai seluruh kelas</span>
    </div>
</div>

</div>

<!-- Bagian Bawah -->
<div class="dashboard-grid">

<!-- Aktivitas Murid -->
<div class="dashboard-box">

    <div class="box-header">
        <div>
            <h2>Aktivitas Murid</h2>
            <p>Aktivitas terbaru siswa</p>
        </div>
    </div>


    <div class="activity-list">

        <div class="activity-item">
            <div class="activity-icon">📝</div>

            <div class="activity-content">
                <strong>Kelas 5A</strong>
                <p>Baru saja menyelesaikan Kuis Ekosistem</p>
                <span>5 menit yang lalu</span>
            </div>
        </div>


        <div class="activity-item">
            <div class="activity-icon">🎮</div>

            <div class="activity-content">
                <strong>Kelas 5B</strong>
                <p>Menyelesaikan Game Bajaga Banua</p>
                <span>15 menit yang lalu</span>
            </div>
        </div>


        <div class="activity-item">
            <div class="activity-icon">📝</div>

            <div class="activity-content">
                <strong>Kelas 5C</strong>
                <p>Menyelesaikan Kuis Rantai Makanan</p>
                <span>30 menit yang lalu</span>
            </div>
        </div>


        <div class="activity-item">
            <div class="activity-icon">🏆</div>

            <div class="activity-content">
                <strong>Kelas 5A</strong>
                <p>Mendapatkan nilai rata-rata 90 pada kuis</p>
                <span>1 jam yang lalu</span>
            </div>
        </div>

    </div>

</div>


<!-- Rekap Nilai -->
<div class="dashboard-box">

    <div class="box-header">
        <div>
            <h2>Rekap Nilai Kuis</h2>
            <p>Rata-rata nilai setiap kelas</p>
        </div>
    </div>


    <div class="score-list">

        <!-- Kelas 5A -->
        <div class="score-item">

            <div class="score-info">
                <strong>Kelas 5A</strong>
                <span>90</span>
            </div>

            <div class="progress">
                <div class="progress-bar" style="width: 90%;"></div>
            </div>

        </div>


        <!-- Kelas 5B -->
        <div class="score-item">

            <div class="score-info">
                <strong>Kelas 5B</strong>
                <span>84</span>
            </div>

            <div class="progress">
                <div class="progress-bar" style="width: 84%;"></div>
            </div>

        </div>


        <!-- Kelas 5C -->
        <div class="score-item">

            <div class="score-info">
                <strong>Kelas 5C</strong>
                <span>78</span>
            </div>

            <div class="progress">
                <div class="progress-bar" style="width: 78%;"></div>
            </div>

        </div>


        <!-- Kelas 5D -->
        <div class="score-item">

            <div class="score-info">
                <strong>Kelas 5D</strong>
                <span>88</span>
            </div>

            <div class="progress">
                <div class="progress-bar" style="width: 88%;"></div>
            </div>

        </div>

    </div>

</div>

</div>

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


    /* Header Dashboard */
    .dashboard-header {
        margin-bottom: 0;
    }

    .dashboard-header h1 {
        margin-bottom: 5px;
        color: #1b4332;
    }

    .dashboard-header p {
        margin: 0;
        color: #6b7280;
        font-size: 15px;
    }


    /* Summary */
    .summary-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
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
        font-size: 24px;
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


    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 20px;
    }


    /* Box */
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


    /* Aktivitas */
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


    /* Rekap Nilai */
    .score-item {
        margin-bottom: 20px;
    }

    .score-info {
        display: flex;
        justify-content: space-between;
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

    .progress {
        width: 100%;
        height: 9px;
        background-color: #eeeeee;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background-color: #2d6a4f;
        border-radius: 10px;
    }


    /* Responsive */
    @media (max-width: 1000px) {

        .summary-container {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

    }

</style>

@endsection
