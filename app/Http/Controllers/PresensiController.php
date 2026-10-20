<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Mahasantri;
use App\Models\Presensi;
use App\Models\SesiPresensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR SESI PRESENSI
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | SCANNER QR
    |--------------------------------------------------------------------------
    */

    public function scanner(SesiPresensi $sesiPresensi)
    {
        $sesiPresensi->load('kegiatan');

        return view(
            'pengurus.presensi.scanner',
            compact('sesiPresensi')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES SCAN QR
    |--------------------------------------------------------------------------
    */
public function scan(
    Request $request,
    SesiPresensi $sesiPresensi
) {
    $validated = $request->validate([
        'qr_code' => [
            'required',
            'string',
            'max:100',
        ],
    ]);

    // Periksa status sesi.
if ($sesiPresensi->status !== 'aktif') {
    return response()->json([
        'success' => false,
        'message' => 'Sesi presensi belum aktif atau sudah tidak aktif.',
    ], 422);
}

// Gunakan zona waktu WIB.
$sekarang = Carbon::now('Asia/Jakarta');

$tanggalSesi = Carbon::parse(
    $sesiPresensi->tanggal->format('Y-m-d'),
    'Asia/Jakarta'
);

$waktuMulai = Carbon::parse(
    $tanggalSesi->format('Y-m-d') . ' ' . $sesiPresensi->jam_mulai,
    'Asia/Jakarta'
);

$waktuSelesai = Carbon::parse(
    $tanggalSesi->format('Y-m-d') . ' ' . $sesiPresensi->jam_selesai,
    'Asia/Jakarta'
);

// Tolak scan sebelum jadwal dimulai.
if ($sekarang->lt($waktuMulai)) {
    return response()->json([
        'success' => false,
        'message' => 'Presensi belum dibuka. Jadwal mulai pukul '
            . $waktuMulai->format('H:i') . ' WIB.',
    ], 422);
}

// Tolak scan setelah jadwal selesai.
if ($sekarang->greaterThanOrEqualTo($waktuSelesai)) {
    $sesiPresensi->update([
        'status' => 'selesai',
    ]);

    return response()->json([
        'success' => false,
        'message' => 'Waktu presensi sudah berakhir.',
    ], 422);
}

    // Periksa batas waktu presensi menggunakan zona waktu Jakarta.
    $sekarang = Carbon::now('Asia/Jakarta');

    $tanggalSesi = Carbon::parse(
        $sesiPresensi->tanggal->format('Y-m-d'),
        'Asia/Jakarta'
    )->format('Y-m-d');

    $waktuSelesai = Carbon::parse(
        $tanggalSesi . ' ' . $sesiPresensi->jam_selesai,
        'Asia/Jakarta'
    );

    if ($sekarang->greaterThanOrEqualTo($waktuSelesai)) {
        $sesiPresensi->update([
            'status' => 'selesai',
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Waktu presensi sudah berakhir.',
        ], 422);
    }

    // Cari data mahasantri berdasarkan QR Code.
    $mahasantri = Mahasantri::with('user')
        ->where('qr_code', $validated['qr_code'])
        ->first();

    if (! $mahasantri) {
        return response()->json([
            'success' => false,
            'message' => 'QR Code tidak terdaftar.',
        ], 404);
    }

    // Cegah presensi ganda pada sesi yang sama.
    $sudahPresensi = Presensi::where(
        'sesi_presensi_id',
        $sesiPresensi->id
    )
        ->where('mahasantri_id', $mahasantri->id)
        ->exists();

    if ($sudahPresensi) {
        return response()->json([
            'success' => false,
            'message' => 'Mahasantri sudah melakukan presensi.',
        ], 422);
    }

    // Simpan presensi.
    $presensi = Presensi::create([
        'sesi_presensi_id' => $sesiPresensi->id,
        'mahasantri_id' => $mahasantri->id,
        'status' => 'hadir',
        'waktu_presensi' => $sekarang,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Presensi berhasil.',
        'data' => [
            'nama' => $mahasantri->user?->name
                ?? $mahasantri->nama,
            'nim' => $mahasantri->nim,
            'status' => $presensi->status,
            'waktu' => $presensi->waktu_presensi
                ->format('H:i:s'),
        ],
    ]);
}


   
/*
|--------------------------------------------------------------------------
| UPDATE STATUS PRESENSI
|--------------------------------------------------------------------------
*/

public function update(Request $request, Presensi $presensi)
{
    $validated = $request->validate([
        'status' => 'required|in:hadir,izin,sakit,alpa',
        'keterangan' => 'nullable|string|max:1000',
    ]);

    $presensi->status = $validated['status'];
    $presensi->keterangan = $validated['keterangan'] ?? null;

    // Jangan mengubah waktu presensi jika status hanya diedit.
    $presensi->save();

    return back()->with(
        'success',
        'Status presensi berhasil diperbarui.'
    );
}

    /*
    |--------------------------------------------------------------------------
    | REKAP SATU SESI
    |--------------------------------------------------------------------------
    */

    
public function rekap(SesiPresensi $sesiPresensi)
{
    $sesiPresensi->load('kegiatan');

    // Ambil semua mahasantri beserta data user.
    $mahasantri = Mahasantri::with('user')
        ->get();

    // Ambil catatan presensi untuk sesi yang dipilih.
    $dataPresensi = Presensi::with('mahasantri.user')
        ->where('sesi_presensi_id', $sesiPresensi->id)
        ->get()
        ->keyBy('mahasantri_id');

    // Pastikan setiap mahasantri muncul di rekap.
    $presensi = $mahasantri->map(function ($item) use (
        $dataPresensi,
        $sesiPresensi
    ) {
        $catatan = $dataPresensi->get($item->id);

        // Jika belum ada catatan, buat objek tampilan sementara.
        if (!$catatan) {
            $catatan = new Presensi();

            $catatan->sesi_presensi_id = $sesiPresensi->id;
            $catatan->mahasantri_id = $item->id;
            $catatan->status = 'belum_presensi';
            $catatan->waktu_presensi = null;
            $catatan->keterangan = null;
            $catatan->setRelation('mahasantri', $item);
        }

        return $catatan;
    });

    // Urutkan berdasarkan nama mahasantri.
    $presensi = $presensi->sortBy(function ($item) {
        return $item->mahasantri?->user?->name ?? '';
    })->values();

    return view(
        'pengurus.presensi.rekap',
        compact('sesiPresensi', 'presensi')
    );
}

    /*
    |--------------------------------------------------------------------------
    | LAPORAN KEGIATAN
    |--------------------------------------------------------------------------
    |
    | Menampilkan semua kegiatan.
    |
    */

    public function laporanKegiatanIndex()
    {
        $kegiatan = Kegiatan::withCount([
            'sesiPresensi'
        ])
            ->orderBy('nama_kegiatan')
            ->get();

        return view(
            'pengurus.laporan-kegiatan.index',
            compact('kegiatan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LAPORAN SATU KEGIATAN
    |--------------------------------------------------------------------------
    |
    | Menampilkan presensi berdasarkan kegiatan tertentu.
    |
    | Filter:
    | - Harian
    | - Mingguan
    | - Bulanan
    | - Rentang tanggal
    | - Status
    |
    */

    public function laporanKegiatan(
        Request $request,
        Kegiatan $kegiatan
    ) {
        $validated = $request->validate([
            'periode' => [
                'nullable',
                'in:harian,mingguan,bulanan,rentang',
            ],

            'tanggal' => [
                'nullable',
                'date',
            ],

            'dari' => [
                'nullable',
                'date',
            ],

            'sampai' => [
                'nullable',
                'date',
                'after_or_equal:dari',
            ],

            'status' => [
                'nullable',
                'in:hadir,izin,sakit,alpa',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | DEFAULT FILTER
        |--------------------------------------------------------------------------
        */

        $periode = $validated['periode']
            ?? 'harian';

        $tanggal = $validated['tanggal']
            ?? now()->format('Y-m-d');

        $dari = $validated['dari']
            ?? null;

        $sampai = $validated['sampai']
            ?? null;


        /*
        |--------------------------------------------------------------------------
        | QUERY DASAR
        |--------------------------------------------------------------------------
        */

        $query = Presensi::with([
            'mahasantri.user',
            'sesiPresensi.kegiatan',
        ])
            ->whereHas(
                'sesiPresensi',
                function ($q) use ($kegiatan) {

                    $q->where(
                        'kegiatan_id',
                        $kegiatan->id
                    );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | FILTER HARIAN
        |--------------------------------------------------------------------------
        */

        if ($periode === 'harian') {

            $query->whereHas(
                'sesiPresensi',
                function ($q) use ($tanggal) {

                    $q->whereDate(
                        'tanggal',
                        $tanggal
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER MINGGUAN
        |--------------------------------------------------------------------------
        */

        elseif ($periode === 'mingguan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);

            $awalMinggu =
                $tanggalCarbon
                    ->copy()
                    ->startOfWeek();

            $akhirMinggu =
                $tanggalCarbon
                    ->copy()
                    ->endOfWeek();


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $awalMinggu,
                    $akhirMinggu
                ) {

                    $q->whereBetween(
                        'tanggal',
                        [
                            $awalMinggu->format('Y-m-d'),
                            $akhirMinggu->format('Y-m-d'),
                        ]
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER BULANAN
        |--------------------------------------------------------------------------
        */

        elseif ($periode === 'bulanan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $tanggalCarbon
                ) {

                    $q->whereYear(
                        'tanggal',
                        $tanggalCarbon->year
                    );

                    $q->whereMonth(
                        'tanggal',
                        $tanggalCarbon->month
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER RENTANG
        |--------------------------------------------------------------------------
        */

        elseif ($periode === 'rentang') {

            if ($dari && $sampai) {

                $query->whereHas(
                    'sesiPresensi',
                    function ($q) use (
                        $dari,
                        $sampai
                    ) {

                        $q->whereBetween(
                            'tanggal',
                            [
                                $dari,
                                $sampai,
                            ]
                        );
                    }
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if (! empty($validated['status'])) {

            $query->where(
                'status',
                $validated['status']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */

        $presensi = $query
            ->orderByDesc('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $total = $presensi->count();

        $hadir = $presensi
            ->where('status', 'hadir')
            ->count();

        $izin = $presensi
            ->where('status', 'izin')
            ->count();

        $sakit = $presensi
            ->where('status', 'sakit')
            ->count();

        $alpa = $presensi
            ->where('status', 'alpa')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | NAMA STATUS
        |--------------------------------------------------------------------------
        */

        $namaStatus = ! empty($validated['status'])
            ? ucfirst($validated['status'])
            : 'Semua Status';


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pengurus.laporan-kegiatan.show',
            compact(
                'kegiatan',
                'presensi',
                'total',
                'hadir',
                'izin',
                'sakit',
                'alpa',
                'periode',
                'tanggal',
                'dari',
                'sampai',
                'namaStatus'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PDF LAPORAN KEGIATAN
    |--------------------------------------------------------------------------
    */

    public function laporanKegiatanPdf(
        Request $request,
        Kegiatan $kegiatan
    ) {
        $validated = $request->validate([
            'periode' => [
                'nullable',
                'in:harian,mingguan,bulanan,rentang',
            ],

            'tanggal' => [
                'nullable',
                'date',
            ],

            'dari' => [
                'nullable',
                'date',
            ],

            'sampai' => [
                'nullable',
                'date',
                'after_or_equal:dari',
            ],

            'status' => [
                'nullable',
                'in:hadir,izin,sakit,alpa',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | DEFAULT FILTER
        |--------------------------------------------------------------------------
        */

        $periode = $validated['periode']
            ?? 'harian';

        $tanggal = $validated['tanggal']
            ?? now()->format('Y-m-d');

        $dari = $validated['dari']
            ?? null;

        $sampai = $validated['sampai']
            ?? null;


        /*
        |--------------------------------------------------------------------------
        | QUERY
        |--------------------------------------------------------------------------
        */

        $query = Presensi::with([
            'mahasantri.user',
            'sesiPresensi.kegiatan',
        ])
            ->whereHas(
                'sesiPresensi',
                function ($q) use ($kegiatan) {

                    $q->where(
                        'kegiatan_id',
                        $kegiatan->id
                    );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | HARIAN
        |--------------------------------------------------------------------------
        */

        if ($periode === 'harian') {

            $query->whereHas(
                'sesiPresensi',
                function ($q) use ($tanggal) {

                    $q->whereDate(
                        'tanggal',
                        $tanggal
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MINGGUAN
        |--------------------------------------------------------------------------
        */

        elseif ($periode === 'mingguan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);

            $awalMinggu =
                $tanggalCarbon
                    ->copy()
                    ->startOfWeek();

            $akhirMinggu =
                $tanggalCarbon
                    ->copy()
                    ->endOfWeek();


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $awalMinggu,
                    $akhirMinggu
                ) {

                    $q->whereBetween(
                        'tanggal',
                        [
                            $awalMinggu->format('Y-m-d'),
                            $akhirMinggu->format('Y-m-d'),
                        ]
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BULANAN
        |--------------------------------------------------------------------------
        */

        elseif ($periode === 'bulanan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $tanggalCarbon
                ) {

                    $q->whereYear(
                        'tanggal',
                        $tanggalCarbon->year
                    );

                    $q->whereMonth(
                        'tanggal',
                        $tanggalCarbon->month
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | RENTANG
        |--------------------------------------------------------------------------
        */

        elseif ($periode === 'rentang') {

            if ($dari && $sampai) {

                $query->whereHas(
                    'sesiPresensi',
                    function ($q) use (
                        $dari,
                        $sampai
                    ) {

                        $q->whereBetween(
                            'tanggal',
                            [
                                $dari,
                                $sampai,
                            ]
                        );
                    }
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        if (! empty($validated['status'])) {

            $query->where(
                'status',
                $validated['status']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $presensi = $query
            ->orderByDesc('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $total = $presensi->count();

        $hadir = $presensi
            ->where('status', 'hadir')
            ->count();

        $izin = $presensi
            ->where('status', 'izin')
            ->count();

        $sakit = $presensi
            ->where('status', 'sakit')
            ->count();

        $alpa = $presensi
            ->where('status', 'alpa')
            ->count();


        $namaStatus = ! empty($validated['status'])
            ? ucfirst($validated['status'])
            : 'Semua Status';


        /*
        |--------------------------------------------------------------------------
        | GENERATE PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'pengurus.laporan-kegiatan.pdf',
            compact(
                'kegiatan',
                'presensi',
                'periode',
                'tanggal',
                'dari',
                'sampai',
                'namaStatus',
                'total',
                'hadir',
                'izin',
                'sakit',
                'alpa'
            )
        );


        $pdf->setPaper(
            'a4',
            'landscape'
        );


        return $pdf->download(
            'laporan-' .
            str()->slug($kegiatan->nama_kegiatan) .
            '.pdf'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LAPORAN PRESENSI UMUM
    |--------------------------------------------------------------------------
    |
    | Fitur lama tetap dipertahankan.
    |
    */

    public function laporan(Request $request)
    {
        $validated = $request->validate([
            'periode' => [
                'nullable',
                'in:harian,mingguan,bulanan,rentang',
            ],

            'tanggal' => [
                'nullable',
                'date',
            ],

            'dari' => [
                'nullable',
                'date',
            ],

            'sampai' => [
                'nullable',
                'date',
                'after_or_equal:dari',
            ],

            'kegiatan_id' => [
                'nullable',
                'exists:kegiatan,id',
            ],

            'status' => [
                'nullable',
                'in:hadir,izin,sakit,alpa',
            ],
        ]);


        $periode = $validated['periode']
            ?? 'harian';

        $tanggal = $validated['tanggal']
            ?? now()->format('Y-m-d');

        $dari = $validated['dari']
            ?? null;

        $sampai = $validated['sampai']
            ?? null;


        $query = Presensi::with([
            'mahasantri.user',
            'sesiPresensi.kegiatan',
        ]);


        if ($periode === 'harian') {

            $query->whereHas(
                'sesiPresensi',
                function ($q) use ($tanggal) {

                    $q->whereDate(
                        'tanggal',
                        $tanggal
                    );
                }
            );
        }


        elseif ($periode === 'mingguan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);

            $awalMinggu =
                $tanggalCarbon
                    ->copy()
                    ->startOfWeek();

            $akhirMinggu =
                $tanggalCarbon
                    ->copy()
                    ->endOfWeek();


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $awalMinggu,
                    $akhirMinggu
                ) {

                    $q->whereBetween(
                        'tanggal',
                        [
                            $awalMinggu->format('Y-m-d'),
                            $akhirMinggu->format('Y-m-d'),
                        ]
                    );
                }
            );
        }


        elseif ($periode === 'bulanan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $tanggalCarbon
                ) {

                    $q->whereYear(
                        'tanggal',
                        $tanggalCarbon->year
                    );

                    $q->whereMonth(
                        'tanggal',
                        $tanggalCarbon->month
                    );
                }
            );
        }


        elseif ($periode === 'rentang') {

            if ($dari && $sampai) {

                $query->whereHas(
                    'sesiPresensi',
                    function ($q) use (
                        $dari,
                        $sampai
                    ) {

                        $q->whereBetween(
                            'tanggal',
                            [
                                $dari,
                                $sampai,
                            ]
                        );
                    }
                );
            }
        }


        if (! empty($validated['kegiatan_id'])) {

            $query->whereHas(
                'sesiPresensi',
                function ($q) use ($validated) {

                    $q->where(
                        'kegiatan_id',
                        $validated['kegiatan_id']
                    );
                }
            );
        }


        if (! empty($validated['status'])) {

            $query->where(
                'status',
                $validated['status']
            );
        }


        $presensi = $query
            ->orderByDesc('created_at')
            ->get();


        $kegiatan = Kegiatan::orderBy(
            'nama_kegiatan'
        )->get();


        $total = $presensi->count();

        $hadir = $presensi
            ->where('status', 'hadir')
            ->count();

        $izin = $presensi
            ->where('status', 'izin')
            ->count();

        $sakit = $presensi
            ->where('status', 'sakit')
            ->count();

        $alpa = $presensi
            ->where('status', 'alpa')
            ->count();


        return view(
            'pengurus.presensi.laporan',
            compact(
                'presensi',
                'kegiatan',
                'total',
                'hadir',
                'izin',
                'sakit',
                'alpa',
                'periode',
                'tanggal',
                'dari',
                'sampai'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LAPORAN PDF UMUM
    |--------------------------------------------------------------------------
    */

    public function laporanPdf(Request $request)
    {
        $validated = $request->validate([
            'periode' => [
                'nullable',
                'in:harian,mingguan,bulanan,rentang',
            ],

            'tanggal' => [
                'nullable',
                'date',
            ],

            'dari' => [
                'nullable',
                'date',
            ],

            'sampai' => [
                'nullable',
                'date',
                'after_or_equal:dari',
            ],

            'kegiatan_id' => [
                'nullable',
                'exists:kegiatan,id',
            ],

            'status' => [
                'nullable',
                'in:hadir,izin,sakit,alpa',
            ],
        ]);


        $periode = $validated['periode']
            ?? 'harian';

        $tanggal = $validated['tanggal']
            ?? now()->format('Y-m-d');

        $dari = $validated['dari']
            ?? null;

        $sampai = $validated['sampai']
            ?? null;


        $query = Presensi::with([
            'mahasantri.user',
            'sesiPresensi.kegiatan',
        ]);


        if ($periode === 'harian') {

            $query->whereHas(
                'sesiPresensi',
                function ($q) use ($tanggal) {

                    $q->whereDate(
                        'tanggal',
                        $tanggal
                    );
                }
            );
        }


        elseif ($periode === 'mingguan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);

            $awalMinggu =
                $tanggalCarbon
                    ->copy()
                    ->startOfWeek();

            $akhirMinggu =
                $tanggalCarbon
                    ->copy()
                    ->endOfWeek();


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $awalMinggu,
                    $akhirMinggu
                ) {

                    $q->whereBetween(
                        'tanggal',
                        [
                            $awalMinggu->format('Y-m-d'),
                            $akhirMinggu->format('Y-m-d'),
                        ]
                    );
                }
            );
        }


        elseif ($periode === 'bulanan') {

            $tanggalCarbon =
                Carbon::parse($tanggal);


            $query->whereHas(
                'sesiPresensi',
                function ($q) use (
                    $tanggalCarbon
                ) {

                    $q->whereYear(
                        'tanggal',
                        $tanggalCarbon->year
                    );

                    $q->whereMonth(
                        'tanggal',
                        $tanggalCarbon->month
                    );
                }
            );
        }


        elseif ($periode === 'rentang') {

            if ($dari && $sampai) {

                $query->whereHas(
                    'sesiPresensi',
                    function ($q) use (
                        $dari,
                        $sampai
                    ) {

                        $q->whereBetween(
                            'tanggal',
                            [
                                $dari,
                                $sampai,
                            ]
                        );
                    }
                );
            }
        }


        if (! empty($validated['kegiatan_id'])) {

            $query->whereHas(
                'sesiPresensi',
                function ($q) use ($validated) {

                    $q->where(
                        'kegiatan_id',
                        $validated['kegiatan_id']
                    );
                }
            );
        }


        if (! empty($validated['status'])) {

            $query->where(
                'status',
                $validated['status']
            );
        }


        $presensi = $query
            ->orderByDesc('created_at')
            ->get();


        $namaKegiatan = 'Semua Kegiatan';


        if (! empty($validated['kegiatan_id'])) {

            $kegiatan = Kegiatan::find(
                $validated['kegiatan_id']
            );

            $namaKegiatan =
                $kegiatan?->nama_kegiatan
                ?? 'Semua Kegiatan';
        }


        $namaStatus = ! empty($validated['status'])
            ? ucfirst($validated['status'])
            : 'Semua Status';


        $total = $presensi->count();

        $hadir = $presensi
            ->where('status', 'hadir')
            ->count();

        $izin = $presensi
            ->where('status', 'izin')
            ->count();

        $sakit = $presensi
            ->where('status', 'sakit')
            ->count();

        $alpa = $presensi
            ->where('status', 'alpa')
            ->count();


        $pdf = Pdf::loadView(
            'pengurus.presensi.laporan-pdf',
            compact(
                'presensi',
                'periode',
                'tanggal',
                'dari',
                'sampai',
                'namaKegiatan',
                'namaStatus',
                'total',
                'hadir',
                'izin',
                'sakit',
                'alpa'
            )
        );


        $pdf->setPaper(
            'a4',
            'landscape'
        );


        return $pdf->download(
            'laporan-presensi-smarttren.pdf'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE ALPA
    |--------------------------------------------------------------------------
    */

    public function generateAlpa(SesiPresensi $sesiPresensi)
    {
        // Alpa hanya dapat dibuat setelah sesi benar-benar selesai.
        if ($sesiPresensi->status !== 'selesai') {
            return back()->with(
                'error',
                'Sesi belum selesai. Alpa hanya dapat dibuat setelah sesi selesai.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA MAHASANTRI
        |--------------------------------------------------------------------------
        */

        $mahasantri = Mahasantri::all();


        DB::transaction(function () use (
            $mahasantri,
            $sesiPresensi
        ) {

            foreach ($mahasantri as $item) {

                /*
                |--------------------------------------------------------------------------
                | JANGAN TIMPA DATA YANG SUDAH ADA
                |--------------------------------------------------------------------------
                */

                Presensi::firstOrCreate(
                    [
                        'sesi_presensi_id' =>
                            $sesiPresensi->id,

                        'mahasantri_id' =>
                            $item->id,
                    ],
                    [
                        'status' => 'alpa',

                        'keterangan' =>
                            'Tidak melakukan presensi.',

                        'waktu_presensi' => null,
                    ]
                );
            }
        });


        return back()->with(
            'success',
            'Data Alpa berhasil dibuat untuk Mahasantri yang belum melakukan presensi.'
        );
    }


}