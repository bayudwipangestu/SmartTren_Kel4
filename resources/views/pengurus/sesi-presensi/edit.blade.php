
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Sesi Presensi
            </h2>

            <a href="{{ route('pengurus.sesi-presensi.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <div class="mb-6 rounded-lg border border-blue-200
                        bg-blue-50 p-4 text-sm text-blue-800">
                Perbarui informasi sesi presensi dengan benar.
                Pastikan jam selesai lebih akhir daripada jam mulai.
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200
                            bg-red-50 p-4 text-red-700">
                    <p class="mb-2 font-semibold">
                        Ada data yang perlu diperbaiki:
                    </p>

                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Formulir Edit Sesi
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        ID Sesi: {{ $sesiPresensi->id }}
                    </p>
                </div>

                <form
                    action="{{ route('pengurus.sesi-presensi.update', $sesiPresensi) }}"
                    method="POST"
                    class="space-y-6 p-6"
                >
                    @csrf
                    @method('PUT')

                    {{-- Kegiatan --}}
                    <div>
                        <label for="kegiatan_id"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Nama Kegiatan <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="kegiatan_id"
                            name="kegiatan_id"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm
                                   focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">-- Pilih Kegiatan --</option>

                            @php
                                $kegiatanSaatIni = $kegiatan->firstWhere(
                                    'id',
                                    $sesiPresensi->kegiatan_id
                                );
                            @endphp

                            @if (!$kegiatanSaatIni && $sesiPresensi->kegiatan)
                                <option
                                    value="{{ $sesiPresensi->kegiatan_id }}"
                                    selected
                                >
                                    {{ $sesiPresensi->kegiatan->nama_kegiatan }}
                                    (kegiatan saat ini)
                                </option>
                            @endif

                            @foreach ($kegiatan as $item)
                                <option
                                    value="{{ $item->id }}"
                                    @selected(
                                        old(
                                            'kegiatan_id',
                                            $sesiPresensi->kegiatan_id
                                        ) == $item->id
                                    )
                                >
                                    {{ $item->nama_kegiatan }}
                                </option>
                            @endforeach
                        </select>

                        @error('kegiatan_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="tanggal"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Tanggal Presensi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            required
                            value="{{ old(
                                'tanggal',
                                $sesiPresensi->tanggal
                                    ? \Illuminate\Support\Carbon::parse(
                                        $sesiPresensi->tanggal
                                    )->format('Y-m-d')
                                    : ''
                            ) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm
                                   focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Jam --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="jam_mulai"
                                   class="mb-2 block text-sm font-medium text-gray-700">
                                Jam Mulai <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="time"
                                id="jam_mulai"
                                name="jam_mulai"
                                required
                                value="{{ old(
                                    'jam_mulai',
                                    substr($sesiPresensi->jam_mulai, 0, 5)
                                ) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('jam_mulai')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="jam_selesai"
                                   class="mb-2 block text-sm font-medium text-gray-700">
                                Jam Selesai <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="time"
                                id="jam_selesai"
                                name="jam_selesai"
                                required
                                value="{{ old(
                                    'jam_selesai',
                                    substr($sesiPresensi->jam_selesai, 0, 5)
                                ) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('jam_selesai')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Status Sesi <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm
                                   focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="aktif"
                                @selected(old('status', $sesiPresensi->status) === 'aktif')>
                                Aktif
                            </option>

                            <option value="selesai"
                                @selected(old('status', $sesiPresensi->status) === 'selesai')>
                                Selesai
                            </option>

                            <option value="dibatalkan"
                                @selected(old('status', $sesiPresensi->status) === 'dibatalkan')>
                                Dibatalkan
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col-reverse gap-3 border-t
                                border-gray-200 pt-5 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('pengurus.sesi-presensi.index') }}"
                            class="inline-flex items-center justify-center rounded-lg
                                   border border-gray-300 px-5 py-2.5 text-sm
                                   font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg
                                   bg-indigo-600 px-5 py-2.5 text-sm font-semibold
                                   text-white hover:bg-indigo-700
                                   focus:outline-none focus:ring-2
                                   focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
