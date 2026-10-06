<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartTren | Login</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* =====================================================
           BACKGROUND
        ====================================================== */

        .login-page {
            min-height: 100vh;
            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(74, 222, 128, .30),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(16, 185, 129, .25),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #064e3b 0%,
                    #047857 45%,
                    #065f46 100%
                );
        }


        /* =====================================================
           BACKGROUND DECORATION
        ====================================================== */

        .circle-one {
            position: absolute;

            width: 420px;
            height: 420px;

            border-radius: 50%;

            background: rgba(255,255,255,.035);

            left: -180px;
            top: -140px;
        }


        .circle-two {
            position: absolute;

            width: 520px;
            height: 520px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,.07);

            right: -220px;
            bottom: -240px;
        }


        .circle-three {
            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background: rgba(255,255,255,.035);

            right: 15%;
            top: -100px;
        }


        /* =====================================================
           MAIN CONTAINER
        ====================================================== */

        .login-container {
            position: relative;

            z-index: 5;

            width: 92%;
            max-width: 1120px;

            min-height: 650px;

            display: grid;

            grid-template-columns:
                1.1fr
                .9fr;

            overflow: hidden;

            border-radius: 24px;

            border:
                1px solid
                rgba(255,255,255,.18);

            background:
                rgba(255,255,255,.08);

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.25);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);
        }


        /* =====================================================
           LEFT BRANDING
        ====================================================== */

        .brand-section {
            position: relative;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            padding: 55px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    rgba(6,78,59,.75),
                    rgba(5,150,105,.45)
                );
        }


        .brand-logo {
            width: 62px;
            height: 62px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background: white;

            color: #047857;

            font-size: 22px;

            font-weight: 800;

            box-shadow:
                0 10px 30px
                rgba(0,0,0,.15);
        }


        .brand-label {
            margin-top: 25px;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 4px;

            color: #bbf7d0;
        }


        .brand-title {
            margin-top: 18px;

            font-size: 45px;

            line-height: 1.15;

            font-weight: 800;

            max-width: 520px;
        }


        .brand-description {
            margin-top: 20px;

            max-width: 500px;

            font-size: 15px;

            line-height: 1.8;

            color:
                rgba(255,255,255,.78);
        }


        /* =====================================================
           FEATURE
        ====================================================== */

        .feature-list {
            display: flex;

            gap: 12px;

            margin-top: 30px;
        }


        .feature-item {
            display: flex;

            align-items: center;

            gap: 8px;

            padding: 9px 13px;

            border-radius: 9px;

            background:
                rgba(255,255,255,.08);

            border:
                1px solid
                rgba(255,255,255,.10);

            font-size: 12px;

            color:
                rgba(255,255,255,.85);
        }


        .feature-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #86efac;
        }


        .brand-footer {
            font-size: 12px;

            color:
                rgba(255,255,255,.55);
        }


        /* =====================================================
           FORM SECTION
        ====================================================== */

        .form-section {
            display: flex;

            align-items: center;

            justify-content: center;

            padding: 45px;

            background:
                rgba(255,255,255,.97);
        }


        .form-container {
            width: 100%;

            max-width: 390px;
        }


        .form-label-top {
            display: inline-block;

            margin-bottom: 12px;

            padding: 6px 10px;

            border-radius: 7px;

            background: #ecfdf5;

            color: #047857;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: 1px;
        }


        .form-title {
            margin: 0;

            color: #111827;

            font-size: 30px;

            font-weight: 800;
        }


        .form-description {
            margin-top: 8px;

            color: #6b7280;

            font-size: 14px;

            line-height: 1.6;
        }


        /* =====================================================
           SESSION STATUS
        ====================================================== */

        .status-box {
            margin-top: 20px;

            padding: 12px 14px;

            border-radius: 9px;

            border:
                1px solid
                #bbf7d0;

            background: #f0fdf4;

            color: #166534;

            font-size: 12px;
        }


        /* =====================================================
           ERROR
        ====================================================== */

        .error-box {
            margin-top: 20px;

            padding: 12px 14px;

            border-radius: 9px;

            border:
                1px solid
                #fecaca;

            background: #fef2f2;

            color: #b91c1c;

            font-size: 12px;
        }


        /* =====================================================
           FORM GROUP
        ====================================================== */

        .form-group {
            margin-top: 22px;
        }


        .form-label {
            display: block;

            margin-bottom: 8px;

            color: #374151;

            font-size: 13px;

            font-weight: 700;
        }


        .input-wrapper {
            position: relative;
        }


        .input-icon {
            position: absolute;

            left: 15px;

            top: 50%;

            transform:
                translateY(-50%);

            color: #9ca3af;

            font-size: 15px;
        }


        .form-input {
            width: 100%;

            height: 48px;

            padding:
                0 15px 0 43px;

            border:
                1px solid
                #e5e7eb;

            border-radius: 10px;

            outline: none;

            background: #f9fafb;

            color: #111827;

            font-size: 13px;

            transition: .2s;
        }


        .form-input:focus {
            border-color: #10b981;

            background: white;

            box-shadow:
                0 0 0 4px
                rgba(16,185,129,.10);
        }


        .form-input::placeholder {
            color: #b0b5bd;
        }


        .field-error {
            margin-top: 5px;

            color: #dc2626;

            font-size: 11px;
        }


        /* =====================================================
           OPTIONS
        ====================================================== */

        .form-options {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-top: 16px;
        }


        .remember {
            display: flex;

            align-items: center;

            gap: 8px;

            color: #6b7280;

            font-size: 12px;

            cursor: pointer;
        }


        .remember input {
            width: 15px;
            height: 15px;

            accent-color: #059669;
        }


        .forgot {
            color: #059669;

            font-size: 12px;

            font-weight: 700;

            text-decoration: none;
        }


        .forgot:hover {
            color: #047857;
        }


        /* =====================================================
           LOGIN BUTTON
        ====================================================== */

        .login-button {
            width: 100%;

            height: 49px;

            margin-top: 25px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #059669,
                    #047857
                );

            color: white;

            font-size: 14px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(5,150,105,.20);

            transition: .2s;
        }


        .login-button:hover {
            transform:
                translateY(-1px);

            box-shadow:
                0 12px 25px
                rgba(5,150,105,.28);
        }


        /* =====================================================
           REGISTER
        ====================================================== */

        .register-section {
            margin-top: 25px;

            padding-top: 22px;

            border-top:
                1px solid
                #f0f0f0;

            text-align: center;
        }


        .register-text {
            color: #9ca3af;

            font-size: 12px;
        }


        .register-link {
            margin-left: 5px;

            color: #059669;

            font-size: 12px;

            font-weight: 800;

            text-decoration: none;
        }


        .register-link:hover {
            color: #047857;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 850px) {

            .login-container {
                grid-template-columns: 1fr;

                max-width: 520px;

                min-height: auto;
            }


            .brand-section {
                min-height: 300px;

                padding: 35px;
            }


            .brand-title {
                font-size: 32px;
            }


            .feature-list {
                display: none;
            }


            .brand-footer {
                margin-top: 35px;
            }


            .form-section {
                padding: 40px 30px;
            }

        }


        @media (max-width: 480px) {

            .login-page {
                padding: 15px;
            }


            .login-container {
                width: 100%;

                border-radius: 18px;
            }


            .brand-section {
                padding: 28px;

                min-height: 260px;
            }


            .brand-title {
                font-size: 28px;
            }


            .form-section {
                padding: 32px 24px;
            }


            .form-title {
                font-size: 26px;
            }

        }

    </style>

