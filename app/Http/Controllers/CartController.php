<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('book')->latest()->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, Book $book)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('book_id', $book->id)->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create(['user_id' => Auth::id(), 'book_id' => $book->id, 'quantity' => 1]);
        }
        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    // --- METHOD BARU UNTUK TOMBOL TAMBAH (+) ---
    public function increase(Cart $cart)
    {
        if ($cart->user_id != Auth::id()) { abort(403); }
        $cart->increment('quantity');
        return back(); // Kembali ke halaman keranjang
    }

    // --- METHOD BARU UNTUK TOMBOL KURANG (-) ---
    public function decrease(Cart $cart)
    {
        if ($cart->user_id != Auth::id()) { abort(403); }

        // Jika jumlah lebih dari 1, kurangi. Jika sisa 1, hapus itemnya.
        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        } else {
            $cart->delete();
        }
        return back();
    }

    // --- METHOD UNTUK TOMBOL HAPUS ---
    public function destroy(Cart $cart)
    {
        if ($cart->user_id != Auth::id()) { abort(403); }
        $cart->delete();
        return back()->with('success', 'Item berhasil dihapus.');
    }
}