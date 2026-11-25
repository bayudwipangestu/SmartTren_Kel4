<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasantri - SmartTren</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f0fdf4;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 18px;
            background: #166534;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .back:hover {
            background: #14532d;
        }

        .header {
            background: linear-gradient(135deg, #166534, #15803d);
            color: white;
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
        }

        .header p {
            margin: 10px 0 0;
            opacity: .9;
        }

        .btn-add {
            display: inline-block;
            padding: 12px 20px;
            background: #ffffff;
            color: #166534;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .07);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f0fdf4;
            color: #166534;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            background: #dcfce7;
            color: #166534;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            background: #f9fafb;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    @php
        $listMahasantri = $mahasantris ?? ($mahasantri ?? ($data ?? collect()));
    @endphp

    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="back">← Kembali ke Dashboard</a>

        <div class="header">
            <div>
                <h1>Data Mahasantri</h1>
                <p>Kelola data mahasantri, identitas, dan informasi akun pada sistem SmartTren.</p>
            </div>
            @if (Route::has('admin.mahasantri.create'))
                <a href="{{ route('admin.mahasantri.create') }}" class="btn-add">+ Tambah Mahasantri</a>
            @endif
        </div>

        <div class="card">
            @if (count($listMahasantri) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>QR Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listMahasantri as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? ($item->nama ?? ($item->name ?? '-')) }}</td>
                                <td>{{ $item->nim ?? '-' }}</td>
                                <td>{{ $item->user->email ?? ($item->email ?? '-') }}</td>
                                <td>
                                    <span class="badge">{{ $item->qr_code ?? '-' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty">
                    <h3>Belum Ada Data Mahasantri</h3>
                    <p>Data mahasantri belum tersedia di dalam sistem.</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>