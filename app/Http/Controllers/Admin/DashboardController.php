<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total buku
        $totalBooks = Book::count();
        
        // Mengambil 3 buku yang paling baru ditambahkan
        $latestBooks = Book::latest()->take(3)->get();

        // Mengirimkan data ke view
        return view('admin.dashboard', [
            'totalBooks' => $totalBooks,
            'latestBooks' => $latestBooks,
        ]);
    }
}