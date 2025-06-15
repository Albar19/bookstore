<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-center text-gray-900">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat Datang di Alber's Bookstore</h1>
                    <p class="text-xl text-gray-600 mb-8">Tempat Anda menemukan dunia baru dalam setiap lembaran.</p>
                    <p class="max-w-3xl mx-auto mb-8">
                        Kami adalah surga bagi para pencinta buku. Dari novel fiksi yang mendebarkan hingga buku-buku non-fiksi yang mencerahkan, koleksi kami dipilih secara saksama untuk memenuhi dahaga pengetahuan dan imajinasi Anda. Mulailah petualangan literasi Anda bersama kami hari ini.
                    </p>
                    {{-- Tombol ini mengarahkan pengguna ke halaman daftar buku --}}
                    <a href="{{ route('etalase') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        Jelajahi Koleksi Buku Kami &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>