<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="margin: 0; font-size: 22px; font-weight: 700; color: #1f2937;">
                Data Mahasantri
            </h2>
            <p style="margin: 4px 0 0; font-size: 14px; color: #6b7280;">
                Kelola data identitas, kamar, status, dan QR Code presensi mahasantri.
            </p>
        </div>
    </x-slot>

    <style>
        .mhs-wrap {
            max-width: 1150px;
            margin: 0 auto;
        }
        .mhs-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-box {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px 22px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .03);
        }
        .stat-label {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
        }
        .stat-val {
            font-size: 28px;
            font-weight: 800;
            color: #111827;
            margin-top: 6px;
        }
        .stat-val.green { color: #059669; }
        .stat-val.gray { color: #6b7280; }

        .table-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, .04);
            overflow: hidden;
        }
        .table-toolbar {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }
        .toolbar-title h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: #111827;
        }
        .toolbar-title p {
            margin: 3px 0 0;
            font-size: 13px;
            color: #6b7280;
        }
        .toolbar-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }
        .input-search, .select-filter {
            padding: 9px 13px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 13px;
            outline: none;
            background: #fff;
        }
        .input-search:focus, .select-filter:focus {
            border-color: #059669;
        }
        .btn-filter {
            padding: 9px 15px;
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-filter:hover { background: #d1fae5; }
        .btn-add {
            padding: 9px 16px;
            background: #059669;
            color: #ffffff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
        }
        .btn-add:hover { background: #047857; }

        .mhs-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }
        .mhs-table thead {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }
        .mhs-table th {
            padding: 14px 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #4b5563;
        }
        .mhs-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #1f2937;
            vertical-align: middle;
        }
        .mhs-table tbody tr:hover {
            background: #f9fafb;
        }
        .qr-pill {
            display: inline-block;
            padding: 4px 10px;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 7px;
            font-family: monospace;
            font-size: 12px;
            font-weight: 700;
            color: #374151;
        }
        .badge-aktif {
            display: inline-block;
            padding: 4px 11px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-nonaktif {
            display: inline-block;
            padding: 4px 11px;
            border-radius: 999px;
            background: #f3f4f6;
            color: #6b7280;
            font-size: 12px;
            font-weight: 700;
        }
        .aksi-group {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .btn-aksi {
            padding: 6px 11px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn-qr { background: #ecfdf5; color: #047857; }
        .btn-qr:hover { background: #d1fae5; }
        .btn-detail { background: #eff6ff; color: #1d4ed8; }
        .btn-detail:hover { background: #dbeafe; }
        .btn-edit { background: #fef3c7; color: #b45309; }
        .btn-edit:hover { background: #fde68a; }
        .btn-hapus { background: #fef2f2; color: #b91c1c; }
        .btn-hapus:hover { background: #fee2e2; }
    </style>

    <div class="mhs-wrap">
        {{-- RINGKASAN --}}
        <div class="mhs-stats">
            <div class="stat-box">
                <div class="stat-label">Total Mahasantri</div>
                <div class="stat-val">{{ $totalMahasantri ?? $mahasantri->total() }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Status Aktif</div>
                <div class="stat-val green">{{ $totalAktif ?? 0 }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Status Nonaktif</div>
                <div class="stat-val gray">{{ $totalNonaktif ?? 0 }}</div>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <div class="table-card">
            <div class="table-toolbar">
                <div class="toolbar-title">
                    <h3>Daftar Mahasantri</h3>
                    <p>Seluruh mahasantri yang terdaftar pada sistem presensi.</p>
                </div>

                <div class="toolbar-actions">
                    <form method="GET" action="{{ route('admin.mahasantri.index') }}" style="display:flex;flex-wrap:wrap;gap:8px;">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama, NIM, kamar..."
                            class="input-search"
                        >
                        <select name="status" class="select-filter">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <button type="submit" class="btn-filter">Filter</button>
                    </form>

                    <a href="{{ route('admin.mahasantri.create') }}" class="btn-add">
                        + Tambah Mahasantri
                    </a>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="mhs-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasantri</th>
                            <th>NIM</th>
                            <th>Kamar</th>
                            <th>Kode QR</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasantri as $item)
                            <tr>
                                <td>{{ $mahasantri->firstItem() + $loop->index }}</td>
                                <td>
                                    <div style="font-weight: 700; color: #111827;">{{ $item->user->name ?? '-' }}</div>
                                    <div style="font-size: 12px; color: #6b7280;">{{ $item->user->email ?? '-' }}</div>
                                </td>
                                <td style="font-weight: 600;">{{ $item->nim }}</td>
                                <td>{{ $item->kamar ?? '-' }}</td>
                                <td><span class="qr-pill">{{ $item->qr_code ?? '-' }}</span></td>
                                <td>
                                    @if(($item->status ?? 'aktif') === 'aktif')
                                        <span class="badge-aktif">Aktif</span>
                                    @else
                                        <span class="badge-nonaktif">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="aksi-group">
                                        <a href="{{ route('admin.mahasantri.qr', $item->id) }}" class="btn-aksi btn-qr">QR Code</a>
                                        <a href="{{ route('admin.mahasantri.show', $item->id) }}" class="btn-aksi btn-detail">Detail</a>
                                        <a href="{{ route('admin.mahasantri.edit', $item->id) }}" class="btn-aksi btn-edit">Edit</a>
                                        <form action="{{ route('admin.mahasantri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data mahasantri ini?');" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-aksi btn-hapus">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 40px 20px; text-align: center; color: #6b7280;">
                                    Belum ada data mahasantri yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($mahasantri->hasPages())
                <div style="padding: 16px 24px; border-top: 1px solid #f1f5f9;">
                    {{ $mahasantri->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>