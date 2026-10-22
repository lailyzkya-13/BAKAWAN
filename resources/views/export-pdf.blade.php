
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Laporan Hasil Evaluasi BAKAWAN</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #1b4332;
            margin-bottom: 5px;
        }

        .subjudul {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #d8f3dc;
            color: #1b4332;
        }

        .nama {
            text-align: left;
        }

        .tanggal {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>

<body>

    <h2>LAPORAN HASIL EVALUASI SISWA</h2>

    <p class="subjudul">
        BAKAWAN - Belajar Asyik Kenali Alam dan Warisan Banua
    </p>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jumlah Kuis</th>
                <th>Rata-rata Nilai</th>
                <th>Nilai Terakhir</th>
            </tr>
        </thead>

        <tbody>

            @forelse($daftarSiswa as $siswa)

                @php
                    // Mengambil riwayat kuis setiap siswa
                    $riwayat = $hasilPerSiswa->get(
                        $siswa->id,
                        collect()
                    );

                    // Menghitung nilai rata-rata
                    $rataRata = $riwayat->avg('nilai');

                    // Mengambil nilai terakhir
                    $nilaiTerakhir = $riwayat->first()?->nilai;
                @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="nama">
                        {{ $siswa->nama_lengkap }}
                    </td>

                    <td>
                        {{ $siswa->kelas }}
                    </td>

                    <td>
                        {{ $riwayat->count() }}
                    </td>

                    <td>
                        {{ $rataRata !== null
                            ? number_format($rataRata, 2, ',', '.')
                            : '-' }}
                    </td>

                    <td>
                        {{ $nilaiTerakhir !== null
                            ? number_format($nilaiTerakhir, 2, ',', '.')
                            : '-' }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        Belum ada data siswa.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <p class="tanggal">
        Dicetak pada:
        {{ now()->format('d-m-Y H:i') }}
    </p>

</body>
</html>
