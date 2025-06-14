<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $books = Book::latest()->paginate(10);
    // dd($books);
    return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
    return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) 
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // (Validasi sama seperti di store)
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $book = Book::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('sampul')) {
            // Hapus gambar lama
            if ($book->sampul) {
                Storage::disk('public')->delete('sampul_buku/' . $book->sampul);
            }
            // Simpan gambar baru
            $namaFile = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->storeAs('public/sampul_buku', $namaFile);
            $input['sampul'] = $namaFile;
        }

        $book->update($input);
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        // Hapus gambar dari storage
        if ($book->sampul) {
            Storage::disk('public')->delete('sampul_buku/' . $book->sampul);
        }
        // Hapus data dari DB
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
