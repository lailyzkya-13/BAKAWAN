
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Evaluasi Akhir | BAKAWAN</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/evaluasi.css') }}">
</head>

<body>

    {{-- HEADER TETAP MENGGUNAKAN YANG SEKARANG --}}
    @include('components.header')

    <main class="evaluasi-page">

        <div class="evaluasi-container">

            <!-- JUDUL -->
            <section class="evaluasi-heading">

                <h1>Evaluasi Akhir</h1>

                <p>
                    Kerjakan soal berikut untuk melihat
                    <br>
                    seberapa jauh kamu memahami materi!
                </p>

            </section>

            <!-- FORM IDENTITAS SISWA -->
            <form
                action="{{ route('evaluasi.mulai') }}"
                method="POST"
                id="formEvaluasi"
            >
                @csrf

                <div class="evaluasi-form-box">

                    <div class="form-grid">

                        <!-- NAMA LENGKAP -->
                        <div class="form-group">

                            <label for="nama_lengkap">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                placeholder="Masukkan nama lengkap"
                                value="{{ old('nama_lengkap') }}"
                                maxlength="100"
                                autocomplete="name"
                                required
                            >

                            @error('nama_lengkap')
                                <small class="error-text">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <!-- KELAS -->
                        <div class="form-group">

                            <label for="kelas">
                                Kelas
                            </label>

                            <input
                                type="text"
                                id="kelas"
                                name="kelas"
                                placeholder="Contoh: V A"
                                value="{{ old('kelas') }}"
                                maxlength="30"
                                required
                            >

                            @error('kelas')
                                <small class="error-text">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>

                <!-- TOMBOL MENUJU PETUNJUK -->
                <div class="evaluasi-action">

                    <button
                        type="submit"
                        class="btn-mulai-kuis"
                    >
                        <span>Mulai Kuis</span>
                        <span class="arrow-icon">→</span>
                    </button>

                </div>

            </form>

        </div>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>