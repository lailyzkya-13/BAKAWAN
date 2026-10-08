
document.addEventListener('DOMContentLoaded', function () {

    // =========================================
    // ELEMENT
    // =========================================

    const board = document.getElementById('matchingBoard');

    if (!board) {
        return;
    }

    const svg = document.getElementById('connectionLayer');

    const leftCards = Array.from(
        board.querySelectorAll('.left-card')
    );

    const rightCards = Array.from(
        board.querySelectorAll('.right-card')
    );

    const leftPoints = Array.from(
        board.querySelectorAll('.point-left')
    );

    const feedbackArea = document.getElementById('feedbackArea');
    const feedbackIcon = document.getElementById('feedbackIcon');
    const feedbackTitle = document.getElementById('feedbackTitle');
    const feedbackText = document.getElementById('feedbackText');

    const progressText = document.getElementById('progressText');
    const progressBar = document.getElementById('progressBar');

    const btnReset = document.getElementById('btnReset');
    const btnResult = document.getElementById('btnResult');
    const btnPlayAgain = document.getElementById('btnPlayAgain');

    const resultSection = document.getElementById('resultSection');
    const explanationList = document.getElementById('explanationList');

    const leftList = board.querySelector(
        '.column-left .object-list'
    );

    const rightList = board.querySelector(
        '.column-right .object-list'
    );

    // =========================================
    // STATE
    // =========================================

    const total = leftCards.length;

    let completed = 0;
    let dragging = false;
    let activeLeftCard = null;
    let activePoint = null;
    let temporaryLine = null;

    const connections = [];

    // =========================================
    // FITUR BARU: ACAK POSISI OBJEK
    // =========================================

    function shuffleArray(items) {
        const result = [...items];

        for (let i = result.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));

            [result[i], result[j]] = [
                result[j],
                result[i]
            ];
        }

        return result;
    }

    function getCurrentOrder(container, selector) {
        return Array.from(
            container.querySelectorAll(selector)
        );
    }

    function isSameOrder(first, second) {
        return first.length === second.length &&
            first.every((item, index) => {
                return item === second[index];
            });
    }

    function shuffleColumn(container, selector) {
        if (!container) {
            return;
        }

        const previousOrder = getCurrentOrder(
            container,
            selector
        );

        if (previousOrder.length <= 1) {
            return;
        }

        let newOrder = shuffleArray(previousOrder);
        let attempts = 0;

        // Usahakan susunan tidak sama dengan sebelumnya.
        while (
            isSameOrder(previousOrder, newOrder) &&
            attempts < 10
        ) {
            newOrder = shuffleArray(previousOrder);
            attempts++;
        }

        // Jika masih sama, geser satu posisi.
        if (isSameOrder(previousOrder, newOrder)) {
            newOrder.push(newOrder.shift());
        }

        newOrder.forEach(function (card) {
            container.appendChild(card);
        });
    }

    function shuffleGame() {
        shuffleColumn(leftList, '.left-card');
        shuffleColumn(rightList, '.right-card');
    }

    // =========================================
    // SVG
    // =========================================

    function createSvgLine(className) {
        const line = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'line'
        );

        line.setAttribute('class', className);
        svg.appendChild(line);

        return line;
    }

    // =========================================
    // POSISI RELATIF TERHADAP BOARD
    // =========================================

    function getBoardPosition(element) {
        const boardRect = board.getBoundingClientRect();
        const rect = element.getBoundingClientRect();

        return {
            x: rect.left - boardRect.left + rect.width / 2,
            y: rect.top - boardRect.top + rect.height / 2
        };
    }

    function getPointerPosition(event) {
        const boardRect = board.getBoundingClientRect();

        return {
            x: event.clientX - boardRect.left,
            y: event.clientY - boardRect.top
        };
    }

    // =========================================
    // SET POSISI GARIS
    // =========================================

    function setLinePosition(
        line,
        startX,
        startY,
        endX,
        endY
    ) {
        line.setAttribute('x1', startX);
        line.setAttribute('y1', startY);
        line.setAttribute('x2', endX);
        line.setAttribute('y2', endY);
    }

    // =========================================
    // FEEDBACK
    // =========================================

    function showFeedback(type, title, message) {
        feedbackArea.classList.remove(
            'correct',
            'incorrect'
        );

        if (type === 'correct') {
            feedbackArea.classList.add('correct');
            feedbackIcon.textContent = '✓';

        } else if (type === 'incorrect') {
            feedbackArea.classList.add('incorrect');
            feedbackIcon.textContent = '!';

        } else {
            feedbackIcon.textContent = '?';
        }

        feedbackTitle.textContent = title;
        feedbackText.textContent = message;
    }

    // =========================================
    // PROGRESS
    // =========================================

    function updateProgress() {
        progressText.textContent = `${completed} / ${total}`;

        const percentage = total > 0
            ? (completed / total) * 100
            : 0;

        progressBar.style.width = `${percentage}%`;

        btnResult.disabled = (
            total === 0 ||
            completed !== total
        );
    }

    // =========================================
    // CARI TITIK KANAN
    // =========================================

    function findRightPointAtPosition(clientX, clientY) {
        const elements = document.elementsFromPoint(
            clientX,
            clientY
        );

        for (const element of elements) {

            if (
                element.classList &&
                element.classList.contains('point-right')
            ) {
                return element;
            }

            if (
                element.classList &&
                element.classList.contains('right-card')
            ) {
                return element.querySelector('.point-right');
            }

            const rightCard = element.closest
                ? element.closest('.right-card')
                : null;

            if (rightCard) {
                return rightCard.querySelector('.point-right');
            }
        }

        return null;
    }

    // =========================================
    // MULAI TARIK GARIS
    // =========================================

    function startConnection(event) {
        const point = event.currentTarget;
        const card = point.closest('.left-card');

        if (
            card.classList.contains('completed') ||
            point.disabled
        ) {
            return;
        }

        event.preventDefault();

        dragging = true;
        activeLeftCard = card;
        activePoint = point;

        activePoint.classList.add('active');

        const start = getBoardPosition(activePoint);

        temporaryLine = createSvgLine(
            'connection-line temp-line'
        );

        setLinePosition(
            temporaryLine,
            start.x,
            start.y,
            start.x,
            start.y
        );

        point.setPointerCapture(event.pointerId);
    }

    // =========================================
    // GARIS MENGIKUTI POINTER
    // =========================================

    function moveConnection(event) {
        if (
            !dragging ||
            !temporaryLine ||
            !activePoint
        ) {
            return;
        }

        event.preventDefault();

        const start = getBoardPosition(activePoint);
        const pointer = getPointerPosition(event);

        setLinePosition(
            temporaryLine,
            start.x,
            start.y,
            pointer.x,
            pointer.y
        );
    }

    // =========================================
    // SELESAI TARIK GARIS
    // =========================================

    function endConnection(event) {
        if (!dragging) {
            return;
        }

        const rightPoint = findRightPointAtPosition(
            event.clientX,
            event.clientY
        );

        if (temporaryLine) {
            temporaryLine.remove();
        }

        temporaryLine = null;

        if (activePoint) {
            activePoint.classList.remove('active');
        }

        if (!rightPoint) {
            showFeedback(
                'incorrect',
                'Belum mengenai pasangan',
                'Tarik garis sampai ke titik pada salah satu pasangan di sebelah kanan.'
            );

            clearDragging();
            return;
        }

        const rightCard = rightPoint.closest('.right-card');

        if (rightCard.classList.contains('completed')) {
            showFeedback(
                'incorrect',
                'Pasangan sudah digunakan',
                'Pilih pasangan lain yang belum terhubung.'
            );

            clearDragging();
            return;
        }

        checkConnection(
            activeLeftCard,
            activePoint,
            rightCard,
            rightPoint
        );

        clearDragging();
    }

    function clearDragging() {
        dragging = false;
        activeLeftCard = null;
        activePoint = null;
        temporaryLine = null;
    }

    // =========================================
    // PERIKSA JAWABAN
    // =========================================

    function checkConnection(
        leftCard,
        leftPoint,
        rightCard,
        rightPoint
    ) {
        const correctTarget = leftCard.dataset.target;
        const selectedTarget = rightCard.dataset.name;

        if (correctTarget === selectedTarget) {
            connectCorrectPair(
                leftCard,
                leftPoint,
                rightCard,
                rightPoint
            );

            return;
        }

        rightCard.classList.add('wrong');

        showFeedback(
            'incorrect',
            'Belum tepat, coba lagi!',
            `Clue untuk ${leftCard.dataset.name}: ${leftCard.dataset.clue}`
        );

        setTimeout(function () {
            rightCard.classList.remove('wrong');
        }, 550);
    }

    // =========================================
    // PASANGAN BENAR
    // =========================================

    function connectCorrectPair(
        leftCard,
        leftPoint,
        rightCard,
        rightPoint
    ) {
        const line = createSvgLine('connection-line');

        const start = getBoardPosition(leftPoint);
        const end = getBoardPosition(rightPoint);

        setLinePosition(
            line,
            start.x,
            start.y,
            end.x,
            end.y
        );

        leftCard.classList.add('completed');
        rightCard.classList.add('completed');

        leftPoint.classList.add('completed');
        rightPoint.classList.add('completed');

        leftPoint.disabled = true;
        rightPoint.disabled = true;

        connections.push({
            leftCard: leftCard,
            leftPoint: leftPoint,
            rightCard: rightCard,
            rightPoint: rightPoint,
            line: line
        });

        completed++;

        showFeedback(
            'correct',
            'Benar!',
            `${leftCard.dataset.name} dan ${rightCard.dataset.name} memiliki hubungan. ${leftCard.dataset.description}`
        );

        updateProgress();
    }

    // =========================================
    // UPDATE GARIS SAAT UKURAN LAYAR BERUBAH
    // =========================================

    function redrawConnections() {
        connections.forEach(function (connection) {
            const start = getBoardPosition(
                connection.leftPoint
            );

            const end = getBoardPosition(
                connection.rightPoint
            );

            setLinePosition(
                connection.line,
                start.x,
                start.y,
                end.x,
                end.y
            );
        });
    }

    // =========================================
    // RESET + ACAK POSISI
    // =========================================

    function resetGame() {
        completed = 0;

        if (temporaryLine) {
            temporaryLine.remove();
            temporaryLine = null;
        }

        if (
            activePoint &&
            activePoint.hasPointerCapture &&
            activePoint.hasPointerCapture(
                activePoint._pointerId || -1
            )
        ) {
            // Pointer akan dilepaskan secara otomatis
            // setelah interaksi selesai.
        }

        if (activePoint) {
            activePoint.classList.remove('active');
        }

        clearDragging();

        // Hapus seluruh garis yang sudah dibuat.
        connections.forEach(function (connection) {
            connection.line.remove();
        });

        connections.length = 0;

        // Reset kartu kiri.
        leftCards.forEach(function (card) {
            card.classList.remove(
                'completed',
                'wrong'
            );

            const point = card.querySelector('.point-left');

            point.disabled = false;
            point.classList.remove(
                'completed',
                'active'
            );
        });

        // Reset kartu kanan.
        rightCards.forEach(function (card) {
            card.classList.remove(
                'completed',
                'wrong'
            );

            const point = card.querySelector('.point-right');

            point.disabled = false;
            point.classList.remove(
                'completed',
                'active'
            );
        });

        // =====================================
        // FITUR BARU: ACAK KEDUA KOLOM
        // =====================================

        shuffleGame();

        // Reset hasil.
        resultSection.classList.remove('show');
        explanationList.replaceChildren();

        showFeedback(
            'neutral',
            'Ayo mulai!',
            'Posisi objek sudah diacak. Tarik garis dari objek di sebelah kiri menuju pasangan yang sesuai di sebelah kanan.'
        );

        updateProgress();

        board.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    // =========================================
    // HASIL PERMAINAN
    // =========================================

    function showResult() {
        if (completed !== total || total === 0) {
            return;
        }

        explanationList.replaceChildren();

        leftCards.forEach(function (card) {
            const item = document.createElement('div');
            item.className = 'explanation-item';

            const title = document.createElement('strong');

            title.textContent =
                `${card.dataset.name} → ${card.dataset.target}`;

            const description = document.createElement('p');
            description.textContent =
                card.dataset.description;

            item.appendChild(title);
            item.appendChild(description);

            explanationList.appendChild(item);
        });

        resultSection.classList.add('show');

        resultSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    // =========================================
    // EVENT POINTER
    // MOUSE + TOUCH + PEN
    // =========================================

    leftPoints.forEach(function (point) {

        point.addEventListener(
            'pointerdown',
            startConnection
        );

        point.addEventListener(
            'pointermove',
            moveConnection
        );

        point.addEventListener(
            'pointerup',
            endConnection
        );

        point.addEventListener(
            'pointercancel',
            function () {

                if (temporaryLine) {
                    temporaryLine.remove();
                }

                if (activePoint) {
                    activePoint.classList.remove('active');
                }

                clearDragging();
            }
        );
    });

    // =========================================
    // BUTTON
    // =========================================

    btnReset.addEventListener(
        'click',
        resetGame
    );

    btnResult.addEventListener(
        'click',
        showResult
    );

    btnPlayAgain.addEventListener(
        'click',
        resetGame
    );

    // =========================================
    // RESIZE
    // =========================================

    window.addEventListener('resize', function () {
        window.requestAnimationFrame(
            redrawConnections
        );
    });

    // =========================================
    // START
    // =========================================

    // Acak ketika halaman pertama kali dibuka.
    shuffleGame();

    updateProgress();

});