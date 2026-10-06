<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Edit Mahasantri
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui data {{ $mahasantri->nama }}
            </p>
        </div>
    </x-slot>

    <div class="bg-gray-100 py-8">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-8 shadow">

                <form action="{{ route('admin.mahasantri.update', $mahasantri) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div class="md:col-span-2">

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                   name="nama"
                                   value="{{ old('nama', $mahasantri->nama) }}"
                                   required
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                        </div>

                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                NIS
                            </label>

                            <input type="text"
                                   name="nis"
                                   value="{{ old('nis', $mahasantri->nis) }}"
                                   required
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                        </div>

                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Email Login
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $mahasantri->user->email ?? '') }}"
                                   required
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                        </div>

                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Jenis Kelamin
                            </label>

                            <select name="jenis_kelamin"
                                    required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                <option value="L" @selected($mahasantri->jenis_kelamin === 'L')>
                                    Laki-laki
                                </option>

                                <option value="P" @selected($mahasantri->jenis_kelamin === 'P')>
                                    Perempuan
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Kamar
                            </label>

                            <input type="text"
                                   name="kamar"
                                   value="{{ old('kamar', $mahasantri->kamar) }}"
                                   required
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                        </div>

                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                No. HP
                            </label>

                            <input type="text"
                                   name="no_hp"
                                   value="{{ old('no_hp', $mahasantri->no_hp) }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                        </div>

                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Status
                            </label>

                            <select name="status"
                                    required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                <option value="aktif" @selected($mahasantri->status === 'aktif')>
                                    Aktif
                                </option>

                                <option value="nonaktif" @selected($mahasantri->status === 'nonaktif')>
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t pt-6">

                        <a href="{{ route('admin.mahasantri.index') }}"
                           class="rounded-lg bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300">
                            Batal
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white hover:bg-green-700">
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>