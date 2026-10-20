
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Presensi SmartTrenMJ</title>
    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h1 {
            margin: 0 0 5px;
            font-size: 19px;
            text-align: center;
        }

        .subtitle {
            margin-bottom: 20px;
            text-align: center;
            color: #555;
        }

        .info {
            margin-bottom: 14px;
            line-height: 1.7;
        }

        .summary {
            width: 100%;
            margin-bottom: 18px;
            border-collapse: collapse;
        }

        .summary td {
            width: 20%;
            padding: 9px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .summary strong {
            display: block;
            margin-bottom: 4px;
            font-size: 15px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        .data th,
        .data td {
            border: 1px solid #ccc;
            padding: 7px;
            text-align: left;
        }

        .data th {
            background: #e9f5ed;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #555;
            text-align: right;
        }
    </style>
</head>
<body>

    <h1>REKAP PRESENSI MAHASANTRI</h1>
    <div class="subtitle">Sistem Presensi SmartTrenMJ</div>

    <div class="info">
        <strong>Periode:</strong>
        {{ $filters['dari'] ?? 'Semua tanggal' }}
        sampai
        {{ $filters['sampai'] ?? 'Semua tanggal' }}
        <br>

        <strong>Kegiatan:</strong>
        @if(!empty($filters['kegiatan_id']))
            {{ $kegiatan->firstWhere('id', (int) $filters['kegiatan_id'])?->nama_kegiatan ?? '-' }}
        @else
            Semua kegiatan
        @endif
        <br>

        <strong>Kamar:</strong> {{ $filters['kamar'] ?? 'Semua kamar' }}
        <br>

        <strong>Pencarian:</strong> {{ $filters['search'] ?? 'Semua Mahasantri' }}
        <br>

        <strong>Filter status:</strong> {{ ucfirst($filters['status'] ?? 'semua status') }}
        <br>

        <strong>Tanggal cetak:</strong> {{ now()->format('d/m/Y H:i') }}
    </div>

    <table class="summary">
        <tr>
            <td><strong>{{ $statistik['total'] }}</strong>Total Presensi</td>
            <td><strong>{{ $statistik['hadir'] }}</strong>Hadir</td>
            <td><strong>{{ $statistik['izin'] }}</strong>Izin</td>
            <td><strong>{{ $statistik['sakit'] }}</strong>Sakit</td>
            <td><strong>{{ $statistik['alpa'] }}</strong>Alpa</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 4%">No.</th>
                <th>Nama Mahasantri</th>
                <th>NIM</th>
                <th>Kamar</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasantri?->nama ?? '-' }}</td>
                    <td>{{ $item->mahasantri?->nim ?? '-' }}</td>
                    <td>{{ $item->mahasantri?->kamar ?? '-' }}</td>
                    <td>{{ $item->sesiPresensi?->kegiatan?->nama_kegiatan ?? '-' }}</td>
                    <td>{{ $item->sesiPresensi?->tanggal?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $item->keterangan ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center">
                        Tidak ada data presensi sesuai filter.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen dibuat secara otomatis oleh SmartTrenMJ.
    </div>

</body>
</html>
