<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-xl font-bold text-gray-800">
                Laporan Presensi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Filter dan lihat rekap kehadiran Mahasantri.
            </p>

        </div>

    </x-slot>


    <div class="min-h-screen bg-gray-100 py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- KEMBALI --}}
            <div class="mb-6">

                <a
                    href="{{ route('pengurus.dashboard') }}"
                    class="inline-flex items-center gap-2
                           text-sm font-semibold
                           text-green-600 hover:text-green-700"
                >
                    ← Kembali ke Dashboard
                </a>

            </div>


            {{-- HEADER --}}
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-800">
                    Laporan Presensi
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Gunakan filter untuk membuat laporan harian,
                    mingguan, bulanan, atau berdasarkan rentang tanggal.
                </p>

            </div>


            {{-- FILTER --}}
            <div class="mb-6 rounded-2xl border
                        border-gray-200 bg-white p-6 shadow-sm">

                <div class="mb-5">

                    <h3 class="text-lg font-bold text-gray-800">
                        Filter Laporan
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Tentukan periode dan data yang ingin ditampilkan.
                    </p>

                </div>


                <form
                    method="GET"
                    action="{{ route('pengurus.laporan-presensi') }}"
                >

                    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">


                        {{-- PERIODE --}}
                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700"
                            >
                                Periode
                            </label>

                            <select
                                name="periode"
                                id="periode"
                                class="w-full rounded-xl
                                       border-gray-300 text-sm"
                            >

                                <option
                                    value="harian"
                                    @selected($periode === 'harian')
                                >
                                    Harian
                                </option>

                                <option
                                    value="mingguan"
                                    @selected($periode === 'mingguan')
                                >
                                    Mingguan
                                </option>

                                <option
                                    value="bulanan"
                                    @selected($periode === 'bulanan')
                                >
                                    Bulanan
                                </option>

                                <option
                                    value="rentang"
                                    @selected($periode === 'rentang')
                                >
                                    Rentang Tanggal
                                </option>

                            </select>

                        </div>


                        {{-- TANGGAL --}}
                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700"
                            >
                                Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                value="{{ $tanggal }}"
                                class="w-full rounded-xl
                                       border-gray-300 text-sm"
                            >

                        </div>


                        {{-- KEGIATAN --}}
                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700"
                            >
                                Kegiatan
                            </label>

                            <select
                                name="kegiatan_id"
                                class="w-full rounded-xl
                                       border-gray-300 text-sm"
                            >

                                <option value="">
                                    Semua Kegiatan
                                </option>

                                @foreach($kegiatan as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        @selected(
                                            request('kegiatan_id') == $item->id
                                        )
                                    >
                                        {{ $item->nama_kegiatan }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700"
                            >
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-xl
                                       border-gray-300 text-sm"
                            >

                                <option value="">
                                    Semua Status
                                </option>

                                <option
                                    value="hadir"
                                    @selected(request('status') === 'hadir')
                                >
                                    Hadir
                                </option>

                                <option
                                    value="izin"
                                    @selected(request('status') === 'izin')
                                >
                                    Izin
                                </option>

                                <option
                                    value="sakit"
                                    @selected(request('status') === 'sakit')
                                >
                                    Sakit
                                </option>

                                <option
                                    value="alpa"
                                    @selected(request('status') === 'alpa')
                                >
                                    Alpa
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- RENTANG TANGGAL --}}
                    <div
                        id="rentangTanggal"
                        class="mt-5 grid gap-5 md:grid-cols-2"
                    >

                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700"
                            >
                                Dari Tanggal
                            </label>

                            <input
                                type="date"
                                name="dari"
                                value="{{ $dari }}"
                                class="w-full rounded-xl
                                       border-gray-300 text-sm"
                            >

                        </div>


                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700"
                            >
                                Sampai Tanggal
                            </label>

                            <input
                                type="date"
                                name="sampai"
                                value="{{ $sampai }}"
                                class="w-full rounded-xl
                                       border-gray-300 text-sm"
                            >

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div
                        class="mt-6 flex flex-wrap gap-3
                               border-t pt-5"
                    >

                        <button
                            type="submit"
                            class="rounded-xl bg-green-600
                                   px-5 py-3 text-sm font-semibold
                                   text-white hover:bg-green-700"
                        >
                            Tampilkan Laporan
                        </button>


                        <a
                            href="{{ route(
                                'pengurus.laporan-presensi'
                            ) }}"
                            class="rounded-xl border
                                   border-gray-300 bg-white
                                   px-5 py-3 text-sm font-semibold
                                   text-gray-700 hover:bg-gray-50"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- STATISTIK --}}
            <div class="mb-6 grid gap-4 sm:grid-cols-2
                        lg:grid-cols-5">

                <div class="rounded-2xl bg-white p-5 shadow-sm">

                    <p class="text-sm text-gray-500">
                        Total
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-800">
                        {{ $total }}
                    </p>

                </div>


                <div class="rounded-2xl bg-green-50 p-5">

                    <p class="text-sm text-green-700">
                        Hadir
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-700">
                        {{ $hadir }}
                    </p>

                </div>


                <div class="rounded-2xl bg-yellow-50 p-5">

                    <p class="text-sm text-yellow-700">
                        Izin
                    </p>

                    <p class="mt-2 text-2xl font-bold text-yellow-700">
                        {{ $izin }}
                    </p>

                </div>


                <div class="rounded-2xl bg-blue-50 p-5">

                    <p class="text-sm text-blue-700">
                        Sakit
                    </p>

                    <p class="mt-2 text-2xl font-bold text-blue-700">
                        {{ $sakit }}
                    </p>

                </div>


                <div class="rounded-2xl bg-red-50 p-5">

                    <p class="text-sm text-red-700">
                        Alpa
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-700">
                        {{ $alpa }}
                    </p>

                </div>

            </div>


            {{-- TABEL --}}
            <div class="overflow-hidden rounded-2xl
                        border border-gray-200
                        bg-white shadow-sm">

                <div class="border-b px-6 py-5">

                    <h3 class="font-bold text-gray-800">
                        Data Kehadiran
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Menampilkan {{ $total }} data presensi.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4">
                                    No
                                </th>

                                <th class="px-6 py-4">
                                    Tanggal
                                </th>

                                <th class="px-6 py-4">
                                    Kegiatan
                                </th>

                                <th class="px-6 py-4">
                                    NIM
                                </th>

                                <th class="px-6 py-4">
                                    Nama
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                                <th class="px-6 py-4">
                                    Waktu
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse($presensi as $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{
                                            $item->sesiPresensi
                                                ->tanggal
                                                ->format('d/m/Y')
                                        }}
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        {{
                                            $item->sesiPresensi
                                                ->kegiatan
                                                ->nama_kegiatan
                                        }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->mahasantri->nim }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->mahasantri->user?->name }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <span
                                            class="rounded-full px-3 py-1
                                            text-xs font-semibold

                                            @if($item->status === 'hadir')
                                                bg-green-100 text-green-700
                                            @elseif($item->status === 'izin')
                                                bg-yellow-100 text-yellow-700
                                            @elseif($item->status === 'sakit')
                                                bg-blue-100 text-blue-700
                                            @else
                                                bg-red-100 text-red-700
                                            @endif"
                                        >
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-4">

                                        {{
                                            $item->waktu_presensi
                                                ? $item->waktu_presensi
                                                    ->format('H:i:s')
                                                : '-'
                                        }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="px-6 py-12 text-center
                                               text-gray-500"
                                    >
                                        Tidak ada data presensi
                                        berdasarkan filter yang dipilih.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>