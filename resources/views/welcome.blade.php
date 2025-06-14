<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">Etalase Buku</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($books as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="block group">
                                <div class="bg-white overflow-hidden border rounded-lg h-full flex flex-col transform transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-xl">
                                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                        @if ($book->sampul)
                                            <img src="{{ asset('storage/sampul_buku/' . $book->sampul) }}" alt="Sampul" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </div>
                                    <div class="p-4 flex-grow flex flex-col">
                                        <h3 class="font-bold text-lg text-gray-800 truncate group-hover:text-blue-600">{{ $book->judul }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $book->pengarang }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center text-gray-500 py-10">
                                <p>Belum ada buku yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-8">{{ $books->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>