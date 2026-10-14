
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BAKAWAN - Portal Guru</title>

    <style>
        /* Pengaturan dasar */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* ================= HEADER ================= */

        .header {
            width: 100%;
            height: 70px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        /* Logo BAKAWAN */
        .header-logo img {
            height: 70px;
            width: auto;
            object-fit: contain;
        }

        /* Menu kanan header */
        .header-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .header-menu a {
            color: #2d6a4f;
            text-decoration: none;
            font-weight: bold;
        }

        .header-menu a:hover {
            color: #1b4332;
        }

        /* Tombol Keluar berwarna merah */
        .header-menu .btn-logout {
            background-color: #FF0000;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: 0.2s;
        }

        .header-menu .btn-logout:hover {
            background-color: #cc0000;
            color: white;
        }

        /* ================= LAYOUT ================= */

        .layout {
            display: flex;
            margin-top: 70px;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 240px;
            height: calc(100vh - 70px);
            background-color: #b7e4c7;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 70px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
            overflow-y: auto;
        }

        /* Judul sidebar */
        .sidebar-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar-title h2 {
            margin: 0;
            color: #1b4332;
            font-size: 24px;
        }

        .sidebar-title p {
            margin: 5px 0 0;
            color: #52796f;
            font-size: 14px;
        }

        /* Kotak menu sidebar */
        .menu-card {
            width: 100%;
            background-color: white;
            border-radius: 10px;
            margin-bottom: 12px;
            padding: 16px 18px;
            transition: 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .menu-card a {
            display: block;
            color: #2d6a4f;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        /* Efek ketika menu disentuh mouse */
        .menu-card:hover {
            background-color: #e8f5ec;
            transform: translateX(3px);
        }

        /* Menu yang sedang aktif */
        .menu-card.active {
            background-color: #FF788D;
        }

        .menu-card.active a {
            color: white;
        }

        /* ================= CONTENT ================= */

        .content {
            margin-left: 240px;
            width: calc(100% - 240px);
            padding: 30px;
        }

        .content h1 {
            margin-top: 0;
            color: #2d6a4f;
        }

        /* Kotak dashboard */
        .dashboard-card {
            background-color: #FFFAF3;
            padding: 25px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h2 {
            margin-top: 0;
            color: #2d6a4f;
        }

        .dashboard-card p {
            color: #555;
        }

    </style>
</head>

<body>

    <!-- ================= HEADER ================= -->

    <div class="header">

        <!-- Logo BAKAWAN -->
        <div class="header-logo">
            <img src="{{ asset('images/logo-bakawan.png') }}"
                 alt="Logo BAKAWAN">
        </div>

        <!-- Menu kanan atas -->
        <div class="header-menu">

            <a href="/dashboard">Dashboard</a>

            <a href="/profil">Profil</a>

            <!-- Tombol Keluar -->
            <a href="#" class="btn-logout">Keluar</a>

        </div>

    </div>


    <!-- ================= LAYOUT ================= -->

    <div class="layout">

        <!-- ================= SIDEBAR ================= -->

        <div class="sidebar">

            <!-- Judul Sidebar -->
            <div class="sidebar-title">
                <h2>BAKAWAN</h2>
                <p>Portal Guru</p>
            </div>

            <!-- Menu Dashboard -->
            <div class="menu-card {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard">
                    Dashboard
                </a>
            </div>

            <!-- Menu Materi -->
            <div class="menu-card {{ request()->is('materi*') ? 'active' : '' }}">
                <a href="/materi">
                    Materi
                </a>
            </div>

            <!-- Menu Game -->
            <div class="menu-card {{ request()->is('game*') ? 'active' : '' }}">
                <a href="/game">
                    Game
                </a>
            </div>

            <!-- Menu Soal Kuis -->
            <div class="menu-card {{ request()->is('soal-kuis*') ? 'active' : '' }}">
                <a href="/soal-kuis">
                    Soal Kuis
                </a>
            </div>

            <!-- Menu Hasil Evaluasi -->
            <div class="menu-card {{ request()->is('hasil-evaluasi*') ? 'active' : '' }}">
                <a href="/hasil-evaluasi">
                    Hasil Evaluasi
                </a>
            </div>

            <!-- Menu Profil -->
            <div class="menu-card {{ request()->is('profil*') ? 'active' : '' }}">
                <a href="/profil">
                    Profil
                </a>
            </div>

        </div>
        <!-- Akhir Sidebar -->


        <!-- ================= CONTENT ================= -->

        <div class="content">

            @yield('content')

        </div>
        <!-- Akhir Content -->

    </div>
    <!-- Akhir Layout -->

</body>

</html>
