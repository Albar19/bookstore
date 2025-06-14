<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

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
}
