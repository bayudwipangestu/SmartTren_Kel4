
<x-admin-layout title="Rekap & Laporan" breadcrumb="Rekap & Laporan">

    <div class="mb-8">
        <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-green-700">
            PUSAT LAPORAN
        </p>
        <h1 class="text-2xl font-bold text-gray-900">
            Rekap & Laporan Presensi
        </h1>
        <p class="mt-2 text-sm text-gray-500">
            Filter data kehadiran Mahasantri dan cetak laporan dalam format PDF.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-1 font-semibold">Periksa filter laporan:</p>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.laporan.index') }}"
          class="mb-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="mb-5">
            <h2 class="text-lg font-bold text-gray-900">Filter Laporan</h2>
            <p class="mt-1 text-sm text-gray-500">
                Kosongkan filter yang tidak ingin digunakan.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

            <div>
                <label for="dari" class="mb-2 block text-sm font-medium text-gray-700">
                    Dari tanggal
                </label>
                <input id="dari" name="dari" type="date"
                       value="{{ $filters['dari'] ?? '' }}"
                       class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600">
            </div>

            <div>
                <label for="sampai" class="mb-2 block text-sm font-medium text-gray-700">
                    Sampai tanggal
                </label>
                <input id="sampai" name="sampai" type="date"
                       value="{{ $filters['sampai'] ?? '' }}"
                       class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600">
            </div>

            <div>
                <label for="kegiatan_id" class="mb-2 block text-sm font-medium text-gray-700">
                    Kegiatan
                </label>
                <select id="kegiatan_id" name="kegiatan_id"
                        class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600">
                    <option value="">Semua kegiatan</option>
                    @foreach($kegiatan as $item)
                        <option value="{{ $item->id }}"
                            @selected((string)($filters['kegiatan_id'] ?? '') === (string)$item->id)>
                            {{ $item->nama_kegiatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kamar" class="mb-2 block text-sm font-medium text-gray-700">
                    Kamar
                </label>
                <select id="kamar" name="kamar"
                        class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600">
                    <option value="">Semua kamar</option>
                    @foreach($kamar as $namaKamar)
                        <option value="{{ $namaKamar }}"
                            @selected(($filters['kamar'] ?? '') === $namaKamar)>
                            {{ $namaKamar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="search" class="mb-2 block text-sm font-medium text-gray-700">
                    Nama atau NIM
                </label>
                <input id="search" name="search" type="text"
                       value="{{ $filters['search'] ?? '' }}"
                       placeholder="Cari Mahasantri..."
                       class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600">
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium text-gray-700">
                    Status kehadiran
                </label>
                <select id="status" name="status"
                        class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600">
                    <option value="">Semua status</option>
                    @foreach(['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'] as $value => $label)
                        <option value="{{ $value }}"
                            @selected(($filters['status'] ?? '') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <button type="submit"
                    class="rounded-xl bg-green-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-800">
                Terapkan Filter
            </button>

            <a href="{{ route('admin.laporan.index') }}"
               class="rounded-xl border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                Reset
            </a>

            <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
               class="rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                Cetak / Unduh PDF
            </a>
        </div>
    </form>

    {{-- Statistik --}}
    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">

        @foreach([
            ['label' => 'Total Presensi', 'value' => $statistik['total'], 'color' => 'text-gray-900'],
            ['label' => 'Hadir', 'value' => $statistik['hadir'], 'color' => 'text-green-700'],
            ['label' => 'Izin', 'value' => $statistik['izin'], 'color' => 'text-blue-700'],
            ['label' => 'Sakit', 'value' => $statistik['sakit'], 'color' => 'text-amber-700'],
            ['label' => 'Alpa', 'value' => $statistik['alpa'], 'color' => 'text-red-700'],
        ] as $card)
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">{{ $card['label'] }}</p>
                <p class="mt-3 text-3xl font-bold {{ $card['color'] }}">
                    {{ $card['value'] }}
                </p>
            </div>
        @endforeach

    </div>

    {{-- Tabel --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 px-6 py-5">
            <h2 class="text-lg font-bold text-gray-900">Hasil Rekap Presensi</h2>
            <p class="mt-1 text-sm text-gray-500">
                Daftar presensi sesuai filter yang diterapkan.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">No.</th>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">Mahasantri</th>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">NIM</th>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">Kamar</th>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">Kegiatan</th>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">Tanggal</th>
                        <th class="px-5 py-4 text-xs font-semibold uppercase text-gray-500">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($laporan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 text-sm text-gray-500">
                                {{ $laporan->firstItem() + $loop->index }}
                            </td>
                            <td class="px-5 py-4 text-sm font-semibold text-gray-900">
                                {{ $item->mahasantri?->nama ?? '-' }}
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-600">
                                {{ $item->mahasantri?->nim ?? '-' }}
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-600">
                                {{ $item->mahasantri?->kamar ?? '-' }}
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-600">
                                {{ $item->sesiPresensi?->kegiatan?->nama_kegiatan ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-600">
                                {{ $item->sesiPresensi?->tanggal?->format('d/m/Y') ?? '-' }}
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $warnaStatus = [
                                        'hadir' => 'bg-green-50 text-green-700',
                                        'izin' => 'bg-blue-50 text-blue-700',
                                        'sakit' => 'bg-amber-50 text-amber-700',
                                        'alpa' => 'bg-red-50 text-red-700',
                                    ];
                                @endphp
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $warnaStatus[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <p class="text-lg font-semibold text-gray-800">
                                    Data presensi tidak ditemukan
                                </p>
                                <p class="mt-2 text-sm text-gray-500">
                                    Coba ubah filter atau pilih periode yang berbeda.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($laporan->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">
                {{ $laporan->links() }}
            </div>
        @endif

    </div>

</x-admin-layout>
