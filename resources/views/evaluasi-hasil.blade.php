
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Evaluasi | BAKAWAN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/evaluasi-hasil.css') }}">
</head>
<body>

    @include('components.header')

    <main class="hasil-page">
        <div class="hasil-container">

            <h1>Kuis Selesai!</h1>

            <p class="hasil-subtitle">
                Kamu telah menyelesaikan evaluasi akhir.<br>
                Terima kasih sudah berusaha!
            </p>

            <div class="hasil-nilai-card">

                <div class="hasil-nilai-item">
                    <h2>Nilai Kamu</h2>
                    <div class="hasil-angka">
                        <span id="nilaiSiswa">0</span>
                        <span class="hasil-total">/ 100</span>
                    </div>
                </div>

                <div class="hasil-nilai-item">
                    <h2>Jawaban Benar</h2>
                    <div class="hasil-angka">
                        <span id="jumlahBenar">0</span>
                        <span class="hasil-total" id="totalSoal">/ 5</span>
                    </div>
                </div>

            </div>

            <p class="hasil-pesan" id="pesanHasil"></p>

            <div class="hasil-actions">

                <a href="{{ route('evaluasi.pembahasan') }}"
                   class="btn-pembahasan">
                    Lihat Pembahasan
                    <span>→</span>
                </a>

                <a href="{{ route('beranda') }}"
                   class="btn-beranda">
                    Kembali ke Beranda
                </a>

            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const data = sessionStorage.getItem('bakawan_hasil_evaluasi');

            if (!data) {
                window.location.replace(@json(route('evaluasi.soal')));
                return;
            }

            let hasil;

            try {
                hasil = JSON.parse(data);

                if (
                    !Array.isArray(hasil.soal) ||
                    !Array.isArray(hasil.jawabanSiswa) ||
                    hasil.soal.length === 0 ||
                    hasil.soal.length !== hasil.jawabanSiswa.length
                ) {
                    throw new Error('Data hasil tidak lengkap');
                }
            } catch (error) {
                sessionStorage.removeItem('bakawan_hasil_evaluasi');
                window.location.replace(@json(route('evaluasi.soal')));
                return;
            }

            const jumlahSoal = hasil.soal.length;

            const benar = hasil.soal.reduce(function (total, soal, index) {
                return total + (
                    hasil.jawabanSiswa[index] === soal.jawaban ? 1 : 0
                );
            }, 0);

            const nilai = Math.round((benar / jumlahSoal) * 100);

            document.getElementById('nilaiSiswa').textContent = nilai;
            document.getElementById('jumlahBenar').textContent = benar;
            document.getElementById('totalSoal').textContent = '/ ' + jumlahSoal;

            let pesan = '';

            if (nilai >= 80) {
                pesan = 'Hebat! Kamu sudah memahami materi dengan baik!';
            } else if (nilai >= 60) {
                pesan = 'Bagus! Terus belajar agar hasilmu semakin baik!';
            } else {
                pesan = 'Tetap semangat! Yuk, pelajari kembali materinya!';
            }

            document.getElementById('pesanHasil').textContent = pesan;
        });
    </script>

</body>
</html>