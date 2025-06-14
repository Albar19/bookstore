<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Temukan Buku Favoritmu</h2>
                    <p class="text-gray-600 mb-8">Jelajahi koleksi kami untuk petualangan literasi berikutnya.</p>

                    <div class="mb-8">
                        <form action="{{ route('home') }}" method="GET">
                            <input type="text" name="search" placeholder="Cari berdasarkan judul atau pengarang..." class="w-full md:w-1/2 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg ml-2 shadow-sm">Cari</button>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($books as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="block group">
                                <div class="bg-white overflow-hidden border rounded-lg h-full flex flex-col transform transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-xl">
                                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                        @if ($book->sampul)
                                            <img src="{{ asset('storage/sampul_buku/' . $book->sampul) }}" alt="Sampul {{ $book->judul }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="p-4 flex-grow flex flex-col">
                                        <h3 class="font-bold text-lg text-gray-800 truncate group-hover:text-blue-600">{{ $book->judul }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">oleh {{ $book->pengarang }}</p>
                                        <div class="mt-auto pt-2">
                                            <p class="text-xs text-gray-500">{{ $book->penerbit }} - {{ $book->tahun_terbit }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center text-gray-500 py-10">
                                <p>Belum ada buku yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>