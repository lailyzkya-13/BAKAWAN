<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-bakawan">

        <div class="container-fluid header-container">

            <!-- LOGO -->
            <a
                class="navbar-brand logo-area"
                href="{{ route('beranda') }}"
            >
                <img
                    src="{{ asset('images/logo-bakawan.png') }}"
                    alt="Logo BAKAWAN"
                    class="logo-bakawan"
                >
            </a>


            <!-- TOGGLE MOBILE -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarBakawan"
                aria-controls="navbarBakawan"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>


            <!-- MENU -->
            <div
                class="collapse navbar-collapse"
                id="navbarBakawan"
            >

                <ul class="navbar-nav nav-menu">

                    <!-- BERANDA -->
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}"
                            href="{{ route('beranda') }}"
                        >
                            Beranda
                        </a>
                    </li>


                    <!-- AKTIVITAS -->
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('aktivitas*') ? 'active' : '' }}"
                            href="{{ route('aktivitas') }}"
                        >
                            Aktivitas
                        </a>
                    </li>


                    <!-- MATERI -->
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('materi*') ? 'active' : '' }}"
                            href="{{ route('materi') }}"
                        >
                            Materi
                        </a>
                    </li>


                    <!-- EVALUASI -->
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('evaluasi*') ? 'active' : '' }}"
                            href="{{ route('evaluasi') }}"
                        >
                            Evaluasi
                        </a>
                    </li>


                    <!-- TENTANG -->
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}"
                            href="{{ route('tentang') }}"
                        >
                            Tentang
                        </a>
                    </li>

                </ul>


                <!-- LOGIN GURU -->
                <div class="login-area">
                    <a
                        href="{{ route('login.guru') }}"
                        class="btn-login"
                    >
                        Login Guru
                    </a>
                </div>

            </div>

        </div>

    </nav>
</header>