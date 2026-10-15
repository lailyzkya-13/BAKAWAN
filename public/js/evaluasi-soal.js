
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // BANK SOAL EVALUASI
    // ==========================================

    const bankSoal = [
        {
            pertanyaan: "Manakah yang termasuk komponen biotik di lingkungan lahan basah?",
            pilihan: [
                "Air sungai",
                "Ikan gabus",
                "Cahaya matahari",
                "Tanah"
            ],
            jawaban: 1,
            pembahasan:
                "Ikan gabus termasuk komponen biotik karena merupakan makhluk hidup yang dapat bergerak, tumbuh, dan berkembang biak. Air, cahaya matahari, dan tanah termasuk komponen abiotik."
        },
        {
            pertanyaan: "Manakah yang termasuk komponen abiotik dalam ekosistem?",
            pilihan: [
                "Katak",
                "Bangau",
                "Air",
                "Teratai"
            ],
            jawaban: 2,
            pembahasan:
                "Air merupakan komponen abiotik karena termasuk benda tak hidup. Katak, bangau, dan teratai termasuk komponen biotik karena merupakan makhluk hidup."
        },
        {
            pertanyaan: "Manakah yang termasuk contoh hubungan predasi di lahan basah?",
            pilihan: [
                "Lebah dan bunga",
                "Katak dan serangga",
                "Bangau dan pohon",
                "Pohon dan tanah"
            ],
            jawaban: 1,
            pembahasan:
                "Katak memangsa serangga, sehingga termasuk hubungan predasi antara makhluk hidup. Predasi adalah hubungan ketika satu hewan menangkap dan memakan hewan lainnya."
        },
        {
            pertanyaan: "Mengapa tumbuhan teratai membutuhkan cahaya matahari?",
            pilihan: [
                "Untuk berpindah tempat",
                "Untuk melakukan fotosintesis",
                "Untuk mencari mangsa",
                "Untuk menghindari ikan"
            ],
            jawaban: 1,
            pembahasan:
                "Teratai membutuhkan cahaya matahari untuk melakukan fotosintesis, yaitu proses tumbuhan membuat makanannya sendiri. Cahaya matahari merupakan komponen abiotik yang membantu kehidupan tumbuhan."
        },
        {
            pertanyaan: "Apa peran air bagi ikan yang hidup di sungai?",
            pilihan: [
                "Sebagai tempat hidup",
                "Sebagai pemangsa",
                "Sebagai produsen",
                "Sebagai pengurai"
            ],
            jawaban: 0,
            pembahasan:
                "Air merupakan tempat hidup atau habitat ikan. Ikan membutuhkan air untuk bernapas melalui insang, bergerak, dan menjalankan aktivitas kehidupannya."
        }
    ];

    // ==========================================
    // FUNGSI PENGACAKAN
    // ==========================================

    function acakArray(array) {

        const hasil = [...array];

        for (let i = hasil.length - 1; i > 0; i--) {

            const j = Math.floor(
                Math.random() * (i + 1)
            );

            [hasil[i], hasil[j]] = [hasil[j], hasil[i]];
        }

        return hasil;
    }

    // ==========================================
    // ACAK SOAL DAN PILIHAN JAWABAN
    // ==========================================

    function buatSoalAcak() {

        const soalAcak = bankSoal.map(function (soal) {

            const pilihanDenganKunci = soal.pilihan.map(
                function (teks, index) {

                    return {
                        teks: teks,
                        benar: index === soal.jawaban
                    };
                }
            );

            const pilihanAcak = acakArray(
                pilihanDenganKunci
            );

            const posisiJawabanBenar =
                pilihanAcak.findIndex(
                    pilihan => pilihan.benar
                );

            return {
                pertanyaan: soal.pertanyaan,

                pilihan: pilihanAcak.map(
                    pilihan => pilihan.teks
                ),

                jawaban: posisiJawabanBenar,

                pembahasan: soal.pembahasan
            };
        });

        return acakArray(soalAcak);
    }

    // ==========================================
    // DATA EVALUASI
    // ==========================================

    const daftarSoal = buatSoalAcak();

    const jawabanSiswa = Array(
        daftarSoal.length
    ).fill(null);

    let nomorAktif = 0;

    let sudahSelesai = false;

    // ==========================================
    // ELEMENT HALAMAN
    // ==========================================

    const nomorGrid = document.getElementById(
        'nomorGrid'
    );

    const jumlahTerjawab = document.getElementById(
        'jumlahTerjawab'
    );

    const soalProgress = document.getElementById(
        'soalProgress'
    );

    const pertanyaan = document.getElementById(
        'pertanyaan'
    );

    const pilihanList = document.getElementById(
        'pilihanList'
    );

    const btnSebelumnya = document.getElementById(
        'btnSebelumnya'
    );

    const btnSelanjutnya = document.getElementById(
        'btnSelanjutnya'
    );

    // ==========================================
    // ELEMENT MODAL KONFIRMASI
    // ==========================================

    const modalKonfirmasi = document.getElementById(
        'modalKonfirmasi'
    );

    const judulKonfirmasi = document.getElementById(
        'judulKonfirmasi'
    );

    const peringatanBelumLengkap = document.getElementById(
        'peringatanBelumLengkap'
    );

    const btnBatalKirim = document.getElementById(
        'btnBatalKirim'
    );

    const btnYaKirim = document.getElementById(
        'btnYaKirim'
    );

    const namaSiswa =
        window.bakawanNamaSiswa || 'Siswa';

    // Hapus hasil evaluasi sebelumnya
    sessionStorage.removeItem(
        'bakawan_hasil_evaluasi'
    );

    // ==========================================
    // NAVIGASI NOMOR SOAL
    // ==========================================

    function tampilkanNavigasi() {

        nomorGrid.replaceChildren();

        daftarSoal.forEach(function (soal, index) {

            const tombol = document.createElement(
                'button'
            );

            tombol.type = 'button';

            tombol.className = 'nomor-btn';

            tombol.textContent = index + 1;

            if (jawabanSiswa[index] !== null) {
                tombol.classList.add('terjawab');
            }

            if (index === nomorAktif) {
                tombol.classList.add('aktif');

                tombol.setAttribute(
                    'aria-current',
                    'step'
                );
            }

            tombol.disabled = sudahSelesai;

            tombol.addEventListener(
                'click',
                function () {

                    if (sudahSelesai) return;

                    nomorAktif = index;

                    tampilkanSoal();
                }
            );

            nomorGrid.appendChild(tombol);
        });

        const totalTerjawab = jawabanSiswa.filter(
            jawaban => jawaban !== null
        ).length;

        jumlahTerjawab.textContent =
            `${totalTerjawab}/${daftarSoal.length} terjawab`;
    }

    // ==========================================
    // MENAMPILKAN SOAL
    // ==========================================

    function tampilkanSoal() {

        const soal = daftarSoal[nomorAktif];

        soalProgress.textContent =
            `Soal ${nomorAktif + 1} dari ${daftarSoal.length}`;

        pertanyaan.textContent = soal.pertanyaan;

        pilihanList.replaceChildren();

        soal.pilihan.forEach(function (pilihan, index) {

            const label = document.createElement(
                'label'
            );

            label.className = 'pilihan-item';

            if (jawabanSiswa[nomorAktif] === index) {
                label.classList.add('dipilih');
            }

            const radio = document.createElement(
                'input'
            );

            radio.type = 'radio';

            radio.name = 'jawaban';

            radio.value = index;

            radio.checked =
                jawabanSiswa[nomorAktif] === index;

            radio.disabled = sudahSelesai;

            const teks = document.createElement(
                'span'
            );

            teks.textContent = pilihan;

            radio.addEventListener(
                'change',
                function () {

                    if (sudahSelesai) return;

                    jawabanSiswa[nomorAktif] = index;

                    tampilkanSoal();
                }
            );

            label.appendChild(radio);

            label.appendChild(teks);

            pilihanList.appendChild(label);
        });

        btnSebelumnya.disabled =
            nomorAktif === 0 || sudahSelesai;

        if (nomorAktif === daftarSoal.length - 1) {

            btnSelanjutnya.innerHTML =
                'Selesai Evaluasi <span>✓</span>';

        } else {

            btnSelanjutnya.innerHTML =
                'Soal Selanjutnya <span>→</span>';
        }

        btnSelanjutnya.disabled = sudahSelesai;

        tampilkanNavigasi();
    }

    // ==========================================
    // TOMBOL SEBELUMNYA
    // ==========================================

    btnSebelumnya.addEventListener(
        'click',
        function () {

            if (nomorAktif > 0 && !sudahSelesai) {

                nomorAktif--;

                tampilkanSoal();
            }
        }
    );

    // ==========================================
    // TOMBOL SELANJUTNYA
    // ==========================================

    btnSelanjutnya.addEventListener(
        'click',
        function () {

            if (sudahSelesai) return;

            if (nomorAktif < daftarSoal.length - 1) {

                nomorAktif++;

                tampilkanSoal();

            } else {

                bukaModalKonfirmasi();
            }
        }
    );

    // ==========================================
    // BUKA MODAL KONFIRMASI
    // ==========================================

    function bukaModalKonfirmasi() {

        const totalTerjawab = jawabanSiswa.filter(
            jawaban => jawaban !== null
        ).length;

        // Nama siswa muncul pada notifikasi
        judulKonfirmasi.textContent =
            `${namaSiswa}, yakin ingin mengirimkan jawaban?`;

        // Jika masih ada soal yang belum dijawab
        if (totalTerjawab < daftarSoal.length) {

            peringatanBelumLengkap.hidden = false;

            peringatanBelumLengkap.textContent =
                `Perhatian! Kamu baru menjawab ` +
                `${totalTerjawab} dari ` +
                `${daftarSoal.length} soal.`;

        } else {

            peringatanBelumLengkap.hidden = true;

            peringatanBelumLengkap.textContent = '';
        }

        modalKonfirmasi.hidden = false;

        document.body.classList.add(
            'modal-terbuka'
        );

        btnBatalKirim.focus();
    }

    // ==========================================
    // TUTUP MODAL
    // ==========================================

    function tutupModalKonfirmasi() {

        modalKonfirmasi.hidden = true;

        document.body.classList.remove(
            'modal-terbuka'
        );

        btnSelanjutnya.focus();
    }

    // Tombol batal
    btnBatalKirim.addEventListener(
        'click',
        tutupModalKonfirmasi
    );

    // Klik area luar modal
    modalKonfirmasi.addEventListener(
        'click',
        function (event) {

            if (event.target === modalKonfirmasi) {
                tutupModalKonfirmasi();
            }
        }
    );

    // Tombol Escape
    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                !modalKonfirmasi.hidden
            ) {
                tutupModalKonfirmasi();
            }
        }
    );

    // ==========================================
    // KIRIM JAWABAN
    // ==========================================

    function kirimJawaban() {

        if (sudahSelesai) return;

        const dataHasil = {

            soal: daftarSoal,

            jawabanSiswa: [...jawabanSiswa],

            waktuSelesai: new Date().toISOString()
        };

        try {

            sessionStorage.setItem(
                'bakawan_hasil_evaluasi',
                JSON.stringify(dataHasil)
            );

        } catch (error) {

            window.alert(
                'Hasil evaluasi tidak dapat disimpan. ' +
                'Silakan periksa pengaturan browser.'
            );

            return;
        }

        sudahSelesai = true;

        // Pindah ke halaman hasil evaluasi
        window.location.href =
            window.bakawanEvaluasiUrls.hasil;
    }

    // Tombol Ya, Kirim Jawaban
    btnYaKirim.addEventListener(
        'click',
        kirimJawaban
    );

    // ==========================================
    // MULAI EVALUASI
    // ==========================================

    tampilkanSoal();

});