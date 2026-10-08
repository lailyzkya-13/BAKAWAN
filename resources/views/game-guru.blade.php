
@extends('layouts.app-guru')

@section('content')

<div class="game-page">
    <div class="game-header">
        <div>
            <h1>Kelola Game</h1>
            <p>Kelola permainan edukasi BAKAWAN.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="pesan sukses">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="pesan gagal">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- FORM TAMBAH GAME -->
    <div class="form-card">
        <h2>+ Tambah Game</h2>

        <form action="{{ route('game.store') }}"
              method="POST">
            @csrf

            <label>Judul Game</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul') }}"
                   placeholder="Contoh: Mengenal Biotik"
                   required>

            <label>Jenis Game</label>
            <select name="jenis" required>
                <option value="">Pilih jenis permainan</option>
                <option value="memory" @selected(old('jenis') == 'memory')>
                    Memory Card
                </option>
                <option value="pasangkan" @selected(old('jenis') == 'pasangkan')>
                    Pasangkan
                </option>
                <option value="dragdrop" @selected(old('jenis') == 'dragdrop')>
                    Drag and Drop
                </option>
            </select>

            <label>Deskripsi Game</label>
            <textarea name="deskripsi"
                      rows="3"
                      placeholder="Deskripsi permainan">{{ old('deskripsi') }}</textarea>

            <label>Pasangan Soal dan Jawaban</label>
            <textarea name="pasangan"
                      rows="6"
                      required
                      placeholder="Ikan|Biotik&#10;Air|Abiotik&#10;Pohon|Biotik&#10;Batu|Abiotik">{{ old('pasangan') }}</textarea>

            <small>
                Satu pasangan per baris. Pisahkan soal dan
                jawaban dengan tanda |.
                Minimal 2 pasangan.
            </small>

            <button type="submit" class="btn-primary">
                Simpan Game
            </button>
        </form>
    </div>

    <!-- DAFTAR GAME -->
    <h2 class="daftar-title">Daftar Game</h2>

    <div class="game-grid">

        @forelse($games as $game)

            <div class="game-card">

                <div class="game-symbol">
                    @if($game->jenis == 'memory')
                        <i data-lucide="grid-2x2"></i>
                    @elseif($game->jenis == 'pasangkan')
                        <i data-lucide="puzzle"></i>
                    @else
                        <i data-lucide="hand"></i>
                    @endif
                </div>

                <span class="jenis-game">
                    @if($game->jenis == 'memory')
                        Memory Card
                    @elseif($game->jenis == 'pasangkan')
                        Pasangkan
                    @else
                        Drag and Drop
                    @endif
                </span>

                <h3>{{ $game->judul }}</h3>

                <p>{{ $game->deskripsi }}</p>

                <div class="game-actions">
                    <a href="{{ route('game.play', $game->id) }}"
                       class="btn-lihat">
                        Mainkan
                    </a>

                    <button type="button"
                            class="btn-edit"
                            onclick="toggleEdit({{ $game->id }})">
                        Edit
                    </button>

                    <form action="{{ route('game.destroy', $game->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus game ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-hapus">
                            Hapus
                        </button>
                    </form>
                </div>

                <!-- FORM EDIT -->
                <div class="edit-form" id="edit-{{ $game->id }}">
                    <h3>Edit Game</h3>

                    <form action="{{ route('game.update', $game->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <label>Judul</label>
                        <input name="judul"
                               value="{{ $game->judul }}"
                               required>

                        <label>Jenis Game</label>
                        <select name="jenis">
                            <option value="memory"
                                @selected($game->jenis == 'memory')>
                                Memory Card
                            </option>
                            <option value="pasangkan"
                                @selected($game->jenis == 'pasangkan')>
                                Pasangkan
                            </option>
                            <option value="dragdrop"
                                @selected($game->jenis == 'dragdrop')>
                                Drag and Drop
                            </option>
                        </select>

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"
                                  rows="3">{{ $game->deskripsi }}</textarea>

                        <label>Pasangan Soal</label>
                        <textarea name="pasangan"
                                  rows="5"
                                  required>{{ $game->pasangan }}</textarea>

                        <button type="submit" class="btn-primary">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

            </div>

        @empty
            <p>Belum ada game yang ditambahkan.</p>
        @endforelse

    </div>
</div>

<style>
.game-page {
    padding-bottom: 35px;
}

.game-header h1 {
    margin: 0 0 6px;
    color: #1b4332;
}

.game-header p {
    color: #777;
    margin-bottom: 25px;
}

.form-card, .game-card {
    background: white;
    padding: 24px;
    border-radius: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.06);
}

.form-card {
    margin-bottom: 30px;
}

.form-card h2, .daftar-title {
    color: #2d6a4f;
    margin-top: 0;
}

.game-page label {
    display: block;
    font-weight: bold;
    font-size: 14px;
    color: #374151;
    margin: 15px 0 7px;
}

.game-page input,
.game-page select,
.game-page textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 9px;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

.game-page small {
    display: block;
    color: #777;
    margin-top: 8px;
    font-size: 12px;
}

.btn-primary {
    margin-top: 20px;
    padding: 12px 20px;
    background: #2d6a4f;
    color: white;
    border: none;
    border-radius: 9px;
    cursor: pointer;
}

.game-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.game-symbol {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #d8f3dc;
    color: #2d6a4f;
    border-radius: 12px;
    margin-bottom: 15px;
}

.game-symbol svg {
    width: 29px;
    height: 29px;
}

.jenis-game {
    font-size: 12px;
    background: #e8f5e9;
    color: #2d6a4f;
    padding: 6px 10px;
    border-radius: 20px;
}

.game-card h3 {
    color: #1b4332;
    margin-bottom: 8px;
}

.game-card p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}

.game-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
}

.game-actions a,
.game-actions button {
    display: inline-block;
    border: none;
    padding: 9px 13px;
    border-radius: 8px;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
}

.btn-lihat {
    background: #d8f3dc;
    color: #1b4332;
}

.btn-edit {
    background: #fff3cd;
    color: #856404;
}

.btn-hapus {
    background: #f8d7da;
    color: #842029;
}

.edit-form {
    display: none;
    margin-top: 22px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.pesan {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.sukses {
    color: #1b4332;
    background: #d8f3dc;
}

.gagal {
    color: #842029;
    background: #f8d7da;
}

@media (max-width: 850px) {
    .game-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function toggleEdit(id) {
    const form = document.getElementById('edit-' + id);

    if (form.style.display === 'block') {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
}
</script>

<!-- Ikon Lucide -->
<script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.lucide) {
        lucide.createIcons();
    }
});
</script>

@endsection
