<x-app-layout>

    <style>

        /* =========================================================
           SMARTTREN - BUAT SESI PRESENSI
        ========================================================= */

        .create-page {
            min-height: calc(100vh - 65px);
            background: #f5f7f6;
            padding: 32px 0 55px;
            color: #17211b;
        }

        .create-container {
            width: min(900px, calc(100% - 40px));
            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .create-header {
            margin-bottom: 25px;
        }

        .create-back {
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

        .create-back:hover {
            color: #126c3c;
            transform: translateX(-2px);
        }

        .create-back svg {
            width: 17px !important;
            height: 17px !important;

            min-width: 17px !important;
            max-width: 17px !important;

            min-height: 17px !important;
            max-height: 17px !important;

            flex: 0 0 17px !important;

            display: block;
        }

        .create-title {
            margin: 0;

            color: #17211b;

            font-size: 28px;
            line-height: 1.25;
            font-weight: 800;

            letter-spacing: -.5px;
        }

        .create-subtitle {
            margin: 7px 0 0;

            color: #718078;

            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
           ERROR
        ========================================================= */

        .create-error {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            margin-bottom: 20px;
            padding: 16px 18px;

            border: 1px solid #fecaca;
            border-radius: 14px;

            background: #fff5f5;
            color: #b42318;
        }

        .create-error-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 32px;
            height: 32px;
            flex: 0 0 32px;

            border-radius: 9px;

            background: #fee2e2;
            color: #dc2626;
        }

        .create-error-icon svg {
            width: 17px !important;
            height: 17px !important;
        }

        .create-error-title {
            margin: 0 0 5px;

            font-size: 13px;
            font-weight: 800;
        }

        .create-error-list {
            margin: 0;
            padding-left: 18px;

            color: #c2413b;

            font-size: 12px;
            line-height: 1.7;
        }


        /* =========================================================
           FORM CARD
        ========================================================= */

        .create-card {
            overflow: hidden;

            border: 1px solid #e2e9e5;
            border-radius: 20px;

            background: #ffffff;

            box-shadow:
                0 8px 30px rgba(23, 33, 27, .055);
        }

        .create-card-header {
            padding: 22px 25px;

            border-bottom: 1px solid #edf1ee;

            background: #fbfcfb;
        }

        .create-card-title {
            margin: 0;

            color: #1a251e;

            font-size: 18px;
            font-weight: 800;
        }

        .create-card-text {
            margin: 5px 0 0;

            color: #7a867f;

            font-size: 13px;
            line-height: 1.6;
        }

        .create-form {
            padding: 26px;
        }


        /* =========================================================
           FIELD
        ========================================================= */

        .create-field {
            margin-bottom: 22px;
        }

        .create-label {
            display: block;

            margin-bottom: 8px;

            color: #344139;

            font-size: 13px;
            font-weight: 800;
        }

        .create-required {
            color: #dc2626;
        }

        .create-input,
        .create-select {
            display: block;

            width: 100%;

            min-height: 46px;

            padding: 10px 13px;

            border: 1px solid #d8e0db;
            border-radius: 11px;

            background: #ffffff;

            color: #253129;

            font-size: 13px;

            outline: none;

            box-shadow: 0 1px 2px rgba(23,33,27,.025);

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .create-input:hover,
        .create-select:hover {
            border-color: #b8c8be;
        }

        .create-input:focus,
        .create-select:focus {
            border-color: #168047;

            box-shadow:
                0 0 0 3px rgba(22, 128, 71, .10);
        }

        .create-help {
            margin: 7px 0 0;

            color: #87918b;

            font-size: 11px;
            line-height: 1.6;
        }


        /* =========================================================
           GRID JAM
        ========================================================= */

        .create-time-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 17px;
        }


        /* =========================================================
           STATUS OPTION
        ========================================================= */

        .create-status-info {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            margin-top: 8px;
            padding: 11px 13px;

            border-radius: 10px;

            background: #effaf3;

            color: #397052;

            font-size: 11px;
            line-height: 1.6;
        }

        .create-status-info svg {
            width: 16px !important;
            height: 16px !important;

            min-width: 16px;
            flex: 0 0 16px;

            margin-top: 1px;
        }


        /* =========================================================
           FORM FOOTER
        ========================================================= */

        .create-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 27px;
            padding-top: 22px;

            border-top: 1px solid #edf1ee;
        }

        .create-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 44px;

            padding: 10px 17px;

            border: 1px solid #d8dfda;
            border-radius: 10px;

            background: #ffffff;
            color: #56635b;

            font-size: 13px;
            font-weight: 750;

            text-decoration: none;

            transition:
                background .2s ease,
                border-color .2s ease;
        }

        .create-cancel:hover {
            background: #f7f9f8;
            border-color: #c4cec8;
        }

        .create-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 44px;

            padding: 10px 19px;

            border: 0;
            border-radius: 10px;

            background: #168047;
            color: #ffffff;

            font-size: 13px;
            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 6px 16px rgba(22, 128, 71, .15);

            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .create-submit:hover {
            background: #126c3c;
            transform: translateY(-1px);

            box-shadow:
                0 9px 20px rgba(22, 128, 71, .20);
        }

        .create-submit svg {
            width: 17px !important;
            height: 17px !important;

            min-width: 17px !important;
            max-width: 17px !important;

            min-height: 17px !important;
            max-height: 17px !important;

            flex: 0 0 17px !important;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 640px) {

            .create-page {
                padding: 22px 0 40px;
            }

            .create-container {
                width: calc(100% - 24px);
            }

            .create-title {
                font-size: 23px;
            }

            .create-subtitle {
                font-size: 13px;
            }

            .create-card {
                border-radius: 16px;
            }

            .create-card-header {
                padding: 19px;
            }

            .create-form {
                padding: 19px;
            }

            .create-time-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .create-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .create-cancel,
            .create-submit {
                width: 100%;
            }

        }

    </style>


    {{-- =========================================================
       HEADER BREEZE
    ========================================================= --}}

    <x-slot name="header">

        <div>

            <h2 class="text-xl font-bold text-gray-800">
                Buat Sesi Presensi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Buat sesi presensi untuk kegiatan Mahasantri.
            </p>

        </div>

    </x-slot>


    {{-- =========================================================
       CONTENT
    ========================================================= --}}

    <div class="create-page">

        <div class="create-container">


            {{-- =================================================
               PAGE HEADER
            ================================================= --}}

            <div class="create-header">

                <a
                    href="{{ route('pengurus.sesi-presensi.index') }}"
                    class="create-back"
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


                <h1 class="create-title">
                    Buat Sesi Presensi
                </h1>


                <p class="create-subtitle">
                    Buat sesi presensi berdasarkan kegiatan,
                    tanggal, dan waktu pelaksanaan.
                </p>

            </div>



            {{-- =================================================
               VALIDATION ERROR
            ================================================= --}}

            @if($errors->any())

                <div class="create-error">

                    <div class="create-error-icon">

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

                            <path d="M12 8v4"></path>

                            <path d="M12 16h.01"></path>

                        </svg>

                    </div>


                    <div>

                        <p class="create-error-title">
                            Ada data yang perlu diperbaiki:
                        </p>


                        <ul class="create-error-list">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif



            {{-- =================================================
               FORM CARD
            ================================================= --}}

            <div class="create-card">


                {{-- CARD HEADER --}}

                <div class="create-card-header">

                    <h2 class="create-card-title">
                        Informasi Sesi
                    </h2>

                    <p class="create-card-text">
                        Tentukan kegiatan, tanggal, waktu,
                        dan status sesi presensi.
                    </p>

                </div>



                {{-- =================================================
                   FORM
                ================================================= --}}

                <form
                    method="POST"
                    action="{{ route('pengurus.sesi-presensi.store') }}"
                    class="create-form"
                >

                    @csrf


                    {{-- =================================================
                       KEGIATAN
                    ================================================= --}}

                    <div class="create-field">

                        <label
                            for="kegiatan_id"
                            class="create-label"
                        >

                            Kegiatan

                            <span class="create-required">
                                *
                            </span>

                        </label>


                        <select
                            id="kegiatan_id"
                            name="kegiatan_id"
                            required
                            class="create-select"
                        >

                            <option value="">
                                -- Pilih Kegiatan --
                            </option>


                            @foreach($kegiatan as $item)

                                <option
                                    value="{{ $item->id }}"
                                    @selected(
                                        old('kegiatan_id') == $item->id
                                    )
                                >

                                    {{ $item->nama_kegiatan }}

                                </option>

                            @endforeach

                        </select>


                        <p class="create-help">
                            Pilih kegiatan yang akan dilakukan presensi.
                        </p>

                    </div>



                    {{-- =================================================
                       TANGGAL
                    ================================================= --}}

                    <div class="create-field">

                        <label
                            for="tanggal"
                            class="create-label"
                        >

                            Tanggal

                            <span class="create-required">
                                *
                            </span>

                        </label>


                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old(
                                'tanggal',
                                now()->format('Y-m-d')
                            ) }}"
                            required
                            class="create-input"
                        >


                        <p class="create-help">
                            Tentukan tanggal pelaksanaan sesi presensi.
                        </p>

                    </div>



                    {{-- =================================================
                       JAM
                    ================================================= --}}

                    <div class="create-time-grid">


                        {{-- JAM MULAI --}}

                        <div class="create-field">

                            <label
                                for="jam_mulai"
                                class="create-label"
                            >

                                Jam Mulai

                                <span class="create-required">
                                    *
                                </span>

                            </label>


                            <input
                                type="time"
                                id="jam_mulai"
                                name="jam_mulai"
                                value="{{ old('jam_mulai') }}"
                                required
                                class="create-input"
                            >


                            <p class="create-help">
                                Waktu mulai presensi dibuka.
                            </p>

                        </div>



                        {{-- JAM SELESAI --}}

                        <div class="create-field">

                            <label
                                for="jam_selesai"
                                class="create-label"
                            >

                                Jam Selesai

                                <span class="create-required">
                                    *
                                </span>

                            </label>


                            <input
                                type="time"
                                id="jam_selesai"
                                name="jam_selesai"
                                value="{{ old('jam_selesai') }}"
                                required
                                class="create-input"
                            >


                            <p class="create-help">
                                Waktu presensi ditutup.
                            </p>

                        </div>


                    </div>



                    {{-- =================================================
                       STATUS
                    ================================================= --}}

                    <div class="create-field">

                        <label
                            for="status"
                            class="create-label"
                        >

                            Status Sesi

                            <span class="create-required">
                                *
                            </span>

                        </label>


                        <select
                            id="status"
                            name="status"
                            required
                            class="create-select"
                        >

                            <option
                                value="aktif"
                                @selected(
                                    old('status', 'aktif') === 'aktif'
                                )
                            >
                                Aktif
                            </option>


                            <option
                                value="selesai"
                                @selected(
                                    old('status') === 'selesai'
                                )
                            >
                                Selesai
                            </option>


                            <option
                                value="dibatalkan"
                                @selected(
                                    old('status') === 'dibatalkan'
                                )
                            >
                                Dibatalkan
                            </option>

                        </select>


                        <div class="create-status-info">

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

                                <path d="M12 11v5"></path>

                                <path d="M12 8h.01"></path>

                            </svg>


                            <span>

                                Gunakan status
                                <strong>Aktif</strong>
                                agar sesi dapat digunakan
                                untuk melakukan scan QR.

                            </span>

                        </div>

                    </div>



                    {{-- =================================================
                       BUTTON
                    ================================================= --}}

                    <div class="create-footer">


                        {{-- BATAL --}}

                        <a
                            href="{{ route(
                                'pengurus.sesi-presensi.index'
                            ) }}"
                            class="create-cancel"
                        >

                            Batal

                        </a>



                        {{-- SIMPAN --}}

                        <button
                            type="submit"
                            class="create-submit"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path d="M12 5v14"></path>

                                <path d="M5 12h14"></path>

                            </svg>

                            Buat Sesi Presensi

                        </button>


                    </div>


                </form>

            </div>


        </div>

    </div>

</x-app-layout>