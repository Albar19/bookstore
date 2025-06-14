<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// --- HALAMAN PUBLIK ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/book/{book}', [HomeController::class, 'show'])->name('books.show');

// --- HALAMAN YANG BUTUH LOGIN ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Universal (Pintu gerbang setelah login)
    Route::get('/dashboard', function () {
        if (Auth::user()->role == 'admin') {
            // Jika admin, arahkan ke route dashboard admin yang baru
            return redirect()->route('admin.dashboard');
        } else {
            // Jika user biasa, tampilkan dashboard sederhana
            return view('dashboard');
        }
    })->name('dashboard');

    // Halaman Profile Bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang Belanja & Checkout
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{book}', [CartController::class, 'add'])->name('add');
        Route::post('/increase/{cart}', [CartController::class, 'increase'])->name('increase');
        Route::post('/decrease/{cart}', [CartController::class, 'decrease'])->name('decrease');
        Route::delete('/remove/{cart}', [CartController::class, 'destroy'])->name('remove');
    });
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // --- GRUP KHUSUS ADMIN ---
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        // Route untuk dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Route untuk kelola buku
        Route::resource('books', BookController::class);
    });
});

require __DIR__.'/auth.php';