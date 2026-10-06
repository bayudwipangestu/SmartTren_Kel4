<x-app-layout>

    <style>

        /* =========================================================
           SMARTTREN PENGURUS DASHBOARD
        ========================================================= */

        .st-dashboard {
            min-height: calc(100vh - 65px);
            background: #f6f8f7;
            color: #17211b;
        }

        .st-container {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
            padding: 32px 0 50px;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .st-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .st-page-title {
            margin: 0;
            font-size: 26px;
            font-weight: 750;
            letter-spacing: -0.5px;
            color: #17211b;
        }

        .st-page-subtitle {
            margin: 6px 0 0;
            font-size: 14px;
            color: #718078;
        }

        .st-role {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 999px;
            background: #e9f8ef;
            color: #168047;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .st-role-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22a55a;
        }


        /* =========================================================
           HERO
        ========================================================= */

        .st-hero {
            position: relative;
            overflow: hidden;
            min-height: 230px;
            padding: 32px;
            margin-bottom: 25px;
            border-radius: 22px;

            background:
                linear-gradient(
                    120deg,
                    #087443 0%,
                    #10945a 52%,
                    #18a765 100%
                );

            box-shadow:
                0 15px 35px rgba(13, 116, 67, .15);
        }

        .st-hero::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            right: -100px;
            top: -140px;
            border-radius: 50%;
            background: rgba(255,255,255,.09);
        }

        .st-hero::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: 110px;
            bottom: -160px;
            border-radius: 50%;
            background: rgba(255,255,255,.07);
        }

        .st-hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
        }

        .st-hero-label {
            margin-bottom: 10px;
            color: #bdf1d2;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .st-hero-title {
            margin: 0;
            color: white;
            font-size: 30px;
            line-height: 1.25;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .st-hero-text {
            max-width: 610px;
            margin: 11px 0 22px;
            color: #e5f7eb;
            font-size: 14px;
            line-height: 1.7;
        }

        .st-primary-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 11px 17px;
            border-radius: 11px;
            background: white;
            color: #087443;
            font-size: 13px;
            font-weight: 750;
            text-decoration: none;
            transition: .2s ease;
            box-shadow: 0 7px 18px rgba(0,0,0,.12);
        }

        .st-primary-button:hover {
            transform: translateY(-2px);
            background: #f3fff7;
        }

        .st-primary-button svg {
            width: 18px !important;
            height: 18px !important;
            flex: 0 0 18px;
        }


        /* =========================================================
           SECTION
        ========================================================= */

        .st-section {
            margin-bottom: 28px;
        }

        .st-section-header {
            margin-bottom: 13px;
        }

        .st-section-title {
            margin: 0;
            font-size: 18px;
            font-weight: 750;
            color: #17211b;
        }

        .st-section-text {
            margin: 4px 0 0;
            color: #7a877f;
            font-size: 13px;
        }


        /* =========================================================
           RINGKASAN
        ========================================================= */

        .st-stat-grid {
            display: grid;

            /* DARI 4 KOLOM MENJADI 2 KOLOM */
            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 15px;
        }

        .st-stat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 0;
            padding: 18px;
            border: 1px solid #e7ece9;
            border-radius: 17px;
            background: white;
            box-shadow: 0 4px 15px rgba(23,33,27,.035);
            text-decoration: none;
            transition: .2s ease;
        }

        .st-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(23,33,27,.08);
            border-color: #cde8d8;
        }

        .st-stat-label {
            margin: 0 0 5px;
            color: #77837c;
            font-size: 12px;
            font-weight: 600;
        }

        .st-stat-value {
            margin: 0;
            color: #1c2921;
            font-size: 16px;
            font-weight: 800;
        }

        .st-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            flex: 0 0 45px;
            border-radius: 13px;
        }

        .st-stat-icon svg {
            width: 22px !important;
            height: 22px !important;
        }

        .st-green {
            background: #e9f8ef;
            color: #168047;
        }

        .st-blue {
            background: #eaf3ff;
            color: #2674c9;
        }

        .st-yellow {
            background: #fff7df;
            color: #bd8a00;
        }

        .st-red {
            background: #ffeded;
            color: #d23b3b;
        }


        /* =========================================================
           MENU
        ========================================================= */

        .st-menu-grid {
            display: grid;

            /* DARI 3 KOLOM MENJADI 2 KOLOM */
            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 17px;
        }

        .st-menu-card {
            display: block;
            padding: 21px;
            border: 1px solid #e6ece8;
            border-radius: 18px;
            background: white;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(23,33,27,.035);
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .st-menu-card:hover {
            transform: translateY(-4px);
            border-color: #cde8d8;
            box-shadow: 0 14px 30px rgba(23,33,27,.09);
        }

        .st-menu-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin-bottom: 17px;
            border-radius: 14px;
        }

        .st-menu-icon svg {
            width: 23px !important;
            height: 23px !important;
        }

        .st-menu-icon.green {
            background: #e9f8ef;
            color: #168047;
        }

        .st-menu-icon.blue {
            background: #eaf3ff;
            color: #2674c9;
        }

        .st-menu-icon.red {
            background: #ffeded;
            color: #d23b3b;
        }

        .st-menu-title {
            margin: 0;
            color: #1a251e;
            font-size: 16px;
            font-weight: 800;
        }

        .st-menu-description {
            min-height: 42px;
            margin: 7px 0 13px;
            color: #78847d;
            font-size: 13px;
            line-height: 1.65;
        }

        .st-menu-link {
            color: #168047;
            font-size: 12px;
            font-weight: 800;
        }

        .st-menu-link.blue {
            color: #2674c9;
        }

        .st-menu-link.red {
            color: #d23b3b;
        }


        /* =========================================================
           INFO
        ========================================================= */

        .st-info {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px 20px;
            border: 1px solid #ccebd8;
            border-radius: 17px;
            background: #effaf3;
        }

        .st-info-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 11px;
            background: #168047;
            color: white;
        }

        .st-info-icon svg {
            width: 19px !important;
            height: 19px !important;
        }

        .st-info-title {
            margin: 0 0 3px;
            color: #126c3c;
            font-size: 13px;
            font-weight: 800;
        }

        .st-info-text {
            margin: 0;
            color: #397052;
            font-size: 12px;
            line-height: 1.7;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .st-stat-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .st-menu-grid {
                grid-template-columns: 1fr;
            }

            .st-hero-title {
                font-size: 26px;
            }

        }


        @media (max-width: 640px) {

            .st-container {
                width: min(100% - 24px, 1180px);
                padding-top: 20px;
            }

            .st-page-header {
                align-items: flex-start;
            }

            .st-role {
                display: none;
            }

            .st-page-title {
                font-size: 22px;
            }

            .st-hero {
                padding: 24px;
                border-radius: 18px;
            }

            .st-hero-title {
                font-size: 23px;
            }

            .st-stat-grid {
                grid-template-columns: 1fr;
            }

            .st-stat {
                padding: 16px;
            }

            .st-menu-card {
                padding: 18px;
            }

        }

    </style>


    {{-- =========================================================
       HEADER BREEZE
    ========================================================= --}}

    <x-slot name="header">

        <div class="st-page-header">

            <div>

                <h2 class="st-page-title">
                    Dashboard Pengurus
                </h2>

                <p class="st-page-subtitle">
                    Kelola presensi dan kegiatan Mahasantri SmartTren.
                </p>

            </div>


            <div class="st-role">

                <span class="st-role-dot"></span>

                Pengurus SmartTren

            </div>

        </div>

    </x-slot>



    {{-- =========================================================
       DASHBOARD
    ========================================================= --}}

    <div class="st-dashboard">

        <div class="st-container">


            {{-- =================================================
               HERO
            ================================================= --}}

            <section class="st-hero">

                <div class="st-hero-content">

                    <div class="st-hero-label">
                        Sistem Presensi SmartTren
                    </div>

                    <h1 class="st-hero-title">
                        Selamat Datang, Pengurus 👋
                    </h1>

                    <p class="st-hero-text">

                        Kelola sesi presensi, scan QR Card Mahasantri,
                        periksa kehadiran, dan pantau rekap presensi
                        dengan lebih cepat dan mudah.

                    </p>


                    <a
                        href="{{ route('pengurus.sesi-presensi.index') }}"
                        class="st-primary-button"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4"
                            />

                        </svg>

                        Kelola Sesi Presensi

                    </a>

                </div>

            </section>



            {{-- =================================================
               RINGKASAN
            ================================================= --}}

            <section class="st-section">

                <div class="st-section-header">

                    <h3 class="st-section-title">
                        Ringkasan
                    </h3>

                    <p class="st-section-text">
                        Akses cepat ke dua fitur utama pengurus.
                    </p>

                </div>


                <div class="st-stat-grid">


                    {{-- KELOLA SESI --}}

                    <a
                        href="{{ route('pengurus.sesi-presensi.index') }}"
                        class="st-stat"
                    >

                        <div>

                            <p class="st-stat-label">
                                Presensi
                            </p>

                            <p class="st-stat-value">
                                Kelola Sesi
                            </p>

                        </div>


                        <div class="st-stat-icon st-green">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4
                                       m6 2a9 9 0 11-18 0
                                       9 9 0 0118 0z"
                                />

                            </svg>

                        </div>

                    </a>



                    {{-- LAPORAN KEGIATAN --}}

                    <a
                        href="{{ route('pengurus.laporan-kegiatan.index') }}"
                        class="st-stat"
                    >

                        <div>

                            <p class="st-stat-label">
                                Laporan
                            </p>

                            <p class="st-stat-value">
                                Laporan Kegiatan
                            </p>

                        </div>


                        <div class="st-stat-icon st-red">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V7.828
                                       a2 2 0 00-.586-1.414l-3.828-3.828
                                       A2 2 0 0013.172 2H7
                                       a2 2 0 00-2 2v15a2 2 0 002 2z"
                                />

                            </svg>

                        </div>

                    </a>


                </div>

            </section>



            {{-- =================================================
               MENU UTAMA
            ================================================= --}}

            <section class="st-section">

                <div class="st-section-header">

                    <h3 class="st-section-title">
                        Menu Utama
                    </h3>

                    <p class="st-section-text">
                        Pilih fitur utama yang ingin digunakan.
                    </p>

                </div>


                <div class="st-menu-grid">


                    {{-- KELOLA SESI PRESENSI --}}

                    <a
                        href="{{ route('pengurus.sesi-presensi.index') }}"
                        class="st-menu-card"
                    >

                        <div class="st-menu-icon green">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4
                                       m6 2a9 9 0 11-18 0
                                       9 9 0 0118 0z"
                                />

                            </svg>

                        </div>


                        <h4 class="st-menu-title">
                            Kelola Sesi Presensi
                        </h4>


                        <p class="st-menu-description">

                            Buat dan kelola sesi presensi berdasarkan
                            kegiatan, tanggal, dan waktu.

                            Dari sini pengurus dapat membuka
                            scanner QR dan melihat rekap satu sesi.

                        </p>


                        <span class="st-menu-link">
                            Buka Sesi Presensi →
                        </span>

                    </a>



                    {{-- LAPORAN KEGIATAN --}}

                    <a
                        href="{{ route('pengurus.laporan-kegiatan.index') }}"
                        class="st-menu-card"
                    >

                        <div class="st-menu-icon red">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V7.828
                                       a2 2 0 00-.586-1.414l-3.828-3.828
                                       A2 2 0 0013.172 2H7
                                       a2 2 0 00-2 2v15a2 2 0 002 2z"
                                />

                            </svg>

                        </div>


                        <h4 class="st-menu-title">
                            Laporan Kegiatan
                        </h4>


                        <p class="st-menu-description">

                            Pilih kegiatan untuk melihat laporan
                            presensi.

                            Gunakan filter harian, mingguan,
                            bulanan atau rentang tanggal,
                            lalu cetak laporan ke PDF.

                        </p>


                        <span class="st-menu-link red">
                            Buka Laporan →
                        </span>

                    </a>


                </div>

            </section>



            {{-- =================================================
               INFO / ALUR PRESENSI
            ================================================= --}}

            <section class="st-info">

                <div class="st-info-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01
                               M12 20a8 8 0 100-16
                               8 8 0 000 16z"
                        />

                    </svg>

                </div>


                <div>

                    <h4 class="st-info-title">
                        Alur Presensi
                    </h4>


                    <p class="st-info-text">

                        Kelola kegiatan → buat sesi presensi →
                        buka sesi aktif → scan QR Card Mahasantri →
                        periksa rekap sesi → buka Laporan Kegiatan
                        untuk melihat filter harian, mingguan,
                        bulanan, atau rentang tanggal dan cetak PDF.

                    </p>

                </div>

            </section>


        </div>

    </div>

</x-app-layout>