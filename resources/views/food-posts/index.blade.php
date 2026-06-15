<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Makanan Tersedia
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if(auth()->user()->role === 'kantin')
    <div class="mb-6 flex gap-3">
        <a href="{{ route('food-posts.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Post Makanan Sisa
        </a>
        <a href="{{ route('claims.kantin') }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Lihat Klaim Masuk
        </a>
    </div>
@endif

        @forelse($foodPosts as $post)
            <div class="bg-white rounded-lg shadow p-5 mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $post->nama_makanan }}</h3>
                        <p class="text-gray-500 text-sm">📍 {{ $post->lokasi }}</p>
                        <p class="text-gray-500 text-sm">⏰ Ambil sebelum: {{ \Carbon\Carbon::parse($post->batas_waktu)->format('H:i, d M Y') }}</p>
                        <p class="text-gray-700 mt-1">Sisa: <strong>{{ $post->jumlah_porsi }} porsi</strong></p>
                    </div>

                    @if($post->foto)
                        <img src="{{ asset('storage/' . $post->foto) }}"
                             class="w-24 h-24 object-cover rounded" alt="foto makanan">
                    @endif
                </div>

                <div class="mt-4 flex gap-2">
                    @if(auth()->user()->role === 'mahasiswa')
                        <form action="{{ route('claims.store', $post) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Klaim Sekarang
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->role === 'kantin' && auth()->id() === $post->user_id)
                        <form action="{{ route('food-posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                    onclick="return confirm('Hapus post ini?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-12">
                <p class="text-xl">Belum ada makanan tersedia saat ini.</p>
                <p class="text-sm mt-2">Cek lagi nanti!</p>
            </div>
        @endforelse

        @if(auth()->user()->role === 'mahasiswa')
            <div class="mt-6 text-center">
                <a href="{{ route('claims.my') }}" class="text-blue-600 underline">
                    Lihat Klaim Saya
                </a>
            </div>
        @endif
    </div>
</x-app-layout>