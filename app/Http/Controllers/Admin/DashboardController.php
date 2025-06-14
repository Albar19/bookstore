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
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $latestBooks = Book::latest()->take(3)->get();

        return view('admin.dashboard', [
            'totalBooks' => $totalBooks,
            'totalUsers' => $totalUsers,
            'latestBooks' => $latestBooks,
        ]);
    }
}