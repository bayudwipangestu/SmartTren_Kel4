<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan daftar seluruh pengguna.
     */
    public function index(): View
    {
        $users = User::orderBy('name')->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Menampilkan form tambah pengguna.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    public function edit(User $user): View
{
    return view(
        'admin.users.edit',
        compact('user')
    );
}

    /**
     * Menyimpan pengguna baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'role' => [
                'required',
                'in:admin,pengurus,mahasantri',
            ],
        ]);

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Pengguna berhasil ditambahkan.'
            );
    }
    public function update(
    Request $request,
    User $user
): RedirectResponse {
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email,' . $user->id,
        ],

        'role' => [
            'required',
            'in:admin,pengurus,mahasantri',
        ],
    ]);

    $user->update($validated);

    return redirect()
        ->route('admin.users.index')
        ->with(
            'success',
            'Data pengguna berhasil diperbarui.'
        );
}

public function destroy(User $user): RedirectResponse
{
    // Mencegah admin menghapus akun yang sedang digunakan
    if ($user->id === auth()->id()) {
        return back()->with(
            'error',
            'Anda tidak dapat menghapus akun yang sedang digunakan.'
        );
    }

    $user->delete();

    return redirect()
        ->route('admin.users.index')
        ->with(
            'success',
            'Pengguna berhasil dihapus.'
        );
}
}