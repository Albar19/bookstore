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
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($cartItems->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">Produk</th>
                                    <th class="px-6 py-3 text-left">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="px-6 py-4">{{ $item->book->judul }}</td>
                                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right mt-6">
                            <a href="#" class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition">
                                Lanjutkan ke Checkout
                            </a>
                        </div>
                    @else
                        <p>Keranjang Anda masih kosong.</p>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline mt-4 inline-block">Mulai Belanja &rarr;</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>