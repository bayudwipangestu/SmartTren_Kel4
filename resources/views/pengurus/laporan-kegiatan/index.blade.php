<x-app-layout>

    <style>
        .laporan-page {
            min-height: 100vh;
            background: #f6f8f7;
            padding: 20px 0 60px;
        }

        .laporan-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 12px;
            box-sizing: border-box;
        }

        .laporan-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #087443;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
            transition: .2s ease;
        }

        .laporan-back:hover {
            color: #055b34;
            transform: translateX(-2px);
        }

        .laporan-title {
            margin: 0;
            color: #17251f;
            font-size: 32px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .laporan-subtitle {
            margin: 8px 0 0;
            color: #718078;
            font-size: 15px;
        }

        .laporan-info {
            position: relative;
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 26px;
            padding: 22px 24px;
            border: 1px solid #ccebdd;
            border-radius: 18px;
            background: linear-gradient(135deg, #ecfaf3 0%, #ffffff 100%);
            overflow: hidden;
        }

        .laporan-info-icon {
            width: 54px;
            height: 54px;
            min-width: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d9f5e6;
            color: #086b3e;
            font-size: 15px;
            font-weight: 800;
        }

        .laporan-info-title {
            margin: 0;
            color: #086b3e;
            font-size: 18px;
            font-weight: 700;
        }

        .laporan-info-text {
            margin: 6px 0 0;
            color: #527063;
            font-size: 14px;
            line-height: 1.6;
        }

        .laporan-main {
            margin-top: 24px;
            background: #ffffff;
            border: 1px solid #e1e8e4;
            border-radius: 22px;
            box-shadow: 0 8px 30px rgba(31, 55, 43, .06);
            overflow: hidden;
        }

        .laporan-main-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 24px 26px;
            border-bottom: 1px solid #edf1ef;
        }

        .laporan-heading {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .laporan-heading-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf9f2;
            color: #087443;
            font-size: 13px;
            font-weight: 800;
        }

        .laporan-heading-title {
            margin: 0;
            color: #1b2923;
            font-size: 19px;
            font-weight: 700;
        }

        .laporan-heading-text {
            margin: 4px 0 0;
            color: #7b8882;
            font-size: 13px;
        }

        .laporan-total {
            display: inline-flex;
            align-items: center;
            padding: 9px 14px;
            border-radius: 999px;
            background: #edf9f2;
            color: #087443;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .laporan-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            padding: 24px;
        }

        .kegiatan-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            border: 1px solid #e3e9e6;
            border-radius: 18px;
            background: #ffffff;
            transition: all .22s ease;
        }

        .kegiatan-card:hover {
            transform: translateY(-3px);
            border-color: #b9e5ce;
            box-shadow: 0 12px 28px rgba(31, 55, 43, .09);
        }

        .kegiatan-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 800;
        }

        .icon-hijau { background: #e6f8ee; color: #047857; }
        .icon-kuning { background: #fff5d9; color: #b45309; }
        .icon-biru { background: #e9f2ff; color: #1d4ed8; }
        .icon-ungu { background: #f2eaff; color: #6d28d9; }
        .icon-merah { background: #ffeded; color: #b91c1c; }
        .icon-default { background: #edf4f0; color: #065f46; }

        .kegiatan-title {
            margin: 0;
            color: #17231e;
            font-size: 17px;
            font-weight: 700;
            line-height: 1.4;
        }

        .kegiatan-description {
            margin: 6px 0 0;
            min-height: 40px;
            color: #77847e;
            font-size: 13px;
            line-height: 1.55;
        }

        .kegiatan-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 18px;
            margin-bottom: 18px;
        }

        .kegiatan-session {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #69766f;
            font-size: 13px;
            font-weight: 600;
        }

        .status-aktif {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #e9f9f0;
            color: #087443;
            font-size: 11px;
            font-weight: 700;
        }

        .status-aktif-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #16a05d;
        }

        .status-nonaktif {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f1f3f2;
            color: #77817c;
            font-size: 11px;
            font-weight: 700;
        }

        .laporan-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            box-sizing: border-box;
            padding: 11px 14px;
            border-radius: 11px;
            background: #079447;
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .laporan-button:hover {
            background: #067c3b;
        }

        .laporan-empty {
            padding: 70px 24px;
            text-align: center;
        }

        @media (max-width: 1000px) {
            .laporan-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 640px) {
            .laporan-grid { grid-template-columns: 1fr; padding: 16px; }
        }
    </style>

    @php
        $listKegiatan = $kegiatan ?? ($kegiatans ?? collect());
    @endphp

    <div class="laporan-page">
        <div class="laporan-container">
            <a href="{{ url('/pengurus/dashboard') }}" class="laporan-back">
                &larr; Kembali ke Dashboard
            </a>

            <h1 class="laporan-title">Laporan Kegiatan</h1>
            <p class="laporan-subtitle">
                Pilih kegiatan untuk melihat laporan presensi berdasarkan periode dan status.
            </p>

            <div class="laporan-info">
                <div class="laporan-info-icon">RPT</div>
                <div>
                    <h2 class="laporan-info-title">Laporan Presensi Per Kegiatan</h2>
                    <p class="laporan-info-text">
                        Setiap kegiatan memiliki laporan presensi sendiri. Pilih salah satu kegiatan untuk melihat data kehadiran, melakukan filter laporan, dan mencetak laporan PDF.
                    </p>
                </div>
            </div>

            <div class="laporan-main">
                <div class="laporan-main-header">
                    <div class="laporan-heading">
                        <div class="laporan-heading-icon">KGT</div>
                        <div>
                            <h2 class="laporan-heading-title">Daftar Kegiatan</h2>
                            <p class="laporan-heading-text">Pilih kegiatan yang ingin dilihat laporannya.</p>
                        </div>
                    </div>

                    <div class="laporan-total">
                        {{ $listKegiatan->count() }} Kegiatan
                    </div>
                </div>

                @if($listKegiatan->count() > 0)
                    <div class="laporan-grid">
                        @foreach($listKegiatan as $item)
                            @php
                                $nama = strtolower($item->nama_kegiatan);
                                if (str_contains($nama, 'subuh')) {
                                    $kode = 'SBH';
                                    $iconClass = 'icon-hijau';
                                } elseif (str_contains($nama, 'magrib')) {
                                    $kode = 'MGR';
                                    $iconClass = 'icon-kuning';
                                } elseif (str_contains($nama, 'isya')) {
                                    $kode = 'ISY';
                                    $iconClass = 'icon-biru';
                                } elseif (str_contains($nama, 'ngaji') || str_contains($nama, 'quran') || str_contains($nama, "qur'an")) {
                                    $kode = 'NGJ';
                                    $iconClass = 'icon-ungu';
                                } elseif (str_contains($nama, 'roan')) {
                                    $kode = 'RON';
                                    $iconClass = 'icon-merah';
                                } else {
                                    $kode = strtoupper(substr($item->nama_kegiatan, 0, 3));
                                    $iconClass = 'icon-default';
                                }
                            @endphp

                            <div class="kegiatan-card">
                                <div class="kegiatan-icon {{ $iconClass }}">{{ $kode }}</div>
                                <h3 class="kegiatan-title">{{ $item->nama_kegiatan }}</h3>
                                <p class="kegiatan-description">
                                    {{ $item->deskripsi ?: 'Laporan presensi kegiatan ' . $item->nama_kegiatan . '.' }}
                                </p>

                                <div class="kegiatan-info">
                                    <div class="kegiatan-session">
                                        {{ $item->sesi_presensi_count ?? 0 }} sesi
                                    </div>

                                    @if($item->status === 'aktif')
                                        <span class="status-aktif">
                                            <span class="status-aktif-dot"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="status-nonaktif">Nonaktif</span>
                                    @endif
                                </div>

                                <a href="{{ route('pengurus.laporan-kegiatan.show', $item->id) }}" class="laporan-button">
                                    <span>Lihat Laporan</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="laporan-empty">
                        <h3>Belum Ada Kegiatan</h3>
                        <p>Belum terdapat kegiatan yang dapat dibuatkan laporan presensi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>