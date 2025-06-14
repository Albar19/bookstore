<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:flex">
                    <div class="md:w-1/3">
                        @if ($book->sampul)
                            <img src="{{ asset('storage/sampul_buku/' . $book->sampul) }}" alt="Sampul" class="w-full h-auto object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="p-8 md:p-12 md:w-2/3">
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">&larr; Kembali</a>
                        <h1 class="text-4xl font-bold text-gray-900">{{ $book->judul }}</h1>
                        <p class="mt-2 text-xl text-gray-600">oleh {{ $book->pengarang }}</p>
                        <div class="mt-8 border-t pt-6">
                            <p><span class="font-semibold">Penerbit:</span> {{ $book->penerbit }}</p>
                            <p><span class="font-semibold">Tahun:</span> {{ $book->tahun_terbit }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>