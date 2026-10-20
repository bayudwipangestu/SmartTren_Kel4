<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SesiPresensiController extends Controller
{
    /**
     * Menampilkan daftar sesi presensi.
     */
    

public function index(Request $request)
{
    $query = SesiPresensi::with('kegiatan');

    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    if ($request->filled('kegiatan_id')) {
        $query->where('kegiatan_id', $request->kegiatan_id);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $sesi = $query
        ->latest('tanggal')
        ->latest('jam_mulai')
        ->paginate(10)
        ->withQueryString();

    $kegiatan = Kegiatan::orderBy('nama_kegiatan')->get();

    return view(
        'pengurus.sesi-presensi.index',
        compact('sesi', 'kegiatan')
    );
}


    /**
     * Form membuat sesi presensi.
     */
    public function create()
    {
        $kegiatan = Kegiatan::where('status', 'aktif')
            ->orderBy('nama_kegiatan')
            ->get();

        return view(
            'pengurus.sesi-presensi.create',
            compact('kegiatan')
        );
    }

    /**
     * Menyimpan sesi presensi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => [
                'required',
                'exists:kegiatan,id',
            ],

            'tanggal' => [
                'required',
                'date',
            ],

            'jam_mulai' => [
                'required',
                'date_format:H:i',
            ],

            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'selesai',
                    'dibatalkan',
                ]),
            ],
        ], [
            'kegiatan_id.required' => 'Kegiatan wajib dipilih.',
            'kegiatan_id.exists' => 'Kegiatan tidak ditemukan.',

            'tanggal.required' => 'Tanggal wajib diisi.',

            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam mulai tidak valid.',

            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Format jam selesai tidak valid.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',

            'status.required' => 'Status sesi wajib dipilih.',
            'status.in' => 'Status sesi tidak valid.',
        ]);

        DB::transaction(function () use ($validated) {

            SesiPresensi::create([
                'kegiatan_id' => $validated['kegiatan_id'],
                'tanggal' => $validated['tanggal'],
                'jam_mulai' => $validated['jam_mulai'],
                'jam_selesai' => $validated['jam_selesai'],
                'status' => $validated['status'],
            ]);

        });

        return redirect()
            ->route('pengurus.sesi-presensi.index')
            ->with(
                'success',
                'Sesi presensi berhasil dibuat.'
            );
    }

    /**
     * Menampilkan detail sesi.
     */
    public function show(SesiPresensi $sesiPresensi)
    {
        $sesiPresensi->load('kegiatan');

        return view(
            'pengurus.sesi-presensi.show',
            compact('sesiPresensi')
        );
    }

    /**
     * Form edit sesi.
     */
    public function edit(SesiPresensi $sesiPresensi)
    {
        $kegiatan = Kegiatan::where('status', 'aktif')
            ->orderBy('nama_kegiatan')
            ->get();

        return view(
            'pengurus.sesi-presensi.edit',
            compact(
                'sesiPresensi',
                'kegiatan'
            )
        );
    }

    /**
     * Update sesi.
     */
    public function update(
        Request $request,
        SesiPresensi $sesiPresensi
    ) {
        $validated = $request->validate([
            'kegiatan_id' => [
                'required',
                'exists:kegiatan,id',
            ],

            'tanggal' => [
                'required',
                'date',
            ],

            'jam_mulai' => [
                'required',
                'date_format:H:i',
            ],

            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'selesai',
                    'dibatalkan',
                ]),
            ],
        ]);

        $sesiPresensi->update([
            'kegiatan_id' => $validated['kegiatan_id'],
            'tanggal' => $validated['tanggal'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('pengurus.sesi-presensi.index')
            ->with(
                'success',
                'Sesi presensi berhasil diperbarui.'
            );
    }

    /**
     * Menghapus sesi.
     */
    public function destroy(SesiPresensi $sesiPresensi)
    {
        $sesiPresensi->delete();

        return redirect()
            ->route('pengurus.sesi-presensi.index')
            ->with(
                'success',
                'Sesi presensi berhasil dihapus.'
            );
    }
}