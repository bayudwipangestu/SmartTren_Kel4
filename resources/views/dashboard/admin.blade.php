<x-admin-layout title="Dashboard Admin" breadcrumb="Dashboard">
    @php
        /*
         * Data utama diambil dari DashboardController jika tersedia.
         * Fallback di bawah menjaga dashboard tetap tampil jika controller belum
         * mengirim seluruh variabel.
         */
        $totalUser = $totalUser ?? \App\Models\User::count();
        $totalMahasantri = $totalMahasantri ?? \App\Models\Mahasantri::count();
        $totalKegiatan = $totalKegiatan ?? \App\Models\Kegiatan::count();
        $kegiatanAktif = $kegiatanAktif ?? \App\Models\Kegiatan::where('status', 'aktif')->count();
        $totalPengurus = $totalPengurus ?? \App\Models\User::where('role', 'pengurus')->count();

        $totalAdmin = $totalAdmin ?? \App\Models\User::where('role', 'admin')->count();
        $totalUserMahasantri = $totalUserMahasantri ?? \App\Models\User::where('role', 'mahasantri')->count();

        $mahasantriTerbaru = $mahasantriTerbaru ?? \App\Models\Mahasantri::with('user')->latest()->take(5)->get();
        $userTerbaru = $userTerbaru ?? \App\Models\User::latest()->take(5)->get();
        $kegiatanTerbaru = $kegiatanTerbaru ?? \App\Models\Kegiatan::latest()->take(5)->get();

        $tanggalHariIni = now()->translatedFormat('l, d F Y');
    @endphp

    <div class="smart-admin">
        {{-- Header halaman --}}
        <header class="sa-page-header">
            <div>
                <div class="sa-breadcrumb"><span>Workspace</span><span>/</span><strong>Dashboard</strong></div>
                <h1>Dashboard</h1>
                <p>Ringkasan operasional dan pengelolaan data SmartTrenMJ.</p>
            </div>
            <div class="sa-header-right">
                <span class="sa-live"><i></i> Sistem aktif</span>
                <div class="sa-date-box"><span class="sa-date-icon">▦</span><span><small>Hari ini</small><strong>{{ $tanggalHariIni }}</strong></span></div>
            </div>
        </header>

        {{-- Banner --}}
        <section class="sa-welcome">
            <div class="sa-welcome-copy">
                <span class="sa-overline">ADMINISTRATOR WORKSPACE</span>
                <h2>Selamat datang, {{ auth()->user()->name }}.</h2>
                <p>Pantau data mahasantri, pengguna, dan kegiatan dari satu tempat. Gunakan ringkasan ini untuk melihat kondisi data sistem secara cepat.</p>
                <div class="sa-welcome-actions">
                    <a href="{{ url('admin/users') }}" class="sa-btn sa-btn-primary">Kelola pengguna <span>↗</span></a>
                    <a href="{{ url('admin/mahasantri') }}" class="sa-btn sa-btn-outline">Lihat data mahasantri</a>
                </div>
            </div>
            <div class="sa-welcome-side" aria-hidden="true">
                <div class="sa-emblem"><span>ST</span></div>
                <div class="sa-emblem-caption">SMARTTREN<span>Student Attendance Management</span></div>
                <div class="sa-decoration-line"></div>
            </div>
        </section>

        {{-- KPI --}}
        <section class="sa-kpi-grid">
            <article class="sa-kpi">
                <div class="sa-kpi-top"><span>Total pengguna</span><span class="sa-kpi-symbol green">US</span></div>
                <div class="sa-kpi-value">{{ number_format($totalUser) }}</div>
                <div class="sa-kpi-bottom"><span>Semua akun terdaftar</span><a href="{{ url('admin/users') }}">Lihat detail ↗</a></div>
                <div class="sa-kpi-rule green-rule"></div>
            </article>
            <article class="sa-kpi">
                <div class="sa-kpi-top"><span>Mahasantri</span><span class="sa-kpi-symbol blue">MH</span></div>
                <div class="sa-kpi-value">{{ number_format($totalMahasantri) }}</div>
                <div class="sa-kpi-bottom"><span>Data mahasantri</span><a href="{{ url('admin/mahasantri') }}">Lihat detail ↗</a></div>
                <div class="sa-kpi-rule blue-rule"></div>
            </article>
            <article class="sa-kpi">
                <div class="sa-kpi-top"><span>Kegiatan</span><span class="sa-kpi-symbol violet">KG</span></div>
                <div class="sa-kpi-value">{{ number_format($totalKegiatan) }}</div>
                <div class="sa-kpi-bottom"><span>{{ number_format($kegiatanAktif) }} kegiatan berstatus aktif</span><a href="{{ url('admin/kegiatan') }}">Lihat detail ↗</a></div>
                <div class="sa-kpi-rule violet-rule"></div>
            </article>
            <article class="sa-kpi">
                <div class="sa-kpi-top"><span>Pengurus</span><span class="sa-kpi-symbol amber">PG</span></div>
                <div class="sa-kpi-value">{{ number_format($totalPengurus) }}</div>
                <div class="sa-kpi-bottom"><span>Akun dengan role pengurus</span><a href="{{ url('admin/users') }}">Lihat detail ↗</a></div>
                <div class="sa-kpi-rule amber-rule"></div>
            </article>
        </section>

        {{-- Ringkasan role dan pintasan --}}
        <section class="sa-main-grid">
            <div class="sa-card sa-role-card">
                <div class="sa-card-heading"><div><h3>Komposisi pengguna</h3><p>Jumlah akun berdasarkan role.</p></div><span class="sa-card-tag">USER OVERVIEW</span></div>
                @php
                    $roleTotal = max((int) $totalUser, 1);
                    $adminPercent = round(($totalAdmin / $roleTotal) * 100);
                    $pengurusPercent = round(($totalPengurus / $roleTotal) * 100);
                    $mhsPercent = round(($totalUserMahasantri / $roleTotal) * 100);
                @endphp
                <div class="sa-role-total"><strong>{{ number_format($totalUser) }}</strong><span>Total akun pengguna</span></div>
                <div class="sa-role-bar" aria-label="Komposisi role pengguna">
                    <span class="sa-bar-admin" style="width: {{ $adminPercent }}%"></span>
                    <span class="sa-bar-pengurus" style="width: {{ $pengurusPercent }}%"></span>
                    <span class="sa-bar-mahasantri" style="width: {{ $mhsPercent }}%"></span>
                </div>
                <div class="sa-role-legend">
                    <div><span class="sa-legend-dot admin-dot"></span><span>Administrator</span><strong>{{ number_format($totalAdmin) }}</strong><small>{{ $adminPercent }}%</small></div>
                    <div><span class="sa-legend-dot pengurus-dot"></span><span>Pengurus</span><strong>{{ number_format($totalPengurus) }}</strong><small>{{ $pengurusPercent }}%</small></div>
                    <div><span class="sa-legend-dot mhs-dot"></span><span>Mahasantri</span><strong>{{ number_format($totalUserMahasantri) }}</strong><small>{{ $mhsPercent }}%</small></div>
                </div>
                <a class="sa-card-footer-link" href="{{ url('admin/users') }}">Buka management user <span>→</span></a>
            </div>

            <div class="sa-card sa-shortcuts-card">
                <div class="sa-card-heading"><div><h3>Akses cepat</h3><p>Menu utama administrator.</p></div><span class="sa-card-tag">QUICK ACCESS</span></div>
                <a class="sa-shortcut" href="{{ url('admin/users') }}"><span class="sa-shortcut-icon">01</span><span><strong>Management User</strong><small>Kelola akun, email, dan role pengguna.</small></span><b>↗</b></a>
                <a class="sa-shortcut" href="{{ url('admin/mahasantri') }}"><span class="sa-shortcut-icon">02</span><span><strong>Data Mahasantri</strong><small>Identitas, NIM, kamar, dan QR Code.</small></span><b>↗</b></a>
                <a class="sa-shortcut" href="{{ url('admin/kegiatan') }}"><span class="sa-shortcut-icon">03</span><span><strong>Data Kegiatan</strong><small>Atur daftar kegiatan presensi.</small></span><b>↗</b></a>
            </div>
        </section>

        {{-- Mahasantri terbaru --}}
        <section class="sa-card sa-table-card">
            <div class="sa-card-heading sa-table-heading">
                <div><h3>Mahasantri terbaru</h3><p>Data mahasantri yang terakhir ditambahkan ke sistem.</p></div>
                <a class="sa-link" href="{{ url('admin/mahasantri') }}">Lihat semua mahasantri <span>→</span></a>
            </div>
            <div class="sa-table-wrap">
                <table class="sa-table">
                    <thead><tr><th>MAHASANTRI</th><th>NIM</th><th>KAMAR</th><th>EMAIL AKUN</th><th>QR CODE</th></tr></thead>
                    <tbody>
                    @forelse($mahasantriTerbaru as $mahasantri)
                        <tr>
                            <td><div class="sa-person"><span class="sa-avatar">{{ strtoupper(substr($mahasantri->nama ?? '?', 0, 1)) }}</span><span><strong>{{ $mahasantri->nama }}</strong><small>Terdaftar di SmartTrenMJ</small></span></div></td>
                            <td><code>{{ $mahasantri->nim ?? '-' }}</code></td>
                            <td>{{ $mahasantri->kamar ?? '-' }}</td>
                            <td>{{ $mahasantri->user->email ?? '-' }}</td>
                            <td>@if($mahasantri->qr_code)<span class="sa-status status-ok"><i></i>Tersedia</span>@else<span class="sa-status status-empty"><i></i>Belum tersedia</span>@endif</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="sa-empty">Belum ada data mahasantri.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Data terkini --}}
        <section class="sa-lower-grid">
            <div class="sa-card sa-lower-card">
                <div class="sa-card-heading"><div><h3>Pengguna terbaru</h3><p>Akun yang baru dibuat.</p></div><a class="sa-link" href="{{ url('admin/users') }}">Semua →</a></div>
                <div class="sa-activity-list">
                    @forelse($userTerbaru as $user)
                        <div class="sa-activity-row">
                            <span class="sa-avatar">{{ strtoupper(substr($user->name ?? '?', 0, 1)) }}</span>
                            <span class="sa-activity-text"><strong>{{ $user->name }}</strong><small>{{ $user->email }}</small></span>
                            <span class="sa-role-pill {{ $user->role ?? 'mahasantri' }}">{{ ucfirst($user->role ?? 'mahasantri') }}</span>
                        </div>
                    @empty <div class="sa-empty">Belum ada akun pengguna.</div>
                    @endforelse
                </div>
            </div>

            <div class="sa-card sa-lower-card">
                <div class="sa-card-heading"><div><h3>Kegiatan terbaru</h3><p>Daftar kegiatan yang tersedia.</p></div><a class="sa-link" href="{{ url('admin/kegiatan') }}">Semua →</a></div>
                <div class="sa-activity-list">
                    @forelse($kegiatanTerbaru as $kegiatan)
                        <div class="sa-activity-row">
                            <span class="sa-activity-code">KG</span>
                            <span class="sa-activity-text"><strong>{{ $kegiatan->nama_kegiatan }}</strong><small>{{ \Illuminate\Support\Str::limit($kegiatan->deskripsi ?: 'Tidak ada deskripsi', 45) }}</small></span>
                            <span class="sa-status {{ $kegiatan->status === 'aktif' ? 'status-ok' : 'status-empty' }}"><i></i>{{ ucfirst($kegiatan->status) }}</span>
                        </div>
                    @empty <div class="sa-empty">Belum ada kegiatan.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <footer class="sa-footer"><span><strong>SmartTrenMJ</strong> · Sistem Presensi Mahasantri</span><span>Dashboard Administrator <b>•</b> {{ now()->format('Y') }}</span></footer>
    </div>

    <style>
        .smart-admin{--sa-green:#087f5b;--sa-green-dark:#075d45;--sa-ink:#172b25;--sa-muted:#7b8b84;--sa-line:#e5ece8;display:flex;flex-direction:column;gap:22px;color:var(--sa-ink);padding-bottom:8px}
        .sa-page-header{display:flex;justify-content:space-between;align-items:flex-end;gap:20px}.sa-breadcrumb{display:flex;gap:9px;align-items:center;color:#9aa7a1;font-size:10px;margin-bottom:8px}.sa-breadcrumb strong{color:#49645a;font-weight:700}.sa-page-header h1{font-size:27px;letter-spacing:-.7px;line-height:1.2;font-weight:800;margin:0;color:#18382d}.sa-page-header p{font-size:12px;color:#87958f;margin:7px 0 0}.sa-header-right{display:flex;align-items:center;gap:14px}.sa-live{display:flex;align-items:center;gap:7px;color:#087f5b;background:#e6f7ef;border:1px solid #ccebdd;padding:8px 10px;border-radius:8px;font-size:10px;font-weight:700;white-space:nowrap}.sa-live i{width:6px;height:6px;background:#12a66f;border-radius:50%;box-shadow:0 0 0 3px #12a66f20}.sa-date-box{display:flex;align-items:center;gap:9px;padding-left:14px;border-left:1px solid var(--sa-line)}.sa-date-icon{display:grid;place-items:center;width:34px;height:34px;border-radius:9px;background:#f0f5f2;color:#497264;font-size:17px}.sa-date-box>span:last-child{display:flex;flex-direction:column;gap:3px}.sa-date-box small{font-size:9px;color:#94a29b}.sa-date-box strong{font-size:10px;color:#3b5549}
        .sa-welcome{position:relative;isolation:isolate;overflow:hidden;display:flex;justify-content:space-between;align-items:center;min-height:208px;padding:29px 32px;border-radius:14px;background:linear-gradient(105deg,#123f34 0%,#0d6248 62%,#0b7655 100%);box-shadow:0 10px 28px #124d3914}.sa-welcome:after{content:"";position:absolute;z-index:-1;right:20%;top:-150px;width:310px;height:310px;border:1px solid #ffffff12;border-radius:50%;box-shadow:0 0 0 30px #ffffff06,0 0 0 65px #ffffff04}.sa-welcome-copy{max-width:690px;position:relative;z-index:2}.sa-overline{font-size:9px;letter-spacing:1.7px;font-weight:800;color:#a6e6c9}.sa-welcome h2{font-size:clamp(22px,2.6vw,31px);font-weight:750;letter-spacing:-.7px;line-height:1.3;color:#fff;margin:12px 0 9px}.sa-welcome p{max-width:570px;font-size:12px;line-height:1.8;color:#d1e7dd;margin:0}.sa-welcome-actions{display:flex;gap:9px;flex-wrap:wrap;margin-top:20px}.sa-btn{display:inline-flex;align-items:center;gap:13px;padding:10px 13px;border-radius:7px;text-decoration:none;font-size:10px;font-weight:750;transition:.18s}.sa-btn:hover{transform:translateY(-1px)}.sa-btn-primary{background:#f6fbf8;color:#12543f}.sa-btn-outline{border:1px solid #ffffff45;color:#f5fff9;background:#ffffff0a}.sa-welcome-side{position:relative;z-index:1;width:220px;min-width:170px;display:flex;align-items:center;flex-direction:column;justify-content:center;gap:10px}.sa-emblem{display:grid;place-items:center;width:88px;height:88px;border:1px solid #ffffff55;border-radius:25px;transform:rotate(45deg);background:linear-gradient(145deg,#ffffff1a,#ffffff04);box-shadow:0 12px 30px #001d151f}.sa-emblem span{font-size:26px;font-weight:850;letter-spacing:-2px;color:#e6fff2;transform:rotate(-45deg)}.sa-emblem-caption{text-align:center;color:#eafff3;font-size:10px;font-weight:800;letter-spacing:2px}.sa-emblem-caption span{display:block;font-size:8px;letter-spacing:.2px;font-weight:400;color:#a9d8c4;margin-top:5px}.sa-decoration-line{position:absolute;width:170px;height:1px;background:#ffffff1c;bottom:-35px}
        .sa-kpi-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px}.sa-kpi{position:relative;overflow:hidden;background:#fff;border:1px solid var(--sa-line);border-radius:12px;padding:17px 17px 15px;min-width:0;box-shadow:0 3px 12px #183d2e05}.sa-kpi-top{display:flex;align-items:center;justify-content:space-between;gap:8px;color:#687a72;font-size:11px;font-weight:600}.sa-kpi-symbol{display:grid;place-items:center;width:32px;height:30px;border-radius:8px;font-size:9px;font-weight:850;letter-spacing:.4px}.sa-kpi-symbol.green{background:#e4f6ed;color:#07835c}.sa-kpi-symbol.blue{background:#e9f1ff;color:#3e74d8}.sa-kpi-symbol.violet{background:#f1eaff;color:#8152c9}.sa-kpi-symbol.amber{background:#fff2df;color:#b87819}.sa-kpi-value{font-size:29px;font-weight:800;letter-spacing:-.8px;color:#19372c;margin:12px 0}.sa-kpi-bottom{display:flex;justify-content:space-between;align-items:center;gap:7px;color:#97a49d;font-size:9px}.sa-kpi-bottom a{color:#087f5b;text-decoration:none;font-weight:700;white-space:nowrap}.sa-kpi-bottom a:hover{text-decoration:underline}.sa-kpi-rule{position:absolute;bottom:0;left:0;width:100%;height:3px}.green-rule{background:#13986b}.blue-rule{background:#5387e5}.violet-rule{background:#9465d8}.amber-rule{background:#d99b39}
        .sa-main-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:16px}.sa-card{background:#fff;border:1px solid var(--sa-line);border-radius:13px;min-width:0;box-shadow:0 3px 12px #183d2e04}.sa-role-card,.sa-shortcuts-card{padding:20px}.sa-card-heading{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:18px}.sa-card-heading h3{font-size:14px;font-weight:800;letter-spacing:-.2px;color:#203a2f;margin:0}.sa-card-heading p{font-size:10px;color:#91a098;margin:5px 0 0}.sa-card-tag{font-size:8px;letter-spacing:1px;font-weight:800;color:#7e9287;background:#f2f6f3;padding:6px 7px;border-radius:5px;white-space:nowrap}.sa-role-total{display:flex;align-items:baseline;gap:9px;margin:8px 0 13px}.sa-role-total strong{font-size:29px;letter-spacing:-.6px;color:#1a382d}.sa-role-total span{font-size:10px;color:#91a098}.sa-role-bar{height:9px;display:flex;overflow:hidden;gap:3px;border-radius:20px;background:#f0f4f1}.sa-role-bar span{display:block;min-width:0;border-radius:20px}.sa-bar-admin{background:#0d9368}.sa-bar-pengurus{background:#5b87dd}.sa-bar-mahasantri{background:#dba04b}.sa-role-legend{display:flex;flex-direction:column;gap:13px;margin:19px 0}.sa-role-legend>div{display:grid;grid-template-columns:9px minmax(0,1fr) 40px 35px;align-items:center;gap:8px;font-size:10px;color:#62756b}.sa-role-legend strong{text-align:right;color:#304b3d;font-size:10px}.sa-role-legend small{text-align:right;color:#9aa79f;font-size:9px}.sa-legend-dot{width:8px;height:8px;border-radius:3px}.admin-dot{background:#0d9368}.pengurus-dot{background:#5b87dd}.mhs-dot{background:#dba04b}.sa-card-footer-link{display:flex;justify-content:space-between;align-items:center;border-top:1px solid #edf2ee;padding-top:13px;text-decoration:none;color:#087f5b;font-size:10px;font-weight:750}.sa-shortcuts-card{display:flex;flex-direction:column}.sa-shortcut{display:flex;align-items:center;gap:12px;padding:13px 0;border-top:1px solid #edf2ee;text-decoration:none;color:inherit}.sa-shortcut-icon{display:grid;place-items:center;flex:0 0 34px;height:34px;border:1px solid #e2ebe5;border-radius:8px;color:#4d7865;font-size:9px;font-weight:800;background:#f8fbf9}.sa-shortcut>span:nth-child(2){display:flex;flex-direction:column;gap:4px;flex:1;min-width:0}.sa-shortcut strong{font-size:11px;color:#2b4538}.sa-shortcut small{font-size:9px;color:#8c9b93;line-height:1.5}.sa-shortcut>b{font-size:15px;color:#82958a;font-weight:500}.sa-shortcut:hover strong,.sa-shortcut:hover>b{color:#087f5b}
        .sa-table-card{padding:20px}.sa-table-heading{align-items:center;margin-bottom:14px}.sa-link{font-size:10px;color:#087f5b;text-decoration:none;font-weight:750;white-space:nowrap}.sa-link:hover{text-decoration:underline}.sa-table-wrap{overflow-x:auto}.sa-table{width:100%;border-collapse:collapse;min-width:680px}.sa-table th{text-align:left;background:#f7f9f8;padding:12px 11px;color:#829188;font-size:9px;letter-spacing:.6px;font-weight:800;white-space:nowrap;border-top:1px solid #edf1ee;border-bottom:1px solid #e8efea}.sa-table td{padding:12px 11px;border-bottom:1px solid #edf2ee;font-size:10px;color:#596d61;white-space:nowrap}.sa-table tbody tr:last-child td{border-bottom:0}.sa-table tbody tr:hover{background:#fbfdfb}.sa-person{display:flex;align-items:center;gap:9px}.sa-person>span:last-child{display:flex;flex-direction:column;gap:4px}.sa-person strong{font-size:10px;color:#2d4739}.sa-person small{font-size:9px;color:#9aa69f}.sa-avatar{display:grid;place-items:center;width:33px;height:33px;flex:0 0 33px;border-radius:9px;background:#e5f5ec;color:#087f5b;font-size:11px;font-weight:800}.sa-table code{background:#f4f7f5;padding:4px 6px;border-radius:4px;font-size:10px;color:#4f685b}.sa-status{display:inline-flex;align-items:center;gap:6px;padding:5px 8px;border-radius:5px;font-size:9px;font-weight:750;white-space:nowrap}.sa-status i{width:5px;height:5px;border-radius:50%;background:currentColor}.status-ok{background:#e6f7ee;color:#087f5b}.status-empty{background:#f1f4f2;color:#829189}.sa-empty{text-align:center;padding:28px 12px;color:#97a59d;font-size:11px}
        .sa-lower-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.sa-lower-card{padding:20px}.sa-lower-card .sa-card-heading{align-items:center;margin-bottom:8px}.sa-activity-list{display:flex;flex-direction:column}.sa-activity-row{display:flex;align-items:center;gap:10px;padding:12px 0;border-bottom:1px solid #edf2ee;min-width:0}.sa-activity-row:last-child{border-bottom:0}.sa-activity-text{display:flex;flex-direction:column;gap:4px;flex:1;min-width:0}.sa-activity-text strong{font-size:10px;color:#2d4739;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.sa-activity-text small{font-size:9px;color:#97a49d;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.sa-role-pill{font-size:8px;font-weight:750;border-radius:5px;padding:5px 7px;white-space:nowrap}.sa-role-pill.admin{background:#e4f6ed;color:#087f5b}.sa-role-pill.pengurus{background:#e9f1ff;color:#3e74d8}.sa-role-pill.mahasantri{background:#fff2df;color:#b87819}.sa-activity-code{display:grid;place-items:center;width:33px;height:33px;flex:0 0 33px;border-radius:9px;background:#f1eaff;color:#8152c9;font-size:9px;font-weight:850}.sa-footer{display:flex;justify-content:space-between;gap:12px;border-top:1px solid #e6ede8;padding:15px 2px 0;color:#97a49d;font-size:9px}.sa-footer strong{color:#526b5e;font-weight:750}.sa-footer b{color:#0c9367;margin:0 4px}
        @media(max-width:1100px){.sa-kpi-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.sa-welcome-side{width:175px}.sa-kpi-value{font-size:26px}}
        @media(max-width:760px){.sa-page-header{align-items:flex-start;flex-direction:column}.sa-header-right{width:100%;justify-content:space-between}.sa-welcome{padding:24px}.sa-welcome-side{display:none}.sa-main-grid,.sa-lower-grid{grid-template-columns:1fr}.sa-card-tag{display:none}.sa-table-card,.sa-lower-card,.sa-role-card,.sa-shortcuts-card{padding:15px}.sa-footer{flex-direction:column}}
        @media(max-width:460px){.sa-kpi-grid{grid-template-columns:1fr}.sa-kpi-bottom{font-size:9px}.sa-kpi-value{margin:9px 0}.sa-welcome h2{font-size:23px}.sa-welcome-actions{align-items:stretch;flex-direction:column}.sa-btn{justify-content:center}.sa-table-heading{align-items:flex-start;flex-direction:column}.sa-date-box strong{font-size:9px}}
    </style>
</x-admin-layout>
