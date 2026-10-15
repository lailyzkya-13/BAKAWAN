
document.addEventListener('DOMContentLoaded', function () {

    const dataTersimpan = sessionStorage.getItem(
        'bakawan_hasil_evaluasi'
    );

    if (!dataTersimpan) {
        window.location.replace(window.bakawanEvaluasiUrls.soal);
        return;
    }

    let hasil;

    try {
        hasil = JSON.parse(dataTersimpan);

        if (
            !Array.isArray(hasil.soal) ||
            !Array.isArray(hasil.jawabanSiswa) ||
            hasil.soal.length === 0 ||
            hasil.soal.length !== hasil.jawabanSiswa.length
        ) {
            throw new Error('Data pembahasan tidak lengkap');
        }
    } catch (error) {
        sessionStorage.removeItem('bakawan_hasil_evaluasi');
        window.location.replace(window.bakawanEvaluasiUrls.soal);
        return;
    }

    const daftarSoal = hasil.soal;
    const jawabanSiswa = hasil.jawabanSiswa;

    let nomorAktif = 0;

    const nomorPembahasan = document.getElementById(
        'nomorPembahasan'
    );

    const nomorAktifElement = document.getElementById(
        'nomorAktif'
    );

    const pertanyaanElement = document.getElementById(
        'pertanyaanPembahasan'
    );

    const jawabanSiswaElement = document.getElementById(
        'jawabanSiswa'
    );

    const statusJawaban = document.getElementById(
        'statusJawaban'
    );

    const jawabanBenarElement = document.getElementById(
        'jawabanBenar'
    );

    const penjelasanElement = document.getElementById(
        'penjelasanSoal'
    );

    const btnSebelumnya = document.getElementById(
        'btnPembahasanSebelumnya'
    );

    const btnBerikutnya = document.getElementById(
        'btnPembahasanBerikutnya'
    );

    function tampilkanNavigasi() {

        nomorPembahasan.replaceChildren();

        daftarSoal.forEach(function (soal, index) {

            const tombol = document.createElement('button');

            tombol.type = 'button';
            tombol.className = 'nomor-pembahasan-btn';
            tombol.textContent = index + 1;

            const benar = jawabanSiswa[index] === soal.jawaban;

            tombol.classList.add(
                benar ? 'benar' : 'salah'
            );

            if (index === nomorAktif) {
                tombol.classList.add('aktif');
                tombol.setAttribute('aria-current', 'step');
            }

            tombol.addEventListener('click', function () {
                nomorAktif = index;
                tampilkanPembahasan();
            });

            nomorPembahasan.appendChild(tombol);
        });
    }

    function tampilkanPembahasan() {

        const soal = daftarSoal[nomorAktif];
        const pilihanSiswa = jawabanSiswa[nomorAktif];

        const benar = pilihanSiswa === soal.jawaban;

        nomorAktifElement.textContent =
            `Soal ${nomorAktif + 1} dari ${daftarSoal.length}`;

        pertanyaanElement.textContent = soal.pertanyaan;

        if (
            pilihanSiswa === null ||
            pilihanSiswa === undefined
        ) {
            jawabanSiswaElement.textContent = 'Belum dijawab';
        } else {
            jawabanSiswaElement.textContent =
                soal.pilihan[pilihanSiswa] ?? 'Belum dijawab';
        }

        statusJawaban.textContent = benar
            ? '✓ Jawaban kamu benar'
            : '✕ Jawaban kamu belum tepat';

        statusJawaban.className =
            'status-jawaban ' + (benar ? 'benar' : 'salah');

        jawabanBenarElement.textContent =
            soal.pilihan[soal.jawaban];

        penjelasanElement.textContent =
            soal.pembahasan || 'Pembahasan belum tersedia.';

        btnSebelumnya.disabled = nomorAktif === 0;

        btnBerikutnya.textContent =
            nomorAktif === daftarSoal.length - 1
                ? 'Kembali ke Hasil Evaluasi →'
                : 'Pembahasan Berikutnya →';

        tampilkanNavigasi();
    }

    btnSebelumnya.addEventListener('click', function () {

        if (nomorAktif > 0) {
            nomorAktif--;
            tampilkanPembahasan();
        }
    });

    btnBerikutnya.addEventListener('click', function () {

        if (nomorAktif < daftarSoal.length - 1) {
            nomorAktif++;
            tampilkanPembahasan();
        } else {
            window.location.href =
                window.bakawanEvaluasiUrls.hasil;
        }
    });

    tampilkanPembahasan();
});