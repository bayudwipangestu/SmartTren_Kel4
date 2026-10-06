<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Presensi Mahasantri - SmartTren</title>

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
            background: linear-gradient(
                135deg,
                #166534,
                #15803d
            );

            color: white;

            padding: 30px;

            border-radius: 18px;

            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
        }

        .header p {
            margin: 10px 0 0;
            opacity: .9;
        }

        .grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.07);
        }

        .card h2 {
            margin-top: 0;
            color: #166534;
            font-size: 20px;
        }

        .qr-card {
            text-align: center;
        }

        .qr-box {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #f9fafb;
            border-radius: 15px;
            margin: 20px 0;
        }

        .qr-code {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            word-break: break-all;
        }

        .info {
            padding: 15px;
            background: #f9fafb;
            border-radius: 10px;
            margin-top: 10px;
        }

        .label {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .value {
            font-weight: bold;
            color: #111827;
        }

        .session {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .session h3 {
            margin: 0;
            color: #111827;
            font-size: 18px;
        }

        .badge {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
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

        @media(max-width: 800px) {

            .grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

<div class="container">

    {{-- KEMBALI KE DASHBOARD --}}

    <a
        href="{{ route('mahasantri.dashboard') }}"
        class="back"
    >
        ← Kembali ke Dashboard
    </a>


    {{-- HEADER --}}

    <div class="header">

        <h1>
            Presensi Kegiatan
        </h1>

        <p>
            Tunjukkan QR Code Anda kepada Pengurus
            untuk melakukan presensi.
        </p>

    </div>


    <div class="grid">


        {{-- KOLOM KIRI --}}

        <div>


            {{-- QR CODE --}}

            <div class="card qr-card">

                <h2>
                    QR Code Presensi
                </h2>

                <div class="qr-box">

                    {!! QrCode::size(250)
                        ->margin(1)
                        ->generate($mahasantri->qr_code) !!}

                </div>

                <div class="qr-code">

                    {{ $mahasantri->qr_code }}

                </div>

                <p style="color:#6b7280;">

                    Tunjukkan QR Code ini
                    kepada Pengurus saat presensi.

                </p>

            </div>


            {{-- DATA MAHASANTRI --}}

            <div class="card">

                <h2>
                    Data Mahasantri
                </h2>


                <div class="info">

                    <span class="label">
                        Nama
                    </span>

                    <span class="value">

                        {{ $mahasantri->user->name ?? '-' }}

                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        NIM
                    </span>

                    <span class="value">

                        {{ $mahasantri->nim }}

                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        Email
                    </span>

                    <span class="value">

                        {{ $mahasantri->user->email ?? '-' }}

                    </span>

                </div>

            </div>

        </div>


        {{-- KOLOM KANAN --}}

        <div class="card">

            <h2>
                Kegiatan Hari Ini
            </h2>


            @if($sesiAktif->count() > 0)


                @foreach($sesiAktif as $sesi)

                    <div class="session">

                        <h3>

                            {{ $sesi->kegiatan->nama_kegiatan ?? 'Kegiatan' }}

                        </h3>


                        <p>

                            📅

                            {{ $sesi->tanggal->format('d-m-Y') }}

                        </p>


                        <p>

                            🕐

                            {{ $sesi->jam_mulai }}

                            -

                            {{ $sesi->jam_selesai }}

                        </p>


                        <span class="badge">

                            ● PRESENSI AKTIF

                        </span>

                    </div>

                @endforeach


            @else


                <div class="empty">

                    <h3>
                        Belum Ada Sesi Presensi
                    </h3>

                    <p>

                        Belum ada kegiatan
                        yang membuka presensi hari ini.

                    </p>

                </div>


            @endif

        </div>


    </div>

</div>

</body>

</html>