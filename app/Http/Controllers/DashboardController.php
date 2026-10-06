<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function admin(): View
    {
        return view('dashboard.admin');
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