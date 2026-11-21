@extends('layouts.app-guru')

@section('content')

<div class="pb-page">

    <!-- HEADER -->
    <div class="pb-header">
        <div>
            <h1>Petualangan Si Bangau</h1>
            <p>Kelola misi, objek permainan, dan pertanyaan Aktivitas 3.</p>
        </div>

        <a href="{{ route('guru.aktivitas.beranda') }}" class="pb-back">
            Kembali
        </a>
    </div>

    <!-- PESAN SUKSES -->
    @if (session('success'))
        <div class="pb-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if (session('error'))
        <div class="pb-error">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="pb-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- FORM TAMBAH MISI -->
    <div class="pb-panel">

        <h2>Tambah Misi Baru</h2>

        <form action="{{ route('guru.aktivitas.tiga.misi.store') }}"
              method="POST">

            @csrf

            <div class="pb-grid">

                <div class="pb-field">
                    <label>Nama Misi</label>
                    <input type="text" name="nama"
                           placeholder="Masukkan nama misi" required>
                </div>

                <div class="pb-field">
                    <label>Urutan Misi</label>
                    <input type="number" name="urutan"
                           min="1" value="4" required>
                </div>

                <div class="pb-field">
                    <label>Background Index</label>
                    <input type="number" name="background_index"
                           min="0" max="10" value="0" required>
                </div>

                <div class="pb-field">
                    <label>Platform Layout</label>
                    <input type="number" name="platform_layout"
                           min="0" max="10" value="0" required>
                </div>

                <div class="pb-field pb-full">
                    <label>Tutorial Misi</label>
                    <textarea name="tutorial" rows="3"
                              placeholder="Jelaskan cara menyelesaikan misi..."
                              required></textarea>
                </div>

                <div class="pb-field pb-full">
                    <label>Fakta Pembelajaran</label>
                    <textarea name="fakta" rows="3"
                              placeholder="Masukkan fakta pembelajaran..."></textarea>
                </div>

            </div>

            <label class="pb-check">
                <input type="checkbox" name="aktif" value="1" checked>
                Misi aktif
            </label>

            <button type="submit" class="pb-button">
                + Tambah Misi
            </button>

        </form>

    </div>


    <!-- DAFTAR MISI -->
    <div class="pb-list">

        @forelse ($daftarMisi as $misi)

            <div class="pb-mission">

                <div class="pb-mission-header">
                    <div>
                        <span class="pb-label">
                            Misi {{ $misi->urutan }}
                        </span>

                        <h2>{{ $misi->nama }}</h2>

                        <p>
                            {{ $misi->tutorial }}
                        </p>
                    </div>

                    @if ($misi->aktif)
                        <span class="pb-status">Aktif</span>
                    @else
                        <span class="pb-status pb-inactive">Nonaktif</span>
                    @endif
                </div>


                <!-- EDIT MISI -->
                <details class="pb-details">

                    <summary>Edit Informasi Misi</summary>

                    <form
                        action="{{ route('guru.aktivitas.tiga.misi.update', $misi->id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="pb-grid">

                            <div class="pb-field">
                                <label>Nama Misi</label>
                                <input type="text" name="nama"
                                       value="{{ $misi->nama }}" required>
                            </div>

                            <div class="pb-field">
                                <label>Urutan</label>
                                <input type="number" name="urutan"
                                       min="1" value="{{ $misi->urutan }}" required>
                            </div>

                            <div class="pb-field">
                                <label>Background Index</label>
                                <input type="number" name="background_index"
                                       min="0" max="10"
                                       value="{{ $misi->background_index }}" required>
                            </div>

                            <div class="pb-field">
                                <label>Platform Layout</label>
                                <input type="number" name="platform_layout"
                                       min="0" max="10"
                                       value="{{ $misi->platform_layout }}" required>
                            </div>

                            <div class="pb-field pb-full">
                                <label>Tutorial</label>
                                <textarea name="tutorial" rows="3"
                                          required>{{ $misi->tutorial }}</textarea>
                            </div>

                            <div class="pb-field pb-full">
                                <label>Fakta Pembelajaran</label>
                                <textarea name="fakta" rows="3">{{ $misi->fakta }}</textarea>
                            </div>

                        </div>

                        <label class="pb-check">
                            <input type="checkbox" name="aktif" value="1"
                                   {{ $misi->aktif ? 'checked' : '' }}>
                            Misi aktif
                        </label>

                        <button type="submit" class="pb-button">
                            Simpan Perubahan
                        </button>

                    </form>

                </details>


                <!-- HAPUS MISI -->
                <form
                    action="{{ route('guru.aktivitas.tiga.misi.destroy', $misi->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus misi ini? Semua item dan pertanyaan di dalamnya juga akan dihapus.')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="pb-delete">
                        Hapus Misi
                    </button>

                </form>


                <!-- DAFTAR ITEM -->
                <div class="pb-items">

                    <h3>Objek dan Pertanyaan Permainan</h3>

                    <p class="pb-muted">
                        Total {{ $misi->items->count() }} item permainan.
                    </p>

                    @forelse ($misi->items as $item)

                        <details class="pb-item">

                            <summary>
                                <strong>{{ $item->label }}</strong>
                                <span>{{ ucfirst($item->jenis) }}</span>
                            </summary>

                            <form
                                class="item-form"
                                action="{{ route('guru.aktivitas.tiga.item.update', $item->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <div class="pb-grid">

                                    <div class="pb-field">
                                        <label>Kode Item</label>
                                        <input type="text" name="kode"
                                               value="{{ $item->kode }}" required>
                                    </div>

                                    <div class="pb-field">
                                        <label>Jenis Item</label>
                                        <select name="jenis" class="jenis-item" required>
                                            @foreach ([
                                                'fish' => 'Ikan',
                                                'quiz' => 'Pertanyaan',
                                                'hazard' => 'Rintangan',
                                                'goal' => 'Tujuan',
                                                'trash' => 'Sampah',
                                                'animal' => 'Hewan',
                                                'post' => 'Pos',
                                            ] as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ $item->jenis === $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="pb-field">
                                        <label>Nama Item</label>
                                        <input type="text" name="label"
                                               value="{{ $item->label }}" required>
                                    </div>

                                    <div class="pb-field">
                                        <label>Asset Key</label>
                                        <input type="text" name="asset_key"
                                               value="{{ $item->asset_key }}" required>
                                    </div>

                                    <div class="pb-field">
                                        <label>Posisi X (%)</label>
                                        <input type="number" name="posisi_x"
                                               min="0" max="100"
                                               value="{{ $item->posisi_x }}" required>
                                    </div>

                                    <div class="pb-field">
                                        <label>Posisi Y (%)</label>
                                        <input type="number" name="posisi_y"
                                               min="0" max="100"
                                               value="{{ $item->posisi_y }}" required>
                                    </div>

                                    <div class="pb-field">
                                        <label>Poin</label>
                                        <input type="number" name="poin"
                                               min="0" value="{{ $item->poin }}">
                                    </div>

                                    <div class="pb-field">
                                        <label>Urutan</label>
                                        <input type="number" name="urutan"
                                               min="1" value="{{ $item->urutan }}" required>
                                    </div>

                                </div>

                                <!-- FORM PERTANYAAN -->
                                <div class="question-fields"
                                     @if ($item->jenis !== 'quiz') hidden @endif>

                                    <h4>Pengaturan Pertanyaan</h4>

                                    <div class="pb-field">
                                        <label>Pertanyaan</label>
                                        <textarea name="pertanyaan" rows="3">{{ $item->pertanyaan?->pertanyaan }}</textarea>
                                    </div>

                                    <div class="pb-field">
                                        <label>Pilihan Jawaban</label>
                                        <textarea name="pilihan_jawaban_text"
                                                  rows="4"
                                                  placeholder="Satu pilihan per baris">{{ implode("\n", $item->pertanyaan?->pilihan_jawaban ?? []) }}</textarea>
                                        <small>Masukkan 2 sampai 4 pilihan, satu pilihan per baris.</small>
                                    </div>

                                    <div class="pb-field">
                                        <label>Indeks Jawaban Benar</label>

                                        <select name="jawaban_benar">
                                            @foreach ([0, 1, 2, 3] as $index)
                                                <option value="{{ $index }}"
                                                    {{ $item->pertanyaan && $item->pertanyaan->jawaban_benar === $index ? 'selected' : '' }}>
                                                    {{ $index }} - Pilihan {{ chr(65 + $index) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <small>Contoh: 0 berarti pilihan A.</small>
                                    </div>

                                    <div class="pb-field">
                                        <label>Penjelasan Jawaban</label>
                                        <textarea name="penjelasan" rows="3">{{ $item->pertanyaan?->penjelasan }}</textarea>
                                    </div>

                                </div>

                                <label class="pb-check">
                                    <input type="checkbox" name="aktif" value="1"
                                           {{ $item->aktif ? 'checked' : '' }}>
                                    Item aktif
                                </label>

                                <button type="submit" class="pb-button">
                                    Simpan Item
                                </button>

                            </form>

                            <form
                                action="{{ route('guru.aktivitas.tiga.item.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus item ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="pb-delete">
                                    Hapus Item
                                </button>

                            </form>

                        </details>

                    @empty

                        <p class="pb-muted">
                            Belum ada objek permainan.
                        </p>

                    @endforelse

                </div>


                <!-- TAMBAH ITEM -->
                <div class="pb-add-item">

                    <h3>Tambah Objek Permainan</h3>

                    <form
                        class="item-form"
                        action="{{ route('guru.aktivitas.tiga.item.store', $misi->id) }}"
                        method="POST">

                        @csrf

                        <div class="pb-grid">

                            <div class="pb-field">
                                <label>Kode Item</label>
                                <input type="text" name="kode"
                                       placeholder="Contoh: fish5" required>
                            </div>

                            <div class="pb-field">
                                <label>Jenis Item</label>
                                <select name="jenis" class="jenis-item" required>
                                    <option value="fish">Ikan</option>
                                    <option value="quiz">Pertanyaan</option>
                                    <option value="hazard">Rintangan</option>
                                    <option value="goal">Tujuan</option>
                                    <option value="trash">Sampah</option>
                                    <option value="animal">Hewan</option>
                                    <option value="post">Pos</option>
                                </select>
                            </div>

                            <div class="pb-field">
                                <label>Nama Item</label>
                                <input type="text" name="label"
                                       placeholder="Nama objek" required>
                            </div>

                            <div class="pb-field">
                                <label>Asset Key</label>
                                <input type="text" name="asset_key"
                                       placeholder="Contoh: ikan" required>
                            </div>

                            <div class="pb-field">
                                <label>Posisi X (%)</label>
                                <input type="number" name="posisi_x"
                                       min="0" max="100" value="50" required>
                            </div>

                            <div class="pb-field">
                                <label>Posisi Y (%)</label>
                                <input type="number" name="posisi_y"
                                       min="0" max="100" value="70" required>
                            </div>

                            <div class="pb-field">
                                <label>Poin</label>
                                <input type="number" name="poin"
                                       min="0" value="10">
                            </div>

                            <div class="pb-field">
                                <label>Urutan</label>
                                <input type="number" name="urutan"
                                       min="1" value="{{ $misi->items->count() + 1 }}" required>
                            </div>

                        </div>

                        <div class="question-fields" hidden>

                            <h4>Pengaturan Pertanyaan</h4>

                            <div class="pb-field">
                                <label>Pertanyaan</label>
                                <textarea name="pertanyaan" rows="3"></textarea>
                            </div>

                            <div class="pb-field">
                                <label>Pilihan Jawaban</label>
                                <textarea name="pilihan_jawaban_text"
                                          rows="4"
                                          placeholder="Satu pilihan per baris"></textarea>
                                <small>Masukkan 2 sampai 4 pilihan, satu pilihan per baris.</small>
                            </div>

                            <div class="pb-field">
                                <label>Indeks Jawaban Benar</label>
                                <select name="jawaban_benar">
                                    <option value="0">0 - Pilihan A</option>
                                    <option value="1">1 - Pilihan B</option>
                                    <option value="2">2 - Pilihan C</option>
                                    <option value="3">3 - Pilihan D</option>
                                </select>
                            </div>

                            <div class="pb-field">
                                <label>Penjelasan Jawaban</label>
                                <textarea name="penjelasan" rows="3"></textarea>
                            </div>

                        </div>

                        <label class="pb-check">
                            <input type="checkbox" name="aktif" value="1" checked>
                            Item aktif
                        </label>

                        <button type="submit" class="pb-button">
                            + Tambah Item
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="pb-empty">
                <h3>Belum ada misi</h3>
                <p>Silakan tambahkan misi pertama.</p>
            </div>

        @endforelse

    </div>

</div>


<style>

    .pb-page {
        padding-bottom: 35px;
        color: #34483d;
    }

    .pb-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .pb-header h1 {
        color: #1b4332;
        font-size: 27px;
        margin: 0 0 5px;
    }

    .pb-header p {
        color: #777;
        font-size: 14px;
        margin: 0;
    }

    .pb-back {
        background: #e8f5ec;
        color: #2d6a4f;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .pb-panel,
    .pb-mission {
        background: white;
        padding: 22px;
        border-radius: 14px;
        margin-bottom: 22px;
        box-shadow: 0 3px 10px rgba(0,0,0,.05);
        min-width: 0;
    }

    .pb-panel h2,
    .pb-mission h2 {
        color: #1b4332;
        margin-top: 0;
    }

    .pb-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .pb-field {
        margin-bottom: 14px;
        min-width: 0;
    }

    .pb-full {
        grid-column: 1 / -1;
    }

    .pb-field label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
        font-size: 13px;
        color: #355c46;
    }

    .pb-field input,
    .pb-field select,
    .pb-field textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        font: inherit;
        font-size: 13px;
        background: #fff;
        color: #34483d;
    }

    .pb-field textarea {
        resize: vertical;
        line-height: 1.6;
    }

    .pb-field input:focus,
    .pb-field select:focus,
    .pb-field textarea:focus {
        outline: none;
        border-color: #2d6a4f;
    }

    .pb-check {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 12px 0 16px;
        font-size: 13px;
    }

    .pb-button {
        background: #2d6a4f;
        color: white;
        padding: 11px 17px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .pb-button:hover {
        background: #1b4332;
    }

    .pb-delete {
        background: #ffe5e8;
        color: #b42342;
        padding: 9px 14px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 10px;
    }

    .pb-success {
        padding: 14px;
        background: #d8f3dc;
        color: #1b4332;
        border-radius: 9px;
        margin-bottom: 18px;
    }

    .pb-error {
        padding: 14px;
        background: #ffe5e5;
        color: #842029;
        border-radius: 9px;
        margin-bottom: 18px;
    }

    .pb-mission {
        border-left: 5px solid #2d6a4f;
    }

    .pb-mission-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .pb-mission-header h2 {
        margin: 10px 0 6px;
    }

    .pb-mission-header p {
        color: #777;
        font-size: 13px;
        line-height: 1.6;
    }

    .pb-label {
        background: #d8f3dc;
        color: #2d6a4f;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .pb-status {
        background: #d8f3dc;
        color: #1b4332;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .pb-inactive {
        background: #ffe5e5;
        color: #842029;
    }

    .pb-details,
    .pb-item {
        border: 1px solid #e5ebe7;
        border-radius: 9px;
        padding: 13px;
        margin-top: 15px;
    }

    .pb-details summary,
    .pb-item summary {
        cursor: pointer;
        font-weight: 600;
        color: #2d6a4f;
    }

    .pb-details form,
    .pb-item form {
        margin-top: 17px;
    }

    .pb-items {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #e5ebe7;
    }

    .pb-items h3,
    .pb-add-item h3 {
        color: #1b4332;
        font-size: 17px;
    }

    .pb-muted {
        color: #888;
        font-size: 13px;
    }

    .pb-item summary {
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .pb-item summary span {
        font-size: 12px;
        color: #888;
    }

    .question-fields {
        background: #f4faf5;
        padding: 16px;
        border-radius: 10px;
        margin: 15px 0;
    }

    .question-fields[hidden] {
        display: none !important;
    }

    .question-fields h4 {
        color: #1b4332;
        margin-top: 0;
    }

    .pb-field small {
        display: block;
        color: #888;
        margin-top: 5px;
    }

    .pb-add-item {
        margin-top: 25px;
        padding: 20px;
        background: #f8fbf8;
        border-radius: 12px;
    }

    .pb-empty {
        background: white;
        padding: 35px;
        text-align: center;
        border-radius: 12px;
    }

    @media (max-width: 600px) {
        .pb-grid {
            grid-template-columns: 1fr;
        }

        .pb-header {
            flex-wrap: wrap;
        }

        .pb-header h1 {
            font-size: 22px;
        }

        .pb-panel,
        .pb-mission {
            padding: 16px;
        }

        .pb-mission-header {
            flex-direction: column;
        }

        .pb-add-item {
            padding: 13px;
        }
    }

</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.item-form').forEach(function (form) {

        const jenis = form.querySelector('.jenis-item');
        const pertanyaan = form.querySelector('.question-fields');

        if (!jenis || !pertanyaan) {
            return;
        }

        function perbaruiTampilan() {
            pertanyaan.hidden = jenis.value !== 'quiz';
        }

        jenis.addEventListener('change', perbaruiTampilan);

        perbaruiTampilan();
    });

});
</script>

@endsection
