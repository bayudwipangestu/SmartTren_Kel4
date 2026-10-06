<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Kegiatan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Tambahkan kegiatan baru yang akan digunakan untuk presensi.
                </p>
            </div>

            <a
                href="{{ route('admin.kegiatan.index') }}"
                class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition"
            >
                ← Kembali
            </a>

        </div>

    </x-slot>


    <div class="bg-gray-100 py-8">

        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- Error Validasi --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

                    <div class="flex items-start">

                        <div class="mr-3 text-xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-semibold text-red-800">
                                Terdapat kesalahan pada formulir
                            </h3>

                            <ul class="mt-2 list-disc pl-5 text-sm text-red-700">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Form --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header Form --}}
                <div class="border-b px-6 py-5">

                    <h3 class="text-lg font-bold text-gray-800">
                        Informasi Kegiatan
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Isi data kegiatan dengan lengkap.
                    </p>

                </div>


                <form
                    action="{{ route('admin.kegiatan.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="space-y-6 p-6">

                        {{-- Nama Kegiatan --}}
                        <div>

                            <label
                                for="nama_kegiatan"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Nama Kegiatan
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama_kegiatan"
                                name="nama_kegiatan"
                                value="{{ old('nama_kegiatan') }}"
                                placeholder="Contoh: Sholat Subuh"
                                required
                                maxlength="100"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-100 @error('nama_kegiatan') border-red-500 @enderror"
                            >

                            <p class="mt-2 text-xs text-gray-500">
                                Masukkan nama kegiatan yang akan digunakan untuk presensi.
                            </p>

                            @error('nama_kegiatan')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Deskripsi --}}
                        <div>

                            <label
                                for="deskripsi"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="5"
                                maxlength="1000"
                                placeholder="Contoh: Presensi Sholat Subuh berjamaah."
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-100 @error('deskripsi') border-red-500 @enderror"
                            >{{ old('deskripsi') }}</textarea>

                            <p class="mt-2 text-xs text-gray-500">
                                Deskripsi boleh dikosongkan.
                            </p>

                            @error('deskripsi')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Status
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-100 @error('status') border-red-500 @enderror"
                            >

                                <option value="">
                                    -- Pilih Status --
                                </option>

                                <option
                                    value="aktif"
                                    {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="nonaktif"
                                    {{ old('status') === 'nonaktif' ? 'selected' : '' }}
                                >
                                    Nonaktif
                                </option>

                            </select>

                            <p class="mt-2 text-xs text-gray-500">
                                Kegiatan dengan status aktif dapat digunakan untuk presensi.
                            </p>

                            @error('status')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Informasi --}}
                        <div class="rounded-xl border border-green-100 bg-green-50 p-4">

                            <div class="flex items-start">

                                <div class="mr-3 text-xl">
                                    ℹ️
                                </div>

                                <div>

                                    <h4 class="font-semibold text-green-800">
                                        Informasi
                                    </h4>

                                    <p class="mt-1 text-sm leading-6 text-green-700">
                                        Kegiatan yang dibuat di halaman ini nantinya
                                        dapat digunakan oleh Pengurus untuk membuka
                                        sesi presensi dan melakukan scan QR Mahasantri.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 border-t bg-gray-50 px-6 py-5">

                        <a
                            href="{{ route('admin.kegiatan.index') }}"
                            class="rounded-xl bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition"
                        >
                            Simpan Kegiatan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>