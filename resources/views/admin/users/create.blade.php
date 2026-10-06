<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Pengguna
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan akun pengguna baru ke sistem SmartTren.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-8">

                    {{-- Judul --}}
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Form Tambah Pengguna
                        </h1>

                        <p class="mt-1 text-sm text-gray-500">
                            Isi data pengguna dengan lengkap.
                        </p>
                    </div>

                    {{-- Pesan Error --}}
                    @if ($errors->any())
                        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                            <div class="font-semibold text-red-700 mb-2">
                                Terdapat kesalahan:
                            </div>

                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form
                        method="POST"
                        action="{{ route('admin.users.store') }}"
                    >

                        @csrf

                        {{-- Nama --}}
                        <div class="mb-6">

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama pengguna"
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>

                        {{-- Email --}}
                        <div class="mb-6">

                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="contoh@smarttren.test"
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>

                        {{-- Password --}}
                        <div class="mb-6">

                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Masukkan password"
                                required
                                minlength="8"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            <p class="mt-1 text-xs text-gray-500">
                                Password minimal 8 karakter.
                            </p>

                        </div>

                        {{-- Role --}}
                        <div class="mb-8">

                            <label
                                for="role"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Role
                            </label>

                            <select
                                name="role"
                                id="role"
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="">
                                    -- Pilih Role --
                                </option>

                                <option
                                    value="admin"
                                    {{ old('role') === 'admin' ? 'selected' : '' }}
                                >
                                    Admin
                                </option>

                                <option
                                    value="pengurus"
                                    {{ old('role') === 'pengurus' ? 'selected' : '' }}
                                >
                                    Pengurus
                                </option>

                                <option
                                    value="mahasantri"
                                    {{ old('role') === 'mahasantri' ? 'selected' : '' }}
                                >
                                    Mahasantri
                                </option>

                            </select>

                        </div>

                        {{-- TOMBOL --}}
                        
                        <div class="flex items-center justify-between border-t pt-6">

                            <a
                                href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center px-5 py-3 bg-gray-200 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-300"
                            >
                                ← Kembali
                            </a>

                            <input
    type="submit"
    value="Simpan Pengguna"
    style="
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
        background: #4f46e5 !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 6px !important;
        border: none !important;
        cursor: pointer !important;
        font-weight: 600 !important;
        font-size: 14px !important;
    "
>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>