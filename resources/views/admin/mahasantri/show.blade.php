<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Detail Mahasantri
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informasi lengkap mahasantri
            </p>
        </div>

    </x-slot>

    <div class="bg-gray-100 py-8">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-xl bg-white shadow">

                {{-- Header --}}
                <div class="bg-green-600 px-8 py-8 text-white">

                    <div class="flex items-center gap-5">

                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white text-3xl font-bold text-green-600">

                            {{ strtoupper(substr($mahasantri->nama, 0, 1)) }}

                        </div>

                        <div>

                            <h3 class="text-2xl font-bold">
                                {{ $mahasantri->nama }}
                            </h3>

                            <p class="mt-1 text-green-100">
                                NIS: {{ $mahasantri->nis }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Detail --}}
                <div class="p-8">

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>
                            <p class="text-sm text-gray-500">
                                Nama Lengkap
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $mahasantri->nama }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                NIS
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $mahasantri->nis }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Email
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $mahasantri->user->email ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Jenis Kelamin
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $mahasantri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Kamar
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $mahasantri->kamar }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                No. HP
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $mahasantri->no_hp ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <div class="mt-2">

                                @if($mahasantri->status === 'aktif')

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Nonaktif
                                    </span>

                                @endif

                            </div>

                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                ID QR
                            </p>

                            <p class="mt-1 font-mono font-semibold text-gray-800">
                                {{ $mahasantri->qr_code }}
                            </p>
                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="mt-8 flex flex-wrap gap-3 border-t pt-6">

                        <a href="{{ route('admin.mahasantri.index') }}"
                           class="rounded-lg bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300">
                            Kembali
                        </a>

                        <a href="{{ route('admin.mahasantri.edit', $mahasantri) }}"
                           class="rounded-lg bg-yellow-500 px-5 py-3 text-sm font-semibold text-white hover:bg-yellow-600">
                            Edit Data
                        </a>

                        <form action="{{ route('admin.mahasantri.destroy', $mahasantri) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="rounded-lg bg-red-600 px-5 py-3 text-sm font-semibold text-white hover:bg-red-700">
                                Hapus Data
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>