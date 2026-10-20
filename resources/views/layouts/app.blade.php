<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SmartTren') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --st-green: #087f50;
            --st-green-dark: #075b3c;
            --st-green-soft: #e8f6ee;
            --st-bg: #f5f8f6;
            --st-text: #20362b;
            --st-muted: #7b8b81;
            --st-border: #e5ece7;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: var(--st-text);
            font-family: Figtree, sans-serif;
        }

        .st-layout {
            min-height: 100vh;
            background: var(--st-bg);
        }

        /* SIDEBAR */
        .st-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 40;
            display: flex;
            flex-direction: column;
            width: 260px;
            padding: 24px 17px 18px;
            background: #fff;
            border-right: 1px solid var(--st-border);
        }

        .st-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 3px 8px 24px;
            border-bottom: 1px solid var(--st-border);
        }

        .st-logo {
            display: grid;
            place-items: center;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            border-radius: 13px;
            background: var(--st-green);
            color: #fff;
            font-size: 23px;
        }

        .st-brand strong {
            display: block;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.4px;
        }

        .st-brand small {
            display: block;
            margin-top: 4px;
            color: var(--st-muted);
            font-size: 11px;
        }

        .st-section-label {
            margin: 27px 10px 12px;
            color: #9aa79f;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .st-nav {
            display: grid;
            gap: 6px;
        }

        .st-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 48px;
            padding: 0 12px;
            border: 1px solid transparent;
            border-radius: 11px;
            color: #627267;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: background .2s, color .2s;
        }

        .st-link:hover {
            background: #f4f8f5;
            color: var(--st-green);
        }

        .st-link.active {
            background: var(--st-green-soft);
            border-color: #d6efdf;
            color: var(--st-green);
        }

        .st-link-icon {
            display: grid;
            place-items: center;
            flex: 0 0 22px;
            width: 22px;
            height: 22px;
        }

        .st-link-icon svg,
        .st-mobile-link svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.7;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .st-account {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--st-border);
        }

        .st-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 3px 14px;
        }

        .st-avatar {
            display: grid;
            place-items: center;
            flex: 0 0 39px;
            width: 39px;
            height: 39px;
            border-radius: 12px;
            background: var(--st-green);
            color: white;
            font-weight: 800;
        }

        .st-user-info {
            flex: 1;
            min-width: 0;
        }

        .st-user-info strong,
        .st-user-info small {
            display: block;
            overflow-wrap: anywhere;
        }

        .st-user-info strong {
            font-size: 11px;
            font-weight: 800;
        }

        .st-user-info small {
            margin-top: 4px;
            color: var(--st-muted);
            font-size: 10px;
        }

        .st-logout {
            width: 100%;
            min-height: 41px;
            border: 1px solid #f0dddd;
            border-radius: 10px;
            background: #fffafa;
            color: #c94b4b;
            font: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .st-logout:hover { background: #fff0f0; }

        /* CONTENT */
        .st-main {
            min-height: 100vh;
            margin-left: 260px;
        }

        .st-mobile-header,
        .st-mobile-nav {
            display: none;
        }

        .st-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 100px;
            padding: 22px 32px;
            background: #fff;
            border-bottom: 1px solid var(--st-border);
        }

        .st-breadcrumb {
            margin-bottom: 7px;
            color: #8b9a90;
            font-size: 11px;
        }

        .st-topbar h1 {
            margin: 0;
            color: var(--st-text);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .st-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 13px;
            border: 1px solid var(--st-border);
            border-radius: 30px;
            background: #fbfdfb;
            color: #65766b;
            font-size: 11px;
            white-space: nowrap;
        }

        .st-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #18b979;
        }

        .st-content {
            min-width: 0;
            padding: 28px 32px 40px;
        }

        /* Jangan biarkan judul halaman di konten terlalu menempel ke header */
        .st-content > h1:first-child {
            margin-top: 0;
        }

        /* MOBILE */
        @media (max-width: 760px) {
            .st-sidebar { display: none; }

            .st-main {
                margin-left: 0;
                padding-bottom: 82px;
            }

            .st-mobile-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                padding: 12px 16px;
                background: #fff;
                border-bottom: 1px solid var(--st-border);
            }

            .st-mobile-brand {
                display: flex;
                align-items: center;
                gap: 9px;
                font-size: 15px;
                font-weight: 800;
            }

            .st-mobile-logo {
                display: grid;
                place-items: center;
                width: 35px;
                height: 35px;
                border-radius: 11px;
                background: var(--st-green);
                color: #fff;
                font-size: 19px;
            }

            .st-mobile-name {
                max-width: 45%;
                overflow-wrap: anywhere;
                color: var(--st-muted);
                font-size: 10px;
                text-align: right;
            }

            .st-topbar {
                min-height: 78px;
                padding: 17px 16px;
            }

            .st-breadcrumb { font-size: 10px; }

            .st-topbar h1 { font-size: 19px; }

            .st-status {
                gap: 6px;
                padding: 7px 9px;
                font-size: 9px;
            }

            .st-content { padding: 20px 15px 28px; }

            .st-mobile-nav {
                position: fixed;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 50;
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 3px;
                padding: 8px 5px calc(8px + env(safe-area-inset-bottom));
                border-top: 1px solid var(--st-border);
                background: rgba(255,255,255,.98);
                box-shadow: 0 -4px 18px rgba(20,60,38,.06);
            }

            .st-mobile-link {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 4px;
                min-width: 0;
                padding: 6px 1px;
                border-radius: 9px;
                color: #77867c;
                text-decoration: none;
                font-size: 9px;
                font-weight: 700;
            }

            .st-mobile-link.active {
                background: var(--st-green-soft);
                color: var(--st-green);
            }
        }

        @media (min-width: 761px) and (max-width: 1050px) {
            .st-sidebar { width: 235px; }
            .st-main { margin-left: 235px; }
            .st-topbar { padding-right: 22px; padding-left: 22px; }
            .st-content { padding: 24px 22px; }
        }
    </style>
