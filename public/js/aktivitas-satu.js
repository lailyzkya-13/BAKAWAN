
document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // ELEMEN HALAMAN
    // ==========================================

    const objekList = document.getElementById("objekList");
    const dropBiotik = document.getElementById("dropBiotik");
    const dropAbiotik = document.getElementById("dropAbiotik");

    const progressText = document.getElementById("progressText");
    const progressFill = document.getElementById("progressFill");

    const feedbackArea = document.getElementById("feedbackArea");
    const feedbackIcon = document.getElementById("feedbackIcon");
    const feedbackTitle = document.getElementById("feedbackTitle");
    const feedbackText = document.getElementById("feedbackText");

    const btnReset = document.getElementById("btnReset");
    const btnCek = document.getElementById("btnCek");
    const btnMainLagi = document.getElementById("btnMainLagi");

    const hasilSection = document.getElementById("hasilSection");
    const penjelasanList = document.getElementById("penjelasanList");

    if (!objekList || !dropBiotik || !dropAbiotik) {
        return;
    }

    // ==========================================
    // DATA OBJEK DARI DATABASE
    // ==========================================

    // Semua objek dibaca langsung dari HTML Blade.
    // Jadi jika guru menambah atau menghapus objek,
    // JavaScript mengikuti data yang ditampilkan.

    const semuaObjek = Array.from(
        objekList.querySelectorAll(".objek-card")
    );

    const totalObjek = semuaObjek.length;

    let objekDipilih = null;
    let objekDiseret = null;
    let permainanSelesai = false;

    // ==========================================
    // FUNGSI ACAK KARTU
    // ==========================================

    function acakArray(array) {
        const hasil = [...array];

        for (let i = hasil.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));

            [hasil[i], hasil[j]] = [hasil[j], hasil[i]];
        }

        return hasil;
    }

    function urutanSekarang() {
        return Array.from(
            objekList.querySelectorAll(".objek-card")
        ).map((objek) => objek.dataset.id);
    }

    function acakPosisiObjek() {
        const urutanLama = urutanSekarang();

        let hasilAcak = acakArray(semuaObjek);

        // Jika ada lebih dari satu objek, usahakan
        // urutan baru tidak sama persis dengan sebelumnya.

        if (semuaObjek.length > 1) {
            let percobaan = 0;

            while (
                hasilAcak.every(
                    (objek, index) =>
                        objek.dataset.id === urutanLama[index]
                ) &&
                percobaan < 10
            ) {
                hasilAcak = acakArray(semuaObjek);
                percobaan++;
            }

            // Jaminan perubahan jika hasil acak
            // masih sama dengan urutan sebelumnya.
            if (
                hasilAcak.every(
                    (objek, index) =>
                        objek.dataset.id === urutanLama[index]
                )
            ) {
                hasilAcak.push(hasilAcak.shift());
            }
        }

        hasilAcak.forEach((objek) => {
            objekList.appendChild(objek);
        });
    }

    // ==========================================
    // UPDATE PROGRESS
    // ==========================================

    function jumlahTerjawab() {
        return (
            dropBiotik.querySelectorAll(".objek-card").length +
            dropAbiotik.querySelectorAll(".objek-card").length
        );
    }

    function updateProgress() {
        const jumlah = jumlahTerjawab();

        if (progressText) {
            progressText.textContent =
                `${jumlah} / ${totalObjek}`;
        }

        if (progressFill) {
            const persen = totalObjek > 0
                ? (jumlah / totalObjek) * 100
                : 0;

            progressFill.style.width = `${persen}%`;
        }

        if (btnCek) {
            btnCek.disabled =
                jumlah !== totalObjek ||
                totalObjek === 0 ||
                permainanSelesai;
        }

        updatePlaceholder();
    }

    // ==========================================
    // PLACEHOLDER KOTAK JAWABAN
    // ==========================================

    function updatePlaceholder() {
        [dropBiotik, dropAbiotik].forEach((area) => {
            const placeholder =
                area.querySelector(".drop-placeholder");

            if (!placeholder) {
                return;
            }

            const adaObjek =
                area.querySelector(".objek-card") !== null;

            placeholder.style.display =
                adaObjek ? "none" : "";
        });
    }

    // ==========================================
    // FEEDBACK
    // ==========================================

    function tampilkanFeedback(judul, pesan, ikon = "✓") {
        if (feedbackArea) {
            feedbackArea.style.display = "";
        }

        if (feedbackIcon) {
            feedbackIcon.textContent = ikon;
        }

        if (feedbackTitle) {
            feedbackTitle.textContent = judul;
        }

        if (feedbackText) {
            feedbackText.textContent = pesan;
        }
    }

    // ==========================================
    // MEMINDAHKAN KARTU
    // ==========================================

    function pindahkanObjek(objek, tujuan) {
        if (!objek || !tujuan || permainanSelesai) {
            return;
        }

        tujuan.appendChild(objek);

        objek.classList.remove("selected");
        objek.classList.remove("dragging");

        objekDipilih = null;
        objekDiseret = null;

        updateProgress();

        tampilkanFeedback(
            "Objek berhasil dipindahkan!",
            "Lanjutkan mengelompokkan objek lainnya. " +
            "Setelah semuanya selesai, tekan Cek Jawaban.",
            "✓"
        );
    }

    // ==========================================
    // DRAG AND DROP
    // ==========================================

    semuaObjek.forEach((objek) => {

        objek.setAttribute("draggable", "true");

        objek.addEventListener("dragstart", function (event) {
            if (permainanSelesai) {
                event.preventDefault();
                return;
            }

            objekDiseret = objek;

            event.dataTransfer.effectAllowed = "move";
            event.dataTransfer.setData(
                "text/plain",
                objek.dataset.id || ""
            );

            objek.classList.add("dragging");
        });

        objek.addEventListener("dragend", function () {
            objek.classList.remove("dragging");
            objekDiseret = null;
        });

        // Klik kartu juga bisa digunakan,
        // sehingga siswa tidak wajib menyeret.

        objek.addEventListener("click", function () {
            if (permainanSelesai) {
                return;
            }

            semuaObjek.forEach((kartu) => {
                kartu.classList.remove("selected");
            });

            objekDipilih = objek;
            objek.classList.add("selected");

            tampilkanFeedback(
                `${objek.dataset.nama} dipilih`,
                "Sekarang klik kotak Biotik atau Abiotik " +
                "untuk memindahkan objek.",
                "✓"
            );
        });

    });

    function pasangDropArea(area) {

        area.addEventListener("dragover", function (event) {
            if (permainanSelesai) {
                return;
            }

            event.preventDefault();
            event.dataTransfer.dropEffect = "move";
        });

        area.addEventListener("dragenter", function (event) {
            if (permainanSelesai) {
                return;
            }

            event.preventDefault();
            area.classList.add("drag-over");
        });

        area.addEventListener("dragleave", function (event) {
            if (!area.contains(event.relatedTarget)) {
                area.classList.remove("drag-over");
            }
        });

        area.addEventListener("drop", function (event) {
            event.preventDefault();
            area.classList.remove("drag-over");

            if (permainanSelesai) {
                return;
            }

            const id = event.dataTransfer.getData("text/plain");

            const objek =
                objekDiseret ||
                semuaObjek.find(
                    (kartu) => kartu.dataset.id === id
                );

            pindahkanObjek(objek, area);
        });

        area.addEventListener("click", function (event) {
            if (event.target.closest(".objek-card")) {
                return;
            }

            if (objekDipilih) {
                pindahkanObjek(objekDipilih, area);
            }
        });
    }

    pasangDropArea(dropBiotik);
    pasangDropArea(dropAbiotik);

    // Klik bagian kotak luar juga dapat digunakan.
    document.querySelectorAll(".drop-box").forEach((kotak) => {
        kotak.addEventListener("click", function (event) {
            if (
                !objekDipilih ||
                event.target.closest(".objek-card")
            ) {
                return;
            }

            const area = kotak.querySelector(".drop-area");

            if (area) {
                pindahkanObjek(objekDipilih, area);
            }
        });
    });

    // ==========================================
    // MEMERIKSA JAWABAN
    // ==========================================

    function cekJawaban() {

        if (
            permainanSelesai ||
            jumlahTerjawab() !== totalObjek ||
            totalObjek === 0
        ) {
            return;
        }

        let jumlahBenar = 0;
        const jawabanSalah = [];

        const daftarJawaban = [
            {
                area: dropBiotik,
                kategori: "biotik"
            },
            {
                area: dropAbiotik,
                kategori: "abiotik"
            }
        ];

        daftarJawaban.forEach(({ area, kategori }) => {

            const kartu = area.querySelectorAll(".objek-card");

            kartu.forEach((objek) => {
                const jawabanBenar =
                    (objek.dataset.kategori || "")
                        .trim()
                        .toLowerCase();

                objek.classList.remove("correct", "incorrect");

                if (jawabanBenar === kategori) {
                    jumlahBenar++;
                    objek.classList.add("correct");
                } else {
                    jawabanSalah.push(objek);
                    objek.classList.add("incorrect");
                }
            });

        });

        // ======================================
        // JIKA MASIH ADA JAWABAN SALAH
        // ======================================

        if (jawabanSalah.length > 0) {

            const objekPertama = jawabanSalah[0];

            const nama = objekPertama.dataset.nama || "Objek";

            const penjelasan =
                objekPertama.dataset.penjelasan ||
                "Perhatikan apakah objek tersebut " +
                "termasuk makhluk hidup atau benda tidak hidup.";

            tampilkanFeedback(
                `Masih ada ${jawabanSalah.length} jawaban yang perlu diperbaiki`,
                `Petunjuk untuk ${nama}: ${penjelasan}`,
                "!"
            );

            // Siswa tetap bisa memindahkan kartu
            // untuk memperbaiki jawabannya.
            return;
        }

        // ======================================
        // JIKA SEMUA JAWABAN BENAR
        // ======================================

        permainanSelesai = true;

        if (btnCek) {
            btnCek.disabled = true;
        }

        tampilkanFeedback(
            "Hebat! Semua jawaban benar!",
            `Kamu berhasil mengelompokkan ${jumlahBenar} objek.`,
            "✓"
        );

        tampilkanHasil();
    }

    // ==========================================
    // MENAMPILKAN HASIL
    // ==========================================

    function tampilkanHasil() {

        if (!hasilSection || !penjelasanList) {
            return;
        }

        penjelasanList.innerHTML = "";

        semuaObjek.forEach((objek) => {

            const nama = objek.dataset.nama || "Objek";

            const kategori =
                (objek.dataset.kategori || "").toLowerCase();

            const penjelasan =
                objek.dataset.penjelasan ||
                `${nama} termasuk komponen ${kategori}.`;

            const item = document.createElement("div");
            item.className = "penjelasan-item";

            const judul = document.createElement("strong");
            judul.textContent =
                `${nama} — ${kategori === "biotik" ? "Biotik" : "Abiotik"}`;

            const isi = document.createElement("p");
            isi.textContent = penjelasan;

            item.appendChild(judul);
            item.appendChild(isi);

            penjelasanList.appendChild(item);
        });

        hasilSection.style.display = "block";
        hasilSection.classList.add("active");

        hasilSection.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    }

    // ==========================================
    // RESET PERMAINAN + ACAK KARTU
    // ==========================================

    function mulaiUlangPermainan() {

        permainanSelesai = false;
        objekDipilih = null;
        objekDiseret = null;

        // Kembalikan seluruh kartu ke daftar objek.
        semuaObjek.forEach((objek) => {

            objek.classList.remove(
                "selected",
                "dragging",
                "correct",
                "incorrect"
            );

            objekList.appendChild(objek);
        });

        // BAGIAN UTAMA:
        // Acak posisi kartu setiap mulai ulang.
        acakPosisiObjek();

        // Hapus tampilan hasil sebelumnya.
        if (hasilSection) {
            hasilSection.style.display = "none";
            hasilSection.classList.remove("active");
        }

        if (penjelasanList) {
            penjelasanList.innerHTML = "";
        }

        // Bersihkan efek drag.
        dropBiotik.classList.remove("drag-over");
        dropAbiotik.classList.remove("drag-over");

        updateProgress();

        tampilkanFeedback(
            "Permainan baru dimulai!",
            "Posisi objek sudah diacak. " +
            "Yuk, kelompokkan kembali ke Biotik atau Abiotik!",
            "✓"
        );

        // Kembali ke bagian Pilih Objek.
        const objekSection = objekList.closest(".objek-section");

        if (objekSection) {
            objekSection.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }
    }

    // ==========================================
    // EVENT TOMBOL
    // ==========================================

    if (btnCek) {
        btnCek.addEventListener("click", cekJawaban);
    }

    if (btnReset) {
        btnReset.addEventListener(
            "click",
            mulaiUlangPermainan
        );
    }

    if (btnMainLagi) {
        btnMainLagi.addEventListener(
            "click",
            mulaiUlangPermainan
        );
    }

    // ==========================================
    // KONDISI AWAL
    // ==========================================

    if (hasilSection) {
        hasilSection.style.display = "none";
    }

    // Acak saat halaman pertama kali dibuka.
    acakPosisiObjek();

    updateProgress();

    tampilkanFeedback(
        "Yuk, mulai!",
        "Pilih satu objek lalu seret ke kelompok " +
        "Biotik atau Abiotik.",
        "✓"
    );

});
