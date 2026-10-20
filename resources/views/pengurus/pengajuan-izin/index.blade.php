<x-app-layout>
<div class="pi-page">
    <div class="pi-heading">
        <div>
            <div class="pi-breadcrumb">SmartTren / Pengurus / Pengajuan Izin</div>
            <h1>Pengajuan Izin & Sakit</h1>
            <p>Periksa pengajuan mahasantri dan tentukan persetujuannya.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="pi-alert pi-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="pi-alert pi-error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="pi-alert pi-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="pi-card">
        <div class="pi-card-heading">
            <div>
                <h2>Daftar Pengajuan</h2>
                <p>Tinjau alasan dan status pengajuan sebelum mengambil tindakan.</p>
            </div>
            <span class="pi-count">{{ $pengajuans->total() }} pengajuan</span>
        </div>

        <form method="GET"
              action="{{ route('pengurus.pengajuan-izin.index') }}"
              class="pi-filter">
            <div class="pi-field">
                <label for="status">Filter status</label>
                <select name="status" id="status">
                    <option value="">Semua status</option>
                    <option value="menunggu" @selected(request('status') === 'menunggu')>
                        Menunggu
                    </option>
                    <option value="disetujui" @selected(request('status') === 'disetujui')>
                        Disetujui
                    </option>
                    <option value="ditolak" @selected(request('status') === 'ditolak')>
                        Ditolak
                    </option>
                </select>
            </div>

            <button class="pi-btn pi-btn-primary" type="submit">
                Terapkan Filter
            </button>

            <a class="pi-btn pi-btn-light"
               href="{{ route('pengurus.pengajuan-izin.index') }}">
                Reset
            </a>
        </form>

        <div class="pi-table-wrap">
            <table class="pi-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Mahasantri</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuans as $pengajuan)
                        <tr>
                            <td>{{ $pengajuans->firstItem() + $loop->index }}</td>

                            <td>
                                <strong>
                                    {{ $pengajuan->mahasantri->nama ?? 'Mahasantri' }}
                                </strong>
                                @if (!empty($pengajuan->mahasantri->nis))
                                    <small class="pi-muted">
                                        NIS: {{ $pengajuan->mahasantri->nis }}
                                    </small>
                                @endif
                            </td>

                            <td>
                                {{ ucfirst($pengajuan->jenis ?? $pengajuan->tipe ?? 'Izin') }}
                            </td>

                            <td>
                                {{ $pengajuan->tanggal_mulai ?? $pengajuan->tanggal ?? '-' }}
                                @if (!empty($pengajuan->tanggal_selesai))
                                    <small class="pi-muted">
                                        s.d. {{ $pengajuan->tanggal_selesai }}
                                    </small>
                                @endif
                            </td>

                            <td class="pi-reason">
                                {{ $pengajuan->alasan ?? $pengajuan->keterangan ?? '-' }}
                            </td>

                            <td>
                                @php
                                    $status = strtolower($pengajuan->status ?? 'menunggu');
                                @endphp

                                <span class="pi-status pi-status-{{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                @if (strtolower($pengajuan->status ?? 'menunggu') === 'menunggu')
                                    <div class="pi-actions">
                                        <form method="POST"
                                              action="{{ route('pengurus.pengajuan-izin.proses', $pengajuan) }}"
                                              onsubmit="return confirm('Setujui pengajuan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button class="pi-btn pi-btn-approve" type="submit">
                                                Setujui
                                            </button>
                                        </form>

                                        <form method="POST"
                                              action="{{ route('pengurus.pengajuan-izin.proses', $pengajuan) }}"
                                              onsubmit="return confirm('Tolak pengajuan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button class="pi-btn pi-btn-reject" type="submit">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="pi-muted">Sudah diproses</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="pi-empty">
                                <strong>Belum ada pengajuan</strong>
                                <p>Pengajuan izin atau sakit akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pi-pagination">
            {{ $pengajuans->links() }}
        </div>
    </section>
</div>

