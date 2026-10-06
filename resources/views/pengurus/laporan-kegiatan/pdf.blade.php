<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Laporan {{ $kegiatan->nama_kegiatan }}
    </title>

    <style>

        @page {
            margin: 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 15px;
            font-weight: normal;
        }

        .header p {
            margin: 3px 0;
            color: #555;
        }

        .line {
            border-bottom: 2px solid #222;
            margin-top: 12px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
        }

        .info td {
            padding: 4px;
            border: none;
        }

        .label {
            width: 130px;
            font-weight: bold;
        }

        .statistics {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .statistics td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .stat-title {
            font-weight: bold;
            font-size: 10px;
        }

        .stat-number {
            font-size: 16px;
            font-weight: bold;
            margin-top: 3px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #166534;
            color: white;
            padding: 7px;
            border: 1px solid #14532d;
            text-align: center;
            font-size: 10px;
        }

        .table td {
            padding: 6px;
            border: 1px solid #ccc;
            font-size: 10px;
        }

        .center {
            text-align: center;
        }

        .status {
            font-weight: bold;
        }

        .hadir {
            color: #15803d;
        }

        .izin {
            color: #ca8a04;
        }

        .sakit {
            color: #2563eb;
        }

        .alpa {
            color: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 25px;
            border: 1px solid #ccc;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }

    </style>

</head>

<body>


{{-- HEADER --}}

<div class="header">

    <h1>
        LAPORAN PRESENSI
    </h1>

    <h2>
        {{ $kegiatan->nama_kegiatan }}
    </h2>

    <p>
        Sistem Presensi SmartTren
    </p>

    <div class="line"></div>

</div>


{{-- INFORMASI LAPORAN --}}

<div class="info">

    <table>

        <tr>

            <td class="label">
                Kegiatan
            </td>

            <td>
                :
                {{ $kegiatan->nama_kegiatan }}
            </td>

        </tr>


        <tr>

            <td class="label">
                Periode
            </td>

            <td>
                :
                {{ ucfirst($periode) }}
            </td>

        </tr>


        @if ($periode === 'harian')

            <tr>

                <td class="label">
                    Tanggal
                </td>

                <td>
                    :
                    {{ \Carbon\Carbon::parse($tanggal)
                        ->format('d F Y') }}
                </td>

            </tr>

        @elseif ($periode === 'mingguan')

            <tr>

                <td class="label">
                    Minggu
                </td>

                <td>
                    :
                    {{ \Carbon\Carbon::parse($tanggal)
                        ->startOfWeek()
                        ->format('d F Y') }}

                    s/d

                    {{ \Carbon\Carbon::parse($tanggal)
                        ->endOfWeek()
                        ->format('d F Y') }}
                </td>

            </tr>

        @elseif ($periode === 'bulanan')

            <tr>

                <td class="label">
                    Bulan
                </td>

                <td>
                    :
                    {{ \Carbon\Carbon::parse($tanggal)
                        ->format('F Y') }}
                </td>

            </tr>

        @elseif ($periode === 'rentang')

            <tr>

                <td class="label">
                    Rentang
                </td>

                <td>
                    :
                    {{ $dari
                        ? \Carbon\Carbon::parse($dari)
                            ->format('d F Y')
                        : '-' }}

                    s/d

                    {{ $sampai
                        ? \Carbon\Carbon::parse($sampai)
                            ->format('d F Y')
                        : '-' }}
                </td>

            </tr>

        @endif


        <tr>

            <td class="label">
                Status
            </td>

            <td>
                :
                {{ $namaStatus }}
            </td>

        </tr>

    </table>

</div>


{{-- STATISTIK --}}

<table class="statistics">

    <tr>

        <td>

            <div class="stat-title">
                TOTAL
            </div>

            <div class="stat-number">
                {{ $total }}
            </div>

        </td>


        <td>

            <div class="stat-title">
                HADIR
            </div>

            <div class="stat-number hadir">
                {{ $hadir }}
            </div>

        </td>


        <td>

            <div class="stat-title">
                IZIN
            </div>

            <div class="stat-number izin">
                {{ $izin }}
            </div>

        </td>


        <td>

            <div class="stat-title">
                SAKIT
            </div>

            <div class="stat-number sakit">
                {{ $sakit }}
            </div>

        </td>


        <td>

            <div class="stat-title">
                ALPA
            </div>

            <div class="stat-number alpa">
                {{ $alpa }}
            </div>

        </td>

    </tr>

</table>


{{-- DATA PRESENSI --}}

@if ($presensi->count())

    <table class="table">

        <thead>

            <tr>

                <th style="width: 35px;">
                    No
                </th>

                <th>
                    Tanggal
                </th>

                <th>
                    Sesi
                </th>

                <th>
                    NIM
                </th>

                <th>
                    Nama Mahasantri
                </th>

                <th>
                    Status
                </th>

                <th>
                    Waktu
                </th>

                <th>
                    Keterangan
                </th>

            </tr>

        </thead>


        <tbody>

            @foreach ($presensi as $item)

                @php

                    $statusClass =
                        match ($item->status) {

                            'hadir' => 'hadir',

                            'izin' => 'izin',

                            'sakit' => 'sakit',

                            'alpa' => 'alpa',

                            default => '',
                        };

                @endphp


                <tr>

                    <td class="center">
                        {{ $loop->iteration }}
                    </td>


                    <td class="center">

                        {{
                            optional(
                                $item->sesiPresensi
                            )->tanggal
                                ?->format('d/m/Y')
                            ?? '-'
                        }}

                    </td>


                    <td class="center">

                        {{
                            optional(
                                $item->sesiPresensi
                            )->jam_mulai
                            ?? '-'
                        }}

                    </td>


                    <td>

                        {{
                            $item->mahasantri->nim
                            ?? '-'
                        }}

                    </td>


                    <td>

                        {{
                            $item->mahasantri
                                ->user
                                ->name
                            ?? '-'
                        }}

                    </td>


                    <td class="center">

                        <span
                            class="status
                                {{ $statusClass }}"
                        >

                            {{
                                ucfirst(
                                    $item->status
                                )
                            }}

                        </span>

                    </td>


                    <td class="center">

                        {{
                            $item->waktu_presensi
                                ?->format('H:i:s')
                            ?? '-'
                        }}

                    </td>


                    <td>

                        {{
                            $item->keterangan
                            ?? '-'
                        }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@else

    <div class="empty">

        Tidak ada data presensi
        untuk filter yang dipilih.

    </div>

@endif


{{-- FOOTER --}}

<div class="footer">

    Dicetak pada:
    {{ now()->format('d F Y H:i') }}

    WIB

</div>


</body>

</html>