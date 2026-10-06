<x-app-layout>

    <style>

        /* =========================================================
           SMARTTREN - REKAP PRESENSI
        ========================================================= */

        .rekap-page {
            min-height: calc(100vh - 65px);
            background: #f5f7f6;
            padding: 32px 0 55px;
            color: #17211b;
        }

        .rekap-container {
            width: min(1200px, calc(100% - 40px));
            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .rekap-header {
            margin-bottom: 25px;
        }

        .rekap-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 13px;

            color: #168047;
            font-size: 13px;
            font-weight: 750;

            text-decoration: none;

            transition:
                color .2s ease,
                transform .2s ease;
        }

        .rekap-back:hover {
            color: #126c3c;
            transform: translateX(-2px);
        }

        .rekap-back svg {
            width: 17px !important;
            height: 17px !important;

            min-width: 17px !important;
            max-width: 17px !important;

            min-height: 17px !important;
            max-height: 17px !important;

            flex: 0 0 17px !important;
        }

        .rekap-title {
            margin: 0;

            font-size: 29px;
            line-height: 1.2;
            font-weight: 800;

            color: #17211b;

            letter-spacing: -.5px;
        }

        .rekap-subtitle {
            margin: 7px 0 0;

            color: #718078;

            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
           SESSION INFO
        ========================================================= */

        .session-info {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;

            margin-top: 15px;
        }

        .session-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 7px 12px;

            border: 1px solid #dce7e0;
            border-radius: 999px;

            background: #ffffff;

            color: #526058;

            font-size: 12px;
            font-weight: 650;
        }

        .session-badge svg {
            width: 15px !important;
            height: 15px !important;

            min-width: 15px !important;
            max-width: 15px !important;

            min-height: 15px !important;
            max-height: 15px !important;

            flex: 0 0 15px !important;

            color: #168047;
        }

        .session-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 12px;

            border-radius: 999px;

            background: #e9f8ef;
            color: #168047;

            font-size: 12px;
            font-weight: 800;
        }

        .session-status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #22a55a;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .rekap-alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;

            margin-bottom: 20px;
            padding: 13px 15px;

            border-radius: 12px;

            font-size: 12px;
            line-height: 1.5;
            font-weight: 650;
        }

        .rekap-alert.success {
            border: 1px solid #bde7cc;

            background: #effaf3;
            color: #126c3c;
        }

        .rekap-alert.error {
            border: 1px solid #fecaca;

            background: #fff5f5;
            color: #b42318;
        }

        .rekap-alert svg {
            width: 18px !important;
            height: 18px !important;

            min-width: 18px;
            flex: 0 0 18px;

            margin-top: 1px;
        }


        /* =========================================================
           SUMMARY
        ========================================================= */

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 14px;

            margin-bottom: 20px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 12px;

            min-width: 0;

            padding: 16px;

            border: 1px solid #e2e9e5;
            border-radius: 15px;

            background: #ffffff;

            box-shadow:
                0 5px 20px rgba(23, 33, 27, .035);
        }

        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 42px;
            height: 42px;
            flex: 0 0 42px;

            border-radius: 12px;
        }

        .summary-icon svg {
            width: 20px !important;
            height: 20px !important;

            min-width: 20px !important;
            max-width: 20px !important;

            min-height: 20px !important;
            max-height: 20px !important;

            flex: 0 0 20px !important;
        }

        .summary-hadir {
            background: #e9f8ef;
            color: #168047;
        }

        .summary-izin {
            background: #fff7df;
            color: #b77900;
        }

        .summary-sakit {
            background: #edf5ff;
            color: #2874c6;
        }

        .summary-alpa {
            background: #fff0f0;
            color: #d33838;
        }

        .summary-label {
            margin: 0 0 3px;

            color: #7b8780;

            font-size: 11px;
            font-weight: 700;
        }

        .summary-value {
            margin: 0;

            color: #202b24;

            font-size: 20px;
            line-height: 1;

            font-weight: 850;
        }


        /* =========================================================
           ACTION BAR
        ========================================================= */

        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            margin-bottom: 16px;
            padding: 17px 19px;

            border: 1px solid #e2e9e5;
            border-radius: 15px;

            background: #ffffff;

            box-shadow:
                0 5px 20px rgba(23, 33, 27, .035);
        }

        .action-title {
            margin: 0;

            color: #202b24;

            font-size: 14px;
            font-weight: 800;
        }

        .action-description {
            margin: 4px 0 0;

            color: #7a867f;

            font-size: 11px;
        }

        .generate-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 40px;

            padding: 9px 14px;

            border: 0;
            border-radius: 9px;

            background: #dc3d3d;
            color: #ffffff;

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                background .2s ease,
                transform .2s ease;
        }

        .generate-button:hover {
            background: #c92f2f;
            transform: translateY(-1px);
        }

        .generate-button svg {
            width: 16px !important;
            height: 16px !important;

            min-width: 16px !important;
            max-width: 16px !important;

            min-height: 16px !important;
            max-height: 16px !important;

            flex: 0 0 16px !important;
        }


        /* =========================================================
           TABLE CARD
        ========================================================= */

        .table-card {
            overflow: hidden;

            border: 1px solid #e2e9e5;
            border-radius: 18px;

            background: #ffffff;

            box-shadow:
                0 7px 25px rgba(23, 33, 27, .045);
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 19px 21px;

            border-bottom: 1px solid #edf1ee;
        }

        .table-title {
            margin: 0;

            color: #202b24;

            font-size: 16px;
            font-weight: 800;
        }

        .table-description {
            margin: 4px 0 0;

            color: #7a867f;

            font-size: 11px;
        }

        .total-badge {
            display: inline-flex;
            align-items: center;

            padding: 7px 11px;

            border-radius: 999px;

            background: #e9f8ef;
            color: #168047;

            font-size: 11px;
            font-weight: 800;

            white-space: nowrap;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .table-wrapper {
            overflow-x: auto;
        }

        .rekap-table {
            width: 100%;

            border-collapse: collapse;

            min-width: 1050px;
        }

        .rekap-table th {
            padding: 13px 15px;

            border-bottom: 1px solid #e7ece9;

            background: #f8faf9;

            color: #66736b;

            font-size: 10px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .45px;

            text-align: left;

            white-space: nowrap;
        }

        .rekap-table td {
            padding: 14px 15px;

            border-bottom: 1px solid #edf1ee;

            color: #536057;

            font-size: 12px;

            vertical-align: middle;
        }

        .rekap-table tbody tr {
            transition: background .15s ease;
        }

        .rekap-table tbody tr:hover {
            background: #fbfdfc;
        }

        .rekap-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .number-cell {
            width: 55px;

            color: #8a958e !important;

            font-weight: 700;
        }

        .nim-cell {
            color: #39463f !important;

            font-weight: 750;
        }

        .name-cell {
            color: #202b24 !important;

            font-weight: 800;
        }


        /* =========================================================
           STATUS BADGE
        ========================================================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 58px;

            padding: 5px 9px;

            border-radius: 999px;

            font-size: 10px;
            font-weight: 800;
        }

        .status-hadir {
            background: #e9f8ef;
            color: #168047;
        }

        .status-izin {
            background: #fff7df;
            color: #a96d00;
        }

        .status-sakit {
            background: #edf5ff;
            color: #2874c6;
        }

        .status-alpa {
            background: #fff0f0;
            color: #d33838;
        }


        /* =========================================================
           UPDATE FORM
        ========================================================= */

        .update-form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 6px;
        }

        .update-select,
        .update-input {
            height: 35px;

            border: 1px solid #d8e0db;
            border-radius: 8px;

            background: #ffffff;

            color: #36423b;

            font-size: 10px;

            outline: none;
        }

        .update-select {
            min-width: 82px;

            padding: 0 8px;
        }

        .update-input {
            width: 135px;

            padding: 0 9px;
        }

        .update-select:focus,
        .update-input:focus {
            border-color: #168047;

            box-shadow:
                0 0 0 2px rgba(22, 128, 71, .08);
        }

        .save-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 35px;

            padding: 0 11px;

            border: 0;
            border-radius: 8px;

            background: #17211b;
            color: #ffffff;

            font-size: 10px;
            font-weight: 800;

            cursor: pointer;

            transition:
                background .2s ease,
                transform .2s ease;
        }

        .save-button:hover {
            background: #26342c;
            transform: translateY(-1px);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            padding: 65px 20px;

            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 62px;
            height: 62px;

            margin: 0 auto 15px;

            border-radius: 17px;

            background: #edf7f1;
            color: #168047;
        }

        .empty-icon svg {
            width: 28px !important;
            height: 28px !important;

            min-width: 28px !important;
            max-width: 28px !important;

            min-height: 28px !important;
            max-height: 28px !important;

            flex: 0 0 28px !important;
        }

        .empty-title {
            margin: 0;

            color: #202b24;

            font-size: 17px;
            font-weight: 800;
        }

        .empty-text {
            max-width: 400px;

            margin: 7px auto 0;

            color: #7a867f;

            font-size: 12px;
            line-height: 1.6;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .summary-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 640px) {

            .rekap-page {
                padding: 22px 0 40px;
            }

            .rekap-container {
                width: calc(100% - 24px);
            }

            .rekap-title {
                font-size: 24px;
            }

            .session-info {
                flex-direction: column;
                align-items: stretch;
            }

            .session-badge,
            .session-status {
                width: 100%;
            }

            .summary-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .summary-card {
                padding: 13px;
            }

            .summary-icon {
                width: 36px;
                height: 36px;
                flex-basis: 36px;
            }

            .summary-icon svg {
                width: 17px !important;
                height: 17px !important;
            }

            .summary-value {
                font-size: 17px;
            }

            .action-bar {
                align-items: stretch;
                flex-direction: column;
            }

            .generate-button {
                width: 100%;
            }

            .table-header {
                align-items: flex-start;
                flex-direction: column;
            }

        }

    </style>


    {{-- =========================================================
       HEADER BREEZE
    ========================================================= --}}

    <x-slot name="header">

        <div>

            <h2 class="text-xl font-bold text-gray-800">
                Rekap Presensi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Rekap kehadiran Mahasantri pada sesi ini.
            </p>

        </div>

    </x-slot>


    {{-- =========================================================
       CONTENT
    ========================================================= --}}

    <div class="rekap-page">

        <div class="rekap-container">


            {{-- =================================================
               HEADER HALAMAN
            ================================================= --}}

            <div class="rekap-header">


                {{-- KEMBALI --}}

                <a
                    href="{{ route('pengurus.sesi-presensi.index') }}"
                    class="rekap-back"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >

                        <path d="M19 12H5"></path>

                        <path d="M12 19l-7-7 7-7"></path>

                    </svg>

                    Kembali ke Sesi Presensi

                </a>


                <h1 class="rekap-title">
                    Rekap Presensi
                </h1>


                <p class="rekap-subtitle">
                    Lihat dan kelola data kehadiran Mahasantri
                    untuk sesi presensi ini.
                </p>


                {{-- INFORMASI SESI --}}

                <div class="session-info">


                    {{-- KEGIATAN --}}

                    <div class="session-badge">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="4"
                                y="4"
                                width="16"
                                height="16"
                                rx="2"
                            ></rect>

                            <path d="M8 9h8"></path>

                            <path d="M8 13h5"></path>

                        </svg>

                        {{ $sesiPresensi->kegiatan->nama_kegiatan }}

                    </div>


                    {{-- TANGGAL --}}

                    <div class="session-badge">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="17"
                                rx="2"
                            ></rect>

                            <path d="M16 2v4"></path>

                            <path d="M8 2v4"></path>

                            <path d="M3 10h18"></path>

                        </svg>

                        {{ $sesiPresensi->tanggal->format('d-m-Y') }}

                    </div>


                    {{-- JAM --}}

                    <div class="session-badge">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <path d="M12 7v5l3 2"></path>

                        </svg>

                        {{ substr($sesiPresensi->jam_mulai, 0, 5) }}
                        -
                        {{ substr($sesiPresensi->jam_selesai, 0, 5) }}

                    </div>


                    {{-- STATUS --}}

                    <div class="session-status">

                        <span class="session-status-dot"></span>

                        {{ ucfirst($sesiPresensi->status) }}

                    </div>

                </div>

            </div>



            {{-- =================================================
               ALERT SUCCESS
            ================================================= --}}

            @if(session('success'))

                <div class="rekap-alert success">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M9 12l2 2 4-4"></path>

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        ></circle>

                    </svg>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- =================================================
               ALERT ERROR
            ================================================= --}}

            @if(session('error'))

                <div class="rekap-alert error">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        ></circle>

                        <path d="M12 8v4"></path>

                        <path d="M12 16h.01"></path>

                    </svg>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif



            {{-- =================================================
               HITUNG RINGKASAN
            ================================================= --}}

            @php

                $jumlahHadir = $presensi
                    ->where('status', 'hadir')
                    ->count();

                $jumlahIzin = $presensi
                    ->where('status', 'izin')
                    ->count();

                $jumlahSakit = $presensi
                    ->where('status', 'sakit')
                    ->count();

                $jumlahAlpa = $presensi
                    ->where('status', 'alpa')
                    ->count();

                $jumlahTotal = $presensi->count();

            @endphp



            {{-- =================================================
               SUMMARY
            ================================================= --}}

            <div class="summary-grid">


                {{-- HADIR --}}

                <div class="summary-card">

                    <div class="summary-icon summary-hadir">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M9 12l2 2 4-4"></path>

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                        </svg>

                    </div>

                    <div>

                        <p class="summary-label">
                            Hadir
                        </p>

                        <p class="summary-value">
                            {{ $jumlahHadir }}
                        </p>

                    </div>

                </div>



                {{-- IZIN --}}

                <div class="summary-card">

                    <div class="summary-icon summary-izin">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <path d="M12 8v4"></path>

                            <path d="M12 16h.01"></path>

                        </svg>

                    </div>

                    <div>

                        <p class="summary-label">
                            Izin
                        </p>

                        <p class="summary-value">
                            {{ $jumlahIzin }}
                        </p>

                    </div>

                </div>



                {{-- SAKIT --}}

                <div class="summary-card">

                    <div class="summary-icon summary-sakit">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M12 3v18"></path>

                            <path d="M3 12h18"></path>

                        </svg>

                    </div>

                    <div>

                        <p class="summary-label">
                            Sakit
                        </p>

                        <p class="summary-value">
                            {{ $jumlahSakit }}
                        </p>

                    </div>

                </div>



                {{-- ALPA --}}

                <div class="summary-card">

                    <div class="summary-icon summary-alpa">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <path d="M9 9l6 6"></path>

                            <path d="M15 9l-6 6"></path>

                        </svg>

                    </div>

                    <div>

                        <p class="summary-label">
                            Alpa
                        </p>

                        <p class="summary-value">
                            {{ $jumlahAlpa }}
                        </p>

                    </div>

                </div>


            </div>



            {{-- =================================================
               ACTION BAR
            ================================================= --}}

            <div class="action-bar">

                <div>

                    <p class="action-title">
                        Kelola Kehadiran
                    </p>

                    <p class="action-description">
                        Mahasantri yang belum melakukan presensi
                        dapat ditandai sebagai Alpa.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route(
                        'pengurus.presensi.generate-alpa',
                        $sesiPresensi
                    ) }}"
                    onsubmit="return confirm(
                        'Yakin ingin menandai semua mahasantri yang belum presensi sebagai ALPA?'
                    )"
                >

                    @csrf

                    <button
                        type="submit"
                        class="generate-button"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M12 9v2"></path>

                            <path d="M12 15h.01"></path>

                            <path
                                d="M5.07 19h13.86
                                   a2 2 0 001.73-3L13.73 4
                                   a2 2 0 00-3.46 0L3.34 16
                                   a2 2 0 001.73 3z"
                            ></path>

                        </svg>

                        Generate Alpa

                    </button>

                </form>

            </div>



            {{-- =================================================
               TABLE
            ================================================= --}}

            <div class="table-card">


                {{-- TABLE HEADER --}}

                <div class="table-header">

                    <div>

                        <h2 class="table-title">
                            Data Presensi
                        </h2>

                        <p class="table-description">
                            Periksa dan ubah status kehadiran
                            setiap Mahasantri.
                        </p>

                    </div>


                    <span class="total-badge">

                        {{ $jumlahTotal }} Data

                    </span>

                </div>



                {{-- TABLE --}}

                <div class="table-wrapper">

                    <table class="rekap-table">

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    NIM
                                </th>

                                <th>
                                    Nama
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

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($presensi as $item)

                                <tr>


                                    {{-- NO --}}

                                    <td class="number-cell">

                                        {{ $loop->iteration }}

                                    </td>



                                    {{-- NIM --}}

                                    <td class="nim-cell">

                                        {{ $item->mahasantri->nim }}

                                    </td>



                                    {{-- NAMA --}}

                                    <td class="name-cell">

                                        {{ $item->mahasantri->user?->name ?? '-' }}

                                    </td>



                                    {{-- STATUS --}}

                                    <td>

                                        @if($item->status === 'hadir')

                                            <span class="status-badge status-hadir">
                                                Hadir
                                            </span>

                                        @elseif($item->status === 'izin')

                                            <span class="status-badge status-izin">
                                                Izin
                                            </span>

                                        @elseif($item->status === 'sakit')

                                            <span class="status-badge status-sakit">
                                                Sakit
                                            </span>

                                        @else

                                            <span class="status-badge status-alpa">
                                                Alpa
                                            </span>

                                        @endif

                                    </td>



                                    {{-- WAKTU --}}

                                    <td>

                                        {{ $item->waktu_presensi?->format('H:i:s') ?? '-' }}

                                    </td>



                                    {{-- KETERANGAN --}}

                                    <td>

                                        {{ $item->keterangan ?? '-' }}

                                    </td>



                                    {{-- AKSI --}}

                                    <td>

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'pengurus.presensi.update',
                                                $item
                                            ) }}"
                                            class="update-form"
                                        >

                                            @csrf

                                            @method('PATCH')


                                            {{-- STATUS --}}

                                            <select
                                                name="status"
                                                class="update-select"
                                            >

                                                @foreach([
                                                    'hadir',
                                                    'izin',
                                                    'sakit',
                                                    'alpa'
                                                ] as $status)

                                                    <option
                                                        value="{{ $status }}"
                                                        @selected(
                                                            $item->status === $status
                                                        )
                                                    >

                                                        {{ ucfirst($status) }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            {{-- KETERANGAN --}}

                                            <input
                                                type="text"
                                                name="keterangan"
                                                value="{{ $item->keterangan }}"
                                                placeholder="Keterangan"
                                                class="update-input"
                                            >


                                            {{-- SIMPAN --}}

                                            <button
                                                type="submit"
                                                class="save-button"
                                            >

                                                Simpan

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty


                                {{-- EMPTY STATE --}}

                                <tr>

                                    <td
                                        colspan="7"
                                        class="empty-state"
                                    >

                                        <div class="empty-icon">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >

                                                <path
                                                    d="M9 12h6"
                                                ></path>

                                                <path
                                                    d="M9 16h6"
                                                ></path>

                                                <path
                                                    d="M7 4h10a2 2 0 012 2v12
                                                       a2 2 0 01-2 2H7
                                                       a2 2 0 01-2-2V6
                                                       a2 2 0 012-2z"
                                                ></path>

                                            </svg>

                                        </div>


                                        <h3 class="empty-title">
                                            Belum Ada Data Presensi
                                        </h3>


                                        <p class="empty-text">

                                            Belum ada Mahasantri yang
                                            melakukan presensi pada sesi ini.
                                            Silakan gunakan Scanner QR
                                            terlebih dahulu.

                                        </p>

                                    </td>

                                </tr>


                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>