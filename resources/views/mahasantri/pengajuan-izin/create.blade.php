 <x-app-layout>
    <div class="min-h-screen bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">

            {{-- Header --}}
            <div class="mb-6 rounded-2xl bg-gradient-to-r from-green-900 to-green-700 p-6 text-white shadow-lg">
                <a href="{{ route('mahasantri.pengajuan-izin.index') }}"
                   class="text-sm font-medium text-green-100 hover:text-white">
                    &larr; Kembali ke Riwayat
                </a>

                <h1 class="mt-4 text-2xl font-bold sm:text-3xl">
                    Formulir Izin / Sakit
                </h1>

                <p class="mt-2 text-sm leading-6 text-green-100">
                    Pilih kegiatan dan tanggal yang ingin diajukan, lalu lengkapi alasan pengajuan.
                </p>
            </div>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="mb-2 font-bold">
                        Pengajuan belum berhasil dikirim:
                    </p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulir --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                    <h2 class="text-lg font-bold text-gray-800">
                        Data Pengajuan
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Lengkapi informasi berikut. Kolom bertanda
                        <span class="font-bold text-red-500">*</span>
                        wajib diisi.
                    </p>
                </div>

                <form
                    action="{{ route('mahasantri.pengajuan-izin.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6 p-6 sm:p-8"
                >
                    @csrf

                    {{-- Kegiatan --}}
                    <div>
                        <label for="kegiatan_id"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Kegiatan
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="kegiatan_id"
                            id="kegiatan_id"
                            required
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600"
                        >
                            <option value="">-- Pilih Kegiatan --</option>

                            @forelse ($kegiatans as $kegiatan)
                                <option
                                    value="{{ $kegiatan->id }}"
                                    @selected((string) old('kegiatan_id') === (string) $kegiatan->id)
                                >
                                    {{ $kegiatan->nama_kegiatan }}
                                </option>
                            @empty
                                <option value="" disabled>
                                    Belum ada kegiatan yang tersedia
                                </option>
                            @endforelse
                        </select>

                        @error('kegiatan_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        @if ($kegiatans->isEmpty())
                            <p class="mt-2 text-sm text-amber-700">
                                Belum ada data kegiatan. Silakan hubungi pengurus.
                            </p>
                        @endif
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="tanggal"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Tanggal Kegiatan
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            value="{{ old('tanggal') }}"
                            required
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600"
                        >

                        @error('tanggal')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-xs text-gray-500">
                            Pilih tanggal kegiatan yang ingin kamu ajukan.
                        </p>
                    </div>

                    {{-- Jenis pengajuan --}}
                    <div>
                        <label for="jenis"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Jenis Pengajuan
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="jenis"
                            id="jenis"
                            required
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600"
                        >
                            <option value="">-- Pilih Jenis Pengajuan --</option>

                            <option value="izin" @selected(old('jenis') === 'izin')>
                                Izin
                            </option>

                            <option value="sakit" @selected(old('jenis') === 'sakit')>
                                Sakit
                            </option>
                        </select>

                        @error('jenis')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Alasan --}}
                    <div>
                        <label for="alasan"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Alasan Pengajuan
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="alasan"
                            name="alasan"
                            rows="4"
                            maxlength="2000"
                            required
                            placeholder="Jelaskan alasan izin atau sakit kamu..."
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-green-600 focus:ring-green-600"
                        >{{ old('alasan') }}</textarea>

                        <p class="mt-2 text-xs text-gray-500">
                            Maksimal 2.000 karakter.
                        </p>

                        @error('alasan')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Bukti foto --}}
                    <div>
                        <label for="bukti_foto"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Bukti Foto
                            <span class="font-normal text-gray-400">(opsional)</span>
                        </label>

                        <input
                            id="bukti_foto"
                            name="bukti_foto"
                            type="file"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full rounded-xl border border-gray-300 bg-white p-3 text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:font-semibold file:text-green-800 hover:file:bg-green-100"
                        >

                        <p class="mt-2 text-xs text-gray-500">
                            Format JPG, JPEG, PNG, atau WebP. Maksimal 5 MB.
                        </p>

                        @error('bukti_foto')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Informasi --}}
                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
                        <p class="text-sm font-semibold text-amber-900">
                            Informasi Pengajuan
                        </p>

                        <p class="mt-1 text-sm leading-6 text-amber-800">
                            Setelah dikirim, pengajuan berstatus Menunggu.
                            Pengurus akan memeriksa pengajuan dan menentukan
                            apakah pengajuan disetujui atau ditolak.
                        </p>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('mahasantri.pengajuan-izin.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            @disabled($kegiatans->isEmpty())
                            class="inline-flex items-center justify-center rounded-xl bg-green-700 px-6 py-3 text-sm font-bold text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-200 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            Kirim Pengajuan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>