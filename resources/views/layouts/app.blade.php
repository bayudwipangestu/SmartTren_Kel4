<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SmartTren') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
            background: #f3f7f4;
            color: #1f2937;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 40;
        }
        .brand {
            padding: 24px 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        .brand-title {
            font-size: 20px;
            font-weight: 800;
            color: #065f46;
            margin: 0;
        }
        .brand-sub {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }
        .nav-section {
            padding: 16px 14px;
            flex: 1;
            overflow-y: auto;
        }
        .nav-label {
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            letter-spacing: .06em;
            padding: 0 12px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 11px 14px;
            border-radius: 10px;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            transition: all .15s ease;
        }
        .nav-link:hover {
            background: #ecfdf5;
            color: #065f46;
        }
        .nav-link.active {
            background: #dcfce7;
            color: #065f46;
            font-weight: 700;
        }
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #f1f5f9;
            background: #fafafa;
        }
        .user-meta {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
        }
        .user-role {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            background: #dcfce7;
            color: #065f46;
            padding: 2px 8px;
            border-radius: 999px;
            margin-top: 4px;
            text-transform: uppercase;
        }
        .btn-logout {
            margin-top: 12px;
            width: 100%;
            padding: 9px;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-logout:hover { background: #fee2e2; }

        .main-wrapper {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .topbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar-title {
            font-size: 15px;
            font-weight: 700;
            color: #374151;
        }
        .content-area {
            padding: 28px;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        @media (max-width: 860px) {
            .sidebar { position: static; width: 100%; height: auto; }
            body { flex-direction: column; }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>
    @php
        $role = auth()->user()->role ?? '';
    @endphp

    <aside class="sidebar">
        <div>
            <div class="brand">
                <h1 class="brand-title">SmartTren</h1>
                <div class="brand-sub">Sistem Presensi Pesantren</div>
            </div>

            <div class="nav-section">
                <div class="nav-label">Menu Utama</div>

                @if($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        Management User
                    </a>
                    <a href="{{ route('admin.mahasantri.index') }}" class="nav-link {{ request()->routeIs('admin.mahasantri.*') ? 'active' : '' }}">
                        Data Mahasantri
                    </a>
                    <a href="{{ route('admin.kegiatan.index') }}" class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                        Data Kegiatan
                    </a>
                @elseif($role === 'pengurus')
                    <a href="{{ route('pengurus.dashboard') }}" class="nav-link {{ request()->routeIs('pengurus.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('pengurus.sesi-presensi.index') }}" class="nav-link {{ request()->routeIs('pengurus.sesi-presensi.*') ? 'active' : '' }}">
                        Kelola Sesi Presensi
                    </a>
                    <a href="{{ route('pengurus.presensi.index') }}" class="nav-link {{ request()->routeIs('pengurus.presensi.*') ? 'active' : '' }}">
                        Data & Scanner Presensi
                    </a>
                    <a href="{{ route('pengurus.laporan-kegiatan.index') }}" class="nav-link {{ request()->routeIs('pengurus.laporan-kegiatan.*') ? 'active' : '' }}">
                        Laporan Kegiatan
                    </a>
                    <a href="{{ route('pengurus.laporan-presensi') }}" class="nav-link {{ request()->routeIs('pengurus.laporan-presensi*') ? 'active' : '' }}">
                        Laporan Presensi
                    </a>
                @elseif($role === 'mahasantri')
                    <a href="{{ route('mahasantri.dashboard') }}" class="nav-link {{ request()->routeIs('mahasantri.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('mahasantri.presensi.index') }}" class="nav-link {{ request()->routeIs('mahasantri.presensi.index') ? 'active' : '' }}">
                        Presensi Kegiatan
                    </a>
                    <a href="{{ route('mahasantri.presensi.riwayat') }}" class="nav-link {{ request()->routeIs('mahasantri.presensi.riwayat') ? 'active' : '' }}">
                        Riwayat Presensi
                    </a>
                    <a href="{{ route('mahasantri.presensi.rekap') }}" class="nav-link {{ request()->routeIs('mahasantri.presensi.rekap') ? 'active' : '' }}">
                        Rekap Kehadiran
                    </a>
                    <a href="{{ route('mahasantri.akun') }}" class="nav-link {{ request()->routeIs('mahasantri.akun*') ? 'active' : '' }}">
                        Data Akun
                    </a>
                @endif
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="user-meta">{{ auth()->user()->name ?? 'Pengguna' }}</div>
            <span class="user-role">{{ $role }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Keluar (Logout)</button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title">{{ $header ?? 'Dashboard' }}</div>
            <div style="font-size: 13px; color: #6b7280;">{{ now()->translatedFormat('l, d F Y') }}</div>
        </header>

        <main class="content-area">
            @if(session('success'))
                <div style="background:#dcfce7;color:#166534;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-weight:600;">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>