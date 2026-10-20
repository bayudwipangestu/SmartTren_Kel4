```blade
<x-admin-layout title="Rekap & Laporan" breadcrumb="Rekap & Laporan">
    <style>
        .report-page {
            --rp-green: #07865b;
            --rp-green-dark: #066b49;
            --rp-green-light: #e7f5ee;
            --rp-border: #e5ece8;
            --rp-text: #172b24;
            --rp-muted: #718078;
            color: var(--rp-text);
            padding: 8px 0 28px;
        }

        .report-page * {
            box-sizing: border-box;
        }

        .rp-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .rp-eyebrow {
            color: var(--rp-green);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .rp-heading h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 750;
            letter-spacing: -.7px;
            color: #172b24;
        }

        .rp-description {
            margin: 7px 0 0;
            color: var(--rp-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .rp-online {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border: 1px solid var(--rp-border);
            background: #fff;
            border-radius: 999px;
            font-size: 12px;
            color: #52665b;
            white-space: nowrap;
        }

        .rp-online-dot {
            width: 8px;
            height: 8px;
            background: #19b875;
            border-radius: 50%;
        }

        .rp-stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .rp-stat {
            position: relative;
            min-width: 0;
            padding: 19px;
            overflow: hidden;
            border: 1px solid var(--rp-border);
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 3px 12px rgba(20, 60, 42, .025);
        }

        .rp-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 17px;
        }

        .rp-stat-label {
            color: #627168;
            font-size: 12px;
            font-weight: 600;
        }

        .rp-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            border-radius: 12px;
            background: #edf4f0;
            color: #426b57;
            font-size: 20px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .rp-stat-number {
            font-size: 30px;
            font-weight: 750;
            line-height: 1;
            letter-spacing: -.7px;
            color: #172b24;
        }

        .rp-stat-note {
            margin-top: 10px;
            color: #87938c;
            font-size: 12px;
        }

        .rp-stat.hadir .rp-stat-icon {
            background: #e2f5e9;
            color: #07834f;
        }

        .rp-stat.izin .rp-stat-icon {
            background: #e8efff;
            color: #3768c8;
        }

        .rp-stat.sakit .rp-stat-icon {
            background: #fff2d9;
            color: #a66b08;
        }

        .rp-stat.alpa .rp-stat-icon {
            background: #ffebeb;
            color: #cf3535;
        }

        .rp-stat.hadir .rp-stat-number { color: #07834f; }
        .rp-stat.izin .rp-stat-number { color: #3768c8; }
        .rp-stat.sakit .rp-stat-number { color: #a66b08; }
        .rp-stat.alpa .rp-stat-number { color: #cf3535; }

        .rp-panel {
            border: 1px solid var(--rp-border);
            background: #fff;
            border-radius: 17px;
            box-shadow: 0 4px 16px rgba(20, 60, 42, .035);
            margin-bottom: 18px;
            overflow: hidden;
        }

        .rp-panel-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 19px 22px;
            border-bottom: 1px solid #edf1ee;
        }

        .rp-panel-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 13px;
            background: var(--rp-green-light);
            color: var(--rp-green);
            font-size: 20px;
        }

        .rp-panel-title {
            margin: 0;
            color: #1c3027;
            font-size: 15px;
            font-weight: 750;
        }

        .rp-panel-subtitle {
            margin: 5px 0 0;
            color: var(--rp-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .rp-filter-body {
            padding: 21px 22px 22px;
        }

        .rp-filter-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px 20px;
        }

        .rp-field {
            min-width: 0;
        }

        .rp-field label {
            display: block;
            margin-bottom: 8px;
            color: #37483f;
            font-size: 12px;
            font-weight: 700;
        }

        .rp-control {
            display: block;
            width: 100%;
            min-width: 0;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #dfe8e2;
            border-radius: 10px;
            background-color: #fff;
            color: #26382f;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .rp-control:focus {
            border-color: #55b58a;
            box-shadow: 0 0 0 3px rgba(7, 134, 91, .09);
        }

        .rp-control::placeholder {
            color: #9aa69f;
        }

        .rp-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 21px;
            padding-top: 17px;
            border-top: 1px solid #edf1ee;
        }

        .rp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 41px;
            padding: 10px 17px;
            border: 1px solid transparent;
            border-radius: 10px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .rp-btn:hover {
            transform: translateY(-1px);
        }

        .rp-btn-primary {
            background: var(--rp-green);
            color: #fff;
        }

        .rp-btn-primary:hover {
            background: var(--rp-green-dark);
            color: #fff;
        }

        .rp-btn-light {
            background: #fff;
            color: #405047;
            border-color: #dfe8e2;
        }

        .rp-btn-light:hover {
            background: #f7faf8;
        }

        .rp-btn-pdf {
            margin-left: auto;
            background: #d93838;
            color: #fff;
        }

        .rp-btn-pdf:hover {
            background: #bb2929;
            color: #fff;
        }

        .rp-result-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 22px;
            border-bottom: 1px solid #edf1ee;
        }

        .rp-result-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .rp-result-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #edf7f1;
            color: #08794f;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .rp-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rp-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 12px;
        }

        .rp-table thead th {
            padding: 14px 13px;
            background: #f1f7f3;
            color: #50645a;
            font-size: 11px;
            font-weight: 750;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid #e4eee7;
        }

        .rp-table thead th:first-child {
            padding-left: 22px;
        }

        .rp-table tbody td {
            padding: 13px;
            color: #4d5c53;
            border-bottom: 1px solid #edf1ee;
            vertical-align: middle;
        }

        .rp-table tbody tr:last-child td {
            border-bottom: none;
        }

        .rp-table tbody tr:hover td {
            background: #fbfdfb;
        }

        .rp-table tbody td:first-child {
            padding-left: 22px;
        }

        .rp-number {
            color: #829087;
            font-variant-numeric: tabular-nums;
        }

        .rp-person {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 180px;
        }

        .rp-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #e3f4e9;
            color: #08794f;
            font-size: 11px;
            font-weight: 800;
        }

        .rp-person-name {
            color: #27382e;
            font-weight: 700;
            line-height: 1.5;
        }

        .rp-nim {
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .rp-room {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 7px;
            background: #f0f4f8;
            color: #50647a;
            font-size: 11px;
            white-space: nowrap;
        }

        .rp-date {
            white-space: nowrap;
        }

        .rp-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-width: 72px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .rp-status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .rp-status-hadir {
            background: #e3f5e9;
            color: #087b4c;
        }

        .rp-status-izin {
            background: #fff3d9;
            color: #9a6909;
        }

        .rp-status-sakit {
            background: #e9efff;
            color: #3a62bd;
        }

        .rp-status-alpa {
            background: #ffebeb;
            color: #c82f36;
        }

        .rp-empty {
            padding: 45px 20px !important;
            text-align: center;
            color: #89968e !important;
        }

        .rp-empty-icon {
            display: block;
            margin-bottom: 9px;
            font-size: 28px;
        }

        .rp-table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 22px;
            border-top: 1px solid #edf1ee;
        }

        .rp-footer-text {
            color: #7b8980;
            font-size: 12px;
        }

        .rp-pagination {
            min-width: 0;
        }

        .rp-pagination nav > div:first-child {
            display: none;
        }

        .rp-pagination nav > div:last-child {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 4px;
        }

        .rp-pagination a,
        .rp-pagination span[aria-current],
        .rp-pagination span[aria-disabled] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 33px;
            min-height: 33px;
            padding: 5px 10px;
            border: 1px solid #e1e9e3;
            border-radius: 8px;
            background: #fff;
            color: #58685e;
            font-size: 12px;
            text-decoration: none;
        }

        .rp-pagination span[aria-current] {
            background: var(--rp-green);
            color: #fff;
            border-color: var(--rp-green);
        }

        @media (max-width: 1100px) {
            .rp-stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .rp-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .report-page {
                padding-top: 2px;
            }

            .rp-heading {
                align-items: flex-start;
            }

            .rp-heading h2 {
                font-size: 22px;
            }

            .rp-online {
                padding: 8px 10px;
            }

            .rp-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .rp-stat {
                padding: 14px;
                border-radius: 13px;
            }

            .rp-stat-top {
                margin-bottom: 13px;
            }

            .rp-stat-icon {
                width: 33px;
                height: 33px;
            }

            .rp-stat-number {
                font-size: 26px;
            }

            .rp-filter-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .rp-panel-header,
            .rp-result-header {
                padding: 15px;
            }

            .rp-filter-body {
                padding: 17px 15px;
            }

            .rp-btn {
                flex: 1 1 auto;
            }

            .rp-btn-pdf {
                margin-left: 0;
                flex-basis: 100%;
            }

            .rp-result-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .rp-table-footer {
                align-items: flex-start;
                flex-direction: column;
                padding: 15px;
            }

            .rp-table thead th:first-child,
            .rp-table tbody td:first-child {
                padding-left: 15px;
            }
        }
    </style>

    @php
        $statCards = [
            [
                'label' => 'Total Presensi',
                'value' => $statistik['total'] ?? 0,
                'note' => 'Seluruh catatan',
                'icon' => '▤',
                'class' => 'total',
            ],
            [
                'label' => 'Hadir',
                'value' => $statistik['hadir'] ?? 0,
                'note' => 'Presensi kehadiran',
                'icon' => '✓',
                'class' => 'hadir',
            ],
            [
                'label' => 'Izin',
                'value' => $statistik['izin'] ?? 0,
                'note' => 'Izin tercatat',
                'icon' => '↗',
                'class' => 'izin',
            ],
            [
                'label' => 'Sakit',
                'value' => $statistik['sakit'] ?? 0,
                'note' => 'Sakit tercatat',
                'icon' => '+',
                'class' => 'sakit',
            ],
            [
                'label' => 'Alpa',
                'value' => $statistik['alpa'] ?? 0,
                'note' => 'Tidak hadir',
                'icon' => '!',
                'class' => 'alpa',
            ],
        ];
    @endphp

    <div class="report-page">
        {{-- Judul halaman --}}
        <div class="rp-heading">
            <div>
                <div class="rp-eyebrow">Pusat Laporan / Presensi Mahasantri</div>
                <h2>Rekap &amp; Laporan</h2>
                <p class="rp-description">
                    Pantau kehadiran mahasantri dan cetak laporan berdasarkan periode maupun kegiatan.
                </p>
            </div>

            <div class="rp-online">
                <span class="rp-online-dot"></span>
                Sistem Aktif
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="rp-stats">
            @foreach ($statCards as $card)
                <div class="rp-stat {{ $card['class'] }}">
                    <div class="rp-stat-top">
                        <span class="rp-stat-label">{{ $card['label'] }}</span>
                        <span class="rp-stat-icon">{{ $card['icon'] }}</span>
                    </div>

                    <div class="rp-stat-number">{{ $card['value'] }}</div>
                    <div class="rp-stat-note">{{ $card['note'] }}</div>
                </div>
            @endforeach
        </div>

        {{-- Filter laporan --}}
        <section class="rp-panel">
            <div class="rp-panel-header">
                <div class="rp-panel-icon">☷</div>
                <div>
                    <h3 class="rp-panel-title">Filter Laporan</h3>
                    <p class="rp-panel-subtitle">
                        Tentukan kriteria untuk menampilkan data presensi yang dibutuhkan.
                        Filter boleh dikosongkan.
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.laporan.index') }}" method="GET" class="rp-filter-body">
                <div class="rp-filter-grid">
                    <div class="rp-field">
                        <label for="dari">Dari tanggal</label>
                        <input
                            class="rp-control"
                            type="date"
                            id="dari"
                            name="dari"
                            value="{{ $filters['dari'] ?? request('dari') }}"
                        >
                    </div>

                    <div class="rp-field">
                        <label for="sampai">Sampai tanggal</label>
                        <input
                            class="rp-control"
                            type="date"
                            id="sampai"
                            name="sampai"
                            value="{{ $filters['sampai'] ?? request('sampai') }}"
                        >
                    </div>

                    <div class="rp-field">
                        <label for="kegiatan_id">Kegiatan</label>
                        <select class="rp-control" id="kegiatan_id" name="kegiatan_id">
                            <option value="">Semua kegiatan</option>
                            @foreach ($kegiatan as $itemKegiatan)
                                <option
                                    value="{{ $itemKegiatan->id }}"
                                    @selected((string) ($filters['kegiatan_id'] ?? request('kegiatan_id')) === (string) $itemKegiatan->id)
                                >
                                    {{ $itemKegiatan->nama_kegiatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="rp-field">
                        <label for="kamar">Kamar</label>
                        <select class="rp-control" id="kamar" name="kamar">
                            <option value="">Semua kamar</option>
                            @foreach ($kamar as $namaKamar)
                                <option
                                    value="{{ $namaKamar }}"
                                    @selected((string) ($filters['kamar'] ?? request('kamar')) === (string) $namaKamar)
                                >
                                    {{ $namaKamar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="rp-field">
                        <label for="search">Nama atau NIM</label>
                        <input
                            class="rp-control"
                            type="text"
                            id="search"
                            name="search"
                            value="{{ $filters['search'] ?? request('search') }}"
                            placeholder="Cari nama atau NIM..."
                        >
                    </div>

                    <div class="rp-field">
                        <label for="status">Status kehadiran</label>
                        <select class="rp-control" id="status" name="status">
                            <option value="">Semua status</option>
                            @foreach (['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'] as $value => $labelStatus)
                                <option
                                    value="{{ $value }}"
                                    @selected(strtolower((string) ($filters['status'] ?? request('status'))) === $value)
                                >
                                    {{ $labelStatus }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="rp-actions">
                    <button type="submit" class="rp-btn rp-btn-primary">
                        <span>⌕</span> Terapkan Filter
                    </button>

                    <a href="{{ route('admin.laporan.index') }}" class="rp-btn rp-btn-light">
                        ↻ Reset
                    </a>

                    <a
                        href="{{ route('admin.laporan.pdf', request()->query()) }}"
                        class="rp-btn rp-btn-pdf"
                        target="_blank"
                        rel="noopener"
                    >
                        ▤ Cetak / Unduh PDF
                    </a>
                </div>
            </form>
        </section>

        {{-- Tabel hasil rekap --}}
        <section class="rp-panel">
            <div class="rp-result-header">
                <div class="rp-result-heading">
                    <div class="rp-panel-icon">▤</div>
                    <div>
                        <h3 class="rp-panel-title">Hasil Rekap Presensi</h3>
                        <p class="rp-panel-subtitle">
                            Daftar kehadiran berdasarkan filter yang diterapkan.
                        </p>
                    </div>
                </div>

                <div class="rp-result-count">
                    <span class="rp-online-dot"></span>
                    {{ $laporan->total() }} data ditemukan
                </div>
            </div>

            <div class="rp-table-wrap">
                <table class="rp-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Mahasantri</th>
                            <th>NIM</th>
                            <th>Kamar</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($laporan as $item)
                            @php
                                $nama = $item->mahasantri?->nama ?? 'Data mahasantri tidak tersedia';
                                $inisial = collect(explode(' ', trim($nama)))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn ($kata) => mb_strtoupper(mb_substr($kata, 0, 1)))
                                    ->implode('');

                                $status = strtolower((string) $item->status);
                                $statusClass = in_array($status, ['hadir', 'izin', 'sakit', 'alpa'], true)
                                    ? $status
                                    : 'alpa';
                            @endphp

                            <tr>
                                <td class="rp-number">
                                    {{ ($laporan->firstItem() ?? 1) + $loop->index }}
                                </td>

                                <td>
                                    <div class="rp-person">
                                        <div class="rp-avatar">
                                            {{ $inisial ?: 'M' }}
                                        </div>
                                        <span class="rp-person-name">{{ $nama }}</span>
                                    </div>
                                </td>

                                <td class="rp-nim">
                                    {{ $item->mahasantri?->nim ?? '-' }}
                                </td>

                                <td>
                                    <span class="rp-room">
                                        {{ $item->mahasantri?->kamar ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->sesiPresensi?->kegiatan?->nama_kegiatan ?? '-' }}
                                </td>

                                <td class="rp-date">
                                    {{ $item->sesiPresensi?->tanggal
                                        ? \Illuminate\Support\Carbon::parse($item->sesiPresensi->tanggal)->format('d/m/Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="rp-status rp-status-{{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="rp-empty">
                                    <span class="rp-empty-icon">▤</span>
                                    <strong>Data presensi belum ditemukan</strong>
                                    <div style="margin-top: 6px;">
                                        Coba ubah filter tanggal, kegiatan, kamar, atau status.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="rp-table-footer">
                <div class="rp-footer-text">
                    @if ($laporan->total() > 0)
                        Menampilkan {{ $laporan->firstItem() }}–{{ $laporan->lastItem() }}
                        dari {{ $laporan->total() }} data
                    @else
                        Tidak ada data untuk ditampilkan
                    @endif
                </div>

                <div class="rp-pagination">
                    {{ $laporan->appends(request()->query())->links() }}
                </div>
            </div>
        </section>
    </div>
</x-admin-layout>
```