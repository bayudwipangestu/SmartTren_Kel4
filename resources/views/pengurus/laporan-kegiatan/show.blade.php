<x-app-layout>

    <style>
        * {
            box-sizing: border-box;
        }

        .laporan-detail-page {
            min-height: 100vh;
            background: #f6f8f7;
            padding: 32px 0 60px;
        }

        .laporan-detail-container {
            width: 100%;
            max-width: 1250px;
            margin: auto;
            padding: 0 24px;
        }

        /* =========================
           BACK
        ========================= */

        .detail-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            color: #087443;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: .2s;
        }

        .detail-back:hover {
            color: #055b34;
            transform: translateX(-2px);
        }

        /* =========================
           HEADER
        ========================= */

        .detail-header {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                #087443,
                #10a05a
            );
            color: white;
            padding: 28px;
            border-radius: 22px;
            margin-bottom: 22px;
            box-shadow: 0 12px 30px rgba(8, 116, 67, .16);
        }

        .detail-header::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            right: -70px;
            top: -100px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }

        .detail-header-content {
            position: relative;
            z-index: 1;
        }

        .detail-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .detail-header p {
            margin: 7px 0 0;
            opacity: .9;
            font-size: 14px;
        }

        /* =========================
           FILTER CARD
        ========================= */

        .filter-card {
            background: white;
            border: 1px solid #e1e8e4;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 22px;
            box-shadow: 0 7px 24px rgba(31,55,43,.05);
        }

        .filter-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .filter-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eaf8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .filter-heading h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: #17231e;
        }

        .filter-heading p {
            margin: 3px 0 0;
            color: #7b8781;
            font-size: 12px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group label {
            color: #46534c;
            font-size: 13px;
            font-weight: 700;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #d9e1dc;
            border-radius: 10px;
            background: white;
            color: #25332c;
            font-size: 13px;
            outline: none;
            transition: .2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #10a05a;
            box-shadow: 0 0 0 3px rgba(16,160,90,.10);
        }
        /* =========================
   STATUS FILTER
========================= */

.status-filter {
    grid-column: 1 / -1;
    margin-top: 2px;
}

.status-filter-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 2px;
}

.status-filter-option {
    position: relative;
}

.status-filter-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.status-filter-option label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 115px;
    height: 42px;
    padding: 0 18px;
    border: 1px solid #d9e1dc;
    border-radius: 10px;
    background: #ffffff;
    color: #526059;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s ease;
}

.status-filter-option label:hover {
    border-color: #10a05a;
    color: #087443;
    background: #f0faf4;
}

.status-filter-option input:checked + label {
    background: #087443;
    border-color: #087443;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(8, 116, 67, .18);
}

