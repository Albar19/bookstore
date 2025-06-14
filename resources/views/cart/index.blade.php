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

                    @if($cartItems->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left">Pilih</th>
                                        <th class="px-6 py-3 text-left">Produk</th>
                                        <th class="px-6 py-3 text-center">Jumlah</th>
                                        <th class="px-6 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="px-6 py-4">
                                                {{-- Checkbox ini terhubung ke form 'checkout-form' di bawah --}}
                                                <input form="checkout-form" type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    @if($item->book?->sampul)
                                                        <img class="h-16 w-12 object-cover rounded" src="{{ asset('storage/' . $item->book->sampul) }}" alt="Sampul buku">
                                                    @else
                                                        <div class="h-16 w-12 bg-gray-200 rounded flex items-center justify-center">
                                                            <span class="text-xs text-gray-400">No Img</span>
                                                        </div>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->book->judul ?? 'Buku tidak tersedia' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center">
                                                    {{-- Form untuk tombol kurang (-) --}}
                                                    <form action="{{ route('cart.decrease', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-8 h-8 bg-gray-200 rounded-full font-bold hover:bg-gray-300">-</button>
                                                    </form>
                                                    <span class="mx-4 font-medium">{{ $item->quantity }}</span>
                                                    {{-- Form untuk tombol tambah (+) --}}
                                                    <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-8 h-8 bg-gray-200 rounded-full font-bold hover:bg-gray-300">+</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                {{-- Form untuk tombol hapus --}}
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Form untuk checkout SEKARANG BERADA DI LUAR TABLE --}}
                        <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET" class="text-right mt-6">
                            <button type="submit" class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition">
                                Checkout Item Terpilih
                            </button>
                        </form>
                    @else
                        <p class="text-center py-8">Keranjang Anda masih kosong.</p>
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-5 rounded-lg hover:bg-blue-700 transition">Mulai Belanja &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>