<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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

    // Method 'show' yang sebelumnya hilang, sekarang sudah ada
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}