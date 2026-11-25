<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MahasantriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiPresensiController;
use App\Http\Controllers\SuratIzinController; // <-- [BARU] Menambahkan controller Surat Izin
use App\Http\Controllers\Mahasantri\AkunController as MahasantriAkunController;
use App\Http\Controllers\Mahasantri\PresensiController as MahasantriPresensiController;
use App\Http\Controllers\Pengurus\PresensiController as PengurusPresensiController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD UTAMA
|--------------------------------------------------------------------------
|
| Setelah login, user diarahkan berdasarkan role.
|
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    return match ($user->role) {

        'admin' => redirect()->route('admin.dashboard'),

        'pengurus' => redirect()->route('pengurus.dashboard'),

        'mahasantri' => redirect()->route('mahasantri.dashboard'),

        default => abort(
            403,
            'Role pengguna tidak dikenali.'
        ),

    };

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            DashboardController::class,
            'admin'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | MANAGEMENT USER
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [
            UserController::class,
            'index'
        ])->name('users.index');

        Route::get('/users/create', [
            UserController::class,
            'create'
        ])->name('users.create');

        Route::post('/users', [
            UserController::class,
            'store'
        ])->name('users.store');

        Route::get('/users/{user}/edit', [
            UserController::class,
            'edit'
        ])->name('users.edit');

        Route::put('/users/{user}', [
            UserController::class,
            'update'
        ])->name('users.update');

        Route::delete('/users/{user}', [
            UserController::class,
            'destroy'
        ])->name('users.destroy');


        /*
        |--------------------------------------------------------------------------
        | QR CODE MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasantri/{mahasantri}/qr', [
            MahasantriController::class,
            'qr'
        ])->name('mahasantri.qr');


        /*
        |--------------------------------------------------------------------------
        | CRUD MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'mahasantri',
            MahasantriController::class
        );


        /*
        |--------------------------------------------------------------------------
        | CRUD KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'kegiatan',
            KegiatanController::class
        );

    });


/*
|--------------------------------------------------------------------------
| PENGURUS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pengurus'])
    ->prefix('pengurus')
    ->name('pengurus.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD PENGURUS
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            DashboardController::class,
            'pengurus'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | SESI PRESENSI
        |--------------------------------------------------------------------------
        |
        | Pengurus dapat:
        | - Melihat sesi
        | - Membuat sesi
        | - Melihat detail sesi
        | - Mengedit sesi
        | - Menghapus sesi
        |
        */

        Route::resource(
            'sesi-presensi',
            SesiPresensiController::class
        );


        /*
        |--------------------------------------------------------------------------
        | LAPORAN KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-kegiatan', [
            PengurusPresensiController::class,
            'laporanKegiatanIndex'
        ])->name('laporan-kegiatan.index');


        /*
        |--------------------------------------------------------------------------
        | LAPORAN SATU KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-kegiatan/{kegiatan}', [
            PengurusPresensiController::class,
            'laporanKegiatan'
        ])->name('laporan-kegiatan.show');


        /*
        |--------------------------------------------------------------------------
        | CETAK PDF LAPORAN KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-kegiatan/{kegiatan}/pdf', [
            PengurusPresensiController::class,
            'laporanKegiatanPdf'
        ])->name('laporan-kegiatan.pdf');


        /*
        |--------------------------------------------------------------------------
        | LAPORAN PRESENSI LAMA
        |--------------------------------------------------------------------------
        |
        | Tetap dipertahankan agar fitur sebelumnya
        | tidak langsung rusak.
        |
        */

        Route::get('/laporan-presensi', [
            PengurusPresensiController::class,
            'laporan'
        ])->name('laporan-presensi');


        /*
        |--------------------------------------------------------------------------
        | CETAK LAPORAN PRESENSI LAMA
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-presensi/pdf', [
            PengurusPresensiController::class,
            'laporanPdf'
        ])->name('laporan-presensi.pdf');


        /*
        |--------------------------------------------------------------------------
        | DAFTAR PRESENSI
        |--------------------------------------------------------------------------
        */

        Route::get('/presensi', [
            PengurusPresensiController::class,
            'index'
        ])->name('presensi.index');


        /*
        |--------------------------------------------------------------------------
        | SCANNER QR
        |--------------------------------------------------------------------------
        |
        | Scanner selalu berdasarkan sesi tertentu.
        |
        */

        Route::get('/presensi/{sesiPresensi}/scanner', [
            PengurusPresensiController::class,
            'scanner'
        ])->name('presensi.scanner');


        /*
        |--------------------------------------------------------------------------
        | PROSES SCAN QR
        |--------------------------------------------------------------------------
        */

        Route::post('/presensi/{sesiPresensi}/scan', [
            PengurusPresensiController::class,
            'scan'
        ])->name('presensi.scan');


        /*
        |--------------------------------------------------------------------------
        | REKAP SATU SESI
        |--------------------------------------------------------------------------
        */

        Route::get('/presensi/{sesiPresensi}/rekap', [
            PengurusPresensiController::class,
            'rekap'
        ])->name('presensi.rekap');


        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS PRESENSI
        |--------------------------------------------------------------------------
        |
        | Status:
        | - Hadir
        | - Izin
        | - Sakit
        | - Alpa
        |
        */

        Route::patch('/presensi/data/{presensi}', [
            PengurusPresensiController::class,
            'update'
        ])->name('presensi.update');


        /*
        |--------------------------------------------------------------------------
        | GENERATE ALPA
        |--------------------------------------------------------------------------
        |
        | Semua Mahasantri yang belum melakukan
        | presensi akan dibuat sebagai ALPA.
        |
        */

        Route::post('/presensi/{sesiPresensi}/generate-alpa', [
            PengurusPresensiController::class,
            'generateAlpa'
        ])->name('presensi.generate-alpa');

    });


