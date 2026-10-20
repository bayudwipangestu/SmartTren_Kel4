<x-app-layout>

 @php
    $daftarPengajuan = $pengajuans ?? collect();

    $jumlahMenunggu = $jumlahMenunggu ?? 0;
    $jumlahDisetujui = $jumlahDisetujui ?? 0;
    $jumlahDitolak = $jumlahDitolak ?? 0;
@endphp

    <style>

        .pg-page {

            max-width: 1440px;

            margin: 0 auto;

            padding: 28px;

            color: #17352b;

        }

        .pg-page * {

            box-sizing: border-box;

        }

        .pg-heading {

            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            gap: 16px;

            margin-bottom: 24px;

        }

        .pg-breadcrumb {

            margin-bottom: 8px;

            color: #84918b;

            font-size: 13px;

        }

        .pg-title {

            margin: 0;

            font-size: 28px;

            line-height: 1.3;

            font-weight: 800;

            letter-spacing: -.5px;

        }

        .pg-description {

            margin-top: 7px;

            color: #77877f;

            font-size: 14px;

        }

        .pg-hero {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 26px;

            margin-bottom: 20px;

            border-radius: 17px;

            color: white;

            background: linear-gradient(115deg, #064e3b, #07845c);

        }

        .pg-hero-label {

            margin-bottom: 8px;

            color: #a7f3d0;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: 1.5px;

        }

        .pg-hero-title {

            margin: 0;

            font-size: 23px;

            font-weight: 800;

        }

        .pg-hero-text {

            margin-top: 8px;

            color: #e1f5eb;

            font-size: 14px;

            line-height: 1.7;

        }

        .pg-hero-icon {

            display: grid;

            flex-shrink: 0;

            width: 58px;

            height: 58px;

            place-items: center;

            border: 1px solid #ffffff30;

            border-radius: 15px;

            background: #ffffff16;

            font-size: 26px;

        }

        .pg-stats {

            display: grid;

            grid-template-columns: repeat(3, minmax(0, 1fr));

            gap: 15px;

            margin-bottom: 22px;

        }

        .pg-stat {

            padding: 19px;

            border: 1px solid #e4ede8;

            border-radius: 15px;

            background: #fff;

            box-shadow: 0 4px 16px #143c2d08;

        }

        .pg-stat-label {

            color: #6e7f76;

            font-size: 13px;

            font-weight: 650;

        }

        .pg-stat-number {

            margin-top: 10px;

            font-size: 30px;

            line-height: 1.2;

            font-weight: 800;

        }

        .pg-stat-note {

            margin-top: 5px;

            color: #8b9891;

            font-size: 12px;

        }

        .pg-action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin: 0 0 18px;
        }

        .pg-button-secondary:hover {
            background: #f4f8f5;
        }

        .pg-card {

            overflow: hidden;

            margin-bottom: 20px;

            border: 1px solid #e4ede8;

            border-radius: 16px;

            background: #fff;

            box-shadow: 0 4px 16px #143c2d08;

        }

        .pg-card-header {

            padding: 20px 22px;

            border-bottom: 1px solid #edf2ef;

        }

        .pg-card-title {

            margin: 0;

            font-size: 17px;

            font-weight: 800;

        }

        .pg-card-subtitle {

            margin-top: 5px;

            color: #829087;

            font-size: 13px;

            line-height: 1.6;

        }

        .pg-card-body {

            padding: 22px;

        }

        .pg-alert {

            margin-bottom: 18px;

            padding: 13px 15px;

            border: 1px solid;

            border-radius: 10px;

            font-size: 13px;

            line-height: 1.6;

        }

        .pg-alert-success {

            border-color: #b9e8cf;

            background: #ecfdf3;

            color: #166534;

        }

        .pg-alert-error {

            border-color: #fecaca;

            background: #fef2f2;

            color: #991b1b;

        }

        .pg-form-grid {

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 18px;

        }

        .pg-field {

            min-width: 0;

        }

        .pg-field-full {

            grid-column: 1 / -1;

        }

        .pg-label {

            display: block;

            margin-bottom: 7px;

            color: #344d41;

            font-size: 13px;

            font-weight: 750;

        }

        .pg-input,

        .pg-select,

        .pg-textarea {

            display: block;

            width: 100%;

            max-width: 100%;

            border: 1px solid #dce6e0;

            border-radius: 9px;

            background: #fff;

            padding: 11px 12px;

            color: #253e32;

            font-size: 14px;

            outline: none;

        }

        .pg-input,

        .pg-select {

            min-height: 44px;

        }

        .pg-textarea {

            min-height: 115px;

            resize: vertical;

        }

        .pg-input[type="file"] {
            min-height: 44px;
            padding: 9px 10px;
            background: #fbfdfb;
            cursor: pointer;
        }

        .pg-input[type="file"]::file-selector-button {
            margin-right: 12px;
            padding: 7px 12px;
            border: 0;
            border-radius: 7px;
            background: #e7f7ef;
            color: #176346;
            font-weight: 700;
            cursor: pointer;
        }

        .pg-input:focus,

        .pg-select:focus,

        .pg-textarea:focus {

            border-color: #07845c;

            box-shadow: 0 0 0 3px #07845c18;

        }

        .pg-help {

            margin-top: 6px;

            color: #87938c;

            font-size: 12px;

            line-height: 1.6;

        }

        .pg-error {

            margin-top: 5px;

            color: #dc2626;

            font-size: 12px;

        }

        .pg-actions {

            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 22px;

        }

        .pg-button {

            display: inline-flex;

            min-height: 43px;

            align-items: center;

            justify-content: center;

            padding: 0 18px;

            border: 1px solid transparent;

            border-radius: 9px;

            font-size: 13px;

            font-weight: 750;

            text-decoration: none;

            cursor: pointer;

        }

        .pg-button-primary {

            background: #07845c;

            color: white;

        }

        .pg-button-primary:hover {

            background: #066b4b;

        }

        .pg-button-secondary {

            border-color: #dce6e0;

            background: #fff;

            color: #52645a;

        }

        .pg-table-wrap {

            overflow-x: auto;

        }

        .pg-table {

            width: 100%;

            min-width: 760px;

            border-collapse: collapse;

        }

        .pg-table th {

            padding: 14px 18px;

            background: #f5f9f7;

            color: #728078;

            text-align: left;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: .5px;

            text-transform: uppercase;

        }

        .pg-table td {

            padding: 16px 18px;

            border-top: 1px solid #edf2ef;

            color: #52645a;

            font-size: 13px;

            line-height: 1.65;

            vertical-align: top;

            overflow-wrap: anywhere;

        }

        .pg-table tbody tr:hover {

            background: #fbfdfc;

        }

        .pg-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 10px;

            border-radius: 999px;

            font-size: 11px;

            font-weight: 800;

            white-space: nowrap;

        }

        .pg-pending {

            background: #fff5dc;

            color: #956300;

        }

        .pg-approved {

            background: #e3f8ed;

            color: #08784e;

        }

        .pg-rejected {

            background: #ffe8e8;

            color: #b42332;

        }

        .pg-type {

            display: inline-block;

            padding: 5px 9px;

            border-radius: 7px;

            background: #eef7f1;

            color: #176346;

            font-size: 12px;

            font-weight: 750;

        }

        .pg-empty {

            padding: 45px 20px;

            text-align: center;

            color: #829087;

        }

        .pg-empty-icon {

            display: grid;

            width: 52px;

            height: 52px;

            place-items: center;

            margin: 0 auto 13px;

            border-radius: 15px;

            background: #e7f7ef;

            color: #07845c;

            font-size: 24px;

        }

        .pg-empty-title {

            color: #294638;

            font-size: 15px;

            font-weight: 800;

        }

        .pg-empty-text {

            margin-top: 7px;

            font-size: 13px;

        }

        .pg-info {

            padding: 14px 16px;

            border: 1px solid #d5eee0;

            border-radius: 11px;

            background: #f0faf4;

            color: #386451;

            font-size: 13px;

            line-height: 1.7;

        }

        @media (max-width: 850px) {

            .pg-page {

                padding: 22px 18px;

            }

            .pg-stats {

                gap: 10px;

            }

            .pg-stat {

                padding: 15px;

            }

            .pg-form-grid {

                gap: 14px;

            }

        }

        @media (max-width: 600px) {

            .pg-page {

                padding: 17px 13px 28px;

            }

            .pg-heading {

                flex-direction: column;

            }

            .pg-title {

                font-size: 24px;

            }

            .pg-hero {

                padding: 20px;

            }

            .pg-hero-title {

                font-size: 19px;

            }

            .pg-hero-icon {

                display: none;

            }

            .pg-stats {

                grid-template-columns: 1fr;

            }

            .pg-form-grid {

                grid-template-columns: 1fr;

            }

            .pg-field-full {

                grid-column: auto;

            }

            .pg-card-header,

            .pg-card-body {

                padding: 17px;

            }

            .pg-actions {

                flex-direction: column-reverse;

            }

            .pg-button {

                width: 100%;

            }

        }

    </style>

    <main class="pg-page" x-data="{ formTerbuka: false }">
