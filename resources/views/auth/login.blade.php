<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — SisaKita</title>
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
        .checkbox-row { display: flex; align-items: center; gap: 8px; margin-bottom: 1.25rem; }
        .checkbox-row label { font-size: 13px; color: #854F0B; }
        .btn { width: 100%; background: #EF9F27; color: #412402; border: none; border-radius: 8px; padding: 11px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .btn:hover { background: #BA7517; color: #FAEEDA; }
        .divider { text-align: center; margin: 1.25rem 0; font-size: 13px; color: #854F0B; }
        .link { color: #EF9F27; text-decoration: none; font-weight: 500; }
        .link:hover { color: #BA7517; }
        .footer-tip { background: #FFF8F0; border: 1px solid #FAC775; border-radius: 12px; padding: 1rem; margin-top: 1.5rem; text-align: center; font-size: 13px; color: #854F0B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">
            <div class="brand-icon">🍱</div>
            <div class="brand-name">SisaKita</div>
            <div class="brand-tagline">Makanan sisa, bukan sampah</div>
        </div>

        <div class="card">
            <div class="card-title">Masuk ke akunmu</div>

            @if ($errors->any())
                <div style="background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;padding:12px;border-radius:8px;font-size:13px;margin-bottom:1rem">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="input" placeholder="kamu@email.com" required autofocus>
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input" placeholder="••••••••" required>
                    @error('password') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="checkbox-row">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn">Masuk</button>
            </form>

            <div class="divider">
                Belum punya akun? <a href="{{ route('register') }}" class="link">Daftar sekarang</a>
            </div>

            @if (Route::has('password.request'))
                <div style="text-align:center">
                    <a href="{{ route('password.request') }}" class="link" style="font-size:13px">Lupa password?</a>
                </div>
            @endif
        </div>

        <div class="footer-tip">
            🌱 Bergabung dan bantu kurangi food waste di kampusmu
        </div>
    </div>
</body>
</html>