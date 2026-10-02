document.addEventListener('DOMContentLoaded', function () {

    const board = document.getElementById('matchingBoard');

    if (!board) {
        return;
    }


    /* =========================================
       ELEMENT
    ========================================= */

    const svg = document.getElementById('connectionLayer');

    const leftCards = Array.from(
        document.querySelectorAll('.left-card')
    );

    const rightCards = Array.from(
        document.querySelectorAll('.right-card')
    );

    const leftPoints = Array.from(
        document.querySelectorAll('.point-left')
    );

    const feedbackArea =
        document.getElementById('feedbackArea');

    const feedbackIcon =
        document.getElementById('feedbackIcon');

    const feedbackTitle =
        document.getElementById('feedbackTitle');

    const feedbackText =
        document.getElementById('feedbackText');

    const progressText =
        document.getElementById('progressText');

    const progressBar =
        document.getElementById('progressBar');

    const btnReset =
        document.getElementById('btnReset');

    const btnResult =
        document.getElementById('btnResult');

    const resultSection =
        document.getElementById('resultSection');

    const explanationList =
        document.getElementById('explanationList');

    const btnPlayAgain =
        document.getElementById('btnPlayAgain');


    /* =========================================
       STATE
    ========================================= */

    const total = Number(board.dataset.total);

    let completed = 0;

    let dragging = false;

    let activeLeftCard = null;

    let activePoint = null;

    let temporaryLine = null;

    const connections = [];


    /* =========================================
       SVG
    ========================================= */

    function createSvgLine(className) {

        const line = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'line'
        );

        line.setAttribute(
            'class',
            className
        );

        svg.appendChild(line);

        return line;
    }


    /* =========================================
       POSISI RELATIF TERHADAP BOARD
    ========================================= */

    function getBoardPosition(element) {

        const boardRect =
            board.getBoundingClientRect();

        const rect =
            element.getBoundingClientRect();

        return {
            x:
                rect.left -
                boardRect.left +
                rect.width / 2,

            y:
                rect.top -
                boardRect.top +
                rect.height / 2
        };
    }


    function getPointerPosition(event) {

        const boardRect =
            board.getBoundingClientRect();

        return {
            x:
                event.clientX -
                boardRect.left,

            y:
                event.clientY -
                boardRect.top
        };
    }


    /* =========================================
       SET GARIS
    ========================================= */

    function setLinePosition(
        line,
        startX,
        startY,
        endX,
        endY
    ) {

        line.setAttribute(
            'x1',
            startX
        );

        line.setAttribute(
            'y1',
            startY
        );

        line.setAttribute(
            'x2',
            endX
        );

        line.setAttribute(
            'y2',
            endY
        );
    }


    /* =========================================
       FEEDBACK
    ========================================= */

    function showFeedback(
        type,
        title,
        message
    ) {

        feedbackArea.classList.remove(
            'correct',
            'incorrect'
        );

        if (type === 'correct') {

            feedbackArea.classList.add(
                'correct'
            );

            feedbackIcon.textContent = '✓';

        } else if (type === 'incorrect') {

            feedbackArea.classList.add(
                'incorrect'
            );

            feedbackIcon.textContent = '!';

        } else {

            feedbackIcon.textContent = '?';

        }

        feedbackTitle.textContent = title;

        feedbackText.textContent = message;
    }


    /* =========================================
       PROGRESS
    ========================================= */

    function updateProgress() {

        progressText.textContent =
            `${completed} / ${total}`;

        const percentage =
            total > 0
                ? (completed / total) * 100
                : 0;

        progressBar.style.width =
            `${percentage}%`;

        btnResult.disabled =
            completed !== total;
    }


    /* =========================================
       CARI TARGET DI POSISI POINTER
    ========================================= */

    function findRightPointAtPosition(
        clientX,
        clientY
    ) {

        const elements =
            document.elementsFromPoint(
                clientX,
                clientY
            );

        for (const element of elements) {

            if (
                element.classList &&
                element.classList.contains(
                    'point-right'
                )
            ) {
                return element;
            }

            if (
                element.classList &&
                element.classList.contains(
                    'right-card'
                )
            ) {
                return element.querySelector(
                    '.point-right'
                );
            }
        }

        return null;
    }


    /* =========================================
       MULAI TARIK GARIS
    ========================================= */

    function startConnection(event) {

        const point = event.currentTarget;

        const card =
            point.closest('.left-card');

        if (
            card.classList.contains('completed')
        ) {
            return;
        }

        event.preventDefault();

        dragging = true;

        activeLeftCard = card;

        activePoint = point;

        activePoint.classList.add('active');

        const start =
            getBoardPosition(activePoint);

        temporaryLine =
            createSvgLine(
                'connection-line temp-line'
            );

        setLinePosition(
            temporaryLine,
            start.x,
            start.y,
            start.x,
            start.y
        );

        point.setPointerCapture(
            event.pointerId
        );
    }


    /* =========================================
       GARIS MENGIKUTI POINTER
    ========================================= */

    function moveConnection(event) {

        if (
            !dragging ||
            !temporaryLine ||
            !activePoint
        ) {
            return;
        }

        event.preventDefault();

        const start =
            getBoardPosition(activePoint);

        const pointer =
            getPointerPosition(event);

        setLinePosition(
            temporaryLine,
            start.x,
            start.y,
            pointer.x,
            pointer.y
        );
    }


    /* =========================================
       SELESAI TARIK
    ========================================= */

    function endConnection(event) {

        if (!dragging) {
            return;
        }

        const rightPoint =
            findRightPointAtPosition(
                event.clientX,
                event.clientY
            );

        if (temporaryLine) {
            temporaryLine.remove();
        }

        temporaryLine = null;

        if (activePoint) {
            activePoint.classList.remove(
                'active'
            );
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


        const rightCard =
            rightPoint.closest('.right-card');

        if (
            rightCard.classList.contains(
                'completed'
            )
        ) {

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


    /* =========================================
       PERIKSA JAWABAN
    ========================================= */

    function checkConnection(
        leftCard,
        leftPoint,
        rightCard,
        rightPoint
    ) {

        const correctTarget =
            leftCard.dataset.target;

        const selectedTarget =
            rightCard.dataset.name;


        if (
            correctTarget === selectedTarget
        ) {

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

            rightCard.classList.remove(
                'wrong'
            );

        }, 550);
    }


    /* =========================================
       PASANGAN BENAR
    ========================================= */

    function connectCorrectPair(
        leftCard,
        leftPoint,
        rightCard,
        rightPoint
    ) {

        const line =
            createSvgLine(
                'connection-line'
            );

        const start =
            getBoardPosition(leftPoint);

        const end =
            getBoardPosition(rightPoint);

        setLinePosition(
            line,
            start.x,
            start.y,
            end.x,
            end.y
        );


        leftCard.classList.add(
            'completed'
        );

        rightCard.classList.add(
            'completed'
        );

        leftPoint.classList.add(
            'completed'
        );

        rightPoint.classList.add(
            'completed'
        );


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


    /* =========================================
       UPDATE POSISI GARIS SAAT RESIZE
    ========================================= */

    function redrawConnections() {

        connections.forEach(
            function (connection) {

                const start =
                    getBoardPosition(
                        connection.leftPoint
                    );

                const end =
                    getBoardPosition(
                        connection.rightPoint
                    );

                setLinePosition(
                    connection.line,
                    start.x,
                    start.y,
                    end.x,
                    end.y
                );
            }
        );
    }


    /* =========================================
       RESET
    ========================================= */

    function resetGame() {

        completed = 0;

        dragging = false;

        activeLeftCard = null;

        activePoint = null;


        if (temporaryLine) {

            temporaryLine.remove();

            temporaryLine = null;
        }


        connections.forEach(
            function (connection) {

                connection.line.remove();

            }
        );

        connections.length = 0;


        leftCards.forEach(
            function (card) {

                card.classList.remove(
                    'completed',
                    'wrong'
                );

                const point =
                    card.querySelector(
                        '.point-left'
                    );

                point.disabled = false;

                point.classList.remove(
                    'completed',
                    'active'
                );
            }
        );


        rightCards.forEach(
            function (card) {

                card.classList.remove(
                    'completed',
                    'wrong'
                );

                const point =
                    card.querySelector(
                        '.point-right'
                    );

                point.disabled = false;

                point.classList.remove(
                    'completed',
                    'active'
                );
            }
        );


        resultSection.classList.remove(
            'show'
        );

        explanationList.replaceChildren();


        showFeedback(
            'neutral',
            'Ayo mulai!',
            'Tarik garis dari salah satu titik di sebelah kiri menuju pasangan yang sesuai di sebelah kanan.'
        );


        updateProgress();


        board.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }


    /* =========================================
       HASIL
    ========================================= */

    function showResult() {

        if (completed !== total) {
            return;
        }


        explanationList.replaceChildren();


        leftCards.forEach(
            function (card) {

                const item =
                    document.createElement(
                        'div'
                    );

                item.className =
                    'explanation-item';


                const title =
                    document.createElement(
                        'strong'
                    );

                title.textContent =
                    `${card.dataset.name} → ${card.dataset.target}`;


                const description =
                    document.createElement(
                        'p'
                    );

                description.textContent =
                    card.dataset.description;


                item.appendChild(title);

                item.appendChild(
                    description
                );

                explanationList.appendChild(
                    item
                );
            }
        );


        resultSection.classList.add(
            'show'
        );


        resultSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }


    /* =========================================
       EVENT POINTER
       Mouse + Touch + Pen
    ========================================= */

    leftPoints.forEach(
        function (point) {

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
                        activePoint.classList.remove(
                            'active'
                        );
                    }

                    clearDragging();
                }
            );
        }
    );


    /* =========================================
       BUTTON
    ========================================= */

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


    /* =========================================
       RESIZE
    ========================================= */

    window.addEventListener(
        'resize',
        function () {

            window.requestAnimationFrame(
                redrawConnections
            );
        }
    );


    /* =========================================
       START
    ========================================= */

    updateProgress();

});