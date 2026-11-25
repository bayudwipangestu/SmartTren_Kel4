<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="margin: 0; font-size: 22px; font-weight: 700; color: #1f2937;">Laporan Presensi</h2>
            <p style="margin: 4px 0 0; font-size: 14px; color: #6b7280;">Rekapitulasi kehadiran seluruh mahasantri berdasarkan periode dan kegiatan.</p>
        </div>
    </x-slot>

    <div style="max-width: 1150px; margin: 0 auto;">
        {{-- RINGKASAN --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
            <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 18px 20px;">
                <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Total Hadir</div>
                <div style="font-size: 26px; font-weight: 800; color: #059669; margin-top: 4px;">{{ $totalHadir ?? 0 }}</div>
            </div>
            <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 18px 20px;">
                <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Total Izin</div>
                <div style="font-size: 26px; font-weight: 800; color: #2563eb; margin-top: 4px;">{{ $totalIzin ?? 0 }}</div>
            </div>
            <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 18px 20px;">
                <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Total Sakit</div>
                <div style="font-size: 26px; font-weight: 800; color: #d97706; margin-top: 4px;">{{ $totalSakit ?? 0 }}</div>
            </div>
            <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 18px 20px;">
                <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Total Alpa</div>
                <div style="font-size: 26px; font-weight: 800; color: #dc2626; margin-top: 4px;">{{ $totalAlpa ?? 0 }}</div>
            </div>
        </div>

        {{-- FILTER & TABEL --}}
        <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 18px; overflow: hidden; box-shadow: 0 6px 24px rgba(0,0,0,.04);">
            <div style="padding: 20px 24px; border-bottom: 1px solid #f1f5f9;">
                <form method="GET" action="{{ route('pengurus.laporan-presensi') }}" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                    <select name="periode" style="padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 13px;">
                        <option value="semua" {{ ($periode ?? 'semua') === 'semua' ? 'selected' : '' }}>Semua Periode</option>
                        <option value="harian" {{ ($periode ?? '') === 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="bulanan" {{ ($periode ?? '') === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ ($periode ?? '') === 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                    </select>

                    <input type="date" name="tanggal" value="{{ $tanggal ?? now()->toDateString() }}" style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 13px;">

                    <select name="kegiatan_id" style="padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 13px;">
                        <option value="">Semua Kegiatan</option>
                        @foreach($kegiatan ?? [] as $k)
                            <option value="{{ $k->id }}" {{ ($kegiatanId ?? '') == $k->id ? 'selected' : '' }}>{{ $k->nama_kegiatan }}</option>
                        @endforeach
                    </select>

                    <select name="status" style="padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 13px;">
                        <option value="">Semua Status</option>
                        <option value="hadir" {{ ($status ?? '') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ ($status ?? '') === 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ ($status ?? '') === 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpa" {{ ($status ?? '') === 'alpa' ? 'selected' : '' }}>Alpa</option>
                    </select>

                    <button type="submit" style="padding: 9px 16px; background: #059669; color: #fff; border: none; border-radius: 10px; font-size: 13px; font-weight: 700; cursor: pointer;">
                        Terapkan Filter
                    </button>

                    <a href="{{ route('pengurus.laporan-presensi') }}" style="padding: 9px 14px; background: #f3f4f6; color: #374151; text-decoration: none; border-radius: 10px; font-size: 13px; font-weight: 600;">
                        Reset
                    </a>
                </form>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                    <thead style="background: #f8fafc; border-bottom: 1px solid #e5e7eb;">
                        <tr>
                            <th style="padding: 14px 20px; font-size: 12px; color: #4b5563; text-transform: uppercase;">No</th>
                            <th style="padding: 14px 20px; font-size: 12px; color: #4b5563; text-transform: uppercase;">Mahasantri</th>
                            <th style="padding: 14px 20px; font-size: 12px; color: #4b5563; text-transform: uppercase;">NIM</th>
                            <th style="padding: 14px 20px; font-size: 12px; color: #4b5563; text-transform: uppercase;">Kegiatan</th>
                            <th style="padding: 14px 20px; font-size: 12px; color: #4b5563; text-transform: uppercase;">Tanggal</th>
                            <th style="padding: 14px 20px; font-size: 12px; color: #4b5563; text-transform: uppercase;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presensi ?? [] as $item)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 14px 20px;">{{ $loop->iteration }}</td>
                                <td style="padding: 14px 20px; font-weight: 700; color: #111827;">{{ $item->mahasantri->user->name ?? $item->mahasantri->nama ?? '-' }}</td>
                                <td style="padding: 14px 20px;">{{ $item->mahasantri->nim ?? '-' }}</td>
                                <td style="padding: 14px 20px;">{{ $item->sesiPresensi->kegiatan->nama_kegiatan ?? '-' }}</td>
                                <td style="padding: 14px 20px;">
                                    {{ isset($item->sesiPresensi->tanggal) ? \Carbon\Carbon::parse($item->sesiPresensi->tanggal)->format('d-m-Y') : '-' }}
                                </td>
                                <td style="padding: 14px 20px; font-weight: 700; text-transform: capitalize;">
                                    {{ $item->status }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 36px 20px; text-align: center; color: #6b7280;">
                                    Belum ada data presensi untuk filter yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>