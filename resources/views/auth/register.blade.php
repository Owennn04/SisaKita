<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — SisaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #FFFBF5; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1.5rem; }
        .container { width: 100%; max-width: 420px; }
        .brand { text-align: center; margin-bottom: 1.5rem; }
        .brand-icon { font-size: 48px; }
        .brand-name { font-size: 24px; font-weight: 600; color: #412402; margin-top: 8px; }
        .brand-tagline { font-size: 13px; color: #854F0B; margin-top: 4px; }
        .card { background: #ffffff; border: 1px solid #FAC775; border-radius: 16px; padding: 2rem; }
        .card-title { font-size: 18px; font-weight: 600; color: #412402; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1.25rem; }
        .label { font-size: 14px; font-weight: 500; color: #412402; margin-bottom: 6px; display: block; }
        .input { width: 100%; border: 1px solid #FAC775; border-radius: 8px; padding: 10px 14px; font-size: 14px; color: #412402; background: #FFFBF5; outline: none; transition: border 0.2s; }
        .input:focus { border-color: #EF9F27; background: #ffffff; }
        .error { color: #991B1B; font-size: 12px; margin-top: 4px; }
        .btn { width: 100%; background: #EF9F27; color: #412402; border: none; border-radius: 8px; padding: 11px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .btn:hover { background: #BA7517; color: #FAEEDA; }
        .divider { text-align: center; margin: 1.25rem 0; font-size: 13px; color: #854F0B; }
        .link { color: #EF9F27; text-decoration: none; font-weight: 500; }
        .link:hover { color: #BA7517; }
        .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 6px; }
        .role-option { position: relative; }
        .role-option input { position: absolute; opacity: 0; width: 0; height: 0; }
        .role-label {
            display: block;
            border: 1.5px solid #FAC775;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #FFFBF5;
        }
        .role-label:hover { border-color: #EF9F27; background: #FFF8F0; }
        .role-option input:checked + .role-label {
            border-color: #EF9F27;
            background: #FFF3E0;
            box-shadow: 0 0 0 2px #EF9F2733;
        }
        .role-icon { font-size: 24px; margin-bottom: 4px; }
        .role-name { font-size: 13px; font-weight: 600; color: #412402; }
        .role-desc { font-size: 11px; color: #854F0B; margin-top: 2px; }
        .footer-tip { background: #FFF8F0; border: 1px solid #FAC775; border-radius: 12px; padding: 1rem; margin-top: 1.5rem; text-align: center; font-size: 13px; color: #854F0B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">
            <div class="brand-icon">🍱</div>
            <div class="brand-name">SisaKita</div>
            <div class="brand-tagline">Bergabung dan kurangi food waste kampus</div>
        </div>

        <div class="card">
            <div class="card-title">Buat akun baru</div>

            @if ($errors->any())
                <div style="background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;padding:12px;border-radius:8px;font-size:13px;margin-bottom:1rem">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="input" placeholder="Nama kamu" required autofocus>
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="input" placeholder="kamu@email.com" required>
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input" placeholder="Min. 8 karakter" required>
                    @error('password') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="input" placeholder="Ulangi password" required>
                </div>

                <div class="form-group">
                    <label class="label">Daftar Sebagai</label>
                    <div class="role-grid">
                        <div class="role-option">
                            <input type="radio" name="role" id="role_mahasiswa" value="mahasiswa"
                                   {{ old('role', 'mahasiswa') === 'mahasiswa' ? 'checked' : '' }}>
                            <label class="role-label" for="role_mahasiswa">
                                <div class="role-icon">🎓</div>
                                <div class="role-name">Mahasiswa</div>
                                <div class="role-desc">Klaim makanan sisa</div>
                            </label>
                        </div>
                        <div class="role-option">
                            <input type="radio" name="role" id="role_kantin" value="kantin"
                                   {{ old('role') === 'kantin' ? 'checked' : '' }}>
                            <label class="role-label" for="role_kantin">
                                <div class="role-icon">🏪</div>
                                <div class="role-name">Kantin</div>
                                <div class="role-desc">Post makanan sisa</div>
                            </label>
                        </div>
                    </div>
                    @error('role') <p class="error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn">Buat Akun</button>
            </form>

            <div class="divider">
                Sudah punya akun? <a href="{{ route('login') }}" class="link">Masuk di sini</a>
            </div>
        </div>

        <div class="footer-tip">
            🌱 Setiap porsi yang diselamatkan = 1 langkah menuju kampus bebas food waste
        </div>
    </div>
</body>
</html>