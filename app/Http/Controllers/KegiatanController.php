<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KegiatanController extends Controller
{
    /**
     * Menampilkan daftar semua kegiatan.
     */
    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(10);

        return view(
            'admin.kegiatan.index',
            compact('kegiatan')
        );
    }

    /**
     * Menampilkan form untuk menambahkan kegiatan.
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    /**
     * Menyimpan kegiatan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => [
                'required',
                'string',
                'max:100',
                'unique:kegiatan,nama_kegiatan',
            ],

            'deskripsi' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'nonaktif',
                ]),
            ],
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'nama_kegiatan.unique' => 'Nama kegiatan tersebut sudah tersedia.',
            'nama_kegiatan.max' => 'Nama kegiatan maksimal 100 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
            'status.required' => 'Status kegiatan wajib dipilih.',
            'status.in' => 'Status kegiatan tidak valid.',
        ]);

        DB::transaction(function () use ($validated) {
            Kegiatan::create([
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.kegiatan.index')
            ->with(
                'success',
                'Kegiatan berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail satu kegiatan.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view(
            'admin.kegiatan.show',
            compact('kegiatan')
        );
    }

    /**
     * Menampilkan form edit kegiatan.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view(
            'admin.kegiatan.edit',
            compact('kegiatan')
        );
    }

    /**
     * Memperbarui data kegiatan.
     */
    public function update(
        Request $request,
        Kegiatan $kegiatan
    ) {
        $validated = $request->validate([
            'nama_kegiatan' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kegiatan', 'nama_kegiatan')
                    ->ignore($kegiatan->id),
            ],

            'deskripsi' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'nonaktif',
                ]),
            ],
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'nama_kegiatan.unique' => 'Nama kegiatan tersebut sudah digunakan.',
            'nama_kegiatan.max' => 'Nama kegiatan maksimal 100 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
            'status.required' => 'Status kegiatan wajib dipilih.',
            'status.in' => 'Status kegiatan tidak valid.',
        ]);

        DB::transaction(function () use (
            $validated,
            $kegiatan
        ) {
            $kegiatan->update([
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.kegiatan.index')
            ->with(
                'success',
                'Kegiatan berhasil diperbarui.'
            );
    }

    /**
     * Menghapus kegiatan.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        /*
        |--------------------------------------------------------------------------
        | Cek apakah kegiatan masih digunakan
        |--------------------------------------------------------------------------
        |
        | Untuk tahap CRUD sekarang, kegiatan langsung dihapus.
        | Nanti ketika tabel sesi_presensi/presensi sudah dibuat,
        | bagian ini akan kita sesuaikan agar kegiatan yang sudah
        | memiliki data presensi tidak sembarangan dihapus.
        |
        */

        DB::transaction(function () use ($kegiatan) {
            $kegiatan->delete();
        });

        return redirect()
            ->route('admin.kegiatan.index')
            ->with(
                'success',
                'Kegiatan berhasil dihapus.'
            );
    }
}