</head>

<body class="font-sans antialiased">




@if (
    request()->routeIs('mahasantri.*')
    || request()->is('mahasantri/*')
    || request()->routeIs('pengurus.*')
    || request()->is('pengurus/*')
    || (
        request()->routeIs('profile.*')
        && auth()->check()
        && in_array(auth()->user()->role, ['mahasantri', 'pengurus'])
    )
)
    @php
        $stUser = auth()->user();

        $isPengurus = $stUser
            && $stUser->role === 'pengurus';

        $stName = $stUser->name ?? (
            $isPengurus ? 'Pengurus' : 'Mahasantri'
        );

        $stEmail = $stUser->email ?? '';

        
if ($isPengurus) {
    $stMenu = [
        [
            'label' => 'Dashboard',
            'icon' => '⌂',
            'url' => route('pengurus.dashboard'),
            'active' => request()->routeIs('pengurus.dashboard'),
        ],
        [
            'label' => 'Sesi Presensi',
            'icon' => '▦',
            'url' => route('pengurus.sesi-presensi.index'),
            'active' => request()->routeIs('pengurus.sesi-presensi.*'),
        ],
        [
            'label' => 'Konfirmasi Presensi',
            'icon' => '▧',
            'url' => route('pengurus.pengajuan-izin.index'),
            'active' => request()->routeIs('pengurus.pengajuan-izin.*'),
        ],
        [
            'label' => 'Laporan Presensi',
            'icon' => '▥',
            'url' => route('pengurus.laporan-presensi'),
            'active' => request()->routeIs(
                'pengurus.laporan-presensi*',
                'pengurus.laporan-kegiatan.*'
            ),
        ],
        [
            'label' => 'Data Akun',
            'icon' => '♙',
            'url' => route('profile.edit'),
            'active' => request()->routeIs('profile.*'),
        ],
    ];
}

         else {
            $stMenu = [
                [
                    'label' => 'Dashboard',
                    'icon' => '⌂',
                    'url' => route('mahasantri.dashboard'),
                    'active' => request()->routeIs(
                        'mahasantri.dashboard'
                    ),
                ],
                [
                    'label' => 'Presensi Kegiatan',
                    'icon' => '▦',
                    'url' => route('mahasantri.presensi.index'),
                    'active' => request()->routeIs(
                        'mahasantri.presensi.index'
                    ),
                ],
                [
                    'label' => 'Riwayat Presensi',
                    'icon' => '▤',
                    'url' => route('mahasantri.presensi.riwayat'),
                    'active' => request()->routeIs(
                        'mahasantri.presensi.riwayat'
                    ),
                ],
                [
                    'label' => 'Pengajuan Izin / Sakit',
                    'icon' => '▧',
                    'url' => route('mahasantri.pengajuan-izin.index'),
                    'active' => request()->routeIs(
                        'mahasantri.pengajuan-izin.*'
                    ),
                ],
                [
                    'label' => 'Data Akun',
                    'icon' => '♙',
                    'url' => route('profile.edit'),
                    'active' => request()->routeIs('profile.*'),
                ],
            ];
        }
    @endphp


    <div class="st-layout">

        <aside class="st-sidebar">
            <div class="st-brand">
                <div class="st-logo">🕌</div>
                <div>
                    <strong>SmartTren</strong>
                    <small>Sistem Presensi Pesantren</small>
                </div>
            </div>

            <div class="st-section-label">MENU UTAMA</div>

            <nav class="st-nav" aria-label="Navigasi Mahasantri">
                @foreach ($stMenu as $item)
                    <a href="{{ $item['url'] }}"
                       class="st-link {{ $item['active'] ? 'active' : '' }}"
                       @if ($item['active']) aria-current="page" @endif>

                        <span class="st-link-icon">
                            @switch($item['icon'])
                                @case('dashboard')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                        <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                        <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                                        <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                                    </svg>
                                    @break

                                @case('presensi')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="4" y="3" width="16" height="18" rx="2"/>
                                        <path d="M8 8h8M8 12h8M8 16h5"/>
                                    </svg>
                                    @break

                                @case('riwayat')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 7v5l3 2"/>
                                    </svg>
                                    @break

                                @case('izin')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 3 21 8v8l-9 5-9-5V8l9-5Z"/>
                                        <path d="M12 8v5M12 16h.01"/>
                                    </svg>
                                    @break

                                @case('akun')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="12" cy="8" r="4"/>
                                        <path d="M4 21a8 8 0 0 1 16 0"/>
                                    </svg>
                                    @break
                            @endswitch
                        </span>

                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="st-section-label">AKUN</div>

            <div class="st-account">
                <div class="st-user">
                   

