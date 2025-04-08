<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $books = Book::where('user_id', auth()->id())
            ->withCount('notes')
            ->latest()
            ->take(5)
            ->get();

        $recentNotes = Note::where('user_id', auth()->id())
            ->with('book')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('books', 'recentNotes'));
    }
}