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

    public function index()
    {
        $sesi = SesiPresensi::with('kegiatan')
            ->latest('tanggal')
            ->latest('jam_mulai')
            ->paginate(10);

        return view(
            'pengurus.presensi.index',
            compact('sesi')
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

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS SESI
        |--------------------------------------------------------------------------
        */

        if ($sesiPresensi->status !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Sesi presensi sudah tidak aktif.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | CARI MAHASANTRI
        |--------------------------------------------------------------------------
        */

        $mahasantri = Mahasantri::with('user')
            ->where(
                'qr_code',
                $validated['qr_code']
            )
            ->first();

        if (! $mahasantri) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak terdaftar.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK PRESENSI DUPLIKAT
        |--------------------------------------------------------------------------
        */

        $sudahPresensi = Presensi::where(
            'sesi_presensi_id',
            $sesiPresensi->id
        )
            ->where(
                'mahasantri_id',
                $mahasantri->id
            )
            ->exists();

        if ($sudahPresensi) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasantri sudah melakukan presensi.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PRESENSI
        |--------------------------------------------------------------------------
        */

        $presensi = Presensi::create([
            'sesi_presensi_id' => $sesiPresensi->id,
            'mahasantri_id' => $mahasantri->id,
            'status' => 'hadir',
            'waktu_presensi' => now(),
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
    |
    | Hadir / Izin / Sakit / Alpa
    |
    */

    public function update(
        Request $request,
        Presensi $presensi
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:hadir,izin,sakit,alpa',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        $presensi->update([
            'status' => $validated['status'],

            'keterangan' =>
                $validated['keterangan'] ?? null,

            'waktu_presensi' =>
                $presensi->waktu_presensi ?? now(),
        ]);


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

        $presensi = Presensi::with([
            'mahasantri.user',
        ])
            ->where(
                'sesi_presensi_id',
                $sesiPresensi->id
            )
            ->orderBy('status')
            ->orderBy('created_at')
            ->get();

        return view(
            'pengurus.presensi.rekap',
            compact(
                'sesiPresensi',
                'presensi'
            )
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

    public function generateAlpa(
        SesiPresensi $sesiPresensi
    ) {

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS SESI
        |--------------------------------------------------------------------------
        */

        if ($sesiPresensi->status === 'aktif') {

            return back()->with(
                'error',
                'Sesi masih aktif. Selesaikan sesi terlebih dahulu sebelum membuat Alpa.'
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