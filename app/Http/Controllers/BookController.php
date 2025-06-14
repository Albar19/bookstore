<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan daftar buku (Read)
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('admin.books.create');
    }

    // Menyimpan buku baru (Create)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('sampul')) {
            $namaFile = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->storeAs('public/sampul_buku', $namaFile);
            $input['sampul'] = $namaFile;
        }

        Book::create($input);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form edit buku
    // Menggunakan Route Model Binding (Book $book)
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    // Memperbarui buku (Update)
    // Menggunakan Route Model Binding (Book $book)
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

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

    // Menghapus buku (Delete)
    // Menggunakan Route Model Binding (Book $book)
    public function destroy(Book $book)
    {
        if ($book->sampul) {
            Storage::disk('public')->delete('sampul_buku/' . $book->sampul);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}