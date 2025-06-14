<x-app-layout>
    <main>
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                @if ($book->sampul)
                                    <img src="{{ asset('storage/sampul_buku/' . $book->sampul) }}" alt="Sampul {{ $book->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <span>No Image</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="p-8 md:p-12 md:w-2/3">
                            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">&larr; Kembali ke Koleksi</a>
                            <h1 class="text-4xl font-bold text-gray-900">{{ $book->judul }}</h1>
                            <p class="mt-2 text-xl text-gray-600">oleh {{ $book->pengarang }}</p>
                            <div class="mt-8 border-t pt-6">
                                <h3 class="font-semibold text-lg">Detail Buku</h3>
                                <div class="mt-4 grid grid-cols-1 gap-x-4 gap-y-2 text-gray-700">
                                    <div><span class="font-semibold">Penerbit:</span> {{ $book->penerbit }}</div>
                                    <div><span class="font-semibold">Tahun Terbit:</span> {{ $book->tahun_terbit }}</div>
                                    <div><span class="font-semibold">Ditambahkan:</span> {{ $book->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>