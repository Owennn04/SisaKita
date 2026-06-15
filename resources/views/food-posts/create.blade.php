<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Makanan Sisa
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('food-posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Makanan</label>
                    <input type="text" name="nama_makanan" value="{{ old('nama_makanan') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="contoh: Nasi Ayam">
                    @error('nama_makanan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Porsi</label>
                    <input type="number" name="jumlah_porsi" value="{{ old('jumlah_porsi') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="contoh: 5" min="1">
                    @error('jumlah_porsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Pengambilan</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="contoh: Kantin Gedung A">
                    @error('lokasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batas Waktu Pengambilan</label>
                    <input type="datetime-local" name="batas_waktu" value="{{ old('batas_waktu') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('batas_waktu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto (opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                           class="w-full border rounded px-3 py-2">
                    @error('foto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Post Makanan
                    </button>
                    <a href="{{ route('food-posts.index') }}"
                       class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>