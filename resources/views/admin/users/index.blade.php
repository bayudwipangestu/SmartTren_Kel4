<x-admin-layout
    title="Management User"
    breadcrumb="Management User"
>

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h2>Management User</h2>

            <p>
                Kelola akun pengguna dan role yang memiliki akses
                ke sistem SmartTren.
            </p>
        </div>

        <button
    type="button"
    class="btn-primary"
    id="openCreateUserModal"
>
    <svg width="17" height="17" viewBox="0 0 24 24"
         fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"/>
        <line x1="5" y1="12" x2="19" y2="12"/>
    </svg>
    Tambah User
</button>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div class="alert-success">

            <div class="alert-icon">
                ✓
            </div>

            <div>

                <div class="alert-title">
                    Berhasil
                </div>

                <div class="alert-message">
                    {{ session('success') }}
                </div>

            </div>

        </div>

    @endif


    {{-- VALIDATION ERROR --}}
    @if ($errors->any())

        <div class="alert-error">

            <div class="alert-error-icon">
                !
            </div>

            <div>

                <div class="alert-title">
                    Terjadi Kesalahan
                </div>

                @foreach ($errors->all() as $error)

                    <div class="alert-message">
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        </div>

    @endif


    {{-- SUMMARY --}}
    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon blue">
                👥
            </div>

            <div>

                <div class="summary-label">
                    Total User
                </div>

                <div class="summary-number">
                    {{ number_format($totalUser) }}
                </div>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon green">
                A
            </div>

            <div>

                <div class="summary-label">
                    Administrator
                </div>

                <div class="summary-number">
                    {{ number_format($totalAdmin) }}
                </div>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon purple">
                P
            </div>

            <div>

                <div class="summary-label">
                    Pengurus
                </div>

                <div class="summary-number">
                    {{ number_format($totalPengurus) }}
                </div>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon orange">
                M
            </div>

            <div>

                <div class="summary-label">
                    Mahasantri
                </div>

                <div class="summary-number">
                    {{ number_format($totalMahasantri) }}
                </div>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="content-card">

        <div class="table-header">

            <div>

                <h3>
                    Daftar Pengguna
                </h3>

                <p>
                    Semua akun yang terdaftar pada sistem.
                </p>

            </div>

            <div class="table-total">

                {{ number_format($users->total()) }} pengguna

            </div>

        </div>


        <div class="table-wrapper">

            <table class="user-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Pengguna</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Terdaftar</th>

                        <th class="text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($users as $index => $user)

                        <tr>

                            {{-- NUMBER --}}

                            <td class="number-cell">

                                {{ $users->firstItem() + $index }}

                            </td>


                            {{-- USER --}}

                            <td>

                                <div class="user-information">

                                    <div class="user-avatar">

                                        {{ strtoupper(
                                            substr($user->name, 0, 1)
                                        ) }}

                                    </div>

                                    <div>

                                        <div class="user-name">

                                            {{ $user->name }}

                                        </div>

                                        <div class="user-id">

                                            ID #{{ $user->id }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}

                            <td>

                                <span class="email-text">

                                    {{ $user->email }}

                                </span>

                            </td>


                            {{-- ROLE --}}

                            <td>

                                @if ($user->role === 'admin')

                                    <span class="role-badge admin">

                                        <span class="role-dot"></span>

                                        Administrator

                                    </span>

                                @elseif ($user->role === 'pengurus')

                                    <span class="role-badge pengurus">

                                        <span class="role-dot"></span>

                                        Pengurus

                                    </span>

                                @else

                                    <span class="role-badge mahasantri">

                                        <span class="role-dot"></span>

                                        Mahasantri

                                    </span>

                                @endif

                            </td>


                            {{-- CREATED --}}

                            <td>

                                <div class="date-text">

                                    {{ $user->created_at
                                        ? $user->created_at->format('d M Y')
                                        : '-'
                                    }}

                                </div>

                            </td>


                            {{-- ACTION --}}

                            <td>

                                <div class="action-wrapper">

                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route(
                                            'admin.users.edit',
                                            $user
                                        ) }}"
                                        class="action-button edit"
                                        title="Edit User"
                                    >

                                        <svg
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="M12 20h9"/>
                                            <path
                                                d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- DELETE --}}

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.users.destroy',
                                            $user
                                        ) }}"
                                        onsubmit="
                                            return confirm(
                                                'Yakin ingin menghapus user ini?'
                                            );
                                        "
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-button delete"
                                            title="Hapus User"
                                        >

                                            <svg
                                                width="16"
                                                height="16"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty-state"
                            >

                                <div class="empty-icon">
                                    👥
                                </div>

                                <div class="empty-title">
                                    Belum ada pengguna
                                </div>

                                <div class="empty-text">
                                    Tambahkan pengguna pertama
                                    untuk mulai menggunakan sistem.
                                </div>

                                <a
                                    href="{{ route(
                                        'admin.users.create'
                                    ) }}"
                                    class="empty-button"
                                >
                                    Tambah User
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if ($users->hasPages())

            <div class="pagination-wrapper">

                <div class="pagination-info">

                    Menampilkan

                    <strong>
                        {{ $users->firstItem() }}
                    </strong>

                    sampai

                    <strong>
                        {{ $users->lastItem() }}
                    </strong>

                    dari

                    <strong>
                        {{ $users->total() }}
                    </strong>

                    pengguna

                </div>


                <div class="pagination-links">

                    {{ $users->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>


    {{-- INFORMATION --}}

    <div class="information-box">

        <div class="information-icon">
            i
        </div>

        <div>

            <div class="information-title">
                Informasi Hak Akses
            </div>

            <div class="information-text">

                <strong>Administrator</strong>
                memiliki akses pengelolaan sistem.

                <strong>Pengurus</strong>
                mengelola proses presensi dan laporan.

                <strong>Mahasantri</strong>
                melakukan presensi dan melihat riwayat
                kehadiran.

            </div>

        </div>

    </div>


    
{{-- MODAL TAMBAH USER --}}
<div class="user-modal-overlay" id="createUserModal" aria-hidden="true">
    <div class="user-modal">
        <div class="user-modal-header">
            <div>
                <span class="user-modal-label">MANAGEMENT USER</span>
                <h2>Tambah Pengguna</h2>
                <p>Buat akun baru untuk sistem SmartTren.</p>
            </div>
            <button type="button" id="closeCreateUserModal"
                    class="user-modal-close" aria-label="Tutup">&times;</button>
        </div>

        @if ($errors->any())
            <div class="user-modal-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="user-field">
                <label for="modal_name">Nama</label>
                <input id="modal_name" type="text" name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap" required>
                @error('name') <small>{{ $message }}</small> @enderror
            </div>

            <div class="user-field">
                <label for="modal_email">Email</label>
                <input id="modal_email" type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="nama@smarttren.test" required>
                @error('email') <small>{{ $message }}</small> @enderror
            </div>

            <div class="user-field">
                <label for="modal_password">Password</label>
                <input id="modal_password" type="password" name="password"
                       minlength="8" placeholder="Minimal 8 karakter" required>
                @error('password') <small>{{ $message }}</small> @enderror
            </div>

            <div class="user-field">
                <label for="modal_role">Role</label>
                <select id="modal_role" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pengurus" {{ old('role') === 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                    <option value="mahasantri" {{ old('role') === 'mahasantri' ? 'selected' : '' }}>Mahasantri</option>
                </select>
                @error('role') <small>{{ $message }}</small> @enderror
            </div>

            <div class="user-modal-actions">
                <button type="button" id="cancelCreateUserModal"
                        class="user-btn-cancel">Batal</button>
                <button type="submit" class="user-btn-save">
                    + Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.user-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(12, 35, 28, .52);
    backdrop-filter: blur(4px);
}
.user-modal-overlay.is-open { display: flex; }

.user-modal {
    width: 100%;
    max-width: 540px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 26px;
    background: #fff;
    border: 1px solid #e2ece6;
    border-radius: 18px;
    box-shadow: 0 24px 70px rgba(0, 0, 0, .22);
}
.user-modal-header {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 23px;
    padding-bottom: 18px;
    border-bottom: 1px solid #edf1ee;
}
.user-modal-label {
    color: #07865b;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
}
.user-modal-header h2 {
    margin: 7px 0 4px;
    color: #173c31;
    font-size: 23px;
    font-weight: 800;
}
.user-modal-header p {
    margin: 0;
    color: #7b8982;
    font-size: 12px;
}
.user-modal-close {
    width: 36px;
    height: 36px;
    border: 1px solid #e3ebe6;
    border-radius: 10px;
    background: #f8faf9;
    color: #53645b;
    font-size: 24px;
    cursor: pointer;
}
.user-field { margin-bottom: 17px; }
.user-field label {
    display: block;
    margin-bottom: 7px;
    color: #30483d;
    font-size: 12px;
    font-weight: 700;
}
.user-field input, .user-field select {
    width: 100%;
    min-height: 43px;
    box-sizing: border-box;
    padding: 10px 12px;
    border: 1px solid #dce6e0;
    border-radius: 9px;
    background: #fff;
    color: #203b30;
    font-size: 13px;
}
.user-field input:focus, .user-field select:focus {
    outline: none;
    border-color: #07865b;
    box-shadow: 0 0 0 3px rgba(7, 134, 91, .1);
}
.user-field small {
    display: block;
    margin-top: 5px;
    color: #dc2626;
    font-size: 11px;
}
.user-modal-error {
    margin-bottom: 16px;
    padding: 12px;
    border: 1px solid #fecaca;
    border-radius: 9px;
    background: #fff5f5;
    color: #b91c1c;
    font-size: 12px;
}
.user-modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid #edf1ee;
}
.user-btn-cancel, .user-btn-save {
    padding: 11px 16px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}
