<x-app-layout>
    <div class="mhs-dashboard">

        <style>
            .mhs-dashboard,
            .mhs-dashboard * {
                box-sizing: border-box;
            }

            .mhs-dashboard {
                padding: 26px 30px 36px;
                color: #17372b;
                font-family: Figtree, sans-serif;
            }

            .mhs-dashboard a {
                text-decoration: none;
            }
.mhs-hero {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 30px;
                min-height: 220px;
                overflow: hidden;
                padding: 34px;
                border-radius: 15px;
                color: #fff;
                background: linear-gradient(115deg, #104d3c 0%, #087b55 68%, #07845b 100%);
                box-shadow: 0 12px 28px #0b68421c;
            }

            .mhs-hero::before {
                position: absolute;
                top: -180px;
                right: 180px;
                width: 420px;
                height: 420px;
                border: 35px solid #ffffff08;
                border-radius: 50%;
                content: "";
                pointer-events: none;
            }

            .mhs-hero-copy {
                position: relative;
                z-index: 1;
                max-width: 720px;
            }

            .mhs-eyebrow {
                margin-bottom: 18px;
                color: #a6f4cf;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 2px;
            }

            .mhs-hero h2 {
                margin: 0;
                color: white;
                font-size: clamp(23px, 2.3vw, 34px);
                font-weight: 800;
                line-height: 1.25;
                letter-spacing: -.7px;
            }

            .mhs-hero p {
                max-width: 650px;
                margin: 13px 0 20px;
                color: #e2f6eb;
                font-size: 12px;
                line-height: 1.9;
            }

            .mhs-hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 9px;
            }

            .mhs-btn-light,
            .mhs-btn-outline {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 9px;
                min-height: 38px;
                padding: 0 15px;
                border-radius: 8px;
                font-size: 11px;
                font-weight: 800;
                transition: .2s;
            }

            .mhs-btn-light {
                color: #12533d;
                background: white;
            }

            .mhs-btn-light:hover {
                background: #eaf8f0;
            }

            .mhs-btn-outline {
                color: white;
                border: 1px solid #ffffff42;
                background: #ffffff09;
            }

            .mhs-btn-outline:hover {
                background: #ffffff19;
            }

            .mhs-hero-brand {
                position: relative;
                z-index: 1;
                display: flex;
                flex: 0 0 180px;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 150px;
                border-bottom: 1px solid #ffffff25;
                color: white;
                text-align: center;
            }

            .mhs-emblem {
                display: grid;
                place-items: center;
                width: 85px;
                height: 85px;
                margin-bottom: 13px;
                transform: rotate(45deg);
                border: 1px solid #ffffff55;
                border-radius: 25px;
                background: #ffffff0a;
                font-size: 35px;
            }

            .mhs-emblem span {
                transform: rotate(-45deg);
            }

            .mhs-hero-brand strong {
                font-size: 11px;
                letter-spacing: 2px;
            }

            .mhs-hero-brand small {
                margin-top: 6px;
                color: #c2ead6;
                font-size: 9px;
            }

            .mhs-stats {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 13px;
                margin-top: 23px;
            }

            .mhs-stat {
                position: relative;
                overflow: hidden;
                min-width: 0;
                padding: 19px;
                border: 1px solid #e6ece8;
                border-bottom: 3px solid var(--accent);
                border-radius: 12px;
                background: white;
                box-shadow: 0 3px 10px #17372b05;
            }

            .mhs-stat-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
            }

            .mhs-stat-label {
                color: #6d8175;
                font-size: 11px;
            }

            .mhs-stat-icon {
                display: grid;
                place-items: center;
                width: 32px;
                height: 32px;
                border-radius: 9px;
                background: var(--soft);
                color: var(--accent);
                font-size: 14px;
                font-weight: 800;
            }

            .mhs-stat-number {
                margin-top: 16px;
                font-size: 29px;
                font-weight: 800;
                line-height: 1;
            }

            .mhs-stat-note {
                margin-top: 13px;
                color: #98a49c;
                font-size: 10px;
            }

            .mhs-bottom-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-top: 23px;
            }

            .mhs-panel {
                min-width: 0;
                padding: 22px;
                border: 1px solid #e6ece8;
                border-radius: 13px;
                background: white;
            }

            .mhs-panel-heading {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 10px;
                margin-bottom: 19px;
            }

            .mhs-panel-heading h3 {
                margin: 0;
                font-size: 15px;
                font-weight: 800;
            }

            .mhs-panel-heading p {
                margin: 6px 0 0;
                color: #8a9990;
                font-size: 11px;
            }

            .mhs-tag {
                padding: 7px 9px;
                border-radius: 6px;
                color: #6f8577;
                background: #f1f6f3;
                font-size: 8px;
                font-weight: 800;
                letter-spacing: .5px;
                white-space: nowrap;
            }

            .mhs-total {
                display: flex;
                align-items: baseline;
                gap: 9px;
                margin: 22px 0 16px;
            }

            .mhs-total strong {
                font-size: 30px;
                font-weight: 800;
            }

            .mhs-total span {
                color: #91a096;
                font-size: 10px;
            }

            .mhs-bar {
                display: flex;
                overflow: hidden;
                height: 9px;
                gap: 3px;
                border-radius: 10px;
                background: #edf2ee;
            }

            .mhs-bar span {
                min-width: 0;
                border-radius: 10px;
            }

            .mhs-legend {
                display: grid;
                gap: 15px;
                margin-top: 22px;
            }

            .mhs-legend-row {
                display: flex;
                align-items: center;
                gap: 9px;
                color: #74867b;
                font-size: 11px;
            }

            .mhs-legend-dot {
                flex: 0 0 8px;
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: var(--dot);
            }

            .mhs-legend-row strong {
                margin-left: auto;
                color: #274536;
            }

            .mhs-quick-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 13px 0;
                border-top: 1px solid #edf1ee;
                color: #234434;
            }

            .mhs-quick-number {
                display: grid;
                flex: 0 0 37px;
                place-items: center;
                width: 37px;
                height: 37px;
                border: 1px solid #e4ece6;
                border-radius: 9px;
                background: #f8fbf9;
                color: #078451;
                font-size: 10px;
                font-weight: 800;
            }

            .mhs-quick-copy {
                flex: 1;
                min-width: 0;
            }

            .mhs-quick-copy strong {
                display: block;
                font-size: 11px;
                font-weight: 800;
            }

            .mhs-quick-copy small {
                display: block;
                margin-top: 5px;
                color: #8b9991;
                font-size: 10px;
                line-height: 1.5;
            }

            .mhs-quick-arrow {
                color: #6b8a77;
                font-size: 17px;
            }

            @media (max-width: 1100px) {
                .mhs-dashboard {
                    padding: 22px;
                }

                .mhs-hero {
                    padding: 27px;
                }

                .mhs-hero-brand {
                    flex-basis: 125px;
                }

                .mhs-stats {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 760px) {
                .mhs-dashboard {
                    padding: 18px 14px 26px;
                }
.mhs-hero-brand { display: none; }

                .mhs-hero {
                    min-height: auto;
                    padding: 25px 20px;
                }

                .mhs-hero h2 {
                    font-size: 25px;
                }

                .mhs-hero p {
                    font-size: 11px;
                }

                .mhs-stats {
                    gap: 10px;
                }

                .mhs-stat {
                    padding: 14px;
                }

                .mhs-stat-number {
                    font-size: 25px;
                }

                .mhs-bottom-grid {
                    grid-template-columns: 1fr;
                    gap: 13px;
                }
            }

            @media (max-width: 360px) {
                .mhs-stats {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        @php
            /*
             * Gunakan nilai dari controller jika tersedia.
             * Nilai cadangan nol hanya untuk mencegah error tampilan.
             */
            $hadir = $hadir ?? $totalHadir ?? 0;
            $izin = $izin ?? $totalIzin ?? 0;
            $sakit = $sakit ?? $totalSakit ?? 0;
            $alfa = $alfa ?? $totalAlfa ?? 0;

            $totalPresensi = (int) $hadir + (int) $izin
                + (int) $sakit + (int) $alfa;
        @endphp

        <section class="mhs-hero">
            <div class="mhs-hero-copy">
                <div class="mhs-eyebrow">MAHASANTRI WORKSPACE</div>

                <h2>
                    Assalamu’alaikum,<br>
                    {{ auth()->user()->name ?? 'Mahasantri' }}!
                </h2>

                <p>
                    Selamat datang di Sistem Presensi SmartTrenMJ.
                    Pantau presensi kegiatan, riwayat kehadiran, serta
                    pengajuan izin atau sakit dari satu tempat.
                </p>

                <div class="mhs-hero-actions">
                    <a class="mhs-btn-light"
                       href="{{ route('mahasantri.presensi.index') }}">
                        Buka presensi <span>↗</span>
                    </a>

                    <a class="mhs-btn-outline"
                       href="{{ route('mahasantri.presensi.riwayat') }}">
                        Lihat riwayat
                    </a>
                </div>
            </div>

            <div class="mhs-hero-brand">
                <div class="mhs-emblem"><span>🕌</span></div>
                <strong>SMARTTREN</strong>
                <small>Student Attendance Management</small>
            </div>
        </section>

        <section class="mhs-stats">
            @foreach ([
                ['label' => 'Hadir', 'value' => $hadir, 'icon' => '✓', 'color' => '#079b68', 'soft' => '#e2f6ed'],
                ['label' => 'Izin', 'value' => $izin, 'icon' => 'i', 'color' => '#4385f5', 'soft' => '#e7efff'],
                ['label' => 'Sakit', 'value' => $sakit, 'icon' => '+', 'color' => '#dc8b12', 'soft' => '#fff2dd'],
                ['label' => 'Alfa', 'value' => $alfa, 'icon' => '!', 'color' => '#e34d63', 'soft' => '#ffe8ec'],
            ] as $stat)
                <article class="mhs-stat"
                         style="--accent:{{ $stat['color'] }};--soft:{{ $stat['soft'] }}">
                    <div class="mhs-stat-top">
                        <span class="mhs-stat-label">{{ $stat['label'] }}</span>
                        <span class="mhs-stat-icon">{{ $stat['icon'] }}</span>
                    </div>

                    <div class="mhs-stat-number">{{ $stat['value'] }}</div>
                    <div class="mhs-stat-note">Data presensi tersedia</div>
                </article>
            @endforeach
        </section>

        <section class="mhs-bottom-grid">

            <div class="mhs-panel">
                <div class="mhs-panel-heading">
                    <div>
                        <h3>Ringkasan Kehadiran</h3>
                        <p>Rekap status presensi kamu.</p>
                    </div>
                    <span class="mhs-tag">ATTENDANCE</span>
                </div>

                <div class="mhs-total">
                    <strong>{{ $totalPresensi }}</strong>
                    <span>Total catatan presensi</span>
                </div>

                <div class="mhs-bar">
                    @foreach ([
                        ['value' => $hadir, 'color' => '#079b68'],
                        ['value' => $izin, 'color' => '#4385f5'],
                        ['value' => $sakit, 'color' => '#dc8b12'],
                        ['value' => $alfa, 'color' => '#e34d63'],
                    ] as $part)
                        <span style="flex:{{ max(0, (int) $part['value']) }};background:{{ $part['color'] }}"></span>
                    @endforeach
                </div>

                <div class="mhs-legend">
                    @foreach ([
                        ['label' => 'Hadir', 'value' => $hadir, 'color' => '#079b68'],
                        ['label' => 'Izin', 'value' => $izin, 'color' => '#4385f5'],
                        ['label' => 'Sakit', 'value' => $sakit, 'color' => '#dc8b12'],
                        ['label' => 'Alfa', 'value' => $alfa, 'color' => '#e34d63'],
                    ] as $item)
                        <div class="mhs-legend-row"
                             style="--dot:{{ $item['color'] }}">
                            <span class="mhs-legend-dot"></span>
                            <span>{{ $item['label'] }}</span>
                            <strong>{{ $item['value'] }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mhs-panel">
                <div class="mhs-panel-heading">
                    <div>
                        <h3>Akses Cepat</h3>
                        <p>Menu utama untuk aktivitasmu.</p>
                    </div>
                    <span class="mhs-tag">QUICK ACCESS</span>
                </div>

                <a class="mhs-quick-item"
                   href="{{ route('mahasantri.presensi.index') }}">
                    <span class="mhs-quick-number">01</span>
                    <span class="mhs-quick-copy">
                        <strong>Presensi Kegiatan</strong>
                        <small>Lihat kegiatan dan akses presensi yang tersedia.</small>
                    </span>
                    <span class="mhs-quick-arrow">↗</span>
                </a>

                <a class="mhs-quick-item"
                   href="{{ route('mahasantri.presensi.riwayat') }}">
                    <span class="mhs-quick-number">02</span>
                    <span class="mhs-quick-copy">
                        <strong>Riwayat Presensi</strong>
                        <small>Periksa catatan kehadiran berdasarkan tanggal.</small>
                    </span>
                    <span class="mhs-quick-arrow">↗</span>
                </a>

                <a class="mhs-quick-item"
                   href="{{ route('mahasantri.pengajuan-izin.index') }}">
                    <span class="mhs-quick-number">03</span>
                    <span class="mhs-quick-copy">
                        <strong>Pengajuan Izin / Sakit</strong>
                        <small>Ajukan izin jika berhalangan mengikuti kegiatan.</small>
                    </span>
                    <span class="mhs-quick-arrow">↗</span>
                </a>

                <a class="mhs-quick-item"
                   href="{{ route('profile.edit') }}">
                    <span class="mhs-quick-number">04</span>
                    <span class="mhs-quick-copy">
                        <strong>Data Akun</strong>
                        <small>Periksa informasi akun kamu.</small>
                    </span>
                    <span class="mhs-quick-arrow">↗</span>
                </a>
            </div>

        </section>
    </div>
</x-app-layout>