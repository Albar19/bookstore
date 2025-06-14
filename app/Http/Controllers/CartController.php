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

    // --- METHOD BARU UNTUK UPDATE JUMLAH ---
    public function update(Request $request, Cart $cart)
    {
        // Pastikan item keranjang ini milik user yang login
        if ($cart->user_id != Auth::id()) {
            return back()->with('error', 'Aksi tidak diizinkan.');
        }

        // Validasi quantity
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah item berhasil diperbarui.');
    }

    // --- METHOD BARU UNTUK HAPUS ITEM ---
    public function destroy(Cart $cart)
    {
        // Pastikan item keranjang ini milik user yang login
        if ($cart->user_id != Auth::id()) {
            return back()->with('error', 'Aksi tidak diizinkan.');
        }

        $cart->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    /**
 * Menambah jumlah (quantity) item di keranjang.
 */
public function increase(Cart $cart)
{
    if ($cart->user_id != Auth::id()) {
        return back()->with('error', 'Aksi tidak diizinkan.');
    }
    $cart->increment('quantity');
    return back(); // Kembali tanpa pesan agar lebih cepat
}

/**
 * Mengurangi jumlah (quantity) item di keranjang.
 */
public function decrease(Cart $cart)
{
    if ($cart->user_id != Auth::id()) {
        return back()->with('error', 'Aksi tidak diizinkan.');
    }

    // Jika jumlah sisa 1, maka hapus itemnya
    if ($cart->quantity > 1) {
        $cart->decrement('quantity');
    } else {
        $cart->delete();
    }
    return back();
}
}