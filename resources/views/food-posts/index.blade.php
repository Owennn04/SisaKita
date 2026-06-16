<x-app-layout>

    {{-- Hero --}}
    <div style="background:#FFF8F0;border:1px solid #FAC775;border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;text-align:center">
        <div style="font-size:36px;margin-bottom:8px">🍱</div>
        <h1 style="font-size:22px;font-weight:600;color:#412402;margin-bottom:6px">Makanan sisa, bukan sampah</h1>
        <p style="font-size:14px;color:#854F0B">Temukan makanan gratis dari kantin kampus sebelum terbuang sia-sia.</p>
    </div>

    {{-- Stats --}}
    <div class="sk-stat-row">
        <div class="sk-stat">
            <div class="sk-stat-num">{{ \App\Models\Claim::count() }}</div>
            <div class="sk-stat-label">Porsi diselamatkan</div>
        </div>
        <div class="sk-stat">
            <div class="sk-stat-num">{{ \App\Models\User::where('role','kantin')->count() }}</div>
            <div class="sk-stat-label">Kantin aktif</div>
        </div>
        <div class="sk-stat">
            <div class="sk-stat-num">{{ $foodPosts->count() }}</div>
            <div class="sk-stat-label">Tersedia sekarang</div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="sk-alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="sk-alert-error">❌ {{ session('error') }}</div>
    @endif

    {{-- Section title --}}
    <div class="sk-section-title">Makanan tersedia hari ini</div>

    {{-- Daftar makanan --}}
    @forelse($foodPosts as $post)
        <div class="sk-card">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px">
                <div style="flex:1">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                        <span class="sk-card-title">{{ $post->nama_makanan }}</span>
                        <span class="sk-badge">{{ $post->jumlah_porsi }} porsi</span>
                    </div>
                    <div class="sk-meta">📍 {{ $post->lokasi }}</div>
                    <div class="sk-meta">⏰ Ambil sebelum {{ \Carbon\Carbon::parse($post->batas_waktu)->format('H:i, d M Y') }}</div>
                    <div class="sk-meta">👤 Oleh: {{ $post->user->name }}</div>
                </div>

                @if($post->foto)
                    <img src="{{ asset('storage/' . $post->foto) }}"
                         style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:1px solid #FAC775"
                         alt="foto makanan">
                @else
                    <div style="width:80px;height:80px;background:#FFF8F0;border:1px solid #FAC775;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:28px">🍽️</div>
                @endif
            </div>

            <div style="margin-top:12px;display:flex;gap:8px">
                @if(auth()->user()->role === 'mahasiswa')
                    <form action="{{ route('claims.store', $post) }}" method="POST">
                        @csrf
                        <button type="submit" class="sk-btn-primary">Klaim Sekarang</button>
                    </form>
                @endif

                @if(auth()->user()->role === 'kantin' && auth()->id() === $post->user_id)
                    <a href="{{ route('food-posts.edit', $post) }}" class="sk-btn-primary">Edit</a>
                    <form action="{{ route('food-posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sk-btn-danger"
                                onclick="return confirm('Hapus post ini?')">Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="sk-empty">
            <div class="sk-empty-icon">🍽️</div>
            <p>Belum ada makanan tersedia saat ini</p>
            <span>Cek lagi nanti atau ikuti update dari kantin favoritmu!</span>
        </div>
    @endforelse

</x-app-layout>