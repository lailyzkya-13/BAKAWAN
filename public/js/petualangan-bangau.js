
(() => {
    'use strict';

    const $ = id => document.getElementById(id);
    const ASSET = window.BANGAU_ASSETS || {};
    const STORAGE = 'bakawan-petualangan-bangau-v3';

    const missions = [
        {
            name: 'Kenali Lingkungan',
            tutorial: 'Kumpulkan 5 ikan, kenali 4 objek biotik dan abiotik, hindari rintangan, lalu capai bendera.',
            fact: 'Biotik adalah makhluk hidup, sedangkan abiotik adalah komponen tak hidup.',
            targets: { fish: 5, quiz: 4 },
            objects: [
                ...[14, 29, 46, 65, 82].map((x, i) => ({
                    id: 'fish' + i,
                    type: 'fish',
                    asset: 'ikan',
                    x, y: 70,
                    label: 'Ikan'
                })),
                {
                    id: 'quiz1', type: 'quiz',
                    asset: 'teratai', x:20, y:59,
                    label:'Teratai',
                    question:'Teratai termasuk komponen apa?',
                    answers:['Biotik','Abiotik'],
                    correct:0,
                    explanation:'Teratai termasuk biotik karena merupakan tumbuhan hidup.'
                },
                {
                    id:'quiz2', type:'quiz',
                    asset:'air', x:39, y:59,
                    label:'Air',
                    question:'Air sungai termasuk komponen apa?',
                    answers:['Biotik','Abiotik'],
                    correct:1,
                    explanation:'Air termasuk abiotik karena bukan makhluk hidup.'
                },
                {
                    id:'quiz3', type:'quiz',
                    asset:'batu', x:58, y:59,
                    label:'Batu',
                    question:'Batu termasuk komponen apa?',
                    answers:['Biotik','Abiotik'],
                    correct:1,
                    explanation:'Batu merupakan komponen abiotik.'
                },
                {
                    id:'quiz4', type:'quiz',
                    asset:'ikan', x:76, y:59,
                    label:'Ikan',
                    question:'Mengapa ikan termasuk biotik?',
                    answers:[
                        'Karena ikan bernapas dan tumbuh',
                        'Karena ikan berada di air'
                    ],
                    correct:0,
                    explanation:'Ikan termasuk biotik karena memiliki ciri makhluk hidup.'
                },
                {
                    id:'haz1', type:'hazard',
                    asset:'sampah', x:35, y:78,
                    label:'Plastik berbahaya'
                },
                {
                    id:'haz2', type:'hazard',
                    asset:'batu', x:70, y:78,
                    label:'Batu rintangan'
                },
                {
                    id:'goal', type:'goal',
                    asset:'bendera', x:95, y:76,
                    label:'Bendera akhir'
                }
            ]
        },
        {
            name:'Bantu Si Bangau',
            tutorial:'Selesaikan 3 teka-teki hubungan ekosistem, lewati 4 pos, dan capai tujuan.',
            fact:'Rantai makanan menunjukkan perpindahan energi dari produsen ke konsumen.',
            targets:{quiz:3, posts:4},
            objects:[
                {
                    id:'q1', type:'quiz',
                    asset:'teratai', x:18, y:59,
                    label:'Teka-teki 1',
                    question:'Organisme yang berperan sebagai produsen adalah ...',
                    answers:['Tumbuhan air','Bangau','Katak'],
                    correct:0,
                    explanation:'Tumbuhan air membuat makanan sendiri sehingga menjadi produsen.'
                },
                {
                    id:'q2', type:'quiz',
                    asset:'serangga', x:46, y:59,
                    label:'Teka-teki 2',
                    question:'Urutan rantai makanan yang benar adalah ...',
                    answers:[
                        'Tumbuhan → serangga → katak → bangau',
                        'Bangau → tumbuhan → serangga'
                    ],
                    correct:0,
                    explanation:'Rantai makanan dimulai dari produsen, kemudian konsumen.'
                },
                {
                    id:'q3', type:'quiz',
                    asset:'ikan', x:75, y:59,
                    label:'Teka-teki 3',
                    question:'Bangau yang memakan ikan berperan sebagai ...',
                    answers:['Produsen','Konsumen','Pengurai'],
                    correct:1,
                    explanation:'Bangau merupakan konsumen karena memakan organisme lain.'
                },
                ...[25,40,62,84].map((x,i) => ({
                    id:'post'+i,
                    type:'post',
                    asset:'papan',
                    x, y:70,
                    label:'Pos '+(i+1)
                })),
                {
                    id:'haz1', type:'hazard',
                    asset:'batu', x:34, y:78,
                    label:'Batu rintangan'
                },
                {
                    id:'haz2', type:'hazard',
                    asset:'sampah', x:68, y:78,
                    label:'Rintangan'
                },
                {
                    id:'goal', type:'goal',
                    asset:'bendera', x:95, y:76,
                    label:'Sarang bangau'
                }
            ]
        },
        {
            name:'Jaga Keseimbangan',
            tutorial:'Bersihkan 6 sampah, bantu 2 hewan, dan jawab 2 tantangan pelestarian.',
            fact:'Mengurangi sampah plastik membantu melindungi habitat hewan air.',
            targets:{trash:6, animals:2, quiz:2},
            objects:[
                ...[13,25,37,51,67,83].map((x,i) => ({
                    id:'trash'+i,
                    type:'trash',
                    asset:'sampah',
                    x, y:70,
                    label:'Sampah untuk dibersihkan'
                })),
                {
                    id:'animal1', type:'animal',
                    asset:'ikan', x:31, y:59,
                    label:'Bantu ikan'
                },
                {
                    id:'animal2', type:'animal',
                    asset:'katak', x:72, y:59,
                    label:'Bantu katak'
                },
                {
                    id:'q1', type:'quiz',
                    asset:'papan', x:44, y:59,
                    label:'Tantangan 1',
                    question:'Mengapa plastik berbahaya bagi hewan air?',
                    answers:[
                        'Dapat tertelan dan mencemari habitat',
                        'Membuat sungai semakin bersih'
                    ],
                    correct:0,
                    explanation:'Sampah plastik dapat mencemari habitat dan membahayakan hewan.'
                },
                {
                    id:'q2', type:'quiz',
                    asset:'papan', x:80, y:59,
                    label:'Tantangan 2',
                    question:'Cara terbaik menjaga sungai adalah ...',
                    answers:[
                        'Membuang sampah ke sungai',
                        'Mengurangi plastik dan membuang sampah dengan benar'
                    ],
                    correct:1,
                    explanation:'Menjaga kebersihan sungai membantu keseimbangan ekosistem.'
                },
                {
                    id:'haz1', type:'hazard',
                    asset:'batu', x:57, y:78,
                    label:'Rintangan berbahaya'
                },
                {
                    id:'goal', type:'goal',
                    asset:'bendera', x:95, y:76,
                    label:'Tujuan akhir'
                }
            ]
        }
    ];

    const platforms = [
        [
            {x:12,w:16,y:61},
            {x:35,w:16,y:57},
            {x:59,w:16,y:61},
            {x:79,w:15,y:57}
        ],
        [
            {x:13,w:17,y:61},
            {x:38,w:17,y:56},
            {x:64,w:15,y:61},
            {x:82,w:14,y:56}
        ],
        [
            {x:13,w:17,y:61},
            {x:38,w:16,y:56},
            {x:62,w:16,y:61},
            {x:81,w:14,y:56}
        ]
    ];

    let state = {
        mission:0,
        score:0,
        missionStartScore:0,
        lives:3,
        x:7,
        y:86,
        vy:0,
        grounded:true,
        platform:null,
        progress:{},
        done:new Set(),
        playing:false,
        paused:false,
        invincibleUntil:0
    };

    const keys = {left:false,right:false};

    let currentQuestion = null;
    let audioContext = null;
    let soundEnabled = true;
    let volume = .45;
    let lastFrame = 0;
    let messageTimer = null;

    const GROUND_Y = 86;

    function showScreen(id) {
        document.querySelectorAll('.bangau-screen')
            .forEach(el => el.classList.toggle(
                'active', el.id === id
            ));
    }

    function openModal(id) {
        $(id).classList.add('open');
    }

    function closeModal(id) {
        $(id).classList.remove('open');
    }

    function getSaved() {
        try {
            return JSON.parse(
                localStorage.getItem(STORAGE) || 'null'
            );
        } catch {
            return null;
        }
    }

    function saveProgress(mission = state.mission, complete = false) {
        localStorage.setItem(STORAGE, JSON.stringify({
            mission,
            score:state.score,
            complete
        }));
        updateContinue();
    }

    function updateContinue() {
        const saved = getSaved();
        $('btnContinue').hidden = !saved || saved.complete;
    }

    /* SUARA SEDERHANA */

    function playSound(type) {
        if (!soundEnabled || volume <= 0) return;

        try {
            audioContext ||= new (
                window.AudioContext ||
                window.webkitAudioContext
            )();

            if (audioContext.state === 'suspended') {
                audioContext.resume();
            }

            const sounds = {
                click:[[500,.06]],
                jump:[[350,.09],[520,.10]],
                collect:[[650,.08],[850,.12]],
                correct:[[520,.10],[750,.16]],
                wrong:[[220,.17]],
                hurt:[[160,.25]],
                win:[[520,.12],[660,.14],[880,.22]],
                over:[[290,.17],[170,.28]]
            };

            const notes = sounds[type] || sounds.click;
            let delay = 0;

            notes.forEach(([frequency,duration]) => {
                const oscillator = audioContext.createOscillator();
                const gain = audioContext.createGain();

                const start = audioContext.currentTime + delay;

                oscillator.type =
                    type === 'hurt' ? 'triangle' : 'sine';

                oscillator.frequency.value = frequency;

                gain.gain.setValueAtTime(
                    Math.max(.001,volume * .12),start
                );

                gain.gain.exponentialRampToValueAtTime(
                    .001,start + duration
                );

                oscillator.connect(gain);
                gain.connect(audioContext.destination);

                oscillator.start(start);
                oscillator.stop(start + duration);

                delay += duration * .8;
            });
        } catch(error) {
            console.warn('Audio:',error);
        }
    }

    /* TUTORIAL */

    function showTutorial(index) {
        state.mission = index;
        state.playing = false;

        $('tutorialLevel').textContent =
            `TUTORIAL MISI ${index+1}`;

        $('tutorialTitle').textContent =
            missions[index].name;

        $('tutorialDescription').textContent =
            missions[index].tutorial;

        openModal('tutorialModal');
    }

    /* MEMULAI MISI */

    function startMission() {
        state.lives = 3;
        state.x = 7;
        state.y = GROUND_Y;
        state.vy = 0;
        state.grounded = true;
        state.platform = null;
        state.progress = {};
        state.done = new Set();
        state.playing = true;
        state.paused = false;
        state.invincibleUntil = 0;
        state.missionStartScore = state.score;

        keys.left = false;
        keys.right = false;

        $('player').classList.remove('hurt','walk','left');

        closeModal('tutorialModal');
        closeModal('gameOverModal');
        closeModal('successModal');

        showScreen('screenGame');
        renderWorld();
        updateHUD();
        updatePlayer();

        $('gameWorld').focus();
        saveProgress();
    }

    /* RENDER GAME */

    function renderWorld() {
        const container = $('worldObjects');
        container.innerHTML = '';

        const background = document.querySelector(
            '.bangau-background-layer'
        );

        background.style.backgroundImage =
            `url("${ASSET.backgrounds[state.mission]}")`;

        const ground = document.createElement('div');
        ground.className = 'bangau-ground';
        container.appendChild(ground);

        platforms[state.mission].forEach(platform => {
            const element = document.createElement('div');
            element.className = 'bangau-platform';
            element.style.left = platform.x + '%';
            element.style.top = platform.y + '%';
            element.style.width = platform.w + '%';
            container.appendChild(element);
        });

        missions[state.mission].objects.forEach(object => {
            if (state.done.has(object.id)) return;

            const element = document.createElement('div');
            element.className = 'bangau-object';
            element.dataset.id = object.id;
            element.style.left = object.x + '%';
            element.style.top = object.y + '%';

            if (['fish','trash'].includes(object.type)) {
                element.classList.add('collectible');
            }

            if (object.type === 'hazard') {
                element.classList.add('hazard');
            }

            if (object.type === 'goal') {
                element.classList.add('goal');
            }

            const image = document.createElement('img');
            image.src = ASSET[object.asset] || '';
            image.alt = object.label || object.asset;

            const label = document.createElement('span');
            label.className = 'bangau-object-label';
            label.textContent = object.label || '';

            element.append(image,label);
            container.appendChild(element);
        });
    }

    function updateHUD() {
        const mission = missions[state.mission];

        $('levelLabel').textContent =
            `MISI ${state.mission+1}`;

        $('levelTitle').textContent = mission.name;
        $('scoreValue').textContent = state.score;

        $('livesDisplay').textContent =
            '♥'.repeat(state.lives) +
            '♡'.repeat(3-state.lives);

        const names = {
            fish:'Ikan',
            quiz:'Pertanyaan',
            posts:'Pos',
            trash:'Sampah',
            animals:'Hewan'
        };

        $('missionTargets').innerHTML =
            Object.entries(mission.targets)
                .map(([key,need]) => {
                    const count = state.progress[key] || 0;
                    const complete = count >= need;

                    return `
                        <span class="bangau-target ${complete ? 'complete' : ''}">
                            ${names[key]}: ${count}/${need}
                        </span>
                    `;
                }).join('');
    }

    function updatePlayer() {
        $('player').style.left = state.x + '%';
        $('player').style.top = state.y + '%';
    }

    function addProgress(key,points) {
        state.progress[key] =
            (state.progress[key] || 0) + 1;

        state.score += points;
        updateHUD();
    }

    function completeTargets() {
        return Object.entries(
            missions[state.mission].targets
        ).every(([key,need]) =>
            (state.progress[key] || 0) >= need
        );
    }

    function showMessage(text) {
        const message = $('worldMessage');
        message.textContent = text;
        message.hidden = false;

        clearTimeout(messageTimer);

        messageTimer = setTimeout(() => {
            message.hidden = true;
        },1800);
    }

    /* INTERAKSI OBJEK */

    function interact(object) {
        if (!state.playing || state.paused ||
            state.done.has(object.id)) return;

        if (object.type === 'fish') {
            state.done.add(object.id);
            addProgress('fish',10);
            playSound('collect');
            renderWorld();
        }

        else if (object.type === 'trash') {
            state.done.add(object.id);
            addProgress('trash',10);
            playSound('collect');
            renderWorld();
        }

        else if (object.type === 'animal') {
            state.done.add(object.id);
            addProgress('animals',20);
            playSound('correct');
            showMessage('Hewan berhasil dibantu!');
            renderWorld();
        }

        else if (object.type === 'post') {
            state.done.add(object.id);
            addProgress('posts',10);
            playSound('collect');
            renderWorld();
        }

        else if (object.type === 'quiz') {
            showQuestion(object);
        }

        else if (object.type === 'hazard') {
            takeDamage();
        }

        else if (object.type === 'goal') {
            if (completeTargets()) {
                finishMission();
            } else {
                showMessage('Selesaikan semua target dahulu!');
            }
        }
    }

    /* PERTANYAAN OTOMATIS */

    function showQuestion(object) {
        state.paused = true;
        currentQuestion = object;

        $('questionTitle').textContent =
            object.label || 'Ayo Menjawab!';

        $('questionText').textContent =
            object.question;

        $('questionFeedback').textContent = '';
        $('btnQuestionNext').hidden = true;

        const answers = $('answerList');
        answers.innerHTML = '';

        object.answers.forEach((answer,index) => {
            const button = document.createElement('button');
            button.className = 'bangau-answer';
            button.textContent = answer;

            button.addEventListener('click',() => {
                answerQuestion(index,button);
            });

            answers.appendChild(button);
        });

        playSound('click');
        openModal('questionModal');
    }

    function answerQuestion(index,button) {
        if (!currentQuestion) return;

        const feedback = $('questionFeedback');

        if (index !== currentQuestion.correct) {
            feedback.textContent =
                'Belum tepat. Ayo coba lagi!';
            feedback.style.color = '#c84c66';
            playSound('wrong');
            return;
        }

        document.querySelectorAll('.bangau-answer')
            .forEach(item => item.disabled = true);

        button.classList.add('correct');

        feedback.textContent =
            currentQuestion.explanation;

        feedback.style.color = '#287d50';

        $('btnQuestionNext').hidden = false;

        state.done.add(currentQuestion.id);
        addProgress('quiz',20);
        playSound('correct');
    }

    /* NYAWA */

    function takeDamage() {
        if (performance.now() < state.invincibleUntil) {
            return;
        }

        state.lives--;
        state.invincibleUntil =
            performance.now() + 1600;

        playSound('hurt');
        updateHUD();

        state.x = Math.max(7,state.x-8);
        state.y = GROUND_Y;
        state.vy = 0;
        state.grounded = true;
        state.platform = null;

        $('player').classList.add('hurt');

        setTimeout(() => {
            $('player').classList.remove('hurt');
        },1600);

        updatePlayer();

        if (state.lives <= 0) {
            state.playing = false;

            $('gameOverScore').textContent =
                state.score-state.missionStartScore;

            playSound('over');
            openModal('gameOverModal');
        }
    }

    /* MISI BERHASIL */

    function finishMission() {
        state.playing = false;

        const mission = missions[state.mission];

        $('successTitle').textContent =
            `Misi ${state.mission+1} Berhasil!`;

        $('successDescription').textContent =
            `Hebat! Kamu telah menyelesaikan ${mission.name}.`;

        $('successScore').textContent =
            state.score-state.missionStartScore;

        $('successLives').textContent = state.lives;
        $('successFact').textContent = mission.fact;

        $('btnNextMission').textContent =
            state.mission === 2
                ? 'Lihat Kemenangan Akhir'
                : 'Lanjutkan Petualangan';

        if (state.mission < 2) {
            saveProgress(state.mission+1,false);
        } else {
            saveProgress(2,true);
        }

        playSound('win');
        openModal('successModal');
    }

    /* GERAKAN DAN FISIKA */

    function jump() {
        if (!state.playing ||
            state.paused ||
            !state.grounded) return;

        state.vy = -1.35;
        state.grounded = false;
        state.platform = null;

        playSound('jump');
    }

    function updatePhysics(dt) {
        const oldY = state.y;

        if (keys.left) {
            state.x -= .38*dt;
            $('player').classList.add('left');
        }

        if (keys.right) {
            state.x += .38*dt;
            $('player').classList.remove('left');
        }

        state.x = Math.max(4,Math.min(96,state.x));

        $('player').classList.toggle(
            'walk',
            (keys.left || keys.right) && state.grounded
        );

        if (state.grounded && state.platform) {
            const p = state.platform;

            if (state.x < p.x || state.x > p.x+p.w) {
                state.grounded = false;
                state.platform = null;
            } else {
                state.y = p.y;
            }
        }

        if (!state.grounded) {
            state.vy += .075*dt;
            state.y += state.vy*dt;

            if (state.vy >= 0) {
                for (const p of platforms[state.mission]) {
                    const withinX =
                        state.x >= p.x &&
                        state.x <= p.x+p.w;

                    const crossed =
                        oldY <= p.y &&
                        state.y >= p.y;

                    if (withinX && crossed) {
                        state.y = p.y;
                        state.vy = 0;
                        state.grounded = true;
                        state.platform = p;
                        break;
                    }
                }
            }

            if (state.y >= GROUND_Y) {
                state.y = GROUND_Y;
                state.vy = 0;
                state.grounded = true;
                state.platform = null;
            }
        }

        updatePlayer();
    }

    /* COLLISION */

    function checkCollisions() {
        document.querySelectorAll('.bangau-object.near')
            .forEach(element => {
                element.classList.remove('near');
            });

        for (const object of missions[state.mission].objects) {
            if (state.done.has(object.id)) continue;

            const dx = Math.abs(state.x-object.x);
            const dy = Math.abs(state.y-object.y);

            const element = document.querySelector(
                `.bangau-object[data-id="${object.id}"]`
            );

            if (dx < 7 && dy < 15) {
                element?.classList.add('near');
            }

            // Collision berbasis koordinat dunia game.
            if (dx < 4 && dy < 9) {
                interact(object);

                if (!state.playing || state.paused) {
                    break;
                }
            }
        }
    }

    /* GAME LOOP */

    function gameLoop(timestamp) {
        const dt = Math.min(
            (timestamp-(lastFrame || timestamp))/16.67,
            2
        );

        lastFrame = timestamp;

        if (state.playing && !state.paused) {
            updatePhysics(dt);
            checkCollisions();
        }

        requestAnimationFrame(gameLoop);
    }

    /* TOMBOL HALAMAN AWAL */

    $('btnStart').addEventListener('click',() => {
        if (getSaved() &&
            !confirm('Mulai petualangan baru dari Misi 1?')) {
            return;
        }

        state.mission = 0;
        state.score = 0;
        showTutorial(0);
    });

    $('btnContinue').addEventListener('click',() => {
        const saved = getSaved();
        if (!saved || saved.complete) return;

        state.mission = saved.mission;
        state.score = saved.score;

        showTutorial(state.mission);
    });

    $('btnTutorialPlay').addEventListener('click',startMission);

    /* TOMBOL PERTANYAAN */

    $('btnQuestionNext').addEventListener('click',() => {
        currentQuestion = null;

        closeModal('questionModal');
        renderWorld();

        state.paused = false;
        $('gameWorld').focus();
    });

    /* TOMBOL MISI */

    $('btnNextMission').addEventListener('click',() => {
        closeModal('successModal');

        if (state.mission < 2) {
            state.mission++;
            showTutorial(state.mission);
        } else {
            $('finalScore').textContent = state.score;
            showScreen('screenFinish');
        }
    });

    $('btnRetry').addEventListener('click',() => {
        state.score = state.missionStartScore;
        startMission();
    });

    $('btnRestart').addEventListener('click',() => {
        state.mission = 0;
        state.score = 0;
        showTutorial(0);
    });

    /* JEDA */

    $('btnPause').addEventListener('click',() => {
        if (!state.playing) return;

        state.paused = true;
        openModal('pauseModal');
    });

    $('btnResume').addEventListener('click',() => {
        closeModal('pauseModal');
        state.paused = false;
        $('gameWorld').focus();
    });


    /* KEYBOARD */

    window.addEventListener('keydown',event => {
        if (!state.playing || state.paused) return;

        const key = event.key.toLowerCase();

        if (['arrowleft','arrowright','arrowup',' ']
            .includes(key)) {
            event.preventDefault();
        }

        if (key === 'a' || key === 'arrowleft') {
            keys.left = true;
        }

        if (key === 'd' || key === 'arrowright') {
            keys.right = true;
        }

        if (['w','arrowup',' '].includes(key) &&
            !event.repeat) {
            jump();
        }
    });

    window.addEventListener('keyup',event => {
        const key = event.key.toLowerCase();

        if (key === 'a' || key === 'arrowleft') {
            keys.left = false;
        }

        if (key === 'd' || key === 'arrowright') {
            keys.right = false;
        }
    });

    /* TOMBOL LAYAR */

    function bindMove(id,direction) {
        const button = $(id);

        button.addEventListener('pointerdown',event => {
            event.preventDefault();

            button.setPointerCapture(event.pointerId);
            keys[direction] = true;
        });

        const stop = () => {
            keys[direction] = false;
        };

        button.addEventListener('pointerup',stop);
        button.addEventListener('pointercancel',stop);
        button.addEventListener('lostpointercapture',stop);
    }

    bindMove('btnLeft','left');
    bindMove('btnRight','right');

    $('btnJump').addEventListener('pointerdown',event => {
        event.preventDefault();
        jump();
    });

    window.addEventListener('blur',() => {
        keys.left = false;
        keys.right = false;

        if (state.playing && !state.paused) {
            state.paused = true;
            openModal('pauseModal');
        }
    });

    /* INISIALISASI */

    updateContinue();
    requestAnimationFrame(gameLoop);

})();