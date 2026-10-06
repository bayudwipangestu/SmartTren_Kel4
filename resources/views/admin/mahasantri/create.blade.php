<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Mahasantri
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Tambahkan data mahasantri baru ke sistem SmartTren
                </p>
            </div>

            <a href="{{ route('admin.mahasantri.index') }}"
               class="rounded-lg bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-8">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-bold text-red-700">
                                Data belum dapat disimpan
                            </h3>

                            <p class="mt-1 text-sm text-red-600">
                                Silakan periksa kembali data berikut:
                            </p>

                            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm text-red-600">

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


            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-5">

                    <p class="font-semibold text-green-700">
                        ✓ {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- FORM --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

                {{-- HEADER FORM --}}
                <div class="border-b bg-white px-8 py-6">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-2xl">
                            👤
                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-gray-800">
                                Informasi Mahasantri
                            </h3>

                            <p class="text-sm text-gray-500">
                                Lengkapi seluruh data yang diperlukan
                            </p>

                        </div>

                    </div>

                </div>


                {{-- FORM --}}
                <form action="{{ route('admin.mahasantri.store') }}"
                      method="POST"
                      class="p-8">

                    @csrf


                    {{-- INFORMASI UTAMA --}}
                    <div class="mb-8">

                        <h4 class="mb-5 border-b pb-3 text-base font-bold text-gray-800">
                            Data Identitas
                        </h4>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            {{-- NAMA --}}
                            <div class="md:col-span-2">

                                <label for="nama"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    Nama Lengkap
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="nama"
                                    type="text"
                                    name="nama"
                                    value="{{ old('nama') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                    autofocus
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                @error('nama')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- NIS --}}
                            <div>

                                <label for="nim"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    NIM
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="nim"
                                    type="text"
                                    name="nim"
                                    value="{{ old('nim') }}"
                                    placeholder="Contoh: MHS001"
                                    required
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                @error('nim')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- JENIS KELAMIN --}}
                            <div>

                                <label for="jenis_kelamin"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    Jenis Kelamin
                                    <span class="text-red-500">*</span>

                                </label>

                                <select
                                    id="jenis_kelamin"
                                    name="jenis_kelamin"
                                    required
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                    <option value="">
                                        -- Pilih Jenis Kelamin --
                                    </option>

                                    <option value="L"
                                        @selected(old('jenis_kelamin') === 'L')>
                                        Laki-laki
                                    </option>

                                    <option value="P"
                                        @selected(old('jenis_kelamin') === 'P')>
                                        Perempuan
                                    </option>

                                </select>

                                @error('jenis_kelamin')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- KAMAR --}}
                            <div>

                                <label for="kamar"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    Kamar
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="kamar"
                                    type="text"
                                    name="kamar"
                                    value="{{ old('kamar') }}"
                                    placeholder="Contoh: A-01"
                                    required
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                @error('kamar')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- NO HP --}}
                            <div>

                                <label for="no_hp"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    Nomor HP

                                </label>

                                <input
                                    id="no_hp"
                                    type="text"
                                    name="no_hp"
                                    value="{{ old('no_hp') }}"
                                    placeholder="Contoh: 081234567890"
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                @error('no_hp')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- AKUN LOGIN --}}
                    <div class="mb-8">

                        <h4 class="mb-5 border-b pb-3 text-base font-bold text-gray-800">
                            Akun Login Mahasantri
                        </h4>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            {{-- EMAIL --}}
                            <div>

                                <label for="email"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    Email Login
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    required
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                @error('email')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- PASSWORD --}}
                            <div>

                                <label for="password"
                                       class="mb-2 block text-sm font-semibold text-gray-700">

                                    Password
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                    minlength="8"
                                    required
                                    class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                                >

                                @error('password')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                                <p class="mt-2 text-xs text-gray-500">
                                    Password minimal 8 karakter.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="mb-8">

                        <h4 class="mb-5 border-b pb-3 text-base font-bold text-gray-800">
                            Status Mahasantri
                        </h4>

                        <div class="max-w-md">

                            <label for="status"
                                   class="mb-2 block text-sm font-semibold text-gray-700">

                                Status
                                <span class="text-red-500">*</span>

                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-green-500"
                            >

                                <option value="aktif"
                                    @selected(old('status', 'aktif') === 'aktif')>
                                    Aktif
                                </option>

                                <option value="nonaktif"
                                    @selected(old('status') === 'nonaktif')>
                                    Nonaktif
                                </option>

                            </select>

                            @error('status')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- INFO QR --}}
                    <div class="mb-8 rounded-xl border border-green-200 bg-green-50 p-5">

                        <div class="flex gap-3">

                            <div class="text-xl">
                                📱
                            </div>

                            <div>

                                <h4 class="font-semibold text-green-800">
                                    QR Code
                                </h4>

                                <p class="mt-1 text-sm leading-relaxed text-green-700">
                                    QR Code akan dibuat otomatis oleh sistem setelah data
                                    mahasantri berhasil disimpan.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- TOMBOL --}}
                    <div class="flex items-center justify-end gap-3 border-t pt-6">

                        <a
                            href="{{ route('admin.mahasantri.index') }}"
                            class="rounded-lg bg-gray-200 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-300"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            Simpan Mahasantri
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>