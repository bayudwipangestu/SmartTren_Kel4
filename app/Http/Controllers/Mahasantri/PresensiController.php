<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\SuratIzin;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    // Halaman Tampil QR Code Presensi Mahasantri
    public function index()
    {
        $user = Auth::user();
        return view('mahasantri.presensi.index', compact('user'));
    }

    // Halaman Riwayat Presensi
    public function riwayat()
    {
        $mahasantriId = Auth::user()->mahasantri?->id;

        $riwayat = $mahasantriId
            ? Presensi::with('sesiPresensi.kegiatan')
                ->where('mahasantri_id', $mahasantriId)
                ->orderBy('created_at', 'desc')
                ->get()
            : collect();

        return view('mahasantri.presensi.riwayat', compact('riwayat'));
    }

    // Halaman Rekap Kehadiran (Dengan Filter & Integrasi Surat Izin Real-Time)
    public function rekap(Request $request)
    {
        $userId = Auth::id();
        $mahasantriId = Auth::user()->mahasantri?->id;
        $kegiatans = Kegiatan::all();

        // 1. Ambil data presensi fisik
        $queryPresensi = $mahasantriId
            ? Presensi::with('sesiPresensi.kegiatan')->where('mahasantri_id', $mahasantriId)
            : Presensi::with('sesiPresensi.kegiatan')->whereRaw('1 = 0');

        if ($request->filled('kegiatan_id')) {
            $queryPresensi->whereHas('sesiPresensi', function ($q) use ($request) {
                $q->where('kegiatan_id', $request->kegiatan_id);
            });
        }

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $queryPresensi->whereBetween('created_at', [
                $request->tanggal_mulai . ' 00:00:00', 
                $request->tanggal_selesai . ' 23:59:59'
            ]);
        }

        if ($request->filled('status')) {
            $queryPresensi->whereRaw('LOWER(status) = ?', [strtolower($request->status)]);
        }

        $listPresensi = $queryPresensi->get();

        // 2. Ambil data surat izin (Sakit / Izin) secara real-time
        $queryIzin = SuratIzin::where('user_id', $userId);

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $queryIzin->whereBetween('tanggal', [
                $request->tanggal_mulai, 
                $request->tanggal_selesai
            ]);
        }

        if ($request->filled('status')) {
            $queryIzin->whereRaw('LOWER(jenis_izin) = ?', [strtolower($request->status)]);
        }

        $listIzin = $queryIzin->get();

        // 3. Gabungkan koleksi data untuk ditampilkan di tabel
        $riwayatGabungan = collect();

        foreach ($listPresensi as $p) {
            $riwayatGabungan->push((object)[
                'tanggal' => $p->created_at,
                'kegiatan' => $p->sesiPresensi->kegiatan->nama_kegiatan ?? '-',
                'status' => $p->status
            ]);
        }

        foreach ($listIzin as $i) {
            // Cek apakah jenis izin sesuai filter status (jika ada filter status)
            if (!$request->filled('status') || strtolower($request->status) == strtolower($i->jenis_izin)) {
                $riwayatGabungan->push((object)[
                    'tanggal' => \Carbon\Carbon::parse($i->tanggal),
                    'kegiatan' => 'Pengajuan Surat ' . $i->jenis_izin,
                    'status' => $i->jenis_izin
                ]);
            }
        }

        // Urutkan berdasarkan tanggal terbaru
        $riwayat = $riwayatGabungan->sortByDesc('tanggal');

        // 4. Hitung total rekap (Hadir, Sakit, Izin, Alpa) secara akurat dari gabungan data
        $dataRekap = [
            'Hadir' => $riwayat->filter(fn ($item) => strtolower((string) $item->status) === 'hadir')->count(),
            'Izin'  => $riwayat->filter(fn ($item) => strtolower((string) $item->status) === 'izin')->count(),
            'Sakit' => $riwayat->filter(fn ($item) => strtolower((string) $item->status) === 'sakit')->count(),
            'Alpa'  => $riwayat->filter(fn ($item) => strtolower((string) $item->status) === 'alpa')->count(),
        ];

        return view('mahasantri.presensi.rekap', compact('riwayat', 'kegiatans', 'dataRekap'));
    }
}