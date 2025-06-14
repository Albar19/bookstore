<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border-green-400 text-green-700 border-l-4 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                         <div class="bg-red-100 border-red-400 text-red-700 border-l-4 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if($cartItems->isNotEmpty())
                        {{-- Form untuk proses checkout --}}
                        <form action="{{ route('checkout.index') }}" method="GET">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="px-6 py-4">
                                                    {{-- Checkbox untuk memilih item --}}
                                                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-16 w-12">
                                                            <img class="h-16 w-12 object-cover rounded" src="{{ asset('storage/sampul_buku/' . $item->book->sampul) }}" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $item->book->judul }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{-- Form untuk update jumlah --}}
                                                    <div>
                                                        <!-- Update quantity form moved outside the main form -->
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border-gray-300 rounded-md">
                                                            <button type="submit" class="ml-2 p-1 text-xs bg-gray-200 rounded hover:bg-gray-300">Update</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    {{-- Form untuk hapus item --}}
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="text-right mt-6">
                                <button type="submit" class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition">
                                    Checkout Item Terpilih
                                </button>
                            </div>
                        </form>
                    @else
                        <p>Keranjang Anda masih kosong.</p>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline mt-4 inline-block">Mulai Belanja &rarr;</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>