@media (max-width: 650px) {
    .status-filter-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .status-filter-option label {
        width: 100%;
        min-width: 0;
    }
}

        /* =========================
           BUTTONS
        ========================= */

        .button-area {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .detail-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 42px;
            padding: 0 17px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-show {
            background: #087443;
            color: white;
        }

        .btn-show:hover {
            background: #066237;
        }

        .btn-pdf {
            background: #dc3545;
            color: white;
        }

        .btn-pdf:hover {
            background: #bb2635;
        }

        .btn-reset {
            background: #f1f4f2;
            color: #526059;
        }

        .btn-reset:hover {
            background: #e5eae7;
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            background: white;
            border: 1px solid #e1e8e4;
            border-radius: 17px;
            padding: 18px;
            box-shadow: 0 6px 20px rgba(31,55,43,.04);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: -20px;
            bottom: -25px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            opacity: .45;
        }

        .stat-label {
            color: #7a8780;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-number {
            margin-top: 5px;
            font-size: 27px;
            font-weight: 850;
        }

        .stat-total .stat-number {
            color: #17231e;
        }

        .stat-hadir .stat-number {
            color: #078445;
        }

        .stat-izin .stat-number {
            color: #ca8a04;
        }

        .stat-sakit .stat-number {
            color: #2563eb;
        }

        .stat-alpa .stat-number {
            color: #dc3545;
        }

        /* =========================
           TABLE
        ========================= */

        .table-card {
            background: white;
            border: 1px solid #e1e8e4;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 7px 24px rgba(31,55,43,.05);
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 22px;
            border-bottom: 1px solid #edf1ef;
        }

        .table-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .table-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: #edf9f2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table-title h2 {
            margin: 0;
            color: #17231e;
            font-size: 18px;
            font-weight: 800;
        }

        .table-title p {
            margin: 3px 0 0;
            color: #7b8781;
            font-size: 12px;
        }

        .filter-info {
            padding: 7px 12px;
            border-radius: 999px;
            background: #f1f5f3;
            color: #66736c;
            font-size: 12px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .presensi-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .presensi-table thead {
            background: #f0faf4;
        }

        .presensi-table th {
            padding: 14px 16px;
            text-align: left;
            color: #087443;
            font-size: 12px;
            font-weight: 800;
            border-bottom: 1px solid #dcefe3;
            white-space: nowrap;
        }

        .presensi-table td {
            padding: 14px 16px;
            color: #46534c;
            font-size: 13px;
            border-bottom: 1px solid #f0f3f1;
            vertical-align: middle;
        }

        .presensi-table tbody tr:hover {
            background: #fbfdfc;
        }

        .nama-mahasantri {
            color: #1e2d26;
            font-weight: 700;
        }

        .nim {
            color: #68756e;
            font-family: monospace;
            font-size: 12px;
        }

        /* =========================
           BADGES
        ========================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
        }

        .badge-hadir {
            background: #dcf8e7;
            color: #087443;
        }

        .badge-izin {
            background: #fff5c9;
            color: #8a6200;
        }

        .badge-sakit {
            background: #e0edff;
            color: #205ab5;
        }

        .badge-alpa {
            background: #ffe2e5;
            color: #b42335;
        }

        /* =========================
           EMPTY
        ========================= */

        .empty-state {
            padding: 65px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            border-radius: 20px;
            background: #f1f4f2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .empty-state h3 {
            margin: 0;
            color: #27342e;
            font-size: 18px;
            font-weight: 800;
        }

        .empty-state p {
            margin: 7px 0 0;
            color: #7b8781;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1050px) {

            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 650px) {

            .laporan-detail-container {
                padding: 0 15px;
            }

            .detail-header {
                padding: 22px;
            }

            .detail-header h1 {
                font-size: 24px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .button-area {
                flex-direction: column;
            }

            .detail-btn {
                width: 100%;
            }

            .table-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>


    <div class="laporan-detail-page">

        <div class="laporan-detail-container">


            {{-- =====================================================
                BACK
            ====================================================== --}}

            <a href="{{ route('pengurus.laporan-kegiatan.index') }}"
               class="detail-back">

                <span>←</span>

                <span>Kembali ke Laporan Kegiatan</span>

            </a>


            {{-- =====================================================
                HEADER
            ====================================================== --}}

            <div class="detail-header">

                <div class="detail-header-content">

                    <h1>
                        {{ $kegiatan->nama_kegiatan }}
                    </h1>

                    <p>
                        Laporan presensi seluruh sesi
                        {{ strtolower($kegiatan->nama_kegiatan) }}.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                FILTER
            ====================================================== --}}

            <div class="filter-card">

                <div class="filter-heading">

                    <div class="filter-icon">
                        🔎
                    </div>

                    <div>

                        <h2>
                            Filter Laporan
                        </h2>

                        <p>
                            Atur periode dan status presensi yang ingin ditampilkan.
                        </p>

                    </div>

                </div>


                <form method="GET"
                      action="{{ route(
                          'pengurus.laporan-kegiatan.show',
                          $kegiatan
                      ) }}">


                    <div class="filter-grid">


                        {{-- PERIODE --}}

                        <div class="form-group">

                            <label for="periode">
                                Periode
                            </label>

                            <select name="periode"
                                    id="periode">

                                <option value="harian"
                                    {{ $periode == 'harian' ? 'selected' : '' }}>
                                    Harian
                                </option>

                                <option value="mingguan"
                                    {{ $periode == 'mingguan' ? 'selected' : '' }}>
                                    Mingguan
                                </option>

                                <option value="bulanan"
                                    {{ $periode == 'bulanan' ? 'selected' : '' }}>
                                    Bulanan
                                </option>

                                <option value="rentang"
                                    {{ $periode == 'rentang' ? 'selected' : '' }}>
                                    Rentang Tanggal
                                </option>

                            </select>

                        </div>


                        {{-- TANGGAL --}}

                        <div class="form-group">

                            <label for="tanggal">
                                Tanggal Acuan
                            </label>

                            <input type="date"
                                   name="tanggal"
                                   id="tanggal"
                                   value="{{ $tanggal }}">

                        </div>


                        {{-- DARI --}}

                        <div class="form-group">

                            <label for="dari">
                                Dari Tanggal
                            </label>

                            <input type="date"
                                   name="dari"
                                   id="dari"
                                   value="{{ $dari }}">

                        </div>


                        {{-- SAMPAI --}}

                        <div class="form-group">

                            <label for="sampai">
                                Sampai Tanggal
                            </label>

                            <input type="date"
                                   name="sampai"
                                   id="sampai"
                                   value="{{ $sampai }}">

                        </div>


                        {{-- STATUS --}}

                        {{-- STATUS --}}
