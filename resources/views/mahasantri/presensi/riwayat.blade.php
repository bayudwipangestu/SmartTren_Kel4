<x-app-layout>
    @php
        $riwayat = collect($presensi ?? []);
        $jumlahHadir = $riwayat->filter(fn ($item) => strtolower(trim($item->status ?? '')) === 'hadir')->count();
        $jumlahIzin = $riwayat->filter(fn ($item) => strtolower(trim($item->status ?? '')) === 'izin')->count();
        $jumlahSakit = $riwayat->filter(fn ($item) => strtolower(trim($item->status ?? '')) === 'sakit')->count();
        $jumlahAlfa = $riwayat->filter(fn ($item) => in_array(strtolower(trim($item->status ?? '')), ['alfa', 'alpha', 'tidak hadir']))->count();
        $daftarKegiatan = $riwayat->map(fn ($item) => $item->sesiPresensi->kegiatan->nama_kegiatan ?? null)->filter()->unique()->values();
    @endphp

    <style>
        .rp-page, .rp-page * { box-sizing: border-box; }
        .rp-page { width:100%; max-width:1480px; margin:0 auto; padding:28px clamp(16px,3vw,34px) 40px; color:#12352a; }
        .rp-muted { color:#71827b; }
        .rp-panel { min-width:0; background:#fff; border:1px solid #e3ece7; border-radius:17px; box-shadow:0 5px 18px rgba(20,55,42,.035); }
        .rp-hero { position:relative; isolation:isolate; overflow:hidden; background:linear-gradient(110deg,#064e3b,#07845c); border-radius:17px; padding:26px 28px; color:#fff; margin-bottom:20px; }
        .rp-hero:after { content:""; position:absolute; z-index:-1; width:250px; height:250px; border:28px solid rgba(255,255,255,.065); border-radius:50%; right:7%; top:-135px; pointer-events:none; }
        .rp-hero-label { margin:0; color:#a7f3d0; font-size:11px; line-height:1.4; font-weight:800; letter-spacing:.15em; }
        .rp-hero-title { margin:8px 0 0; color:#fff; font-size:clamp(20px,2vw,25px); line-height:1.3; font-weight:800; }
        .rp-hero-text { margin:8px 0 0; color:#e6fff4; font-size:13px; line-height:1.6; }
        .rp-stats { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; margin-bottom:20px; }
        .rp-stat { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; padding:20px; }
        .rp-stat-label { margin:0; color:#71827b; font-size:13px; }
        .rp-stat-number { margin:9px 0 0; color:#102d23; font-size:30px; line-height:1.15; font-weight:800; }
        .rp-stat-note { margin:7px 0 0; color:#8a9891; font-size:11px; line-height:1.4; }
        .rp-icon { display:flex; width:44px; height:44px; flex:0 0 44px; align-items:center; justify-content:center; border-radius:13px; font-size:20px; font-weight:700; }
        .rp-section-head { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:19px 22px; border-bottom:1px solid #edf2ef; }
        .rp-section-title { margin:0; color:#17372b; font-size:15px; line-height:1.4; font-weight:800; }
        .rp-section-desc { margin:4px 0 0; color:#7b8a83; font-size:12px; line-height:1.5; }
        .rp-filter-body { padding:20px 22px 22px; }
        .rp-filter-grid { display:grid; grid-template-columns:repeat(5,minmax(0,1fr)); gap:14px; align-items:start; }
        .rp-field { min-width:0; }
        .rp-field label { display:block; margin:0 0 7px; color:#52665c; font-size:12px; line-height:1.4; font-weight:700; }
        .rp-field input, .rp-field select, .rp-search { display:block; width:100%; max-width:100%; height:43px; margin:0; border:1px solid #dce6e0; border-radius:10px; background:#fff; padding:0 11px; color:#263e34; font-family:inherit; font-size:13px; line-height:normal; }
        .rp-field input:focus, .rp-field select:focus, .rp-search:focus { outline:none; border-color:#059669; box-shadow:0 0 0 3px rgba(5,150,105,.09); }
        .rp-filter-actions { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:12px; margin-top:18px; }
        .rp-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; min-height:42px; border-radius:10px; padding:0 16px; font-family:inherit; font-size:12px; line-height:1.3; font-weight:750; text-decoration:none; cursor:pointer; border:1px solid transparent; white-space:nowrap; }
        .rp-btn-primary { background:#047857; color:#fff; }
        .rp-btn-primary:hover { background:#065f46; }
        .rp-btn-light { background:#fff; border-color:#dce6e0; color:#34483e; }
        .rp-btn-light:hover { background:#f7faf8; }
        .rp-table-wrap { width:100%; overflow-x:auto; }
        .rp-table { width:100%; min-width:680px; border-collapse:collapse; }
        .rp-table th { background:#f5f9f7; color:#73847c; font-size:11px; letter-spacing:.035em; text-transform:uppercase; font-weight:800; text-align:left; padding:14px 18px; white-space:nowrap; }
        .rp-table td { padding:15px 18px; border-top:1px solid #edf2ef; font-size:13px; color:#52645c; vertical-align:middle; line-height:1.5; }
        .rp-table tbody tr:hover { background:#fbfdfc; }
        .rp-status { display:inline-flex; align-items:center; gap:7px; border-radius:999px; padding:6px 11px; font-size:12px; line-height:1.3; font-weight:750; white-space:nowrap; }
        .rp-dot { width:7px; height:7px; border-radius:50%; background:currentColor; }
        .rp-empty { padding:44px 20px; text-align:center; color:#71827b; }
        .rp-hidden { display:none !important; }
        .rp-footer-note { border-top:1px solid #edf2ef; background:#fbfdfc; padding:13px 22px; color:#71827b; font-size:11px; line-height:1.6; }
        @media (max-width:1100px) { .rp-filter-grid { grid-template-columns:repeat(3,minmax(0,1fr)); } .rp-stats { grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media (max-width:680px) { .rp-page { padding:20px 14px 30px; } .rp-hero { padding:22px 20px; } .rp-stats { grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; } .rp-stat { padding:15px; } .rp-icon { width:36px; height:36px; flex-basis:36px; border-radius:11px; } .rp-stat-number { font-size:26px; } .rp-filter-grid { grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px; } .rp-section-head { padding:16px; } .rp-filter-body { padding:16px; } .rp-filter-actions { align-items:stretch; } .rp-filter-actions .rp-btn { flex:1; } .rp-footer-note { padding:13px 16px; } }
        @media (max-width:420px) { .rp-stats, .rp-filter-grid { grid-template-columns:1fr; } .rp-stat { align-items:center; } .rp-filter-actions { flex-direction:column; } .rp-filter-actions .rp-btn { width:100%; } }
    </style>

    <main class="rp-page">
        {{-- Header judul dihapus karena sudah ditampilkan oleh layout utama. --}}
        <section class="rp-hero">
            <p class="rp-hero-label">RINGKASAN PRESENSI</p>
            <h2 class="rp-hero-title">Catatan Kehadiran Mahasantri</h2>
            <p class="rp-hero-text">Pantau kegiatan, tanggal, dan status kehadiranmu secara lengkap.</p>
        </section>

        <section class="rp-stats" aria-label="Ringkasan status presensi">
            @foreach ([['Hadir', $jumlahHadir, '✓', '#e4f8ef', '#059669'], ['Izin', $jumlahIzin, 'i', '#e8f1ff', '#2563eb'], ['Sakit', $jumlahSakit, '+', '#fff3d9', '#b77905'], ['Alfa', $jumlahAlfa, '!', '#ffe9ec', '#e11d48']] as $stat)
                <article class="rp-panel rp-stat">
                    <div>
                        <p class="rp-stat-label">{{ $stat[0] }}</p>
                        <p class="rp-stat-number">{{ $stat[1] }}</p>
                        <p class="rp-stat-note">Total catatan {{ strtolower($stat[0]) }}</p>
                    </div>
                    <div class="rp-icon" style="background:{{ $stat[3] }};color:{{ $stat[4] }}">{{ $stat[2] }}</div>
                </article>
            @endforeach
        </section>

        <section class="rp-panel" style="margin-bottom:20px">
            <div class="rp-section-head">
                <div>
                    <h2 class="rp-section-title">Filter Riwayat</h2>
                    <p class="rp-section-desc">Pilih periode, tanggal, kegiatan, atau status.</p>
                </div>
                <button type="button" id="rp-reset" class="rp-btn rp-btn-light">↻ Reset filter</button>
            </div>
            <div class="rp-filter-body">
                <div class="rp-filter-grid">
                    <div class="rp-field">
                        <label for="rp-periode">Periode</label>
                        <select id="rp-periode">
                            <option value="semua">Semua riwayat</option><option value="hari">Hari ini</option><option value="minggu">7 hari terakhir</option><option value="bulan">Bulan ini</option><option value="custom">Rentang tanggal</option>
                        </select>
                    </div>
                    <div class="rp-field"><label for="rp-awal">Tanggal mulai</label><input type="date" id="rp-awal"></div>
                    <div class="rp-field"><label for="rp-akhir">Tanggal akhir</label><input type="date" id="rp-akhir"></div>
                    <div class="rp-field">
                        <label for="rp-kegiatan">Kegiatan</label>
                        <select id="rp-kegiatan"><option value="">Semua kegiatan</option>@foreach ($daftarKegiatan as $nama)<option value="{{ $nama }}">{{ $nama }}</option>@endforeach</select>
                    </div>
                    <div class="rp-field">
                        <label for="rp-status">Status</label>
                        <select id="rp-status"><option value="">Semua status</option><option value="hadir">Hadir</option><option value="izin">Izin</option><option value="sakit">Sakit</option><option value="alfa">Alfa</option></select>
                    </div>
                </div>
                <div class="rp-filter-actions">
                    <p class="rp-section-desc" style="margin:0">Filter diterapkan pada catatan yang tersedia di halaman ini.</p>
                    <button type="button" id="rp-apply" class="rp-btn rp-btn-primary">⌕ Terapkan filter</button>
                </div>
            </div>
        </section>

        <section class="rp-panel" style="overflow:hidden">
            <div class="rp-section-head" style="flex-wrap:wrap">
                <div>
                    <h2 class="rp-section-title">Daftar Riwayat Presensi</h2>
                    <p class="rp-section-desc"><span id="rp-count">{{ $riwayat->count() }}</span> catatan ditampilkan</p>
                </div>
                <input type="search" id="rp-search" class="rp-search" style="max-width:300px" placeholder="Cari kegiatan atau status..." aria-label="Cari kegiatan atau status">
            </div>

            @if ($riwayat->isEmpty())
                <div class="rp-empty">
                    <div style="font-size:30px;margin-bottom:10px">▤</div>
                    <h3 style="font-weight:800;color:#34483e">Belum ada riwayat presensi</h3>
                    <p style="font-size:13px;margin-top:7px">Catatan kehadiran akan tampil setelah presensi tersimpan.</p>
                </div>
            @else
                <div class="rp-table-wrap">
                    <table class="rp-table">
                        <thead><tr><th style="width:65px">No.</th><th>Kegiatan</th><th>Tanggal</th><th>Waktu presensi</th><th>Status</th></tr></thead>
                        <tbody id="rp-tbody">
                            @foreach ($riwayat as $item)
                                @php
                                    $status = strtolower(trim($item->status ?? ''));
                                    $statusNormal = in_array($status, ['alfa', 'alpha', 'tidak hadir']) ? 'alfa' : $status;
                                    $waktu = $item->waktu_presensi ?? null;
                                    $tanggal = $item->sesiPresensi->tanggal ?? $waktu;
                                    $namaKegiatan = $item->sesiPresensi->kegiatan->nama_kegiatan ?? 'Kegiatan';
                                    $tanggalIso = $tanggal ? \Carbon\Carbon::parse($tanggal)->format('Y-m-d') : '';
                                    $tanggalLabel = $tanggal ? \Carbon\Carbon::parse($tanggal)->format('d M Y') : '-';
                                    $waktuLabel = $waktu ? \Carbon\Carbon::parse($waktu)->format('H:i') : '-';
                                    [$statusStyle, $statusLabel] = match ($statusNormal) {
                                        'hadir' => ['background:#e4f8ef;color:#047857', 'Hadir'],
                                        'izin' => ['background:#e8f1ff;color:#1d4ed8', 'Izin'],
                                        'sakit' => ['background:#fff3d9;color:#a16207', 'Sakit'],
                                        'alfa' => ['background:#ffe9ec;color:#be123c', 'Alfa'],
                                        default => ['background:#f1f5f3;color:#64746c', ucfirst($status ?: 'Belum ada status')],
                                    };
                                @endphp
                                <tr class="rp-row" data-kegiatan="{{ strtolower($namaKegiatan) }}" data-status="{{ $statusNormal }}" data-tanggal="{{ $tanggalIso }}" data-search="{{ strtolower($namaKegiatan.' '.$statusLabel) }}">
                                    <td class="rp-no">{{ $loop->iteration }}</td>
                                    <td><span style="font-weight:750;color:#243b31">{{ $namaKegiatan }}</span><div class="rp-section-desc">Catatan presensi kegiatan</div></td>
                                    <td>{{ $tanggalLabel }}</td><td>{{ $waktuLabel }}</td>
                                    <td><span class="rp-status" style="{{ $statusStyle }}"><span class="rp-dot"></span>{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="rp-no-results" class="rp-empty rp-hidden">
                    <h3 style="font-weight:800;color:#34483e">Tidak ada catatan yang cocok</h3>
                    <p style="font-size:13px;margin-top:7px">Coba ubah filter tanggal, kegiatan, atau status.</p>
                </div>
            @endif
            <div class="rp-footer-note">Jika catatan kehadiran tidak sesuai, hubungi Pengurus atau Admin untuk pemeriksaan.</div>
        </section>
    </main>

    <script>
        (() => {
            const periode = document.getElementById('rp-periode');
            const awal = document.getElementById('rp-awal');
            const akhir = document.getElementById('rp-akhir');
            const kegiatan = document.getElementById('rp-kegiatan');
            const status = document.getElementById('rp-status');
            const search = document.getElementById('rp-search');
            const rows = Array.from(document.querySelectorAll('.rp-row'));
            const count = document.getElementById('rp-count');
            const noResults = document.getElementById('rp-no-results');
            const localISO = date => `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;

            const setPeriod = () => {
                const now = new Date();
                const today = localISO(now);
                if (periode.value === 'hari') { awal.value = today; akhir.value = today; }
                else if (periode.value === 'minggu') { const first = new Date(now); first.setDate(first.getDate()-6); awal.value = localISO(first); akhir.value = today; }
                else if (periode.value === 'bulan') { awal.value = localISO(new Date(now.getFullYear(), now.getMonth(), 1)); akhir.value = today; }
                else if (periode.value === 'semua') { awal.value = ''; akhir.value = ''; }
            };
            const applyFilter = () => {
                const q = (search?.value || '').trim().toLowerCase();
                let visible = 0;
                rows.forEach(row => {
                    const date = row.dataset.tanggal || '';
                    const rowStatus = row.dataset.status || '';
                    const rowKegiatan = row.dataset.kegiatan || '';
                    const matches = (!awal.value || (date && date >= awal.value)) &&
                        (!akhir.value || (date && date <= akhir.value)) &&
                        (!kegiatan.value || rowKegiatan === kegiatan.value.toLowerCase()) &&
                        (!status.value || rowStatus === status.value) &&
                        (!q || (row.dataset.search || '').includes(q));
                    row.style.display = matches ? '' : 'none';
                    if (matches) { visible++; row.querySelector('.rp-no').textContent = visible; }
                });
                if (count) count.textContent = visible;
                if (noResults) noResults.classList.toggle('rp-hidden', visible !== 0);
            };
            periode?.addEventListener('change', () => { setPeriod(); });
            document.getElementById('rp-apply')?.addEventListener('click', applyFilter);
            search?.addEventListener('input', applyFilter);
            document.getElementById('rp-reset')?.addEventListener('click', () => {
                periode.value = 'semua'; awal.value = ''; akhir.value = ''; kegiatan.value = ''; status.value = ''; if (search) search.value = ''; applyFilter();
            });
        })();
    </script>
</x-app-layout>
