<x-app-layout>

    <style>
        .laporan-page {
            min-height: 100vh;
            background: #f6f8f7;
            padding: 36px 0 60px;
        }

        .laporan-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
            box-sizing: border-box;
        }

        /* =========================
           HEADER
        ========================= */

        .laporan-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #087443;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
            transition: .2s ease;
        }

        .laporan-back:hover {
            color: #055b34;
            transform: translateX(-2px);
        }

        .laporan-title {
            margin: 0;
            color: #17251f;
            font-size: 34px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .laporan-subtitle {
            margin: 8px 0 0;
            color: #718078;
            font-size: 15px;
        }

        /* =========================
           INFO BOX
        ========================= */

        .laporan-info {
            position: relative;
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 26px;
            padding: 22px 24px;
            border: 1px solid #ccebdd;
            border-radius: 18px;
            background: linear-gradient(
                135deg,
                #ecfaf3 0%,
                #ffffff 100%
            );
            overflow: hidden;
        }

        .laporan-info::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            right: -70px;
            top: -80px;
            border-radius: 50%;
            background: #dff5e9;
            opacity: .7;
        }

        .laporan-info-icon {
            position: relative;
            z-index: 1;
            width: 58px;
            height: 58px;
            min-width: 58px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d9f5e6;
            font-size: 26px;
        }

        .laporan-info-content {
            position: relative;
            z-index: 1;
        }

        .laporan-info-title {
            margin: 0;
            color: #086b3e;
            font-size: 18px;
            font-weight: 750;
        }

        .laporan-info-text {
            margin: 6px 0 0;
            color: #527063;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================
           MAIN CARD
        ========================= */

        .laporan-main {
            margin-top: 24px;
            background: #ffffff;
            border: 1px solid #e1e8e4;
            border-radius: 22px;
            box-shadow: 0 8px 30px rgba(31, 55, 43, .06);
            overflow: hidden;
        }

        .laporan-main-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 24px 26px;
            border-bottom: 1px solid #edf1ef;
        }

        .laporan-heading {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .laporan-heading-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf9f2;
            font-size: 21px;
        }

        .laporan-heading-title {
            margin: 0;
            color: #1b2923;
            font-size: 19px;
            font-weight: 750;
        }

        .laporan-heading-text {
            margin: 4px 0 0;
            color: #7b8882;
            font-size: 13px;
        }

        .laporan-total {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 14px;
            border-radius: 999px;
            background: #edf9f2;
            color: #087443;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* =========================
           GRID
        ========================= */

        .laporan-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            padding: 24px;
        }

        /* =========================
           ACTIVITY CARD
        ========================= */

        .kegiatan-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            border: 1px solid #e3e9e6;
            border-radius: 18px;
            background: #ffffff;
            transition: all .22s ease;
        }

        .kegiatan-card:hover {
            transform: translateY(-3px);
            border-color: #b9e5ce;
            box-shadow: 0 12px 28px rgba(31, 55, 43, .09);
        }

        .kegiatan-icon {
            width: 54px;
            height: 54px;
            min-width: 54px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 25px;
        }

        .icon-hijau {
            background: #e6f8ee;
        }

        .icon-kuning {
            background: #fff5d9;
        }

        .icon-biru {
            background: #e9f2ff;
        }

        .icon-ungu {
            background: #f2eaff;
        }

        .icon-merah {
            background: #ffeded;
        }

        .icon-default {
            background: #edf4f0;
        }

        .kegiatan-title {
            margin: 0;
            color: #17231e;
            font-size: 17px;
            font-weight: 750;
            line-height: 1.4;
        }

        .kegiatan-description {
            margin: 6px 0 0;
            min-height: 40px;
            color: #77847e;
            font-size: 13px;
            line-height: 1.55;
        }

        .kegiatan-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 18px;
            margin-bottom: 18px;
        }

        .kegiatan-session {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #69766f;
            font-size: 13px;
        }

        .session-icon {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f3f6f4;
            font-size: 14px;
        }

        .status-aktif {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #e9f9f0;
            color: #087443;
            font-size: 11px;
            font-weight: 750;
        }

        .status-aktif-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #16a05d;
        }

        .status-nonaktif {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f1f3f2;
            color: #77817c;
            font-size: 11px;
            font-weight: 750;
        }

        .laporan-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            box-sizing: border-box;
            padding: 11px 14px;
            border-radius: 11px;
            background: #079447;
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .laporan-button:hover {
            background: #067c3b;
            box-shadow: 0 5px 14px rgba(7, 148, 71, .22);
        }

        .laporan-arrow {
            transition: transform .2s ease;
        }

        .laporan-button:hover .laporan-arrow {
            transform: translateX(3px);
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .laporan-empty {
            padding: 70px 24px;
            text-align: center;
        }

        .laporan-empty-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            background: #f1f4f2;
            font-size: 34px;
        }

        .laporan-empty-title {
            margin: 0;
            color: #1b2923;
            font-size: 19px;
            font-weight: 750;
        }

        .laporan-empty-text {
            max-width: 420px;
            margin: 7px auto 0;
            color: #7b8781;
            font-size: 13px;
            line-height: 1.6;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .laporan-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 640px) {

            .laporan-page {
                padding-top: 25px;
            }

            .laporan-container {
                padding: 0 15px;
            }

            .laporan-title {
                font-size: 28px;
            }

            .laporan-info {
                align-items: flex-start;
                padding: 18px;
            }

            .laporan-main-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
            }

            .laporan-grid {
                grid-template-columns: 1fr;
                padding: 16px;
            }

            .laporan-total {
                align-self: flex-start;
            }

        }
    </style>


    <div class="laporan-page">

        <div class="laporan-container">


            {{-- =====================================================
                HEADER
            ====================================================== --}}

            <a href="{{ url('/pengurus/dashboard') }}"
               class="laporan-back">

                <span>←</span>

                <span>Kembali ke Dashboard</span>

            </a>


            <h1 class="laporan-title">
                Laporan Kegiatan
            </h1>


            <p class="laporan-subtitle">
                Pilih kegiatan untuk melihat laporan presensi berdasarkan periode dan status.
            </p>


            {{-- =====================================================
                INFO
            ====================================================== --}}

            <div class="laporan-info">

                <div class="laporan-info-icon">
                    📊
                </div>


                <div class="laporan-info-content">

                    <h2 class="laporan-info-title">
                        Laporan Presensi Per Kegiatan
                    </h2>


                    <p class="laporan-info-text">
                        Setiap kegiatan memiliki laporan presensi sendiri.
                        Pilih salah satu kegiatan untuk melihat data kehadiran,
                        melakukan filter laporan, dan mencetak laporan PDF.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                MAIN
            ====================================================== --}}

            <div class="laporan-main">


                {{-- HEADER MAIN --}}

                <div class="laporan-main-header">

                    <div class="laporan-heading">

                        <div class="laporan-heading-icon">
                            📚
                        </div>


                        <div>

                            <h2 class="laporan-heading-title">
                                Daftar Kegiatan
                            </h2>


                            <p class="laporan-heading-text">
                                Pilih kegiatan yang ingin dilihat laporannya.
                            </p>

                        </div>

                    </div>


                    <div class="laporan-total">

                        <span>▦</span>

                        <span>
                            {{ $kegiatan->count() }} Kegiatan
                        </span>

                    </div>

                </div>


                {{-- =================================================
                    DATA KEGIATAN
                ================================================== --}}

                @if($kegiatan->count() > 0)

                    <div class="laporan-grid">

                        @foreach($kegiatan as $item)

                            @php

                                $nama = strtolower($item->nama_kegiatan);

                                if (str_contains($nama, 'subuh')) {

                                    $icon = '🕌';
                                    $iconClass = 'icon-hijau';

                                } elseif (str_contains($nama, 'magrib')) {

                                    $icon = '🌙';
                                    $iconClass = 'icon-kuning';

                                } elseif (str_contains($nama, 'isya')) {

                                    $icon = '🌌';
                                    $iconClass = 'icon-biru';

                                } elseif (
                                    str_contains($nama, 'ngaji') ||
                                    str_contains($nama, 'quran') ||
                                    str_contains($nama, "qur'an")
                                ) {

                                    $icon = '📖';
                                    $iconClass = 'icon-ungu';

                                } elseif (str_contains($nama, 'roan')) {

                                    $icon = '🧹';
                                    $iconClass = 'icon-merah';

                                } else {

                                    $icon = '📋';
                                    $iconClass = 'icon-default';

                                }

                            @endphp


                            {{-- =================================================
                                CARD
                            ================================================== --}}

                            <div class="kegiatan-card">


                                <div class="kegiatan-icon {{ $iconClass }}">
                                    {{ $icon }}
                                </div>


                                <h3 class="kegiatan-title">
                                    {{ $item->nama_kegiatan }}
                                </h3>


                                <p class="kegiatan-description">

                                    @if($item->deskripsi)

                                        {{ $item->deskripsi }}

                                    @else

                                        Laporan presensi kegiatan
                                        {{ $item->nama_kegiatan }}.

                                    @endif

                                </p>


                                <div class="kegiatan-info">


                                    {{-- SESI --}}

                                    <div class="kegiatan-session">

                                        <span class="session-icon">
                                            📅
                                        </span>

                                        <span>
                                            {{ $item->sesi_presensi_count }}
                                            sesi
                                        </span>

                                    </div>


                                    {{-- STATUS --}}

                                    @if($item->status === 'aktif')

                                        <span class="status-aktif">

                                            <span class="status-aktif-dot"></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="status-nonaktif">

                                            Nonaktif

                                        </span>

                                    @endif

                                </div>


                                {{-- BUTTON --}}

                                <a href="{{ route(
                                    'pengurus.laporan-kegiatan.show',
                                    $item->id
                                ) }}"
                                   class="laporan-button">

                                    <span>📊</span>

                                    <span>
                                        Lihat Laporan
                                    </span>

                                    <span class="laporan-arrow">
                                        →
                                    </span>

                                </a>

                            </div>

                        @endforeach

                    </div>


                @else


                    {{-- =================================================
                        EMPTY
                    ================================================== --}}

                    <div class="laporan-empty">

                        <div class="laporan-empty-icon">
                            📋
                        </div>


                        <h3 class="laporan-empty-title">
                            Belum Ada Kegiatan
                        </h3>


                        <p class="laporan-empty-text">
                            Belum terdapat kegiatan yang dapat dibuatkan
                            laporan presensi.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>