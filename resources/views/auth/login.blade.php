<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Login InoMitha - Sistem Informasi IntanMitha Collection"
    >

    <title>Login | InoMitha</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }

        :root {
            --primary: #8f4667;
            --primary-dark: #603247;
            --primary-soft: #b95e82;
            --text-dark: #513747;
            --text-muted: #927d88;
            --border: #eadde3;
            --background: #fff9fb;
        }

        html {
            min-height: 100%;
        }

        body {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            padding: 34px;
            color: var(--text-dark);
            background:
                radial-gradient(
                    circle at 8% 12%,
                    rgba(229, 175, 196, .36),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 92% 88%,
                    rgba(190, 153, 181, .28),
                    transparent 27%
                ),
                linear-gradient(
                    135deg,
                    #fffafb 0%,
                    #fdf5f8 48%,
                    #faf4f8 100%
                );
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            z-index: 0;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(2px);
        }

        body::before {
            width: 260px;
            height: 260px;
            top: -120px;
            right: 8%;
            border: 42px solid rgba(143, 70, 103, .035);
        }

        body::after {
            width: 190px;
            height: 190px;
            bottom: -95px;
            left: 6%;
            background: rgba(143, 70, 103, .035);
        }

        .page-decoration {
            position: fixed;
            z-index: 0;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: rgba(143, 70, 103, .16);
            box-shadow:
                35px 55px 0 rgba(143, 70, 103, .08),
                -45px 115px 0 rgba(143, 70, 103, .06);
            pointer-events: none;
        }

        .decoration-one {
            top: 13%;
            left: 7%;
        }

        .decoration-two {
            right: 8%;
            bottom: 20%;
            transform: scale(.7);
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            display: grid;
            grid-template-columns:
                minmax(0, .95fr)
                minmax(0, 1.05fr);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .8);
            border-radius: 28px;
            background: #ffffff;
            box-shadow:
                0 28px 80px rgba(94, 45, 68, .15),
                0 5px 20px rgba(94, 45, 68, .05);
        }

        /* =========================================================
           BRAND PANEL
        ========================================================= */

        .login-brand {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 50px;
            color: #ffffff;
            background:
                radial-gradient(
                    circle at 80% 15%,
                    rgba(255, 255, 255, .13),
                    transparent 27%
                ),
                linear-gradient(
                    145deg,
                    #583247 0%,
                    #81405e 48%,
                    #b85d81 100%
                );
        }

        .login-brand::before {
            content: "";
            position: absolute;
            width: 310px;
            height: 310px;
            top: -155px;
            right: -130px;
            border: 45px solid rgba(255, 255, 255, .045);
            border-radius: 50%;
        }

        .login-brand::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            bottom: -145px;
            left: -110px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .045);
        }

        .brand-glow {
            position: absolute;
            width: 170px;
            height: 170px;
            right: -30px;
            bottom: 80px;
            border-radius: 50%;
            background: rgba(255, 211, 228, .07);
            filter: blur(3px);
        }

        .brand-top,
        .brand-bottom {
            position: relative;
            z-index: 2;
        }

        .brand-badge {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 36px;
            padding: 7px 11px;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 30px;
            color: #fceaf1;
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(8px);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f7d4e1;
            box-shadow:
                0 0 0 4px rgba(255, 255, 255, .06);
        }

        .brand-icon {
            width: 66px;
            height: 66px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, .17);
            border-radius: 19px;
            background: rgba(255, 255, 255, .11);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .08),
                0 15px 30px rgba(57, 25, 40, .12);
            backdrop-filter: blur(8px);
            font-size: 27px;
        }

        .login-brand h1 {
            margin-bottom: 8px;
            font-size: 42px;
            line-height: 1.1;
            letter-spacing: -.7px;
        }

        .store-name {
            margin-bottom: 20px;
            color: #f9dce7;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .brand-description {
            max-width: 390px;
            margin-bottom: 28px;
            color: #f5e8ed;
            font-size: 13px;
            line-height: 1.8;
        }

        .feature-list {
            display: grid;
            gap: 10px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #f7eaf0;
            font-size: 11px;
        }

        .feature-check {
            width: 23px;
            height: 23px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 7px;
            background: rgba(255, 255, 255, .09);
            font-size: 9px;
            font-weight: 800;
        }

        .brand-bottom {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 36px;
            color: #efdce4;
            font-size: 10px;
        }

        .system-status-dot {
            width: 6px;
            height: 6px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #c9e7d2;
            box-shadow:
                0 0 0 4px rgba(201, 231, 210, .08);
        }

        /* =========================================================
           LOGIN FORM
        ========================================================= */

        .login-form-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 58px 65px;
            background:
                radial-gradient(
                    circle at 100% 0,
                    rgba(143, 70, 103, .025),
                    transparent 30%
                ),
                #ffffff;
        }

        .form-header {
            margin-bottom: 29px;
        }

        .form-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .9px;
            text-transform: uppercase;
        }

        .form-eyebrow::before {
            content: "";
            width: 18px;
            height: 2px;
            border-radius: 10px;
            background: var(--primary);
        }

        .login-form-wrapper h2 {
            margin-bottom: 8px;
            color: #4f3040;
            font-size: 30px;
            line-height: 1.25;
            letter-spacing: -.3px;
        }

        .login-subtitle {
            max-width: 410px;
            color: #96808b;
            font-size: 13px;
            line-height: 1.7;
        }

        /* =========================================================
           ALERT
        ========================================================= */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 11px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert-icon {
            width: 21px;
            height: 21px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
        }

        .alert-success {
            color: #426c50;
            border: 1px solid #d2e8d8;
            background: #f0f8f2;
        }

        .alert-success .alert-icon {
            background: #dcefe1;
        }

        .alert-error {
            color: #93485a;
            border: 1px solid #f0d2da;
            background: #fff3f5;
        }

        .alert-error .alert-icon {
            background: #f8dfe5;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #654858;
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 15px;
            width: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            color: #ad929f;
            pointer-events: none;
        }

        .input-icon svg {
            width: 17px;
            height: 17px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-control {
            width: 100%;
            height: 51px;
            padding: 0 45px 0 45px;
            border: 1px solid var(--border);
            border-radius: 11px;
            outline: none;
            color: #523846;
            background: #fffdfd;
            font-size: 13px;
            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-control:hover {
            border-color: #dac3ce;
        }

        .form-control:focus {
            border-color: #b76688;
            background: #ffffff;
            box-shadow:
                0 0 0 4px rgba(184, 95, 130, .08);
        }

        .form-control::placeholder {
            color: #b9a7b0;
        }

        .password-toggle {
            position: absolute;
            z-index: 3;
            top: 50%;
            right: 10px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            border: none;
            border-radius: 8px;
            color: #9f8793;
            background: transparent;
            cursor: pointer;
            transition:
                color .2s ease,
                background .2s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
            background: #faedf2;
        }

        .password-toggle:focus-visible {
            outline: 2px solid rgba(143, 70, 103, .25);
            outline-offset: 1px;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .eye-hidden {
            display: none;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 1px 0 25px;
        }

        .remember-wrapper {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #765e6b;
            font-size: 11px;
            cursor: pointer;
            user-select: none;
        }

        .remember-wrapper input {
            width: 14px;
            height: 14px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .secure-label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #aa929e;
            font-size: 10px;
        }

        .secure-label svg {
            width: 13px;
            height: 13px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-login {
            position: relative;
            width: 100%;
            height: 51px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: none;
            border-radius: 11px;
            color: #ffffff;
            background:
                linear-gradient(
                    135deg,
                    #754058 0%,
                    #974c6d 48%,
                    #ba6184 100%
                );
            box-shadow:
                0 9px 22px rgba(143, 70, 103, .18);
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-login::before {
            content: "";
            position: absolute;
            width: 80px;
            height: 100%;
            top: 0;
            left: -100px;
            transform: skewX(-20deg);
            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, .14),
                    transparent
                );
            transition: left .5s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow:
                0 13px 27px rgba(143, 70, 103, .24);
        }

        .btn-login:hover::before {
            left: calc(100% + 30px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: .75;
            cursor: wait;
            transform: none;
        }

        .btn-arrow {
            font-size: 17px;
            line-height: 1;
            transition: transform .2s ease;
        }

        .btn-login:hover .btn-arrow {
            transform: translateX(2px);
        }

        .login-spinner {
            width: 15px;
            height: 15px;
            display: none;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .btn-login.loading .login-spinner {
            display: block;
        }

        .btn-login.loading .btn-arrow {
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .login-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0 17px;
            color: #b5a2ab;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .login-divider::before,
        .login-divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #f0e5e9;
        }

        .system-info {
            display: flex;
            justify-content: center;
            gap: 6px;
            color: #9f8a95;
            font-size: 10px;
            text-align: center;
            line-height: 1.6;
        }

        .system-info strong {
            color: #785367;
        }

        .footer-text {
            margin-top: 9px;
            color: #b09ca6;
            font-size: 9px;
            text-align: center;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {
            body {
                padding: 24px;
            }

            .login-container {
                max-width: 580px;
                grid-template-columns: 1fr;
            }

            .login-brand {
                min-height: auto;
                padding: 36px 40px;
            }

            .brand-badge {
                margin-bottom: 22px;
            }

            .brand-icon {
                width: 55px;
                height: 55px;
                margin-bottom: 18px;
                border-radius: 16px;
                font-size: 23px;
            }

            .login-brand h1 {
                font-size: 34px;
            }

            .brand-description {
                margin-bottom: 0;
            }

            .feature-list,
            .brand-bottom {
                display: none;
            }

            .login-form-wrapper {
                padding: 42px 40px;
            }
        }

        @media (max-width: 520px) {
            body {
                align-items: flex-start;
                padding: 12px;
            }

            .login-container {
                margin: 10px 0;
                border-radius: 20px;
            }

            .login-brand {
                padding: 28px 25px;
            }

            .brand-badge {
                margin-bottom: 18px;
                font-size: 8px;
            }

            .brand-icon {
                width: 48px;
                height: 48px;
                margin-bottom: 14px;
            }

            .login-brand h1 {
                font-size: 29px;
            }

            .store-name {
                margin-bottom: 12px;
                font-size: 13px;
            }

            .brand-description {
                font-size: 11px;
                line-height: 1.7;
            }

            .login-form-wrapper {
                padding: 34px 25px;
            }

            .login-form-wrapper h2 {
                font-size: 25px;
            }

            .login-subtitle {
                font-size: 11px;
            }

            .form-options {
                align-items: flex-start;
                flex-direction: column;
                gap: 9px;
            }
        }
    </style>
</head>

<body>

    <span class="page-decoration decoration-one"></span>
    <span class="page-decoration decoration-two"></span>

    <main class="login-container">

        {{-- =====================================================
             BRAND / INFORMATION PANEL
        ====================================================== --}}
        <section class="login-brand">

            <div class="brand-glow"></div>

            <div class="brand-top">

                <div class="brand-badge">
                    <span class="badge-dot"></span>
                    Integrated Business System
                </div>

                <div class="brand-icon">
                    ✦
                </div>

                <h1>InoMitha</h1>

                <p class="store-name">
                    IntanMitha Collection
                </p>

                <p class="brand-description">
                    Sistem informasi bisnis terintegrasi untuk membantu
                    pengelolaan pelanggan, penjualan, persediaan, laporan,
                    serta analisis bisnis berbasis kecerdasan buatan.
                </p>

                <div class="feature-list">

                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        Manajemen pelanggan dan riwayat transaksi
                    </div>

                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        Penjualan dan persediaan terintegrasi
                    </div>

                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        Laporan dan insight bisnis
                    </div>

                    <div class="feature-item">
                        <span class="feature-check">✦</span>
                        AI Business Assistant dengan Gemini
                    </div>

                </div>

            </div>

            <div class="brand-bottom">
                <span class="system-status-dot"></span>
                Sistem InoMitha siap digunakan
            </div>

        </section>


        {{-- =====================================================
             LOGIN FORM
        ====================================================== --}}
        <section class="login-form-wrapper">

            <div class="form-header">

                <span class="form-eyebrow">
                    Secure Access
                </span>

                <h2>Selamat Datang Kembali</h2>

                <p class="login-subtitle">
                    Masuk ke akun Anda untuk mengakses dashboard
                    dan mengelola aktivitas bisnis IntanMitha Collection.
                </p>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div class="alert alert-success">

                    <span class="alert-icon">
                        ✓
                    </span>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- ERROR MESSAGE --}}
            @if ($errors->any())

                <div class="alert alert-error">

                    <span class="alert-icon">
                        !
                    </span>

                    <span>
                        {{ $errors->first() }}
                    </span>

                </div>

            @endif


            <form
                action="{{ route('login.process') }}"
                method="POST"
                id="loginForm"
            >

                @csrf


                {{-- EMAIL --}}
                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M4 6h16v12H4z"
                                ></path>

                                <path
                                    d="m4 7 8 6 8-6"
                                ></path>
                            </svg>

                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email Anda"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <rect
                                    x="5"
                                    y="10"
                                    width="14"
                                    height="10"
                                    rx="2"
                                ></rect>

                                <path
                                    d="M8 10V7a4 4 0 0 1 8 0v3"
                                ></path>
                            </svg>

                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password Anda"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="passwordToggle"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                            title="Tampilkan password"
                        >

                            {{-- Mata terbuka --}}
                            <svg
                                id="eyeOpen"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                ></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="2.5"
                                ></circle>
                            </svg>

                            {{-- Mata dicoret --}}
                            <svg
                                id="eyeClosed"
                                class="eye-hidden"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M3 3l18 18"
                                ></path>

                                <path
                                    d="M10.6 6.2A9.6 9.6 0 0 1 12 6c6 0 9.5 6 9.5 6a15.4 15.4 0 0 1-2.1 2.8"
                                ></path>

                                <path
                                    d="M6.1 6.1C3.7 7.7 2.5 12 2.5 12s3.5 6 9.5 6a9.7 9.7 0 0 0 4-.8"
                                ></path>

                                <path
                                    d="M9.8 9.8a3 3 0 0 0 4.4 4.4"
                                ></path>
                            </svg>

                        </button>

                    </div>

                </div>


                {{-- OPTIONS --}}
                <div class="form-options">

                    <label class="remember-wrapper">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <span>
                            Ingat saya
                        </span>

                    </label>

                    <span class="secure-label">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M12 3 5 6v5c0 4.5 2.8 8.1 7 10 4.2-1.9 7-5.5 7-10V6z"
                            ></path>

                            <path
                                d="m9.5 12 1.7 1.7 3.6-3.7"
                            ></path>
                        </svg>

                        Akses aman
                    </span>

                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    type="submit"
                    class="btn-login"
                    id="loginButton"
                >

                    <span
                        class="login-spinner"
                        id="loginSpinner"
                    ></span>

                    <span id="loginButtonText">
                        Masuk ke InoMitha
                    </span>

                    <span class="btn-arrow">
                        ›
                    </span>

                </button>

            </form>


            <div class="login-divider">
                InoMitha Business System
            </div>


            <div class="system-info">
                <span>
                    <strong>IntanMitha Collection</strong>
                    · Business Management & AI
                </span>
            </div>

            <p class="footer-text">
                &copy; {{ date('Y') }} InoMitha ·
                Seluruh akses dikelola melalui sistem
            </p>

        </section>

    </main>


    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /*
                |--------------------------------------------------------------------------
                | Show / Hide Password
                |--------------------------------------------------------------------------
                */

                const passwordInput =
                    document.getElementById('password');

                const passwordToggle =
                    document.getElementById('passwordToggle');

                const eyeOpen =
                    document.getElementById('eyeOpen');

                const eyeClosed =
                    document.getElementById('eyeClosed');


                if (
                    passwordInput &&
                    passwordToggle &&
                    eyeOpen &&
                    eyeClosed
                ) {

                    passwordToggle.addEventListener(
                        'click',
                        function () {

                            const passwordIsHidden =
                                passwordInput.type === 'password';


                            passwordInput.type =
                                passwordIsHidden
                                    ? 'text'
                                    : 'password';


                            eyeOpen.style.display =
                                passwordIsHidden
                                    ? 'none'
                                    : 'block';


                            eyeClosed.style.display =
                                passwordIsHidden
                                    ? 'block'
                                    : 'none';


                            passwordToggle.setAttribute(
                                'aria-label',
                                passwordIsHidden
                                    ? 'Sembunyikan password'
                                    : 'Tampilkan password'
                            );


                            passwordToggle.setAttribute(
                                'title',
                                passwordIsHidden
                                    ? 'Sembunyikan password'
                                    : 'Tampilkan password'
                            );


                            passwordToggle.setAttribute(
                                'aria-pressed',
                                passwordIsHidden
                                    ? 'true'
                                    : 'false'
                            );

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Login Loading State
                |--------------------------------------------------------------------------
                */

                const loginForm =
                    document.getElementById('loginForm');

                const loginButton =
                    document.getElementById('loginButton');

                const loginButtonText =
                    document.getElementById('loginButtonText');


                if (
                    loginForm &&
                    loginButton &&
                    loginButtonText
                ) {

                    loginForm.addEventListener(
                        'submit',
                        function () {

                            loginButton.disabled = true;

                            loginButton.classList.add(
                                'loading'
                            );

                            loginButtonText.textContent =
                                'Memverifikasi akun...';

                        }
                    );

                }

            }
        );
    </script>

</body>
</html>