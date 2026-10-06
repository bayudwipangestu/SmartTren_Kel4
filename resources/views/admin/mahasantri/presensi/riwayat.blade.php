<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Presensi</title>

    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Arial, sans-serif;
            background: #f0fdf4;
            color: #1f2937;
        }

        .box {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        h1 {
            color: #166534;
            margin-top: 0;
        }

        .success {
            padding: 15px;
            background: #dcfce7;
            color: #166534;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .info {
            padding: 15px;
            background: #f9fafb;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: #166534;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="box">

    <h1>
        Riwayat Presensi Mahasantri
    </h1>

    <div class="success">
        HALAMAN RIWAYAT BERHASIL DIBUKA
    </div>

    <div class="info">
        <strong>Nama:</strong>
        {{ $mahasantri->user->name ?? '-' }}
    </div>

    <div class="info">
        <strong>NIM:</strong>
        {{ $mahasantri->nim ?? '-' }}
    </div>

    <div class="info">
        <strong>Total Data Presensi:</strong>
        {{ $presensi->count() }}
    </div>

    <a
        href="{{ route('mahasantri.dashboard') }}"
        class="back"
    >
        ← Kembali ke Dashboard
    </a>

</div>

</body>

</html>