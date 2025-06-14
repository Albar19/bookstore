<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Selamat Datang, {{ Auth::user()->name }}!</h3>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-500 uppercase tracking-wider">Total Buku</h4>
                        <p class="mt-2 text-3xl font-bold">{{ $totalBooks }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-500 uppercase tracking-wider">Total Pengguna</h4>
                        <p class="mt-2 text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900">Navigasi Cepat</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.books.index') }}" class="bg-blue-600 text-white font-bold py-4 px-6 rounded-lg text-center hover:bg-blue-700 transition">
                        Kelola Semua Buku
                    </a>
                    <a href="{{ route('admin.books.create') }}" class="bg-green-600 text-white font-bold py-4 px-6 rounded-lg text-center hover:bg-green-700 transition">
                        Tambah Buku Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>