<div class="status-filter">

    <div class="form-group">

        <label>
            Status Presensi
        </label>

        @php
            $statusAktif = request('status', '');
        @endphp

        <div class="status-filter-options">

            <div class="status-filter-option">
                <input
                    type="radio"
                    name="status"
                    id="status-semua"
                    value=""
                    {{ $statusAktif === '' ? 'checked' : '' }}
                >

                <label for="status-semua">
                    Semua Status
                </label>
            </div>

            <div class="status-filter-option">
                <input
                    type="radio"
                    name="status"
                    id="status-hadir"
                    value="hadir"
                    {{ $statusAktif === 'hadir' ? 'checked' : '' }}
                >

                <label for="status-hadir">
                    ✓ Hadir
                </label>
            </div>

            <div class="status-filter-option">
                <input
                    type="radio"
                    name="status"
                    id="status-izin"
                    value="izin"
                    {{ $statusAktif === 'izin' ? 'checked' : '' }}
                >

                <label for="status-izin">
                    📝 Izin
                </label>
            </div>

            <div class="status-filter-option">
                <input
                    type="radio"
                    name="status"
                    id="status-sakit"
                    value="sakit"
                    {{ $statusAktif === 'sakit' ? 'checked' : '' }}
                >

                <label for="status-sakit">
                    🩺 Sakit
                </label>
            </div>

            <div class="status-filter-option">
                <input
                    type="radio"
                    name="status"
                    id="status-alpa"
                    value="alpa"
                    {{ $statusAktif === 'alpa' ? 'checked' : '' }}
                >

                <label for="status-alpa">
                    ✕ Alpa
                </label>
            </div>

        </div>

    </div>

