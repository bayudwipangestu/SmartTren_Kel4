<x-app-layout>

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-slot name="header">

        <div class="flex items-center justify-between gap-4">

            {{-- JUDUL --}}
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Management User
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola data pengguna dan role SmartTren.
                </p>
            </div>


            {{-- KEMBALI KE DASHBOARD --}}
            <a
                href="{{ url('/admin/dashboard') }}"
                class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700"
            >
                <span>←</span>
                <span>Dashboard</span>
            </a>

        </div>

    </x-slot>


    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <div class="min-h-screen bg-[#f6f8f7] py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- =====================================================
                SUCCESS MESSAGE
            ====================================================== --}}
            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 font-bold text-green-600">
                            ✓
                        </div>

                        <div>

                            <p class="text-sm font-bold text-green-800">
                                Berhasil
                            </p>

                            <p class="mt-0.5 text-sm text-green-700">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                ERROR MESSAGE
            ====================================================== --}}
            @if(session('error'))

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-600">
                            !
                        </div>

                        <div>

                            <p class="text-sm font-bold text-red-800">
                                Terjadi Kesalahan
                            </p>

                            <p class="mt-0.5 text-sm text-red-700">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                SUMMARY CARD
            ====================================================== --}}
            <div class="mb-7 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="p-6 sm:p-7">

                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">


                        {{-- KIRI --}}
                        <div>

                            <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                SMARTTREN

                            </div>


                            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                                Daftar Pengguna
                            </h1>


                            <p class="mt-2 max-w-xl text-sm leading-6 text-gray-500">
                                Kelola akun pengguna dan hak akses berdasarkan
                                role yang tersedia dalam sistem SmartTren.
                            </p>

                        </div>


                        {{-- TOTAL USER --}}
                        <div class="flex min-w-[190px] items-center gap-4 rounded-2xl border border-green-100 bg-green-50 px-5 py-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-600 text-xl text-white shadow-sm">
                                👥
                            </div>

                            <div>

                                <p class="text-xs font-bold uppercase tracking-wider text-green-600">
                                    Total User
                                </p>

                                <p class="mt-0.5 text-2xl font-bold text-green-800">
                                    {{ $users->count() }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                DATA PENGGUNA
            ====================================================== --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">


                {{-- HEADER DATA --}}
                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h2 class="text-lg font-bold text-gray-900">
                                Data Pengguna
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Daftar seluruh akun pengguna yang terdaftar.
                            </p>

                        </div>


                        {{-- TAMBAH PENGGUNA --}}
                        <a
                            href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-green-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-green-700 hover:shadow-md"
                        >
                            <span class="text-lg leading-none">
                                +
                            </span>

                            Tambah Pengguna
                        </a>

                    </div>

                </div>


                {{-- =================================================
                    TABLE
                ================================================== --}}
                <div class="p-5 sm:p-6">

                    @if($users->count() > 0)

                        <div class="overflow-x-auto rounded-xl border border-gray-100">

                            <table class="min-w-full divide-y divide-gray-200">


                                {{-- TABLE HEADER --}}
                                <thead class="bg-gray-50">

                                    <tr>

                                        <th class="w-16 px-5 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">
                                            No
                                        </th>

                                        <th class="min-w-[220px] px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                            Pengguna
                                        </th>

                                        <th class="min-w-[240px] px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                            Email
                                        </th>

                                        <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                            Role
                                        </th>

                                        <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                            Dibuat
                                        </th>

                                        <th class="min-w-[150px] px-5 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                {{-- TABLE BODY --}}
                                <tbody class="divide-y divide-gray-100 bg-white">

                                    @foreach($users as $user)

                                        <tr class="transition hover:bg-green-50/40">


                                            {{-- NO --}}
                                            <td class="px-5 py-4 text-center text-sm font-medium text-gray-400">
                                                {{ $loop->iteration }}
                                            </td>


                                            {{-- PENGGUNA --}}
                                            <td class="px-5 py-4">

                                                <div class="flex items-center gap-3">

                                                    {{-- AVATAR --}}
                                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 font-bold uppercase text-green-700">

                                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                                    </div>


                                                    <div class="min-w-0">

                                                        <p class="truncate font-semibold text-gray-800">
                                                            {{ $user->name }}
                                                        </p>

                                                        <p class="mt-0.5 text-xs text-gray-400">
                                                            ID #{{ $user->id }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- EMAIL --}}
                                            <td class="px-5 py-4">

                                                <span class="text-sm text-gray-600">
                                                    {{ $user->email }}
                                                </span>

                                            </td>


                                            {{-- ROLE --}}
                                            <td class="whitespace-nowrap px-5 py-4">

                                                @if($user->role === 'admin')

                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                                        Admin

                                                    </span>

                                                @elseif($user->role === 'pengurus')

                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                                        Pengurus

                                                    </span>

                                                @elseif($user->role === 'mahasantri')

                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                                        Mahasantri

                                                    </span>

                                                @else

                                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-600">

                                                        {{ ucfirst($user->role ?? '-') }}

                                                    </span>

                                                @endif

                                            </td>


                                            {{-- TANGGAL --}}
                                            <td class="whitespace-nowrap px-5 py-4">

                                                <span class="text-sm text-gray-500">
                                                    {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                                                </span>

                                            </td>


                                            {{-- AKSI --}}
                                            <td class="px-5 py-4">

                                                <div class="flex items-center justify-center gap-2">


                                                    {{-- EDIT --}}
                                                    <a
                                                        href="{{ route('admin.users.edit', $user) }}"
                                                        class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700 transition hover:border-blue-300 hover:bg-blue-100"
                                                    >
                                                        Edit
                                                    </a>


                                                    {{-- HAPUS --}}
                                                    <form
                                                        method="POST"
                                                        action="{{ route('admin.users.destroy', $user) }}"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}?')"
                                                    >

                                                        @csrf

                                                        @method('DELETE')

                                                        <input
                                                            type="submit"
                                                            value="Hapus"
                                                            class="cursor-pointer rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:border-red-300 hover:bg-red-100"
                                                        >

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                    @else

                        {{-- =================================================
                            EMPTY STATE
                        ================================================== --}}
                        <div class="py-16 text-center">

                            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-green-50 text-3xl">
                                👥
                            </div>

                            <h3 class="text-lg font-bold text-gray-800">
                                Belum Ada Pengguna
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                                Belum terdapat data pengguna pada sistem SmartTren.
                            </p>

                            <a
                                href="{{ route('admin.users.create') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-green-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-green-700"
                            >
                                + Tambah Pengguna
                            </a>

                        </div>

                    @endif

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="mt-5 text-center text-xs text-gray-400">
                SmartTren &bull; Management User
            </div>


        </div>

    </div>

</x-app-layout>