<section class="pg-hero">

            <div>

                <div class="pg-hero-label">LAYANAN MAHASANTRI</div>

                <h2 class="pg-hero-title">Pengajuan Izin dan Sakit</h2>

                <p class="pg-hero-text">

                    Isi data dengan benar. Pengajuan akan diperiksa oleh pengurus.

                </p>

            </div>

            <div class="pg-hero-icon" aria-hidden="true">✎</div>

        </section>

        @if(session('success'))

            <div class="pg-alert pg-alert-success">{{ session('success') }}</div>

        @endif

        @if(session('error'))

            <div class="pg-alert pg-alert-error">{{ session('error') }}</div>

        @endif

        @if($errors->any())

            <div class="pg-alert pg-alert-error">

                <strong>Periksa kembali data yang kamu isi:</strong>

                <ul style="margin:8px 0 0 18px;list-style:disc">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <section class="pg-stats">

            <div class="pg-stat">

                <div class="pg-stat-label">Menunggu pemeriksaan</div>

                <div class="pg-stat-number">{{ $jumlahMenunggu }}</div>

                <div class="pg-stat-note">Pengajuan yang belum diputuskan</div>

            </div>

            <div class="pg-stat">

                <div class="pg-stat-label">Disetujui</div>

                <div class="pg-stat-number" style="color:#07845c">{{ $jumlahDisetujui }}</div>

                <div class="pg-stat-note">Pengajuan yang telah disetujui</div>

            </div>

            <div class="pg-stat">

                <div class="pg-stat-label">Ditolak</div>

                <div class="pg-stat-number" style="color:#c2414b">{{ $jumlahDitolak }}</div>

                <div class="pg-stat-note">Pengajuan yang tidak disetujui</div>

            </div>

        </section>

        <div class="pg-action-row">
            <div>
                <h2 class="pg-card-title">Pengajuan Saya</h2>
                <p class="pg-card-subtitle">Ajukan izin atau sakit dan pantau status pengajuanmu.</p>
            </div>
            <button type="button" class="pg-button pg-button-primary"
                    @click="formTerbuka = !formTerbuka"
                    x-text="formTerbuka ? 'Tutup Form' : '+ Buat Pengajuan'"></button>
        </div>

        
