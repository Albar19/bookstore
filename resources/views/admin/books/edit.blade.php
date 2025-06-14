<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $book->judul) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="pengarang" class="block text-sm font-medium text-gray-700">Pengarang</label>
                            <input type="text" name="pengarang" id="pengarang" value="{{ old('pengarang', $book->pengarang) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="sampul" class="block text-sm font-medium text-gray-700">Ganti Sampul (Opsional)</label>
                            <input type="file" name="sampul" id="sampul" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                            @if ($book->sampul)
                                <div class="mt-4">
                                    <p class="text-sm">Sampul saat ini:</p>
                                    <img src="{{ asset('storage/sampul_buku/' . $book->sampul) }}" alt="Sampul saat ini" class="w-32 h-auto rounded mt-2">
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.books.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>