</div>
                    {{-- BUTTON --}}

                    <div class="button-area">

                        <button type="submit"
                                class="detail-btn btn-show">

                            🔎

                            <span>
                                Tampilkan Laporan
                            </span>

                        </button>


                        <a href="{{ route(
                            'pengurus.laporan-kegiatan.show',
                            $kegiatan
                        ) }}"
                           class="detail-btn btn-reset">

                            ↻

                            <span>
                                Reset
                            </span>

                        </a>


                        <a href="{{ route(
                            'pengurus.laporan-kegiatan.pdf',
                            array_merge(
                                ['kegiatan' => $kegiatan->id],
                                request()->query()
                            )
                        ) }}"
                           target="_blank"
                           class="detail-btn btn-pdf">

                            🖨

                            <span>
                                Cetak PDF
                            </span>

                        </a>

                    </div>

                </form>

            </div>


            {{-- =====================================================
                STATISTIK
            ====================================================== --}}

            <div class="stats-grid">


                <div class="stat-card stat-total">

                    <div class="stat-label">
                        Total Presensi
                    </div>

                    <div class="stat-number">
                        {{ $total }}
                    </div>

                </div>


                <div class="stat-card stat-hadir">

                    <div class="stat-label">
                        Hadir
                    </div>

                    <div class="stat-number">
                        {{ $hadir }}
                    </div>

                </div>


                <div class="stat-card stat-izin">

                    <div class="stat-label">
                        Izin
                    </div>

                    <div class="stat-number">
                        {{ $izin }}
                    </div>

                </div>


                <div class="stat-card stat-sakit">

                    <div class="stat-label">
                        Sakit
                    </div>

                    <div class="stat-number">
                        {{ $sakit }}
                    </div>

                </div>


                <div class="stat-card stat-alpa">

                    <div class="stat-label">
                        Alpa
                    </div>

                    <div class="stat-number">
                        {{ $alpa }}
                    </div>

                </div>

            </div>


            {{-- =====================================================
                TABLE
            ====================================================== --}}

            <div class="table-card">


                <div class="table-header">

                    <div class="table-title">

                        <div class="table-title-icon">
                            📋
                        </div>

                        <div>

                            <h2>
                                Data Presensi
                            </h2>

                            <p>
                                Data presensi berdasarkan filter yang dipilih.
                            </p>

                        </div>

                    </div>


                    <div class="filter-info">

                        Filter:

                        <strong>
                            {{ $namaStatus }}
                        </strong>

                    </div>

                </div>


                @if($presensi->count())


                    <div class="table-wrapper">

                        <table class="presensi-table">

                            <thead>

                                <tr>

                                    <th>No</th>

                                    <th>Tanggal</th>

                                    <th>Sesi</th>

                                    <th>NIM</th>

                                    <th>Nama Mahasantri</th>

                                    <th>Status</th>

                                    <th>Waktu</th>

                                    <th>Keterangan</th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($presensi as $item)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>


                                        <td>

                                            {{
                                                optional(
                                                    $item->sesiPresensi
                                                )->tanggal?->format('d/m/Y')
                                                ?? '-'
                                            }}

                                        </td>


                                        <td>

                                            {{
                                                optional(
                                                    $item->sesiPresensi
                                                )->jam_mulai
                                                ?? '-'
                                            }}

                                        </td>


                                        <td>

                                            <span class="nim">
                                                {{ $item->mahasantri->nim ?? '-' }}
                                            </span>

                                        </td>


                                        <td>

                                            <span class="nama-mahasantri">

                                                {{
                                                    $item->mahasantri
                                                        ->user
                                                        ->name
                                                        ?? '-'
                                                }}

                                            </span>

                                        </td>


                                        <td>

                                            @php

                                                $statusClass = match (
                                                    $item->status
                                                ) {

                                                    'hadir'
                                                        => 'badge-hadir',

                                                    'izin'
                                                        => 'badge-izin',

                                                    'sakit'
                                                        => 'badge-sakit',

                                                    'alpa'
                                                        => 'badge-alpa',

                                                    default
                                                        => ''

                                                };

                                            @endphp


                                            <span class="status-badge {{ $statusClass }}">

                                                {{ ucfirst($item->status) }}

                                            </span>

                                        </td>


                                        <td>

                                            {{
                                                $item->waktu_presensi
                                                    ?->format('H:i:s')
                                                ?? '-'
                                            }}

                                        </td>


                                        <td>

                                            {{ $item->keterangan ?? '-' }}

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                @else


                    <div class="empty-state">

                        <div class="empty-icon">
                            📋
                        </div>

                        <h3>
                            Belum Ada Data Presensi
                        </h3>

                        <p>
                            Belum ada data presensi untuk filter yang dipilih.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>