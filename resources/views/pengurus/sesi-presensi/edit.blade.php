<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold mb-4">Edit Sesi Presensi</h2>
            
            <form action="{{ route('pengurus.sesi-presensi.update', $sesiPresensi->id ?? 1) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Pilih Kegiatan</label>
                    <select name="kegiatan_id" class="w-full border-gray-300 rounded-md">
                        @foreach($kegiatan as $k)
                            <!-- Sesuaikan variabel $sesiPresensi dengan yang dikirim dari controller -->
                            <option value="{{ $k->id }}">{{ $k->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Waktu Mulai</label>
                    <input type="datetime-local" name="waktu_mulai" class="w-full border-gray-300 rounded-md" required>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>