<section class="pg-card" x-show="formTerbuka" x-transition style="display: none;">
    <div class="pg-card-header">
        <h2 class="pg-card-title">Form Pengajuan</h2>
        <p class="pg-card-subtitle">
            Pilih kegiatan, jenis pengajuan, dan jelaskan alasanmu.
        </p>
    </div>

    <div class="pg-card-body">
        
<form method="POST"
      enctype="multipart/form-data"
      action="{{ route('mahasantri.pengajuan-izin.store') }}">
    @csrf

    <div class="pg-form-grid">
<div class="pg-field pg-field-full">
    <label class="pg-label" for="kegiatan_id">
        Kegiatan <span style="color:#dc2626">*</span>
    </label>

    <select class="pg-select"
            id="kegiatan_id"
            name="kegiatan_id"
            required>
        <option value="">-- Pilih kegiatan --</option>

        @foreach ($kegiatans as $kegiatan)
            <option value="{{ $kegiatan->id }}"
                @selected(old('kegiatan_id') == $kegiatan->id)>
                {{ $kegiatan->nama_kegiatan }}
            </option>
        @endforeach
    </select>

    @error('kegiatan_id')
        <p class="pg-error">{{ $message }}</p>
    @enderror
</div>



        <div class="pg-field">
            <label class="pg-label" for="jenis">
                Jenis pengajuan <span style="color:#dc2626">*</span>
            </label>

            <select class="pg-select" id="jenis" name="jenis" required>
                <option value="">Pilih jenis pengajuan</option>
                <option value="izin" @selected(old('jenis') === 'izin')>Izin</option>
                <option value="sakit" @selected(old('jenis') === 'sakit')>Sakit</option>
            </select>

            @error('jenis')
                <p class="pg-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pg-field">
            <label class="pg-label" for="tanggal">
                Tanggal pengajuan <span style="color:#dc2626">*</span>
            </label>

            <input class="pg-input"
                   id="tanggal"
                   name="tanggal"
                   type="date"
                   value="{{ old('tanggal', date('Y-m-d')) }}"
                   required>

            @error('tanggal')
                <p class="pg-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pg-field pg-field-full">
            <label class="pg-label" for="alasan">
                Alasan pengajuan <span style="color:#dc2626">*</span>
            </label>

            <textarea class="pg-textarea"
                      id="alasan"
                      name="alasan"
                      rows="4"
                      maxlength="2000"
                      placeholder="Jelaskan alasan izin atau sakit..."
                      required>{{ old('alasan') }}</textarea>

            @error('alasan')
                <p class="pg-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pg-field pg-field-full">
            <label class="pg-label" for="bukti_foto">
                Foto bukti pendukung (opsional)
            </label>

            <input class="pg-input"
                   id="bukti_foto"
                   name="bukti_foto"
                   type="file"
                   accept=".jpg,.jpeg,.png,.webp">

            <p class="pg-help">
                Format JPG, JPEG, PNG, atau WebP. Maksimal 5 MB.
            </p>

            @error('bukti_foto')
                <p class="pg-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="pg-actions">
        <button class="pg-button pg-button-secondary"
                type="button"
                @click="formTerbuka = false">
            Batal
        </button>

        <button class="pg-button pg-button-primary" type="submit">
            Kirim Pengajuan
        </button>
    </div>
