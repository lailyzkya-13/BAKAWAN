<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru BAKAWAN</title>

    <!-- FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }



        body {
            min-height: 100vh;
            margin: 0;
            position: relative;
            background: #263b40;
        }

        /* Background foto */

        body {
            min-height: 100vh;

            background-image:
                linear-gradient(rgba(20, 35, 40, 0.15),
                    rgba(20, 35, 40, 0.15)),
                url('{{ asset('images/login-lahan-basah-landscape.jpg') }}');

            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }


        .overlay {
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.15);
            padding: 24px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        /* Logo BAKAWAN kiri atas */
        .logo-kecil {
            height: 90px;
            width: auto;
            object-fit: contain;
        }

        .guru-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            color: #355c3a;
            background: rgba(255, 255, 255, 0.8);
            padding: 8px 14px;
            border-radius: 20px;
        }

        .guru-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #4f7d53;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .login-wrapper {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        /* Logo BAKAWAN tengah */
        .logo-besar {
            width: 450px;
            max-width: 90%;
            height: auto;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.92);
            border-radius: 16px;
            padding: 30px 28px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: left;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 8px;
            color: #1f3b2d;
        }

        .login-card p {
            text-align: center;
            margin-bottom: 24px;
            font-size: 14px;
            color: #555;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            background: #f7f3eb;
        }

        .form-group input:focus {
            border-color: #c05378;
        }


        /* TOMBOL LIHAT PASSWORD */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);

            background: none;
            border: none;
            color: #63836D;

            font-size: 19px;
            cursor: pointer;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #c04d72;
        }


        .btn-login {
            width: 100%;
            padding: 12px;
            background: #c04d72;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: #a93f63;
        }

        .error-box {
            background: #ffe5e5;
            color: #b30000;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }


        @media (max-width: 600px) {
            .logo-besar {
                width: 190px;
            }

            .login-card {
                padding: 22px 18px;
            }

            .top-bar {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="overlay">

        <div class="top-bar">
            <img src="{{ asset('images/logo-bakawan.png') }}" alt="Logo BAKAWAN" class="logo-kecil">

            <div class="guru-badge">
                <div class="guru-icon">👤</div>
                <span>Guru</span>
            </div>
        </div>

        <div class="login-wrapper">
            <img src="{{ asset('images/logo-bakawan.png') }}" alt="Logo BAKAWAN" class="logo-kecil">

            <div class="login-card">
                <h2>Login Guru</h2>
                <p>Masuk untuk mengelola pembelajaran BAKAWAN.</p>

                @if ($errors->any())
                    <div class="error-box">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.guru.proses') }}">

                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>

                        <input type="email" id="email" name="email" placeholder="Masukkan email"
                            value="{{ old('email') }}" required>
                    </div>


                    <div class="form-group">
                        <label for="password">Password</label>

                        <div class="password-wrapper">

                            <input type="password" id="password" name="password" placeholder="Masukkan password"
                                required>

                            <button type="button" class="toggle-password" id="togglePassword"
                                aria-label="Tampilkan password">

                                <i class="bi bi-eye" id="togglePasswordIcon"></i>

                            </button>

                        </div>
                    </div>


                    <button type="submit" class="btn-login">
                        Masuk
                    </button>
                </form>
            </div>
        </div>


    </div>

    <!-- JAVASCRIPT LIHAT PASSWORD -->
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function () {

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                togglePasswordIcon.classList.remove('bi-eye');
                togglePasswordIcon.classList.add('bi-eye-slash');

                togglePassword.setAttribute('aria-label', 'Sembunyikan password');

            } else {

                passwordInput.type = 'password';

                togglePasswordIcon.classList.remove('bi-eye-slash');
                togglePasswordIcon.classList.add('bi-eye');

                togglePassword.setAttribute('aria-label', 'Tampilkan password');

            }

        });
    </script>

</body>

</html>