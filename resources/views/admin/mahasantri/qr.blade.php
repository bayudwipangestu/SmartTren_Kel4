<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    QR Code Mahasantri
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    QR Code digunakan untuk melakukan presensi.
                </p>
            </div>

            <a
                href="{{ route('admin.mahasantri.index') }}"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg"
            >
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

                {{-- Identitas --}}
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        SMARTTREN MJ
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Kartu Presensi Mahasantri
                    </p>
                </div>

                <div class="border-t border-gray-200 pt-6">

                    <div class="text-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $mahasantri->nama }}
                        </h2>

                        <p class="text-gray-500">
                            NIM: {{ $mahasantri->nim }}
                        </p>

                        <p class="text-gray-500">
                            Kamar: {{ $mahasantri->kamar }}
                        </p>
                    </div>

                    {{-- QR CODE --}}
                    <div class="flex justify-center mb-6">
                        <div class="p-4 bg-white border border-gray-200 rounded-xl">
                            {!! QrCode::size(250)->margin(1)->generate($mahasantri->qr_code) !!}
                        </div>
                    </div>

                    {{-- ID QR --}}
                    <div class="text-center">
                        <p class="text-xs text-gray-500 mb-1">
                            ID QR
                        </p>

                        <p class="font-mono font-bold text-gray-800">
                            {{ $mahasantri->qr_code }}
                        </p>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500">
                            Tunjukkan QR Code ini kepada Pengurus
                            untuk melakukan presensi.
                        </p>
                    </div>

                </div>

                {{-- Tombol Print --}}
                <div class="mt-8 flex justify-center">
                    <button
                        onclick="window.print()"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl"
                    >
                        🖨 Cetak QR
                    </button>
                </div>

            </div>

        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .bg-white,
            .bg-white * {
                visibility: visible;
            }

            .bg-white {
                position: absolute;
                left: 50%;
                top: 30px;
                transform: translateX(-50%);
                width: 90%;
                box-shadow: none !important;
            }

            button {
                display: none !important;
            }
        }
    </style>
</x-app-layout>