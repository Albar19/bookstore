<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/book/{book}', [HomeController::class, 'show'])->name('books.show');

// Halaman yang Butuh Login
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Universal
    Route::get('/dashboard', function () {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // Halaman Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Grup Khusus Admin
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        // Route baru untuk dashboard admin yang berisi perkenalan
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route untuk kelola buku
        Route::resource('books', BookController::class);
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    // ... (route dashboard, profile, dll)

    // Route untuk Keranjang Belanja
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{book}', [CartController::class, 'add'])->name('add');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    // ... (route lain) ...

    // Route untuk Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

require __DIR__.'/auth.php';