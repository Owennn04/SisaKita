<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SisaKita — Makanan Sisa, Bukan Sampah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #FFFBF5; }

        .sk-navbar {
            background: #ffffff;
            border-bottom: 1px solid #FAC775;
            padding: 14px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .sk-brand {
            font-size: 18px;
            font-weight: 600;
            color: #633806;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sk-brand span { font-size: 22px; }
        .sk-nav-links { display: flex; gap: 12px; align-items: center; }
        .sk-nav-link {
            font-size: 14px;
            color: #854F0B;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .sk-nav-link:hover { background: #FFF3E0; }
        .sk-nav-btn {
            background: #EF9F27;
            color: #412402;
            border: none;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .sk-nav-btn:hover { background: #BA7517; color: #FAEEDA; }

        .sk-main { max-width: 900px; margin: 0 auto; padding: 2rem 1.5rem; }

        .sk-alert-success {
            background: #ECFDF5;
            border: 1px solid #6EE7B7;
            color: #065F46;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 14px;
        }
        .sk-alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 14px;
        }

        .sk-stat-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 1.5rem;
        }
        .sk-stat {
            background: #FFF8F0;
            border: 1px solid #FAC775;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }
        .sk-stat-num { font-size: 28px; font-weight: 600; color: #412402; }
        .sk-stat-label { font-size: 12px; color: #854F0B; margin-top: 4px; }

        .sk-card {
            background: #ffffff;
            border: 1px solid #FAC775;
            border-radius: 14px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: box-shadow 0.2s;
        }
        .sk-card:hover { box-shadow: 0 4px 16px rgba(239,159,39,0.12); }
        .sk-card-title { font-size: 16px; font-weight: 600; color: #412402; }
        .sk-badge {
            background: #FAEEDA;
            color: #633806;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        .sk-meta { font-size: 13px; color: #854F0B; margin: 4px 0; }

        .sk-btn-primary {
            background: #EF9F27;
            color: #412402;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }
        .sk-btn-primary:hover { background: #BA7517; color: #FAEEDA; }
        .sk-btn-danger {
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }
        .sk-btn-danger:hover { background: #FEE2E2; }

        .sk-empty {
            background: #FFF8F0;
            border: 1.5px dashed #FAC775;
            border-radius: 14px;
            padding: 3rem;
            text-align: center;
            color: #854F0B;
        }
        .sk-empty-icon { font-size: 40px; margin-bottom: 12px; }
        .sk-empty p { font-size: 15px; font-weight: 500; color: #412402; }
        .sk-empty span { font-size: 13px; color: #854F0B; }

        .sk-form-group { margin-bottom: 1.25rem; }
        .sk-label { font-size: 14px; font-weight: 500; color: #412402; margin-bottom: 6px; display: block; }
        .sk-input {
            width: 100%;
            border: 1px solid #FAC775;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            color: #412402;
            background: #FFFBF5;
            outline: none;
            transition: border 0.2s;
        }
        .sk-input:focus { border-color: #EF9F27; background: #ffffff; }
        .sk-error { color: #991B1B; font-size: 12px; margin-top: 4px; }

        .sk-section-title {
            font-size: 16px;
            font-weight: 600;
            color: #412402;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sk-section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #FAC775;
        }

        .sk-kode {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 6px;
            color: #EF9F27;
        }
        .sk-status-pending {
            background: #FAEEDA;
            color: #633806;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
        }
        .sk-status-confirmed {
            background: #ECFDF5;
            color: #065F46;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <nav class="sk-navbar">
        <a href="{{ route('food-posts.index') }}" class="sk-brand">
            <span>🍱</span> SisaKita
        </a>
        <div class="sk-nav-links">
            @auth
                <a href="{{ route('food-posts.index') }}" class="sk-nav-link">Makanan</a>
                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('claims.my') }}" class="sk-nav-link">Klaim Saya</a>
                @endif
                @if(auth()->user()->role === 'kantin')
                    <a href="{{ route('claims.kantin') }}" class="sk-nav-link">Klaim Masuk</a>
                    <a href="{{ route('food-posts.create') }}" class="sk-btn-primary">+ Post Makanan</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="sk-nav-link" style="background:none;border:none;cursor:pointer">Keluar</button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="sk-main">
        {{ $slot }}
    </main>

    <footer style="text-align:center;padding:2rem;color:#854F0B;font-size:13px;border-top:1px solid #FAC775;margin-top:2rem;background:#FFF8F0">
        🍱 SisaKita — Kurangi food waste, bantu sesama mahasiswa
    </footer>
</body>
</html>