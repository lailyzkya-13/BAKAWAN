<!DOCTYPE html>
<html>

<head>
    <title>BAKAWAN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }


        /* header */
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

        .header-logo {
            color: #2d6a4f;
            font-size: 22px;
            font-weight: bold;
        }

        .header-logo img {
            height: 70px;
            width: auto;
            object-fit: contain;
        }

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


        /* layout */
        .layout {
            display: flex;
            margin-top: 70px;
        }


        /* sidebar */
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


        /* title sidebar */
        .sidebar-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar-title h2 {
            margin: 0;
            color: #1b4332;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar-title p {
            margin: 5px 0 0;
            color: #52796f;
            font-size: 14px;
        }


        /* menu sidebar */
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

        .menu-card:hover {
            background-color: #e8f5ec;
            transform: translateX(3px);
        }


        /* menu aktif */
        .menu-card.active {
            background-color: #FF788D;
        }

        .menu-card.active a {
            color: white;
        }


        /* menu keluar */
        .menu-logout {
            margin-top: auto;

            padding-top: 15px;

            border-top: 1px solid rgba(45, 106, 79, 0.25);
        }

        .menu-logout .menu-card {
            background-color: #FF0000;
        }

        .menu-logout .menu-card a {
            color: white;
        }

        .menu-logout .menu-card:hover {
            background-color: #cc0000;
        }

        /* content */
        .content {
            margin-left: 240px;
            width: calc(100% - 240px);
            padding: 30px;
        }

        .content h1 {
            margin-top: 0;
            color: #2d6a4f;
        }


        /* dashboard card */
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


    <!-- header -->
    <div class="header">
        <div class="header-logo">
            <img src="{{ asset('images/logo-bakawan.png') }}" alt="Logo BAKAWAN">
        </div>

        <div class="header-menu">
            <a href="/dashboard">
                Dashboard
            </a>

            <a href="#">
                Profil
            </a>
        </div>
    </div>


    <!-- layout -->
    <div class="layout">


        <!-- sidebar -->
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
            <div class="menu-card {{ request()->is('materi') ? 'active' : '' }}">
                <a href="/materi">
                    Materi
                </a>
            </div>

            <!-- Menu Game -->
            <div class="menu-card {{ request()->is('game') ? 'active' : '' }}">
                <a href="/game">
                    Game
                </a>
            </div>

            <!-- Menu Soal Kuis -->
            <div class="menu-card {{ request()->is('soal-kuis') ? 'active' : '' }}">
                <a href="/soal-kuis">
                    Soal Kuis
                </a>
            </div>

            <!-- Menu Hasil Evaluasi -->
            <div class="menu-card {{ request()->is('hasil-evaluasi') ? 'active' : '' }}">
                <a href="/hasil-evaluasi">
                    Hasil Evaluasi
                </a>
            </div>

            <!-- Menu Profil -->
            <div class="menu-card {{ request()->is('profil') ? 'active' : '' }}">
                <a href="/profil">
                    Profil
                </a>
            </div>

            <!-- Menu Keluar -->
            <div class="menu-logout">
                <div class="menu-card">
                    <a href="#">
                        Keluar
                    </a>
                </div>
            </div>
        </div>


        <!-- content -->

        <div class="content">

            @yield('content')

        </div>

    </div>

</body>

</html>