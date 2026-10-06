<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Data Kegiatan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola kegiatan SmartTren yang digunakan untuk presensi.
                </p>
            </div>

            <a
                href="{{ route('admin.kegiatan.create') }}"
                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition"
            >
                + Tambah Kegiatan
            </a>

        </div>

    </x-slot>


    <div class="bg-gray-100 py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if(session('success'))

                <div class="mb-6 rounded-lg bg-green-100 px-5 py-4 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>

            @endif


            {{-- Statistik --}}
            <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-3">

                {{-- Total --}}
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">

                    <p class="text-sm text-gray-500">
                        Total Kegiatan
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-800">
                        {{ $kegiatan->total() }}
                    </p>

                </div>


                {{-- Aktif --}}
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">

                    <p class="text-sm text-gray-500">
                        Kegiatan Aktif
                    </p>

                    <p class="mt-2 text-3xl font-bold text-green-600">
                        {{ $kegiatan->where('status', 'aktif')->count() }}
                    </p>

                </div>


                {{-- Nonaktif --}}
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">

                    <p class="text-sm text-gray-500">
                        Kegiatan Nonaktif
                    </p>

                    <p class="mt-2 text-3xl font-bold text-red-600">
                        {{ $kegiatan->where('status', 'nonaktif')->count() }}
                    </p>

                </div>

            </div>


            {{-- Tabel --}}
            <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b px-6 py-5">

                    <div>

                        <h3 class="text-lg font-bold text-gray-800">
                            Daftar Kegiatan
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Kegiatan yang tersedia untuk sistem presensi.
                        </p>

                    </div>

                    <a
                        href="{{ route('admin.kegiatan.create') }}"
                        class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition"
                    >
                        + Tambah
                    </a>

                </div>


                {{-- Isi Tabel --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr class="border-b">

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                    Nama Kegiatan
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                    Deskripsi
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold uppercase text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold uppercase text-gray-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse($kegiatan as $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Nomor --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">

                                        {{ $loop->iteration + (($kegiatan->currentPage() - 1) * $kegiatan->perPage()) }}

                                    </td>


                                    {{-- Nama --}}
                                    <td class="px-6 py-4">

                                        <div class="font-semibold text-gray-800">
                                            {{ $item->nama_kegiatan }}
                                        </div>

                                    </td>


                                    {{-- Deskripsi --}}
                                    <td class="px-6 py-4">

                                        <div class="max-w-md text-sm text-gray-600">

                                            {{ $item->deskripsi ?: '-' }}

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4 text-center">

                                        @if($item->status === 'aktif')

                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Aktif
                                            </span>

                                        @else

                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Nonaktif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">

                                        <div class="flex flex-wrap justify-center gap-2">

                                            {{-- Detail --}}
                                            <a
                                                href="{{ route('admin.kegiatan.show', $item) }}"
                                                class="rounded-lg bg-blue-100 px-3 py-2 text-xs font-semibold text-blue-700 hover:bg-blue-200 transition"
                                            >
                                                Detail
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('admin.kegiatan.edit', $item) }}"
                                                class="rounded-lg bg-yellow-100 px-3 py-2 text-xs font-semibold text-yellow-700 hover:bg-yellow-200 transition"
                                            >
                                                Edit
                                            </a>


                                            {{-- Hapus --}}
                                            <form
                                                action="{{ route('admin.kegiatan.destroy', $item) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kegiatan {{ $item->nama_kegiatan }}?')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-200 transition"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- Data Kosong --}}
                                <tr>

                                    <td
                                        colspan="5"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div class="text-gray-500">

                                            <div class="mb-3 text-5xl">
                                                📋
                                            </div>

                                            <h3 class="text-lg font-semibold text-gray-700">
                                                Belum Ada Kegiatan
                                            </h3>

                                            <p class="mt-1 text-sm">
                                                Silakan tambahkan kegiatan terlebih dahulu.
                                            </p>

                                            <a
                                                href="{{ route('admin.kegiatan.create') }}"
                                                class="mt-5 inline-block rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white hover:bg-green-700 transition"
                                            >
                                                + Tambah Kegiatan
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($kegiatan->hasPages())

                    <div class="border-t px-6 py-4">

                        {{ $kegiatan->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>