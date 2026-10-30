
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petualangan Si Bangau - BAKAWAN</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/petualangan-bangau.css') }}">
</head>
<body>

@include('components.header')

<main class="bangau-game" id="bangauGame"
      data-activity-url="{{ route('aktivitas') }}">

    <!-- HALAMAN AWAL -->
    <section class="bangau-screen active" id="screenHome">
        <div class="bangau-home">
            <div class="bangau-home-content">
                <span class="bangau-tag">GAME UTAMA BAKAWAN</span>

                <h1>Petualangan<br>Si Bangau</h1>
                <h2>Menjelajahi Ekosistem Lahan Basah</h2>

                <p>
                    Ayo bantu Si Bangau menjelajahi sungai dan rawa
                    Kalimantan Selatan sambil belajar tentang
                    komponen ekosistem dan hubungan makhluk hidup!
                </p>

                <div class="bangau-actions">
                    <button class="bangau-btn primary"
                            id="btnStart">
                        Mulai Petualangan
                    </button>

                    <button class="bangau-btn secondary"
                            id="btnContinue" hidden>
                        Lanjutkan Petualangan
                    </button>

                    <a class="bangau-btn secondary"
                       href="{{ route('aktivitas') }}">
                        Kembali ke Aktivitas
                    </a>
                </div>
            </div>

            <div class="bangau-home-art">
                <div class="bangau-home-bird"></div>
            </div>
        </div>
    </section>

    <!-- AREA GAMEPLAY -->
    <section class="bangau-screen" id="screenGame">
        <div class="bangau-game-card">

            <div class="bangau-hud">
                <div class="bangau-hud-heading">
                    <span class="bangau-level-label"
                          id="levelLabel">MISI 1</span>

                    <strong id="levelTitle">
                        Kenali Lingkungan
                    </strong>
                </div>

                <div class="bangau-hud-targets"
                     id="missionTargets"></div>

                <div class="bangau-hud-right">
                    <span class="bangau-score">
                        Skor: <b id="scoreValue">0</b>
                    </span>

                    <span class="bangau-lives"
                          id="livesDisplay">♥♥♥</span>

                    <button class="bangau-pause-btn"
                            id="btnPause">
                        Jeda
                    </button>
                </div>
            </div>

            <div class="bangau-world" id="gameWorld"
                 tabindex="0"
                 aria-label="Area permainan Petualangan Bangau">

                <div class="bangau-background-layer"></div>

                <div class="bangau-world-objects"
                     id="worldObjects"></div>

                <div class="bangau-player" id="player">
                    <div class="bangau-player-image"></div>
                    <span class="bangau-player-name">
                        Si Bangau
                    </span>
                </div>

                <div class="bangau-nearby-hint"
                     id="nearbyHint" hidden></div>

                <div class="bangau-world-message"
                     id="worldMessage" hidden></div>
            </div>

            <div class="bangau-controls">
                <div class="bangau-control-group">
                    <button class="bangau-control-btn"
                            id="btnLeft"
                            aria-label="Bergerak kiri">←</button>

                    <button class="bangau-control-btn"
                            id="btnRight"
                            aria-label="Bergerak kanan">→</button>
                </div>

                <span class="bangau-control-help">
                    ← → Bergerak · Spasi Melompat
                </span>

                <button class="bangau-control-btn jump"
                        id="btnJump"
                        aria-label="Melompat">↑</button>
            </div>
        </div>
    </section>

    <!-- HALAMAN AKHIR -->
    <section class="bangau-screen" id="screenFinish">
        <div class="bangau-finish">
            <div class="bangau-finish-medal">★</div>
            <h1>Petualangan Selesai!</h1>

            <p>
                Hebat! Kamu berhasil membantu Si Bangau
                mengenali dan menjaga ekosistem lahan basah.
            </p>

            <h2>Total Skor: <span id="finalScore">0</span></h2>

            <div class="bangau-actions center">
                <button class="bangau-btn primary"
                        id="btnRestart">
                    Main Lagi
                </button>

                <a class="bangau-btn secondary"
                   href="{{ route('aktivitas') }}">
                    Kembali ke Aktivitas
                </a>
            </div>
        </div>
    </section>

    <!-- MODAL TUTORIAL -->
    <div class="bangau-modal" id="tutorialModal"
         role="dialog" aria-modal="true"
         aria-labelledby="tutorialTitle">
        <div class="bangau-modal-card">
            <span class="bangau-tag" id="tutorialLevel">
                TUTORIAL MISI 1
            </span>

            <h2 id="tutorialTitle">Cara Bermain</h2>

            <div class="bangau-tutorial-scene">
                <div class="bangau-tutorial-character"></div>
                <div class="bangau-tutorial-ground"></div>
            </div>

            <p id="tutorialDescription"></p>

            <p class="bangau-tutorial-note">
                Gunakan tombol kiri dan kanan untuk bergerak,
                serta tombol atas untuk melompat.
                Pertanyaan muncul otomatis saat menyentuh
                objek pembelajaran.
            </p>

            <button class="bangau-btn primary"
                    id="btnTutorialPlay">
                Mulai Bermain
            </button>
        </div>
    </div>

    <!-- MODAL PERTANYAAN -->
    <div class="bangau-modal" id="questionModal"
         role="dialog" aria-modal="true"
         aria-labelledby="questionTitle">
        <div class="bangau-modal-card">
            <span class="bangau-tag">TANTANGAN IPAS</span>

            <h2 id="questionTitle">Ayo Menjawab!</h2>

            <p id="questionText"></p>

            <div class="bangau-answer-list"
                 id="answerList"></div>

            <p class="bangau-feedback"
               id="questionFeedback"></p>

            <button class="bangau-btn primary"
                    id="btnQuestionNext" hidden>
                Lanjutkan
            </button>
        </div>
    </div>

    <!-- MODAL MISI BERHASIL -->
    <div class="bangau-modal" id="successModal"
         role="dialog" aria-modal="true">
        <div class="bangau-modal-card">
            <div class="bangau-result-icon">★</div>

            <h2 id="successTitle">Misi Berhasil!</h2>
            <p id="successDescription"></p>

            <div class="bangau-result-stats">
                <div>
                    <strong id="successScore">0</strong>
                    <span>Skor Misi</span>
                </div>

                <div>
                    <strong id="successLives">3</strong>
                    <span>Sisa Nyawa</span>
                </div>
            </div>

            <p class="bangau-fact" id="successFact"></p>

            <button class="bangau-btn primary"
                    id="btnNextMission">
                Lanjutkan Petualangan
            </button>
        </div>
    </div>

    <!-- MODAL GAME OVER -->
    <div class="bangau-modal" id="gameOverModal"
         role="dialog" aria-modal="true">
        <div class="bangau-modal-card">
            <div class="bangau-sad-stork" aria-label="Bangau sedih">
                <div class="sad-stork-character"></div>
                <span class="sad-stork-tear tear-one"></span>
                <span class="sad-stork-tear tear-two"></span>
            </div>

            <h2>Yah, Petualangan Belum Berhasil!</h2>

            <p>
                Jangan menyerah! Ayo coba lagi dan
                bantu Si Bangau menyelesaikan misinya.
            </p>

            <p>Skor Misi: <strong id="gameOverScore">0</strong></p>

            <button class="bangau-btn primary"
                    id="btnRetry">
                Coba Lagi
            </button>
        </div>
    </div>

    <!-- MODAL JEDA -->
    <div class="bangau-modal" id="pauseModal"
         role="dialog" aria-modal="true">
        <div class="bangau-modal-card">
            <h2>Permainan Dijeda</h2>
            <p>Si Bangau sedang beristirahat sebentar.</p>

            <button class="bangau-btn primary"
                    id="btnResume">
                Lanjutkan
            </button>
        </div>
    </div>

