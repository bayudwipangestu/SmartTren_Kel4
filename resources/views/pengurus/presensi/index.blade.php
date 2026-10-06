<x-app-layout>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Presensi
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola sesi dan presensi mahasantri.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-5 rounded-xl bg-green-50 px-4 py-3
                            text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Kegiatan</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Jam</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @forelse($sesi as $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        {{ $sesi->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->kegiatan->nama_kegiatan }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->tanggal->format('d-m-Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->jam_mulai }}
                                        -
                                        {{ $item->jam_selesai }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if($item->status === 'aktif')

                                            <span class="rounded-full bg-green-100
                                                px-3 py-1 text-xs font-semibold
                                                text-green-700">
                                                Aktif
                                            </span>

                                        @elseif($item->status === 'selesai')

                                            <span class="rounded-full bg-gray-100
                                                px-3 py-1 text-xs font-semibold
                                                text-gray-700">
                                                Selesai
                                            </span>

                                        @else

                                            <span class="rounded-full bg-red-100
                                                px-3 py-1 text-xs font-semibold
                                                text-red-700">
                                                Dibatalkan
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex flex-wrap gap-2">

                                            @if($item->status === 'aktif')

                                                <a href="{{ route(
                                                    'pengurus.presensi.scanner',
                                                    $item
                                                ) }}"
                                                class="rounded-lg bg-green-600
                                                       px-3 py-2 text-xs
                                                       font-semibold text-white
                                                       hover:bg-green-700">
                                                    Scan QR
                                                </a>

                                            @endif

                                            <a href="{{ route(
                                                'pengurus.presensi.rekap',
                                                $item
                                            ) }}"
                                            class="rounded-lg bg-blue-100
                                                   px-3 py-2 text-xs
                                                   font-semibold text-blue-700
                                                   hover:bg-blue-200">
                                                Rekap
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-10 text-center
                                               text-gray-500">
                                        Belum ada sesi presensi.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

                <div class="border-t px-6 py-4">
                    {{ $sesi->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>