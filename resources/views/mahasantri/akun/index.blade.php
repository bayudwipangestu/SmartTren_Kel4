<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun Mahasantri - SmartTren</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f0fdf4;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 18px;
            background: #166534;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .back:hover {
            background: #14532d;
        }

        .header {
            background: linear-gradient(135deg, #166534, #15803d);
            color: white;
            padding: 28px 30px;
            border-radius: 18px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .header p {
            margin: 8px 0 0;
            opacity: .9;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .07);
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #374151;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #166534;
        }

        .hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #166534;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: #14532d;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('mahasantri.dashboard') }}" class="back">
            ← Kembali ke Dashboard
        </a>

        <div class="header">
            <h1>Data Akun Mahasantri</h1>
            <p>Kelola informasi nama, email, dan kata sandi akun Anda.</p>
        </div>

        <div class="card">
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mahasantri.akun.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter">
                    <div class="hint">Kosongkan jika tidak ingin mengganti password.</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>

</html>