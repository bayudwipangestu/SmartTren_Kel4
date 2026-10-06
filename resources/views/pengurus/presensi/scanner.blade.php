<x-app-layout>

    <style>

        /* =========================================================
           SMARTTREN - SCANNER PRESENSI
        ========================================================= */

        .scanner-page {
            min-height: calc(100vh - 65px);
            background: #f5f7f6;
            padding: 32px 0 50px;
            color: #17211b;
        }

        .scanner-container {
            width: min(1050px, calc(100% - 40px));
            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .scanner-header {
            margin-bottom: 25px;
        }

        .scanner-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 13px;

            color: #168047;
            font-size: 13px;
            font-weight: 750;

            text-decoration: none;

            transition:
                color .2s ease,
                transform .2s ease;
        }

        .scanner-back:hover {
            color: #126c3c;
            transform: translateX(-2px);
        }

        .scanner-back svg {
            width: 17px !important;
            height: 17px !important;

            min-width: 17px !important;
            max-width: 17px !important;

            min-height: 17px !important;
            max-height: 17px !important;

            flex: 0 0 17px !important;

            display: block;
        }

        .scanner-title {
            margin: 0;

            color: #17211b;

            font-size: 29px;
            line-height: 1.2;
            font-weight: 800;

            letter-spacing: -.5px;
        }

        .scanner-subtitle {
            margin: 7px 0 0;

            color: #718078;

            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
           SESSION INFO
        ========================================================= */

        .scanner-session {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;

            margin-top: 15px;
        }

        .scanner-session-item {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 7px 11px;

            border: 1px solid #dce7e0;
            border-radius: 999px;

            background: #ffffff;

            color: #526058;

            font-size: 12px;
            font-weight: 650;
        }

        .scanner-session-item svg {
            width: 15px !important;
            height: 15px !important;

            min-width: 15px !important;
            max-width: 15px !important;

            min-height: 15px !important;
            max-height: 15px !important;

            flex: 0 0 15px !important;

            color: #168047;
        }

        .scanner-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 11px;

            border-radius: 999px;

            background: #e9f8ef;
            color: #168047;

            font-size: 12px;
            font-weight: 800;
        }

        .scanner-status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #22a55a;
        }


        /* =========================================================
           MAIN GRID
        ========================================================= */

        .scanner-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1.1fr)
                minmax(0, .9fr);

            gap: 20px;

            align-items: stretch;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .scanner-card {
            overflow: hidden;

            border: 1px solid #e2e9e5;
            border-radius: 20px;

            background: #ffffff;

            box-shadow:
                0 8px 30px rgba(23, 33, 27, .055);
        }

        .scanner-card-header {
            padding: 20px 22px;

            border-bottom: 1px solid #edf1ee;
        }

        .scanner-card-title {
            margin: 0;

            color: #1a251e;

            font-size: 17px;
            font-weight: 800;
        }

        .scanner-card-description {
            margin: 5px 0 0;

            color: #7a867f;

            font-size: 12px;
            line-height: 1.6;
        }


        /* =========================================================
           CAMERA
        ========================================================= */

        .scanner-camera-area {
            padding: 20px;
        }

        .scanner-camera {
            position: relative;

            width: 100%;
            max-width: 520px;

            margin: 0 auto;

            overflow: hidden;

            border-radius: 16px;

            background: #111816;

            min-height: 360px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*
         * Html5-qrcode membuat elemen internal sendiri.
         * Kita batasi agar tidak merusak layout.
         */

        #reader {
            width: 100% !important;
            max-width: 520px !important;

            margin: 0 auto;

            border: 0 !important;

            color: #ffffff;
        }

        #reader > div:first-child {
            width: 100% !important;
        }

        #reader video {
            width: 100% !important;
            height: auto !important;

            min-height: 340px;

            object-fit: cover;

            border-radius: 16px;
        }

        #reader img {
            max-width: 100% !important;
        }

        #reader__dashboard {
            padding: 12px !important;

            background: #ffffff !important;
        }

        #reader__dashboard_section_csr {
            margin: 0 auto !important;
        }

        #reader button {
            border: 0 !important;
            border-radius: 9px !important;

            padding: 8px 13px !important;

            background: #168047 !important;
            color: #ffffff !important;

            font-size: 12px !important;
            font-weight: 700 !important;

            cursor: pointer;
        }

        #reader select {
            max-width: 100% !important;

            border: 1px solid #d8e0db !important;
            border-radius: 8px !important;

            padding: 7px 9px !important;

            font-size: 12px !important;
        }


        /* =========================================================
           CAMERA GUIDE
        ========================================================= */

        .scanner-guide {
            margin-top: 15px;

            padding: 12px 14px;

            border-radius: 11px;

            background: #effaf3;

            color: #397052;

            font-size: 12px;
            line-height: 1.6;

            text-align: center;
        }

        .scanner-guide strong {
            color: #126c3c;
        }


        /* =========================================================
           MESSAGE
        ========================================================= */

        #message {
            margin: 0 20px 20px;

            border-radius: 11px;

            padding: 12px 14px;

            font-size: 12px;
            line-height: 1.5;
            font-weight: 700;
        }

        .message-success {
            border: 1px solid #bde7cc;

            background: #effaf3;

            color: #126c3c;
        }

        .message-error {
            border: 1px solid #fecaca;

            background: #fff5f5;

            color: #b42318;
        }


        /* =========================================================
           RESULT
        ========================================================= */

        .result-area {
            min-height: 420px;

            padding: 22px;
        }

        .result-empty {
            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            min-height: 350px;

            text-align: center;
        }

        .result-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 64px;
            height: 64px;

            margin-bottom: 17px;

            border-radius: 18px;

            background: #eaf8ef;
            color: #168047;
        }

        .result-empty-icon svg {
            width: 29px !important;
            height: 29px !important;

            min-width: 29px !important;
            max-width: 29px !important;

            min-height: 29px !important;
            max-height: 29px !important;

            flex: 0 0 29px !important;

            display: block;
        }

        .result-empty-title {
            margin: 0;

            color: #202b24;

            font-size: 17px;
            font-weight: 800;
        }

        .result-empty-text {
            max-width: 320px;

            margin: 7px auto 0;

            color: #7a867f;

            font-size: 12px;
            line-height: 1.65;
        }


        /* =========================================================
           SUCCESS RESULT
        ========================================================= */

        .result-success {
            border: 1px solid #bde7cc;

            border-radius: 15px;

            background: #effaf3;

            padding: 20px;
        }

        .result-success-header {
            display: flex;
            align-items: center;
            gap: 12px;

            margin-bottom: 18px;
        }

        .result-success-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 43px;
            height: 43px;
            flex: 0 0 43px;

            border-radius: 12px;

            background: #168047;
            color: #ffffff;
        }

        .result-success-icon svg {
            width: 22px !important;
            height: 22px !important;

            min-width: 22px !important;
            max-width: 22px !important;

            min-height: 22px !important;
            max-height: 22px !important;

            flex: 0 0 22px !important;
        }

        .result-success-title {
            margin: 0;

            color: #126c3c;

            font-size: 16px;
            font-weight: 800;
        }

        .result-success-subtitle {
            margin: 3px 0 0;

            color: #4e765f;

            font-size: 11px;
        }

        .result-data {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 10px;
        }

        .result-data-item {
            padding: 12px;

            border: 1px solid #d8efdf;
            border-radius: 10px;

            background: rgba(255,255,255,.75);
        }

        .result-data-label {
            margin: 0 0 4px;

            color: #7a9282;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .result-data-value {
            margin: 0;

            color: #1e3b29;

            font-size: 12px;
            font-weight: 800;

            word-break: break-word;
        }

        .result-full {
            grid-column: 1 / -1;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 850px) {

            .scanner-grid {
                grid-template-columns: 1fr;
            }

            .result-area {
                min-height: auto;
            }

            .result-empty {
                min-height: 280px;
            }

        }


        @media (max-width: 640px) {

            .scanner-page {
                padding: 22px 0 40px;
            }

            .scanner-container {
                width: calc(100% - 24px);
            }

            .scanner-title {
                font-size: 24px;
            }

            .scanner-session {
                align-items: flex-start;
                flex-direction: column;
            }

            .scanner-session-item,
            .scanner-status {
                width: 100%;
                justify-content: flex-start;
            }

            .scanner-card {
                border-radius: 16px;
            }

            .scanner-card-header {
                padding: 18px;
            }

            .scanner-camera-area {
                padding: 14px;
            }

            .scanner-camera {
                min-height: 300px;
            }

            #reader video {
                min-height: 280px;
            }

            .result-area {
                padding: 18px;
            }

            .result-data {
                grid-template-columns: 1fr;
            }

            .result-full {
                grid-column: auto;
            }

        }

    </style>


    {{-- =========================================================
       HEADER BREEZE
    ========================================================= --}}

    <x-slot name="header">

        <div>

            <h2 class="text-xl font-bold text-gray-800">
                Scan Presensi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Scan QR Card Mahasantri untuk mencatat kehadiran.
            </p>

        </div>

    </x-slot>


    {{-- =========================================================
       CONTENT
    ========================================================= --}}

    <div class="scanner-page">

        <div class="scanner-container">


            {{-- =================================================
               PAGE HEADER
            ================================================= --}}

            <div class="scanner-header">


                {{-- KEMBALI KE SESI PRESENSI --}}

                <a
                    href="{{ route('pengurus.sesi-presensi.index') }}"
                    class="scanner-back"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >

                        <path d="M19 12H5"></path>

                        <path d="M12 19l-7-7 7-7"></path>

                    </svg>

                    Kembali ke Sesi Presensi

                </a>


                <h1 class="scanner-title">
                    Scan Presensi
                </h1>


                <p class="scanner-subtitle">
                    Arahkan kamera ke QR Card Mahasantri
                    untuk mencatat kehadiran.
                </p>


                {{-- INFORMASI SESI --}}

                <div class="scanner-session">


                    {{-- KEGIATAN --}}

                    <div class="scanner-session-item">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="4"
                                y="4"
                                width="16"
                                height="16"
                                rx="2"
                            ></rect>

                            <path d="M8 9h8"></path>

                            <path d="M8 13h5"></path>

                        </svg>


                        {{ $sesiPresensi->kegiatan->nama_kegiatan }}

                    </div>


                    {{-- TANGGAL --}}

                    <div class="scanner-session-item">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="17"
                                rx="2"
                            ></rect>

                            <path d="M16 2v4"></path>

                            <path d="M8 2v4"></path>

                            <path d="M3 10h18"></path>

                        </svg>


                        {{ $sesiPresensi->tanggal->format('d-m-Y') }}

                    </div>


                    {{-- JAM --}}

                    <div class="scanner-session-item">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <path d="M12 7v5l3 2"></path>

                        </svg>


                        {{ substr($sesiPresensi->jam_mulai, 0, 5) }}

                        -

                        {{ substr($sesiPresensi->jam_selesai, 0, 5) }}

                    </div>


                    {{-- STATUS --}}

                    <div class="scanner-status">

                        <span class="scanner-status-dot"></span>

                        {{ ucfirst($sesiPresensi->status) }}

                    </div>

                </div>

            </div>



            {{-- =================================================
               MAIN GRID
            ================================================= --}}

            <div class="scanner-grid">


                {{-- =================================================
                   SCANNER CARD
                ================================================= --}}

                <div class="scanner-card">


                    <div class="scanner-card-header">

                        <h2 class="scanner-card-title">
                            Scanner QR
                        </h2>

                        <p class="scanner-card-description">
                            Gunakan kamera untuk membaca QR Card
                            Mahasantri.
                        </p>

                    </div>


                    <div class="scanner-camera-area">


                        <div
                            id="reader"
                            class="scanner-camera"
                        >
                        </div>


                        <div class="scanner-guide">

                            <strong>
                                Cara menggunakan:
                            </strong>

                            Arahkan QR Card Mahasantri
                            ke dalam area kamera sampai
                            kode berhasil terbaca.

                        </div>

                    </div>


                    {{-- PESAN --}}

                    <div
                        id="message"
                        class="hidden"
                    >
                    </div>


                </div>



                {{-- =================================================
                   HASIL PRESENSI
                ================================================= --}}

                <div class="scanner-card">


                    <div class="scanner-card-header">

                        <h2 class="scanner-card-title">
                            Hasil Presensi
                        </h2>

                        <p class="scanner-card-description">
                            Data Mahasantri yang berhasil melakukan
                            presensi akan tampil di sini.
                        </p>

                    </div>


                    <div
                        id="result"
                        class="result-area"
                    >

                        {{-- EMPTY STATE --}}

                        <div class="result-empty">

                            <div class="result-empty-icon">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >

                                    <rect
                                        x="4"
                                        y="4"
                                        width="16"
                                        height="16"
                                        rx="2"
                                    ></rect>

                                    <path d="M8 9h8"></path>

                                    <path d="M8 13h5"></path>

                                    <path d="M8 17h3"></path>

                                </svg>

                            </div>


                            <h3 class="result-empty-title">
                                Belum Ada Presensi
                            </h3>


                            <p class="result-empty-text">

                                Silakan scan QR Card Mahasantri.
                                Setelah berhasil, informasi
                                kehadiran akan muncul di sini.

                            </p>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>



    {{-- =========================================================
       HTML5 QR CODE
    ========================================================= --}}

    <script
        src="https://unpkg.com/html5-qrcode"
        type="text/javascript"
    ></script>


    <script>

        const scanUrl =
            "{{ route(
                'pengurus.presensi.scan',
                $sesiPresensi
            ) }}";

        const csrfToken =
            "{{ csrf_token() }}";


        let processing = false;


        /* =========================================================
           PESAN
        ========================================================= */

        function showMessage(
            message,
            success = true
        ) {

            const element =
                document.getElementById('message');


            element.textContent =
                message;


            element.className =
                success
                    ? 'message-success'
                    : 'message-error';

        }


        /* =========================================================
           HASIL PRESENSI
        ========================================================= */

        function showResult(data) {

            const result =
                document.getElementById('result');


            result.innerHTML = `

                <div class="result-success">

                    <div class="result-success-header">

                        <div class="result-success-icon">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path
                                    d="M9 12l2 2 4-4"
                                ></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                ></circle>

                            </svg>

                        </div>


                        <div>

                            <h3 class="result-success-title">
                                Presensi Berhasil
                            </h3>

                            <p class="result-success-subtitle">
                                Data Mahasantri berhasil dicatat.
                            </p>

                        </div>

                    </div>


                    <div class="result-data">


                        <div class="result-data-item result-full">

                            <p class="result-data-label">
                                Nama Mahasantri
                            </p>

                            <p class="result-data-value">
                                ${escapeHtml(data.data.nama)}
                            </p>

                        </div>


                        <div class="result-data-item">

                            <p class="result-data-label">
                                NIM
                            </p>

                            <p class="result-data-value">
                                ${escapeHtml(data.data.nim)}
                            </p>

                        </div>


                        <div class="result-data-item">

                            <p class="result-data-label">
                                Status
                            </p>

                            <p class="result-data-value">
                                ${escapeHtml(data.data.status)}
                            </p>

                        </div>


                        <div class="result-data-item result-full">

                            <p class="result-data-label">
                                Waktu Presensi
                            </p>

                            <p class="result-data-value">
                                ${escapeHtml(data.data.waktu)}
                            </p>

                        </div>


                    </div>

                </div>

            `;

        }


        /* =========================================================
           ESCAPE HTML
        ========================================================= */

        function escapeHtml(value) {

            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');

        }


        /* =========================================================
           HANDLE SCAN
        ========================================================= */

        async function handleScan(
            decodedText
        ) {

            if (processing) {
                return;
            }


            processing = true;


            try {

                const response =
                    await fetch(
                        scanUrl,
                        {
                            method: 'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken

                            },

                            body: JSON.stringify({
                                qr_code: decodedText
                            })

                        }
                    );


                const data =
                    await response.json();


                if (
                    !response.ok ||
                    !data.success
                ) {

                    showMessage(
                        data.message ??
                        'Presensi gagal.',
                        false
                    );


                    processing = false;


                    return;

                }


                /* =============================================
                   BERHASIL
                ============================================= */

                showMessage(
                    data.message ??
                    'Presensi berhasil.',
                    true
                );


                showResult(data);


            } catch (error) {

                console.error(error);


                showMessage(
                    'Terjadi kesalahan saat mengirim data.',
                    false
                );

            }


            /*
             * Beri jeda supaya kamera tidak langsung
             * membaca QR yang sama berkali-kali.
             */

            setTimeout(
                () => {
                    processing = false;
                },
                1500
            );

        }


        /* =========================================================
           START SCANNER
        ========================================================= */

        const scanner =
            new Html5Qrcode('reader');


        scanner.start(

            {
                facingMode: 'environment'
            },

            {

                fps: 10,

                qrbox: function(
                    viewfinderWidth,
                    viewfinderHeight
                ) {

                    const size =
                        Math.min(
                            viewfinderWidth,
                            viewfinderHeight,
                            250
                        );

                    return {
                        width: size,
                        height: size
                    };

                },

                aspectRatio: 1.0

            },

            handleScan,

            function(errorMessage) {

                /*
                 * Error pembacaan frame diabaikan.
                 * Kamera tetap berjalan.
                 */

            }

        ).catch(
            function(error) {

                console.error(error);


                showMessage(
                    'Kamera tidak dapat digunakan. Pastikan izin kamera diberikan.',
                    false
                );

            }
        );

    </script>

</x-app-layout>