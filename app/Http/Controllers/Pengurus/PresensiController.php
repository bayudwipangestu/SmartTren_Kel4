<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Mahasantri;
use App\Models\Presensi;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $sesi = SesiPresensi::with('kegiatan')
            ->latest('tanggal')
            ->paginate(10);

        return view('pengurus.presensi.index', compact('sesi'));
    }

    public function scanner($sesiPresensi)
    {
        $sesi = SesiPresensi::with('kegiatan')->findOrFail($sesiPresensi);
        return view('pengurus.presensi.scanner', compact('sesi'));
    }

    public function scan(Request $request, $sesiPresensi)
    {
        $request->validate(['qr_code' => 'required|string']);

        $sesi = SesiPresensi::findOrFail($sesiPresensi);
        $mahasantri = Mahasantri::where('qr_code', $request->qr_code)->first();

        if (!$mahasantri) {
            return back()->with('error', 'QR Code tidak terdaftar.');
        }

        Presensi::updateOrCreate(
            [
                'sesi_presensi_id' => $sesi->id,
                'mahasantri_id'    => $mahasantri->id,
            ],
            [
                'status'     => 'hadir',
                'waktu_scan' => now(),
            ]
        );

        return back()->with('success', 'Presensi berhasil dicatat untuk ' . ($mahasantri->user->name ?? $mahasantri->nim));
    }

    public function rekap($sesiPresensi)
    {
        $sesi = SesiPresensi::with('kegiatan')->findOrFail($sesiPresensi);
        $presensi = Presensi::with('mahasantri.user')
            ->where('sesi_presensi_id', $sesi->id)
            ->get();
        $riwayatPresensi = $presensi;

        return view('pengurus.presensi.rekap', compact('sesi', 'presensi', 'riwayatPresensi'));
    }

    public function update(Request $request, $presensi)
    {
        $request->validate(['status' => 'required|in:hadir,izin,sakit,alpa,Hadir,Izin,Sakit,Alpa']);

        $data = Presensi::findOrFail($presensi);
        $data->update(['status' => strtolower($request->status)]);

        return back()->with('success', 'Status presensi berhasil diperbarui.');
    }

    public function generateAlpa($sesiPresensi)
    {
        $sesi = SesiPresensi::findOrFail($sesiPresensi);
        $sudahPresensiIds = Presensi::where('sesi_presensi_id', $sesi->id)->pluck('mahasantri_id');
        $belumPresensi = Mahasantri::whereNotIn('id', $sudahPresensiIds)->get();

        foreach ($belumPresensi as $mhs) {
            Presensi::create([
                'sesi_presensi_id' => $sesi->id,
                'mahasantri_id'    => $mhs->id,
                'status'           => 'alpa',
            ]);
        }

        return back()->with('success', count($belumPresensi) . ' mahasantri yang belum hadir ditandai Alpa.');
    }

    public function laporan(Request $request)
    {
        $periode    = $request->get('periode', 'semua');
        $tanggal    = $request->get('tanggal', now()->toDateString());
        $bulan      = $request->get('bulan', now()->month);
        $tahun      = $request->get('tahun', now()->year);
        $kegiatanId = $request->get('kegiatan_id');
        $status     = $request->get('status');

        $query = Presensi::with(['mahasantri.user', 'sesiPresensi.kegiatan']);

        if ($periode === 'harian' && $tanggal) {
            $query->whereHas('sesiPresensi', fn ($q) => $q->whereDate('tanggal', $tanggal));
        } elseif ($periode === 'bulanan' && $bulan && $tahun) {
            $query->whereHas('sesiPresensi', fn ($q) => $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun));
        } elseif ($periode === 'tahunan' && $tahun) {
            $query->whereHas('sesiPresensi', fn ($q) => $q->whereYear('tanggal', $tahun));
        }

        if ($kegiatanId) {
            $query->whereHas('sesiPresensi', fn ($q) => $q->where('kegiatan_id', $kegiatanId));
        }

        if ($status) {
            $query->where('status', strtolower($status));
        }

        $presensi  = $query->latest()->get();
        $presensis = $presensi;
        $kegiatan  = Kegiatan::all();

        $totalHadir = $presensi->where('status', 'hadir')->count();
        $totalIzin  = $presensi->where('status', 'izin')->count();
        $totalSakit = $presensi->where('status', 'sakit')->count();
        $totalAlpa  = $presensi->where('status', 'alpa')->count();

        return view('pengurus.presensi.laporan', compact(
            'presensi',
            'presensis',
            'kegiatan',
            'periode',
            'tanggal',
            'bulan',
            'tahun',
            'kegiatanId',
            'status',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpa'
        ));
    }

    public function laporanPdf(Request $request)
    {
        return $this->laporan($request);
    }

    public function laporanKegiatanIndex()
    {
        $kegiatan = Kegiatan::withCount('sesiPresensi')->get();
        return view('pengurus.laporan-kegiatan.index', compact('kegiatan'));
    }

    public function laporanKegiatan(Request $request, $kegiatan)
    {
        $kegiatanData = Kegiatan::findOrFail($kegiatan);
        $presensis = Presensi::with(['mahasantri.user', 'sesiPresensi'])
            ->whereHas('sesiPresensi', fn ($q) => $q->where('kegiatan_id', $kegiatanData->id))
            ->get();

        return view('pengurus.laporan-kegiatan.show', [
            'kegiatan'  => $kegiatanData,
            'presensis' => $presensis,
        ]);
    }

    public function laporanKegiatanPdf(Request $request, $kegiatan)
    {
        $kegiatanData = Kegiatan::findOrFail($kegiatan);
        $presensis = Presensi::with(['mahasantri.user', 'sesiPresensi'])
            ->whereHas('sesiPresensi', fn ($q) => $q->where('kegiatan_id', $kegiatanData->id))
            ->get();

        return view('pengurus.laporan-kegiatan.pdf', [
            'kegiatan'  => $kegiatanData,
            'presensis' => $presensis,
        ]);
    }
}