<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Laporan Presensi</h2>
            <p class="mt-1 text-sm text-gray-500">Filter dan lihat rekap kehadiran Mahasantri.</p>
        </div>
    </x-slot>

    <style>
        .presensi-report { min-height:calc(100vh - 65px); padding:30px 0 44px; background:#f5f8f6; color:#193629; }
        .presensi-report .report-container { max-width:1320px; margin:0 auto; padding:0 24px; }
        .presensi-report .report-heading { margin-bottom:18px; }
        .presensi-report .report-heading h1 { margin:0; color:#183629; font-size:30px; font-weight:800; letter-spacing:-.6px; }
        .presensi-report .report-heading p { margin-top:8px; color:#718078; font-size:14px; }
        .presensi-report .report-panel,.presensi-report .report-table-panel { margin-bottom:18px; overflow:hidden; border:1px solid #e2eae5; border-radius:14px; background:#fff; box-shadow:0 5px 22px rgb(23 50 35 / 4%); }
        .presensi-report .report-panel-heading { padding:16px 20px 0; }
        .presensi-report .report-panel-heading h3,.presensi-report .report-table-heading h3 { margin:0; color:#1b3025; font-size:17px; font-weight:800; }
        .presensi-report .report-panel-heading p,.presensi-report .report-table-heading p { margin-top:4px; color:#78867d; font-size:12px; }
        .presensi-report .report-filter { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); align-items:start; gap:12px 20px; padding:14px 20px 18px; }
        .presensi-report .report-filter > div { min-width:0; }
        .presensi-report .report-filter #rentangTanggal { grid-column:1/-1; display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px 20px; margin-top:0; }
        .presensi-report .report-filter label { display:block; margin-bottom:5px; color:#405448; font-size:12px; font-weight:700; line-height:1.4; }
        .presensi-report .report-filter input,.presensi-report .report-filter select { display:block; box-sizing:border-box; width:100%; min-width:0; height:38px; padding:7px 11px; border:1px solid #d8e2db; border-radius:8px; background-color:#fff; color:#26392e; font-size:13px; line-height:1.4; outline:none; transition:border-color .2s,box-shadow .2s; }
        .presensi-report .report-filter select { cursor:pointer; }
        .presensi-report .report-filter input:hover,.presensi-report .report-filter select:hover { border-color:#b9cfc0; }
        .presensi-report .report-filter input:focus,.presensi-report .report-filter select:focus { border-color:#159663; box-shadow:0 0 0 3px rgb(8 127 80 / 9%); }
        .presensi-report .report-filter-actions { grid-column:1/-1; display:flex; align-items:center; flex-wrap:wrap; gap:8px; margin-top:0; padding-top:12px; border-top:1px solid #e8eeea; }
        .presensi-report .report-btn { display:inline-flex; min-height:38px; align-items:center; justify-content:center; padding:0 16px; border:1px solid transparent; border-radius:8px; font-size:12px; font-weight:700; text-decoration:none; cursor:pointer; transition:background .2s,transform .2s; }
        .presensi-report .report-btn:hover { transform:translateY(-1px); }
        .presensi-report .report-btn-primary { background:#0b9654; color:#fff; }
        .presensi-report .report-btn-primary:hover { background:#087744; }
        .presensi-report .report-btn-reset { border-color:#dce5df; background:#fff; color:#405448; }
        .presensi-report .report-btn-reset:hover { background:#f4f8f5; }
        .presensi-report .report-stats { display:grid; grid-template-columns:repeat(5,minmax(0,1fr)); gap:12px; margin-bottom:20px; }
        .presensi-report .report-stat { min-width:0; padding:16px 18px; border:1px solid #e3ebe5; border-radius:13px; background:#fff; box-shadow:0 4px 16px rgb(23 50 35 / 4%); transition:transform .2s,box-shadow .2s; }
        .presensi-report .report-stat:hover { transform:translateY(-2px); box-shadow:0 8px 22px rgb(23 50 35 / 7%); }
        .presensi-report .report-stat p { margin:0; font-size:13px; font-weight:600; }
        .presensi-report .report-stat .report-stat-number { margin-top:8px; font-size:27px; font-weight:800; line-height:1.2; }
        .presensi-report .report-stat-total p,.presensi-report .report-stat-total .report-stat-number { color:#24392d; }
        .presensi-report .report-stat-hadir { background:#effaf3; border-color:#d6efdf; }
        .presensi-report .report-stat-hadir p,.presensi-report .report-stat-hadir .report-stat-number { color:#167c45; }
        .presensi-report .report-stat-izin { background:#fff9e9; border-color:#f5e8bb; }
        .presensi-report .report-stat-izin p,.presensi-report .report-stat-izin .report-stat-number { color:#966b00; }
        .presensi-report .report-stat-sakit { background:#eff6ff; border-color:#dbeafe; }
        .presensi-report .report-stat-sakit p,.presensi-report .report-stat-sakit .report-stat-number { color:#2563a6; }
        .presensi-report .report-stat-alpa { background:#fff1f1; border-color:#f8dada; }
        .presensi-report .report-stat-alpa p,.presensi-report .report-stat-alpa .report-stat-number { color:#bd3838; }
        .presensi-report .report-table-panel { margin-bottom:0; }
        .presensi-report .report-table-heading { padding:21px 24px; border-bottom:1px solid #e8eeea; }
        .presensi-report .report-table-heading h3 { font-size:17px; }
        .presensi-report .report-table-wrap { overflow-x:auto; }
        .presensi-report .report-table { width:100%; border-collapse:collapse; text-align:left; }
        .presensi-report .report-table thead { background:#f5f9f6; }
        .presensi-report .report-table th { padding:15px 18px; border-bottom:1px solid #e4ebe6; color:#718078; font-size:11px; font-weight:800; letter-spacing:.4px; text-transform:uppercase; white-space:nowrap; }
        .presensi-report .report-table td { padding:15px 18px; border-bottom:1px solid #edf1ee; color:#526058; font-size:13px; vertical-align:middle; }
        .presensi-report .report-table tbody tr:hover { background:#f8fbf9; }
        .presensi-report .report-table tbody tr:last-child td { border-bottom:0; }
        .presensi-report .status-pill { display:inline-flex; align-items:center; border-radius:999px; padding:5px 11px; font-size:12px; font-weight:700; }
        .presensi-report .status-hadir { background:#dcfce7; color:#166534; }
        .presensi-report .status-izin { background:#fef3c7; color:#92400e; }
        .presensi-report .status-sakit { background:#dbeafe; color:#1d4ed8; }
        .presensi-report .status-alpa { background:#fee2e2; color:#b91c1c; }
        @media(max-width:1050px) { .presensi-report .report-stats { grid-template-columns:repeat(3,minmax(0,1fr)); } }
        @media(max-width:640px) {
            .presensi-report { padding:22px 0 30px; }
            .presensi-report .report-container { padding:0 12px; }
            .presensi-report .report-heading h1 { font-size:25px; }
            .presensi-report .report-filter { grid-template-columns:minmax(0,1fr); gap:12px; padding:14px 15px 16px; }
            .presensi-report .report-filter #rentangTanggal { grid-column:auto; grid-template-columns:minmax(0,1fr); gap:12px; }
            .presensi-report .report-filter-actions { grid-column:auto; }
            .presensi-report .report-btn { flex:1; }
            .presensi-report .report-stats { grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; }
            .presensi-report .report-stat { padding:13px; }
            .presensi-report .report-stat .report-stat-number { font-size:26px; }
            .presensi-report .report-table th,.presensi-report .report-table td { padding:13px 14px; white-space:nowrap; }
        }
        @media print {
            .presensi-report { background:#fff; padding:0; }
            .presensi-report .report-filter { display:none !important; }
            .presensi-report .report-stat,.presensi-report .report-table-panel { box-shadow:none; break-inside:avoid; }
        }

        

.presensi-report .report-filter-actions .report-btn {
    min-height: 40px;
    padding: 0 15px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 7px;
    gap: 6px;
}

.presensi-report .report-filter-actions .report-btn-pdf {
    background-color: #dc2626 !important;
    color: #fff !important;
    border: 1px solid #dc2626 !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    white-space: nowrap;
}

.presensi-report .report-filter-actions .report-btn-pdf:hover {
    background-color: #b91c1c !important;
    border-color: #b91c1c !important;
}

    </style>

    <div class="presensi-report">
        <div class="report-container">
            <div class="report-heading">
                <h1>Laporan Presensi</h1>
                <p>Gunakan filter untuk membuat laporan harian, mingguan, bulanan, atau berdasarkan rentang tanggal.</p>
            </div>

            <section class="report-panel">
                <div class="report-panel-heading">
                    <h3>Filter Laporan</h3>
                    <p>Tentukan periode dan data yang ingin ditampilkan.</p>
                </div>

                <form method="GET" action="{{ route('pengurus.laporan-presensi') }}" class="report-filter">
                    <div>
                        <label for="periode">Periode</label>
                        <select name="periode" id="periode">
                            <option value="harian" @selected($periode === 'harian')>Harian</option>
                            <option value="mingguan" @selected($periode === 'mingguan')>Mingguan</option>
                            <option value="bulanan" @selected($periode === 'bulanan')>Bulanan</option>
                            <option value="rentang" @selected($periode === 'rentang')>Rentang Tanggal</option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}">
                    </div>

                    <div>
                        <label for="kegiatan_id">Kegiatan</label>
                        <select name="kegiatan_id" id="kegiatan_id">
                            <option value="">Semua Kegiatan</option>
                            @foreach($kegiatan as $item)
                                <option value="{{ $item->id }}" @selected((string) request('kegiatan_id') === (string) $item->id)>
                                    {{ $item->nama_kegiatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="">Semua Status</option>
                            <option value="hadir" @selected(request('status') === 'hadir')>Hadir</option>
                            <option value="izin" @selected(request('status') === 'izin')>Izin</option>
                            <option value="sakit" @selected(request('status') === 'sakit')>Sakit</option>
                            <option value="alpa" @selected(request('status') === 'alpa')>Alpa</option>
                        </select>
                    </div>

                    <div id="rentangTanggal" class="grid gap-5 sm:grid-cols-2" style="grid-column:1/-1">
                        <div>
                            <label for="dari">Dari Tanggal</label>
                            <input type="date" id="dari" name="dari" value="{{ $dari }}">
                        </div>
                        <div>
                            <label for="sampai">Sampai Tanggal</label>
                            <input type="date" id="sampai" name="sampai" value="{{ $sampai }}">
                        </div>
                    </div>

                    
<div class="report-filter-actions">
    <button type="submit" class="report-btn report-btn-primary">
        Tampilkan Laporan
    </button>

    <a href="{{ route('pengurus.laporan-presensi') }}"
       class="report-btn report-btn-reset">
        Reset
    </a>

    <a href="{{ route('pengurus.laporan-presensi.pdf', request()->query()) }}"
       class="report-btn report-btn-pdf">
        Cetak / Unduh PDF
    </a>
</div>



            </section>

            <section class="report-stats" aria-label="Ringkasan presensi">
                <div class="report-stat report-stat-total"><p>Total</p><div class="report-stat-number">{{ $total }}</div></div>
                <div class="report-stat report-stat-hadir"><p>Hadir</p><div class="report-stat-number">{{ $hadir }}</div></div>
                <div class="report-stat report-stat-izin"><p>Izin</p><div class="report-stat-number">{{ $izin }}</div></div>
                <div class="report-stat report-stat-sakit"><p>Sakit</p><div class="report-stat-number">{{ $sakit }}</div></div>
                <div class="report-stat report-stat-alpa"><p>Alpa</p><div class="report-stat-number">{{ $alpa }}</div></div>
            </section>

            <section class="report-table-panel">
                <div class="report-table-heading">
                    <h3>Data Kehadiran</h3>
                    <p>Menampilkan {{ $total }} data presensi.</p>
                </div>
                <div class="report-table-wrap">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>No</th><th>Tanggal</th><th>Kegiatan</th><th>NIM</th><th>Nama</th><th>Status</th><th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($presensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->sesiPresensi->tanggal->format('d/m/Y') }}</td>
                                    <td class="font-semibold">{{ $item->sesiPresensi->kegiatan->nama_kegiatan }}</td>
                                    <td>{{ $item->mahasantri->nim }}</td>
                                    <td class="font-semibold">{{ $item->mahasantri->user?->name ?? '-' }}</td>
                                    <td>
                                        <span class="status-pill
                                            @if($item->status === 'hadir') status-hadir
                                            @elseif($item->status === 'izin') status-izin
                                            @elseif($item->status === 'sakit') status-sakit
                                            @else status-alpa @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->waktu_presensi ? $item->waktu_presensi->format('H:i:s') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        Tidak ada data presensi berdasarkan filter yang dipilih.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const periode = document.getElementById('periode');
            const rentang = document.getElementById('rentangTanggal');
            if (!periode || !rentang) return;

            function aturRentangTanggal() {
                rentang.style.display = periode.value === 'rentang' ? 'grid' : 'none';
            }

            periode.addEventListener('change', aturRentangTanggal);
            aturRentangTanggal();
        });
    </script>
</x-app-layout>
