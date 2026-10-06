@extends('layouts.app-guru')

@section('content')

    <div class="materi-page">
        <!-- Header -->
        <div class="page-header">
            <div>
                <h1>Materi Pembelajaran</h1>
                <p>Kelola materi pembelajaran IPAS untuk siswa kelas V.</p>
            </div>

            <button class="btn-tambah" onclick="openModal()">
                + Tambah Materi
            </button>
        </div>

        <!-- Daftar Materi -->
        <div class="materi-container">

            <!-- Materi 1 -->
            <div class="materi-card">

                <div class="materi-image">
                    <img src="{{ asset('images/materi/ekosistem.jpeg') }}" alt="Ekosistem">
                </div>

                <div class="materi-content">

                    <span class="materi-label">Materi 1</span>

                    <h2>Mengenal Ekosistem</h2>

                    <p>
                        Mengenal komponen biotik dan abiotik serta hubungan
                        antara makhluk hidup dengan lingkungan di sekitarnya.
                    </p>

                    <div class="materi-info">
                        <span>📚 IPAS Kelas V</span>
                        <span>⏱️ 20 Menit</span>
                    </div>

                    <div class="materi-action">
                        <button class="btn-lihat">Lihat</button>

                        <button class="btn-edit" onclick="openEditModal(
                            'Mengenal Ekosistem',
                            'Mengenal komponen biotik dan abiotik serta hubungan antara makhluk hidup dengan lingkungan di sekitarnya.'
                        )">
                            Edit
                        </button>

                        <button class="btn-delete" onclick="hapusMateri()">
                            Hapus
                        </button>
                    </div>

                </div>
            </div>


            <!-- Materi 2 -->
            <div class="materi-card">

                <div class="materi-image">
                    <img src="{{ asset('images/materi/interaksi.jpg') }}" alt="Interaksi Ekosistem">
                </div>

                <div class="materi-content">

                    <span class="materi-label">Materi 2</span>

                    <h2>Interaksi dalam Ekosistem</h2>

                    <p>
                        Mempelajari hubungan antar makhluk hidup seperti
                        mutualisme, kompetisi, dan predasi.
                    </p>

                    <div class="materi-info">
                        <span>📚 IPAS Kelas V</span>
                        <span>⏱️ 20 Menit</span>
                    </div>

                    <div class="materi-action">
                        <button class="btn-lihat">Lihat</button>

                        <button class="btn-edit" onclick="openEditModal(
                            'Interaksi dalam Ekosistem',
                            'Mempelajari hubungan antar makhluk hidup seperti mutualisme, kompetisi, dan predasi.'
                        )">
                            Edit
                        </button>

                        <button class="btn-delete" onclick="hapusMateri()">
                            Hapus
                        </button>
                    </div>

                </div>
            </div>


            <!-- Materi 3 -->
            <div class="materi-card">

                <div class="materi-image">
                    <img src="{{ asset('images/materi/rantaimakanan.jpg') }}" alt="Rantai Makanan">
                </div>

                <div class="materi-content">

                    <span class="materi-label">Materi 3</span>

                    <h2>Rantai Makanan</h2>

                    <p>
                        Memahami proses perpindahan energi melalui hubungan
                        makan dan dimakan dalam suatu ekosistem.
                    </p>

                    <div class="materi-info">
                        <span>📚 IPAS Kelas V</span>
                        <span>⏱️ 20 Menit</span>
                    </div>

                    <div class="materi-action">
                        <button class="btn-lihat">Lihat</button>

                        <button class="btn-edit" onclick="openEditModal(
                            'Rantai Makanan',
                            'Memahami proses perpindahan energi melalui hubungan makan dan dimakan dalam suatu ekosistem.'
                        )">
                            Edit
                        </button>

                        <button class="btn-delete" onclick="hapusMateri()">
                            Hapus
                        </button>
                    </div>

                </div>
            </div>

        </div>
        ```

    </div>


    <!-- MODAL TAMBAH / EDIT -->

    <div class="modal" id="materiModal">
        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h2 id="modalTitle">Tambah Materi</h2>
                    <p>Masukkan informasi materi pembelajaran.</p>
                </div>

                <button class="btn-close" onclick="closeModal()">×</button>

            </div>


            <!-- Judul -->
            <div class="form-group">

                <label>Judul Materi</label>

                <input type="text" id="judulMateri" placeholder="Contoh: Mengenal Ekosistem">

            </div>


            <!-- Deskripsi -->
            <div class="form-group">

                <label>Deskripsi Materi</label>

                <textarea id="deskripsiMateri" placeholder="Masukkan deskripsi materi"></textarea>

            </div>


            <!-- Gambar -->
            <div class="form-group">

                <label>Gambar Materi</label>

                <input type="file" id="gambarMateri" accept="image/*">

                <small>
                    Format gambar: JPG, JPEG, PNG
                </small>

            </div>


            <!-- Durasi -->
            <div class="form-group">

                <label>Durasi Materi</label>

                <input type="text" id="durasiMateri" placeholder="Contoh: 20 Menit">

            </div>


            <!-- Tombol -->
            <div class="modal-footer">

                <button class="btn-batal" onclick="closeModal()">
                    Batal
                </button>

                <button class="btn-simpan" onclick="saveMateri()">
                    Simpan
                </button>

            </div>

        </div>

    </div>

    <style>
  

        /* HALAMAN MATERI */

        .materi-page {
            padding-bottom: 30px;
        }


        /* HEADER */

        .page-header {

            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;

        }

        .page-header h1 {

            margin: 0 0 5px;

            color: #1b4332;

            font-size: 28px;

        }

        .page-header p {

            margin: 0;

            color: #777;

            font-size: 14px;

        }


        /* TOMBOL TAMBAH */

        .btn-tambah {

            border: none;

            background-color: #2d6a4f;

            color: white;

            padding: 12px 18px;

            border-radius: 10px;

            font-size: 14px;

            cursor: pointer;

        }

        .btn-tambah:hover {

            background-color: #1b4332;

        }


        /* CONTAINER MATERI */
        .materi-container {

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 20px;

        }


        /* CARD MATERI */

        .materi-card {

            background-color: white;

            border-radius: 15px;

            overflow: hidden;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);

            transition: 0.2s;

        }

        .materi-card:hover {

            transform: translateY(-3px);

        }


        /* GAMBAR */

        .materi-image {
            width: 100%;
            height: 350px;
            background-color: #d8f3dc;
            overflow: hidden;
        }

        .materi-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* ISI */
        .materi-content {
            padding: 20px;
        }

        .materi-label {
            display: inline-block;
            background-color: #d8f3dc;
            color: #2d6a4f;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;

        }

        .materi-content h2 {
            margin: 12px 0 8px;
            color: #1b4332;
            font-size: 20px;

        }

        .materi-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;

        }


        /* INFORMASI */

        .materi-info {
            display: flex;
            gap: 20px;
            margin-top: 15px;
            color: #777;
            font-size: 12px;
        }


        /* TOMBOL AKSI */

        .materi-action {
            display: flex;
            gap: 7px;
            margin-top: 18px;
        }

        .materi-action button {
            border: none;
            padding: 8px 12px;
            border-radius: 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-lihat {
            background-color: #e8f5e9;
            color: #2d6a4f;
        }

        .btn-edit {

            background-color: #fff3cd;

            color: #856404;

        }

        .btn-delete {

            background-color: #f8d7da;

            color: #842029;

        }

        /* MODAL */
        .modal {

            display: none;

            position: fixed;

            z-index: 1000;

            left: 0;

            top: 0;

            width: 100%;

            height: 100%;

            background-color: rgba(0, 0, 0, 0.4);

            align-items: center;

            justify-content: center;

        }


        .modal-content {

            width: 500px;

            max-width: 90%;

            background-color: white;

            border-radius: 16px;

            padding: 25px;

        }


        .modal-header {

            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            margin-bottom: 25px;

        }


        .modal-header h2 {

            margin: 0;

            color: #1b4332;

        }

        .modal-header p {

            margin: 5px 0 0;

            color: #999;

            font-size: 13px;

        }


        .btn-close {

            border: none;

            background: none;

            font-size: 28px;

            color: #777;

            cursor: pointer;

        }


        /* FORM */

        .form-group {

            margin-bottom: 18px;

        }

        .form-group label {

            display: block;

            margin-bottom: 7px;

            color: #374151;

            font-size: 14px;

            font-weight: 600;

        }


        .form-group input,
        .form-group textarea {

            width: 100%;

            box-sizing: border-box;

            padding: 11px 12px;

            border: 1px solid #dddddd;

            border-radius: 9px;

            outline: none;

            font-size: 14px;

            font-family: Arial, sans-serif;

        }


        .form-group textarea {

            height: 100px;

            resize: vertical;

        }


        .form-group input:focus,
        .form-group textarea:focus {

            border-color: #2d6a4f;

        }


        .form-group small {

            display: block;

            margin-top: 5px;

            color: #999;

            font-size: 11px;

        }


        /* FOOTER MODAL */

        .modal-footer {

            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 25px;

        }


        .btn-batal,
        .btn-simpan {

            border: none;

            padding: 10px 18px;

            border-radius: 9px;

            cursor: pointer;

            font-size: 14px;

        }


        .btn-batal {

            background-color: #eeeeee;

            color: #555;

        }


        .btn-simpan {

            background-color: #2d6a4f;

            color: white;

        }


        /* RESPONSIVE */

        @media (max-width: 900px) {

            .materi-container {

                grid-template-columns: 1fr;

            }

        }
    </style>

    <script>

        /* Buka modal tambah */

        function openModal() {

            document.getElementById('modalTitle').innerText = 'Tambah Materi';

            document.getElementById('judulMateri').value = '';

            document.getElementById('deskripsiMateri').value = '';

            document.getElementById('durasiMateri').value = '';

            document.getElementById('gambarMateri').value = '';

            document.getElementById('materiModal').style.display = 'flex';

        }


        /* Buka modal edit */

        function openEditModal(judul, deskripsi) {

            document.getElementById('modalTitle').innerText = 'Edit Materi';

            document.getElementById('judulMateri').value = judul;

            document.getElementById('deskripsiMateri').value = deskripsi;

            document.getElementById('materiModal').style.display = 'flex';

        }


        /* Tutup modal */

        function closeModal() {

            document.getElementById('materiModal').style.display = 'none';

        }


        /* Simpan */

        function saveMateri() {

            alert('Data materi berhasil disimpan!');

            closeModal();

        }


        /* Hapus */

        function hapusMateri() {

            if (confirm('Apakah Anda yakin ingin menghapus materi ini?')) {

                alert('Materi berhasil dihapus!');

            }

        }

    </script>

@endsection