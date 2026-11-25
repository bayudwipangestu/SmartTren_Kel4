<x-app-layout>
    <!-- Kontainer Utama: Flexbox agar Sidebar & Konten bersebelahan -->
    <div style="display: flex; min-height: calc(100vh - 65px); background: #f6f8f7; width: 100%;">
        
        <!-- ================= SIDEBAR KIRI ================= -->
        <aside style="width: 260px; background: white; border-right: 1px solid #e1e8e4; padding: 24px; flex-shrink: 0;">
            <div style="margin-bottom: 32px;">
                <h2 style="font-size: 22px; font-weight: 900; color: #087443; margin: 0;">SmartTren</h2>
                <p style="font-size: 12px; color: #7a8780; margin: 4px 0 0 0;">Sistem Presensi</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <p style="font-size: 11px; font-weight: 800; color: #a0aec0; letter-spacing: 1px; margin-bottom: 8px;">MENU UTAMA</p>

                <a href="{{ route('mahasantri.dashboard') }}" style="text-decoration: none; padding: 12px 16px; background: #eaf8f0; color: #087443; border-radius: 12px; font-weight: 700; font-size: 14px; display: block;">Dashboard</a>

                <a href="{{ route('mahasantri.presensi.index') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Presensi Kegiatan</a>

                <a href="{{ route('mahasantri.presensi.riwayat') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Riwayat Presensi</a>

                <!-- MENU REKAP KEHADIRAN DIKEMBALIKAN -->
                <a href="{{ route('mahasantri.presensi.rekap') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Rekap Kehadiran</a>

                <a href="#form-izin" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Pengajuan Izin / Sakit</a>

                <a href="{{ route('mahasantri.akun') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Data Akun</a>
            </div>
        </aside>

        <!-- ================= KONTEN KANAN ================= -->
        <main style="flex: 1; padding: 32px; overflow-y: auto;">
            <style>
                * { box-sizing: border-box; }
                .mhs-container { width: 100%; max-width: 1000px; margin: 0 auto; }
                
                /* WELCOME CARD */
                .welcome-card { position: relative; overflow: hidden; background: linear-gradient(135deg, #087443, #10a05a); color: white; border-radius: 22px; padding: 32px; margin-bottom: 24px; box-shadow: 0 12px 30px rgba(8, 116, 67, .16); }
                .welcome-card::before { content: ""; position: absolute; width: 230px; height: 230px; right: -80px; top: -120px; border-radius: 50%; background: rgba(255, 255, 255, .08); }
                .welcome-card::after { content: ""; position: absolute; width: 130px; height: 130px; right: 100px; bottom: -85px; border-radius: 50%; background: rgba(255, 255, 255, .06); }
                .welcome-content { position: relative; z-index: 1; }
                .welcome-label { display: inline-flex; align-items: center; padding: 7px 12px; background: rgba(255,255,255,.13); border: 1px solid rgba(255,255,255,.15); border-radius: 999px; font-size: 12px; font-weight: 700; margin-bottom: 14px; }
                .welcome-title { margin: 0; font-size: 30px; font-weight: 800; letter-spacing: -.5px; }
                .welcome-description { margin: 8px 0 0; font-size: 14px; opacity: .92; max-width: 650px; }

                /* INFO GRID */
                .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 24px; }
                .info-card { background: white; border: 1px solid #e1e8e4; border-radius: 18px; padding: 20px; box-shadow: 0 6px 20px rgba(31,55,43,.04); }
                .info-title { margin: 0; color: #1c2a23; font-size: 16px; font-weight: 800; }
                .info-text { margin: 5px 0 0; color: #7a8780; font-size: 13px; line-height: 1.6; }

                /* MENU UTAMA */
                .section-card { background: white; border: 1px solid #e1e8e4; border-radius: 20px; padding: 24px; box-shadow: 0 7px 24px rgba(31,55,43,.05); }
                .section-heading h2 { margin: 0; color: #17231e; font-size: 19px; font-weight: 800; }
                .section-heading p { margin: 3px 0 20px 0; color: #7b8781; font-size: 12px; }
                .menu-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
                .menu-card { display: block; text-decoration: none; border: 1px solid #e1e8e4; border-radius: 16px; padding: 20px; background: #fbfdfc; transition: .2s ease; }
                .menu-card:hover { transform: translateY(-3px); border-color: #b9dfca; box-shadow: 0 8px 20px rgba(8,116,67,.08); }
                .menu-card h3 { margin: 0; color: #1e2d26; font-size: 15px; font-weight: 800; }
                .menu-card p { margin: 6px 0 0; color: #7a8780; font-size: 12px; line-height: 1.6; }

                /* ACCOUNT CARD */
                .account-card { margin-top: 20px; background: white; border: 1px solid #e1e8e4; border-radius: 20px; padding: 22px; box-shadow: 0 7px 24px rgba(31,55,43,.05); display: flex; align-items: center; gap: 15px; }
                .avatar { width: 52px; height: 52px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border-radius: 15px; background: #087443; color: white; font-size: 20px; font-weight: 800; }
                .account-name { margin: 0; color: #1e2d26; font-size: 16px; font-weight: 800; }
                .account-email { margin: 4px 0 0; color: #7a8780; font-size: 13px; }
                .role-badge { margin-left: auto; padding: 7px 12px; border-radius: 999px; background: #eaf8f0; color: #087443; font-size: 11px; font-weight: 800; text-transform: uppercase; }

                @media (max-width: 900px) {
                    .menu-grid { grid-template-columns: 1fr; }
                    aside { display: none !important; }
                }
            </style>

            <div class="mhs-container">
                
                <!-- WELCOME -->
                <div class="welcome-card">
                    <div class="welcome-content">
                        <div class="welcome-label">Dashboard Mahasantri</div>
                        <h1 class="welcome-title">Assalamu'alaikum, {{ auth()->user()->name }}</h1>
                        <p class="welcome-description">Selamat datang di Sistem Presensi SmartTren. Gunakan dashboard ini untuk mengakses informasi dan aktivitas presensi kamu.</p>
                    </div>
                </div>

                <!-- INFO (PRESENSI & REKAP) -->
                <div class="info-grid">
                    <div class="info-card">
                        <h3 class="info-title">Presensi</h3>
                        <p class="info-text">Lakukan presensi pada kegiatan yang sedang berlangsung.</p>
                    </div>
                    <div class="info-card">
                        <h3 class="info-title">Rekap Kehadiran</h3>
                        <p class="info-text">Lihat ringkasan kehadiran kamu pada berbagai kegiatan.</p>
                    </div>
                </div>

                <!-- MENU UTAMA -->
                <div class="section-card">
                    <div class="section-heading">
                        <h2>Menu Mahasantri</h2>
                        <p>Akses fitur utama presensi kamu.</p>
                    </div>

                    <div class="menu-grid">
                        <!-- PRESENSI -->
                        <a href="{{ route('mahasantri.presensi.index') }}" class="menu-card">
                            <h3>Presensi Kegiatan</h3>
                            <p>Tampilkan QR Code kamu untuk melakukan presensi pada kegiatan.</p>
                        </a>

                        <!-- RIWAYAT -->
                        <a href="{{ route('mahasantri.presensi.riwayat') }}" class="menu-card">
                            <h3>Riwayat Presensi</h3>
                            <p>Lihat daftar kehadiran kamu berdasarkan kegiatan dan tanggal.</p>
                        </a>

                        <!-- REKAP KEHADIRAN DIKEMBALIKAN DALAM CARD -->
                        <a href="{{ route('mahasantri.presensi.rekap') }}" class="menu-card">
                            <h3>Rekap Kehadiran</h3>
                            <p>Lihat ringkasan jumlah hadir, izin, sakit, dan alpa.</p>
                        </a>
                    </div>

                    <!-- SURAT IZIN -->
                    <div id="form-izin" class="menu-card" style="margin-top: 24px; background: white; border-color: #e1e8e4; cursor: default;">
                        <h3 style="font-size: 18px; margin-bottom: 6px; color: #1e2d26;">Pengajuan Surat Izin / Sakit</h3>
                        <p style="margin-bottom: 24px; color: #7a8780; font-size: 13px;">Ajukan izin berhalangan hadir pada kegiatan kepada pengurus pesantren dengan mengisi formulir di bawah ini.</p>

                        @if(session('success'))
                        <div style="background: #eaf8f0; border: 1px solid #b9dfca; color: #087443; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 700;">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 16px;">
                            @csrf
                            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                                <div style="flex: 1; min-width: 200px;">
                                    <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Jenis Izin</label>
                                    <select name="jenis_izin" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 10px 14px; font-size: 14px; outline: none; background: white;" required>
                                        <option value="" disabled selected>-- Pilih Jenis Izin --</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin (Halangan Lain)</option>
                                    </select>
                                </div>
                                <div style="flex: 1; min-width: 200px;">
                                    <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Tanggal Izin</label>
                                    <input type="date" name="tanggal" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 10px 14px; font-size: 14px; outline: none;" required>
                                </div>
                            </div>
                            
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Keterangan (Alasan)</label>
                                <textarea name="keterangan" rows="3" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 12px 14px; font-size: 14px; outline: none; font-family: inherit;" placeholder="Tuliskan alasan secara detail..." required></textarea>
                            </div>

                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Bukti Foto (Surat Sakit / Acara)</label>
                                <input type="file" name="bukti_foto" accept="image/*" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 10px 14px; font-size: 14px; outline: none; background: white;" required>
                            </div>
                            
                            <div style="text-align: left; margin-top: 8px;">
                                <button type="submit" style="background: #087443; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 800; cursor: pointer;">
                                    Kirim Pengajuan Izin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ACCOUNT -->
                <div class="account-card">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="account-name">{{ auth()->user()->name }}</h3>
                        <p class="account-email">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="role-badge">Mahasantri</div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>