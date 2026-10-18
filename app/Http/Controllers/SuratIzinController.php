<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratIzin;
use Illuminate\Support\Facades\Auth;

class SuratIzinController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        SuratIzin::create([
            'user_id' => Auth::id(), // Menyimpan ID mahasantri yang sedang login
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan surat izin berhasil dikirim ke pengurus!');
    }
}