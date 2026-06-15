<x-app-layout>

    <div style="margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between">
        <div>
            <h1 style="font-size:22px;font-weight:600;color:#412402">Klaim Saya</h1>
            <p style="font-size:14px;color:#854F0B">Tunjukkan kode ini ke kantin saat pengambilan</p>
        </div>
        <a href="{{ route('food-posts.index') }}" class="sk-nav-link">← Kembali</a>
    </div>

    @forelse($claims as $claim)
        <div class="sk-card">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                <div style="flex:1">
                    <div style="font-size:16px;font-weight:600;color:#412402;margin-bottom:6px">
                        {{ $claim->foodPost->nama_makanan }}
                    </div>
                    <div class="sk-meta">📍 {{ $claim->foodPost->lokasi }}</div>
                    <div class="sk-meta">⏰ Ambil sebelum {{ \Carbon\Carbon::parse($claim->foodPost->batas_waktu)->format('H:i, d M Y') }}</div>
                    <div style="margin-top:10px">
                        @if($claim->status === 'confirmed')
                            <span class="sk-status-confirmed">✅ Sudah diambil</span>
                        @else
                            <span class="sk-status-pending">⏳ Belum diambil</span>
                        @endif
                    </div>
                </div>

                <div style="text-align:center;background:#FFF8F0;border:1px solid #FAC775;border-radius:12px;padding:1rem;min-width:120px">
                    <p style="font-size:11px;color:#854F0B;margin-bottom:6px">Kode Klaim</p>
                    <div class="sk-kode">{{ $claim->kode_klaim }}</div>
                </div>
            </div>
        </div>
    @empty
        <div class="sk-empty">
            <div class="sk-empty-icon">🎫</div>
            <p>Belum ada klaim</p>
            <span>Klaim makanan tersedia dan kode akan muncul di sini</span>
            <br><br>
            <a href="{{ route('food-posts.index') }}" class="sk-btn-primary">Lihat Makanan Tersedia</a>
        </div>
    @endforelse

</x-app-layout>