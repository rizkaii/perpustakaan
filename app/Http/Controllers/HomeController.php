<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $books      = Book::with('category')->latest()->take(8)->get();
        $categories = Category::withCount('books')->get();
        $totalBooks = Book::count();

        return view('home', compact('books', 'categories', 'totalBooks'));
    }
}
