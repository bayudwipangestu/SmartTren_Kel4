<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Mahasantri;
use App\Models\SesiPresensi;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    /**
     * Menampilkan halaman presensi Mahasantri.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }

        $mahasantri = Mahasantri::with('user')
            ->where('user_id', $user->id)
            ->first();

        if (!$mahasantri) {
            abort(
                404,
                'Data Mahasantri belum terhubung dengan akun pengguna ini.'
            );
        }

        $sesiAktif = SesiPresensi::with('kegiatan')
            ->where('status', 'aktif')
            ->whereDate(
                'tanggal',
                now()->toDateString()
            )
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view(
            'mahasantri.presensi.index',
            compact(
                'mahasantri',
                'sesiAktif'
            )
        );
    }
    public function riwayat()
{
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Anda harus login terlebih dahulu.');
    }

    $mahasantri = Mahasantri::where(
        'user_id',
        $user->id
    )->firstOrFail();

    $presensi = \App\Models\Presensi::with([
        'sesiPresensi.kegiatan'
    ])
        ->where('mahasantri_id', $mahasantri->id)
        ->orderByDesc('waktu_presensi')
        ->get();

    return view(
        'mahasantri.presensi.riwayat',
        compact(
            'mahasantri',
            'presensi'
        )
    );
}
}