<style>
.pi-page {
    max-width: 1500px;
    margin: 0 auto;
    padding: 28px;
    color: #19372a;
}
.pi-heading { margin-bottom: 26px; }
.pi-breadcrumb { margin-bottom: 12px; color: #78877d; font-size: 12px; }
.pi-heading h1 { margin: 0; font-size: 30px; font-weight: 800; letter-spacing: -.7px; }
.pi-heading p, .pi-card-heading p { margin: 8px 0 0; color: #78877d; font-size: 13px; }
.pi-card { overflow: hidden; border: 1px solid #e1eae4; border-radius: 16px; background: white; box-shadow: 0 8px 28px rgb(20 55 35 / 4%); }
.pi-card-heading { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 24px; border-bottom: 1px solid #edf1ee; }
.pi-card-heading h2 { margin: 0; font-size: 19px; font-weight: 800; }
.pi-count { padding: 9px 13px; border-radius: 999px; background: #eaf7ef; color: #087f50; font-size: 12px; font-weight: 800; white-space: nowrap; }
.pi-filter { display: flex; align-items: end; flex-wrap: wrap; gap: 12px; padding: 20px 24px; border-bottom: 1px solid #edf1ee; }
.pi-field { display: grid; gap: 7px; min-width: 210px; }
.pi-field label { color: #52645a; font-size: 12px; font-weight: 700; }
.pi-field select { min-height: 44px; padding: 0 12px; border: 1px solid #dce6df; border-radius: 9px; background: #fff; color: #263c30; font: inherit; }
.pi-btn { display: inline-flex; min-height: 40px; align-items: center; justify-content: center; padding: 0 13px; border: 0; border-radius: 9px; font-size: 12px; font-weight: 750; text-decoration: none; cursor: pointer; white-space: nowrap; }
.pi-btn-primary { min-height: 44px; padding: 0 18px; background: #108251; color: white; }
.pi-btn-light { min-height: 44px; padding: 0 18px; background: #f0f3f1; color: #52645a; }
.pi-table-wrap { overflow-x: auto; }
.pi-table { width: 100%; border-collapse: collapse; text-align: left; }
.pi-table th { padding: 15px 16px; background: #f7faf8; color: #708077; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .4px; }
.pi-table td { padding: 17px 16px; border-top: 1px solid #edf1ee; color: #405448; font-size: 12px; vertical-align: middle; }
.pi-table td strong { display: block; color: #19372a; font-size: 12px; }
.pi-muted { display: block; margin-top: 5px; color: #89958d; font-size: 11px; }
.pi-reason { min-width: 150px; max-width: 240px; line-height: 1.7; }
.pi-status { display: inline-block; padding: 7px 10px; border-radius: 999px; background: #f0f3f1; color: #5d6b62; font-size: 11px; font-weight: 800; white-space: nowrap; }
.pi-status-menunggu { background: #fff5dc; color: #946200; }
.pi-status-disetujui { background: #e7f7ed; color: #167747; }
.pi-status-ditolak { background: #ffeded; color: #b42332; }
.pi-actions { display: flex; flex-wrap: wrap; gap: 6px; }
.pi-btn-approve { background: #e5f6eb; color: #167747; }
.pi-btn-reject { background: #ffeded; color: #b42332; }
.pi-alert { margin-bottom: 18px; padding: 13px 16px; border-radius: 10px; font-size: 13px; }
.pi-success { background: #e7f7ed; color: #167747; }
.pi-error { background: #ffeded; color: #b42332; }
.pi-empty { padding: 45px 20px !important; text-align: center; }
.pi-empty p { margin: 7px 0 0; color: #78877d; }
.pi-pagination { padding: 20px 24px; }
@media (max-width: 700px) {
    .pi-page { padding: 16px; }
    .pi-heading h1 { font-size: 25px; }
    .pi-card-heading { align-items: flex-start; padding: 18px; }
    .pi-filter { align-items: stretch; padding: 18px; }
    .pi-field { width: 100%; }
    .pi-filter .pi-btn { width: 100%; }
}
</style>
</x-app-layout>
