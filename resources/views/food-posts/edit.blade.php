<x-app-layout>

    <div style="max-width:600px;margin:0 auto">

        <div style="text-align:center;margin-bottom:1.5rem">
            <div style="font-size:36px;margin-bottom:8px">✏️</div>
            <h1 style="font-size:22px;font-weight:600;color:#412402;margin-bottom:6px">Edit Makanan</h1>
            <p style="font-size:14px;color:#854F0B">Update informasi makanan yang kamu post</p>
        </div>

        <div class="sk-card">
            <form action="{{ route('food-posts.update', $foodPost) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="sk-form-group">
                    <label class="sk-label">🍽️ Nama Makanan</label>
                    <input type="text" name="nama_makanan" value="{{ old('nama_makanan', $foodPost->nama_makanan) }}"
                           class="sk-input">
                    @error('nama_makanan') <p class="sk-error">{{ $message }}</p> @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">🔢 Jumlah Porsi</label>
                    <input type="number" name="jumlah_porsi" value="{{ old('jumlah_porsi', $foodPost->jumlah_porsi) }}"
                           class="sk-input" min="1">
                    @error('jumlah_porsi') <p class="sk-error">{{ $message }}</p> @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">📍 Lokasi Pengambilan</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $foodPost->lokasi) }}"
                           class="sk-input">
                    @error('lokasi') <p class="sk-error">{{ $message }}</p> @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">⏰ Batas Waktu Pengambilan</label>
                    <input type="datetime-local" name="batas_waktu"
                           value="{{ old('batas_waktu', \Carbon\Carbon::parse($foodPost->batas_waktu)->format('Y-m-d\TH:i')) }}"
                           class="sk-input">
                    @error('batas_waktu') <p class="sk-error">{{ $message }}</p> @enderror
                </div>

                <div class="sk-form-group">
                    <label class="sk-label">📸 Foto Makanan (opsional)</label>
                    @if($foodPost->foto)
                        <div style="margin-bottom:8px">
                            <img src="{{ asset('storage/' . $foodPost->foto) }}"
                                 style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:1px solid #FAC775">
                            <p style="font-size:12px;color:#854F0B;margin-top:4px">Foto saat ini — upload baru untuk mengganti</p>
                        </div>
                    @endif
                    <input type="file" name="foto" accept="image/*" class="sk-input">
                    @error('foto') <p class="sk-error">{{ $message }}</p> @enderror
                </div>

                <div style="display:flex;gap:10px;margin-top:1.5rem">
                    <button type="submit" class="sk-btn-primary" style="flex:1;text-align:center">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('food-posts.index') }}"
                       style="flex:1;text-align:center;padding:9px 18px;border:1px solid #FAC775;border-radius:8px;color:#854F0B;font-size:14px;text-decoration:none;display:inline-block">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>