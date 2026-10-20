<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Mahasantri;
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    private function filters(Request $request): array
    {
        return $request->validate([
            'dari' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
            'kegiatan_id' => ['nullable', 'integer', 'exists:kegiatan,id'],
            'kamar' => ['nullable', 'string', 'max:50'],
            'status' => ['nullable', 'in:hadir,izin,sakit,alpa'],
            'search' => ['nullable', 'string', 'max:100'],
        ]);
    }

    private function queryLaporan(array $filters): Builder
    {
        $query = Presensi::query()->with([
            'mahasantri.user',
            'sesiPresensi.kegiatan',
        ]);

        if (!empty($filters['dari']) || !empty($filters['sampai'])) {
            $query->whereHas('sesiPresensi', function ($q) use ($filters) {
                if (!empty($filters['dari'])) {
                    $q->whereDate('tanggal', '>=', $filters['dari']);
                }

                if (!empty($filters['sampai'])) {
                    $q->whereDate('tanggal', '<=', $filters['sampai']);
                }
            });
        }

        if (!empty($filters['kegiatan_id'])) {
            $query->whereHas('sesiPresensi', function ($q) use ($filters) {
                $q->where('kegiatan_id', $filters['kegiatan_id']);
            });
        }

        if (!empty($filters['kamar'])) {
            $query->whereHas('mahasantri', function ($q) use ($filters) {
                $q->where('kamar', $filters['kamar']);
            });
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->whereHas('mahasantri', function ($q) use ($search) {
                $q->where(function ($subQuery) use ($search) {
                    $subQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            });
        }

        return $query;
    }

    private function statistik(Builder $query): array
    {
        return [
            'total' => (clone $query)->count(),
            'hadir' => (clone $query)->where('status', 'hadir')->count(),
            'izin' => (clone $query)->where('status', 'izin')->count(),
            'sakit' => (clone $query)->where('status', 'sakit')->count(),
            'alpa' => (clone $query)->where('status', 'alpa')->count(),
        ];
    }

    public function index(Request $request)
    {
        $filters = $this->filters($request);

        // Query dasar mengikuti filter tanggal, kegiatan,
        // kamar, dan nama/NIM.
        $baseQuery = $this->queryLaporan($filters);
        $statistik = $this->statistik($baseQuery);

        // Filter status diterapkan khusus pada daftar hasil.
        $query = clone $baseQuery;

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $laporan = $query
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $kegiatan = Kegiatan::orderBy('nama_kegiatan')->get();

        $kamar = Mahasantri::query()
            ->whereNotNull('kamar')
            ->where('kamar', '!=', '')
            ->distinct()
            ->orderBy('kamar')
            ->pluck('kamar');

        return view('admin.laporan.index', compact(
            'laporan',
            'kegiatan',
            'kamar',
            'filters',
            'statistik'
        ));
    }

    public function pdf(Request $request)
    {
        $filters = $this->filters($request);

        $baseQuery = $this->queryLaporan($filters);
        $statistik = $this->statistik($baseQuery);

        $query = clone $baseQuery;

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $laporan = $query
            ->orderByDesc('created_at')
            ->get();

        $kegiatan = Kegiatan::orderBy('nama_kegiatan')->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'laporan',
            'filters',
            'statistik',
            'kegiatan'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('rekap-presensi-smarttrenmj.pdf');
    }
}