</main>

<script>
    window.BANGAU_ASSETS = {
        ikan: "{{ asset('images/aktivitas/ikan.png') }}",
        batu: "{{ asset('images/aktivitas/batu.png') }}",
        teratai: "{{ asset('images/aktivitas/teratai.png') }}",
        air: "{{ asset('images/aktivitas/air.png') }}",
        katak: "{{ asset('images/aktivitas/katak.png') }}",
        serangga: "{{ asset('images/aktivitas/serangga.png') }}",
        sampah: "{{ asset('assets/game-bangau/objects/sampah.svg') }}",
        papan: "{{ asset('assets/game-bangau/objects/papan-petunjuk.svg') }}",
        bendera: "{{ asset('assets/game-bangau/objects/bendera-tujuan.svg') }}",
        bangau: "{{ asset('assets/game-bangau/characters/bangau-sprite-sheet.png') }}",
        backgrounds: [
            "{{ asset('assets/game-bangau/backgrounds/level-1-platformer-v2.png') }}",
            "{{ asset('assets/game-bangau/backgrounds/level-2-platformer-v2.png') }}",
            "{{ asset('assets/game-bangau/backgrounds/level-3-platformer-v2.png') }}"
        ]
    };
</script>

<script src="{{ asset('js/petualangan-bangau.js') }}"></script>

</body>
</html>