<div class="st-avatar" style="width: 44px; height: 44px; min-width: 44px; overflow: hidden; padding: 0; border-radius: 12px;">
    @if (!empty($stUser->profile_photo_path))
        <img
            src="{{ asset('storage/' . $stUser->profile_photo_path) }}"
            alt="Foto {{ $stName }}"
            style="display: block; width: 100%; height: 100%; object-fit: cover;"
        >
    @else
        <span style="display: flex; width: 100%; height: 100%; align-items: center; justify-content: center;">
            {{ strtoupper(substr($stName, 0, 1)) }}
        </span>
    @endif
</div>

                    <div class="st-user-info">
                        <strong>{{ $stName }}</strong>
                        <small>{{ $stEmail }}</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="st-logout">
                        ↪ &nbsp; Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="st-main">

            <header class="st-mobile-header">
                <div class="st-mobile-brand">
                    <span class="st-mobile-logo">🕌</span>
                    <span>SmartTren</span>
                </div>
                <div class="st-mobile-name">{{ $stName }}</div>
            </header>

            <header class="st-topbar">
                <div>
                    <div class="st-breadcrumb">
                        SmartTren &nbsp;/&nbsp; Mahasantri
                    </div>

                    <h1>
                        @if (request()->routeIs('mahasantri.dashboard'))
                            Dashboard Mahasantri
                        @elseif (request()->routeIs('mahasantri.presensi.riwayat'))
                            Riwayat Presensi
                        @elseif (request()->routeIs('mahasantri.presensi.*'))
                            Presensi Kegiatan
                        @elseif (request()->routeIs('mahasantri.pengajuan-izin.*'))
                            Pengajuan Izin / Sakit
                        @elseif (request()->routeIs('profile.*'))
                            Data Akun
                        @else
                            SmartTren
                        @endif
                    </h1>
                </div>

                <div class="st-status">
                    <span class="st-status-dot"></span>
                    Sistem aktif
                </div>
            </header>

            <main class="st-content">
                {{ $slot }}
            </main>
        </div>

        <nav class="st-mobile-nav" aria-label="Navigasi bawah">
            @foreach ($stMenu as $item)
                <a href="{{ $item['url'] }}"
                   class="st-mobile-link {{ $item['active'] ? 'active' : '' }}"
                   @if ($item['active']) aria-current="page" @endif>

                    @switch($item['icon'])
                        @case('dashboard')
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                            </svg>
                            @break

                        @case('presensi')
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="4" y="3" width="16" height="18" rx="2"/>
                                <path d="M8 8h8M8 12h8M8 16h5"/>
                            </svg>
                            @break

                        @case('riwayat')
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                            @break

                        @case('izin')
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 21 8v8l-9 5-9-5V8l9-5Z"/>
                                <path d="M12 8v5M12 16h.01"/>
                            </svg>
                            @break

                        @case('akun')
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>
                            @break
                    @endswitch

                    <span>{{ $item['short'] ?? $item['label'] ?? 'Menu' }}</span>
                </a>
            @endforeach
        </nav>

    </div>

@else

    {{-- Layout Breeze lama tetap dipakai untuk halaman Admin/Pengurus --}}
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

@endif

</body>
</html>
