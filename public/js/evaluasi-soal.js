
document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // BANK SOAL: ID TETAP UNTUK LARAVEL
    // ==========================================
    const bankSoal = [
        {
            id: 1,
            pertanyaan: 'Manakah yang termasuk komponen biotik di lingkungan lahan basah?',
            pilihan: ['Air sungai', 'Ikan gabus', 'Cahaya matahari', 'Tanah'],
            jawaban: 1,
            pembahasan: 'Ikan gabus termasuk komponen biotik karena merupakan makhluk hidup yang dapat bergerak, tumbuh, dan berkembang biak. Air, cahaya matahari, dan tanah termasuk komponen abiotik.'
        },
        {
            id: 2,
            pertanyaan: 'Manakah yang termasuk komponen abiotik dalam ekosistem?',
            pilihan: ['Katak', 'Bangau', 'Air', 'Teratai'],
            jawaban: 2,
            pembahasan: 'Air merupakan komponen abiotik karena termasuk benda tak hidup. Katak, bangau, dan teratai termasuk komponen biotik karena merupakan makhluk hidup.'
        },
        {
            id: 3,
            pertanyaan: 'Manakah yang termasuk contoh hubungan predasi di lahan basah?',
            pilihan: ['Lebah dan bunga', 'Katak dan serangga', 'Bangau dan pohon', 'Pohon dan tanah'],
            jawaban: 1,
            pembahasan: 'Katak memangsa serangga, sehingga termasuk hubungan predasi antara makhluk hidup. Predasi adalah hubungan ketika satu hewan menangkap dan memakan hewan lainnya.'
        },
        {
            id: 4,
            pertanyaan: 'Mengapa tumbuhan teratai membutuhkan cahaya matahari?',
            pilihan: ['Untuk berpindah tempat', 'Untuk melakukan fotosintesis', 'Untuk mencari mangsa', 'Untuk menghindari ikan'],
            jawaban: 1,
            pembahasan: 'Teratai membutuhkan cahaya matahari untuk melakukan fotosintesis, yaitu proses tumbuhan membuat makanannya sendiri. Cahaya matahari merupakan komponen abiotik yang membantu kehidupan tumbuhan.'
        },
        {
            id: 5,
            pertanyaan: 'Apa peran air bagi ikan yang hidup di sungai?',
            pilihan: ['Sebagai tempat hidup', 'Sebagai pemangsa', 'Sebagai produsen', 'Sebagai pengurai'],
            jawaban: 0,
            pembahasan: 'Air merupakan tempat hidup atau habitat ikan. Ikan membutuhkan air untuk bernapas melalui insang, bergerak, dan menjalankan aktivitas kehidupannya.'
        }
    ];

    // ==========================================
    // PENGACAKAN SOAL DAN PILIHAN
    // ==========================================
    function acakArray(array) {
        const hasil = [...array];

        for (let i = hasil.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [hasil[i], hasil[j]] = [hasil[j], hasil[i]];
        }

        return hasil;
    }

    function buatSoalAcak() {
        const soalAcak = bankSoal.map(function (soal) {
            const pilihanDenganKunci = soal.pilihan.map(function (teks, index) {
                return {
                    teks: teks,
                    benar: index === soal.jawaban
                };
            });

            const pilihanAcak = acakArray(pilihanDenganKunci);

            return {
                id: soal.id,
                pertanyaan: soal.pertanyaan,
                pilihan: pilihanAcak.map(pilihan => pilihan.teks),
                jawaban: pilihanAcak.findIndex(pilihan => pilihan.benar),
                pembahasan: soal.pembahasan
            };
        });

        return acakArray(soalAcak);
    }

    // ==========================================
    // DATA EVALUASI
    // ==========================================
    const daftarSoal = buatSoalAcak();
    const jawabanSiswa = Array(daftarSoal.length).fill(null);

    let nomorAktif = 0;
    let sudahSelesai = false;
    let sedangMengirim = false;

    // ==========================================
    // ELEMEN HALAMAN
    // ==========================================
    const nomorGrid = document.getElementById('nomorGrid');
    const jumlahTerjawab = document.getElementById('jumlahTerjawab');
    const soalProgress = document.getElementById('soalProgress');
    const pertanyaan = document.getElementById('pertanyaan');
    const pilihanList = document.getElementById('pilihanList');
    const btnSebelumnya = document.getElementById('btnSebelumnya');
    const btnSelanjutnya = document.getElementById('btnSelanjutnya');

    // ==========================================
    // ELEMEN MODAL
    // ==========================================
    const modalKonfirmasi = document.getElementById('modalKonfirmasi');
    const judulKonfirmasi = document.getElementById('judulKonfirmasi');
    const peringatanBelumLengkap = document.getElementById('peringatanBelumLengkap');
    const btnBatalKirim = document.getElementById('btnBatalKirim');
    const btnYaKirim = document.getElementById('btnYaKirim');

    const namaSiswa = window.bakawanNamaSiswa || 'Siswa';

    // Menghapus hasil evaluasi lama
    sessionStorage.removeItem('bakawan_hasil_evaluasi');

    // ==========================================
    // NAVIGASI NOMOR SOAL
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
                tombol.setAttribute('aria-current', 'step');
            }

            tombol.disabled = sudahSelesai || sedangMengirim;

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
    // MENAMPILKAN SOAL
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
            radio.disabled = sudahSelesai || sedangMengirim;

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
            nomorAktif === 0 || sudahSelesai || sedangMengirim;

        if (nomorAktif === daftarSoal.length - 1) {
            btnSelanjutnya.innerHTML =
                'Selesai Evaluasi <span>✓</span>';
        } else {
            btnSelanjutnya.innerHTML =
                'Soal Selanjutnya <span>→</span>';
        }

        btnSelanjutnya.disabled =
            sudahSelesai || sedangMengirim;

        tampilkanNavigasi();
    }

    // ==========================================
    // TOMBOL SEBELUMNYA
    // ==========================================
    btnSebelumnya.addEventListener('click', function () {
        if (nomorAktif > 0 && !sudahSelesai && !sedangMengirim) {
            nomorAktif--;
            tampilkanSoal();
        }
    });

    // ==========================================
    // TOMBOL SELANJUTNYA
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
    // MODAL KONFIRMASI
    // ==========================================
    function bukaModalKonfirmasi() {
        if (sedangMengirim) return;

        const terjawab = jawabanSiswa.filter(
            jawaban => jawaban !== null
        ).length;

        judulKonfirmasi.textContent =
            `${namaSiswa}, yakin ingin mengirimkan jawaban?`;

        if (terjawab < daftarSoal.length) {
            peringatanBelumLengkap.hidden = false;
            peringatanBelumLengkap.textContent =
                `Perhatian! Kamu baru menjawab ${terjawab} dari ${daftarSoal.length} soal.`;
        } else {
            peringatanBelumLengkap.hidden = true;
            peringatanBelumLengkap.textContent = '';
        }

        modalKonfirmasi.hidden = false;
        document.body.classList.add('modal-terbuka');
        btnBatalKirim.focus();
    }

    function tutupModalKonfirmasi() {
        if (sedangMengirim) return;

        modalKonfirmasi.hidden = true;
        document.body.classList.remove('modal-terbuka');
        btnSelanjutnya.focus();
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

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            !modalKonfirmasi.hidden
        ) {
            tutupModalKonfirmasi();
        }
    });

    // ==========================================
    // KIRIM JAWABAN KE LARAVEL
    // ==========================================
    async function kirimJawaban() {
        if (sudahSelesai || sedangMengirim) return;

        const urlSimpan = window.bakawanEvaluasiUrls?.simpan;

        const tokenCSRF = document.querySelector(
            'meta[name="csrf-token"]'
        )?.content;

        if (!urlSimpan || !tokenCSRF) {
            alert(
                'Alamat penyimpanan atau CSRF token belum tersedia. ' +
                'Periksa evaluasi-soal.blade.php.'
            );
            return;
        }

        // Mengirim ID soal dan teks pilihan yang dipilih siswa
        const jawaban = daftarSoal.map(function (soal, index) {
            const nomorPilihan = jawabanSiswa[index];

            return {
                id: soal.id,
                pilihan: nomorPilihan === null
                    ? null
                    : soal.pilihan[nomorPilihan]
            };
        });

        sedangMengirim = true;

        btnYaKirim.disabled = true;
        btnYaKirim.textContent = 'Menyimpan...';

        try {
            // Mengirim jawaban ke routes/web.php
            const response = await fetch(urlSimpan, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': tokenCSRF
                },
                body: JSON.stringify({ jawaban })
            });

            // Memeriksa status respons Laravel
            if (!response.ok) {
                if (response.status === 419) {
                    throw new Error(
                        'Sesi kedaluwarsa. Muat ulang halaman dan kerjakan kembali.'
                    );
                }

                if (response.status === 401) {
                    throw new Error(
                        'Identitas siswa tidak ditemukan. Isi nama dan kelas kembali.'
                    );
                }

                if (response.status === 422) {
                    throw new Error(
                        'Data jawaban tidak valid. Silakan periksa jawaban.'
                    );
                }

                throw new Error(
                    `Server gagal menyimpan nilai (HTTP ${response.status}).`
                );
            }

            // Laravel sudah menerima dan menyimpan hasil
            sudahSelesai = true;

            // Mengambil hasil perhitungan dari database
            const hasilDatabase = await response.json();

            // Menyimpan data untuk tampilan hasil dan pembahasan
            try {
                sessionStorage.setItem(
                    'bakawan_hasil_evaluasi',
                    JSON.stringify({
                        soal: daftarSoal,
                        jawabanSiswa: [...jawabanSiswa],
                        nilai: hasilDatabase.nilai,
                        jumlahBenar: hasilDatabase.jumlahBenar,
                        jumlahSoal: hasilDatabase.jumlahSoal,
                        waktuSelesai: new Date().toISOString()
                    })
                );
            } catch (error) {
                console.error(
                    'Database berhasil, tetapi sessionStorage gagal:',
                    error
                );

                alert(
                    'Nilai telah tersimpan di database, ' +
                    'tetapi browser gagal menampilkan hasil.'
                );
                return;
            }

            // Pindah ke halaman hasil evaluasi
            window.location.href =
                window.bakawanEvaluasiUrls.hasil;

        } catch (error) {
            console.error('Gagal mengirim jawaban:', error);

            if (sudahSelesai) {
                alert(
                    'Jawaban sudah diterima server, tetapi terjadi ' +
                    'masalah saat membuka hasil. Periksa tabel hasil_kuis.'
                );
            } else {
                alert(
                    error.message ||
                    'Gagal menyimpan nilai. Silakan coba lagi.'
                );
            }

        } finally {
            if (!sudahSelesai) {
                sedangMengirim = false;
                btnYaKirim.disabled = false;
                btnYaKirim.textContent = 'Ya, Kirim Jawaban';
            }
        }
    }

    // Tombol kirim jawaban
    btnYaKirim.addEventListener(
        'click',
        kirimJawaban
    );

    // ==========================================
    // MULAI EVALUASI
    // ==========================================
    tampilkanSoal();
});
