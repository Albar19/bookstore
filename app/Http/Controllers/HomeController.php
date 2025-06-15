<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (welcome/dashboard publik).
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Menampilkan halaman etalase buku.
     * Method ini menangani route '/etalase'.
     */
    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->search . '%');
        }
        $books = $query->latest()->paginate(12);
        // Menggunakan view 'etalase' yang baru untuk daftar buku
        return view('etalase', compact('books'));
    }

    /**
     * Menampilkan detail satu buku.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}