</head>


<body>


<div class="login-page">


    {{-- BACKGROUND --}}
    <div class="circle-one"></div>

    <div class="circle-two"></div>

    <div class="circle-three"></div>


    {{-- =========================================================
         MAIN CONTAINER
    ========================================================== --}}
    <div class="login-container">


        {{-- =====================================================
             BRANDING
        ====================================================== --}}
        <div class="brand-section">


            <div>

                {{-- LOGO --}}
                <div class="brand-logo">
                    ST
                </div>


                {{-- BRAND --}}
                <div class="brand-label">
                    SMARTTREN
                </div>


                <div class="brand-title">
                    Sistem Presensi
                    <br>
                    Mahasantri.
                </div>


                <div class="brand-description">
                    Sistem informasi presensi yang membantu
                    pengelolaan kehadiran mahasantri,
                    kegiatan, dan laporan secara mudah,
                    cepat, dan terintegrasi.
                </div>


                {{-- FEATURES --}}
                <div class="feature-list">

                    <div class="feature-item">

                        <span class="feature-dot"></span>

                        Presensi QR

                    </div>


                    <div class="feature-item">

                        <span class="feature-dot"></span>

                        Rekap Kehadiran

                    </div>


                    <div class="feature-item">

                        <span class="feature-dot"></span>

                        Multi Role

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="brand-footer">

                © {{ date('Y') }} SmartTren
                · Sistem Informasi Presensi Mahasantri

            </div>

        </div>



        {{-- =====================================================
             LOGIN FORM
        ====================================================== --}}
        <div class="form-section">


            <div class="form-container">


                {{-- LABEL --}}
                <div class="form-label-top">
                    SMARTTREN
                </div>


                {{-- TITLE --}}
                <h2 class="form-title">
                    Selamat Datang
                </h2>


                <p class="form-description">
                    Masuk ke akun Anda untuk melanjutkan
                    ke sistem SmartTren.
                </p>


                {{-- SESSION STATUS --}}
                @if (session('status'))

                    <div class="status-box">
                        {{ session('status') }}
                    </div>

                @endif


                {{-- ERROR --}}
                @if ($errors->any())

                    <div class="error-box">

                        @foreach ($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif


                {{-- =================================================
                     LOGIN FORM
                ================================================== --}}
                <form
                    method="POST"
                    action="{{ route('login') }}"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div class="form-group">

                        <label
                            for="email"
                            class="form-label"
                        >
                            Email
                        </label>


                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉
                            </span>


                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan email"
                                class="form-input"
                            >

                        </div>


                        @error('email')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- PASSWORD --}}
                    <div class="form-group">

                        <label
                            for="password"
                            class="form-label"
                        >
                            Password
                        </label>


                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>


                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="form-input"
                            >

                        </div>


                        @error('password')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- OPTIONS --}}
                    <div class="form-options">


                        <label
                            for="remember"
                            class="remember"
                        >

                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                            >

                            Ingat saya

                        </label>


                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="forgot"
                            >
                                Lupa Password?
                            </a>

                        @endif


                    </div>



                    {{-- LOGIN --}}
                    <button
                        type="submit"
                        class="login-button"
                    >

                        LOGIN

                        <span style="margin-left: 7px;">
                            →
                        </span>

                    </button>


                </form>



                {{-- =================================================
                     REGISTER
                ================================================== --}}
                @if (Route::has('register'))

                    <div class="register-section">

                        <span class="register-text">
                            Belum punya akun?
                        </span>


                        <a
                            href="{{ route('register') }}"
                            class="register-link"
                        >
                            Daftar sekarang
                        </a>

                    </div>

                @endif


            </div>

        </div>


    </div>

</div>


</body>

</html>