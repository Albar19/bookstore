<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:flex">
                    <div class="md:w-1/3">
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            @if ($book->sampul)
                                <img src="{{ asset('storage/' . $book->sampul) }}" alt="Sampul {{ $book->judul }}" class="w-full h-full object-cover">
                            @else
                                {{-- Gambar placeholder jika tidak ada sampul --}}
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 rounded">
                                    <span class="text-gray-400 text-xs">No Image</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="p-8 md:p-12 md:w-2/3">
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">&larr; Kembali ke Koleksi</a>
                        <h1 class="text-4xl font-bold text-gray-900">{{ $book->judul }}</h1>
                        <p class="mt-2 text-xl text-gray-600">oleh {{ $book->pengarang }}</p>
                        
                        <div class="mt-8 border-t pt-6">
                            <p class="mb-2"><span class="font-semibold">Penerbit:</span> {{ $book->penerbit }}</p>
                            <p><span class="font-semibold">Tahun Terbit:</span> {{ $book->tahun_terbit }}</p>

                            {{-- Tombol Masukkan ke Keranjang --}}
                            @auth
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" class="mt-6">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition ease-in-out duration-150">
                                        + Masukkan ke Keranjang
                                    </button>
                                </form>
                            @else
                                <div class="mt-6 p-4 bg-gray-100 rounded-lg text-center border">
                                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:underline">Login untuk mulai membeli</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<head>
    <!-- ...existing code... -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- ...existing code... -->
</head>