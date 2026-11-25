<x-app-layout>
    <div style="display: flex; min-height: calc(100vh - 65px); background: #f6f8f7; width: 100%;">
        
        <!-- SIDEBAR KIRI -->
        <aside style="width: 260px; background: white; border-right: 1px solid #e1e8e4; padding: 24px; flex-shrink: 0;">
            <div style="margin-bottom: 32px;">
                <h2 style="font-size: 22px; font-weight: 900; color: #087443; margin: 0;">SmartTren</h2>
                <p style="font-size: 12px; color: #7a8780; margin: 4px 0 0 0;">Sistem Presensi</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <p style="font-size: 11px; font-weight: 800; color: #a0aec0; letter-spacing: 1px; margin-bottom: 8px;">MENU UTAMA</p>
                <a href="{{ route('mahasantri.dashboard') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Dashboard</a>
                <a href="{{ route('mahasantri.presensi.index') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Presensi Kegiatan</a>
                <a href="{{ route('mahasantri.presensi.riwayat') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Riwayat Presensi</a>
                <a href="{{ route('mahasantri.presensi.rekap') }}" style="text-decoration: none; padding: 12px 16px; background: #eaf8f0; color: #087443; border-radius: 12px; font-weight: 700; font-size: 14px; display: block;">Rekap Kehadiran</a>
                <a href="{{ route('mahasantri.akun') }}" style="text-decoration: none; padding: 12px 16px; color: #7a8780; border-radius: 12px; font-weight: 600; font-size: 14px; display: block;">Data Akun</a>
            </div>
        </aside>

        <!-- KONTEN KANAN -->
        <main style="flex: 1; padding: 32px; overflow-y: auto;">
            <div style="max-width: 1000px; margin: 0 auto;">
                
                <div style="display: flex; align-items: center; justify-content: between; margin-bottom: 24px;">
                    <h2 style="font-size: 24px; font-weight: 800; color: #17231e; margin: 0;">Rekap Kehadiran</h2>
                </div>

                <!-- FILTER BOX -->
                <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e1e8e4; margin-bottom: 24px; box-shadow: 0 4px 15px rgba(31,55,43,.03);">
                    <form method="GET" action="{{ route('mahasantri.presensi.rekap') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) gap: 16px; align-items: end;">
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 800; color: #7a8780; margin-bottom: 6px;">Kegiatan</label>
                            <select name="kegiatan_id" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 10px; padding: 8px 12px; font-size: 13px; background: white;">
                                <option value="">Semua Kegiatan</option>
                                @foreach($kegiatans as $kegiatan)
                                    <option value="{{ $kegiatan->id }}" {{ request('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>{{ $kegiatan->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 800; color: #7a8780; margin-bottom: 6px;">Dari Tanggal</label>
                            <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 10px; padding: 8px 12px; font-size: 13px;">
                        </div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 800; color: #7a8780; margin-bottom: 6px;">Sampai Tanggal</label>
                            <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 10px; padding: 8px 12px; font-size: 13px;">
                        </div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 800; color: #7a8780; margin-bottom: 6px;">Status</label>
                            <select name="status" style="width: 100%; border: 1px solid #e1e8e4; border-radius: 10px; padding: 8px 12px; font-size: 13px; background: white;">
                                <option value="">Semua Status</option>
                                <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="Sakit" {{ request('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                <option value="Alpa" {{ request('status') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                            </select>
                        </div>
                        <div style="display: flex; gap: 8px; margin-bottom: 12px;">
                            <button type="submit" style="background: #087443; color: white; border: none; padding: 9px 16px; border-radius: 10px; font-weight: 700; font-size: 13px; cursor: pointer; flex: 1;">Filter</button>
                            <a href="{{ route('mahasantri.presensi.rekap') }}" style="background: #e2e8f0; color: #475569; text-decoration: none; padding: 9px 14px; border-radius: 10px; font-weight: 700; font-size: 13px; text-align: center;">Reset</a>
                        </div>
                    </form>
                </div>

                <!-- BOX REKAP COUNTER -->
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
                    <div style="background: white; padding: 20px; border-radius: 16px; border-bottom: 4px solid #10b981; border-left: 1px solid #e1e8e4; border-right: 1px solid #e1e8e4; border-top: 1px solid #e1e8e4; text-align: center;">
                        <span style="font-size: 12px; font-weight: 700; color: #7a8780;">Hadir</span>
                        <div style="font-size: 28px; font-weight: 900; color: #10b981; margin-top: 4px;">{{ $dataRekap['Hadir'] }}</div>
                    </div>
                    <div style="background: white; padding: 20px; border-radius: 16px; border-bottom: 4px solid #f59e0b; border-left: 1px solid #e1e8e4; border-right: 1px solid #e1e8e4; border-top: 1px solid #e1e8e4; text-align: center;">
                        <span style="font-size: 12px; font-weight: 700; color: #7a8780;">Sakit</span>
                        <div style="font-size: 28px; font-weight: 900; color: #f59e0b; margin-top: 4px;">{{ $dataRekap['Sakit'] }}</div>
                    </div>
                    <div style="background: white; padding: 20px; border-radius: 16px; border-bottom: 4px solid #3b82f6; border-left: 1px solid #e1e8e4; border-right: 1px solid #e1e8e4; border-top: 1px solid #e1e8e4; text-align: center;">
                        <span style="font-size: 12px; font-weight: 700; color: #7a8780;">Izin</span>
                        <div style="font-size: 28px; font-weight: 900; color: #3b82f6; margin-top: 4px;">{{ $dataRekap['Izin'] }}</div>
                    </div>
                    <div style="background: white; padding: 20px; border-radius: 16px; border-bottom: 4px solid #ef4444; border-left: 1px solid #e1e8e4; border-right: 1px solid #e1e8e4; border-top: 1px solid #e1e8e4; text-align: center;">
                        <span style="font-size: 12px; font-weight: 700; color: #7a8780;">Alpa</span>
                        <div style="font-size: 28px; font-weight: 900; color: #ef4444; margin-top: 4px;">{{ $dataRekap['Alpa'] }}</div>
                    </div>
                </div>

                <!-- TABEL RINCIAN -->
                <div style="background: white; border-radius: 20px; border: 1px solid #e1e8e4; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #e1e8e4; color: #475569;">
                                <th style="padding: 16px 24px; font-weight: 800;">Tanggal</th>
                                <th style="padding: 16px 24px; font-weight: 800;">Kegiatan / Keterangan</th>
                                <th style="padding: 16px 24px; font-weight: 800;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $item)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 24px; color: #334155;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                <td style="padding: 16px 24px; color: #334155; font-weight: 600;">{{ $item->kegiatan }}</td>
                                <td style="padding: 16px 24px; font-weight: 800;">
                                    @if($item->status == 'Hadir') <span style="color: #10b981;">Hadir</span>
                                    @elseif($item->status == 'Sakit') <span style="color: #f59e0b;">Sakit</span>
                                    @elseif($item->status == 'Izin') <span style="color: #3b82f6;">Izin</span>
                                    @else <span style="color: #ef4444;">Alpa</span> @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 32px; text-align: center; color: #94a3b8;">Tidak ada data ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>