<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'InoMitha')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #8f4667;
            --primary-dark: #65364d;
            --primary-light: #f7e8ee;
            --secondary: #bd6688;
            --background: #fbf8fa;
            --white: #ffffff;
            --text: #4f3944;
            --text-muted: #947e89;
            --border: #eee3e8;
            --sidebar-width: 260px;
        }

        body {
            min-height: 100vh;
            background: var(--background);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            padding: 24px 18px;
            color: #ffffff;
            background:
                radial-gradient(
                    circle at top right,
                    rgba(255, 255, 255, 0.10),
                    transparent 30%
                ),
                linear-gradient(180deg, #63384e 0%, #7f405e 55%, #5b3147 100%);
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 4px 10px 26px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.12);
            font-size: 22px;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .brand-store {
            margin-top: 3px;
            color: #ead4de;
            font-size: 10px;
        }

        .menu-label {
            margin: 25px 12px 10px;
            color: #d8b8c7;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            border-radius: 11px;
            color: #f3e7ec;
            font-size: 13px;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            transform: translateX(2px);
        }

        .nav-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.16);
            box-shadow: inset 3px 0 0 #f5c9da;
        }

        .nav-icon {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        /* =========================
        AI NAVIGATION
        ========================= */

        .ai-nav-link {
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.055);
        }

        .ai-nav-link:hover {
            border-color: rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.11);
        }

        .ai-nav-icon {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #fff3f7;
            background: rgba(255, 255, 255, 0.11);
            font-size: 13px;
        }

        .ai-nav-content {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .ai-nav-title {
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            line-height: 1.3;
        }

        .ai-nav-status {
            color: #ddbdcb;
            font-size: 8px;
            line-height: 1.2;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        /* =========================
        SIDEBAR AI CARD
        ========================= */

        .sidebar-ai-card {
            position: relative;
            overflow: hidden;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.13),
                    rgba(255, 255, 255, 0.06)
                );
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.08),
                0 8px 22px rgba(46, 20, 34, 0.10);
        }

        .sidebar-ai-card::after {
            content: "✦";
            position: absolute;
            right: -4px;
            bottom: -17px;
            color: rgba(255, 255, 255, 0.055);
            font-size: 62px;
            line-height: 1;
            pointer-events: none;
        }

        .sidebar-ai-card-header {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 9px;
        }

        .sidebar-ai-icon {
            width: 29px;
            height: 29px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 9px;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.12);
            font-size: 12px;
        }

        .sidebar-ai-card-title {
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
        }

        .sidebar-ai-card-label {
            margin-top: 2px;
            color: #e8ccd8;
            font-size: 8px;
        }

        .sidebar-ai-card-text {
            position: relative;
            z-index: 2;
            margin: 0;
            color: #f0dfe7;
            font-size: 9px;
            line-height: 1.65;
        }

        /* =========================
           MAIN
        ========================= */

        .main-wrapper {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            position: sticky;
            top: 0;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.96);
            z-index: 900;
        }

        .topbar-left h2 {
            color: var(--primary-dark);
            font-size: 18px;
        }

        .topbar-left p {
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 11px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding-left: 15px;
            border-left: 1px solid var(--border);
        }

        .avatar {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #ffffff;
            background: linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );
            font-size: 14px;
            font-weight: 700;
        }

        .user-name {
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 700;
        }

        .user-role {
            margin-top: 3px;
            color: var(--text-muted);
            font-size: 10px;
        }

        .logout-form {
            display: inline;
        }

        .logout-button {
            padding: 9px 13px;
            border: 1px solid #ead9e1;
            border-radius: 9px;
            color: var(--primary);
            background: #ffffff;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .logout-button:hover {
            color: #ffffff;
            border-color: var(--primary);
            background: var(--primary);
        }

        /* =========================
        LOGOUT CONFIRMATION MODAL
        ========================= */

        .logout-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(49, 27, 38, 0.48);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);

            opacity: 0;
            visibility: hidden;
            pointer-events: none;

            transition:
                opacity 0.25s ease,
                visibility 0.25s ease;
        }

        .logout-modal-overlay.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .logout-modal {
            position: relative;
            width: 100%;
            max-width: 430px;
            overflow: hidden;
            padding: 35px 34px 28px;
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 22px;
            background:
                radial-gradient(
                    circle at top right,
                    rgba(190, 102, 136, 0.08),
                    transparent 28%
                ),
                #ffffff;
            box-shadow:
                0 28px 70px rgba(67, 32, 49, 0.24),
                0 5px 18px rgba(67, 32, 49, 0.08);

            opacity: 0;
            transform: translateY(14px) scale(0.97);

            transition:
                transform 0.25s ease,
                opacity 0.25s ease;
        }

        .logout-modal-overlay.show .logout-modal {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .logout-modal::before {
            content: "";
            position: absolute;
            top: -75px;
            right: -75px;
            width: 175px;
            height: 175px;
            border: 28px solid rgba(143, 70, 103, 0.035);
            border-radius: 50%;
            pointer-events: none;
        }

        .logout-modal-close {
            position: absolute;
            top: 17px;
            right: 17px;
            z-index: 2;
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eee1e7;
            border-radius: 9px;
            color: #9d818e;
            background: #ffffff;
            font-size: 18px;
            line-height: 1;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-modal-close:hover {
            color: var(--primary);
            border-color: #e2cbd5;
            background: #fbf1f5;
            transform: rotate(4deg);
        }

        .logout-modal-icon {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 19px;
            border: 1px solid #efdce4;
            border-radius: 17px;
            color: #ffffff;
            background: linear-gradient(
                135deg,
                #754058,
                #aa5779
            );
            box-shadow: 0 9px 22px rgba(143, 70, 103, 0.18);
        }

        .logout-modal-icon span {
            font-size: 24px;
            line-height: 1;
            transform: rotate(45deg);
        }

        .logout-modal-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            color: var(--primary);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .logout-modal-label::before {
            content: "";
            width: 16px;
            height: 2px;
            border-radius: 10px;
            background: var(--primary);
        }

        .logout-modal h3 {
            margin-bottom: 9px;
            color: #523447;
            font-size: 23px;
            line-height: 1.3;
        }

        .logout-modal-description {
            max-width: 350px;
            margin-bottom: 22px;
            color: #917a86;
            font-size: 12px;
            line-height: 1.75;
        }

        .logout-modal-user {
            position: relative;
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 24px;
            padding: 12px 14px;
            border: 1px solid #eee2e7;
            border-radius: 12px;
            background: #fdf9fb;
        }

        .logout-modal-avatar {
            width: 37px;
            height: 37px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            color: #ffffff;
            background: linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );
            font-size: 12px;
            font-weight: 800;
        }

        .logout-modal-user-info {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .logout-modal-user-info strong {
            overflow: hidden;
            color: #614253;
            font-size: 11px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .logout-modal-user-info span {
            color: #a18b96;
            font-size: 9px;
        }

        .logout-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 10px;
        }

        .logout-cancel-button,
        .logout-confirm-button {
            min-height: 43px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-cancel-button {
            border: 1px solid #e7d9df;
            color: #765968;
            background: #ffffff;
        }

        .logout-cancel-button:hover {
            border-color: #d9beca;
            color: var(--primary);
            background: #fdf7f9;
        }

        .logout-confirm-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid var(--primary);
            color: #ffffff;
            background: linear-gradient(
                135deg,
                #754058,
                #a75275
            );
            box-shadow: 0 7px 17px rgba(143, 70, 103, 0.16);
        }

        .logout-confirm-button:hover {
            transform: translateY(-1px);
            background: linear-gradient(
                135deg,
                #65364d,
                #914564
            );
            box-shadow: 0 10px 20px rgba(143, 70, 103, 0.22);
        }

        .logout-confirm-arrow {
            font-size: 16px;
            line-height: 1;
            transition: transform 0.2s ease;
        }

        .logout-confirm-button:hover .logout-confirm-arrow {
            transform: translateX(2px);
        }

        .logout-modal-note {
            margin-top: 15px;
            color: #b09ba5;
            font-size: 9px;
            text-align: center;
        }

        body.logout-modal-open {
            overflow: hidden;
        }

        @media (max-width: 520px) {
            .logout-modal-overlay {
                padding: 16px;
            }

            .logout-modal {
                max-width: 100%;
                padding: 31px 23px 24px;
                border-radius: 19px;
            }

            .logout-modal-icon {
                width: 51px;
                height: 51px;
            }

            .logout-modal h3 {
                font-size: 20px;
            }

            .logout-modal-actions {
                grid-template-columns: 1fr;
            }

            .logout-cancel-button,
            .logout-confirm-button {
                width: 100%;
            }
        }

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 30px 32px 40px;
        }

        .flash-message {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #cde7d5;
            border-radius: 10px;
            color: #38694a;
            background: #eef9f1;
            font-size: 12px;
        }

        /* =========================
           MOBILE
        ========================= */

        .mobile-menu-button {
            display: none;
            border: none;
            color: var(--primary-dark);
            background: transparent;
            font-size: 24px;
            cursor: pointer;
        }

        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-menu-button {
                display: block;
            }

            .topbar {
                padding: 0 20px;
            }

            .content {
                padding: 25px 20px;
            }
        }

        @media (max-width: 600px) {
            .user-detail {
                display: none;
            }

            .topbar-left p {
                display: none;
            }
        }

        .flash-error {
            border: 1px solid #f0d5dc;
            color: #8d4356;
            background: #fff2f5;
        }

        .flash-error .flash-icon {
            color: #ffffff;
            background: #a94f64;
        }
    </style>

    @stack('styles')
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <div class="brand">

            <div class="brand-logo">
                ✦
            </div>

            <div>
                <div class="brand-name">InoMitha</div>
                <div class="brand-store">IntanMitha Collection</div>
            </div>

        </div>

        <div class="menu-label">
            Menu Utama
        </div>

        <ul class="nav-menu">

            <li class="nav-item">
                <a
                    href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    <span class="nav-icon">⌂</span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="{{ route('customers.index') }}"
                    class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">♙</span>
                    <span>Pelanggan</span>
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="{{ route('categories.index') }}"
                    class="nav-link {{ request()->routeIs('categories.*') || request()->routeIs('products.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">◇</span>
                    <span>Produk & Kategori</span>
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="{{ route('sales.index') }}"
                    class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">♢</span>
                    <span>Transaksi Penjualan</span>
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="{{ route('inventory.index') }}"
                    class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">≡</span>
                    <span>Persediaan</span>
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="{{ route('reports.index') }}"
                    class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">▤</span>
                    <span>Laporan</span>
                </a>
            </li>

        </ul>

        <div class="menu-label">
            Artificial Intelligence
        </div>

        <ul class="nav-menu">

            <li class="nav-item">

                <a
                    href="{{ route('ai.index') }}"
                    class="nav-link ai-nav-link {{ request()->routeIs('ai.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon ai-nav-icon">
                        ✦
                    </span>

                    <span class="ai-nav-content">

                        <span class="ai-nav-title">
                            AI Business Assistant
                        </span>

                        <span class="ai-nav-status">
                            Gemini AI Aktif
                        </span>

                    </span>

                </a>

            </li>

        </ul>

        <div class="sidebar-bottom">

            <div class="sidebar-ai-card">

                <div class="sidebar-ai-card-header">

                    <div class="sidebar-ai-icon">
                        ✦
                    </div>

                    <div>
                        <div class="sidebar-ai-card-title">
                            InoMitha AI
                        </div>

                        <div class="sidebar-ai-card-label">
                            Business Intelligence
                        </div>
                    </div>

                </div>

                <p class="sidebar-ai-card-text">
                    Analisis penjualan, rekomendasi promosi,
                    dan persediaan berbasis AI.
                </p>

            </div>

        </div>

    </aside>

    <div class="main-wrapper">

        <header class="topbar">

            <div style="display: flex; align-items: center; gap: 15px;">

                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                >
                    ☰
                </button>

                <div class="topbar-left">
                    <h2>@yield('page-title', 'Dashboard')</h2>
                    <p>@yield('page-subtitle', 'IntanMitha Collection Management System')</p>
                </div>

            </div>

            <div class="topbar-right">

                <div class="user-profile">

                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="user-detail">
                        <div class="user-name">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="user-role">
                            Administrator
                        </div>
                    </div>

                </div>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                    id="logoutForm"
                >
                    @csrf

                    <button
                        type="button"
                        class="logout-button"
                        id="openLogoutModal"
                    >
                        Keluar
                    </button>
                </form>

            </div>

        </header>

        <main class="content">

            @if (session('success'))
                <div class="flash-message">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="flash-message flash-error">
                    <span class="flash-icon">!</span>

                    <div>
                        <strong>Perhatian</strong>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')

        </main>

    </div>

        {{-- =========================
            LOGOUT CONFIRMATION MODAL
        ========================== --}}

        <div
            class="logout-modal-overlay"
            id="logoutModal"
            aria-hidden="true"
        >
            <div
                class="logout-modal"
                role="dialog"
                aria-modal="true"
                aria-labelledby="logoutModalTitle"
            >

                <button
                    type="button"
                    class="logout-modal-close"
                    id="closeLogoutModal"
                    aria-label="Tutup konfirmasi"
                >
                    ×
                </button>

                <div class="logout-modal-icon">
                    <span>↗</span>
                </div>

                <div class="logout-modal-label">
                    Konfirmasi Keluar
                </div>

                <h3 id="logoutModalTitle">
                    Keluar dari InoMitha?
                </h3>

                <p class="logout-modal-description">
                    Apakah Anda yakin ingin mengakhiri sesi?
                    Anda perlu masuk kembali untuk mengakses
                    sistem InoMitha.
                </p>

                <div class="logout-modal-user">

                    <div class="logout-modal-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="logout-modal-user-info">

                        <strong>
                            {{ auth()->user()->name }}
                        </strong>

                        <span>
                            Administrator · IntanMitha Collection
                        </span>

                    </div>

                </div>

                <div class="logout-modal-actions">

                    <button
                        type="button"
                        class="logout-cancel-button"
                        id="cancelLogout"
                    >
                        Batal
                    </button>

                    <button
                        type="button"
                        class="logout-confirm-button"
                        id="confirmLogout"
                    >
                        <span>Ya, Keluar</span>
                        <span class="logout-confirm-arrow">›</span>
                    </button>

                </div>

                <p class="logout-modal-note">
                    Sesi Anda akan ditutup dengan aman.
                </p>

            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                /*
                |--------------------------------------------------------------------------
                | Mobile Sidebar
                |--------------------------------------------------------------------------
                */

                const mobileMenuButton =
                    document.getElementById('mobileMenuButton');

                const sidebar =
                    document.getElementById('sidebar');

                if (mobileMenuButton && sidebar) {
                    mobileMenuButton.addEventListener('click', function () {
                        sidebar.classList.toggle('show');
                    });
                }


                /*
                |--------------------------------------------------------------------------
                | Logout Confirmation Modal
                |--------------------------------------------------------------------------
                */

                const logoutModal =
                    document.getElementById('logoutModal');

                const openLogoutModal =
                    document.getElementById('openLogoutModal');

                const closeLogoutModal =
                    document.getElementById('closeLogoutModal');

                const cancelLogout =
                    document.getElementById('cancelLogout');

                const confirmLogout =
                    document.getElementById('confirmLogout');

                const logoutForm =
                    document.getElementById('logoutForm');


                function showLogoutModal() {
                    if (!logoutModal) {
                        return;
                    }

                    logoutModal.classList.add('show');

                    logoutModal.setAttribute(
                        'aria-hidden',
                        'false'
                    );

                    document.body.classList.add(
                        'logout-modal-open'
                    );

                    setTimeout(function () {
                        if (cancelLogout) {
                            cancelLogout.focus();
                        }
                    }, 100);
                }


                function hideLogoutModal() {
                    if (!logoutModal) {
                        return;
                    }

                    logoutModal.classList.remove('show');

                    logoutModal.setAttribute(
                        'aria-hidden',
                        'true'
                    );

                    document.body.classList.remove(
                        'logout-modal-open'
                    );

                    if (openLogoutModal) {
                        openLogoutModal.focus();
                    }
                }


                if (openLogoutModal) {
                    openLogoutModal.addEventListener(
                        'click',
                        showLogoutModal
                    );
                }


                if (closeLogoutModal) {
                    closeLogoutModal.addEventListener(
                        'click',
                        hideLogoutModal
                    );
                }


                if (cancelLogout) {
                    cancelLogout.addEventListener(
                        'click',
                        hideLogoutModal
                    );
                }


                /*
                | Klik area gelap di luar modal = batal
                */
                if (logoutModal) {
                    logoutModal.addEventListener(
                        'click',
                        function (event) {

                            if (event.target === logoutModal) {
                                hideLogoutModal();
                            }

                        }
                    );
                }


                /*
                | Tombol ESC = batal
                */
                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key === 'Escape' &&
                            logoutModal &&
                            logoutModal.classList.contains('show')
                        ) {
                            hideLogoutModal();
                        }

                    }
                );


                /*
                | Konfirmasi logout
                */
                if (confirmLogout && logoutForm) {
                    confirmLogout.addEventListener(
                        'click',
                        function () {

                            confirmLogout.disabled = true;

                            confirmLogout.innerHTML =
                                '<span>Keluar...</span>';

                            logoutForm.submit();

                        }
                    );
                }

            });
        </script>

    @stack('scripts')

</body>
</html>