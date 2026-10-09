@extends('layouts.app-guru')

@section('content')

    <div class="soal-page">

        <!-- HEADER HALAMAN -->
        <div class="page-header">

            <div>
                <h1>Soal Kuis</h1>
                <p>Kelola soal kuis untuk pembelajaran BAKAWAN.</p>
            </div>

            <button type="button" class="btn-tambah" onclick="openModal()">
                + Tambah Soal
            </button>

        </div>


        <!-- PESAN BERHASIL -->
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif


        <!-- PESAN ERROR -->
        @if($errors->any())
            <div class="alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- RINGKASAN -->
        <div class="summary-container">

            <!-- TOTAL SOAL -->
            <div class="summary-card">

                <div class="summary-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div>
                    <p>Total Soal</p>
                    <h2>{{ $daftarSoal->count() }}</h2>
                    <span>Soal kuis tersedia</span>
                </div>

            </div>


            <!-- TOTAL MATERI -->
            <div class="summary-card">

                <div class="summary-icon">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <p>Total Materi</p>
                    <h2>{{ $daftarMateri->count() }}</h2>
                    <span>Total materi pembelajaran</span>
                </div>

            </div>

        </div>


        <!-- DAFTAR SOAL -->
        <div class="soal-box">

            <div class="box-header">
                <h2>Daftar Soal</h2>
                <p>Soal yang akan digunakan dalam kuis siswa.</p>
            </div>

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Materi</th>
                            <th>Jawaban Benar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($daftarSoal as $soal)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $soal->pertanyaan }}</td>

                                <td>
                                    <span class="materi-badge">
                                        {{ $soal->materi->judul ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="jawaban-badge">
                                        {{ $soal->jawaban_benar }}
                                    </span>
                                </td>

                                <td>

                                    <!-- LIHAT -->
                                    <button type="button" class="btn-detail" onclick="lihatSoal({{ $soal->id }})">
                                        Lihat
                                    </button>

                                    <!-- EDIT -->
                                    <button type="button" class="btn-edit" onclick="openEditModal({{ $soal->id }})">
                                        Edit
                                    </button>

                                    <!-- HAPUS -->
                                    <form action="{{ route('soal.kuis.destroy', $soal->id) }}" method="POST" class="form-hapus"
                                        onsubmit="return confirm('Yakin ingin menghapus soal ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="soal-kosong">
                                    Belum ada soal kuis. Silakan tambahkan soal terlebih dahulu.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- MODAL TAMBAH DAN EDIT SOAL -->

    <div class="modal" id="soalModal">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h2 id="modalTitle">Tambah Soal</h2>
                    <p>Masukkan pertanyaan dan pilihan jawaban.</p>
                </div>

                <button type="button" class="btn-close" onclick="closeModal()">
                    ×
                </button>

            </div>


            <!-- FORM SOAL -->
            <form id="formSoal" action="{{ route('soal.kuis.store') }}" method="POST">

                @csrf

                <!-- POST untuk tambah, PUT untuk edit -->
                <input type="hidden" name="_method" id="methodForm" value="POST">


                <!-- PERTANYAAN -->
                <div class="form-group">

                    <label for="pertanyaan">Pertanyaan</label>

                    <textarea id="pertanyaan" name="pertanyaan" placeholder="Masukkan pertanyaan kuis" required></textarea>

                </div>


                <!-- PILIH MATERI -->
                <div class="form-group">

                    <label for="materi">Materi</label>

                    <select id="materi" name="materi_id" required>

                        <option value="">-- Pilih Materi --</option>

                        @forelse($daftarMateri as $materi)

                            <option value="{{ $materi->id }}">
                                {{ $materi->judul }}
                            </option>

                        @empty

                            <option value="" disabled>
                                Belum ada materi tersedia
                            </option>

                        @endforelse

                    </select>

                </div>


                <!-- PILIHAN A -->
                <div class="form-group">

                    <label for="pilihanA">Pilihan A</label>

                    <input type="text" id="pilihanA" name="pilihan_a" maxlength="255" placeholder="Masukkan pilihan A"
                        required>

                </div>


                <!-- PILIHAN B -->
                <div class="form-group">

                    <label for="pilihanB">Pilihan B</label>

                    <input type="text" id="pilihanB" name="pilihan_b" maxlength="255" placeholder="Masukkan pilihan B"
                        required>

                </div>


                <!-- PILIHAN C -->
                <div class="form-group">

                    <label for="pilihanC">Pilihan C</label>

                    <input type="text" id="pilihanC" name="pilihan_c" maxlength="255" placeholder="Masukkan pilihan C"
                        required>

                </div>


                <!-- PILIHAN D -->
                <div class="form-group">

                    <label for="pilihanD">Pilihan D</label>

                    <input type="text" id="pilihanD" name="pilihan_d" maxlength="255" placeholder="Masukkan pilihan D"
                        required>

                </div>


                <!-- JAWABAN BENAR -->
                <div class="form-group">

                    <label for="jawaban">Jawaban Benar</label>

                    <select id="jawaban" name="jawaban_benar" required>

                        <option value="">-- Pilih Jawaban --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>

                    </select>

                </div>


                <!-- TOMBOL MODAL -->
                <div class="modal-footer">

                    <button type="button" class="btn-batal" onclick="closeModal()">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>



    <!-- =====================================
                         MODAL LIHAT DETAIL SOAL
                    ===================================== -->

    <div class="modal" id="lihatModal">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h2>Detail Soal</h2>
                    <p>Informasi lengkap soal kuis.</p>
                </div>

                <button type="button" class="btn-close" onclick="closeLihatModal()">
                    ×
                </button>

            </div>


            <div class="detail-soal">

                <div class="detail-item">
                    <span>Pertanyaan</span>
                    <p id="detailPertanyaan"></p>
                </div>

                <div class="detail-item">
                    <span>Materi</span>
                    <p id="detailMateri"></p>
                </div>

                <div class="detail-item">

                    <span>Pilihan Jawaban</span>

                    <div class="pilihan-list">
                        <p>A. <span id="detailA"></span></p>
                        <p>B. <span id="detailB"></span></p>
                        <p>C. <span id="detailC"></span></p>
                        <p>D. <span id="detailD"></span></p>
                    </div>

                </div>

                <div class="detail-item">
                    <span>Jawaban Benar</span>

                    <strong class="jawaban-detail" id="detailJawaban">
                    </strong>
                </div>

            </div>

        </div>

    </div>



    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* HALAMAN SOAL KUIS */

        .soal-page {
            padding-bottom: 30px;
        }


        /* HEADER */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
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


        /* NOTIFIKASI */
        .alert-success {
            background: #d8f3dc;
            color: #1b4332;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }


        /* KARTU RINGKASAN */

        .summary-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .summary-card {
            background-color: white;
            border-radius: 14px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        /* KOTAK IKON */
        .summary-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background-color: #d8f3dc;

            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* WARNA DAN UKURAN IKON */
        .summary-icon i {
            font-size: 24px;
            color: #2d6a4f;
            line-height: 1;
        }

        .summary-card p {
            margin: 0;
            color: #777;
            font-size: 13px;
        }

        .summary-card h2 {
            margin: 4px 0;
            color: #1b4332;
            font-size: 25px;
        }

        .summary-card span {
            color: #999;
            font-size: 12px;
        }


        /* DAFTAR SOAL */

        .soal-box {
            background-color: white;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .box-header {
            margin-bottom: 20px;
        }

        .box-header h2 {
            margin: 0;
            color: #1b4332;
            font-size: 20px;
        }

        .box-header p {
            margin: 5px 0 0;
            color: #999;
            font-size: 13px;
        }


        /* TABEL */
        .table-container {
            overflow-x: auto;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container thead {
            background-color: #ABE7B2;
        }

        .table-container th {
            padding: 14px;
            text-align: left;
            color: #2d6a4f;
            font-size: 13px;
        }

        .table-container td {
            padding: 15px 14px;
            border-bottom: 1px solid #eeeeee;
            color: #555;
            font-size: 14px;
            vertical-align: middle;
        }

        .table-container tbody tr:hover {
            background-color: #fafdfb;
        }


        /* LABEL MATERI */
        .materi-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #FF788D;
            color: white;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }


        /* LABEL JAWABAN */
        .jawaban-badge {
            display: inline-flex;
            width: 30px;
            height: 30px;
            align-items: center;
            justify-content: center;
            background-color: #FF788D;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
        }


        /*  TOMBOL AKSI */

        .btn-detail,
        .btn-edit,
        .btn-delete {
            border: none;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            cursor: pointer;
            margin-right: 4px;
        }

        .btn-detail {
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

        .form-hapus {
            display: inline;
        }


        /* BELUM ADA SOAL */
        .soal-kosong {
            text-align: center;
            padding: 25px !important;
            color: #777;
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
            width: 550px;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            background-color: white;
            border-radius: 16px;
            padding: 25px;
            box-sizing: border-box;
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


        /* =====================================
                       FORM SOAL
                    ===================================== */

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
        .form-group textarea,
        .form-group select {
            width: 100%;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #dddddd;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
            font-family: Arial, sans-serif;
            background-color: white;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #2d6a4f;
        }


        /* TOMBOL MODAL */
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


        /* DETAIL SOAL */

        .detail-item {
            margin-bottom: 20px;
        }

        .detail-item>span {
            display: block;
            color: #888;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .detail-item>p {
            margin: 0;
            color: #333;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .pilihan-list {
            background-color: #f8faf9;
            border-radius: 10px;
            padding: 10px 15px;
        }

        .pilihan-list p {
            margin: 10px 0;
            color: #555;
            overflow-wrap: anywhere;
        }

        .jawaban-detail {
            display: inline-flex;
            width: 35px;
            height: 35px;
            align-items: center;
            justify-content: center;
            background-color: #2d6a4f;
            color: white;
            border-radius: 50%;
        }


        /* RESPONSIVE */

        @media (max-width: 900px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .summary-container {
                grid-template-columns: 1fr;
            }

            .table-container th,
            .table-container td {
                white-space: nowrap;
            }

        }

        @media (max-width: 480px) {

            .modal-content {
                padding: 18px;
            }

            .page-header h1 {
                font-size: 23px;
            }

            .btn-tambah {
                width: 100%;
            }

        }
    </style>



    <script>

        // Mengambil data soal dari Laravel
        const daftarSoal = {{ Illuminate\Support\Js::from($daftarSoal) }};

        // Alamat untuk tambah dan edit
        const urlSimpan = @js(route('soal.kuis.store'));
        const urlSoal = @js(url('/soal-kuis'));


        // 1. MEMBUKA MODAL TAMBAH SOAL
        function openModal() {

            // Mengubah judul
            document.getElementById('modalTitle').innerText = 'Tambah Soal';

            // Mengosongkan form
            document.getElementById('formSoal').reset();

            // Mengatur alamat penyimpanan
            document.getElementById('formSoal').action = urlSimpan;
            document.getElementById('methodForm').value = 'POST';

            // Menampilkan modal
            document.getElementById('soalModal').style.display = 'flex';
        }


        // 2. MEMBUKA MODAL EDIT SOAL
        function openEditModal(id) {

            // Mencari soal berdasarkan ID
            const soal = daftarSoal.find(function (item) {
                return item.id == id;
            });

            if (!soal) {
                alert('Soal tidak ditemukan.');
                return;
            }

            // Mengubah judul modal
            document.getElementById('modalTitle').innerText = 'Edit Soal';

            // Mengisi data soal lama
            document.getElementById('pertanyaan').value = soal.pertanyaan;
            document.getElementById('materi').value = soal.materi_id;
            document.getElementById('pilihanA').value = soal.pilihan_a;
            document.getElementById('pilihanB').value = soal.pilihan_b;
            document.getElementById('pilihanC').value = soal.pilihan_c;
            document.getElementById('pilihanD').value = soal.pilihan_d;
            document.getElementById('jawaban').value = soal.jawaban_benar;

            // Mengatur alamat update
            document.getElementById('formSoal').action = urlSoal + '/' + id;
            document.getElementById('methodForm').value = 'PUT';

            // Menampilkan modal
            document.getElementById('soalModal').style.display = 'flex';
        }


        // 3. MENUTUP MODAL
        function closeModal() {
            document.getElementById('soalModal').style.display = 'none';
        }


        // 4. MELIHAT DETAIL SOAL
        function lihatSoal(id) {

            const soal = daftarSoal.find(function (item) {
                return item.id == id;
            });

            if (!soal) {
                alert('Soal tidak ditemukan.');
                return;
            }

            // Menampilkan informasi soal
            document.getElementById('detailPertanyaan').innerText =
                soal.pertanyaan;

            document.getElementById('detailMateri').innerText =
                soal.materi ? soal.materi.judul : '-';

            document.getElementById('detailA').innerText = soal.pilihan_a;
            document.getElementById('detailB').innerText = soal.pilihan_b;
            document.getElementById('detailC').innerText = soal.pilihan_c;
            document.getElementById('detailD').innerText = soal.pilihan_d;

            document.getElementById('detailJawaban').innerText =
                soal.jawaban_benar;

            // Menampilkan modal detail
            document.getElementById('lihatModal').style.display = 'flex';
        }


        // 5. MENUTUP MODAL DETAIL
        function closeLihatModal() {
            document.getElementById('lihatModal').style.display = 'none';
        }


        // 6. MEMULIHKAN FORM JIKA VALIDASI GAGAL
        @if($errors->any())

            document.addEventListener('DOMContentLoaded', function () {

                openModal();

                document.getElementById('pertanyaan').value =
                    @js(old('pertanyaan', ''));

                document.getElementById('materi').value =
                    @js(old('materi_id', ''));

                document.getElementById('pilihanA').value =
                    @js(old('pilihan_a', ''));

                document.getElementById('pilihanB').value =
                    @js(old('pilihan_b', ''));

                document.getElementById('pilihanC').value =
                    @js(old('pilihan_c', ''));

                document.getElementById('pilihanD').value =
                    @js(old('pilihan_d', ''));

                document.getElementById('jawaban').value =
                    @js(old('jawaban_benar', ''));

            });

        @endif

    </script>

@endsection