<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Edit Kegiatan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Perbarui informasi kegiatan SmartTren.
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

            {{-- Error --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

                    <div class="flex items-start">

                        <div class="mr-3 text-xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-semibold text-red-800">
                                Terdapat kesalahan
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


            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b px-6 py-5">

                    <h3 class="text-lg font-bold text-gray-800">
                        Edit Informasi Kegiatan
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Ubah data sesuai kebutuhan.
                    </p>

                </div>


                {{-- Form --}}
                <form
                    action="{{ route('admin.kegiatan.update', $kegiatan) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="space-y-6 p-6">

                        {{-- Nama --}}
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
                                value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}"
                                maxlength="100"
                                required
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 @error('nama_kegiatan') border-red-500 @enderror"
                            >

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
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 @error('deskripsi') border-red-500 @enderror"
                            >{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>

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
                                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100"
                            >

                                <option value="aktif"
                                    {{ old('status', $kegiatan->status) === 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="nonaktif"
                                    {{ old('status', $kegiatan->status) === 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>

                            @error('status')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Informasi --}}
                        <div class="rounded-xl border border-yellow-100 bg-yellow-50 p-4">

                            <div class="flex items-start">

                                <div class="mr-3 text-xl">
                                    💡
                                </div>

                                <div>

                                    <h4 class="font-semibold text-yellow-800">
                                        Perhatian
                                    </h4>

                                    <p class="mt-1 text-sm text-yellow-700">
                                        Jika kegiatan dibuat nonaktif,
                                        kegiatan tersebut nantinya tidak dapat
                                        digunakan untuk membuka sesi presensi baru.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 border-t bg-gray-50 px-6 py-5">

                        <a
                            href="{{ route('admin.kegiatan.show', $kegiatan) }}"
                            class="rounded-xl bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-green-600 px-6 py-3 text-sm font-semibold text-white hover:bg-green-700 transition"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>