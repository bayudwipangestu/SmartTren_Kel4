<x-app-layout>

    <style>

        /* =========================================================
           SESI PRESENSI - SMARTTREN
        ========================================================= */

        .sp-page {
            min-height: calc(100vh - 65px);
            background: #f5f7f6;
            padding: 32px 0 50px;
            color: #17211b;
        }

        .sp-container {
            width: min(1200px, calc(100% - 40px));
            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .sp-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 25px;
        }

        .sp-header-left {
            min-width: 0;
        }
        /* =========================================================
   TOMBOL KEMBALI KE DASHBOARD
========================================================= */

.sp-back {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 12px;

    color: #168047;
    font-size: 13px;
    font-weight: 750;

    text-decoration: none;

    transition:
        color .2s ease,
        transform .2s ease;
}

.sp-back:hover {
    color: #126c3c;
    transform: translateX(-2px);
}

.sp-back svg {
    width: 17px !important;
    height: 17px !important;

    min-width: 17px !important;
    max-width: 17px !important;

    min-height: 17px !important;
    max-height: 17px !important;

    flex: 0 0 17px !important;

    display: block;
}

        .sp-title {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 800;
            color: #17211b;
            letter-spacing: -.5px;
        }

        .sp-subtitle {
            margin: 7px 0 0;
            color: #718078;
            font-size: 14px;
            line-height: 1.6;
        }

        .sp-create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            flex-shrink: 0;

            padding: 12px 18px;

            border: 0;
            border-radius: 11px;

            background: #168047;
            color: #ffffff;

            font-size: 13px;
            font-weight: 750;

            text-decoration: none;

            box-shadow:
                0 7px 18px rgba(22, 128, 71, .16);

            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .sp-create-btn:hover {
            background: #126c3c;
            transform: translateY(-2px);

            box-shadow:
                0 10px 24px rgba(22, 128, 71, .22);
        }

        .sp-create-btn svg {
            width: 18px !important;
            height: 18px !important;
            min-width: 18px;
            max-width: 18px;
            min-height: 18px;
            max-height: 18px;
            flex: 0 0 18px;
            display: block;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .sp-alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;

            margin-bottom: 20px;
            padding: 14px 16px;

            border: 1px solid #bde7cc;
            border-radius: 13px;

            background: #effaf3;
            color: #126c3c;

            font-size: 13px;
            line-height: 1.5;
            font-weight: 600;
        }

        .sp-alert-icon {
            width: 20px;
            height: 20px;
            flex: 0 0 20px;
            margin-top: 1px;
        }

        .sp-alert-icon svg {
            width: 20px !important;
            height: 20px !important;
            display: block;
        }


        /* =========================================================
           TABLE CARD
        ========================================================= */

        .sp-card {
            overflow: hidden;

            border: 1px solid #e3e9e5;
            border-radius: 18px;

            background: #ffffff;

            box-shadow:
                0 6px 24px rgba(23, 33, 27, .055);
        }

        .sp-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 19px 22px;

            border-bottom: 1px solid #edf1ee;
        }

        .sp-card-title {
            margin: 0;

            font-size: 17px;
            font-weight: 800;
            color: #1b2720;
        }

        .sp-card-description {
            margin: 4px 0 0;

            color: #7b877f;
            font-size: 12px;
        }

        .sp-count {
            display: inline-flex;
            align-items: center;

            padding: 6px 10px;

            border-radius: 999px;

            background: #edf9f2;
            color: #168047;

            font-size: 12px;
            font-weight: 750;
            white-space: nowrap;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .sp-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .sp-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .sp-table thead {
            background: #f8faf9;
        }

        .sp-table th {
            padding: 13px 18px;

            border-bottom: 1px solid #e7ece9;

            color: #758078;

            font-size: 11px;
            line-height: 1.4;
            font-weight: 800;

            letter-spacing: .6px;
            text-transform: uppercase;

            text-align: left;
            white-space: nowrap;
        }

        .sp-table td {
            padding: 16px 18px;

            border-bottom: 1px solid #eef2ef;

            color: #526058;

            font-size: 13px;
            vertical-align: middle;
        }

        .sp-table tbody tr {
            transition: background .15s ease;
        }

        .sp-table tbody tr:hover {
            background: #fafcfb;
        }

        .sp-table tbody tr:last-child td {
            border-bottom: 0;
        }


        /* =========================================================
           NUMBER
        ========================================================= */

        .sp-number {
            width: 55px;
            color: #89938d !important;
            font-weight: 700;
        }


        /* =========================================================
           KEGIATAN
        ========================================================= */

        .sp-activity {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 190px;
        }

        .sp-activity-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 38px;
            height: 38px;
            flex: 0 0 38px;

            border-radius: 11px;

            background: #eaf8ef;
            color: #168047;
        }

        .sp-activity-icon svg {
            width: 18px !important;
            height: 18px !important;

            min-width: 18px;
            max-width: 18px;
            min-height: 18px;
            max-height: 18px;

            display: block;
        }

        .sp-activity-name {
            color: #1d2922;
            font-size: 13px;
            font-weight: 750;
        }


        /* =========================================================
           DATE / TIME
        ========================================================= */

        .sp-date {
            color: #4e5b53;
            white-space: nowrap;
        }

        .sp-time {
            color: #4e5b53;
            white-space: nowrap;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .sp-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 10px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .sp-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .sp-status-active {
            background: #e9f8ef;
            color: #168047;
        }

        .sp-status-active .sp-status-dot {
            background: #22a55a;
        }

        .sp-status-finished {
            background: #f1f3f2;
            color: #626c66;
        }

        .sp-status-finished .sp-status-dot {
            background: #8a938e;
        }

        .sp-status-cancelled {
            background: #ffeded;
            color: #c43a3a;
        }

        .sp-status-cancelled .sp-status-dot {
            background: #df4b4b;
        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .sp-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .sp-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 32px;

            padding: 7px 10px;

            border-radius: 8px;

            font-size: 11px;
            font-weight: 750;

            text-decoration: none;

            border: 0;
            cursor: pointer;

            white-space: nowrap;

            transition:
                background .15s ease,
                transform .15s ease;
        }

        .sp-action:hover {
            transform: translateY(-1px);
        }

        .sp-action-scan {
            background: #168047;
            color: #ffffff;
        }

        .sp-action-scan:hover {
            background: #126c3c;
        }

        .sp-action-rekap {
            background: #edf5ff;
            color: #2569ad;
        }

        .sp-action-rekap:hover {
            background: #dcecff;
        }

        .sp-action-edit {
            background: #fff7df;
            color: #9b7000;
        }

        .sp-action-edit:hover {
            background: #ffefb9;
        }

        .sp-action-delete {
            background: #ffeded;
            color: #c43a3a;
        }

        .sp-action-delete:hover {
            background: #ffe0e0;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .sp-empty {
            padding: 65px 25px 70px;
            text-align: center;
        }

        .sp-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 64px;
            height: 64px;

            margin: 0 auto 18px;

            border-radius: 18px;

            background: #eaf8ef;
            color: #168047;
        }

        /*
         * PENTING:
         * Ukuran SVG dibuat eksplisit agar tidak menjadi
         * tanda + raksasa karena CSS global.
         */
        .sp-empty-icon svg {
            display: block !important;

            width: 28px !important;
            height: 28px !important;

            min-width: 28px !important;
            max-width: 28px !important;

            min-height: 28px !important;
            max-height: 28px !important;

            flex: 0 0 28px !important;
        }

        .sp-empty-title {
            margin: 0;

            color: #202b24;

            font-size: 18px;
            font-weight: 800;
        }

        .sp-empty-text {
            max-width: 430px;

            margin: 8px auto 0;

            color: #7a867f;

            font-size: 13px;
            line-height: 1.65;
        }

        /*
         * Tidak ada tombol kedua di sini.
         * Tombol buat sesi hanya ada di header.
         */


        /* =========================================================
           PAGINATION
        ========================================================= */

        .sp-pagination {
            padding: 16px 20px;

            border-top: 1px solid #edf1ee;
            background: #ffffff;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .sp-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .sp-create-btn {
                width: 100%;
            }

            .sp-card-top {
                align-items: flex-start;
                flex-direction: column;
            }

        }


        @media (max-width: 640px) {

            .sp-page {
                padding: 22px 0 40px;
            }

            .sp-container {
                width: calc(100% - 24px);
            }

            .sp-title {
                font-size: 23px;
            }

            .sp-subtitle {
                font-size: 13px;
            }

            .sp-card {
                border-radius: 15px;
            }

            .sp-table {
                min-width: 800px;
            }

            .sp-empty {
                padding: 50px 18px 55px;
            }

        }

    </style>


    {{-- =========================================================
       HEADER BREEZE
    ========================================================= --}}

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Sesi Presensi
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola sesi presensi Mahasantri.
                </p>

            </div>

        </div>

    </x-slot>


    {{-- =========================================================
       CONTENT
    ========================================================= --}}

    <div class="sp-page">

        <div class="sp-container">


            {{-- =================================================
               PAGE HEADER
            ================================================= --}}

           <div class="sp-header">

    <div class="sp-header-left">

        {{-- KEMBALI KE DASHBOARD --}}

        <a
            href="{{ route('pengurus.dashboard') }}"
            class="sp-back"
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

            Kembali ke Dashboard

        </a>


        <h1 class="sp-title">
            Sesi Presensi
        </h1>

        <p class="sp-subtitle">
            Buat dan kelola sesi presensi berdasarkan
            kegiatan, tanggal, dan waktu.
        </p>

    </div>


                {{-- SATU-SATUNYA TOMBOL BUAT SESI --}}

                <a
                    href="{{ route('pengurus.sesi-presensi.create') }}"
                    class="sp-create-btn"
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

                        <path d="M12 5v14"></path>

                        <path d="M5 12h14"></path>

                    </svg>

                    Buat Sesi Presensi

                </a>

            </div>


            {{-- =================================================
               SUCCESS MESSAGE
            ================================================= --}}

            @if(session('success'))

                <div class="sp-alert">

                    <div class="sp-alert-icon">

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
                        {{ session('success') }}
                    </div>

                </div>

            @endif


            {{-- =================================================
               TABLE CARD
            ================================================= --}}

            <div class="sp-card">


                {{-- CARD HEADER --}}

                <div class="sp-card-top">

                    <div>

                        <h2 class="sp-card-title">
                            Daftar Sesi Presensi
                        </h2>

                        <p class="sp-card-description">
                            Pilih sesi untuk melakukan scan QR,
                            melihat rekap, mengedit, atau menghapus.
                        </p>

                    </div>


                    <span class="sp-count">

                        {{ $sesi->total() }}

                        {{ $sesi->total() == 1 ? 'Sesi' : 'Sesi' }}

                    </span>

                </div>


                {{-- =================================================
                   TABLE
                ================================================= --}}

                <div class="sp-table-wrapper">

                    <table class="sp-table">

                        <thead>

                            <tr>

                                <th style="width: 60px;">
                                    No
                                </th>

                                <th>
                                    Kegiatan
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Jam
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse($sesi as $item)

                                <tr>


                                    {{-- NO --}}

                                    <td class="sp-number">

                                        {{ $sesi->firstItem() + $loop->index }}

                                    </td>


                                    {{-- KEGIATAN --}}

                                    <td>

                                        <div class="sp-activity">

                                            <div class="sp-activity-icon">

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
                                                        d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"
                                                    ></path>

                                                    <path
                                                        d="M8 7h8"
                                                    ></path>

                                                    <path
                                                        d="M8 11h8"
                                                    ></path>

                                                    <path
                                                        d="M8 15h5"
                                                    ></path>

                                                </svg>

                                            </div>


                                            <div class="sp-activity-name">

                                                {{ $item->kegiatan->nama_kegiatan }}

                                            </div>

                                        </div>

                                    </td>


                                    {{-- TANGGAL --}}

                                    <td class="sp-date">

                                        {{ $item->tanggal->format('d/m/Y') }}

                                    </td>


                                    {{-- JAM --}}

                                    <td class="sp-time">

                                        {{ substr($item->jam_mulai, 0, 5) }}

                                        <span style="color:#a0aaa4;">
                                            -
                                        </span>

                                        {{ substr($item->jam_selesai, 0, 5) }}

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if($item->status === 'aktif')

                                            <span
                                                class="sp-status sp-status-active"
                                            >

                                                <span
                                                    class="sp-status-dot"
                                                ></span>

                                                Aktif

                                            </span>


                                        @elseif($item->status === 'selesai')

                                            <span
                                                class="sp-status sp-status-finished"
                                            >

                                                <span
                                                    class="sp-status-dot"
                                                ></span>

                                                Selesai

                                            </span>


                                        @else

                                            <span
                                                class="sp-status sp-status-cancelled"
                                            >

                                                <span
                                                    class="sp-status-dot"
                                                ></span>

                                                Dibatalkan

                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td>

                                        <div class="sp-actions">


                                            {{-- SCAN QR --}}

                                            @if($item->status === 'aktif')

                                                <a
                                                    href="{{ route(
                                                        'pengurus.presensi.scanner',
                                                        $item
                                                    ) }}"
                                                    class="sp-action sp-action-scan"
                                                >
                                                    Scan QR
                                                </a>

                                            @endif


                                            {{-- REKAP --}}

                                            <a
                                                href="{{ route(
                                                    'pengurus.presensi.rekap',
                                                    $item
                                                ) }}"
                                                class="sp-action sp-action-rekap"
                                            >
                                                Rekap
                                            </a>


                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route(
                                                    'pengurus.sesi-presensi.edit',
                                                    $item
                                                ) }}"
                                                class="sp-action sp-action-edit"
                                            >
                                                Edit
                                            </a>


                                            {{-- HAPUS --}}

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'pengurus.sesi-presensi.destroy',
                                                    $item
                                                ) }}"
                                                onsubmit="return confirm(
                                                    'Yakin ingin menghapus sesi presensi ini?'
                                                )"
                                                style="margin:0;"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="sp-action sp-action-delete"
                                                >
                                                    Hapus
                                                </button>

                                            </form>


                                        </div>

                                    </td>

                                </tr>


                            @empty


                                {{-- =================================================
                                   EMPTY STATE
                                   TIDAK ADA TOMBOL KEDUA
                                ================================================= --}}

                                <tr>

                                    <td
                                        colspan="6"
                                        style="padding:0;"
                                    >

                                        <div class="sp-empty">


                                            <div class="sp-empty-icon">

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    aria-hidden="true"
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

                                                    <path d="M8 17h3"></path>

                                                </svg>

                                            </div>


                                            <h3 class="sp-empty-title">
                                                Belum Ada Sesi Presensi
                                            </h3>


                                            <p class="sp-empty-text">

                                                Belum ada sesi presensi yang dibuat.
                                                Silakan gunakan tombol
                                                <strong>
                                                    Buat Sesi Presensi
                                                </strong>
                                                di bagian atas untuk membuat
                                                sesi pertama.

                                            </p>

                                        </div>

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                   PAGINATION
                ================================================= --}}

                @if($sesi->hasPages())

                    <div class="sp-pagination">

                        {{ $sesi->links() }}

                    </div>

                @endif


            </div>

        </div>

    </div>

</x-app-layout>