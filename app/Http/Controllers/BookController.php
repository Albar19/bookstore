<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate(['judul'=>'required','pengarang'=>'required','penerbit'=>'required','tahun_terbit'=>'required|integer','sampul'=>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048']);
        $input = $request->all();
        if ($request->hasFile('sampul')) {
            $namaFile = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->storeAs('public/sampul_buku', $namaFile);
            $input['sampul'] = $namaFile;
        }
        Book::create($input);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate(['judul'=>'required','pengarang'=>'required','penerbit'=>'required','tahun_terbit'=>'required|integer','sampul'=>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048']);
        $input = $request->all();
        if ($request->hasFile('sampul')) {
            if ($book->sampul) {
                Storage::disk('public')->delete('sampul_buku/' . $book->sampul);
            }
            $namaFile = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->storeAs('public/sampul_buku', $namaFile);
            $input['sampul'] = $namaFile;
        }
        $book->update($input);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->sampul) {
            Storage::disk('public')->delete('sampul_buku/' . $book->sampul);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}