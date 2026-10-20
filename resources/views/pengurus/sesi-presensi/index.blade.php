
<x-app-layout>
    <style>
        /* ===== HALAMAN ===== */
        .sp-page {
            min-height: calc(100vh - 65px);
            padding: 28px 0 44px;
            background: #f4f7f5;
            color: #1b3025;
        }

        .sp-container {
            width: min(1320px, calc(100% - 48px));
            margin: 0 auto;
        }

        /* ===== HEADER ===== */
        .sp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 24px;
        }

        .sp-header-content {
            min-width: 0;
        }

        .sp-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 14px;
            color: #087f50;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .sp-back:hover {
            color: #055d3a;
        }

        .sp-title {
            margin: 0;
            color: #183126;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -.7px;
            line-height: 1.25;
        }

        .sp-subtitle {
            margin: 8px 0 0;
            color: #718078;
            font-size: 14px;
            line-height: 1.6;
        }

        .sp-create-btn {
            display: inline-flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 20px;
            border: 1px solid #087f50;
            border-radius: 10px;
            background: #087f50;
            color: #fff;
            font-size: 13px;
            font-weight: 750;
            text-decoration: none;
            box-shadow: 0 4px 10px rgb(8 127 80 / 10%);
            transition: background .2s, transform .2s;
        }

        .sp-create-btn:hover {
            background: #066640;
            transform: translateY(-1px);
        }

        /* ===== NOTIFIKASI ===== */
        .sp-alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #bde7cc;
            border-radius: 10px;
            background: #effaf3;
            color: #126c3c;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        /* ===== KARTU UTAMA ===== */
        .sp-card {
            overflow: hidden;
            border: 1px solid #e2eae5;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 5px 22px rgb(23 50 35 / 4%);
        }

        .sp-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 24px;
            border-bottom: 1px solid #eaf0ec;
        }

        .sp-card-title {
            margin: 0;
            color: #1b3025;
            font-size: 18px;
            font-weight: 800;
        }

        .sp-card-description {
            margin: 6px 0 0;
            color: #78867d;
            font-size: 13px;
            line-height: 1.6;
        }

        .sp-count {
            display: inline-flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            padding: 0 13px;
            border: 1px solid #d7efdf;
            border-radius: 999px;
            background: #edf8f1;
            color: #087f50;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* ===== FILTER ===== */
        .sp-filter {
            display: grid;
            grid-template-columns: minmax(150px, 1fr)
                minmax(160px, 1fr)
                minmax(145px, .9fr)
                auto auto;
            align-items: end;
            gap: 14px;
            padding: 20px 24px;
            border-bottom: 1px solid #eaf0ec;
            background: #fff;
        }

        .sp-filter-field {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 7px;
        }

        .sp-filter-label {
            color: #53645a;
            font-size: 12px;
            font-weight: 750;
        }

        .sp-filter-control {
            display: block;
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 0 12px;
            border: 1px solid #dce6df;
            border-radius: 9px;
            outline: none;
            background: #fff;
            color: #26392e;
            font-family: inherit;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .sp-filter-control:focus {
            border-color: #159663;
            box-shadow: 0 0 0 3px rgb(8 127 80 / 9%);
        }

        .sp-filter-btn,
        .sp-reset-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            padding: 0 17px;
            border: 1px solid transparent;
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 750;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s;
        }

        .sp-filter-btn {
            background: #087f50;
            color: #fff;
        }

        .sp-filter-btn:hover {
            background: #066640;
        }

        .sp-reset-btn {
            border-color: #e6ebe8;
            background: #f3f5f4;
            color: #53645a;
        }

        .sp-reset-btn:hover {
            background: #e9eeeb;
        }

        /* ===== TABEL ===== */
        .sp-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .sp-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .sp-table thead {
            background: #f7faf8;
        }

        .sp-table th {
            padding: 14px 18px;
            border-bottom: 1px solid #e4ebe6;
            color: #718078;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .45px;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .sp-table td {
            padding: 16px 18px;
            border-bottom: 1px solid #edf1ee;
            color: #526058;
            font-size: 13px;
            vertical-align: middle;
        }

        .sp-table tbody tr {
            transition: background .15s;
        }

        .sp-table tbody tr:hover {
            background: #f9fcfa;
        }

        .sp-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .sp-number {
            width: 55px;
            color: #849189 !important;
            font-weight: 700;
        }

        .sp-activity-name {
            color: #20362a;
            font-size: 13px;
            font-weight: 750;
        }

        .sp-date,
        .sp-time {
            color: #526058;
            white-space: nowrap;
        }

        /* ===== LABEL STATUS ===== */
        .sp-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .sp-status-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            flex-shrink: 0;
            border-radius: 50%;
        }

        .sp-status-active {
            background: #e8f7ee;
            color: #167c45;
        }

        .sp-status-active .sp-status-dot {
            background: #22a55a;
        }

        .sp-status-finished {
            background: #f0f3f1;
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

        .sp-status-scheduled {
            background: #fff6df;
            color: #916b00;
        }

        .sp-status-scheduled .sp-status-dot {
            background: #d99a00;
        }

        /* ===== TOMBOL AKSI ===== */
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
            min-height: 34px;
            padding: 0 11px;
            border: 1px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 11px;
            font-weight: 750;
            text-decoration: none;
            white-space: nowrap;
            transition: filter .15s, transform .15s;
        }

        .sp-action:hover {
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        .sp-action-scan {
            background: #087f50;
            color: #fff;
        }

        .sp-action-rekap {
            background: #edf5ff;
            color: #2569ad;
        }

        .sp-action-edit {
            background: #fff5dc;
            color: #926b00;
        }

        .sp-action-delete {
            background: #ffeded;
            color: #c43a3a;
        }

        /* ===== DATA KOSONG DAN PAGINATION ===== */
        .sp-empty {
            padding: 44px 20px;
            color: #718078;
            text-align: center;
        }

        .sp-empty strong {
            display: block;
            margin-bottom: 7px;
            color: #26392e;
            font-size: 16px;
        }

        .sp-empty p {
            margin: 0;
            font-size: 13px;
            line-height: 1.6;
        }

        .sp-pagination {
            padding: 16px 22px;
            border-top: 1px solid #edf1ee;
        }

        /* ===== TABLET ===== */
        @media (max-width: 1050px) {
            .sp-container {
                width: calc(100% - 36px);
            }

            .sp-filter {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .sp-filter-btn,
            .sp-reset-btn {
                width: 100%;
            }
        }

        /* ===== HP ===== */
        @media (max-width: 640px) {
            .sp-page {
                padding: 22px 0 32px;
            }

            .sp-container {
                width: calc(100% - 24px);
            }

            .sp-header {
                align-items: stretch;
                flex-direction: column;
                gap: 18px;
                margin-bottom: 20px;
            }

            .sp-title {
                font-size: 26px;
            }

            .sp-create-btn {
                width: 100%;
            }

            .sp-card {
                border-radius: 12px;
            }

            .sp-card-top {
                align-items: flex-start;
                padding: 18px;
            }

            .sp-card-title {
                font-size: 16px;
            }

            .sp-card-description {
                font-size: 12px;
            }

            .sp-filter {
                grid-template-columns: minmax(0, 1fr);
                gap: 13px;
                padding: 17px;
            }

            .sp-filter-control,
            .sp-filter-btn,
            .sp-reset-btn {
                height: 44px;
            }

            .sp-table {
                min-width: 850px;
            }

            .sp-table th,
            .sp-table td {
                padding: 13px 15px;
            }
        }
    </style>

    <div class="sp-page">
        <div class="sp-container">

            {{-- HEADER --}}
            <div class="sp-header">
                <div class="sp-header-content">
                    <a href="{{ route('pengurus.dashboard') }}" class="sp-back">
                        ← Kembali ke Dashboard
                    </a>

                    <h1 class="sp-title">Sesi Presensi</h1>

                    <p class="sp-subtitle">
                        Kelola sesi presensi dan pantau jadwal kegiatan mahasantri.
                    </p>
                </div>

                <a href="{{ route('pengurus.sesi-presensi.create') }}"
                   class="sp-create-btn">
                    + Buat Sesi Presensi
                </a>
            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="sp-alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- KARTU DAFTAR SESI --}}
            <div class="sp-card">

                <div class="sp-card-top">
                    <div>
                        <h2 class="sp-card-title">Daftar Sesi Presensi</h2>

                        <p class="sp-card-description">
                            Gunakan filter untuk mencari sesi, lalu pilih aksi yang diperlukan.
                        </p>
                    </div>

                    <span class="sp-count">
                        {{ $sesi->total() }} Sesi
                    </span>
                </div>

                {{-- FILTER: LOGIKA TETAP SAMA --}}
                <form method="GET"
                      action="{{ route('pengurus.sesi-presensi.index') }}"
                      class="sp-filter">

                    <div class="sp-filter-field">
                        <label for="tanggal" class="sp-filter-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="sp-filter-control"
                        >
                    </div>

                    <div class="sp-filter-field">
                        <label for="kegiatan_id" class="sp-filter-label">
                            Kegiatan
                        </label>

                        <select
                            id="kegiatan_id"
                            name="kegiatan_id"
                            class="sp-filter-control"
                        >
                            <option value="">Semua kegiatan</option>

                            @foreach($kegiatan as $k)
                                <option
                                    value="{{ $k->id }}"
                                    @selected(request('kegiatan_id') == $k->id)
                                >
                                    {{ $k->nama_kegiatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sp-filter-field">
                        <label for="status" class="sp-filter-label">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="sp-filter-control"
                        >
                            <option value="">Semua status</option>
                            <option value="aktif" @selected(request('status') === 'aktif')>
                                Aktif
                            </option>
                            <option value="selesai" @selected(request('status') === 'selesai')>
                                Selesai
                            </option>
                            <option value="dibatalkan" @selected(request('status') === 'dibatalkan')>
                                Dibatalkan
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="sp-filter-btn">
                        Terapkan Filter
                    </button>

                    <a href="{{ route('pengurus.sesi-presensi.index') }}"
                       class="sp-reset-btn">
                        Reset
                    </a>
                </form>

                



                {{-- TABEL --}}
                <div class="sp-table-wrapper">
                    <table class="sp-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No.</th>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($sesi as $item)
                                @php
                                    $sekarang = \Carbon\Carbon::now('Asia/Jakarta');

                                    $tanggalSesi = \Carbon\Carbon::parse(
                                        $item->tanggal->format('Y-m-d'),
                                        'Asia/Jakarta'
                                    );

                                    $waktuMulai = \Carbon\Carbon::parse(
                                        $tanggalSesi->format('Y-m-d') . ' ' . $item->jam_mulai,
                                        'Asia/Jakarta'
                                    );

                                    $waktuSelesai = \Carbon\Carbon::parse(
                                        $tanggalSesi->format('Y-m-d') . ' ' . $item->jam_selesai,
                                        'Asia/Jakarta'
                                    );

                                    $jadwalBerlangsung =
                                        $sekarang->greaterThanOrEqualTo($waktuMulai)
                                        && $sekarang->lt($waktuSelesai);
                                @endphp

                                <tr>
                                    <td class="sp-number">
                                        {{ $sesi->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <span class="sp-activity-name">
                                            {{ $item->kegiatan->nama_kegiatan ?? 'Kegiatan tidak tersedia' }}
                                        </span>
                                    </td>

                                    <td class="sp-date">
                                        {{ $item->tanggal->format('d/m/Y') }}
                                    </td>

                                    <td class="sp-time">
                                        {{ substr($item->jam_mulai, 0, 5) }}
                                        -
                                        {{ substr($item->jam_selesai, 0, 5) }}
                                    </td>

                                    <td>
                                        @if($item->status === 'selesai')
                                            <span class="sp-status sp-status-finished">
                                                <span class="sp-status-dot"></span>
                                                Selesai
                                            </span>

                                        @elseif($item->status !== 'aktif')
                                            <span class="sp-status sp-status-cancelled">
                                                <span class="sp-status-dot"></span>
                                                Dibatalkan
                                            </span>

                                        @elseif($sekarang->lt($waktuMulai))
                                            <span class="sp-status sp-status-scheduled">
                                                <span class="sp-status-dot"></span>
                                                Terjadwal
                                            </span>

                                        @elseif($sekarang->greaterThanOrEqualTo($waktuSelesai))
                                            <span class="sp-status sp-status-finished">
                                                <span class="sp-status-dot"></span>
                                                Waktu Habis
                                            </span>

                                        @else
                                            <span class="sp-status sp-status-active">
                                                <span class="sp-status-dot"></span>
                                                Berlangsung
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="sp-actions">
                                            @if($item->status === 'aktif' && $jadwalBerlangsung)
                                                <a
                                                    href="{{ route('pengurus.presensi.scanner', $item) }}"
                                                    class="sp-action sp-action-scan"
                                                >
                                                    Scan QR
                                                </a>
                                            @endif

                                            <a
                                                href="{{ route('pengurus.presensi.rekap', $item) }}"
                                                class="sp-action sp-action-rekap"
                                            >
                                                Rekap
                                            </a>

                                            <a
                                                href="{{ route('pengurus.sesi-presensi.edit', $item) }}"
                                                class="sp-action sp-action-edit"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('pengurus.sesi-presensi.destroy', $item) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus sesi presensi ini?')"
                                                style="margin: 0;"
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
                                <tr>
                                    <td colspan="6">
                                        <div class="sp-empty">
                                            <strong>Belum Ada Sesi Presensi</strong>

                                            <p>
                                                Belum ada sesi yang sesuai dengan data yang tersedia.
                                                Kamu bisa membuat sesi baru melalui tombol di atas.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($sesi->hasPages())
                    <div class="sp-pagination">
                        {{ $sesi->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
