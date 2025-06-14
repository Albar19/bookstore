<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     // Menampilkan item di keranjang
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('book')->get();
        return view('cart.index', compact('cartItems'));
    }

    // Menambah item ke keranjang
    public function add(Request $request, Book $book)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                          ->where('book_id', $book->id)
                          ->first();

        if ($cartItem) {
            // Jika item sudah ada, tambah quantity
            $cartItem->increment('quantity');
        } else {
            // Jika item belum ada, buat item baru
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }
}