.user-btn-cancel {
    border: 1px solid #dce6e0;
    background: white;
    color: #52645c;
}
.user-btn-save {
    border: 1px solid #07865b;
    background: #07865b;
    color: white;
}
.user-btn-save:hover { background: #066d4a; }
body.user-modal-active { overflow: hidden; }

@media (max-width: 560px) {
    .user-modal { padding: 20px; }
    .user-modal-actions { flex-direction: column-reverse; }
    .user-btn-cancel, .user-btn-save { width: 100%; }
}
</style>

<script>
(() => {
    const modal = document.getElementById('createUserModal');
    const openButton = document.getElementById('openCreateUserModal');
    const closeButton = document.getElementById('closeCreateUserModal');
    const cancelButton = document.getElementById('cancelCreateUserModal');

    if (!modal || !openButton) return;

    function openModal() {
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('user-modal-active');
        modal.querySelector('input[name="name"]').focus();
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('user-modal-active');
        openButton.focus();
    }

    openButton.addEventListener('click', openModal);
    closeButton.addEventListener('click', closeModal);
    cancelButton.addEventListener('click', closeModal);

    modal.addEventListener('click', event => {
        if (event.target === modal) closeModal();
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });

    // Buka kembali modal otomatis apabila validasi Laravel gagal.
    @if ($errors->any())
        openModal();
    @endif
})();
</script>


    <style>

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 21px;
            font-weight: 750;
            color: #111827;
        }

        .page-header p {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 11px;
        }


        .btn-primary {
            height: 39px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 15px;
            border-radius: 8px;
            background: #047857;
            color: white;
            text-decoration: none;
            font-size: 10px;
            font-weight: 750;
            box-shadow: 0 4px 10px rgba(4,120,87,.12);
            transition: .2s ease;
        }

        .btn-primary:hover {
            background: #065f46;
            transform: translateY(-1px);
        }


        .alert-success,
        .alert-error {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 14px;
            margin-bottom: 18px;
            border-radius: 10px;
        }

        .alert-success {
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
        }

        .alert-error {
            border: 1px solid #fecaca;
            background: #fef2f2;
        }

        .alert-icon,
        .alert-error-icon {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 800;
        }

        .alert-icon {
            background: #dcfce7;
            color: #15803d;
        }

        .alert-error-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .alert-title {
            font-size: 10px;
            font-weight: 750;
            color: #166534;
        }

        .alert-error .alert-title {
            color: #991b1b;
        }

        .alert-message {
            margin-top: 2px;
            font-size: 9px;
            color: #64748b;
        }


        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin-bottom: 22px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            padding: 16px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
        }

        .summary-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 800;
        }

        .summary-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .summary-icon.green {
            background: #ecfdf5;
            color: #047857;
        }

        .summary-icon.purple {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .summary-icon.orange {
            background: #fff7ed;
            color: #ea580c;
        }

        .summary-label {
            color: #94a3b8;
            font-size: 9px;
        }

        .summary-number {
            margin-top: 3px;
            color: #111827;
            font-size: 20px;
            font-weight: 800;
        }


        .content-card {
            overflow: hidden;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 13px;
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-header h3 {
            margin: 0;
            font-size: 14px;
            font-weight: 750;
            color: #1f2937;
        }

        .table-header p {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 9px;
        }

        .table-total {
            flex-shrink: 0;
            padding: 6px 9px;
            border-radius: 6px;
            background: #f8fafc;
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
        }


        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .user-table th {
            height: 43px;
            padding: 0 18px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            color: #64748b;
            font-size: 9px;
            font-weight: 750;
            white-space: nowrap;
        }

        .user-table td {
            height: 68px;
            padding: 8px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 10px;
            white-space: nowrap;
        }

        .user-table tbody tr:hover {
            background: #fafdfb;
        }

        .user-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .text-right {
            text-align: right !important;
        }

        .number-cell {
            width: 45px;
            color: #94a3b8 !important;
        }


        .user-information {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 9px;
            background: #ecfdf5;
            color: #047857;
            font-size: 11px;
            font-weight: 800;
        }

        .user-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #1f2937;
            font-size: 10px;
            font-weight: 750;
        }

        .user-id {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 8px;
        }

        .email-text {
            color: #64748b;
        }

        .date-text {
            color: #64748b;
            font-size: 9px;
        }


        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            min-height: 23px;
            padding: 0 8px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 750;
        }

        .role-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .role-badge.admin {
            background: #ecfdf5;
            color: #047857;
        }

        .role-badge.pengurus {
            background: #eff6ff;
            color: #2563eb;
        }

        .role-badge.mahasantri {
            background: #fff7ed;
            color: #ea580c;
        }


        .action-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .action-button {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            border: 1px solid;
            cursor: pointer;
            text-decoration: none;
            background: white;
            transition: .2s ease;
        }

        .action-button.edit {
            border-color: #dbeafe;
            color: #2563eb;
        }

        .action-button.edit:hover {
            background: #eff6ff;
        }

        .action-button.delete {
            border-color: #fee2e2;
            color: #dc2626;
        }

        .action-button.delete:hover {
            background: #fef2f2;
        }


        .empty-state {
            height: 250px !important;
            text-align: center !important;
            white-space: normal !important;
        }

        .empty-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            border-radius: 12px;
            background: #f8fafc;
            font-size: 20px;
        }

        .empty-title {
            color: #374151;
            font-size: 12px;
            font-weight: 750;
        }

        .empty-text {
            max-width: 300px;
            margin: 5px auto 12px;
            color: #94a3b8;
            font-size: 9px;
        }

        .empty-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            padding: 0 12px;
            border-radius: 7px;
            background: #047857;
            color: white;
            text-decoration: none;
            font-size: 9px;
            font-weight: 700;
        }


        /* PAGINATION */

        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 18px;
            border-top: 1px solid #f1f5f9;
        }

        .pagination-info {
            color: #64748b;
            font-size: 9px;
        }

        .pagination-info strong {
            color: #374151;
        }

        .pagination-links {
            flex-shrink: 0;
        }

        .pagination-links nav {
            display: flex;
            align-items: center;
        }

        .pagination-links nav > div {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pagination-links a,
        .pagination-links span {
            min-width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 8px;
            border-radius: 7px;
            font-size: 9px;
            font-weight: 600;
            text-decoration: none;
        }

        .pagination-links a {
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #64748b;
        }

        .pagination-links a:hover {
            background: #ecfdf5;
            border-color: #bbf7d0;
            color: #047857;
        }

        .pagination-links span[aria-current="page"] {
            background: #047857;
            color: #fff;
        }


        .information-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 18px;
            padding: 14px 16px;
            border: 1px solid #dbeafe;
            border-radius: 10px;
            background: #f8fbff;
        }

        .information-icon {
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            font-size: 11px;
            font-weight: 800;
        }

        .information-title {
            font-size: 10px;
            font-weight: 750;
            color: #1e40af;
        }

        .information-text {
            margin-top: 3px;
            color: #64748b;
            font-size: 9px;
            line-height: 1.7;
        }

        .information-text strong {
            color: #475569;
        }


        @media (max-width: 1050px) {

            .summary-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 650px) {

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-primary {
                width: 100%;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .pagination-wrapper {
                align-items: flex-start;
                flex-direction: column;
            }

        }

    </style>

</x-admin-layout>