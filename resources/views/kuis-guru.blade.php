@extends('app-guru')

@section('content')

<div class="soal-page">

<!-- header -->
<div class="page-header">

    <div>
        <h1>Soal Kuis</h1>
        <p>Kelola soal kuis untuk pembelajaran BAKAWAN.</p>
    </div>

    <button class="btn-tambah" onclick="openModal()">
        + Tambah Soal
    </button>

</div>


<!-- ringkasan -->
<div class="summary-container">

    <div class="summary-card">

        <div class="summary-icon">
            📝
        </div>

        <div>
            <p>Total Soal</p>
            <h2>10</h2>
            <span>Soal kuis tersedia</span>
        </div>

    </div>


    <div class="summary-card">

        <div class="summary-icon">
            📚
        </div>

        <div>
            <p>Total Materi</p>
            <h2>3</h2>
            <span>Materi memiliki soal</span>
        </div>

    </div>

</div>


<!-- daftar soal -->
<div class="soal-box">

    <div class="box-header">

        <div>
            <h2>Daftar Soal</h2>
            <p>Soal yang akan digunakan dalam kuis siswa.</p>
        </div>

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

                <!-- soal 1 -->
                <tr>

                    <td>1</td>

                    <td>
                        Apa yang dimaksud dengan ekosistem?
                    </td>

                    <td>
                        <span class="materi-badge">
                            Mengenal Ekosistem
                        </span>
                    </td>

                    <td>
                        <span class="jawaban-badge">
                            A
                        </span>
                    </td>

                    <td>

                        <button
                            class="btn-detail"
                            onclick="lihatSoal(
                                'Apa yang dimaksud dengan ekosistem?',
                                'Mengenal Ekosistem',
                                'Lingkungan yang terdiri dari makhluk hidup dan benda tak hidup yang saling berinteraksi.',
                                'Lingkungan yang terdiri dari makhluk hidup dan benda tak hidup yang saling berinteraksi.',
                                'Kumpulan hewan saja',
                                'Tempat tinggal manusia',
                                'Kumpulan tumbuhan saja',
                                'A'
                            )">
                            Lihat
                        </button>

                        <button
                            class="btn-edit"
                            onclick="openEditModal(
                                'Apa yang dimaksud dengan ekosistem?',
                                'Mengenal Ekosistem',
                                'Lingkungan yang terdiri dari makhluk hidup dan benda tak hidup yang saling berinteraksi.',
                                'Kumpulan hewan saja',
                                'Tempat tinggal manusia',
                                'Kumpulan tumbuhan saja',
                                'A'
                            )">
                            Edit
                        </button>

                        <button
                            class="btn-delete"
                            onclick="hapusSoal()">
                            Hapus
                        </button>

                    </td>

                </tr>


                <!-- soal 2 -->
                <tr>

                    <td>2</td>

                    <td>
                        Manakah yang termasuk komponen biotik?
                    </td>

                    <td>
                        <span class="materi-badge">
                            Mengenal Ekosistem
                        </span>
                    </td>

                    <td>
                        <span class="jawaban-badge">
                            B
                        </span>
                    </td>

                    <td>

                        <button
                            class="btn-detail"
                            onclick="lihatSoal(
                                'Manakah yang termasuk komponen biotik?',
                                'Mengenal Ekosistem',
                                'Tumbuhan',
                                'Air',
                                'Batu',
                                'Cahaya matahari',
                                'A'
                            )">
                            Lihat
                        </button>

                        <button
                            class="btn-edit"
                            onclick="openEditModal(
                                'Manakah yang termasuk komponen biotik?',
                                'Mengenal Ekosistem',
                                'Air',
                                'Tumbuhan',
                                'Batu',
                                'Cahaya matahari',
                                'B'
                            )">
                            Edit
                        </button>

                        <button
                            class="btn-delete"
                            onclick="hapusSoal()">
                            Hapus
                        </button>

                    </td>

                </tr>


                <!-- soal 3 -->
                <tr>

                    <td>3</td>

                    <td>
                        Hubungan antara dua makhluk hidup yang saling menguntungkan disebut?
                    </td>

                    <td>
                        <span class="materi-badge">
                            Interaksi Ekosistem
                        </span>
                    </td>

                    <td>
                        <span class="jawaban-badge">
                            C
                        </span>
                    </td>

                    <td>

                        <button
                            class="btn-detail"
                            onclick="lihatSoal(
                                'Hubungan antara dua makhluk hidup yang saling menguntungkan disebut?',
                                'Interaksi Ekosistem',
                                'Mutualisme',
                                'Kompetisi',
                                'Predasi',
                                'Parasitisme',
                                'A'
                            )">
                            Lihat
                        </button>

                        <button
                            class="btn-edit"
                            onclick="openEditModal(
                                'Hubungan antara dua makhluk hidup yang saling menguntungkan disebut?',
                                'Interaksi Ekosistem',
                                'Mutualisme',
                                'Kompetisi',
                                'Predasi',
                                'Parasitisme',
                                'A'
                            )">
                            Edit
                        </button>

                        <button
                            class="btn-delete"
                            onclick="hapusSoal()">
                            Hapus
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</div>


