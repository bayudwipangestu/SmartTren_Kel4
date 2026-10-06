<x-app-layout>

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-slot name="header">

        <div>
            <h2 style="
                margin: 0;
                font-size: 22px;
                font-weight: 700;
                color: #1f2937;
            ">
                Dashboard Admin
            </h2>

            <p style="
                margin: 5px 0 0;
                font-size: 14px;
                color: #6b7280;
            ">
                Pusat pengelolaan sistem SmartTren
            </p>
        </div>

    </x-slot>


    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <div style="
        min-height: calc(100vh - 80px);
        background: #f5f8f6;
        padding: 35px 20px 50px;
    ">

        <div style="
            max-width: 1150px;
            margin: 0 auto;
        ">


            {{-- =====================================================
                WELCOME CARD
            ====================================================== --}}
            <div style="
                position: relative;
                overflow: hidden;
                margin-bottom: 30px;
                border-radius: 20px;
                background: linear-gradient(135deg, #047857 0%, #059669 55%, #10b981 100%);
                box-shadow: 0 10px 30px rgba(5, 150, 105, 0.18);
            ">

                {{-- Dekorasi lingkaran --}}
                <div style="
                    position: absolute;
                    width: 260px;
                    height: 260px;
                    right: -100px;
                    top: -120px;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.08);
                "></div>

                <div style="
                    position: absolute;
                    width: 180px;
                    height: 180px;
                    right: 170px;
                    bottom: -130px;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.06);
                "></div>


                <div style="
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 30px;
                    padding: 32px;
                    flex-wrap: wrap;
                ">


                    {{-- =============================================
                        WELCOME TEXT
                    ============================================== --}}
                    <div style="
                        flex: 1;
                        min-width: 300px;
                    ">

                        {{-- Label --}}
                        <div style="
                            display: inline-flex;
                            align-items: center;
                            gap: 7px;
                            padding: 6px 11px;
                            margin-bottom: 14px;
                            border-radius: 8px;
                            background: rgba(255,255,255,0.14);
                            border: 1px solid rgba(255,255,255,0.15);
                            color: #ecfdf5;
                            font-size: 11px;
                            font-weight: 700;
                            letter-spacing: 1px;
                        ">

                            <span style="
                                width: 7px;
                                height: 7px;
                                border-radius: 50%;
                                background: #bbf7d0;
                            "></span>

                            SMARTTREN

                        </div>


                        {{-- Judul --}}
                        <h1 style="
                            margin: 0;
                            color: #ffffff;
                            font-size: 30px;
                            line-height: 1.3;
                            font-weight: 700;
                            letter-spacing: -0.5px;
                        ">
                            Selamat Datang,
                            {{ auth()->user()->name }} 👋
                        </h1>


                        {{-- Deskripsi --}}
                        <p style="
                            max-width: 650px;
                            margin: 10px 0 0;
                            color: rgba(255,255,255,0.86);
                            font-size: 14px;
                            line-height: 1.7;
                        ">
                            Selamat datang di Dashboard Administrator SmartTren.
                            Kelola pengguna, data mahasantri, dan kegiatan
                            dengan mudah dari satu tempat.
                        </p>


                        {{-- Status --}}
                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 9px;
                            margin-top: 20px;
                            color: #ecfdf5;
                            font-size: 13px;
                            font-weight: 500;
                        ">

                            <span style="
                                width: 9px;
                                height: 9px;
                                border-radius: 50%;
                                background: #bbf7d0;
                                box-shadow: 0 0 0 4px rgba(187,247,208,0.13);
                            "></span>

                            Sistem SmartTren aktif

                        </div>

                    </div>


                    {{-- =============================================
                        ROLE CARD
                    ============================================== --}}
                    <div style="
                        width: 240px;
                        flex-shrink: 0;
                        padding: 18px;
                        border-radius: 16px;
                        background: rgba(255,255,255,0.12);
                        border: 1px solid rgba(255,255,255,0.18);
                        backdrop-filter: blur(8px);
                    ">

                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 13px;
                        ">

                            <div style="
                                width: 50px;
                                height: 50px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 13px;
                                background: #ffffff;
                                color: #059669;
                                font-size: 20px;
                                font-weight: 800;
                            ">
                                A
                            </div>


                            <div>

                                <div style="
                                    color: rgba(255,255,255,0.70);
                                    font-size: 10px;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 1px;
                                ">
                                    Role Aktif
                                </div>

                                <div style="
                                    margin-top: 3px;
                                    color: #ffffff;
                                    font-size: 15px;
                                    font-weight: 700;
                                ">
                                    Administrator
                                </div>

                            </div>

                        </div>


                        <div style="
                            height: 1px;
                            margin: 17px 0;
                            background: rgba(255,255,255,0.15);
                        "></div>


                        <div style="
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                        ">

                            <span style="
                                color: rgba(255,255,255,0.70);
                                font-size: 12px;
                            ">
                                Status
                            </span>

                            <span style="
                                padding: 5px 10px;
                                border-radius: 20px;
                                background: rgba(187,247,208,0.16);
                                color: #dcfce7;
                                font-size: 11px;
                                font-weight: 700;
                            ">
                                ● Aktif
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                MENU UTAMA
            ====================================================== --}}
            <div style="
                margin-bottom: 17px;
            ">

                <h2 style="
                    margin: 0;
                    font-size: 21px;
                    font-weight: 700;
                    color: #111827;
                ">
                    Menu Utama
                </h2>

                <p style="
                    margin: 5px 0 0;
                    font-size: 14px;
                    color: #6b7280;
                ">
                    Pilih menu yang ingin Anda kelola.
                </p>

            </div>


            {{-- =====================================================
                MENU CARDS
            ====================================================== --}}
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 18px;
                margin-bottom: 30px;
            ">


                {{-- =================================================
                    MANAGEMENT USER
                ================================================== --}}
                <a
                    href="{{ url('admin/users') }}"
                    style="
                        display: block;
                        text-decoration: none;
                        background: #ffffff;
                        border: 1px solid #e5e7eb;
                        border-radius: 15px;
                        padding: 24px;
                        transition: all .2s ease;
                    "
                    onmouseover="
                        this.style.transform='translateY(-3px)';
                        this.style.borderColor='#bfdbfe';
                        this.style.boxShadow='0 10px 25px rgba(0,0,0,.07)';
                    "
                    onmouseout="
                        this.style.transform='translateY(0)';
                        this.style.borderColor='#e5e7eb';
                        this.style.boxShadow='none';
                    "
                >

                    <div style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                    ">

                        <div style="
                            width: 48px;
                            height: 48px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 12px;
                            background: #eff6ff;
                            font-size: 22px;
                        ">
                            👥
                        </div>

                        <span style="
                            color: #9ca3af;
                            font-size: 20px;
                        ">
                            →
                        </span>

                    </div>


                    <h3 style="
                        margin: 20px 0 0;
                        font-size: 17px;
                        font-weight: 700;
                        color: #111827;
                    ">
                        Management User
                    </h3>


                    <p style="
                        margin: 8px 0 18px;
                        color: #6b7280;
                        font-size: 14px;
                        line-height: 1.6;
                    ">
                        Kelola akun pengguna, role, email,
                        dan hak akses sistem.
                    </p>


                    <span style="
                        color: #2563eb;
                        font-size: 13px;
                        font-weight: 700;
                    ">
                        Kelola Pengguna →
                    </span>

                </a>


                {{-- =================================================
                    DATA MAHASANTRI
                ================================================== --}}
                <a
                    href="{{ url('admin/mahasantri') }}"
                    style="
                        display: block;
                        text-decoration: none;
                        background: #ffffff;
                        border: 1px solid #e5e7eb;
                        border-radius: 15px;
                        padding: 24px;
                        transition: all .2s ease;
                    "
                    onmouseover="
                        this.style.transform='translateY(-3px)';
                        this.style.borderColor='#bbf7d0';
                        this.style.boxShadow='0 10px 25px rgba(0,0,0,.07)';
                    "
                    onmouseout="
                        this.style.transform='translateY(0)';
                        this.style.borderColor='#e5e7eb';
                        this.style.boxShadow='none';
                    "
                >

                    <div style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                    ">

                        <div style="
                            width: 48px;
                            height: 48px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 12px;
                            background: #ecfdf5;
                            font-size: 22px;
                        ">
                            🎓
                        </div>

                        <span style="
                            color: #9ca3af;
                            font-size: 20px;
                        ">
                            →
                        </span>

                    </div>


                    <h3 style="
                        margin: 20px 0 0;
                        font-size: 17px;
                        font-weight: 700;
                        color: #111827;
                    ">
                        Data Mahasantri
                    </h3>


                    <p style="
                        margin: 8px 0 18px;
                        color: #6b7280;
                        font-size: 14px;
                        line-height: 1.6;
                    ">
                        Kelola data mahasantri,
                        identitas, dan QR Code presensi.
                    </p>


                    <span style="
                        color: #16a34a;
                        font-size: 13px;
                        font-weight: 700;
                    ">
                        Kelola Mahasantri →
                    </span>

                </a>


                {{-- =================================================
                    DATA KEGIATAN
                ================================================== --}}
                <a
                    href="{{ url('admin/kegiatan') }}"
                    style="
                        display: block;
                        text-decoration: none;
                        background: #ffffff;
                        border: 1px solid #e5e7eb;
                        border-radius: 15px;
                        padding: 24px;
                        transition: all .2s ease;
                    "
                    onmouseover="
                        this.style.transform='translateY(-3px)';
                        this.style.borderColor='#fed7aa';
                        this.style.boxShadow='0 10px 25px rgba(0,0,0,.07)';
                    "
                    onmouseout="
                        this.style.transform='translateY(0)';
                        this.style.borderColor='#e5e7eb';
                        this.style.boxShadow='none';
                    "
                >

                    <div style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                    ">

                        <div style="
                            width: 48px;
                            height: 48px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 12px;
                            background: #fff7ed;
                            font-size: 22px;
                        ">
                            📚
                        </div>

                        <span style="
                            color: #9ca3af;
                            font-size: 20px;
                        ">
                            →
                        </span>

                    </div>


                    <h3 style="
                        margin: 20px 0 0;
                        font-size: 17px;
                        font-weight: 700;
                        color: #111827;
                    ">
                        Data Kegiatan
                    </h3>


                    <p style="
                        margin: 8px 0 18px;
                        color: #6b7280;
                        font-size: 14px;
                        line-height: 1.6;
                    ">
                        Kelola kegiatan yang digunakan
                        untuk pelaksanaan presensi.
                    </p>


                    <span style="
                        color: #ea580c;
                        font-size: 13px;
                        font-weight: 700;
                    ">
                        Kelola Kegiatan →
                    </span>

                </a>


            </div>


            {{-- =====================================================
                INFORMASI SISTEM
            ====================================================== --}}
            <div style="
                overflow: hidden;
                background: #ffffff;
                border: 1px solid #e5e7eb;
                border-radius: 15px;
            ">

                {{-- Header --}}
                <div style="
                    padding: 20px 24px;
                    border-bottom: 1px solid #f1f5f9;
                ">

                    <h2 style="
                        margin: 0;
                        font-size: 17px;
                        font-weight: 700;
                        color: #111827;
                    ">
                        Informasi Sistem
                    </h2>

                    <p style="
                        margin: 5px 0 0;
                        font-size: 13px;
                        color: #6b7280;
                    ">
                        Pembagian fungsi setiap role dalam SmartTren.
                    </p>

                </div>


                {{-- Role --}}
                <div style="
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                ">


                    {{-- ADMIN --}}
                    <div style="
                        padding: 22px 24px;
                        border-right: 1px solid #f1f5f9;
                    ">

                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            margin-bottom: 10px;
                        ">

                            <div style="
                                width: 35px;
                                height: 35px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 9px;
                                background: #ecfdf5;
                                color: #15803d;
                                font-size: 13px;
                                font-weight: 700;
                            ">
                                A
                            </div>

                            <strong style="
                                font-size: 14px;
                                color: #111827;
                            ">
                                Admin
                            </strong>

                        </div>

                        <p style="
                            margin: 0;
                            color: #6b7280;
                            font-size: 13px;
                            line-height: 1.6;
                        ">
                            Mengelola user, mahasantri,
                            dan kegiatan.
                        </p>

                    </div>


                    {{-- PENGURUS --}}
                    <div style="
                        padding: 22px 24px;
                        border-right: 1px solid #f1f5f9;
                    ">

                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            margin-bottom: 10px;
                        ">

                            <div style="
                                width: 35px;
                                height: 35px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 9px;
                                background: #eff6ff;
                                color: #2563eb;
                                font-size: 13px;
                                font-weight: 700;
                            ">
                                P
                            </div>

                            <strong style="
                                font-size: 14px;
                                color: #111827;
                            ">
                                Pengurus
                            </strong>

                        </div>

                        <p style="
                            margin: 0;
                            color: #6b7280;
                            font-size: 13px;
                            line-height: 1.6;
                        ">
                            Mengelola sesi, scanner,
                            rekap, dan laporan presensi.
                        </p>

                    </div>


                    {{-- MAHASANTRI --}}
                    <div style="
                        padding: 22px 24px;
                    ">

                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            margin-bottom: 10px;
                        ">

                            <div style="
                                width: 35px;
                                height: 35px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 9px;
                                background: #f0fdf4;
                                color: #16a34a;
                                font-size: 13px;
                                font-weight: 700;
                            ">
                                M
                            </div>

                            <strong style="
                                font-size: 14px;
                                color: #111827;
                            ">
                                Mahasantri
                            </strong>

                        </div>

                        <p style="
                            margin: 0;
                            color: #6b7280;
                            font-size: 13px;
                            line-height: 1.6;
                        ">
                            Memiliki QR pribadi untuk
                            digunakan dalam presensi.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                FOOTER
            ====================================================== --}}
            <div style="
                padding: 24px 0 5px;
                text-align: center;
                color: #9ca3af;
                font-size: 12px;
            ">
                SmartTren &bull; Sistem Informasi Presensi Mahasantri
            </div>


        </div>

    </div>

</x-app-layout>