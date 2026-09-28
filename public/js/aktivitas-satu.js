document.addEventListener("DOMContentLoaded", function () {

    /* =========================================
       ELEMEN
    ========================================= */

    const objekList =
        document.getElementById("objekList");

    const objekCards =
        document.querySelectorAll(".objek-card");

    const dropBoxes =
        document.querySelectorAll(".drop-box");

    const feedbackArea =
        document.getElementById("feedbackArea");

    const feedbackIcon =
        document.getElementById("feedbackIcon");

    const feedbackTitle =
        document.getElementById("feedbackTitle");

    const feedbackText =
        document.getElementById("feedbackText");

    const progressText =
        document.getElementById("progressText");

    const progressFill =
        document.getElementById("progressFill");

    const btnCek =
        document.getElementById("btnCek");

    const btnReset =
        document.getElementById("btnReset");

    const hasilSection =
        document.getElementById("hasilSection");

    const penjelasanList =
        document.getElementById("penjelasanList");

    const btnMainLagi =
        document.getElementById("btnMainLagi");


    /* =========================================
       STATE
    ========================================= */

    let draggedCard = null;

    let selectedCard = null;

    let jumlahBenar = 0;

    const totalObjek =
        objekCards.length;


    /* =========================================
       DETEKSI PERANGKAT SENTUH
    ========================================= */

    const perangkatSentuh =
        window.matchMedia(
            "(hover: none), (pointer: coarse)"
        ).matches;


    /* =========================================
       CLUE
    ========================================= */

    function buatClue(
        card,
        kategoriTujuan
    ) {

        const kategoriBenar =
            card.dataset.kategori;

        const nama =
            card.dataset.nama;


        /*
           Clue tidak langsung memberikan
           jawaban supaya siswa tetap berpikir.
        */

        if (
            kategoriBenar === "biotik" &&
            kategoriTujuan === "abiotik"
        ) {

            return (
                "Perhatikan " +
                nama +
                ". Apakah objek ini merupakan makhluk hidup " +
                "yang dapat tumbuh, berkembang, atau melakukan " +
                "proses kehidupan? Coba pikirkan lagi."
            );

        }


        if (
            kategoriBenar === "abiotik" &&
            kategoriTujuan === "biotik"
        ) {

            return (
                "Perhatikan " +
                nama +
                ". Apakah objek ini benar-benar makhluk hidup? " +
                "Ingat, komponen abiotik adalah unsur tidak hidup " +
                "yang membantu membentuk kondisi lingkungan."
            );

        }


        return (
            "Coba perhatikan kembali ciri-ciri " +
            nama +
            " sebelum memilih kelompoknya."
        );

    }


    /* =========================================
       FEEDBACK NORMAL
    ========================================= */

    function feedbackNormal() {

        feedbackArea.classList.remove(
            "feedback-benar",
            "feedback-salah"
        );

        feedbackIcon.textContent =
            "🌱";

        feedbackTitle.textContent =
            "Yuk, mulai!";


        if (perangkatSentuh) {

            feedbackText.textContent =
                "Pilih satu objek, lalu ketuk kotak Biotik atau Abiotik.";

        } else {

            feedbackText.textContent =
                "Pilih satu objek lalu seret ke kelompok Biotik atau Abiotik.";

        }

    }


    /* =========================================
       FEEDBACK SAAT OBJEK DIPILIH
    ========================================= */

    function feedbackDipilih(card) {

        feedbackArea.classList.remove(
            "feedback-benar",
            "feedback-salah"
        );

        feedbackIcon.textContent =
            "👆";

        feedbackTitle.textContent =
            card.dataset.nama + " dipilih";

        feedbackText.textContent =
            "Sekarang pilih kotak Biotik atau Abiotik.";

    }


    /* =========================================
       FEEDBACK BENAR
    ========================================= */

    function feedbackBenar(card) {

        feedbackArea.classList.remove(
            "feedback-salah"
        );

        feedbackArea.classList.add(
            "feedback-benar"
        );

        feedbackIcon.textContent =
            "✓";

        feedbackTitle.textContent =
            "Benar!";

        feedbackText.textContent =
            card.dataset.penjelasan;

    }


    /* =========================================
       FEEDBACK SALAH + CLUE
    ========================================= */

    function feedbackSalah(
        card,
        kategoriTujuan
    ) {

        feedbackArea.classList.remove(
            "feedback-benar"
        );

        feedbackArea.classList.add(
            "feedback-salah"
        );

        feedbackIcon.textContent =
            "💡";

        feedbackTitle.textContent =
            "Belum tepat, coba lagi!";

        feedbackText.textContent =
            buatClue(
                card,
                kategoriTujuan
            );


        card.classList.add(
            "jawaban-salah"
        );


        setTimeout(function () {

            card.classList.remove(
                "jawaban-salah"
            );

        }, 450);

    }


    /* =========================================
       UPDATE PROGRESS
    ========================================= */

    function updateProgress() {

        progressText.textContent =
            jumlahBenar +
            " / " +
            totalObjek;


        let persen = 0;


        if (totalObjek > 0) {

            persen =
                (jumlahBenar / totalObjek) *
                100;

        }


        progressFill.style.width =
            persen + "%";


        /*
           Cek Jawaban hanya aktif jika
           semua objek sudah ditempatkan.
        */

        if (
            totalObjek > 0 &&
            jumlahBenar === totalObjek
        ) {

            btnCek.disabled = false;


            feedbackArea.classList.remove(
                "feedback-salah"
            );

            feedbackArea.classList.add(
                "feedback-benar"
            );


            feedbackIcon.textContent =
                "🎉";

            feedbackTitle.textContent =
                "Semua objek sudah dikelompokkan!";

            feedbackText.textContent =
                "Bagus! Sekarang tekan tombol Cek Jawaban untuk melihat penjelasan dari setiap objek.";

        } else {

            btnCek.disabled = true;

        }

    }


    /* =========================================
       HAPUS STATUS OBJEK TERPILIH
    ========================================= */

    function hapusPilihan() {

        objekCards.forEach(function (card) {

            card.classList.remove(
                "objek-terpilih"
            );

        });


        dropBoxes.forEach(function (dropBox) {

            dropBox.classList.remove(
                "tap-target"
            );

        });


        selectedCard = null;

    }


    /* =========================================
       PILIH OBJEK DENGAN TAP / CLICK
    ========================================= */

    function pilihObjek(card) {

        /*
           Objek yang sudah benar
           tidak boleh dipilih kembali.
        */

        if (
            card.classList.contains(
                "jawaban-benar"
            )
        ) {

            return;

        }


        /*
           Jika card yang sama ditekan lagi,
           pilihan dibatalkan.
        */

        if (selectedCard === card) {

            hapusPilihan();

            feedbackNormal();

            return;

        }


        hapusPilihan();


        selectedCard = card;


        card.classList.add(
            "objek-terpilih"
        );


        dropBoxes.forEach(function (dropBox) {

            dropBox.classList.add(
                "tap-target"
            );

        });


        feedbackDipilih(card);

    }


    /* =========================================
       MASUKKAN OBJEK KE KATEGORI
       DIPAKAI OLEH DRAG DAN TAP
    ========================================= */

    function prosesJawaban(
        card,
        dropBox
    ) {

        if (!card || !dropBox) {
            return;
        }


        if (
            card.classList.contains(
                "jawaban-benar"
            )
        ) {

            return;

        }


        const kategoriObjek =
            card.dataset.kategori;

        const kategoriTujuan =
            dropBox.dataset.kategori;


        /* =====================================
           JAWABAN BENAR
        ===================================== */

        if (
            kategoriObjek ===
            kategoriTujuan
        ) {

            const dropArea =
                dropBox.querySelector(
                    ".drop-area"
                );


            const placeholder =
                dropArea.querySelector(
                    ".drop-placeholder"
                );


            if (placeholder) {

                placeholder.remove();

            }


            dropArea.appendChild(
                card
            );


            card.classList.add(
                "jawaban-benar"
            );


            card.classList.remove(
                "jawaban-salah",
                "dragging",
                "objek-terpilih"
            );


            card.setAttribute(
                "draggable",
                "false"
            );


            jumlahBenar++;


            feedbackBenar(card);


            hapusPilihan();


            updateProgress();

        }


        /* =====================================
           JAWABAN SALAH
        ===================================== */

        else {

            feedbackSalah(
                card,
                kategoriTujuan
            );


            /*
               Jika menggunakan HP,
               card tetap dipilih supaya
               siswa bisa mencoba kotak lain
               tanpa memilih ulang objek.
            */

            if (perangkatSentuh) {

                selectedCard = card;

                card.classList.add(
                    "objek-terpilih"
                );


                dropBoxes.forEach(
                    function (box) {

                        box.classList.add(
                            "tap-target"
                        );

                    }
                );

            }

        }

    }


    /* =========================================
       DRAG START / END - LAPTOP
    ========================================= */

    objekCards.forEach(function (card) {

        card.addEventListener(
            "dragstart",
            function (event) {

                if (
                    card.classList.contains(
                        "jawaban-benar"
                    )
                ) {

                    event.preventDefault();

                    return;

                }


                draggedCard = card;


                card.classList.add(
                    "dragging"
                );


                /*
                   Membantu browser mengenali
                   proses drag.
                */

                if (event.dataTransfer) {

                    event.dataTransfer.effectAllowed =
                        "move";

                    event.dataTransfer.setData(
                        "text/plain",
                        card.dataset.id || ""
                    );

                }

            }
        );


        card.addEventListener(
            "dragend",
            function () {

                card.classList.remove(
                    "dragging"
                );


                dropBoxes.forEach(
                    function (dropBox) {

                        dropBox.classList.remove(
                            "drag-over"
                        );

                    }
                );


                draggedCard = null;

            }
        );


        /* =====================================
           TAP / CLICK OBJEK
        ===================================== */

        card.addEventListener(
            "click",
            function (event) {

                /*
                   Pada laptop, click juga boleh
                   digunakan sebagai alternatif
                   selain drag.
                */

                if (
                    card.classList.contains(
                        "jawaban-benar"
                    )
                ) {

                    return;

                }


                event.preventDefault();


                pilihObjek(card);

            }
        );

    });


    /* =========================================
       DROP AREA
    ========================================= */

    dropBoxes.forEach(function (dropBox) {

        /* =====================================
           DRAG OVER
        ===================================== */

        dropBox.addEventListener(
            "dragover",
            function (event) {

                event.preventDefault();


                if (event.dataTransfer) {

                    event.dataTransfer.dropEffect =
                        "move";

                }


                dropBox.classList.add(
                    "drag-over"
                );

            }
        );


        /* =====================================
           DRAG LEAVE
        ===================================== */

        dropBox.addEventListener(
            "dragleave",
            function () {

                dropBox.classList.remove(
                    "drag-over"
                );

            }
        );


        /* =====================================
           DROP DENGAN MOUSE
        ===================================== */

        dropBox.addEventListener(
            "drop",
            function (event) {

                event.preventDefault();


                dropBox.classList.remove(
                    "drag-over"
                );


                if (!draggedCard) {
                    return;
                }


                prosesJawaban(
                    draggedCard,
                    dropBox
                );


                draggedCard = null;

            }
        );


        /* =====================================
           TAP DROP BOX DI HP
        ===================================== */

        dropBox.addEventListener(
            "click",
            function (event) {

                /*
                   Jangan jalankan click drop box
                   ketika yang ditekan adalah card
                   yang sudah berada di dalamnya.
                */

                if (
                    event.target.closest(
                        ".objek-card"
                    )
                ) {

                    return;

                }


                if (!selectedCard) {

                    /*
                       Jika belum memilih objek,
                       beri petunjuk.
                    */

                    feedbackArea.classList.remove(
                        "feedback-benar",
                        "feedback-salah"
                    );


                    feedbackIcon.textContent =
                        "👆";

                    feedbackTitle.textContent =
                        "Pilih objek terlebih dahulu";

                    feedbackText.textContent =
                        "Ketuk salah satu objek di atas, lalu pilih kelompok Biotik atau Abiotik.";

                    return;

                }


                prosesJawaban(
                    selectedCard,
                    dropBox
                );

            }
        );

    });


    /* =========================================
       CEK JAWABAN
    ========================================= */

    btnCek.addEventListener(
        "click",
        function () {

            if (
                jumlahBenar !== totalObjek
            ) {

                return;

            }


            /*
               Kosongkan penjelasan lama.
            */

            penjelasanList.innerHTML =
                "";


            /*
               Buat penjelasan berdasarkan
               data dari database.
            */

            objekCards.forEach(
                function (card) {

                    const nama =
                        card.dataset.nama;

                    const kategori =
                        card.dataset.kategori;

                    const penjelasan =
                        card.dataset.penjelasan;


                    const item =
                        document.createElement(
                            "div"
                        );


                    item.className =
                        "penjelasan-item";


                    /*
                       Dibuat dengan createElement
                       agar isi database dipasang
                       sebagai textContent.
                    */

                    const check =
                        document.createElement(
                            "div"
                        );

                    check.className =
                        "penjelasan-check";

                    check.textContent =
                        "✓";


                    const content =
                        document.createElement(
                            "div"
                        );


                    const judul =
                        document.createElement(
                            "strong"
                        );

                    judul.textContent =
                        nama +
                        " — " +
                        kapitalKategori(
                            kategori
                        );


                    const paragraf =
                        document.createElement(
                            "p"
                        );

                    paragraf.textContent =
                        penjelasan;


                    content.appendChild(
                        judul
                    );

                    content.appendChild(
                        paragraf
                    );


                    item.appendChild(
                        check
                    );

                    item.appendChild(
                        content
                    );


                    penjelasanList.appendChild(
                        item
                    );

                }
            );


            /*
               Tampilkan hasil.
            */

            hasilSection.classList.add(
                "show"
            );


            /*
               Scroll ke hasil.
            */

            setTimeout(function () {

                hasilSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });

            }, 150);

        }
    );


    /* =========================================
       KAPITAL KATEGORI
    ========================================= */

    function kapitalKategori(kategori) {

        if (kategori === "biotik") {

            return "Biotik";

        }


        if (kategori === "abiotik") {

            return "Abiotik";

        }


        return kategori;

    }


    /* =========================================
       BUAT PLACEHOLDER
    ========================================= */

    function buatPlaceholder(
        area,
        kategori
    ) {

        const placeholder =
            document.createElement(
                "div"
            );


        placeholder.className =
            "drop-placeholder";


        const panah =
            document.createElement(
                "span"
            );

        panah.textContent =
            "↓";


        const teks =
            document.createElement(
                "p"
            );


        if (kategori === "biotik") {

            teks.textContent =
                "Letakkan objek biotik di sini";

        } else {

            teks.textContent =
                "Letakkan objek abiotik di sini";

        }


        placeholder.appendChild(
            panah
        );

        placeholder.appendChild(
            teks
        );


        area.appendChild(
            placeholder
        );

    }


    /* =========================================
       RESET
    ========================================= */

    function resetAktivitas() {

        jumlahBenar = 0;


        draggedCard = null;

        selectedCard = null;


        hasilSection.classList.remove(
            "show"
        );


        penjelasanList.innerHTML =
            "";


        /*
           Kembalikan semua card ke tempat awal.
        */

        objekCards.forEach(
            function (card) {

                card.classList.remove(
                    "jawaban-benar",
                    "jawaban-salah",
                    "dragging",
                    "objek-terpilih"
                );


                card.setAttribute(
                    "draggable",
                    "true"
                );


                objekList.appendChild(
                    card
                );

            }
        );


        /*
           Bersihkan status drop box.
        */

        dropBoxes.forEach(
            function (dropBox) {

                dropBox.classList.remove(
                    "drag-over",
                    "tap-target"
                );

            }
        );


        /*
           Buat ulang placeholder
           pada masing-masing kotak.
        */

        document
            .querySelectorAll(
                ".drop-area"
            )
            .forEach(
                function (area) {

                    const kategori =
                        area.parentElement
                            .dataset.kategori;


                    area.innerHTML =
                        "";


                    buatPlaceholder(
                        area,
                        kategori
                    );

                }
            );


        feedbackNormal();


        updateProgress();


        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    }


    /* =========================================
       BUTTON RESET
    ========================================= */

    btnReset.addEventListener(
        "click",
        resetAktivitas
    );


    btnMainLagi.addEventListener(
        "click",
        resetAktivitas
    );


    /* =========================================
       UPDATE TEKS DRAG SESUAI PERANGKAT
    ========================================= */

    function updatePetunjukObjek() {

        objekCards.forEach(
            function (card) {

                const dragText =
                    card.querySelector(
                        ".drag-text"
                    );


                if (!dragText) {
                    return;
                }


                if (perangkatSentuh) {

                    dragText.textContent =
                        "Ketuk untuk memilih";

                } else {

                    dragText.textContent =
                        "⋮⋮ Seret atau klik";

                }

            }
        );

    }


    /* =========================================
       INITIAL
    ========================================= */

    updatePetunjukObjek();

    feedbackNormal();

    updateProgress();

});