
<x-admin-layout title="Data Kegiatan" breadcrumb="Data Kegiatan">

    <style>
        .kg-page {
            color: #17221d;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
        }

        .kg-page * { box-sizing: border-box; }

        .kg-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 26px;
        }

        .kg-eyebrow {
            margin: 0 0 7px;
            color: #087f5b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .kg-title {
            margin: 0;
            color: #17221d;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.6px;
            line-height: 1.3;
        }

        .kg-description {
            margin: 8px 0 0;
            color: #718078;
            font-size: 13px;
            line-height: 1.7;
        }

        .kg-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 37px;
            padding: 9px 12px;
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
            transition: background .18s ease;
        }

        .kg-btn:hover { background: #f7faf8; }

        .kg-btn-primary {
            min-height: 44px;
            padding: 11px 17px;
            border-color: #087f5b;
            background: #087f5b;
            color: #fff;
            box-shadow: 0 4px 10px rgba(8,127,91,.12);
        }

        .kg-btn-primary:hover {
            background: #066649;
            color: #fff;
        }

        .kg-detail { color: #1d5dc1; border-color: #d8e5fa; }
        .kg-edit { color: #98600a; border-color: #f1dfb8; }
        .kg-delete { color: #c43c3c; border-color: #f3d0d0; }
        .kg-delete:hover { background: #fff1f1; }

        .kg-alert {
            margin-bottom: 20px;
            padding: 14px 17px;
            border: 1px solid #ccebd7;
            border-radius: 11px;
            background: #effaf3;
            color: #087044;
            font-size: 13px;
        }

        .kg-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .kg-stat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-width: 0;
            padding: 21px;
            background: #fff;
            border: 1px solid #e4ebe6;
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(25,50,35,.025);
        }

        .kg-stat-label {
            margin: 0;
            color: #68776f;
            font-size: 12px;
            font-weight: 650;
        }

        .kg-stat-number {
            margin: 9px 0 5px;
            color: #17221d;
            font-size: 31px;
            font-weight: 800;
            letter-spacing: -.8px;
            line-height: 1.2;
        }

        .kg-stat-note {
            margin: 0;
            color: #8a9790;
            font-size: 11px;
            line-height: 1.5;
        }

        .kg-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 43px;
            width: 43px;
            height: 43px;
            border-radius: 12px;
            background: #eaf2ff;
            color: #326ac2;
            font-size: 20px;
        }

        .kg-icon-green { background: #eaf7f0; color: #087f5b; }
        .kg-icon-red { background: #fff0f0; color: #c43c3c; }

        .kg-panel {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e2e9e4;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(25,50,35,.025);
        }

        .kg-panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 21px 23px;
            border-bottom: 1px solid #edf1ee;
        }

        .kg-panel-title {
            margin: 0;
            color: #17221d;
            font-size: 16px;
            font-weight: 800;
        }

        .kg-panel-subtitle {
            margin: 5px 0 0;
            color: #829087;
            font-size: 12px;
            line-height: 1.6;
        }

        .kg-count {
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

        .kg-table-wrap { width: 100%; overflow-x: auto; }

        .kg-table {
            width: 100%;
            min-width: 760px;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .kg-table thead th {
            padding: 14px 17px;
            background: #f8faf9;
            border-bottom: 1px solid #e9efeb;
            color: #748178;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .kg-table tbody td {
            padding: 16px 17px;
            border-bottom: 1px solid #edf1ee;
            color: #4b5a50;
            font-size: 12px;
            vertical-align: middle;
        }

        .kg-table tbody tr:last-child td { border-bottom: 0; }
        .kg-table tbody tr:hover td { background: #fbfdfb; }

        .kg-number { color: #8a9790 !important; }

        .kg-name {
            color: #202d25;
            font-size: 13px;
            font-weight: 750;
            line-height: 1.5;
        }

        .kg-name-note {
            margin-top: 4px;
            color: #8a9790;
            font-size: 11px;
        }

        .kg-desc {
            min-width: 180px;
            max-width: 340px;
            color: #68776f;
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .kg-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .kg-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .kg-active { background: #eaf7ef; color: #087747; }
        .kg-inactive { background: #fff0f0; color: #bd3434; }

        .kg-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .kg-actions .kg-btn {
            min-height: 34px;
            padding: 8px 10px;
            font-size: 11px;
        }

        .kg-delete-form { margin: 0; }

        .kg-empty {
            padding: 48px 20px !important;
            text-align: center;
        }

        .kg-empty-icon { margin-bottom: 12px; font-size: 34px; }

        .kg-empty-title {
            margin: 0;
            color: #25352b;
            font-size: 16px;
            font-weight: 800;
        }

        .kg-empty-text {
            margin: 7px 0 18px;
            color: #829087;
            font-size: 12px;
            line-height: 1.7;
        }

        .kg-pagination {
            padding: 17px 22px;
            border-top: 1px solid #edf1ee;
        }

        @media (max-width: 1000px) {
            .kg-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 600px) {
            .kg-header { align-items: stretch; }
            .kg-header .kg-btn-primary { width: 100%; }
            .kg-stats { grid-template-columns: 1fr; gap: 12px; }
            .kg-stat { padding: 18px; }
            .kg-panel-heading { padding: 18px; }
            .kg-title { font-size: 23px; }
        }
    </style>

    <div class="kg-page">

        {{-- HEADER --}}
        <div class="kg-header">
            <div>
                <p class="kg-eyebrow">MANAJEMEN KEGIATAN</p>
                <h1 class="kg-title">Data Kegiatan</h1>
                <p class="kg-description">
                    Kelola kegiatan SmartTren yang digunakan untuk presensi.
                </p>
            </div>

            <a href="{{ route('admin.kegiatan.create') }}"
               class="kg-btn kg-btn-primary">
                <span style="font-size:18px">+</span>
                Tambah Kegiatan
            </a>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="kg-alert" role="status">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="kg-alert"
                 role="alert"
                 style="background:#fff4f4;border-color:#f3d1d1;color:#b42323">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- STATISTIK --}}
        <div class="kg-stats">

            <section class="kg-stat">
                <div>
                    <p class="kg-stat-label">Total Kegiatan</p>
                    <p class="kg-stat-number">{{ $kegiatan->total() }}</p>
                    <p class="kg-stat-note">Seluruh data kegiatan</p>
                </div>
                <div class="kg-stat-icon" aria-hidden="true">▤</div>
            </section>

            <section class="kg-stat">
                <div>
                    <p class="kg-stat-label">Kegiatan Aktif</p>
                    <p class="kg-stat-number" style="color:#087f5b">
                        {{ $kegiatan->where('status', 'aktif')->count() }}
                    </p>
                    <p class="kg-stat-note">Data aktif pada halaman ini</p>
                </div>
                <div class="kg-stat-icon kg-icon-green" aria-hidden="true">✓</div>
            </section>

            <section class="kg-stat">
                <div>
                    <p class="kg-stat-label">Kegiatan Nonaktif</p>
                    <p class="kg-stat-number" style="color:#c43c3c">
                        {{ $kegiatan->where('status', 'nonaktif')->count() }}
                    </p>
                    <p class="kg-stat-note">Data nonaktif pada halaman ini</p>
                </div>
                <div class="kg-stat-icon kg-icon-red" aria-hidden="true">Ⅱ</div>
            </section>

        </div>

        {{-- DAFTAR KEGIATAN --}}
        <section class="kg-panel">

            <div class="kg-panel-heading">
                <div>
                    <h2 class="kg-panel-title">Daftar Kegiatan</h2>
                    <p class="kg-panel-subtitle">
                        Periksa dan kelola kegiatan yang tersedia untuk presensi.
                    </p>
                </div>

                <span class="kg-count">{{ $kegiatan->total() }} data</span>
            </div>

            <div class="kg-table-wrap">
                <table class="kg-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kegiatan as $item)
                            <tr>
                                <td class="kg-number">
                                    {{ $loop->iteration + (($kegiatan->currentPage() - 1) * $kegiatan->perPage()) }}
                                </td>

                                <td>
                                    <div class="kg-name">{{ $item->nama_kegiatan }}</div>
                                    <div class="kg-name-note">Kegiatan SmartTren</div>
                                </td>

                                <td>
                                    <div class="kg-desc">
                                        {{ $item->deskripsi ?: '-' }}
                                    </div>
                                </td>

                                <td>
                                    @if($item->status === 'aktif')
                                        <span class="kg-status kg-active">
                                            <span class="kg-dot"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="kg-status kg-inactive">
                                            <span class="kg-dot"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="kg-actions">
                                        <a href="{{ route('admin.kegiatan.show', $item) }}"
                                           class="kg-btn kg-detail">
                                            Detail
                                        </a>

                                        <a href="{{ route('admin.kegiatan.edit', $item) }}"
                                           class="kg-btn kg-edit">
                                            Edit
                                        </a>

                                        <form class="kg-delete-form"
                                              action="{{ route('admin.kegiatan.destroy', $item) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kegiatan {{ $item->nama_kegiatan }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="kg-btn kg-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="kg-empty">
                                    <div class="kg-empty-icon">▤</div>
                                    <h3 class="kg-empty-title">Belum Ada Kegiatan</h3>
                                    <p class="kg-empty-text">
                                        Belum ada kegiatan yang terdaftar.
                                        Tambahkan kegiatan agar dapat dikelola melalui sistem.
                                    </p>
                                    <a href="{{ route('admin.kegiatan.create') }}"
                                       class="kg-btn kg-btn-primary">
                                        + Tambah Kegiatan
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($kegiatan->hasPages())
                <div class="kg-pagination">
                    {{ $kegiatan->links() }}
                </div>
            @endif

        </section>
    </div>

</x-admin-layout>
