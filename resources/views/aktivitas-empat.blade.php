<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasar Lahan Basah | BAKAWAN</title>

    <!-- FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS HEADER BAKAWAN -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">


    <style>
        /* =====================================
           1. WARNA BAKAWAN
        ===================================== */

        .icon-mini {
            font-size: 22px;
            color: #63836D;
            margin-right: 6px;
        }

        .icon-pink {
            color: #D98DA8;
        }

        .icon-green {
            color: #63836D;
        }

        .photo-mini {
            width: 46px;
            height: 46px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #f3e4ea;
            background: #fff;
            padding: 2px;
        }

        .photo-small {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #f3e4ea;
            background: #fff;
            padding: 2px;
        }

        .hero-decoration {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .hero-decoration img,
        .hero-decoration i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .section-title-icon {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        :root {
            --pink: #D98DA8;
            --pink-light: #FBEAF0;
            --green: #63836D;
            --green-light: #EAF3EA;
            --cream: #FFF9F2;
            --peach: #F8E9DE;
            --lavender: #F0EAF7;
            --text: #31534A;
            --muted: #78877F;
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        button {
            font-family: 'Poppins', sans-serif;
        }

        .game-wrapper {
            max-width: 1050px;
            margin: auto;
            padding: 30px 20px 60px;
        }

        .hidden {
            display: none !important;
        }

        /* =====================================
           2. HERO
        ===================================== */

        .game-hero {
            background: linear-gradient(120deg,
                    #EAF3EA,
                    #FBEAF0,
                    #F8E9DE);

            border-radius: 28px;
            padding: 35px 20px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .hero-label {
            display: inline-block;
            background: white;
            color: var(--pink);
            padding: 7px 17px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .game-hero h1 {
            font-size: 30px;
            font-weight: 800;
            margin: 14px 0 8px;
            color: var(--text);
        }

        .game-hero p {
            font-size: 13px;
            line-height: 1.8;
            color: var(--muted);
            margin: 0;
        }

        .hero-decoration {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 18px;
            margin-top: 18px;
        }

        .hero-decoration img {
            width: 65px;
            height: 65px;
            object-fit: contain;
            border-radius: 12px;
            background: white;
            padding: 5px;
        }

        /* =====================================
           3. STATUS PERMAINAN
        ===================================== */

        .game-status {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .status-box {
            background: white;
            border: 1px solid #eee8df;
            border-radius: 15px;
            padding: 13px;
            text-align: center;
        }

        .status-icon {
            display: block;
            font-size: 24px;
            margin: 0 auto 6px;
            color: var(--green);
        }

        .status-box small {
            display: block;
            color: var(--muted);
            font-size: 10px;
        }

        .status-box strong {
            display: block;
            font-size: 13px;
            color: var(--green);
            margin-top: 4px;
        }

        /* =====================================
           4. PROGRESS
        ===================================== */

        .progress-card {
            background: white;
            border: 1px solid #eee8df;
            border-radius: 17px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .progress-title {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 13px;
        }

        .progress-list {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 5px;
        }

        .progress-item {
            text-align: center;
            color: #b8beb9;
        }

        .progress-number {
            width: 30px;
            height: 30px;
            margin: auto auto 6px;
            background: #f1f2ef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }

        .progress-item small {
            font-size: 9px;
            display: block;
        }

        .progress-item.active {
            color: var(--pink);
        }

        .progress-item.active .progress-number {
            background: var(--pink-light);
            border: 2px solid var(--pink);
        }

        .progress-item.done {
            color: var(--green);
        }

        .progress-item.done .progress-number {
            background: var(--green-light);
        }

        /* =====================================
           5. KOTAK GAME
        ===================================== */

        .game-card {
            background: white;
            border: 1px solid #eee8df;
            border-radius: 23px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(49, 83, 74, 0.04);
            min-height: 430px;
        }

        .stage-label {
            display: inline-block;
            background: var(--pink-light);
            color: var(--pink);
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .stage-title {
            font-size: 21px;
            font-weight: 800;
            margin: 0 0 8px;
        }

        .stage-description {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        /* =====================================
           6. TOMBOL UMUM
        ===================================== */

        .game-button {
            border: none;
            border-radius: 12px;
            background: var(--green);
            color: white;
            padding: 13px 20px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .game-button:hover:not(:disabled) {
            transform: translateY(-2px);
            background: #4f7059;
        }

        .game-button.pink {
            background: var(--pink);
        }

        .game-button.pink:hover:not(:disabled) {
            background: #C47795;
        }

        .game-button:disabled {
            background: #e9eae5;
            color: #a0a59e;
            cursor: not-allowed;
        }

        .button-center {
            text-align: center;
            margin-top: 22px;
        }

        /* =====================================
           7. PILIHAN PRODUK
        ===================================== */

        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 17px;
        }

        .product-option {
            background: var(--cream);
            border: 2px solid #eee8df;
            border-radius: 19px;
            padding: 23px 15px;
            cursor: pointer;
            text-align: center;
            color: var(--text);
            transition: 0.2s;
        }

        .product-option:hover {
            border-color: var(--pink);
            transform: translateY(-4px);
        }

        .product-option.selected {
            background: var(--pink-light);
            border-color: var(--pink);
        }


        .product-option strong {
            display: block;
            font-size: 14px;
            margin-bottom: 7px;
        }

        .product-option small {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
        }

        /* =====================================
           8. TEMPAT BAHAN BAKU
        ===================================== */

        .material-scene {
            background: linear-gradient(180deg,
                    #EAF3EA,
                    #F6F5E9);

            border-radius: 20px;
            padding: 23px 15px;
            text-align: center;
        }

        .scene-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .scene-description {
            font-size: 10px;
            color: var(--muted);
            margin-bottom: 18px;
        }

        .material-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }

        .material-item {
            border: 2px solid transparent;
            background: white;
            border-radius: 14px;
            padding: 13px 3px;
            cursor: pointer;
            transition: 0.2s;
        }

        .material-item span {
            display: block;
            font-size: 30px;
        }

        .material-item small {
            display: block;
            font-size: 8px;
            color: var(--muted);
            margin-top: 5px;
        }

        .material-item:hover:not(:disabled) {
            transform: translateY(-4px);
            border-color: var(--pink);
        }

        .material-item.collected {
            background: var(--pink-light);
            border-color: var(--pink);
        }

        .material-item:disabled {
            cursor: default;
            opacity: 0.65;
        }

        .collection-count {
            background: white;
            border-radius: 30px;
            padding: 9px 16px;
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            margin-top: 17px;
        }

        /* =====================================
           9. PEMBUATAN PRODUK
        ===================================== */

        .craft-scene {
            background: var(--cream);
            border-radius: 18px;
            padding: 22px;
            text-align: center;
        }

        .craft-product {
            font-size: 75px;
            margin: 15px 0;
            animation: float 2s infinite ease-in-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        .craft-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .craft-step {
            background: white;
            border: 1px solid #eee8df;
            border-radius: 14px;
            padding: 15px 7px;
            cursor: pointer;
            color: var(--text);
            transition: 0.2s;
        }

        .craft-step span {
            display: block;
            font-size: 30px;
            margin-bottom: 7px;
        }

        .craft-step small {
            display: block;
            font-size: 9px;
            line-height: 1.5;
        }

        .craft-step.active {
            border: 2px solid var(--pink);
            background: var(--pink-light);
        }

        .craft-step.done {
            border: 2px solid var(--green);
            background: var(--green-light);
        }

        .craft-step:disabled {
            cursor: default;
            opacity: 0.65;
        }

        /* =====================================
           10. TOKO DAN HARGA
        ===================================== */

        .shop-scene {
            background: linear-gradient(130deg,
                    var(--pink-light),
                    var(--green-light));

            border-radius: 19px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }


        .shop-scene h3 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .shop-scene p {
            font-size: 10px;
            color: var(--muted);
            margin: 0;
        }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .price-option {
            border: 2px solid #eee8df;
            background: white;
            border-radius: 13px;
            padding: 16px 5px;
            cursor: pointer;
            color: var(--text);
        }

        .price-option strong {
            display: block;
            font-size: 13px;
        }

        .price-option small {
            font-size: 9px;
            color: var(--muted);
        }

        .price-option.selected {
            border-color: var(--pink);
            background: var(--pink-light);
        }

        .packaging-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 17px;
        }

        .packaging-option {
            background: white;
            border: 2px solid #eee8df;
            border-radius: 14px;
            padding: 15px 8px;
            cursor: pointer;
            color: var(--text);
        }

        .packaging-option span {
            display: block;
            font-size: 30px;
            margin-bottom: 5px;
        }

        .packaging-option strong {
            display: block;
            font-size: 11px;
        }

        .packaging-option small {
            display: block;
            color: var(--muted);
            font-size: 9px;
            margin-top: 4px;
        }

        .packaging-option.selected {
            background: var(--green-light);
            border-color: var(--green);
        }

        .money-preview {
            background: var(--cream);
            border-radius: 14px;
            padding: 15px;
            margin-top: 17px;
        }

        .money-preview div {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 11px;
            margin-bottom: 9px;
        }

        .money-preview div:last-child {
            margin-bottom: 0;
        }

        /* =====================================
           11. PELANGGAN
        ===================================== */

        .market-scene {
            background: linear-gradient(130deg,
                    var(--green-light),
                    var(--pink-light));

            padding: 20px;
            border-radius: 18px;
            text-align: center;
            margin-bottom: 18px;
        }

        .market-scene .market-icon {
            font-size: 50px;
        }

        .market-scene h3 {
            font-size: 15px;
            font-weight: 800;
            margin: 7px 0;
        }

        .market-scene p {
            font-size: 10px;
            margin: 0;
            color: var(--muted);
        }

        .customer-card {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--cream);
            border-radius: 16px;
            padding: 17px;
            margin-bottom: 17px;
        }

        .customer-avatar {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--lavender);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 38px;
        }

        .customer-info strong {
            font-size: 13px;
            display: block;
        }

        .customer-info p {
            font-size: 10px;
            line-height: 1.7;
            color: var(--muted);
            margin: 5px 0;
        }

        .customer-order {
            background: white;
            border-radius: 10px;
            padding: 8px;
            font-size: 10px;
            font-weight: 700;
            color: var(--pink);
        }

        .basket-scene {
            background: var(--cream);
            border-radius: 16px;
            padding: 18px;
            text-align: center;
        }

        .basket-icon {
            font-size: 48px;
        }

        .basket-items {
            font-size: 11px;
            font-weight: 700;
            margin: 8px 0;
        }

        .product-add-button {
            border: 2px solid #eee8df;
            background: white;
            border-radius: 15px;
            padding: 15px;
            cursor: pointer;
            width: 100%;
            color: var(--text);
            margin-top: 12px;
        }

        .product-add-button span {
            display: block;
            font-size: 40px;
        }

        .product-add-button strong {
            display: block;
            font-size: 11px;
            margin-top: 6px;
        }

        .money-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 9px;
            margin-top: 15px;
        }

        .money-button {
            background: white;
            border: 1px solid #ddd9d0;
            border-radius: 12px;
            padding: 13px 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            color: var(--green);
        }

        .money-button:hover:not(:disabled) {
            background: var(--green-light);
            border-color: var(--green);
        }

        .money-button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .change-panel {
            background: var(--pink-light);
            padding: 17px;
            border-radius: 15px;
            margin-top: 17px;
        }

        .change-panel h3 {
            font-size: 13px;
            margin: 0 0 10px;
        }

        .change-total {
            font-size: 21px;
            color: var(--pink);
            font-weight: 800;
        }

        .change-progress {
            font-size: 11px;
            margin-top: 7px;
        }

        /* =====================================
           12. MISI LINGKUNGAN
        ===================================== */

        .nature-scene {
            background: linear-gradient(150deg,
                    #DCEFE0,
                    #EFF4E5);

            padding: 20px;
            border-radius: 18px;
            text-align: center;
            margin-bottom: 18px;
        }

        .nature-scene .nature-icons {
            font-size: 45px;
        }

        .nature-scene h3 {
            font-size: 15px;
            font-weight: 800;
            margin: 8px 0;
        }

        .nature-scene p {
            font-size: 10px;
            color: var(--muted);
            margin: 0;
            line-height: 1.7;
        }

        .trash-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .trash-item {
            background: var(--cream);
            border: 2px solid #eee8df;
            border-radius: 14px;
            padding: 15px 5px;
            cursor: pointer;
        }

        .trash-item span {
            display: block;
            font-size: 32px;
        }

        .trash-item small {
            display: block;
            font-size: 9px;
            margin-top: 5px;
        }

        .trash-item.cleaned {
            background: var(--green-light);
            border-color: var(--green);
        }

        .trash-item:disabled {
            cursor: default;
        }

        .eco-choice {
            display: block;
            width: 100%;
            background: white;
            border: 2px solid #eee8df;
            border-radius: 13px;
            padding: 14px;
            margin-bottom: 10px;
            cursor: pointer;
            text-align: left;
            color: var(--text);
            font-size: 11px;
            line-height: 1.7;
        }

        .eco-choice:hover:not(:disabled) {
            border-color: var(--pink);
            background: var(--pink-light);
        }

        .eco-choice.selected {
            border-color: var(--green);
            background: var(--green-light);
        }

        .eco-choice:disabled {
            cursor: default;
        }

        /* =====================================
           13. FEEDBACK
        ===================================== */

        .feedback {
            background: var(--green-light);
            padding: 13px;
            border-radius: 12px;
            margin-top: 15px;
            font-size: 11px;
            line-height: 1.8;
            text-align: center;
        }

        .feedback.warning {
            background: var(--pink-light);
        }

        /* =====================================
           14. HASIL AKHIR
        ===================================== */

        .result-scene {
            text-align: center;
            padding: 20px 10px;
        }

        .trophy {
            font-size: 75px;
            animation: float 2s infinite ease-in-out;
        }

        .result-scene h2 {
            font-size: 24px;
            font-weight: 800;
            margin: 10px 0;
        }

        .result-scene p {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.8;
        }

        .stars-display {
            font-size: 30px;
            letter-spacing: 3px;
            margin: 18px 0;
        }

        .result-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 11px;
            margin: 20px 0;
        }

        .result-box {
            background: var(--cream);
            padding: 15px;
            border-radius: 13px;
        }

        .result-box span {
            display: block;
            font-size: 24px;
        }

        .result-box small {
            display: block;
            font-size: 9px;
            color: var(--muted);
        }

        .result-box strong {
            display: block;
            font-size: 14px;
            color: var(--green);
            margin-top: 5px;
        }

        /* =====================================
           15. RESPONSIF
        ===================================== */

        @media(max-width: 650px) {

            .game-wrapper {
                padding: 20px 13px 45px;
            }

            .game-hero h1 {
                font-size: 23px;
            }

            .game-card {
                padding: 18px;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .material-grid {
                grid-template-columns: repeat(5, 1fr);
                gap: 4px;
            }

            .material-item {
                padding: 10px 2px;
            }

            .material-item span {
                font-size: 23px;
            }

            .craft-steps {
                gap: 5px;
            }

            .craft-step {
                padding: 12px 4px;
            }

            .craft-step span {
                font-size: 25px;
            }

            .craft-step small {
                font-size: 8px;
            }

            .progress-list {
                gap: 2px;
            }

            .progress-item small {
                font-size: 7px;
            }

            .progress-number {
                width: 26px;
                height: 26px;
            }

            .trash-grid {
                gap: 5px;
            }

            .trash-item {
                padding: 12px 2px;
            }

            .trash-item span {
                font-size: 25px;
            }

            .customer-avatar {
                width: 52px;
                height: 52px;
                font-size: 29px;
            }
        }


        /* FOTO PRODUK */
        .foto-produk {
            width: 135px;
            height: 115px;
            object-fit: contain;
            border-radius: 15px;
            display: block;
            margin: 0 auto 12px;
            background: #fffaf4;
            padding: 6px;
        }

        /* FOTO LINGKUNGAN */
        .foto-lingkungan {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 16px;
        }


        /* =====================================
           IKON BOOTSTRAP DAN FOTO PRODUK
        ===================================== */

        .section-icon,
        .feedback-icon {
            margin-right: 5px;
            color: var(--green);
        }

        .foto-game {
            display: block;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            margin: 0 auto;
            border-radius: 12px;
        }

        .foto-produk-mini {
            display: inline-block;
            width: 54px;
            height: 54px;
            object-fit: contain;
            vertical-align: middle;
            border-radius: 10px;
            margin-right: 8px;
        }

        .foto-langkah {
            display: block;
            width: 58px;
            height: 58px;
            object-fit: contain;
            margin: 0 auto;
            border-radius: 9px;
        }

        .material-item img {
            display: block;
            width: 52px;
            height: 52px;
            object-fit: contain;
            margin: 0 auto;
        }

        .craft-product .foto-game {
            width: 180px;
            height: 150px;
        }

        .craft-product > i {
            font-size: 70px;
            color: var(--green);
        }

        .craft-step .foto-langkah {
            width: 58px;
            height: 58px;
        }

        .craft-step > span > i {
            font-size: 30px;
            color: var(--green);
        }

        .shop-image img {
            display: block;
            width: 100%;
            max-height: 170px;
            object-fit: cover;
            border-radius: 14px;
            margin: 0 auto 14px;
        }

        .product-add-button .foto-produk-mini {
            width: 64px;
            height: 64px;
            margin: 0 auto;
        }

        .nature-scene .nature-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 22px;
            margin-bottom: 8px;
        }

        .nature-scene .nature-icons i {
            font-size: 42px;
            color: var(--green);
        }

        .stars-display i {
            color: #E0A83B;
            margin: 0 2px;
        }

        .result-box .foto-game {
            width: 64px;
            height: 64px;
            margin-bottom: 5px;
        }

        .progress-number i {
            font-size: 15px;
        }

        .collection-count i {
            color: var(--green);
            margin-right: 5px;
        }

        @media (max-width: 650px) {
            .foto-produk-mini {
                width: 46px;
                height: 46px;
            }

            .foto-langkah {
                width: 46px;
                height: 46px;
            }

            .material-item img {
                width: 42px;
                height: 42px;
            }

            .nature-scene .nature-icons i {
                font-size: 34px;
            }
        }

    </style>
</head>

<body>

    <!-- HEADER BAKAWAN -->
    @include('components.header')


    <main class="game-wrapper">

        <!-- HERO -->
        <section class="game-hero">

            <span class="hero-label">
                AKTIVITAS 4 - KEWIRAUSAHAAN
            </span>

            <h1>
                <i class="bi bi-flower1"></i>
                Petualangan Pasar Lahan Basah
            </h1>

            <p>
                Ayo menjadi pengusaha cilik!
                Buat produk, buka toko, layani pelanggan,
                dan selamatkan lingkungan lahan basah.
            </p>

            <div class="hero-decoration">

                <img src="{{ asset('images/ikan.png') }}" alt="Ikan">

                <img src="{{ asset('images/purun.jpeg') }}" alt="Tanaman Purun">

                <img src="{{ asset('images/tas-purun.png') }}" alt="Tas Anyaman Purun">

                <img src="{{ asset('images/kerupuk-ikan.png') }}" alt="Kerupuk Ikan">

            </div>

        </section>


        <!-- STATUS GAME -->

        <div class="game-status">

            <div class="status-box">
                <i class="bi bi-cash-coin status-icon"></i>
                <small>Uang Penjualan</small>
                <strong id="hudMoney">Rp0</strong>
            </div>

            <div class="status-box">
                <i class="bi bi-star-fill status-icon"></i>
                <small>Bintang</small>
                <strong id="hudStars">0</strong>
            </div>

            <div class="status-box">
                <i class="bi bi-basket status-icon"></i>
                <small>Bahan Baku</small>
                <strong id="hudMaterial">0</strong>
            </div>

        </div>



        <!-- PROGRESS -->
        <div class="progress-card">

            <div class="progress-title">
                <i class="bi bi-map"></i>
                Perjalanan Pengusaha Cilik
            </div>

            <div class="progress-list" id="progressList"></div>

        </div>


        <!-- AREA PERMAINAN -->
        <section class="game-card">

            <div id="stageContent"></div>

        </section>


        <footer style="
            text-align:center;
            padding:22px 10px;
            font-size:10px;
            line-height:1.8;
            color:#78877F;
        ">
            BAKAWAN - Belajar Asyik Kenali Alam dan Warisan Bumi
            <br>
            Belajar berwirausaha sambil menjaga lahan basah <i class="bi bi-leaf-fill" aria-hidden="true"></i>
        </footer>

    </main>


    <!-- =====================================
         JAVASCRIPT PERMAINAN
    ====================================== -->

    <script>

        /* =====================================
           1. DATA PRODUK
        ===================================== */


        const products = {

            purun: {
                name: "Tas Anyaman Purun",

                // Foto produk jadi
                image: "{{ asset('images/tas-purun.png') }}",

                // Foto bahan baku
                materialImage: "{{ asset('images/purun.jpeg') }}",

                cost: 8000,
                prices: [10000, 12000, 15000],

                steps: [
                    {
                        image: "{{ asset('images/purun.jpeg') }}",
                        title: "Siapkan Purun"
                    },
                    {
                        icon: "bi bi-arrow-left-right",
                        title: "Anyam Purun"
                    },
                    {
                        image: "{{ asset('images/tas-purun.png') }}",
                        title: "Rapikan Tas"
                    }
                ]
            },

            ikan: {
                name: "Kerupuk Ikan",

                // Foto produk jadi
                image: "{{ asset('images/kerupuk-ikan.png') }}",

                // Foto bahan baku
                materialImage: "{{ asset('images/ikan.png') }}",

                cost: 4000,
                prices: [6000, 8000, 10000],

                steps: [
                    {
                        image: "{{ asset('images/ikan.png') }}",
                        title: "Siapkan Ikan"
                    },
                    {
                        icon: "bi bi-basket",
                        title: "Campur Bahan"
                    },
                    {
                        icon: "bi bi-sun",
                        title: "Jemur Kerupuk"
                    }
                ]
            }

        };


        function renderVisual(item, className = "foto-game") {

            if (item && item.image) {
                return `<img src="${item.image}" class="${className}" alt="">`;
            }

            if (item && item.icon) {
                return `<i class="${item.icon}" aria-hidden="true"></i>`;
            }

            return '<i class="bi bi-image" aria-hidden="true"></i>';

        }



        /* =====================================
           2. DATA PELANGGAN
        ===================================== */

        const customers = [

            {
                name: "Bu Rina",
                icon: "bi bi-person-circle",
                quantity: 1,
                greeting: "Halo! Saya ingin membeli satu produk."
            },

            {
                name: "Pak Dedi",
                icon: "bi bi-person-badge",
                quantity: 1,
                greeting: "Wah, produkmu menarik! Saya mau membeli satu."
            },

            {
                name: "Sari",
                icon: "bi bi-person",
                quantity: 2,
                greeting: "Hai! Saya ingin membeli dua produk."
            }

        ];



        /* =====================================
           3. DENOMINASI UANG
        ===================================== */

        const denominations = [
            10000,
            5000,
            2000,
            1000
        ];


        /* =====================================
           4. STATUS PERMAINAN
        ===================================== */

        function createInitialState() {

            return {

                stage: 0,

                product: null,

                collected: [],

                craftStep: 0,

                price: null,

                packaging: "eco",

                stock: 4,

                sold: 0,

                revenue: 0,

                customerIndex: 0,

                basket: 0,

                changeGiven: 0,

                cleaned: [],

                ecoChoice: null

            };

        }

        let game = createInitialState();


        /* =====================================
           5. ELEMEN DAN FORMAT UANG
        ===================================== */

        const stageContent =
            document.getElementById("stageContent");


        function rupiah(number) {

            return "Rp" + new Intl.NumberFormat("id-ID")
                .format(number);

        }


        function unitCost() {

            if (!game.product) return 0;

            return game.product.cost +
                (game.packaging === "eco" ? 500 : 0);

        }


        function productionCapital() {

            return unitCost() * 4;

        }


        function currentCustomer() {

            return customers[game.customerIndex];

        }


        function currentTotal() {

            if (!currentCustomer()) return 0;

            return game.price * currentCustomer().quantity;

        }


        function customerCash() {

            const total = currentTotal();

            return Math.ceil(total / 10000) * 10000 + 5000;

        }


        function changeDue() {

            return customerCash() - currentTotal();

        }


        /* =====================================
           6. UPDATE STATUS GAME
        ===================================== */

        function updateHUD() {

            document.getElementById("hudMoney").textContent =
                rupiah(game.revenue);

            document.getElementById("hudMaterial").textContent =
                game.collected.length;

            document.getElementById("hudStars").textContent =
                calculateStars();

        }


        function calculateStars() {

            let stars = 0;

            if (game.product && game.collected.length === 3) {
                stars++;
            }

            if (game.craftStep === 3) {
                stars++;
            }

            if (game.price) {
                stars++;
            }

            stars += game.customerIndex;

            if (game.stage >= 5 || game.cleaned.length === 4) {
                stars++;
            }

            if (game.ecoChoice === "good") {
                stars++;
            }

            return stars;

        }


        /* =====================================
           7. PROGRESS
        ===================================== */

        function renderProgress() {

            const names = [
                "Bahan Baku",
                "Produksi",
                "Buka Toko",
                "Pelanggan",
                "Lingkungan",
                "Hasil"
            ];

            let html = "";

            names.forEach(function (name, index) {

                let className = "";

                if (index < game.stage) {
                    className = "done";
                }

                if (index === game.stage) {
                    className = "active";
                }

                const number =
                    index < game.stage
                        ? '<i class="bi bi-check-lg" aria-hidden="true"></i>'
                        : index + 1;

                html += `

                    <div class="progress-item ${className}">

                        <div class="progress-number">
                            ${number}
                        </div>

                        <small>${name}</small>

                    </div>

                `;

            });

            document.getElementById("progressList").innerHTML =
                html;

        }


        /* =====================================
           8. RENDER GAME
        ===================================== */

        function renderGame() {

            updateHUD();

            renderProgress();

            if (game.stage === 0) {
                renderMaterialStage();
            }

            if (game.stage === 1) {
                renderCraftStage();
            }

            if (game.stage === 2) {
                renderShopStage();
            }

            if (game.stage === 3) {
                renderMarketStage();
            }

            if (game.stage === 4) {
                renderNatureStage();
            }

            if (game.stage === 5) {
                renderResultStage();
            }

        }


        /* =====================================
           9. TAHAP 1: BAHAN BAKU
        ===================================== */

        function renderMaterialStage() {


            let html = `

    <span class="stage-label">
        MISI 1 DARI 6
    </span>

    <h2 class="stage-title">
        <i class="bi bi-flower1"></i>
        Ayo Cari Bahan Baku!
    </h2>

    <p class="stage-description">
        Pilih produk yang ingin kamu buat.
        Setelah itu, ketuk bahan baku untuk mengumpulkannya.
    </p>

`;



            if (!game.product) {

                html += `

                    <div class="product-grid">

                        <button
                            type="button"
                            class="product-option"
                            data-action="choose-product"
                            data-product="purun">

                            <img
    src="{{ asset('images/tas-purun.png') }}"
    alt="Tas Anyaman Purun"
    class="foto-produk"
>

                            <strong>Tas Anyaman Purun</strong>

                            <small>
                                Kerajinan dari tanaman purun
                                yang tumbuh di lahan basah.
                            </small>

                        </button>


                        <button
                            type="button"
                            class="product-option"
                            data-action="choose-product"
                            data-product="ikan">

                            <img
    src="{{ asset('images/kerupuk-ikan.png') }}"
    alt="Kerupuk Ikan"
    class="foto-produk"
>

                            <strong>Kerupuk Ikan</strong>

                            <small>
                                Makanan olahan dari ikan
                                hasil perikanan.
                            </small>

                        </button>

                    </div>

                    <div class="feedback">
                        <i class="bi bi-lightbulb-fill feedback-icon" aria-hidden="true"></i>
                        Pilih satu produk untuk memulai usahamu!
                    </div>

                `;

            } else {

                let materialHTML = "";

                for (let i = 0; i < 5; i++) {

                    const collected =
                        game.collected.includes(i);

                    materialHTML += `

                        
<button
    type="button"
    class="material-item ${collected ? "collected" : ""}"
    data-action="collect"
    data-index="${i}"
    ${collected || game.collected.length >= 3 ? "disabled" : ""}>

    <span>
        ${collected
                            ? '<i class="bi bi-check-circle-fill"></i>'
                            : `<img src="${game.product.materialImage}" alt="Bahan baku">`
                        }
    </span>

    <small>
        ${collected ? "Diambil" : "Ketuk"}
    </small>

</button>


                    `;

                }


                html += `

                    <div class="material-scene">

                        <div class="scene-title">
                            ${renderVisual(game.product, "foto-produk-mini")} ${game.product.name}
                        </div>

                        <p class="scene-description">
                            Ketuk 3 bahan baku secukupnya!
                        </p>

                        <div class="material-grid">
                            ${materialHTML}
                        </div>

                        <div class="collection-count">
                            <i class="bi bi-basket-fill" aria-hidden="true"></i>
                            Bahan terkumpul: ${game.collected.length}/3
                        </div>

                    </div>


                    
<div class="feedback">
    <i class="bi bi-leaf-fill feedback-icon"></i>
    Ingat! Ambil bahan secukupnya
    agar alam tetap terjaga.
</div>


                    <div class="button-center">

                        <button
                            type="button"
                            class="game-button pink"
                            data-action="next-craft"
                            ${game.collected.length < 3 ? "disabled" : ""}>

                            Lanjut Membuat Produk <i class="bi bi-arrow-right" aria-hidden="true"></i>

                        </button>

                    </div>

                `;

            }

            stageContent.innerHTML = html;

        }


        /* =====================================
           10. TAHAP 2: MEMBUAT PRODUK
        ===================================== */

        function renderCraftStage() {

            let stepsHTML = "";

            game.product.steps.forEach(function (step, index) {

                let className = "";

                if (index < game.craftStep) {
                    className = "done";
                } else if (index === game.craftStep) {
                    className = "active";
                }

                stepsHTML += `

                    <button
                        type="button"
                        class="craft-step ${className}"
                        data-action="craft"
                        data-index="${index}"
                        ${index !== game.craftStep ? "disabled" : ""}>

                        <span>
                            ${index < game.craftStep
                                ? '<i class="bi bi-check-circle-fill" aria-hidden="true"></i>'
                                : renderVisual(step, "foto-langkah")}
                        </span>

                        <small>
                            ${step.title}
                        </small>

                    </button>

                `;

            });


            const productDisplay =
                game.craftStep === 3
                    ? renderVisual(game.product, "foto-game")
                    : renderVisual({ image: game.product.materialImage }, "foto-game");


            stageContent.innerHTML = `

                <span class="stage-label">
                    MISI 2 DARI 6
                </span>

                <h2 class="stage-title">
    <i class="bi bi-tools"></i>
    Ayo Buat Produk!
</h2>

                <p class="stage-description">
                    Ketuk setiap langkah untuk membuat produkmu.
                </p>

                <div class="craft-scene">

                    <div style="font-size:12px;font-weight:700;">
                        ${game.product.name}
                    </div>

                    <div class="craft-product">
                        ${productDisplay}
                    </div>

                    <div style="font-size:11px;color:#78877F;">
                        ${game.craftStep}/3 langkah selesai
                    </div>

                    <div class="craft-steps">
                        ${stepsHTML}
                    </div>

                </div>


                ${game.craftStep === 3 ? `

                    
<div class="feedback">
    <i class="bi bi-check-circle-fill feedback-icon"></i>
    Hebat! Produkmu berhasil dibuat!
</div>


                    <div class="button-center">

                        <button
                            type="button"
                            class="game-button pink"
                            data-action="next-shop">

                            Atur Toko Sekarang <i class="bi bi-arrow-right" aria-hidden="true"></i>

                        </button>

                    </div>

                ` : `

                    
<div class="feedback">
    <i class="bi bi-lightbulb-fill feedback-icon"></i>
    Selesaikan ketiga langkah untuk
    menghasilkan produk.
</div>


                `}

            `;

        }


        /* =====================================
           11. TAHAP 3: BUKA TOKO
        ===================================== */

        function renderShopStage() {

            const prices = game.product.prices;

            let priceHTML = "";

            prices.forEach(function (price) {

                const selected =
                    game.price === price;

                priceHTML += `

                    <button
                        type="button"
                        class="price-option ${selected ? "selected" : ""}"
                        data-action="choose-price"
                        data-price="${price}">

                        <strong>${rupiah(price)}</strong>

                        <small>
                            ${selected ? '<i class="bi bi-check-circle-fill" aria-hidden="true"></i> Dipilih' : "Pilih harga"}
                        </small>

                    </button>

                `;

            });


            const capital =
                productionCapital();

            const revenue =
                game.price ? game.price * 4 : 0;

            const profit =
                revenue - capital;


            stageContent.innerHTML = `

                <span class="stage-label">
                    MISI 3 DARI 6
                </span>

                
<h2 class="stage-title">
    <i class="bi bi-shop"></i>
    Buka Toko Impianmu!
</h2>


                <p class="stage-description">
                    Pilih harga dan kemasan untuk produkmu.
                </p>


                <div class="shop-scene">

                    <div class="shop-image">
    <img
        src="{{ asset('images/pasar-lahan-basah.jpg') }}"
        alt="Pasar tradisional lahan basah"
    >
</div>

                    <h3>Toko ${game.product.name}</h3>

                    <p>
                        Selamat datang di toko pengusaha cilik!
                    </p>

                </div>


                
<h3 style="font-size:13px;margin-bottom:12px;">
    <i class="bi bi-tag-fill section-icon"></i>
    Berapa harga jual produkmu?
</h3>

<div class="price-grid">
    ${priceHTML}
</div>


<h3 style="font-size:13px;margin-top:22px;">
    <i class="bi bi-box-seam section-icon"></i>
    Pilih kemasan
</h3>


                <div class="packaging-grid">

                    <button
                        type="button"
                        class="packaging-option ${game.packaging === "eco" ? "selected" : ""}"
                        data-action="packaging"
                        data-packaging="eco">

                        <span>
    <i class="bi bi-leaf-fill"></i>
</span>

                        <strong>Ramah Lingkungan</strong>

                        <small>Biaya Rp500/produk</small>

                    </button>


                    <button
                        type="button"
                        class="packaging-option ${game.packaging === "plastic" ? "selected" : ""}"
                        data-action="packaging"
                        data-packaging="plastic">

                        <span>
    <i class="bi bi-bag-fill"></i>
</span>

                        <strong>Plastik</strong>

                        <small>Biaya Rp0</small>

                    </button>

                </div>


                <div class="money-preview">

                    <div>
                        <span>Modal 4 produk</span>
                        <strong>${rupiah(capital)}</strong>
                    </div>

                    <div>
                        <span>Potensi penjualan</span>
                        <strong>${rupiah(revenue)}</strong>
                    </div>

                    <div style="border-top:1px dashed #ddd;padding-top:10px;">
                        <span>Potensi keuntungan</span>
                        <strong style="color:#63836D;">
                            ${rupiah(profit)}
                        </strong>
                    </div>

                </div>


                
<div class="feedback">
    <i class="bi bi-leaf-fill feedback-icon"></i>
    Kemasan ramah lingkungan membantu
    mengurangi sampah plastik.
</div>



                <div class="button-center">

                    <button
                        type="button"
                        class="game-button pink"
                        data-action="open-market"
                        ${!game.price ? "disabled" : ""}>

                        Buka Pasarku! <i class="bi bi-arrow-right" aria-hidden="true"></i>

                    </button>

                </div>

            `;

        }


        /* =====================================
           12. TAHAP 4: MELAYANI PELANGGAN
        ===================================== */

        function renderMarketStage() {

            if (game.customerIndex >= customers.length) {

                stageContent.innerHTML = `

                    <span class="stage-label">
                        MISI 4 DARI 6
                    </span>

                    <div class="result-scene">

                        
<div class="trophy">
    <i class="bi bi-trophy-fill"></i>
</div>

<h2>Pasar Berhasil!</h2>

<p>
    Semua pelanggan sudah dilayani.
    Sekarang waktunya menjaga lingkungan!
</p>

<div class="result-grid">

    <div class="result-box">
        <span>
            <i class="bi bi-bag-fill"></i>
        </span>
        <small>Produk Terjual</small>
        <strong>${game.sold}</strong>
    </div>

    <div class="result-box">
        <span>
            <i class="bi bi-cash-coin"></i>
        </span>
        <small>Uang Penjualan</small>
        <strong>${rupiah(game.revenue)}</strong>
    </div>

</div>


                        </div>

                        <button
                            type="button"
                            class="game-button pink"
                            data-action="next-nature">

                            Jaga Lahan Basah <i class="bi bi-arrow-right" aria-hidden="true"></i>

                        </button>

                    </div>

                `;

                return;

            }


            const customer = currentCustomer();

            const total = currentTotal();

            const cash = customerCash();

            const due = changeDue();


            let moneyHTML = "";

            denominations.forEach(function (value) {

                const cannotAdd =
                    game.changeGiven + value > due;

                moneyHTML += `

                    
<button
    type="button"
    class="money-button"
    data-action="give-money"
    data-value="${value}"
    ${cannotAdd || game.basket !== customer.quantity ? "disabled" : ""}>

    <i class="bi bi-cash-stack"></i>
    ${rupiah(value)}

</button>

                `;

            });


            const basketFull =
                game.basket === customer.quantity;


            stageContent.innerHTML = `

                <span class="stage-label">
                    MISI 4 DARI 6
                </span>

                <h2 class="stage-title">
                    <i class="bi bi-shop-window" aria-hidden="true"></i>
                    Layani Pelanggan!
                </h2>

                <p class="stage-description">
                    Pilih barang sesuai pesanan dan berikan
                    uang kembalian dengan tepat.
                </p>


                <div class="market-scene">

                  
<div class="market-icon">
    <i class="bi bi-shop"></i>
</div>


                    <h3>Pasar Lahan Basah</h3>

                    <p>
                        Pelanggan ke-${game.customerIndex + 1}
                        dari ${customers.length}
                    </p>

                </div>


                <div class="customer-card">

                    <div class="customer-avatar">
    <i class="${customer.icon}"></i>
</div>

                    <div class="customer-info">

                        <strong>${customer.name}</strong>

                        <p>${customer.greeting}</p>

                        <div class="customer-order">
                            Pesanan: ${customer.quantity} produk
                        </div>

                    </div>

                </div>


                <div class="basket-scene">

                   
<div class="basket-icon">
    <i class="bi bi-basket2-fill"></i>
</div>


                    <div class="basket-items">
                        Keranjang: ${game.basket}/${customer.quantity}
                    </div>

                    ${!basketFull ? `

                        <button
                            type="button"
                            class="product-add-button"
                            data-action="add-product">

                            <span>${renderVisual(game.product, "foto-produk-mini")}</span>

                            <strong>
                                Masukkan ${game.product.name}
                            </strong>

                        </button>

                    ` : `

                        
<div class="feedback">
    <i class="bi bi-check-circle-fill feedback-icon"></i>
    Pesanan sudah lengkap!
</div>


                    `}

                </div>


                ${basketFull ? `

                    <div class="change-panel">

                       
<h3>
    <i class="bi bi-cash-stack section-icon"></i>
    Pelanggan membayar:
</h3>


                        <div class="change-total">
                            ${rupiah(cash)}
                        </div>

                        <div style="font-size:11px;margin-top:10px;">
                            Total belanja:
                            <strong>${rupiah(total)}</strong>
                        </div>

                        <div style="font-size:11px;margin-top:7px;">
                            Kembalian yang harus diberikan:
                        </div>

                        <div class="change-total">
                            ${rupiah(due)}
                        </div>

                        <hr style="border:0;border-top:1px dashed #dfc9d1;margin:15px 0;">

                        
<h3>
    <i class="bi bi-hand-index-thumb section-icon"></i>
    Ketuk uang untuk memberikan kembalian
</h3>

                        <div class="money-grid">
                            ${moneyHTML}
                        </div>

                        <div class="change-progress">
                            Uang yang sudah diberikan:
                            <strong>${rupiah(game.changeGiven)}</strong>
                        </div>

                        <div style="margin-top:8px;font-size:11px;">
                            Sisa:
                            <strong>
                                ${rupiah(due - game.changeGiven)}
                            </strong>
                        </div>

                        <button
                            type="button"
                            class="game-button pink"
                            data-action="confirm-sale"
                            style="width:100%;margin-top:16px;"
                            ${game.changeGiven !== due ? "disabled" : ""}>

                            Selesaikan Transaksi <i class="bi bi-check-circle-fill" aria-hidden="true"></i>

                        </button>

                    </div>

                ` : ""}

            `;

        }


        /* =====================================
           13. TAHAP 5: JAGA LINGKUNGAN
        ===================================== */

        function renderNatureStage() {

            const trash = [
                { icon: "bi bi-cup-straw", name: "Gelas" },
                { icon: "bi bi-bag", name: "Kantong" },
                { icon: "bi bi-bottle", name: "Botol" },
                { icon: "bi bi-trash3", name: "Kaleng" }
            ];

            let trashHTML = "";

            trash.forEach(function (item, index) {

                const cleaned = game.cleaned.includes(index);

                trashHTML += `
                    <button
                        type="button"
                        class="trash-item ${cleaned ? "cleaned" : ""}"
                        data-action="clean"
                        data-index="${index}"
                        ${cleaned ? "disabled" : ""}>

                        <span>
                            ${cleaned
                                ? '<i class="bi bi-check-circle-fill" aria-hidden="true"></i>'
                                : `<i class="${item.icon}" aria-hidden="true"></i>`}
                        </span>

                        <small>${cleaned ? "Bersih!" : item.name}</small>
                    </button>
                `;

            });

            const environmentChoiceHTML = game.cleaned.length === 4 ? `
                <div class="environment-question" style="margin-top:22px;">
                    <h3 style="font-size:14px;font-weight:700;">
                        <i class="bi bi-tree-fill section-icon" aria-hidden="true"></i>
                        Bagaimana cara menjaga lahan basah?
                    </h3>

                    <p style="font-size:10px;color:#78877F;">
                        Pilih tindakan terbaik!
                    </p>

                    <button
                        type="button"
                        class="eco-choice ${game.ecoChoice === "good" ? "selected" : ""}"
                        data-action="eco-choice"
                        data-choice="good"
                        ${game.ecoChoice ? "disabled" : ""}>
                        <i class="bi bi-leaf-fill section-icon" aria-hidden="true"></i>
                        Mengambil sumber daya secukupnya dan menjaga alam tetap lestari.
                    </button>

                    <button
                        type="button"
                        class="eco-choice ${game.ecoChoice === "bad" ? "selected" : ""}"
                        data-action="eco-choice"
                        data-choice="bad"
                        ${game.ecoChoice ? "disabled" : ""}>
                        <i class="bi bi-exclamation-triangle-fill section-icon" aria-hidden="true"></i>
                        Mengambil seluruh sumber daya tanpa memikirkan kelestarian lingkungan.
                    </button>

                    ${game.ecoChoice ? `
                        <div class="feedback ${game.ecoChoice === "good" ? "" : "warning"}">
                            ${game.ecoChoice === "good"
                                ? '<i class="bi bi-star-fill feedback-icon" aria-hidden="true"></i> Hebat! Kamu pengusaha yang peduli lingkungan!'
                                : '<i class="bi bi-heart-fill feedback-icon" aria-hidden="true"></i> Belum tepat. Sumber daya lahan basah harus dijaga agar tetap lestari.'}
                        </div>
                    ` : ""}

                    <div class="button-center">
                        <button
                            type="button"
                            class="game-button pink"
                            data-action="finish-game"
                            ${!game.ecoChoice ? "disabled" : ""}>
                            Lihat Hasil Permainan
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            ` : "";

            stageContent.innerHTML = `
                <span class="stage-label">MISI 5 DARI 6</span>

                <h2 class="stage-title">
                    <i class="bi bi-tree-fill" aria-hidden="true"></i>
                    Selamatkan Lahan Basah!
                </h2>

                <p class="stage-description">
                    Ketuk sampah yang ada di sekitar sungai untuk membersihkan lingkungan.
                </p>

                <div class="nature-scene">
                    <div class="nature-icons" aria-hidden="true">
                        <i class="bi bi-water"></i>
                        <i class="bi bi-flower1"></i>
                        <i class="bi bi-bug"></i>
                    </div>

                    <h3>Lingkungan Lahan Basah</h3>
                    <p>
                        Ayo jaga sungai dan habitat makhluk hidup agar tetap bersih!
                    </p>
                </div>

                <h3 style="font-size:13px;margin-bottom:12px;">
                    <i class="bi bi-trash3-fill section-icon" aria-hidden="true"></i>
                    Ketuk sampah untuk membersihkannya
                </h3>

                <div class="trash-grid">${trashHTML}</div>

                <div class="feedback">
                    <i class="bi bi-check-circle-fill feedback-icon" aria-hidden="true"></i>
                    Sampah dibersihkan: ${game.cleaned.length}/4
                </div>

                ${environmentChoiceHTML}
            `;

        }


        /* =====================================
           14. TAHAP 6: HASIL PERMAINAN
        ===================================== */

        function renderResultStage() {

            const stars = calculateStars();
            const profit = game.revenue - (unitCost() * game.sold);
            const totalStars = 8;

            let message = "";

            if (stars >= 7) {
                message = "Luar biasa! Kamu pengusaha cilik yang hebat dan peduli lingkungan!";
            } else if (stars >= 5) {
                message = "Bagus! Kamu sudah belajar menjadi pengusaha yang bertanggung jawab.";
            } else {
                message = "Tetap semangat! Terus belajar dan coba lagi menjadi pengusaha hebat.";
            }

            const starHTML = Array.from({ length: totalStars }, function (_, index) {
                const iconClass = index < stars ? "bi-star-fill" : "bi-star";
                return `<i class="bi ${iconClass}" aria-hidden="true"></i>`;
            }).join("");

            stageContent.innerHTML = `
                <span class="stage-label">MISI 6 DARI 6</span>

                <div class="result-scene">
                    <div class="trophy">
                        <i class="bi bi-trophy-fill" aria-hidden="true"></i>
                    </div>

                    <h2>Selamat, Pengusaha Cilik!</h2>
                    <p>${message}</p>

                    <div class="stars-display" aria-label="Skor ${stars} dari ${totalStars} bintang">
                        ${starHTML}
                    </div>

                    <div style="font-size:12px;font-weight:700;">
                        Skor: ${stars}/${totalStars} Bintang
                    </div>

                    <div class="result-grid">
                        <div class="result-box">
                            <span>${renderVisual(game.product, "foto-game")}</span>
                            <small>Produk Usaha</small>
                            <strong>${game.product ? game.product.name : "-"}</strong>
                        </div>

                        <div class="result-box">
                            <span><i class="bi bi-bag-fill" aria-hidden="true"></i></span>
                            <small>Produk Terjual</small>
                            <strong>${game.sold} produk</strong>
                        </div>

                        <div class="result-box">
                            <span><i class="bi bi-cash-coin" aria-hidden="true"></i></span>
                            <small>Total Penjualan</small>
                            <strong>${rupiah(game.revenue)}</strong>
                        </div>

                        <div class="result-box">
                            <span><i class="bi bi-graph-up-arrow" aria-hidden="true"></i></span>
                            <small>Keuntungan</small>
                            <strong>${rupiah(profit)}</strong>
                        </div>

                        <div class="result-box">
                            <span><i class="bi bi-trash3-fill" aria-hidden="true"></i></span>
                            <small>Sampah Dibersihkan</small>
                            <strong>${game.cleaned.length} benda</strong>
                        </div>

                        <div class="result-box">
                            <span><i class="bi bi-leaf-fill" aria-hidden="true"></i></span>
                            <small>Peduli Lingkungan</small>
                            <strong>${game.ecoChoice === "good" ? "Hebat!" : "Belajar lagi"}</strong>
                        </div>
                    </div>
                </div>

                <div class="feedback">
                    <i class="bi bi-leaf-fill feedback-icon" aria-hidden="true"></i>
                    Ingat! Pengusaha hebat bukan hanya mencari keuntungan, tetapi juga menjaga alam agar tetap lestari.
                </div>

                <div class="button-center">
                    <button
                        type="button"
                        class="game-button pink"
                        data-action="restart">
                        <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                        Mainkan Kembali
                    </button>
                </div>
            `;

        }


        /* =====================================
           15. MENGATUR SEMUA KLIK
        ===================================== */

        stageContent.addEventListener("click", function (event) {

            const button =
                event.target.closest("[data-action]");

            if (!button || button.disabled) return;


            const action = button.dataset.action;


            /* PILIH PRODUK */

            if (action === "choose-product") {

                const key = button.dataset.product;

                game.product = products[key];

                game.collected = [];

            }


            /* KUMPULKAN BAHAN */

            else if (action === "collect") {

                const index =
                    Number(button.dataset.index);

                if (
                    !game.collected.includes(index) &&
                    game.collected.length < 3
                ) {

                    game.collected.push(index);

                }

            }


            /* LANJUT KE PRODUKSI */

            else if (action === "next-craft") {

                if (game.collected.length === 3) {

                    game.stage = 1;

                }

            }


            /* LANGKAH PRODUKSI */

            else if (action === "craft") {

                const index =
                    Number(button.dataset.index);

                if (index === game.craftStep) {

                    game.craftStep++;

                }

            }


            /* BUKA TOKO */

            else if (action === "next-shop") {

                if (game.craftStep === 3) {

                    game.stage = 2;

                }

            }


            /* PILIH HARGA */

            else if (action === "choose-price") {

                game.price =
                    Number(button.dataset.price);

            }


            /* PILIH KEMASAN */

            else if (action === "packaging") {

                game.packaging =
                    button.dataset.packaging;

            }


            /* BUKA PASAR */

            else if (action === "open-market") {

                if (game.price) {

                    game.stage = 3;

                    game.customerIndex = 0;

                    game.stock = 4;

                }

            }


            /* MASUKKAN PRODUK KE KERANJANG */

            else if (action === "add-product") {

                const customer = currentCustomer();

                if (
                    customer &&
                    game.stock > 0 &&
                    game.basket < customer.quantity
                ) {

                    game.basket++;

                }

            }


            /* MEMBERIKAN UANG KEMBALIAN */

            else if (action === "give-money") {

                const value =
                    Number(button.dataset.value);

                const due = changeDue();

                const customer = currentCustomer();

                if (
                    customer &&
                    game.basket === customer.quantity &&
                    game.changeGiven + value <= due
                ) {

                    game.changeGiven += value;

                }

            }


            /* MENYELESAIKAN TRANSAKSI */

            else if (action === "confirm-sale") {

                const customer = currentCustomer();

                if (
                    customer &&
                    game.basket === customer.quantity &&
                    game.changeGiven === changeDue()
                ) {

                    const total = currentTotal();

                    game.revenue += total;

                    game.sold += customer.quantity;

                    game.stock -= customer.quantity;

                    game.customerIndex++;

                    game.basket = 0;

                    game.changeGiven = 0;

                }

            }


            /* MENUJU LINGKUNGAN */

            else if (action === "next-nature") {

                game.stage = 4;

            }


            /* MEMBERSIHKAN SAMPAH */

            else if (action === "clean") {

                const index =
                    Number(button.dataset.index);

                if (!game.cleaned.includes(index)) {

                    game.cleaned.push(index);

                }

            }


            /* PILIH TINDAKAN LINGKUNGAN */

            else if (action === "eco-choice") {

                if (!game.ecoChoice) {

                    game.ecoChoice =
                        button.dataset.choice;

                }

            }


            /* HASIL AKHIR */

            else if (action === "finish-game") {

                if (
                    game.cleaned.length === 4 &&
                    game.ecoChoice
                ) {

                    game.stage = 5;

                }

            }


            /* ULANG PERMAINAN */

            else if (action === "restart") {

                game = createInitialState();

            }


            renderGame();

        });


        /* =====================================
           16. MULAI PERMAINAN
        ===================================== */

        renderGame();

    </script>

</body>

</html>