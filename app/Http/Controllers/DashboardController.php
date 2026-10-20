<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Mahasantri;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function admin(): View
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK USER
        |--------------------------------------------------------------------------
        */

        $totalUser = User::count();

        $totalAdmin = User::where('role', 'admin')->count();

        $totalPengurus = User::where('role', 'pengurus')->count();

        $totalMahasantriUser = User::where(
            'role',
            'mahasantri'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK MAHASANTRI
        |--------------------------------------------------------------------------
        */

        $totalMahasantri = Mahasantri::count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK KEGIATAN
        |--------------------------------------------------------------------------
        */

        $totalKegiatan = Kegiatan::count();

        $kegiatanAktif = Kegiatan::where(
            'status',
            'aktif'
        )->count();

        $kegiatanNonaktif = Kegiatan::where(
            'status',
            'nonaktif'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | DATA TERBARU
        |--------------------------------------------------------------------------
        */

        $mahasantriTerbaru = Mahasantri::with('user')
            ->latest()
            ->take(6)
            ->get();


        $userTerbaru = User::latest()
            ->take(6)
            ->get();


        $kegiatanTerbaru = Kegiatan::latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard.admin', compact(
            'totalUser',
            'totalAdmin',
            'totalPengurus',
            'totalMahasantriUser',
            'totalMahasantri',
            'totalKegiatan',
            'kegiatanAktif',
            'kegiatanNonaktif',
            'mahasantriTerbaru',
            'userTerbaru',
            'kegiatanTerbaru',
        ));
    }


    /**
     * Dashboard Pengurus
     */
    public function pengurus(): View
    {
        return view('dashboard.pengurus');
    }


    /**
     * Dashboard Mahasantri
     */
    public function mahasantri(): View
    {
        return view('dashboard.mahasantri');
    }
}