<!-- tambah/edit soal -->

<div class="modal" id="soalModal">

```
<div class="modal-content">

    <div class="modal-header">

        <div>
            <h2 id="modalTitle">Tambah Soal</h2>
            <p>Masukkan pertanyaan dan pilihan jawaban.</p>
        </div>

        <button class="btn-close" onclick="closeModal()">
            ×
        </button>

    </div>


    <!-- pertanyaan -->

    <div class="form-group">

        <label>Pertanyaan</label>

        <textarea
            id="pertanyaan"
            placeholder="Masukkan pertanyaan kuis"></textarea>

    </div>


    <!-- materi -->

    <div class="form-group">

        <label>Materi</label>

        <select id="materi">

            <option value="">
                Pilih Materi
            </option>

            <option>
                Mengenal Ekosistem
            </option>

            <option>
                Interaksi dalam Ekosistem
            </option>

            <option>
                Rantai Makanan
            </option>

        </select>

    </div>


    <!-- pilihan A -->
    <div class="form-group">
        <label>Pilihan A</label>
        <input
            type="text"
            id="pilihanA"
            placeholder="Masukkan pilihan A">
    </div>


    <!-- pilihan B -->
    <div class="form-group">
        <label>Pilihan B</label>
        <input
            type="text"
            id="pilihanB"
            placeholder="Masukkan pilihan B">
    </div>


    <!-- pilihan C -->
    <div class="form-group">
        <label>Pilihan C</label>
        <input
            type="text"
            id="pilihanC"
            placeholder="Masukkan pilihan C">
    </div>


    <!-- pilihan D -->
    <div class="form-group">
        <label>Pilihan D</label>
        <input
            type="text"
            id="pilihanD"
            placeholder="Masukkan pilihan D">
    </div>


    <!-- jawaban -->
    <div class="form-group">
        <label>Jawaban Benar</label>
        <select id="jawaban">
            <option value="">
                Pilih Jawaban
            </option>

            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>

        </select>

    </div>


    <!-- tombol -->
    <div class="modal-footer">
        <button
            class="btn-batal"
            onclick="closeModal()">
            Batal
        </button>

        <button
            class="btn-simpan"
            onclick="saveSoal()">
            Simpan
        </button>

    </div>

</div>

</div>


<!--  lihat soal -->
<div class="modal" id="lihatModal">
<div class="modal-content">
    <div class="modal-header">
        <div>
            <h2>Detail Soal</h2>
            <p>Informasi lengkap soal kuis.</p>
        </div>

        <button
            class="btn-close"
            onclick="closeLihatModal()">
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
            <strong
                class="jawaban-detail"
                id="detailJawaban">
            </strong>
        </div>
    </div>

</div>
</div>

<style>


/* HALAMAN */
.soal-page {
    padding-bottom: 30px;
}


/* header */
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


/* tombol tambah */
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


/* ringkasan */
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

.summary-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background-color: #d8f3dc;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
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



/* box soal */
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


/* table */
.table-container {

    overflow-x: auto;

}

table {

    width: 100%;

    border-collapse: collapse;

}

thead {

    background-color: #ABE7B2;

}

th {

    padding: 14px;

    text-align: left;

    color: #2d6a4f;

    font-size: 13px;

}

td {

    padding: 15px 14px;

    border-bottom: 1px solid #eeeeee;

    color: #555;

    font-size: 14px;

    vertical-align: middle;

}

tbody tr:hover {

    background-color: #fafdfb;

}


/* latar belakaang tombol materi */

.materi-badge {

    display: inline-block;

    padding: 5px 10px;

    background-color: #FF788D;

    color: #FFFFFF;

    border-radius: 20px;

    font-size: 11px;

    font-weight: 600;

}

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


/* BUTTON AKSI */

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


/* MODAL FOOTER */

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

.detail-item > span {

    display: block;

    color: #888;

    font-size: 12px;

    margin-bottom: 6px;

}

.detail-item > p {

    margin: 0;

    color: #333;

    line-height: 1.6;

}

.pilihan-list {

    background-color: #f8faf9;

    border-radius: 10px;

    padding: 10px 15px;

}

.pilihan-list p {

    margin: 10px 0;

    color: #555;

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

    th,
    td {

        white-space: nowrap;

    }

}

</style>

<script>

/* TAMBAH SOAL */
function openModal() {

    document.getElementById('modalTitle').innerText = 'Tambah Soal';

    document.getElementById('pertanyaan').value = '';

    document.getElementById('materi').value = '';

    document.getElementById('pilihanA').value = '';

    document.getElementById('pilihanB').value = '';

    document.getElementById('pilihanC').value = '';

    document.getElementById('pilihanD').value = '';

    document.getElementById('jawaban').value = '';

    document.getElementById('soalModal').style.display = 'flex';

}


/* EDIT SOAL */
function openEditModal(
    pertanyaan,
    materi,
    pilihanA,
    pilihanB,
    pilihanC,
    pilihanD,
    jawaban
) {

    document.getElementById('modalTitle').innerText = 'Edit Soal';

    document.getElementById('pertanyaan').value = pertanyaan;

    document.getElementById('materi').value = materi;

    document.getElementById('pilihanA').value = pilihanA;

    document.getElementById('pilihanB').value = pilihanB;

    document.getElementById('pilihanC').value = pilihanC;

    document.getElementById('pilihanD').value = pilihanD;

    document.getElementById('jawaban').value = jawaban;

    document.getElementById('soalModal').style.display = 'flex';

}



/* TUTUP MODAL */
function closeModal() {

    document.getElementById('soalModal').style.display = 'none';

}



/* SIMPAN SOAL */
function saveSoal() {

    alert('Soal berhasil disimpan!');

    closeModal();

}


/* HAPUS SOAL */
function hapusSoal() {

    if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {

        alert('Soal berhasil dihapus!');

    }

}


/* LIHAT SOAL */
function lihatSoal(
    pertanyaan,
    materi,
    pilihanA,
    pilihanB,
    pilihanC,
    pilihanD,
    jawaban
) {

    document.getElementById('detailPertanyaan').innerText = pertanyaan;

    document.getElementById('detailMateri').innerText = materi;

    document.getElementById('detailA').innerText = pilihanA;

    document.getElementById('detailB').innerText = pilihanB;

    document.getElementById('detailC').innerText = pilihanC;

    document.getElementById('detailD').innerText = pilihanD;

    document.getElementById('detailJawaban').innerText = jawaban;

    document.getElementById('lihatModal').style.display = 'flex';

}


/* TUTUP DETAIL */
function closeLihatModal() {

    document.getElementById('lihatModal').style.display = 'none';

}

</script>

@endsection
