<x-app-layout>
    <style>
        .pengurus-dashboard {
            --green: #078653;
            --green-dark: #104b38;
            --muted: #829087;
            --border: #e5ece7;
            color: #18382b;
            font-size: 13px;
        }

        .pengurus-dashboard * {
            box-sizing: border-box;
        }

        .pengurus-dashboard .container-dashboard {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 24px 28px;
        }

        /* Header */
        .pengurus-dashboard .top-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 22px;
        }

        .pengurus-dashboard .breadcrumb {
            margin-bottom: 8px;
            color: #829087;
            font-size: 11px;
        }

        .pengurus-dashboard .page-title {
            margin: 0;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.7px;
            color: #123f30;
        }

        .pengurus-dashboard .page-subtitle {
            margin-top: 7px;
            color: #7b8981;
            font-size: 12px;
        }

        .pengurus-dashboard .heading-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pengurus-dashboard .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border: 1px solid #d6eee1;
            border-radius: 9px;
            background: #eaf8f0;
            color: #087f52;
            font-size: 11px;
            font-weight: 700;
        }

        .pengurus-dashboard .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #10b981;
        }

        .pengurus-dashboard .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 15px;
            border-radius: 9px;
            background: var(--green);
            color: white;
            font-size: 12px;
            font-weight: 750;
            text-decoration: none;
            transition: .2s ease;
        }

        .pengurus-dashboard .primary-button:hover {
            background: #066d43;
            transform: translateY(-1px);
        }

        /* Welcome banner */
        .pengurus-dashboard .welcome-banner {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            overflow: hidden;
            min-height: 225px;
            margin-bottom: 22px;
            padding: 32px 35px;
            border-radius: 17px;
            background: linear-gradient(115deg, #103f32 0%, #087650 70%, #078653 100%);
            color: white;
        }

        .pengurus-dashboard .welcome-banner::before {
            position: absolute;
            top: -190px;
            right: 16%;
            width: 400px;
            height: 400px;
            border: 35px solid rgba(255, 255, 255, .035);
            border-radius: 50%;
            content: "";
            pointer-events: none;
        }

        .pengurus-dashboard .welcome-copy {
            position: relative;
            z-index: 1;
            max-width: 700px;
        }

        .pengurus-dashboard .eyebrow {
            margin-bottom: 14px;
            color: #a8f0cf;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .pengurus-dashboard .welcome-title {
            margin: 0;
            color: white;
            font-size: clamp(23px, 2.4vw, 34px);
            font-weight: 850;
            line-height: 1.25;
            letter-spacing: -.7px;
        }

        .pengurus-dashboard .welcome-description {
            max-width: 650px;
            margin-top: 12px;
            color: #d6eee5;
            font-size: 12px;
            line-height: 1.9;
        }

        .pengurus-dashboard .welcome-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 20px;
        }

        .pengurus-dashboard .banner-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 14px;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 8px;
            color: white;
            font-size: 11px;
            font-weight: 750;
            text-decoration: none;
            transition: .2s ease;
        }

        .pengurus-dashboard .banner-button-light {
            border-color: white;
            background: white;
            color: #104b38;
        }

        .pengurus-dashboard .banner-button:hover {
            background: rgba(255, 255, 255, .12);
        }

        .pengurus-dashboard .banner-button-light:hover {
            background: #e9f7ef;
        }

        .pengurus-dashboard .brand-mark {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 190px;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, .18);
            text-align: center;
        }

        .pengurus-dashboard .brand-symbol {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 82px;
            height: 82px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 25px;
            background: rgba(255, 255, 255, .07);
            color: white;
            font-size: 27px;
            font-weight: 900;
            transform: rotate(45deg);
        }

        .pengurus-dashboard .brand-symbol span {
            transform: rotate(-45deg);
        }

        .pengurus-dashboard .brand-name {
            font-size: 12px;
            font-weight: 850;
            letter-spacing: 2px;
        }

        .pengurus-dashboard .brand-caption {
            margin-top: 5px;
            color: #c3e7d8;
            font-size: 9px;
        }

        /* Statistics */
        .pengurus-dashboard .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .pengurus-dashboard .stat-card {
            position: relative;
            overflow: hidden;
            min-width: 0;
            padding: 19px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: white;
            box-shadow: 0 3px 9px rgba(24, 56, 43, .035);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .pengurus-dashboard .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(24, 56, 43, .08);
        }

        .pengurus-dashboard .stat-card::after {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 4px;
            background: var(--accent, #078653);
            content: "";
        }

        .pengurus-dashboard .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .pengurus-dashboard .stat-label {
            color: #66786d;
            font-size: 12px;
            font-weight: 600;
        }

        .pengurus-dashboard .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--icon-bg, #e5f5eb);
            color: var(--accent, #078653);
            font-size: 11px;
            font-weight: 850;
        }

        .pengurus-dashboard .stat-value {
            margin-top: 20px;
            color: #103f30;
            font-size: 31px;
            font-weight: 850;
            line-height: 1.1;
        }

        .pengurus-dashboard .stat-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 17px;
        }

        .pengurus-dashboard .stat-note {
            color: #92a097;
            font-size: 10px;
        }

        .pengurus-dashboard .stat-link {
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
            text-decoration: none;
        }

        /* Content panels */
        .pengurus-dashboard .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .pengurus-dashboard .panel {
            min-width: 0;
            padding: 21px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: white;
            box-shadow: 0 3px 9px rgba(24, 56, 43, .025);
        }

        .pengurus-dashboard .panel-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
        }

        .pengurus-dashboard .panel-title {
            margin: 0;
            color: #164531;
            font-size: 15px;
            font-weight: 850;
        }

        .pengurus-dashboard .panel-description {
            margin-top: 5px;
            color: #89968e;
            font-size: 11px;
        }

        .pengurus-dashboard .panel-tag {
            flex-shrink: 0;
            padding: 7px 9px;
            border-radius: 6px;
            background: #f0f5f1;
            color: #718178;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .pengurus-dashboard .quick-list {
            display: flex;
            flex-direction: column;
        }

        .pengurus-dashboard .quick-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 0;
            border-top: 1px solid #edf1ee;
            color: inherit;
            text-decoration: none;
            transition: padding .2s ease;
        }

        .pengurus-dashboard .quick-link:first-child {
            border-top: 0;
        }

        .pengurus-dashboard .quick-link:hover {
            padding-right: 5px;
            padding-left: 5px;
        }

        .pengurus-dashboard .quick-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 37px;
            height: 37px;
            flex-shrink: 0;
            border: 1px solid #dfe9e2;
            border-radius: 9px;
            background: #f7faf8;
            color: #267451;
            font-size: 10px;
            font-weight: 850;
        }

        .pengurus-dashboard .quick-title {
            color: #244a37;
            font-size: 11px;
            font-weight: 800;
        }

        .pengurus-dashboard .quick-description {
            margin-top: 4px;
            color: #8a978f;
            font-size: 10px;
            line-height: 1.5;
        }

        .pengurus-dashboard .quick-arrow {
            margin-left: auto;
            color: #7c9284;
            font-size: 19px;
        }

        /* Table */
        .pengurus-dashboard .table-panel {
            overflow: hidden;
            padding: 0;
            margin-bottom: 20px;
        }

        .pengurus-dashboard .table-panel .panel-header {
            padding: 20px 21px;
            margin-bottom: 0;
        }

        .pengurus-dashboard .table-wrap {
            overflow-x: auto;
        }

        .pengurus-dashboard .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .pengurus-dashboard .data-table th {
            padding: 13px 18px;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            background: #f6f9f7;
            color: #77867c;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .45px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .pengurus-dashboard .data-table td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf1ee;
            color: #4d6557;
            font-size: 11px;
        }

        .pengurus-dashboard .empty-state {
            padding: 30px 15px !important;
            color: #89968e !important;
            text-align: center;
            line-height: 1.9;
        }

        .pengurus-dashboard .text-link {
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
        }

        .pengurus-dashboard .text-link:hover {
            text-decoration: underline;
        }

        .pengurus-dashboard .footer-note {
            padding: 2px 0 10px;
            color: #9aa69e;
            font-size: 10px;
            text-align: center;
        }

        @@media (max-width: 1100px) {
            .pengurus-dashboard .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .pengurus-dashboard .brand-mark {
                width: 145px;
            }

            .pengurus-dashboard .content-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        @@media (max-width: 650px) {
            .pengurus-dashboard .container-dashboard {
                padding: 18px 14px;
            }

            .pengurus-dashboard .page-title {
                font-size: 23px;
            }

            .pengurus-dashboard .top-heading {
                align-items: flex-start;
            }

            .pengurus-dashboard .heading-right {
                flex-wrap: wrap;
            }

            .pengurus-dashboard .welcome-banner {
                min-height: 0;
                padding: 25px 21px;
            }

            .pengurus-dashboard .brand-mark {
                display: none;
            }

            .pengurus-dashboard .welcome-title {
                font-size: 24px;
            }

            .pengurus-dashboard .stats-grid {
                gap: 10px;
            }

            .pengurus-dashboard .stat-card {
                padding: 13px;
            }

            .pengurus-dashboard .stat-value {
                margin-top: 15px;
                font-size: 26px;
            }

            .pengurus-dashboard .stat-bottom {
                align-items: flex-start;
                flex-direction: column;
                margin-top: 12px;
            }

            .pengurus-dashboard .panel {
                padding: 15px;
            }

            .pengurus-dashboard .table-panel {
                padding: 0;
            }

            .pengurus-dashboard .table-panel .panel-header {
                padding: 16px;
            }
        }
    </style>

    <div class="pengurus-dashboard">
        <main class="container-dashboard">

            {{-- PAGE HEADING --}}
            <header class="top-heading">
                <div>
                    <div class="breadcrumb">Workspace&nbsp; / &nbsp;Pengurus&nbsp; / &nbsp;Dashboard</div>
                    <h1 class="page-title">Dashboard Pengurus</h1>
                    <p class="page-subtitle">
                        Ringkasan operasional dan pengelolaan presensi SmartTrenMJ.
                    </p>
                </div>

                <div class="heading-right">
                    <span class="status-pill">
                        <span class="status-dot"></span>
                        Sistem aktif
                    </span>

                    <a href="{{ route('pengurus.sesi-presensi.index') }}"
                       class="primary-button">
                        <span aria-hidden="true">＋</span>
                        Sesi Presensi
                    </a>
                </div>
            </header>

            {{-- WELCOME BANNER --}}
            <section class="welcome-banner">
                <div class="welcome-copy">
                    <div class="eyebrow">Pengurus Workspace</div>

                    <h2 class="welcome-title">
                        Selamat datang, {{ auth()->user()->name ?? 'Pengurus' }}.
                    </h2>

                    <p class="welcome-description">
                        Kelola sesi presensi, pantau kehadiran mahasantri,
                        dan periksa laporan kegiatan pesantren dari satu tempat.
                    </p>

                    <div class="welcome-actions">
                        <a href="{{ route('pengurus.sesi-presensi.index') }}"
                           class="banner-button banner-button-light">
                            Kelola sesi presensi <span aria-hidden="true">↗</span>
                        </a>

                        <a href="{{ route('pengurus.laporan-presensi') }}"
                           class="banner-button">
                            Lihat laporan <span aria-hidden="true">↗</span>
                        </a>
                    </div>
                </div>

                <div class="brand-mark" aria-label="SmartTren">
                    <div class="brand-symbol"><span>ST</span></div>
                    <div class="brand-name">SMARTTREN</div>
                    <div class="brand-caption">Student Attendance Management</div>
                </div>
            </section>

            {{-- STATISTIC CARDS --}}
            <section class="stats-grid">
                <article class="stat-card" style="--accent:#07966a;--icon-bg:#e4f6ed">
                    <div class="stat-top">
                        <span class="stat-label">Total Sesi</span>
                        <span class="stat-icon">SS</span>
                    </div>
                    <div class="stat-value">—</div>
                    <div class="stat-bottom">
                        <span class="stat-note">Data sesi belum dihubungkan</span>
                        <a href="{{ route('pengurus.sesi-presensi.index') }}"
                           class="stat-link">Lihat detail ↗</a>
                    </div>
                </article>

                <article class="stat-card" style="--accent:#5887ee;--icon-bg:#eaf0ff">
                    <div class="stat-top">
                        <span class="stat-label">Kehadiran Hari Ini</span>
                        <span class="stat-icon">KH</span>
                    </div>
                    <div class="stat-value">—</div>
                    <div class="stat-bottom">
                        <span class="stat-note">Data presensi belum dihubungkan</span>
                        <a href="{{ route('pengurus.laporan-presensi') }}"
                           class="stat-link">Lihat detail ↗</a>
                    </div>
                </article>

                <article class="stat-card" style="--accent:#9863df;--icon-bg:#f1e9ff">
                    <div class="stat-top">
                        <span class="stat-label">Sesi Aktif</span>
                        <span class="stat-icon">SA</span>
                    </div>
                    <div class="stat-value">—</div>
                    <div class="stat-bottom">
                        <span class="stat-note">Data sesi belum dihubungkan</span>
                        <a href="{{ route('pengurus.sesi-presensi.index') }}"
                           class="stat-link">Lihat detail ↗</a>
                    </div>
                </article>

                <article class="stat-card" style="--accent:#e3a13c;--icon-bg:#fff2df">
                    <div class="stat-top">
                        <span class="stat-label">Pengajuan Izin</span>
                        <span class="stat-icon">IZ</span>
                    </div>
                    <div class="stat-value">—</div>
                    <div class="stat-bottom">
                        <span class="stat-note">Data pengajuan belum dihubungkan</span>
                        <a href="{{ route('pengurus.pengajuan-izin.index') }}"
                           class="stat-link">Lihat detail ↗</a>
                    </div>
                </article>
            </section>

            {{-- QUICK ACCESS AND SUMMARY --}}
            <section class="content-grid">

                <article class="panel">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">Akses cepat</h2>
                            <p class="panel-description">
                                Fitur utama untuk operasional presensi.
                            </p>
                        </div>
                        <span class="panel-tag">QUICK ACCESS</span>
                    </div>

                    <div class="quick-list">
                        <a href="{{ route('pengurus.sesi-presensi.index') }}"
                           class="quick-link">
                            <span class="quick-number">01</span>
                            <span>
                                <span class="quick-title">Sesi Presensi</span>
                                <span class="quick-description" style="display:block">
                                    Buat dan kelola sesi kegiatan.
                                </span>
                            </span>
                            <span class="quick-arrow">↗</span>
                        </a>

                        <a href="{{ route('pengurus.pengajuan-izin.index') }}"
                           class="quick-link">
                            <span class="quick-number">02</span>
                            <span>
                                <span class="quick-title">Pengajuan Izin / Sakit</span>
                                <span class="quick-description" style="display:block">
                                    Periksa pengajuan izin mahasantri.
                                </span>
                            </span>
                            <span class="quick-arrow">↗</span>
                        </a>

                        <a href="{{ route('pengurus.laporan-presensi') }}"
                           class="quick-link">
                            <span class="quick-number">03</span>
                            <span>
                                <span class="quick-title">Laporan Presensi</span>
                                <span class="quick-description" style="display:block">
                                    Lihat rekap presensi kegiatan.
                                </span>
                            </span>
                            <span class="quick-arrow">↗</span>
                        </a>
                    </div>
                </article>

                <article class="panel">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">Informasi sistem</h2>
                            <p class="panel-description">
                                Ringkasan akses dan aktivitas pengurus.
                            </p>
                        </div>
                        <span class="panel-tag">OVERVIEW</span>
                    </div>

                    <div class="quick-list">
                        <div class="quick-link">
                            <span class="quick-number">✓</span>
                            <span>
                                <span class="quick-title">Sistem presensi</span>
                                <span class="quick-description" style="display:block">
                                    Halaman pengurus siap digunakan.
                                </span>
                            </span>
                        </div>

                        <div class="quick-link">
                            <span class="quick-number">QR</span>
                            <span>
                                <span class="quick-title">Presensi QR</span>
                                <span class="quick-description" style="display:block">
                                    Kelola sesi melalui menu sesi presensi.
                                </span>
                            </span>
                        </div>

                        <div class="quick-link">
                            <span class="quick-number">PDF</span>
                            <span>
                                <span class="quick-title">Rekap laporan</span>
                                <span class="quick-description" style="display:block">
                                    Buka halaman laporan untuk melihat rekap.
                                </span>
                            </span>
                            <a href="{{ route('pengurus.laporan-presensi') }}"
                               class="text-link">Buka ↗</a>
                        </div>
                    </div>
                </article>
            </section>

            {{-- ATTENDANCE SESSIONS --}}
            <section class="panel table-panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Sesi Presensi Terbaru</h2>
                        <p class="panel-description">
                            Pantau jadwal dan status kegiatan pesantren.
                        </p>
                    </div>

                    <a href="{{ route('pengurus.sesi-presensi.index') }}"
                       class="text-link">
                        Lihat semua →
                    </a>
                </div>

                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="empty-state">
                                    Data sesi belum dihubungkan ke ringkasan dashboard.
                                    <br>
                                    <a href="{{ route('pengurus.sesi-presensi.index') }}"
                                       class="text-link">
                                        Buka halaman Sesi Presensi →
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <footer class="footer-note">
                SmartTrenMJ · Sistem Informasi Presensi Pesantren
            </footer>

        </main>
    </div>
</x-app-layout>