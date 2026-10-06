<x-app-layout>

    <div style="
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    ">

        {{-- HEADER --}}
        <div style="
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
        ">

            <h1 style="
                margin: 0;
                font-size: 28px;
                font-weight: 700;
                color: #1f2937;
            ">
                Edit Pengguna
            </h1>

            <p style="
                margin: 8px 0 0;
                color: #6b7280;
            ">
                Ubah data pengguna SmartTren.
            </p>

        </div>


        {{-- FORM --}}
        <div style="
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        ">

            <form
                method="POST"
                action="{{ route('admin.users.update', $user) }}"
            >

                @csrf
                @method('PUT')


                {{-- NAMA --}}
                <div style="margin-bottom: 20px;">

                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #374151;
                    ">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px 14px;
                            border: 1px solid #d1d5db;
                            border-radius: 10px;
                            font-size: 15px;
                        "
                    >

                    @error('name')
                        <div style="
                            color: #dc2626;
                            font-size: 14px;
                            margin-top: 6px;
                        ">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div style="margin-bottom: 20px;">

                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #374151;
                    ">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px 14px;
                            border: 1px solid #d1d5db;
                            border-radius: 10px;
                            font-size: 15px;
                        "
                    >

                    @error('email')
                        <div style="
                            color: #dc2626;
                            font-size: 14px;
                            margin-top: 6px;
                        ">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ROLE --}}
                <div style="margin-bottom: 28px;">

                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #374151;
                    ">
                        Role
                    </label>

                    <select
                        name="role"
                        required
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px 14px;
                            border: 1px solid #d1d5db;
                            border-radius: 10px;
                            font-size: 15px;
                            background: white;
                        "
                    >

                        <option
                            value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}
                        >
                            Admin
                        </option>

                        <option
                            value="pengurus"
                            {{ old('role', $user->role) === 'pengurus' ? 'selected' : '' }}
                        >
                            Pengurus
                        </option>

                        <option
                            value="mahasantri"
                            {{ old('role', $user->role) === 'mahasantri' ? 'selected' : '' }}
                        >
                            Mahasantri
                        </option>

                    </select>

                    @error('role')
                        <div style="
                            color: #dc2626;
                            font-size: 14px;
                            margin-top: 6px;
                        ">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- BUTTON --}}
                <div style="
                    display: flex;
                    gap: 12px;
                    align-items: center;
                ">

                    <a
                        href="{{ route('admin.users.index') }}"
                        style="
                            display: inline-block;
                            padding: 12px 20px;
                            background: #e5e7eb;
                            color: #374151;
                            text-decoration: none;
                            border-radius: 10px;
                            font-weight: 600;
                        "
                    >
                        Batal
                    </a>

                    <input
                        type="submit"
                        value="Update Pengguna"
                        style="
                            padding: 12px 22px;
                            background: #16a34a;
                            color: white;
                            border: none;
                            border-radius: 10px;
                            font-size: 15px;
                            font-weight: 600;
                            cursor: pointer;
                        "
                    >

                </div>

            </form>

        </div>

    </div>

</x-app-layout>