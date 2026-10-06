<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Detail Kegiatan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Informasi lengkap kegiatan SmartTren.
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

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b bg-gradient-to-r from-green-600 to-green-500 px-6 py-6 text-white">

                    <p class="text-sm font-medium text-green-100">
                        KEGIATAN SMARTTREN
                    </p>

                    <h1 class="mt-1 text-2xl font-bold">
                        {{ $kegiatan->nama_kegiatan }}
                    </h1>

                </div>


                {{-- Detail --}}
                <div class="p-6">

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Nama --}}
                        <div class="rounded-xl bg-gray-50 p-5">

                            <p class="text-xs font-bold uppercase text-gray-500">
                                Nama Kegiatan
                            </p>

                            <p class="mt-2 text-lg font-semibold text-gray-800">
                                {{ $kegiatan->nama_kegiatan }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div class="rounded-xl bg-gray-50 p-5">

                            <p class="text-xs font-bold uppercase text-gray-500">
                                Status
                            </p>

                            <div class="mt-2">

                                @if($kegiatan->status === 'aktif')

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                        Nonaktif
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Deskripsi --}}
                        <div class="rounded-xl bg-gray-50 p-5 md:col-span-2">

                            <p class="text-xs font-bold uppercase text-gray-500">
                                Deskripsi
                            </p>

                            <p class="mt-2 leading-7 text-gray-700">
                                {{ $kegiatan->deskripsi ?: 'Tidak ada deskripsi.' }}
                            </p>

                        </div>


                        {{-- Dibuat --}}
                        <div class="rounded-xl bg-gray-50 p-5">

                            <p class="text-xs font-bold uppercase text-gray-500">
                                Dibuat
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $kegiatan->created_at?->format('d F Y, H:i') ?? '-' }}
                            </p>

                        </div>


                        {{-- Diperbarui --}}
                        <div class="rounded-xl bg-gray-50 p-5">

                            <p class="text-xs font-bold uppercase text-gray-500">
                                Terakhir Diperbarui
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $kegiatan->updated_at?->format('d F Y, H:i') ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="mt-8 flex flex-wrap justify-end gap-3 border-t pt-6">

                        <a
                            href="{{ route('admin.kegiatan.index') }}"
                            class="rounded-xl bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition"
                        >
                            Kembali
                        </a>

                        <a
                            href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                            class="rounded-xl bg-yellow-500 px-5 py-3 text-sm font-semibold text-white hover:bg-yellow-600 transition"
                        >
                            Edit Kegiatan
                        </a>

                        <form
                            action="{{ route('admin.kegiatan.destroy', $kegiatan) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kegiatan {{ $kegiatan->nama_kegiatan }}?')"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white hover:bg-red-700 transition"
                            >
                                Hapus Kegiatan
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>