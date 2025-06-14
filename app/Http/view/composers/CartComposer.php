<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Hanya jalankan jika user sudah login
        if (Auth::check()) {
            // Hitung jumlah item unik di keranjang milik user yang sedang login
            $cartCount = Cart::where('user_id', Auth::id())->count();
            $view->with('cartCount', $cartCount);
        } else {
            // Jika belum login, jumlah item adalah 0
            $view->with('cartCount', 0);
        }
    }
}