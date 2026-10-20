<?php

namespace App\Http\Controllers;

use App\Models\Mahasantri;
use App\Models\PengajuanIzin;
use App\Models\Presensi;
use App\Models\SesiPresensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengajuanIzinController extends Controller
{
    /**
     * Daftar pengajuan milik mahasiswa yang login.
     */
    public function index()
    {
        $mahasantri = Mahasantri::where('user_id', Auth::id())
            ->firstOrFail();

        $query = PengajuanIzin::where(
            'mahasantri_id',
            $mahasantri->id
        );

        $jumlahMenunggu = (clone $query)
            ->whereIn(DB::raw('LOWER(TRIM(status))'), [
                'menunggu',
                'pending',
            ])
            ->count();

        $jumlahDisetujui = (clone $query)
            ->whereIn(DB::raw('LOWER(TRIM(status))'), [
                'disetujui',
                'diterima',
                'approved',
            ])
            ->count();

        $jumlahDitolak = (clone $query)
            ->whereIn(DB::raw('LOWER(TRIM(status))'), [
                'ditolak',
                'rejected',
            ])
            ->count();

        $pengajuans = (clone $query)
            ->latest()
            ->paginate(10);

           $kegiatans = \App\Models\Kegiatan::orderBy('nama_kegiatan')
    ->get();

       
return view('mahasantri.pengajuan-izin.index', compact(
    'mahasantri',
    'pengajuans',
    'jumlahMenunggu',
    'jumlahDisetujui',
    'jumlahDitolak',
    'kegiatans'
));

    }

   

public function create()
{
    $mahasantri = Mahasantri::where('user_id', Auth::id())
        ->firstOrFail();

    $kegiatans = \App\Models\Kegiatan::orderBy('nama_kegiatan')
        ->get();

    return view('mahasantri.pengajuan-izin.create', compact(
        'mahasantri',
        'kegiatans'
    ));
}

  
public function store(Request $request)
{
    $mahasantri = Mahasantri::where('user_id', Auth::id())
        ->firstOrFail();

    $validated = $request->validate([
        'kegiatan_id' => [
            'required',
            'integer',
            'exists:kegiatan,id',
        ],
        'tanggal' => [
            'required',
            'date',
        ],
        'jenis' => [
            'required',
            Rule::in(['izin', 'sakit']),
        ],
        'alasan' => [
            'required',
            'string',
            'max:2000',
        ],
        'bukti_foto' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:5120',
        ],
    ], [
        'kegiatan_id.required' => 'Pilih kegiatan terlebih dahulu.',
        'kegiatan_id.exists' => 'Kegiatan yang dipilih tidak ditemukan.',
        'tanggal.required' => 'Tanggal pengajuan wajib diisi.',
        'jenis.required' => 'Pilih jenis pengajuan izin atau sakit.',
        'alasan.required' => 'Alasan pengajuan wajib diisi.',
        'bukti_foto.image' => 'Bukti harus berupa gambar.',
        'bukti_foto.max' => 'Ukuran bukti foto maksimal 5 MB.',
    ]);

    $sudahMengajukan = PengajuanIzin::where(
        'mahasantri_id',
        $mahasantri->id
    )
        ->where('kegiatan_id', $validated['kegiatan_id'])
        ->whereDate('tanggal', $validated['tanggal'])
        ->whereIn('status', ['menunggu', 'disetujui'])
        ->exists();

    if ($sudahMengajukan) {
        return back()
            ->withInput()
            ->withErrors([
                'kegiatan_id' =>
                    'Kamu sudah memiliki pengajuan aktif untuk kegiatan dan tanggal tersebut.',
            ]);
    }

    $data = [
        'mahasantri_id' => $mahasantri->id,
        'sesi_presensi_id' => null,
        'kegiatan_id' => $validated['kegiatan_id'],
        'jenis' => $validated['jenis'],
        'tanggal' => $validated['tanggal'],
        'alasan' => $validated['alasan'],
        'status' => 'menunggu',
    ];

    if ($request->hasFile('bukti_foto')) {
        $data['bukti_foto'] = $request->file('bukti_foto')
            ->store('bukti-pengajuan', 'local');
    }

    try {
        PengajuanIzin::create($data);
    } catch (\Throwable $e) {
        if (!empty($data['bukti_foto'])) {
            Storage::disk('local')->delete($data['bukti_foto']);
        }

        report($e);

        return back()
            ->withInput()
            ->withErrors([
                'pengajuan' =>
                    'Pengajuan gagal disimpan. Periksa log Laravel untuk mengetahui penyebabnya.',
            ]);
    }

    return redirect()
        ->route('mahasantri.pengajuan-izin.index')
        ->with('success', 'Pengajuan berhasil dikirim dan menunggu pemeriksaan pengurus.');
}


    
public function pengurusIndex(Request $request)
{
    $query = PengajuanIzin::with([
        'mahasantri',
        'kegiatan',
        'sesiPresensi.kegiatan',
        'pemroses',
    ])->latest();

    if ($request->filled('status') && in_array(
        $request->status,
        ['menunggu', 'disetujui', 'ditolak'],
        true
    )) {
        $query->where('status', $request->status);
    }

    $pengajuans = $query
        ->paginate(15)
        ->withQueryString();

    return view(
        'pengurus.pengajuan-izin.index',
        compact('pengajuans')
    );
}


    
    public function proses(
        Request $request,
        PengajuanIzin $pengajuanIzin
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['disetujui', 'ditolak']),
            ],
            'catatan_pengurus' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        if ($pengajuanIzin->status !== 'menunggu') {
            return back()->withErrors([
                'status' =>
                    'Pengajuan ini sudah diproses sebelumnya.',
            ]);
        }

        if (!$pengajuanIzin->sesi_presensi_id) {
    return back()->withErrors([
        'status' => 'Pengajuan ini belum terhubung ke sesi kegiatan.',
    ]);
}
        DB::transaction(function () use (
            $pengajuanIzin,
            $validated
        ) {
            $pengajuan = PengajuanIzin::whereKey($pengajuanIzin->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($pengajuan->status !== 'menunggu') {
                throw new \RuntimeException(
                    'Pengajuan ini sudah diproses sebelumnya.'
                );
            }

            $sesi = SesiPresensi::whereKey(
                $pengajuan->sesi_presensi_id
            )->lockForUpdate()->firstOrFail();

            if ($sesi->status === 'dibatalkan') {
                throw new \RuntimeException(
                    'Sesi kegiatan sudah dibatalkan.'
                );
            }

            $pengajuan->update([
                'status' => $validated['status'],
                'catatan_pengurus' =>
                    $validated['catatan_pengurus'] ?? null,
                'diproses_oleh' => Auth::id(),
                'diproses_pada' => now(),
            ]);

            $presensi = Presensi::where(
                'sesi_presensi_id',
                $sesi->id
            )
                ->where(
                    'mahasantri_id',
                    $pengajuan->mahasantri_id
                )
                ->lockForUpdate()
                ->first();

            if ($validated['status'] === 'disetujui') {
                // Jangan mengganti status hadir yang sudah valid.
                if ($presensi && $presensi->status === 'hadir') {
                    return;
                }

                $statusPresensi = $pengajuan->jenis;

                if (!$presensi) {
                    Presensi::create([
                        'sesi_presensi_id' => $sesi->id,
                        'mahasantri_id' => $pengajuan->mahasantri_id,
                        'status' => $statusPresensi,
                        'keterangan' => 'Pengajuan '
                            . $statusPresensi . ' disetujui.',
                        'waktu_presensi' => null,
                    ]);
                } else {
                    $presensi->update([
                        'status' => $statusPresensi,
                        'keterangan' => 'Pengajuan '
                            . $statusPresensi . ' disetujui.',
                    ]);
                }

                return;
            }

            // Jika ditolak dan sesi selesai, catat alpa
            // hanya bila catatan presensi belum ada.
            if (!$presensi && $sesi->status === 'selesai') {
                Presensi::create([
                    'sesi_presensi_id' => $sesi->id,
                    'mahasantri_id' => $pengajuan->mahasantri_id,
                    'status' => 'alpa',
                    'keterangan' => 'Pengajuan '
                        . $pengajuan->jenis . ' ditolak.',
                    'waktu_presensi' => null,
                ]);
            }
        });

        return back()->with(
            'success',
            $validated['status'] === 'disetujui'
                ? 'Pengajuan berhasil disetujui.'
                : 'Pengajuan berhasil ditolak.'
        );
    }
}
