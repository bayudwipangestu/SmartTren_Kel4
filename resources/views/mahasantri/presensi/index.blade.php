
<x-app-layout>
    <div class="st-presensi">
        <style>
            .st-presensi,
            .st-presensi * {
                box-sizing: border-box;
            }

            .st-presensi {
                width: 100%;
                max-width: 1600px;
                margin: 0 auto;
                padding: 28px 30px 40px;
                color: #17372b;
                font-family: Figtree, sans-serif;
            }

            .st-presensi a {
                text-decoration: none;
            }

            .st-presensi-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                margin-bottom: 24px;
            }

            .st-breadcrumb {
                display: flex;
                flex-wrap: wrap;
                gap: 9px;
                margin-bottom: 9px;
                color: #89988f;
                font-size: 12px;
            }

            .st-breadcrumb span:last-child {
                color: #078451;
                font-weight: 700;
            }

            .st-page-title {
                margin: 0;
                color: #17372b;
                font-size: 27px;
                font-weight: 800;
                letter-spacing: -.6px;
            }

            .st-page-subtitle {
                margin: 7px 0 0;
                color: #819087;
                font-size: 13px;
                line-height: 1.7;
            }

            .st-online {
                display: inline-flex;
                flex-shrink: 0;
                align-items: center;
                gap: 9px;
                padding: 11px 15px;
                border: 1px solid #e1eee6;
                border-radius: 30px;
                background: white;
                color: #536b5d;
                font-size: 12px;
            }

            .st-online-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #10b981;
            }

            .st-presensi-hero {
                position: relative;
                display: flex;
                align-items: center;
                gap: 20px;
                overflow: hidden;
                margin-bottom: 22px;
                padding: 27px 30px;
                border-radius: 17px;
                background: linear-gradient(115deg, #104d3c, #07845b);
                color: white;
            }

            .st-presensi-hero::after {
                position: absolute;
                top: -115px;
                right: 16%;
                width: 280px;
                height: 280px;
                border: 30px solid #ffffff0b;
                border-radius: 50%;
                content: "";
                pointer-events: none;
            }

            .st-hero-icon {
                display: grid;
                flex: 0 0 62px;
                width: 62px;
                height: 62px;
                place-items: center;
                border: 1px solid #ffffff35;
                border-radius: 15px;
                background: #ffffff15;
                color: white;
                font-size: 28px;
            }

            .st-hero-copy {
                position: relative;
                z-index: 1;
                min-width: 0;
            }

            .st-hero-eyebrow {
                margin-bottom: 7px;
                color: #a6f4cf;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 1.8px;
            }

            .st-hero-copy h2 {
                margin: 0;
                color: white;
                font-size: 23px;
                font-weight: 800;
                line-height: 1.4;
            }

            .st-hero-copy p {
                margin: 7px 0 0;
                color: #e0f5e9;
                font-size: 12px;
                line-height: 1.8;
            }

            .st-presensi-grid {
                display: grid;
                grid-template-columns: minmax(280px, 370px) minmax(0, 1fr);
                align-items: start;
                gap: 20px;
            }

            .st-left-column {
                display: grid;
                min-width: 0;
                gap: 18px;
            }

            .st-card {
                min-width: 0;
                padding: 23px;
                border: 1px solid #e7eee9;
                border-radius: 16px;
                background: #fff;
                box-shadow: 0 5px 20px #17372b08;
            }

            .st-card-heading {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 18px;
            }

            .st-heading-icon {
                display: grid;
                flex: 0 0 42px;
                width: 42px;
                height: 42px;
                place-items: center;
                border-radius: 12px;
                background: #e5f8ed;
                color: #078451;
                font-size: 20px;
            }

            .st-card-heading h2 {
                margin: 0;
                color: #17372b;
                font-size: 16px;
                font-weight: 800;
            }

            .st-card-heading p {
                margin: 5px 0 0;
                color: #89988f;
                font-size: 11px;
                line-height: 1.6;
            }

            .st-qr-card {
                text-align: center;
            }

            /* QR disembunyikan pada halaman utama agar kartu lebih ringkas.
               SVG tetap ada di DOM untuk fitur unduh dan modal Tampilkan QR. */
            .st-qr-card .st-qr-frame,
            .st-qr-card .st-qr-code {
                display: none;
            }

            .st-qr-card .st-qr-actions {
                margin-top: 8px;
            }

            .st-qr-card .st-qr-note {
                margin-top: 10px;
            }

            .st-qr-frame {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 250px;
                margin: 5px 0 16px;
                padding: 18px;
                border: 1px solid #edf3ef;
                border-radius: 14px;
                background: #f7faf8;
            }

            .st-qr-frame svg,
            .st-qr-frame img,
            .st-qr-frame canvas {
                display: block;
                width: 100%;
                max-width: 250px;
                height: auto;
                background: white;
            }

            .st-qr-code {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                min-height: 44px;
                padding: 10px 12px;
                border: 1px solid #d8f3e3;
                border-radius: 9px;
                background: #e5faee;
                color: #087747;
                font-size: 13px;
                font-weight: 800;
                overflow-wrap: anywhere;
            }

            .st-qr-note {
                margin: 12px 0 0;
                color: #849188;
                font-size: 11px;
                line-height: 1.8;
            }

            .st-qr-actions {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
                margin-top: 14px;
            }

            .st-qr-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                min-height: 42px;
                padding: 10px 12px;
                border: 1px solid #cfe9d9;
                border-radius: 10px;
                background: #078451;
                color: #fff !important;
                font: inherit;
                font-size: 12px;
                font-weight: 800;
                cursor: pointer;
                transition: background .2s, transform .2s;
            }

            .st-qr-button:hover {
                background: #066b43;
                transform: translateY(-1px);
            }

            .st-qr-button.st-qr-button-secondary {
                background: #fff;
                color: #087747 !important;
            }

            .st-qr-button.st-qr-button-secondary:hover {
                background: #effaf3;
            }

            .st-qr-modal[hidden] { display: none !important; }

            .st-qr-modal {
                position: fixed;
                z-index: 9999;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                background: rgba(10, 35, 25, .72);
            }

            .st-qr-modal-panel {
                position: relative;
                width: min(100%, 430px);
                padding: 28px 24px;
                border-radius: 20px;
                background: #fff;
                text-align: center;
                box-shadow: 0 24px 80px #0003;
            }

            .st-qr-modal-close {
                position: absolute;
                top: 10px;
                right: 12px;
                width: 38px;
                height: 38px;
                border: 0;
                border-radius: 50%;
                background: #edf6f0;
                color: #174b35;
                font-size: 24px;
                cursor: pointer;
            }

            .st-qr-modal-panel h2 {
                margin: 5px 35px 8px;
                color: #17372b;
                font-size: 20px;
                font-weight: 800;
            }

            .st-qr-modal-panel p {
                margin: 0 0 18px;
                color: #718277;
                font-size: 12px;
                line-height: 1.6;
            }

            .st-qr-modal-image {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 280px;
                padding: 16px;
                border: 1px solid #e6efe9;
                border-radius: 14px;
                background: #f8fbf9;
            }

            .st-qr-modal-image svg {
                display: block;
                width: 100%;
                max-width: 300px;
                height: auto;
                background: white;
            }

            .st-qr-modal-code {
                margin-top: 14px;
                color: #087747;
                font-size: 12px;
                font-weight: 800;
                overflow-wrap: anywhere;
            }

            @media (max-width: 420px) {
                .st-qr-actions { grid-template-columns: 1fr; }
                .st-qr-modal-panel { padding: 24px 16px; }
            }

            .st-security-note {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-top: 15px;
                padding: 12px;
                border-radius: 10px;
                background: #f0f6ff;
                color: #456486;
                font-size: 11px;
                line-height: 1.7;
                text-align: left;
            }

            .st-security-note strong {
                color: #315579;
            }

            .st-info-item {
                margin-top: 10px;
                padding: 13px 14px;
                border: 1px solid #edf1ee;
                border-radius: 10px;
                background: #fafcfb;
            }

            .st-info-label {
                display: block;
                margin-bottom: 5px;
                color: #849188;
                font-size: 11px;
            }

            .st-info-value {
                display: block;
                color: #254636;
                font-size: 12px;
                font-weight: 700;
                overflow-wrap: anywhere;
            }

            .st-schedule-card {
                padding: 23px;
            }

            .st-schedule-heading {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 19px;
            }

            .st-schedule-title {
                display: flex;
                align-items: center;
                gap: 11px;
            }

            .st-schedule-title h2 {
                margin: 0;
                color: #17372b;
                font-size: 17px;
                font-weight: 800;
            }

            .st-today {
                color: #839188;
                font-size: 11px;
                text-align: right;
            }

            .st-session {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 14px;
                margin-top: 11px;
                padding: 17px;
                border: 1px solid #e7eee9;
                border-radius: 12px;
                background: white;
                transition: border-color .2s, box-shadow .2s;
            }

            .st-session:hover {
                border-color: #b9e6cd;
                box-shadow: 0 4px 14px #0784510b;
            }

            .st-session-main {
                display: flex;
                min-width: 0;
                align-items: flex-start;
                gap: 12px;
            }

            .st-session-icon {
                display: grid;
                flex: 0 0 40px;
                width: 40px;
                height: 40px;
                place-items: center;
                border-radius: 12px;
                background: #e5f8ed;
                color: #078451;
                font-size: 18px;
            }

            .st-session-info {
                min-width: 0;
            }

            .st-session h3 {
                margin: 1px 0 10px;
                color: #203b2e;
                font-size: 14px;
                font-weight: 800;
                overflow-wrap: anywhere;
            }

            .st-session-detail {
                display: flex;
                flex-wrap: wrap;
                gap: 8px 15px;
                color: #7a8a80;
                font-size: 11px;
                line-height: 1.6;
            }

            .st-status {
                display: inline-flex;
                flex-shrink: 0;
                align-items: center;
                gap: 6px;
                margin-top: 2px;
                padding: 7px 10px;
                border-radius: 30px;
                background: #e1f9eb;
                color: #087747;
                font-size: 9px;
                font-weight: 800;
                white-space: nowrap;
            }

            .st-status-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: #079b68;
            }

            .st-schedule-footer {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-top: 16px;
                padding: 13px;
                border-radius: 10px;
                background: #f0f8f3;
                color: #60766a;
                font-size: 11px;
                line-height: 1.7;
            }

            .st-empty {
                padding: 38px 20px;
                border: 1px dashed #dbe8df;
                border-radius: 12px;
                background: #fafcfb;
                text-align: center;
            }

            .st-empty-icon {
                margin-bottom: 12px;
                color: #8aa697;
                font-size: 30px;
            }

            .st-empty h3 {
                margin: 0;
                color: #345643;
                font-size: 15px;
                font-weight: 800;
            }

            .st-empty p {
                margin: 8px 0 0;
                color: #8a9990;
                font-size: 12px;
                line-height: 1.8;
            }

            @media (max-width: 1100px) {
                .st-presensi {
                    padding: 23px 20px 32px;
                }

                .st-presensi-grid {
                    grid-template-columns: minmax(250px, 320px) minmax(0, 1fr);
                    gap: 15px;
                }

                .st-card,
                .st-schedule-card {
                    padding: 18px;
                }

                .st-session {
                    flex-direction: column;
                }

                .st-status {
                    margin-left: 52px;
                }
            }

            @media (max-width: 760px) {
                .st-presensi {
                    padding: 19px 14px 28px;
                }

                .st-presensi-header {
                    align-items: flex-start;
                    margin-bottom: 18px;
                }

                .st-page-title {
                    font-size: 23px;
                }

                .st-page-subtitle {
                    font-size: 12px;
                }

                .st-online {
                    padding: 8px 10px;
                    font-size: 10px;
                }

                .st-presensi-hero {
                    gap: 13px;
                    margin-bottom: 16px;
                    padding: 21px 18px;
                    border-radius: 14px;
                }

                .st-hero-icon {
                    flex-basis: 45px;
                    width: 45px;
                    height: 45px;
                    border-radius: 11px;
                    font-size: 21px;
                }

                .st-hero-copy h2 {
                    font-size: 18px;
                }

                .st-hero-copy p {
                    font-size: 11px;
                }

                .st-presensi-grid {
                    grid-template-columns: minmax(0, 1fr);
                    gap: 15px;
                }

                .st-left-column {
                    gap: 15px;
                }

                .st-qr-frame {
                    min-height: 220px;
                }

                .st-qr-frame svg,
                .st-qr-frame img,
                .st-qr-frame canvas {
                    max-width: 230px;
                }

                .st-session {
                    flex-direction: row;
                    padding: 14px 12px;
                }

                .st-session-main {
                    gap: 9px;
                }

                .st-session-icon {
                    flex-basis: 34px;
                    width: 34px;
                    height: 34px;
                    font-size: 15px;
                }

                .st-session h3 {
                    font-size: 13px;
                }

                .st-session-detail {
                    display: grid;
                    gap: 5px;
                }

                .st-status {
                    margin: 0;
                    font-size: 8px;
                }
            }

            @media (max-width: 420px) {
                .st-online {
                    gap: 6px;
                    padding: 8px;
                }

                .st-online-text {
                    display: none;
                }

                .st-breadcrumb {
                    font-size: 10px;
                }

                .st-presensi-hero {
                    align-items: flex-start;
                }

                .st-hero-icon {
                    display: none;
                }

                .st-schedule-heading {
                    align-items: flex-start;
                }

                .st-today {
                    max-width: 100px;
                    line-height: 1.6;
                }

                .st-session {
                    flex-direction: column;
                }

                .st-status {
                    margin-left: 43px;
                }
            }
        </style>

        @php
            $namaMahasantri = $mahasantri->user->name ?? 'Mahasantri';
            $emailMahasantri = $mahasantri->user->email ?? '-';
            $nimMahasantri = $mahasantri->nim ?? '-';
        @endphp



        {{-- BANNER --}}
        <section class="st-presensi-hero">
            <div class="st-hero-icon" aria-hidden="true">▦</div>

            <div class="st-hero-copy">
                <div class="st-hero-eyebrow">PRESENSI MAHASANTRI</div>
                <h2>Tunjukkan QR Code Anda</h2>
                <p>
                    Siapkan QR pribadi dan tunjukkan kepada Pengurus
                    untuk mencatat kehadiran pada kegiatan.
                </p>
            </div>
        </section>

        <div class="st-presensi-grid">
            {{-- KOLOM KIRI --}}
            <div class="st-left-column">
                <section class="st-card st-qr-card">
                    <div class="st-card-heading">
                        <div class="st-heading-icon" aria-hidden="true">▦</div>
                        <div>
                            <h2>QR Code Presensi</h2>
                            <p>QR unik untuk identitas presensi kamu.</p>
                        </div>
                    </div>

                    @if (!empty($mahasantri->qr_code))
                        <div class="st-qr-frame">
                            {!! QrCode::size(250)
                                ->margin(2)
                                ->generate($mahasantri->qr_code) !!}
                        </div>

                        <div class="st-qr-code">
                            {{ $mahasantri->qr_code }}
                        </div>

                        <div class="st-qr-actions">
                            <button type="button" class="st-qr-button" id="stDownloadQr">
                                <span aria-hidden="true"></span> Unduh QR Code
                            </button>
                            <button type="button" class="st-qr-button st-qr-button-secondary" id="stShowQr">
                                <span aria-hidden="true"></span> Tampilkan QR 
                            </button>
                        </div>

                        <p class="st-qr-note">
                            Tunjukkan kode ini kepada Pengurus saat presensi.
                            Jangan membagikannya kepada orang lain.
                        </p>

                        <div class="st-security-note">
                            <span aria-hidden="true">ⓘ</span>
                            <div>
                                <strong>Jaga keamanan QR kamu.</strong><br>
                                QR ini adalah identitas untuk proses presensi,
                                bukan tanda bahwa kehadiran sudah tercatat.
                            </div>
                        </div>
                    @else
                        <div class="st-empty">
                            <div class="st-empty-icon">▦</div>
                            <h3>QR Code belum tersedia</h3>
                            <p>
                                Hubungi Admin untuk memastikan QR Code
                                akun Mahasantri sudah dibuat.
                            </p>
                        </div>
                    @endif
                </section>

                @if (!empty($mahasantri->qr_code))
                    <div class="st-qr-modal" id="stQrModal" hidden role="dialog" aria-modal="true" aria-labelledby="stQrModalTitle">
                        <div class="st-qr-modal-panel">
                            <button type="button" class="st-qr-modal-close" id="stCloseQr" aria-label="Tutup QR Code">×</button>
                            <h2 id="stQrModalTitle">QR Code Presensi Kamu</h2>
                            <p>Tunjukkan QR ini kepada Pengurus untuk dipindai saat kegiatan.</p>
                            <div class="st-qr-modal-image" id="stQrModalImage"></div>
                            <div class="st-qr-modal-code">{{ $mahasantri->qr_code }}</div>
                            <div class="st-qr-actions">
                                <button type="button" class="st-qr-button" id="stDownloadQrModal">Unduh QR Code</button>
                                <button type="button" class="st-qr-button st-qr-button-secondary" id="stCloseQrBottom">Tutup</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        (() => {
                            const root = document.querySelector('.st-presensi');
                            if (!root || root.dataset.qrActionsReady === '1') return;
                            root.dataset.qrActionsReady = '1';

                            const originalQr = root.querySelector('.st-qr-frame svg');
                            const modal = root.querySelector('#stQrModal');
                            const modalImage = root.querySelector('#stQrModalImage');
                            const downloadButton = root.querySelector('#stDownloadQr');
                            const showButton = root.querySelector('#stShowQr');
                            const closeButton = root.querySelector('#stCloseQr');
                            const closeBottomButton = root.querySelector('#stCloseQrBottom');
                            const modalDownloadButton = root.querySelector('#stDownloadQrModal');

                            function downloadQr() {
                                if (!originalQr) {
                                    alert('QR Code belum dapat dimuat. Silakan muat ulang halaman.');
                                    return;
                                }
                                const svg = originalQr.cloneNode(true);
                                svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                                svg.setAttribute('width', '1000');
                                svg.setAttribute('height', '1000');
                                if (!svg.getAttribute('viewBox')) {
                                    const width = originalQr.getAttribute('width') || '250';
                                    const height = originalQr.getAttribute('height') || '250';
                                    svg.setAttribute('viewBox', `0 0 ${parseFloat(width)} ${parseFloat(height)}`);
                                }
                                const source = new XMLSerializer().serializeToString(svg);
                                const blob = new Blob([source], { type: 'image/svg+xml;charset=utf-8' });
                                const url = URL.createObjectURL(blob);
                                const link = document.createElement('a');
                                link.href = url;
                                link.download = 'qr-presensi-{{ preg_replace('/[^A-Za-z0-9_-]/', '-', (string) ($mahasantri->nim ?? $mahasantri->id)) }}.svg';
                                document.body.appendChild(link);
                                link.click();
                                link.remove();
                                URL.revokeObjectURL(url);
                            }

                            function openQr() {
                                if (!originalQr || !modal || !modalImage) return;
                                modalImage.replaceChildren(originalQr.cloneNode(true));
                                modal.hidden = false;
                                document.body.style.overflow = 'hidden';
                                if (closeButton) closeButton.focus();
                            }

                            function closeQr() {
                                if (modal) modal.hidden = true;
                                document.body.style.overflow = '';
                                if (showButton) showButton.focus();
                            }

                            if (downloadButton) downloadButton.addEventListener('click', downloadQr);
                            if (modalDownloadButton) modalDownloadButton.addEventListener('click', downloadQr);
                            if (showButton) showButton.addEventListener('click', openQr);
                            if (closeButton) closeButton.addEventListener('click', closeQr);
                            if (closeBottomButton) closeBottomButton.addEventListener('click', closeQr);
                            if (modal) {
                                modal.addEventListener('click', event => {
                                    if (event.target === modal) closeQr();
                                });
                                document.addEventListener('keydown', event => {
                                    if (event.key === 'Escape' && !modal.hidden) closeQr();
                                });
                            }
                        })();
                    </script>
                @endif

                {{-- DATA MAHASANTRI --}}
                <section class="st-card">
                    <div class="st-card-heading">
                        <div class="st-heading-icon" aria-hidden="true">♙</div>
                        <div>
                            <h2>Data Mahasantri</h2>
                            <p>Informasi akun yang terdaftar.</p>
                        </div>
                    </div>

                    <div class="st-info-item">
                        <span class="st-info-label">Nama lengkap</span>
                        <span class="st-info-value">{{ $namaMahasantri }}</span>
                    </div>

                    <div class="st-info-item">
                        <span class="st-info-label">NIM</span>
                        <span class="st-info-value">{{ $nimMahasantri }}</span>
                    </div>

                    <div class="st-info-item">
                        <span class="st-info-label">Email akun</span>
                        <span class="st-info-value">{{ $emailMahasantri }}</span>
                    </div>
                </section>
            </div>

            {{-- KOLOM KANAN: JADWAL --}}
            <section class="st-card st-schedule-card">
                <div class="st-schedule-heading">
                    <div class="st-schedule-title">
                        <div class="st-heading-icon" aria-hidden="true">▣</div>
                        <h2>Kegiatan Hari Ini</h2>
                    </div>

                    <div class="st-today">
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                @if (isset($sesiAktif) && $sesiAktif->count() > 0)
                    @foreach ($sesiAktif as $sesi)
                        <article class="st-session">
                            <div class="st-session-main">
                                <div class="st-session-icon" aria-hidden="true">▤</div>

                                <div class="st-session-info">
                                    <h3>
                                        {{ $sesi->kegiatan->nama_kegiatan ?? 'Kegiatan' }}
                                    </h3>

                                    <div class="st-session-detail">
                                        <span>
                                            ▦
                                            {{ $sesi->tanggal
                                                ? \Carbon\Carbon::parse($sesi->tanggal)->format('d-m-Y')
                                                : '-' }}
                                        </span>

                                        <span>
                                            ◷
                                            {{ $sesi->jam_mulai ?? '--:--' }}
                                            –
                                            {{ $sesi->jam_selesai ?? '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <span class="st-status">
                                <span class="st-status-dot"></span>
                                PRESENSI AKTIF
                            </span>
                        </article>
                    @endforeach

                    <div class="st-schedule-footer">
                        <span aria-hidden="true">◷</span>
                        <span>
                            Ikuti jadwal kegiatan dan tunjukkan QR kepada
                            Pengurus saat proses presensi berlangsung.
                        </span>
                    </div>
                @else
                    <div class="st-empty">
                        <div class="st-empty-icon"></div>
                        <h3>Belum Ada Sesi Presensi</h3>
                        <p>
                            Belum ada sesi presensi yang tersedia untuk
                            ditampilkan hari ini. Silakan periksa kembali
                            sesuai jadwal kegiatan.
                        </p>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
