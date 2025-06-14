<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('book')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('info', 'Keranjang Anda kosong, silakan belanja terlebih dahulu.');
        }
        return view('checkout.index', compact('cartItems'));
    }

    // Memproses pesanan
    public function store(Request $request)
    {
        // Di sini seharusnya ada logika untuk menyimpan pesanan ke tabel 'orders'
        // dan integrasi pembayaran.
        // Untuk saat ini, kita hanya akan mengosongkan keranjang.

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('home')->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }
}