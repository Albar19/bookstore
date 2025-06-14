<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan halaman utama dengan semua buku
    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->search . '%');
        }
        $books = $query->latest()->paginate(12);
        return view('welcome', compact('books'));
    }

    // Menampilkan halaman detail satu buku
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}