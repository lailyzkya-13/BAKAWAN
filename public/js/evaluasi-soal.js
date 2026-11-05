
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // 1. MENGAMBIL SOAL DARI DATABASE
    // ==========================================

    const bankSoal = Array.isArray(window.bakawanDaftarSoal)
        ? window.bakawanDaftarSoal
        : [];

    // ==========================================
    // 2. FUNGSI MENGACAK
    // ==========================================

    function acakArray(array) {
        const hasil = [...array];

        for (let i = hasil.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [hasil[i], hasil[j]] = [hasil[j], hasil[i]];
        }

        return hasil;
    }

    // ==========================================
    // 3. MENYIAPKAN SOAL DAN PILIHAN
    // ==========================================

    function buatSoalAcak() {

        const indeksKunci = {
            A: 0,
            B: 1,
            C: 2,
            D: 3
        };

        const hasil = bankSoal.map(function (soal) {

            const pilihanAsli = [
                soal.pilihan_a,
                soal.pilihan_b,
                soal.pilihan_c,
                soal.pilihan_d
            ];

            const indeksBenar =
                indeksKunci[String(soal.jawaban_benar).toUpperCase()];

            if (
                !soal.pertanyaan ||
                !Number.isInteger(indeksBenar) ||
                pilihanAsli.some(p => typeof p !== 'string' || !p.trim())
            ) {
                return null;
            }

            const pilihanDenganKunci = pilihanAsli.map(
                function (teks, index) {
                    return {
                        teks: teks,
                        benar: index === indeksBenar
                    };
                }
            );

            const pilihanAcak = acakArray(pilihanDenganKunci);

            return {
                id: soal.id,
                pertanyaan: soal.pertanyaan,
                pilihan: pilihanAcak.map(p => p.teks),
                jawaban: pilihanAcak.findIndex(p => p.benar),
                pembahasan: soal.pembahasan || ''
            };

        }).filter(Boolean);

        return acakArray(hasil);
    }

    const daftarSoal = buatSoalAcak();

    if (daftarSoal.length === 0) {
        alert('Belum ada soal evaluasi yang tersedia.');
        window.location.href = '/evaluasi';
        return;
    }

    // ==========================================
    // 4. STATUS JAWABAN
    // ==========================================

    const jawabanSiswa = Array(daftarSoal.length).fill(null);

    let nomorAktif = 0;
    let sudahSelesai = false;
    let sedangMengirim = false;

    // ==========================================
    // 5. MENGAMBIL ELEMEN HALAMAN
    // ==========================================

    const nomorGrid = document.getElementById('nomorGrid');
    const jumlahTerjawab = document.getElementById('jumlahTerjawab');
    const soalProgress = document.getElementById('soalProgress');
    const pertanyaan = document.getElementById('pertanyaan');
    const pilihanList = document.getElementById('pilihanList');

    const btnSebelumnya = document.getElementById('btnSebelumnya');
    const btnSelanjutnya = document.getElementById('btnSelanjutnya');

    // Modal
    const modalKonfirmasi = document.getElementById('modalKonfirmasi');
    const judulKonfirmasi = document.getElementById('judulKonfirmasi');
    const peringatanBelumLengkap = document.getElementById('peringatanBelumLengkap');

    const btnBatalKirim = document.getElementById('btnBatalKirim');
    const btnYaKirim = document.getElementById('btnYaKirim');

    const namaSiswa = window.bakawanNamaSiswa || 'Siswa';

    // Memastikan elemen HTML tersedia
    if (
        !nomorGrid ||
        !jumlahTerjawab ||
        !soalProgress ||
        !pertanyaan ||
        !pilihanList ||
        !btnSebelumnya ||
        !btnSelanjutnya
    ) {
        console.error('Elemen halaman evaluasi tidak ditemukan.');
        return;
    }

    // ==========================================
    // 6. MENAMPILKAN NOMOR SOAL
    // ==========================================

    function tampilkanNavigasi() {

        nomorGrid.replaceChildren();

        daftarSoal.forEach(function (soal, index) {

            const tombol = document.createElement('button');

            tombol.type = 'button';
            tombol.className = 'nomor-btn';
            tombol.textContent = index + 1;

            if (jawabanSiswa[index] !== null) {
                tombol.classList.add('terjawab');
            }

            if (index === nomorAktif) {
                tombol.classList.add('aktif');
            }

            tombol.addEventListener('click', function () {

                if (sudahSelesai || sedangMengirim) return;

                nomorAktif = index;
                tampilkanSoal();

            });

            nomorGrid.appendChild(tombol);

        });

        const terjawab = jawabanSiswa.filter(
            jawaban => jawaban !== null
        ).length;

        jumlahTerjawab.textContent =
            `${terjawab}/${daftarSoal.length} terjawab`;
    }

    // ==========================================
    // 7. MENAMPILKAN PERTANYAAN DAN PILIHAN
    // ==========================================

    function tampilkanSoal() {

        const soal = daftarSoal[nomorAktif];

        soalProgress.textContent =
            `Soal ${nomorAktif + 1} dari ${daftarSoal.length}`;

        pertanyaan.textContent = soal.pertanyaan;

        pilihanList.replaceChildren();

        soal.pilihan.forEach(function (pilihan, index) {

            const label = document.createElement('label');

            label.className = 'pilihan-item';

            if (jawabanSiswa[nomorAktif] === index) {
                label.classList.add('dipilih');
            }

            const radio = document.createElement('input');

            radio.type = 'radio';
            radio.name = 'jawaban';
            radio.value = index;

            radio.checked = jawabanSiswa[nomorAktif] === index;

            const teks = document.createElement('span');
            teks.textContent = pilihan;

            radio.addEventListener('change', function () {

                if (sudahSelesai || sedangMengirim) return;

                jawabanSiswa[nomorAktif] = index;

                tampilkanSoal();

            });

            label.appendChild(radio);
            label.appendChild(teks);

            pilihanList.appendChild(label);

        });

        btnSebelumnya.disabled =
            nomorAktif === 0 || sedangMengirim;

        if (nomorAktif === daftarSoal.length - 1) {

            btnSelanjutnya.innerHTML =
                'Selesai Evaluasi <span>✓</span>';

        } else {

            btnSelanjutnya.innerHTML =
                'Soal Selanjutnya <span>→</span>';

        }

        btnSelanjutnya.disabled = sedangMengirim;

        tampilkanNavigasi();
    }

    // ==========================================
    // 8. TOMBOL SEBELUMNYA
    // ==========================================

    btnSebelumnya.addEventListener('click', function () {

        if (nomorAktif > 0 && !sedangMengirim) {

            nomorAktif--;

            tampilkanSoal();

        }

    });

    // ==========================================
    // 9. TOMBOL SELANJUTNYA
    // ==========================================

    btnSelanjutnya.addEventListener('click', function () {

        if (sudahSelesai || sedangMengirim) return;

        if (nomorAktif < daftarSoal.length - 1) {

            nomorAktif++;

            tampilkanSoal();

        } else {

            bukaModalKonfirmasi();

        }

    });

    // ==========================================
    // 10. MODAL KONFIRMASI
    // ==========================================

    function bukaModalKonfirmasi() {

        const terjawab = jawabanSiswa.filter(
            jawaban => jawaban !== null
        ).length;

        judulKonfirmasi.textContent =
            `${namaSiswa}, yakin ingin mengirimkan jawaban?`;

        if (terjawab < daftarSoal.length) {

            peringatanBelumLengkap.hidden = false;

            peringatanBelumLengkap.textContent =
                `Kamu baru menjawab ${terjawab} dari ${daftarSoal.length} soal.`;

        } else {

            peringatanBelumLengkap.hidden = true;

        }

        modalKonfirmasi.hidden = false;

        document.body.classList.add('modal-terbuka');
    }

    function tutupModalKonfirmasi() {

        if (sedangMengirim) return;

        modalKonfirmasi.hidden = true;

        document.body.classList.remove('modal-terbuka');

    }

    btnBatalKirim.addEventListener(
        'click',
        tutupModalKonfirmasi
    );

    modalKonfirmasi.addEventListener('click', function (event) {

        if (event.target === modalKonfirmasi) {
            tutupModalKonfirmasi();
        }

    });

    // ==========================================
    // 11. MENGIRIM JAWABAN
    // ==========================================

    async function kirimJawaban() {

        if (sudahSelesai || sedangMengirim) return;

        const jawaban = daftarSoal.map(function (soal, index) {

            const pilihanIndex = jawabanSiswa[index];

            return {
                id: soal.id,
                pilihan: pilihanIndex === null
                    ? null
                    : soal.pilihan[pilihanIndex]
            };

        });

        const token = document.querySelector(
            'meta[name="csrf-token"]'
        )?.content;

        sedangMengirim = true;

        btnYaKirim.disabled = true;
        btnYaKirim.textContent = 'Menyimpan...';

        try {

            const response = await fetch(
                window.bakawanEvaluasiUrls.simpan,
                {
                    method: 'POST',

                    credentials: 'same-origin',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },

                    body: JSON.stringify({
                        jawaban: jawaban
                    })
                }
            );

            const hasil = await response.json();

            if (!response.ok) {
                throw new Error(
                    hasil.message || 'Gagal menyimpan jawaban.'
                );
            }

            sudahSelesai = true;

            sessionStorage.setItem(
                'bakawan_hasil_evaluasi',
                JSON.stringify({
                    soal: daftarSoal,
                    jawabanSiswa: jawabanSiswa,
                    nilai: hasil.nilai,
                    jumlahBenar: hasil.jumlahBenar,
                    jumlahSoal: hasil.jumlahSoal
                })
            );

            window.location.href =
                window.bakawanEvaluasiUrls.hasil;

        } catch (error) {

            alert(error.message);

            sedangMengirim = false;

            btnYaKirim.disabled = false;

            btnYaKirim.textContent = 'Ya, Kirim Jawaban';

        }

    }

    btnYaKirim.addEventListener(
        'click',
        kirimJawaban
    );

    // ==========================================
    // 12. MEMULAI EVALUASI
    // ==========================================

    tampilkanSoal();

});
