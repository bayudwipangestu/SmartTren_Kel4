
<x-admin-layout title="Data Mahasantri" breadcrumb="Data Mahasantri">

    <style>
        .mhs-page {
            color: #17221d;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
        }

        .mhs-page * { box-sizing: border-box; }

        .mhs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 26px;
        }

        .mhs-eyebrow {
            margin: 0 0 7px;
            color: #087f5b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .mhs-title {
            margin: 0;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.7px;
            line-height: 1.3;
            color: #17221d;
        }

        .mhs-description {
            margin: 8px 0 0;
            color: #718078;
            font-size: 13px;
            line-height: 1.7;
        }

        .mhs-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 39px;
            padding: 9px 13px;
            border: 1px solid #e0e7e2;
            border-radius: 9px;
            background: #fff;
            color: #34443a;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
            white-space: nowrap;
            cursor: pointer;
            transition: .18s ease;
        }

        .mhs-btn:hover { background: #f7faf8; }

        .mhs-btn-primary {
            min-height: 44px;
            padding: 11px 17px;
            border-color: #087f5b;
            background: #087f5b;
            color: #fff;
            box-shadow: 0 4px 10px rgba(8,127,91,.12);
        }

        .mhs-btn-primary:hover {
            background: #066649;
            color: #fff;
        }

        .mhs-btn-detail { color: #1d5dc1; border-color: #d8e5fa; }
        .mhs-btn-qr { color: #087f5b; border-color: #ccebd9; }
        .mhs-btn-edit { color: #98600a; border-color: #f1dfb8; }
        .mhs-btn-delete { color: #c43c3c; border-color: #f3d0d0; }
        .mhs-btn-delete:hover { background: #fff1f1; }

        .mhs-alert {
            margin-bottom: 20px;
            padding: 14px 17px;
            border: 1px solid;
            border-radius: 11px;
            font-size: 13px;
            line-height: 1.6;
        }

        .mhs-alert-success {
            color: #087044;
            background: #effaf3;
            border-color: #ccebd7;
        }

        .mhs-alert-error {
            color: #b42323;
            background: #fff4f4;
            border-color: #f3d1d1;
        }

        .mhs-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .mhs-stat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-width: 0;
            padding: 22px 24px;
            background: #fff;
            border: 1px solid #e4ebe6;
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(25,50,35,.025);
        }

        .mhs-stat-label {
            margin: 0;
            color: #68776f;
            font-size: 12px;
            font-weight: 600;
        }

        .mhs-stat-number {
            margin: 8px 0 4px;
            color: #17221d;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .mhs-stat-note {
            margin: 0;
            color: #8a9790;
            font-size: 11px;
        }

        .mhs-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 46px;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #eaf2ff;
            color: #326ac2;
            font-size: 21px;
        }

        .mhs-stat-icon-green {
            background: #eaf7f0;
            color: #087f5b;
        }

        .mhs-panel {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e2e9e4;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(25,50,35,.025);
        }

        .mhs-panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 21px 23px;
            border-bottom: 1px solid #edf1ee;
        }

        .mhs-panel-title {
            margin: 0;
            color: #17221d;
            font-size: 16px;
            font-weight: 800;
        }

        .mhs-panel-description {
            margin: 5px 0 0;
            color: #829087;
            font-size: 12px;
            line-height: 1.6;
        }

        .mhs-count {
            display: inline-flex;
            align-items: center;
            padding: 7px 11px;
            border: 1px solid #e5ebe7;
            border-radius: 8px;
            background: #f7faf8;
            color: #56665c;
            font-size: 11px;
            font-weight: 750;
        }

        .mhs-table-wrap { width: 100%; overflow-x: auto; }

        .mhs-table {
            width: 100%;
            min-width: 850px;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .mhs-table thead th {
            padding: 13px 17px;
            background: #f8faf9;
            border-bottom: 1px solid #e9efeb;
            color: #748178;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .mhs-table tbody td {
            padding: 16px 17px;
            border-bottom: 1px solid #edf1ee;
            color: #4b5a50;
            font-size: 12px;
            vertical-align: middle;
        }

        .mhs-table tbody tr:last-child td { border-bottom: 0; }
        .mhs-table tbody tr:hover td { background: #fbfdfb; }

        .mhs-number {
            width: 55px;
            color: #8a9790 !important;
        }

        .mhs-person-name {
            color: #202d25;
            font-size: 13px;
            font-weight: 750;
            overflow-wrap: anywhere;
        }

        .mhs-person-email {
            margin-top: 4px;
            color: #8a9790;
            font-size: 11px;
            overflow-wrap: anywhere;
        }

        .mhs-nim {
            color: #34443a;
            font-family: Consolas, monospace;
            font-size: 12px;
            white-space: nowrap;
        }

        .mhs-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .mhs-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .mhs-status-active { background: #eaf7ef; color: #087747; }
        .mhs-status-inactive { background: #fff0f0; color: #bd3434; }

        .mhs-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .mhs-actions .mhs-btn {
            min-height: 34px;
            padding: 8px 10px;
            font-size: 11px;
        }

        .mhs-delete-form { margin: 0; }

        .mhs-empty {
            padding: 48px 20px !important;
            text-align: center;
        }

        .mhs-empty-icon {
            margin-bottom: 12px;
            font-size: 36px;
        }

        .mhs-empty-title {
            margin: 0;
            color: #25352b;
            font-size: 16px;
            font-weight: 800;
        }

        .mhs-empty-text {
            margin: 7px 0 18px;
            color: #829087;
            font-size: 12px;
        }

        .mhs-pagination {
            padding: 17px 22px;
            border-top: 1px solid #edf1ee;
        }

        @media (max-width: 760px) {
            .mhs-header { align-items: stretch; }
            .mhs-header .mhs-btn-primary { width: 100%; }
            .mhs-stats { gap: 12px; }
            .mhs-stat { padding: 17px; }
            .mhs-panel-heading { padding: 18px; }
        }

        @media (max-width: 520px) {
            .mhs-title { font-size: 23px; }
            .mhs-stats { grid-template-columns: 1fr; }
            .mhs-stat { padding: 19px; }
        }
    </style>

    <div class="mhs-page">

        {{-- HEADER --}}
        <div class="mhs-header">
            <div>
                <p class="mhs-eyebrow">Manajemen Mahasantri</p>
                <h1 class="mhs-title">Data Mahasantri</h1>
                <p class="mhs-description">
                    Kelola identitas, akun, status, dan QR Code Mahasantri SmartTrenMJ.
                </p>
            </div>

            <a href="{{ route('admin.mahasantri.create') }}"
               class="mhs-btn mhs-btn-primary">
                <span style="font-size:18px;line-height:1">+</span>
                Tambah Mahasantri
            </a>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="mhs-alert mhs-alert-success" role="status">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mhs-alert mhs-alert-error" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- STATISTIK --}}
        <div class="mhs-stats">
            <section class="mhs-stat">
                <div>
                    <p class="mhs-stat-label">Total Mahasantri</p>
                    <p class="mhs-stat-number">{{ $mahasantri->total() }}</p>
                    <p class="mhs-stat-note">Jumlah seluruh data terdaftar</p>
                </div>
                <div class="mhs-stat-icon" aria-hidden="true">♟</div>
            </section>

            <section class="mhs-stat">
                <div>
                    <p class="mhs-stat-label">Mahasantri Aktif</p>
                    <p class="mhs-stat-number" style="color:#087f5b">
                        {{ $mahasantri->where('status', 'aktif')->count() }}
                    </p>
                    <p class="mhs-stat-note">Data aktif pada halaman ini</p>
                </div>
                <div class="mhs-stat-icon mhs-stat-icon-green" aria-hidden="true">✓</div>
            </section>
        </div>

        {{-- TABEL MAHASANTRI --}}
        <section class="mhs-panel">
            <div class="mhs-panel-heading">
                <div>
                    <h2 class="mhs-panel-title">Daftar Mahasantri</h2>
                    <p class="mhs-panel-description">
                        Periksa identitas dan kelola data setiap Mahasantri.
                    </p>
                </div>

                <span class="mhs-count">
                    {{ $mahasantri->total() }} data
                </span>
            </div>

            <div class="mhs-table-wrap">
                <table class="mhs-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Mahasantri</th>
                            <th>NIM</th>
                            <th>Kamar</th>
                            <th>Status</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($mahasantri as $item)
                            <tr>
                                <td class="mhs-number">
                                    {{ $mahasantri->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="mhs-person-name">
                                        {{ $item->nama }}
                                    </div>
                                    <div class="mhs-person-email">
                                        {{ $item->user?->email ?? 'Email belum tersedia' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="mhs-nim">{{ $item->nim }}</span>
                                </td>

                                <td>{{ $item->kamar ?: '-' }}</td>

                                <td>
                                    @if($item->status === 'aktif')
                                        <span class="mhs-status mhs-status-active">
                                            <span class="mhs-status-dot"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="mhs-status mhs-status-inactive">
                                            <span class="mhs-status-dot"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="mhs-actions">
                                        <a href="{{ route('admin.mahasantri.show', $item) }}"
                                           class="mhs-btn mhs-btn-detail">
                                            Detail
                                        </a>

                                        <a href="{{ route('admin.mahasantri.qr', $item) }}"
                                           class="mhs-btn mhs-btn-qr">
                                            QR
                                        </a>

                                        <a href="{{ route('admin.mahasantri.edit', $item) }}"
                                           class="mhs-btn mhs-btn-edit">
                                            Edit
                                        </a>

                                        <form class="mhs-delete-form"
                                              action="{{ route('admin.mahasantri.destroy', $item) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data Mahasantri {{ $item->nama }} beserta akun penggunanya?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="mhs-btn mhs-btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="mhs-empty">
                                    <div class="mhs-empty-icon">♟</div>
                                    <h3 class="mhs-empty-title">
                                        Belum Ada Mahasantri
                                    </h3>
                                    <p class="mhs-empty-text">
                                        Belum ada data Mahasantri yang terdaftar.
                                    </p>
                                    <a href="{{ route('admin.mahasantri.create') }}"
                                       class="mhs-btn mhs-btn-primary">
                                        + Tambah Mahasantri
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($mahasantri->hasPages())
                <div class="mhs-pagination">
                    {{ $mahasantri->links() }}
                </div>
            @endif
        </section>
    </div>

</x-admin-layout>
