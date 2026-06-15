<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Klaim Saya
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4">

        <div class="mb-4">
            <a href="{{ route('food-posts.index') }}" class="text-blue-600 underline text-sm">
                ← Kembali ke daftar makanan
            </a>
        </div>

        @forelse($claims as $claim)
            <div class="bg-white rounded-lg shadow p-5 mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $claim->foodPost->nama_makanan }}</h3>
                        <p class="text-gray-500 text-sm">📍 {{ $claim->foodPost->lokasi }}</p>
                        <p class="text-gray-500 text-sm">⏰ Ambil sebelum: {{ \Carbon\Carbon::parse($claim->foodPost->batas_waktu)->format('H:i, d M Y') }}</p>
                    </div>

                    <div class="text-right">
                        <p class="text-sm text-gray-500">Kode Klaim</p>
                        <p class="text-2xl font-bold tracking-widest text-green-600">
                            {{ $claim->kode_klaim }}
                        </p>
                        <span class="text-xs px-2 py-1 rounded-full
                            {{ $claim->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $claim->status === 'confirmed' ? 'Sudah diambil' : 'Belum diambil' }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-12">
                <p class="text-xl">Belum ada klaim.</p>
                <a href="{{ route('food-posts.index') }}" class="text-blue-600 underline text-sm">
                    Lihat makanan tersedia
                </a>
            </div>
        @endforelse
    </div>
</x-app-layout>