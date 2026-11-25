<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratIzin;

class SuratIzinController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis_izin' => 'required|in:Sakit,Izin',
            'tanggal'    => 'required|date',
            'keterangan' => 'required|string',
            'bukti_foto' => 'required|image|max:2048',
        ]);

        $path = $request->file('bukti_foto')->store('bukti-izin', 'public');

        SuratIzin::create([
            'user_id'    => Auth::id(),
            'jenis_izin' => $request->jenis_izin,
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan,
            'bukti_foto' => $path,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Pengajuan surat izin berhasil dikirim dan otomatis masuk ke rekap kehadiran!');
    }
}