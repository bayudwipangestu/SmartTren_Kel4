<?php

namespace App\Http\Controllers;

use App\Models\Mahasantri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MahasantriController extends Controller
{
    /**
     * Menampilkan daftar Mahasantri.
     */
    public function index()
    {
        $mahasantri = Mahasantri::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.mahasantri.index', compact('mahasantri'));
    }

    /**
     * Menampilkan form tambah Mahasantri.
     */
    public function create()
    {
        return view('admin.mahasantri.create');
    }

    /**
     * Menyimpan Mahasantri baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'nim' => [
                'required',
                'string',
                'max:30',
                'unique:mahasantri,nim',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],

            'kamar' => [
                'required',
                'string',
                'max:50',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
        ]);

        DB::transaction(function () use ($validated) {

            /*
            |--------------------------------------------------------------------------
            | Membuat akun User
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'mahasantri',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Membuat ID QR unik
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | MHS-A8K2P9XQ7Z
            |
            */

            do {
                $qrCode = 'MHS-' . strtoupper(str()->random(10));
            } while (
                Mahasantri::where('qr_code', $qrCode)->exists()
            );

            /*
            |--------------------------------------------------------------------------
            | Membuat data Mahasantri
            |--------------------------------------------------------------------------
            */

            Mahasantri::create([
                'user_id' => $user->id,
                'nim' => $validated['nim'],
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'kamar' => $validated['kamar'],
                'no_hp' => $validated['no_hp'] ?? null,
                'qr_code' => $qrCode,
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.mahasantri.index')
            ->with(
                'success',
                'Data Mahasantri berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail Mahasantri.
     */
    public function show(Mahasantri $mahasantri)
    {
        $mahasantri->load('user');

        return view(
            'admin.mahasantri.show',
            compact('mahasantri')
        );
    }

    /**
     * Menampilkan form edit Mahasantri.
     */
    public function edit(Mahasantri $mahasantri)
    {
        $mahasantri->load('user');

        return view(
            'admin.mahasantri.edit',
            compact('mahasantri')
        );
    }

    /**
     * Memperbarui data Mahasantri.
     */
    public function update(
        Request $request,
        Mahasantri $mahasantri
    ) {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'nim' => [
                'required',
                'string',
                'max:30',
                Rule::unique('mahasantri', 'nim')
                    ->ignore($mahasantri->id),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($mahasantri->user_id),
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],

            'kamar' => [
                'required',
                'string',
                'max:50',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $mahasantri
        ) {

            /*
            |--------------------------------------------------------------------------
            | Update User
            |--------------------------------------------------------------------------
            */

            if ($mahasantri->user) {
                $mahasantri->user->update([
                    'name' => $validated['nama'],
                    'email' => $validated['email'],
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Update Mahasantri
            |--------------------------------------------------------------------------
            */

            $mahasantri->update([
                'nim' => $validated['nim'],
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'kamar' => $validated['kamar'],
                'no_hp' => $validated['no_hp'] ?? null,
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.mahasantri.index')
            ->with(
                'success',
                'Data Mahasantri berhasil diperbarui.'
            );
    }

    /**
     * Menampilkan QR Code Mahasantri.
     */
    public function qr(Mahasantri $mahasantri)
    {
        $mahasantri->load('user');

        return view(
            'admin.mahasantri.qr',
            compact('mahasantri')
        );
    }

    /**
     * Menghapus Mahasantri.
     */
    public function destroy(Mahasantri $mahasantri)
    {
        DB::transaction(function () use ($mahasantri) {

            /*
            |--------------------------------------------------------------------------
            | Simpan User terlebih dahulu
            |--------------------------------------------------------------------------
            */

            $user = $mahasantri->user;

            /*
            |--------------------------------------------------------------------------
            | Hapus Mahasantri
            |--------------------------------------------------------------------------
            */

            $mahasantri->delete();

            /*
            |--------------------------------------------------------------------------
            | Hapus User
            |--------------------------------------------------------------------------
            */

            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('admin.mahasantri.index')
            ->with(
                'success',
                'Data Mahasantri berhasil dihapus.'
            );
    }
}