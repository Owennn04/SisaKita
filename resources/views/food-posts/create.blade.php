<x-app-layout>

    <div style="max-width:600px;margin:0 auto">

        {{-- Header --}}
        <div style="text-align:center;margin-bottom:1.5rem">
            <div style="font-size:36px;margin-bottom:8px">🍱</div>
            <h1 style="font-size:22px;font-weight:600;color:#412402;margin-bottom:6px">Post Makanan Sisa</h1>
            <p style="font-size:14px;color:#854F0B">Bantu mahasiswa lain dan kurangi food waste kampus</p>
        </div>

        {{-- Form --}}
        <div class="sk-card">
            <form action="{{ route('food-posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="sk-form-group">
                    <label class="sk-label">🍽️ Nama Makanan</label>
                    <input type="text" name="nama_makanan" value="{{ old('nama_makanan') }}"
                           class="sk-input" placeholder="contoh: Nasi Ayam Goreng">
                    @error('nama_makanan')
                        <p class="sk-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">🔢 Jumlah Porsi</label>
                    <input type="number" name="jumlah_porsi" value="{{ old('jumlah_porsi') }}"
                           class="sk-input" placeholder="contoh: 5" min="1">
                    @error('jumlah_porsi')
                        <p class="sk-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">📍 Lokasi Pengambilan</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                           class="sk-input" placeholder="contoh: Kantin Gedung A Lt. 1">
                    @error('lokasi')
                        <p class="sk-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">⏰ Batas Waktu Pengambilan</label>
                    <input type="datetime-local" name="batas_waktu" value="{{ old('batas_waktu') }}"
                           class="sk-input">
                    @error('batas_waktu')
                        <p class="sk-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">📸 Foto Makanan (opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="sk-input">
                    @error('foto')
                        <p class="sk-error">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display:flex;gap:10px;margin-top:1.5rem">
                    <button type="submit" class="sk-btn-primary" style="flex:1;text-align:center">
                        Post Makanan Sekarang
                    </button>
                    <a href="{{ route('food-posts.index') }}"
                       style="flex:1;text-align:center;padding:9px 18px;border:1px solid #FAC775;border-radius:8px;color:#854F0B;font-size:14px;text-decoration:none;display:inline-block">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- Tips --}}
        <div style="background:#FFF8F0;border:1px solid #FAC775;border-radius:12px;padding:1rem;margin-top:1rem">
            <p style="font-size:13px;font-weight:600;color:#412402;margin-bottom:6px">💡 Tips posting</p>
            <ul style="font-size:13px;color:#854F0B;padding-left:16px;line-height:1.8">
                <li>Post makanan minimal 1 jam sebelum tutup</li>
                <li>Cantumkan lokasi yang jelas agar mudah ditemukan</li>
                <li>Foto akan membantu mahasiswa tertarik untuk klaim</li>
            </ul>
        </div>
    </div>

</x-app-layout>