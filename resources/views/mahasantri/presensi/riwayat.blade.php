<x-app-layout>
    <div class="p-8">
        <h2 class="text-2xl font-bold mb-6">Riwayat Presensi</h2>
        <div class="bg-white rounded-lg shadow p-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Kegiatan</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $item)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4">{{ $item->sesiPresensi->kegiatan->nama_kegiatan ?? 'Kegiatan Tidak Diketahui' }}</td>
                        <td class="py-3 px-4 font-bold">{{ $item->status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">Belum ada data riwayat presensi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>