<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Presensi SmartTrenMJ</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h2, p {
            text-align: center;
            margin: 4px 0;
        }

        .summary {
            margin: 18px 0;
            width: 100%;
        }

        .summary td {
            padding: 6px;
            border: 1px solid #ccc;
            text-align: center;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        .data th, .data td {
            border: 1px solid #777;
            padding: 6px;
            text-align: left;
        }

        .data th {
            background-color: #e8eee8;
            text-align: center;
        }

        .data td.center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>LAPORAN PRESENSI SMARTTRENMJ</h2>
    <p>Sistem Informasi Presensi Mahasantri</p>
    <p>Periode: {{ $periode ?? '-' }}</p>

    <table class="summary">
        <tr>
            <td><strong>Total Data</strong><br>{{ $total ?? 0 }}</td>
            <td><strong>Hadir</strong><br>{{ $hadir ?? 0 }}</td>
            <td><strong>Izin</strong><br>{{ $izin ?? 0 }}</td>
            <td><strong>Sakit</strong><br>{{ $sakit ?? 0 }}</td>
            <td><strong>Alpa</strong><br>{{ $alpa ?? 0 }}</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mahasantri</th>
                <th>NIM/NIS</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th>Waktu Presensi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($presensi as $item)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasantri->nama ?? '-' }}</td>
                    <td>{{ $item->mahasantri->nim ?? $item->mahasantri->nis ?? '-' }}</td>
                    <td>{{ $item->sesiPresensi->kegiatan->nama_kegiatan
                        ?? $item->sesiPresensi->kegiatan->nama
                        ?? '-' }}</td>
                    <td>
                        {{ $item->sesiPresensi->tanggal
                            ?? $item->created_at?->format('d-m-Y')
                            ?? '-' }}
                    </td>
                    <td>
                        {{ $item->waktu_presensi
                            ?? $item->created_at?->format('H:i')
                            ?? '-' }}
                    </td>
                    <td>{{ ucfirst($item->status ?? '-') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="center">
                        Tidak ada data presensi pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="text-align:right; margin-top:25px;">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </p>

</body>
</html>