/*
|--------------------------------------------------------------------------
| MAHASANTRI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:mahasantri'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasantri/dashboard', [
            DashboardController::class,
            'mahasantri'
        ])->name('mahasantri.dashboard');


        /*
        |--------------------------------------------------------------------------
        | PRESENSI MAHASANTRI
        |--------------------------------------------------------------------------
        |
        | Mahasantri TIDAK melakukan scan sendiri.
        |
        | Mahasantri hanya menampilkan QR Code miliknya.
        | Pengurus yang melakukan scan QR tersebut.
        |
        */

        Route::get('/mahasantri/presensi', [
            MahasantriPresensiController::class,
            'index'
        ])->name('mahasantri.presensi.index');


        /*
        |--------------------------------------------------------------------------
        | RIWAYAT PRESENSI MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasantri/riwayat-presensi', [
            MahasantriPresensiController::class,
            'riwayat'
        ])->name('mahasantri.presensi.riwayat');


        /*
        |--------------------------------------------------------------------------
        | REKAP PRESENSI MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasantri/rekap-presensi', [
            MahasantriPresensiController::class,
            'rekap'
        ])->name('mahasantri.presensi.rekap');


        /*
        |--------------------------------------------------------------------------
        | PENGAJUAN SURAT IZIN MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::post('/izin', [
            SuratIzinController::class,
            'store'
        ])->name('izin.store');


        /*
        |--------------------------------------------------------------------------
        | DATA AKUN MAHASANTRI
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasantri/akun', [
            MahasantriAkunController::class,
            'index'
        ])->name('mahasantri.akun');

        Route::put('/mahasantri/akun', [
            MahasantriAkunController::class,
            'update'
        ])->name('mahasantri.akun.update');

    });


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
|
| Route bawaan Laravel Breeze.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE EDIT
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');


    /*
    |--------------------------------------------------------------------------
    | PROFILE UPDATE
    |--------------------------------------------------------------------------
    */

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | PROFILE DELETE
    |--------------------------------------------------------------------------
    */

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
|
| Route bawaan Laravel Breeze.
|
*/

require __DIR__ . '/auth.php';