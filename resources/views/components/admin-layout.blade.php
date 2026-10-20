@props([
    'title' => 'Dashboard Admin',
    'breadcrumb' => 'Dashboard',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>
        {{ $title }} - SmartTren
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body>

<div class="smarttren-admin">

    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}

    <aside
        id="adminSidebar"
        class="admin-sidebar"
    >

        {{-- BRAND --}}
        <div class="admin-brand">

            <a
                href="{{ route('admin.dashboard') }}"
                class="brand-link"
            >

                <div class="brand-logo">
                    S
                </div>

                <div class="brand-text">

                    <div class="brand-name">
                        SmartTren
                    </div>

                    <div class="brand-description">
                        Sistem Presensi
                    </div>

                </div>

            </a>

        </div>


        {{-- NAVIGATION --}}
        <nav class="admin-navigation">

            {{-- MAIN --}}
            <div class="navigation-title">
                MENU UTAMA
            </div>


            {{-- DASHBOARD --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="admin-nav-item
                    {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    <svg
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            x="3"
                            y="3"
                            width="7"
                            height="7"
                            rx="1"
                        />

                        <rect
                            x="14"
                            y="3"
                            width="7"
                            height="7"
                            rx="1"
                        />

                        <rect
                            x="3"
                            y="14"
                            width="7"
                            height="7"
                            rx="1"
                        />

                        <rect
                            x="14"
                            y="14"
                            width="7"
                            height="7"
                            rx="1"
                        />
                    </svg>
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- MANAGEMENT USER --}}
            <a
                href="{{ url('admin/users') }}"
                class="admin-nav-item
                    {{ request()->is('admin/users*') ? 'active' : '' }}"
            >

                <span class="nav-icon">

                    <svg
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            d="M22 21v-2a4 4 0 0 0-3-3.87"
                        />

                        <path
                            d="M16 3.13a4 4 0 0 1 0 7.75"
                        />

                    </svg>

                </span>

                <span>
                    Management User
                </span>

            </a>


            {{-- MAHASANTRI --}}
            <a
                href="{{ url('admin/mahasantri') }}"
                class="admin-nav-item
                    {{ request()->is('admin/mahasantri*') ? 'active' : '' }}"
            >

                <span class="nav-icon">

                    <svg
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <circle
                            cx="12"
                            cy="8"
                            r="4"
                        />

                        <path
                            d="M4 21a8 8 0 0 1 16 0"
                        />

                    </svg>

                </span>

                <span>
                    Data Mahasantri
                </span>

            </a>


            {{-- KEGIATAN --}}
            <a
                href="{{ url('admin/kegiatan') }}"
                class="admin-nav-item
                    {{ request()->is('admin/kegiatan*') ? 'active' : '' }}"
            >

                <span class="nav-icon">

                    <svg
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"
                        />

                        <path
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                        />

                    </svg>

                </span>

                <span>
                    Data Kegiatan
                </span>

            </a>
            {{-- REKAP & LAPORAN --}}
<a
    href="{{ route('admin.laporan.index') }}"
    class="admin-nav-item
        {{ request()->is('admin/laporan*') ? 'active' : '' }}"
>
    <span class="nav-icon">📊</span>
    <span>Rekap & Laporan</span>
</a>


            {{-- DIVIDER --}}
            <div class="navigation-divider"></div>


            {{-- SYSTEM --}}
            <div class="navigation-title">
                SISTEM
            </div>


            {{-- STATUS SISTEM --}}
            <div class="system-status">

                <div class="status-indicator"></div>

                <div class="status-content">

                    <div class="status-title">
                        Sistem Aktif
                    </div>

                    <div class="status-description">
                        SmartTren berjalan normal
                    </div>

                </div>

            </div>

        </nav>


        {{-- SIDEBAR BOTTOM --}}
        <div class="sidebar-bottom">

            <div class="admin-profile">

                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="profile-information">

                    <div class="profile-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="profile-role">
                        Administrator
                    </div>

                </div>

            </div>


            {{-- LOGOUT --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >

                    <svg
                        width="17"
                        height="17"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
                        />

                        <polyline
                            points="16 17 21 12 16 7"
                        />

                        <line
                            x1="21"
                            y1="12"
                            x2="9"
                            y2="12"
                        />

                    </svg>

                    <span>
                        Keluar
                    </span>

                </button>

            </form>

        </div>

    </aside>


    {{-- =========================================================
        MAIN AREA
    ========================================================== --}}

    <div class="admin-main">


        {{-- TOPBAR --}}
        <header class="admin-topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    id="sidebarToggle"
                    class="sidebar-toggle"
                >

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <line
                            x1="3"
                            y1="6"
                            x2="21"
                            y2="6"
                        />

                        <line
                            x1="3"
                            y1="12"
                            x2="21"
                            y2="12"
                        />

                        <line
                            x1="3"
                            y1="18"
                            x2="21"
                            y2="18"
                        />

                    </svg>

                </button>


                <div class="breadcrumb-wrapper">

                    <div class="breadcrumb">
                        {{ $breadcrumb }}
                    </div>

                    <h1 class="topbar-title">
                        {{ $title }}
                    </h1>

                </div>

            </div>


            {{-- TOPBAR RIGHT --}}
            <div class="topbar-right">

                <div class="topbar-status">

                    <span class="topbar-status-dot"></span>

                    Online

                </div>


                <div class="topbar-user">

                    <div class="topbar-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    <div class="topbar-user-information">

                        <div class="topbar-user-name">

                            {{ auth()->user()->name }}

                        </div>

                        <div class="topbar-user-role">

                            Administrator

                        </div>

                    </div>

                </div>

            </div>

        </header>


        {{-- PAGE CONTENT --}}
        <main class="admin-page-content">

            {{ $slot }}

        </main>


    </div>

</div>


{{-- =============================================================
    MOBILE OVERLAY
============================================================== --}}

<div
    id="sidebarOverlay"
    class="sidebar-overlay"
></div>


{{-- =============================================================
    ADMIN LAYOUT STYLE
============================================================== --}}

<style>

    :root {
        --admin-green: #047857;
        --admin-green-dark: #065f46;
        --admin-green-light: #ecfdf5;
        --admin-green-border: #d1fae5;

        --admin-bg: #f7f9f8;
        --admin-white: #ffffff;

        --admin-text: #111827;
        --admin-text-secondary: #64748b;
        --admin-text-muted: #94a3b8;

        --admin-border: #e5e7eb;

        --admin-sidebar-width: 260px;
        --admin-topbar-height: 74px;
    }


    * {
        box-sizing: border-box;
    }


    body {
        margin: 0;
        background: var(--admin-bg);
    }


    /* =========================================================
       MAIN WRAPPER
    ========================================================== */

    .smarttren-admin {
        min-height: 100vh;
        display: flex;
        background: var(--admin-bg);
    }


    /* =========================================================
       SIDEBAR
    ========================================================== */

    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;

        width: var(--admin-sidebar-width);
        height: 100vh;

        display: flex;
        flex-direction: column;

        background: var(--admin-white);

        border-right: 1px solid var(--admin-border);

        z-index: 100;

        transition:
            transform .25s ease,
            width .25s ease;
    }


    /* BRAND */

    .admin-brand {
        height: 84px;

        display: flex;
        align-items: center;

        padding: 0 22px;

        border-bottom: 1px solid #f1f5f9;
    }


    .brand-link {
        width: 100%;

        display: flex;
        align-items: center;

        gap: 12px;

        text-decoration: none;
    }


    .brand-logo {
        width: 43px;
        height: 43px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background:
            linear-gradient(
                135deg,
                #047857,
                #10b981
            );

        color: white;

        font-size: 19px;
        font-weight: 800;

        box-shadow:
            0 6px 16px rgba(4, 120, 87, .20);
    }


    .brand-name {
        font-size: 16px;
        font-weight: 800;

        color: var(--admin-text);
    }


    .brand-description {
        margin-top: 2px;

        font-size: 10px;

        color: var(--admin-text-muted);
    }


    /* NAV */

    .admin-navigation {
        flex: 1;

        overflow-y: auto;

        padding: 25px 14px;
    }


    .navigation-title {
        padding: 0 10px;

        margin-bottom: 9px;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: 1px;

        color: #9ca3af;
    }


    .admin-nav-item {
        position: relative;

        height: 45px;

        display: flex;
        align-items: center;

        gap: 12px;

        padding: 0 12px;

        margin-bottom: 4px;

        border-radius: 9px;

        color: var(--admin-text-secondary);

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        transition:
            background .18s ease,
            color .18s ease,
            transform .18s ease;
    }


    .admin-nav-item:hover {
        background: #f8fafc;

        color: var(--admin-green);
    }


    .admin-nav-item.active {
        background: var(--admin-green-light);

        color: var(--admin-green);

        font-weight: 700;
    }


    .admin-nav-item.active::before {
        content: "";

        position: absolute;

        left: 0;
        top: 9px;
        bottom: 9px;

        width: 3px;

        border-radius: 0 4px 4px 0;

        background: var(--admin-green);
    }


    .nav-icon {
        width: 23px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }


    .navigation-divider {
        height: 1px;

        margin: 20px 10px;

        background: #f1f5f9;
    }


    /* SYSTEM STATUS */

    .system-status {
        display: flex;

        align-items: center;

        gap: 10px;

        padding: 13px 12px;

        border-radius: 10px;

        background: #f8fafc;

        border: 1px solid #f1f5f9;
    }


    .status-indicator {
        width: 8px;
        height: 8px;

        flex-shrink: 0;

        border-radius: 50%;

        background: #22c55e;

        box-shadow:
            0 0 0 4px #dcfce7;
    }


    .status-title {
        font-size: 11px;

        font-weight: 700;

        color: #374151;
    }


    .status-description {
        margin-top: 2px;

        font-size: 9px;

        color: #94a3b8;
    }


    /* SIDEBAR BOTTOM */

    .sidebar-bottom {
        padding: 15px;

        border-top: 1px solid #f1f5f9;

        background: #ffffff;
    }


    .admin-profile {
        display: flex;

        align-items: center;

        gap: 10px;

        padding: 5px 5px 13px;
    }


    .profile-avatar,
    .topbar-avatar {
        display: flex;

        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 50%;

        background: var(--admin-green);

        color: white;

        font-weight: 800;
    }


    .profile-avatar {
        width: 36px;
        height: 36px;

        font-size: 12px;
    }


    .profile-name {
        max-width: 155px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

        font-size: 11px;

        font-weight: 700;

        color: #374151;
    }


    .profile-role {
        margin-top: 2px;

        font-size: 9px;

        color: #94a3b8;
    }


    .logout-button {
        width: 100%;

        height: 38px;

        display: flex;

        align-items: center;
        justify-content: center;

        gap: 8px;

        border: 1px solid #fee2e2;

        border-radius: 8px;

        background: #fffafa;

        color: #dc2626;

        font-size: 11px;

        font-weight: 700;

        cursor: pointer;

        transition: .2s ease;
    }


    .logout-button:hover {
        background: #fef2f2;

        border-color: #fecaca;
    }


    /* =========================================================
       MAIN
    ========================================================== */

    .admin-main {
        width: 100%;

        min-width: 0;

        margin-left: var(--admin-sidebar-width);
    }


    /* =========================================================
       TOPBAR
    ========================================================== */

    .admin-topbar {
        position: sticky;

        top: 0;

        z-index: 50;

        height: var(--admin-topbar-height);

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        padding: 0 30px;

        background: rgba(255,255,255,.96);

        border-bottom: 1px solid var(--admin-border);

        backdrop-filter: blur(12px);
    }


    .topbar-left {
        display: flex;

        align-items: center;

        gap: 15px;

        min-width: 0;
    }


    .sidebar-toggle {
        display: none;

        width: 38px;
        height: 38px;

        align-items: center;
        justify-content: center;

        border: 1px solid var(--admin-border);

        border-radius: 8px;

        background: white;

        color: #475569;

        cursor: pointer;
    }


    .breadcrumb {
        margin-bottom: 3px;

        font-size: 10px;

        color: #94a3b8;
    }


    .topbar-title {
        margin: 0;

        font-size: 19px;

        font-weight: 750;

        color: var(--admin-text);
    }


    .topbar-right {
        display: flex;

        align-items: center;

        gap: 20px;
    }


    .topbar-status {
        display: flex;

        align-items: center;

        gap: 6px;

        font-size: 10px;

        font-weight: 600;

        color: #64748b;
    }


    .topbar-status-dot {
        width: 7px;
        height: 7px;

        border-radius: 50%;

        background: #22c55e;
    }


    .topbar-user {
        display: flex;

        align-items: center;

        gap: 9px;
    }


    .topbar-avatar {
        width: 36px;
        height: 36px;

        font-size: 12px;
    }


    .topbar-user-name {
        max-width: 160px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

        font-size: 11px;

        font-weight: 700;

        color: #374151;
    }


    .topbar-user-role {
        margin-top: 2px;

        font-size: 9px;

        color: #94a3b8;
    }


    /* =========================================================
       PAGE CONTENT
    ========================================================== */

    .admin-page-content {
        min-height: calc(100vh - var(--admin-topbar-height));

        padding: 30px;

        background: var(--admin-bg);
    }


    /* =========================================================
       OVERLAY
    ========================================================== */

    .sidebar-overlay {
        display: none;

        position: fixed;

        inset: 0;

        background: rgba(15,23,42,.35);

        z-index: 90;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .admin-sidebar {
            transform: translateX(-100%);
        }


        .admin-sidebar.open {
            transform: translateX(0);
        }


        .admin-main {
            margin-left: 0;
        }


        .sidebar-toggle {
            display: flex;
        }


        .sidebar-overlay.active {
            display: block;
        }


        .admin-topbar {
            padding: 0 20px;
        }


        .admin-page-content {
            padding: 22px 20px;
        }

    }


    @media (max-width: 640px) {

        .topbar-status {
            display: none;
        }


        .topbar-user-information {
            display: none;
        }


        .admin-topbar {
            padding: 0 15px;
        }


        .admin-page-content {
            padding: 18px 14px;
        }


        .topbar-title {
            font-size: 17px;
        }

    }

    
/* =========================================================
   SMARTTRENMJ — LAYOUT REFINEMENT
   Penyempurnaan visual tanpa mengubah fitur
========================================================= */

:root {
    --admin-green: #087f5b;
    --admin-green-dark: #066649;
    --admin-green-light: #eaf7f0;
    --admin-green-border: #ccebd9;

    --admin-bg: #f5f7f6;
    --admin-white: #ffffff;

    --admin-text: #17221d;
    --admin-text-secondary: #64736b;
    --admin-text-muted: #8b9891;

    --admin-border: #e3e9e5;

    --admin-sidebar-width: 264px;
    --admin-topbar-height: 76px;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: Inter, "Segoe UI", Arial, sans-serif;
    color: var(--admin-text);
    -webkit-font-smoothing: antialiased;
}

/* Sidebar tetap di kiri */
.admin-sidebar {
    width: var(--admin-sidebar-width);
    background: #fff;
    border-right: 1px solid #e5ebe7;
    box-shadow: 3px 0 18px rgba(20, 50, 35, 0.025);
}

.admin-brand {
    height: 88px;
    padding: 0 24px;
}

.brand-logo {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    background: linear-gradient(145deg, #087f5b, #16a36f);
    box-shadow: 0 5px 12px rgba(8, 127, 91, 0.16);
}

.brand-name {
    font-size: 17px;
    letter-spacing: -0.4px;
}

.brand-description {
    font-size: 11px;
    margin-top: 4px;
}

/* Navigasi lebih lega dan konsisten */
.admin-navigation {
    padding: 25px 15px;
}

.navigation-title {
    font-size: 10px;
    letter-spacing: 1.15px;
    margin-bottom: 12px;
}

.admin-nav-item {
    min-height: 46px;
    height: auto;
    padding: 12px 13px;
    margin-bottom: 5px;
    gap: 13px;
    border-radius: 10px;
    font-size: 13px;
    line-height: 1.4;
}

.admin-nav-item:hover {
    background: #f2f8f4;
    transform: translateX(2px);
}

.admin-nav-item.active {
    background: #eaf7f0;
    color: #087f5b;
}

.admin-nav-item.active::before {
    top: 9px;
    bottom: 9px;
    border-radius: 0 5px 5px 0;
}

.nav-icon {
    width: 23px;
}

/* Informasi status sistem */
.system-status {
    padding: 14px 12px;
    border-radius: 12px;
    background: #f7faf8;
    border-color: #e8efea;
}

.status-title {
    font-size: 12px;
}

.status-description {
    font-size: 10px;
    line-height: 1.5;
}

/* Profil dan tombol keluar */
.sidebar-bottom {
    padding: 17px 15px;
    border-top-color: #e8eeea;
}

.profile-name {
    font-size: 12px;
}

.profile-role {
    font-size: 10px;
}

.logout-button {
    min-height: 41px;
    border-radius: 10px;
    font-size: 12px;
}

/* Header utama */
.admin-topbar {
    padding: 0 32px;
    background: rgba(255, 255, 255, 0.97);
    border-bottom-color: #e5ebe7;
}

.breadcrumb {
    font-size: 11px;
    margin-bottom: 5px;
}

.topbar-title {
    font-size: 21px;
    font-weight: 750;
    letter-spacing: -0.55px;
}

.topbar-status {
    padding: 8px 11px;
    border: 1px solid #e5eee8;
    border-radius: 999px;
    background: #f8fbf9;
    font-size: 11px;
}

.topbar-user-name {
    font-size: 12px;
}

.topbar-user-role {
    font-size: 10px;
}

/* Area konten */
.admin-page-content {
    padding: 32px;
    background: #f5f7f6;
}

/* Kartu, panel dan tabel */
.admin-page-content .bg-white {
    border-color: #e6ece8;
}

.admin-page-content table {
    border-collapse: separate;
    border-spacing: 0;
}

.admin-page-content th {
    font-size: 11px;
    letter-spacing: 0.035em;
}

.admin-page-content td {
    vertical-align: middle;
}

.admin-page-content input,
.admin-page-content select,
.admin-page-content textarea {
    min-height: 42px;
    border-radius: 9px;
}

.admin-page-content button,
.admin-page-content a {
    transition:
        background-color 0.18s ease,
        border-color 0.18s ease,
        box-shadow 0.18s ease;
}

/* Tampilan tablet */
@media (max-width: 900px) {
    .admin-topbar {
        padding: 0 22px;
    }

    .admin-page-content {
        padding: 24px 22px;
    }
}

/* Tampilan HP */
@media (max-width: 640px) {
    .admin-topbar {
        height: 68px;
        padding: 0 15px;
    }

    .admin-page-content {
        padding: 20px 14px;
    }

    .topbar-title {
        font-size: 18px;
    }

    .admin-brand {
        height: 80px;
    }
}

/* ===== PERAPIAN SIDEBAR SMARTTRENMJ ===== */

.admin-sidebar {
    width: 264px;
    min-width: 264px;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border-right: 1px solid #e5ebe7;
}

.admin-brand {
    min-height: 88px;
    box-sizing: border-box;
}

.admin-navigation {
    padding: 24px 14px;
}

.navigation-title {
    padding: 0 10px;
    margin-bottom: 14px;
    line-height: 1.5;
}

.admin-nav-item {
    width: 100%;
    min-height: 46px;
    height: 46px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 13px;
    margin: 0 0 6px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 550;
    line-height: 1.3;
    white-space: nowrap;
    text-decoration: none;
    transition: background-color .2s ease, color .2s ease;
}

.admin-nav-item:hover {
    background: #f2f8f4;
    transform: none;
}

.admin-nav-item.active {
    background: #e8f6ee;
    color: #087f5b;
    font-weight: 700;
}

.admin-nav-item.active::before {
    top: 9px;
    bottom: 9px;
    border-radius: 0 4px 4px 0;
}

.nav-icon {
    width: 22px;
    min-width: 22px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.system-status {
    margin-top: 18px;
    border-radius: 12px;
}

.sidebar-bottom {
    margin-top: auto;
    padding: 16px 14px;
}

@media (max-width: 900px) {
    .admin-sidebar {
        width: 264px;
        min-width: 264px;
    }

    .admin-navigation {
        padding: 20px 12px;
    }
}


/* ===== KONSISTENSI KONTEN ADMIN ===== */

.admin-page-content {
    width: 100%;
    min-width: 0;
    padding: 26px 28px;
    background: #f5f7f6;
}

.admin-page-content > * {
    min-width: 0;
}

.admin-page-content .report-page {
    width: 100%;
    max-width: none;
    margin: 0;
}

/* Grid laporan desktop */
.admin-page-content .report-page .rp-stat-grid {
    display: grid !important;
    grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
    gap: 14px;
}

.admin-page-content .report-page .rp-filter-grid {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 18px;
}

/* Tablet */
@media (max-width: 1100px) {
    .admin-page-content {
        padding: 22px;
    }

    .admin-page-content .report-page .rp-stat-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }

    .admin-page-content .report-page .rp-filter-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
}

/* HP */
@media (max-width: 640px) {
    .admin-page-content {
        padding: 16px 12px;
    }

    .admin-page-content .report-page .rp-stat-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    .admin-page-content .report-page .rp-filter-grid {
        grid-template-columns: minmax(0, 1fr) !important;
    }
}


</style>


{{-- =============================================================
    SIDEBAR JAVASCRIPT
============================================================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const sidebar =
            document.getElementById('adminSidebar');

        const toggle =
            document.getElementById('sidebarToggle');

        const overlay =
            document.getElementById('sidebarOverlay');


        if (!sidebar || !toggle || !overlay) {
            return;
        }


        toggle.addEventListener('click', function () {

            sidebar.classList.toggle('open');

            overlay.classList.toggle('active');

        });


        overlay.addEventListener('click', function () {

            sidebar.classList.remove('open');

            overlay.classList.remove('active');

        });


        window.addEventListener('resize', function () {

            if (window.innerWidth > 900) {

                sidebar.classList.remove('open');

                overlay.classList.remove('active');

            }

        });

    });
    

</script>


</body>

</html>