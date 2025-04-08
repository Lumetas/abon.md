<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $books = Storage::disk('local')->directories("vaults/{$userId}");
        
        return view('books.index', [
            'books' => array_map('basename', $books)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        $path = "vaults/".auth()->id()."/".Str::slug($request->name);
        Storage::disk('local')->makeDirectory($path);
        
        return redirect()->route('books.index');
    }

    public function show($book)
    {
        $path = "vaults/".auth()->id()."/{$book}";
        $themes = Storage::disk('local')->directories($path);
        $notes = Storage::disk('local')->files($path);
        
        return view('books.show', [
            'book' => $book,
            'themes' => array_map('basename', $themes),
            'notes' => array_map(function($note) {
                return basename($note, '.md');
            }, array_filter($notes, function($note) {
                return Str::endsWith($note, '.md');
            }))
        ]);
    }

    public function addTheme(Request $request, $book)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        $path = "vaults/".auth()->id()."/{$book}/".Str::slug($request->name);
        Storage::disk('local')->makeDirectory($path);
        
        return back();
    }

    public function deleteTheme($book, $theme)
    {
        $path = "vaults/".auth()->id()."/{$book}/{$theme}";
        Storage::disk('local')->deleteDirectory($path);
        
        return back();
    }

    public function destroy($book)
    {
        $path = "vaults/".auth()->id()."/{$book}";
        Storage::disk('local')->deleteDirectory($path);
        
        return redirect()->route('books.index');
    }
}