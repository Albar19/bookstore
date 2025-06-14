<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->judul }} - Bookstore Sederhana</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center font-bold text-xl">Bookstore</a>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="font-medium text-gray-600 hover:text-gray-900">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-900">Log in</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

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
    </div>
</body>
</html>