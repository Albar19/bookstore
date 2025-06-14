<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;

// --- HALAMAN PUBLIK (Bisa diakses siapa saja) ---
// Halaman utama sekarang adalah etalase buku
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/book/{book}', [HomeController::class, 'show'])->name('books.show');


// --- HALAMAN YANG BUTUH LOGIN ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Universal (Pintu gerbang setelah login)
    Route::get('/dashboard', function () {
        if (Auth::user()->role == 'admin') {
            // Jika admin, lempar ke panel admin
            return redirect()->route('admin.books.index');
        } else {
            // Jika user biasa, tampilkan dashboard sederhana
            return view('dashboard');
        }
    })->name('dashboard');

    // Halaman Profile Bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP KHUSUS ADMIN (Dilindungi 'role:admin') ---
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('books', BookController::class);
    });

});

// Route untuk autentikasi (login, register, dll)
require __DIR__.'/auth.php';