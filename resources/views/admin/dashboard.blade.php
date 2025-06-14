<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <h3 class="text-2xl font-bold">Selamat Datang di Bookstore, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600">
                        Ini adalah pusat kendali Anda. Jelajahi koleksi kami yang terus bertambah atau kelola data buku jika Anda adalah admin.
                    </p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-900">Baru Ditambahkan</h3>
                <p class="text-sm text-gray-500 mb-4">Lihat buku-buku terbaru dalam koleksi kami.</p>

                @if($latestBooks->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($latestBooks as $book)
                            <a href="{{ route('books.show', $book) }}" class="block group">
                                <div class="bg-white overflow-hidden border rounded-lg h-full flex flex-col">
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        @if ($book->sampul)
                                            <img src="{{ asset('storage/sampul_buku/' . $book->sampul) }}" alt="Sampul {{ $book->judul }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-md text-gray-800 truncate group-hover:text-blue-600">{{ $book->judul }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ $book->pengarang }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Belum ada buku yang ditambahkan.</p>
                @endif
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-900">Panel Admin</h3>
                <p class="text-sm text-gray-500 mb-4">Akses cepat untuk mengelola data bookstore.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.books.index') }}" class="bg-blue-600 text-white font-bold py-4 px-6 rounded-lg text-center hover:bg-blue-700 transition">
                        Kelola Semua Buku ({{ $totalBooks }})
                    </a>
                    <a href="{{ route('admin.books.create') }}" class="bg-green-600 text-white font-bold py-4 px-6 rounded-lg text-center hover:bg-green-700 transition">
                        Tambah Buku Baru
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>