</form>

    </div>
</section>


        <section class="pg-card">

            <div class="pg-card-header">

                <h2 class="pg-card-title">Riwayat Pengajuan</h2>

                <p class="pg-card-subtitle">

                    Periksa status pengajuan dan catatan dari pengurus.

                </p>

            </div>

            @if($daftarPengajuan->isEmpty())

                <div class="pg-empty">

                    <div class="pg-empty-icon">▤</div>

                    <div class="pg-empty-title">Belum ada pengajuan</div>

                    <p class="pg-empty-text">

                        Pengajuan yang kamu kirim akan tercatat di bagian ini.

                    </p>

                </div>

            @else

                <div class="pg-table-wrap">

                    <table class="pg-table">

                        <thead>

                            <tr>

                                <th>No.</th>

                                <th>Jenis</th>

                                <th>Tanggal</th>

                                <th>Alasan</th>

                                <th>Status</th>

                                <th>Catatan Pengurus</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($daftarPengajuan as $item)

                                @php

                                    $status = strtolower((string) data_get($item, 'status', 'menunggu'));

                                    $kelasStatus = match($status) {

                                        'disetujui', 'diterima', 'approved' => 'pg-approved',

                                        'ditolak', 'rejected' => 'pg-rejected',

                                        default => 'pg-pending',

                                    };

                                    $labelStatus = match($status) {

                                        'disetujui', 'diterima', 'approved' => 'Disetujui',

                                        'ditolak', 'rejected' => 'Ditolak',

                                        default => 'Menunggu',

                                    };

                                    $jenisPengajuan = data_get($item, 'jenis', data_get($item, 'jenis_pengajuan', '-'));

                                    $tanggalPengajuan = data_get($item, 'tanggal', data_get($item, 'tanggal_pengajuan'));

                                    $alasanPengajuan = data_get($item, 'alasan', '-');

                                    $catatanPengurus = data_get($item, 'catatan_pengurus');

                                @endphp

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <span class="pg-type">{{ ucfirst($jenisPengajuan ?: '-') }}</span>

                                    </td>

                                    <td>

                                        @if($tanggalPengajuan)

                                            {{ \Illuminate\Support\Carbon::parse($tanggalPengajuan)->format('d M Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td style="max-width:260px;white-space:normal;overflow-wrap:anywhere">

                                        {{ $alasanPengajuan ?: '-' }}

                                    </td>

                                    <td>

                                        <span class="pg-badge {{ $kelasStatus }}">

                                            {{ $labelStatus }}

                                        </span>

                                    </td>

                                    <td style="max-width:240px;white-space:normal;overflow-wrap:anywhere">

                                        {{ $catatanPengurus ?: 'Belum ada catatan' }}

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </section>

        <div class="pg-info">

            <strong>Informasi:</strong>

            Pengajuan akan berstatus menunggu sampai diperiksa oleh pengurus.

            Jika terdapat kesalahan data atau pertanyaan, silakan hubungi pengurus.

        </div>

    </main>

</x-app-layout>
