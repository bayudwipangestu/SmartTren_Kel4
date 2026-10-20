
<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="margin:0;color:#718096;font-size:12px;">SmartTren / Mahasantri</p>
            <h2 style="margin:5px 0 0;font-size:24px;font-weight:700;color:#173b2b;">
                Data Akun
            </h2>
        </div>
    </x-slot>

    @php
        $bagian = request('bagian', '');
    @endphp

    <style>
        .account-page, .account-page * {
            box-sizing: border-box;
        }

        .account-card {
            width: 100%;
            min-width: 0;
            border: 1px solid #e2e8e5;
            border-radius: 14px;
            background: #fff;
            padding: 22px;
            box-shadow: 0 2px 8px rgba(20, 50, 35, .035);
        }

        .account-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 9px 15px;
            border: 1px solid #d5e0d9;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            background: white;
            color: #256448;
        }

        .account-button.primary {
            background: #087f50;
            color: white;
            border-color: #087f50;
        }

        .account-button:hover {
            filter: brightness(.96);
        }

        .account-page input:not([type="hidden"]),
        .account-page select,
        .account-page textarea {
            max-width: 100%;
        }

        @media (max-width: 600px) {
            .account-card {
                padding: 16px;
            }
        }
    </style>

    <div class="account-page"
         style="width:100%;max-width:900px;margin:0 auto;padding:24px 20px 40px;">

        @if (session('success'))
            <div style="margin-bottom:16px;padding:12px 15px;border:1px solid #b7e4c7;border-radius:9px;background:#effaf2;color:#166534;font-size:14px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Ringkasan akun --}}
        <section class="account-card" style="margin-bottom:18px;">
            <div style="display:flex;align-items:center;gap:16px;min-width:0;">
                <img
                    src="{{ $user->profile_photo_path
                        ? asset('storage/' . $user->profile_photo_path)
                        : 'data:image/svg+xml,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><circle cx="40" cy="40" r="40" fill="#e8f6ee"/><text x="40" y="53" font-size="32" text-anchor="middle" fill="#087f50">' . strtoupper(substr($user->name ?? 'U', 0, 1)) . '</text></svg>') }}"
                    alt="Foto profil"
                    style="width:76px;height:76px;min-width:76px;border-radius:50%;object-fit:cover;border:2px solid #e5f3e9;"
                >

                <div style="min-width:0;flex:1;">
                    <h3 style="margin:0;font-size:18px;font-weight:700;color:#24382e;overflow-wrap:anywhere;">
                        {{ $user->name }}
                    </h3>
                    <p style="margin:5px 0;color:#64748b;font-size:13px;overflow-wrap:anywhere;">
                        {{ $user->email }}
                    </p>
                    <span style="font-size:12px;color:#94a3b8;">
                        Akun Mahasantri SmartTrenMJ
                    </span>
                </div>
            </div>

            <div style="display:flex;flex-wrap:wrap;gap:9px;margin-top:20px;padding-top:17px;border-top:1px solid #edf1ee;">
                <a class="account-button"
                   href="{{ route('profile.edit', ['bagian' => 'foto']) }}">
                    Ubah Foto
                </a>

                <a class="account-button primary"
                   href="{{ route('profile.edit', ['bagian' => 'profil']) }}">
                    Edit Profil
                </a>

                <a class="account-button"
                   href="{{ route('profile.edit', ['bagian' => 'password']) }}">
                    Edit Password
                </a>
            </div>
        </section>

        {{-- Form foto hanya muncul ketika dipilih --}}
        @if ($bagian === 'foto')
            <section class="account-card" style="margin-bottom:18px;">
                <h3 style="margin:0 0 6px;font-size:17px;font-weight:700;color:#24382e;">
                    Ubah Foto Profil
                </h3>
                <p style="margin:0 0 18px;color:#718096;font-size:13px;">
                    Pilih foto JPG, PNG, atau WEBP dengan ukuran maksimal 2 MB.
                </p>

                <form action="{{ route('profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">

                    <input id="profile_photo"
                           name="profile_photo"
                           type="file"
                           accept="image/jpeg,image/png,image/webp"
                           required
                           style="display:block;width:100%;padding:10px;border:1px solid #d5ddd8;border-radius:8px;font-size:13px;">

                    @error('profile_photo')
                        <p style="margin:8px 0;color:#dc2626;font-size:13px;">
                            {{ $message }}
                        </p>
                    @enderror

                    <div style="display:flex;flex-wrap:wrap;gap:9px;margin-top:18px;">
                        <button class="account-button primary" type="submit">
                            Simpan Foto
                        </button>
                        <a class="account-button" href="{{ route('profile.edit') }}">
                            Batal
                        </a>
                    </div>
                </form>
            </section>
        @endif

        {{-- Form profil --}}
        @if ($bagian === 'profil')
            <section class="account-card" style="margin-bottom:18px;">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px;">
                    <h3 style="margin:0;font-size:17px;font-weight:700;color:#24382e;">
                        Edit Informasi Profil
                    </h3>
                    <a class="account-button" href="{{ route('profile.edit') }}">Batal</a>
                </div>

                @include('profile.partials.update-profile-information-form')
            </section>
        @endif

        {{-- Form password --}}
        @if ($bagian === 'password')
            <section class="account-card" style="margin-bottom:18px;">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px;">
                    <h3 style="margin:0;font-size:17px;font-weight:700;color:#24382e;">
                        Ganti Password
                    </h3>
                    <a class="account-button" href="{{ route('profile.edit') }}">Batal</a>
                </div>

                @include('profile.partials.update-password-form')
            </section>
        @endif

        {{-- Pengaturan tambahan --}}
        <details class="account-card">
            <summary style="cursor:pointer;font-size:14px;font-weight:600;color:#64748b;">
                Pengaturan akun lainnya
            </summary>

            <div style="margin-top:18px;padding-top:18px;border-top:1px solid #edf1ee;">
                @include('profile.partials.delete-user-form')
            </div>
        </details>

    </div>
</x-app-layout>
