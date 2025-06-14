<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        return view('admin.books.index', ['books' => Book::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('sampul')) {
            // BENAR: `store()` akan membuat nama unik dan mengembalikan path lengkap
            // Contoh path yang dikembalikan: "sampul_buku/random_name.jpg"
            $path = $request->file('sampul')->store('sampul_buku', 'public');
            $input['sampul'] = $path; // <-- Simpan path lengkap ini ke database
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
        $input = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('sampul')) {
            // Hapus gambar lama jika ada
            if ($book->sampul) {
                Storage::disk('public')->delete($book->sampul);
            }
            // BENAR: Simpan file baru dan dapatkan path lengkapnya
            $path = $request->file('sampul')->store('sampul_buku', 'public');
            $input['sampul'] = $path;
        }

        $book->update($input);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->sampul) {
            Storage::disk('public')->delete($book->sampul);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}