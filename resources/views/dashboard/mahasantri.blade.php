<x-app-layout>

    <style>
        * {
            box-sizing: border-box;
        }

        .mhs-dashboard {
            min-height: calc(100vh - 65px);
            background: #f6f8f7;
            padding: 32px 0 60px;
        }

        .mhs-container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* =========================
           WELCOME
        ========================= */

        .welcome-card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                #087443,
                #10a05a
            );
            color: white;
            border-radius: 22px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 12px 30px rgba(8, 116, 67, .16);
        }

        .welcome-card::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            right: -80px;
            top: -120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
        }

        .welcome-card::after {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            right: 100px;
            bottom: -85px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            background: rgba(255,255,255,.13);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .welcome-title {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .welcome-description {
            margin: 8px 0 0;
            font-size: 14px;
            opacity: .92;
            max-width: 650px;
        }

        /* =========================
           QUICK INFO
        ========================= */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-card {
            background: white;
            border: 1px solid #e1e8e4;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(31,55,43,.04);
        }

        .info-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #eaf8f0;
            font-size: 21px;
            margin-bottom: 14px;
        }

        .info-title {
            margin: 0;
            color: #1c2a23;
            font-size: 16px;
            font-weight: 800;
        }

        .info-text {
            margin: 5px 0 0;
            color: #7a8780;
            font-size: 13px;
            line-height: 1.6;
        }

        /* =========================
           MAIN MENU
        ========================= */

        .section-card {
            background: white;
            border: 1px solid #e1e8e4;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 7px 24px rgba(31,55,43,.05);
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eaf8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .section-heading h2 {
            margin: 0;
            color: #17231e;
            font-size: 19px;
            font-weight: 800;
        }

        .section-heading p {
            margin: 3px 0 0;
            color: #7b8781;
            font-size: 12px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .menu-card {
            border: 1px solid #e1e8e4;
            border-radius: 16px;
            padding: 20px;
            background: #fbfdfc;
            transition: .2s ease;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            border-color: #b9dfca;
            box-shadow: 0 8px 20px rgba(8,116,67,.08);
        }

        .menu-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: #eaf8f0;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .menu-card h3 {
            margin: 0;
            color: #1e2d26;
            font-size: 15px;
            font-weight: 800;
        }

        .menu-card p {
            margin: 6px 0 0;
            color: #7a8780;
            font-size: 12px;
            line-height: 1.6;
        }

        .menu-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
            padding: 5px 9px;
            border-radius: 999px;
            background: #f1f4f2;
            color: #6c7972;
            font-size: 11px;
            font-weight: 700;
        }

        .menu-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #9aa59f;
        }

        /* =========================
           ACCOUNT INFO
        ========================= */

        .account-card {
            margin-top: 20px;
            background: white;
            border: 1px solid #e1e8e4;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 7px 24px rgba(31,55,43,.05);
        }

        .account-row {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #087443;
            color: white;
            font-size: 20px;
            font-weight: 800;
        }

        .account-name {
            margin: 0;
            color: #1e2d26;
            font-size: 16px;
            font-weight: 800;
        }

        .account-email {
            margin: 4px 0 0;
            color: #7a8780;
            font-size: 13px;
        }

        .role-badge {
            margin-left: auto;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eaf8f0;
            color: #087443;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {
            .info-grid,
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .mhs-container {
                padding: 0 15px;
            }

            .mhs-dashboard {
                padding-top: 20px;
            }

            .welcome-card {
                padding: 24px;
                border-radius: 18px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .info-grid,
            .menu-grid {
                grid-template-columns: 1fr;
            }

            .section-card,
            .account-card {
                padding: 18px;
            }

            .account-row {
                align-items: flex-start;
            }

            .role-badge {
                margin-left: 0;
                margin-top: 5px;
            }
            
            /* Agar form input turun jadi 1 kolom di HP */
            .form-row {
                flex-direction: column;
            }
        }
    </style>

    <div class="mhs-dashboard">
        <div class="mhs-container">

            {{-- =========================
                 WELCOME
            ========================= --}}
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="welcome-label">
                        Dashboard Mahasantri
                    </div>
                    <h1 class="welcome-title">
                        Assalamu'alaikum, {{ auth()->user()->name }} 👋
                    </h1>
                    <p class="welcome-description">
                        Selamat datang di Sistem Presensi SmartTren. Gunakan dashboard ini untuk mengakses informasi dan aktivitas presensi kamu.
                    </p>
                </div>
            </div>

            {{-- =========================
                 INFO
            ========================= --}}
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">📝</div>
                    <h3 class="info-title">Presensi</h3>
                    <p class="info-text">Lakukan presensi pada kegiatan yang sedang berlangsung.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">📊</div>
                    <h3 class="info-title">Rekap Kehadiran</h3>
                    <p class="info-text">Lihat riwayat dan rekap kehadiran kamu pada berbagai kegiatan.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">👤</div>
                    <h3 class="info-title">Data Akun</h3>
                    <p class="info-text">Informasi akun yang digunakan untuk sistem presensi SmartTren.</p>
                </div>
            </div>

            {{-- =========================
                 MENU UTAMA
            ========================= --}}
            <div class="section-card">
                <div class="section-heading">
                    <div class="section-icon">📋</div>
                    <div>
                        <h2>Menu Mahasantri</h2>
                        <p>Akses fitur utama presensi kamu.</p>
                    </div>
                </div>

                <div class="menu-grid">

                    {{-- PRESENSI --}}
                    <a href="{{ route('mahasantri.presensi.index') }}" class="menu-card" style="text-decoration: none; display: block; color: inherit;">
                        <div class="menu-icon">📱</div>
                        <h3>Presensi Kegiatan</h3>
                        <p>Tampilkan QR Code kamu untuk melakukan presensi pada kegiatan.</p>
                        <div class="menu-status" style="background: #dcf8e7; color: #087443;">
                            <span class="menu-status-dot" style="background: #087443;"></span>
                            Buka Presensi
                        </div>
                    </a>

                    {{-- RIWAYAT --}}
                    <a href="{{ route('mahasantri.presensi.riwayat') }}" class="menu-card" style="text-decoration: none; display: block; color: inherit;">
                        <div class="menu-icon">📅</div>
                        <h3>Riwayat Presensi</h3>
                        <p>Lihat daftar kehadiran kamu berdasarkan kegiatan dan tanggal.</p>
                        <div class="menu-status" style="background: #dcf8e7; color: #087443;">
                            <span class="menu-status-dot" style="background: #087443;"></span>
                            Lihat Riwayat
                        </div>
                    </a>

                    {{-- REKAP --}}
                    <div class="menu-card">
                        <div class="menu-icon">📈</div>
                        <h3>Rekap Kehadiran</h3>
                        <p>Lihat ringkasan jumlah hadir, izin, sakit, dan alpa.</p>
                        <div class="menu-status">
                            <span class="menu-status-dot"></span>
                            Segera tersedia
                        </div>
                    </div>

                    {{-- FITUR TAMBAHAN: SURAT IZIN --}}
                    <div class="menu-card" style="grid-column: 1 / -1; margin-top: 10px;">
                        <div class="menu-icon" style="background: #fdf2f2; color: #e53e3e;">✉️</div>
                        <h3>Surat Izin</h3>
                        <p style="margin-bottom: 20px;">Ajukan izin berhalangan hadir pada kegiatan kepada pengurus pesantren dengan mengisi formulir di bawah ini.</p>

                        {{-- Alert Sukses --}}
                        @if(session('success'))
                        <div style="background: #eaf8f0; border: 1px solid #b9dfca; color: #087443; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 700;">
                            ✅ {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('izin.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                            @csrf
                            <div class="form-row" style="display: flex; gap: 16px;">
                                <div style="flex: 1;">
                                    <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 10px 14px; font-size: 14px; outline: none;" required>
                                </div>
                                <div style="flex: 1;">
                                    <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Tanggal Selesai</label>
                                    <input type="date" name="tanggal_selesai" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 10px 14px; font-size: 14px; outline: none;" required>
                                </div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 800; color: #1e2d26; margin-bottom: 6px;">Alasan Izin</label>
                                <textarea name="alasan" rows="3" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 12px; padding: 12px 14px; font-size: 14px; outline: none; font-family: inherit;" placeholder="Tuliskan alasan izin dengan detail..." required></textarea>
                            </div>
                            <div style="text-align: left;">
                                <button type="submit" style="background: #087443; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 800; cursor: pointer; transition: 0.2s;">
                                    Kirim Pengajuan Izin
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            {{-- =========================
                 ACCOUNT
            ========================= --}}
            <div class="account-card">
                <div class="account-row">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="account-name">
                            {{ auth()->user()->name }}
                        </h3>
                        <p class="account-email">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                    <div class="role-badge">
                        Mahasantri
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>