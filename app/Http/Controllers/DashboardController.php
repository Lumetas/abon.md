<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Support\Facades\Storage;

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
        $userId = auth()->id();
        return view('dashboard', ["books" => Storage::disk('local')->directories("vaults/{$userId}")]);
    }
}