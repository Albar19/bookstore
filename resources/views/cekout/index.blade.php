<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Ringkasan Pesanan</h3>
                    <ul>
                    @foreach($cartItems as $item)
                        <li class="flex justify-between py-2 border-b">
                            <span>{{ $item->book->judul }} ({{ $item->quantity }}x)</span>
                        </li>
                    @endforeach
                    </ul>

                    <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition">
                            Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>