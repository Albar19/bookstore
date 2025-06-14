<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <h3 class="text-2xl font-medium mb-6">Ringkasan Pesanan Anda</h3>

                    <div class="border rounded-lg p-4">
                        <ul class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <li class="flex justify-between items-center py-3">
                                <div>
                                    <p class="font-semibold">{{ $item->book->judul ?? 'Buku tidak tersedia' }}</p>
                                    <p class="text-sm text-gray-500">Jumlah: {{ $item->quantity }}</p>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                    {{-- Form untuk menyelesaikan pesanan --}}
                    <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
                        @csrf
                        {{-- Kirim ID item yang di-checkout agar bisa dihapus dari keranjang --}}
                        <input type="hidden" name="checkout_items" value="{{ json_encode($cartItems->pluck('id')) }}">

                        <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition duration-150 ease-in-out">
                            Buat Pesanan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>