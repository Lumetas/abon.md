<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoteController extends Controller
{
        private function getNotePath($userId, $book, $theme = null, $note)
        {
            $note = Str::finish($note, '.md');
            $path = "vaults/{$userId}/{$book}";
            if ($theme) $path .= "/{$theme}";
            return "{$path}/{$note}";
        }

    public function show($book, $theme = null, $note)
    {
        $path = $this->getNotePath(auth()->id(), $book, $theme, $note);
        $content = Storage::disk('local')->exists($path) 
            ? Storage::disk('local')->get($path) 
            : '';
        
        return view('editor', [
            'content' => $content,
            'saveUrl' => route('notes.save', compact('book', 'theme', 'note')),
            'rawUrl' => route('notes.raw', compact('book', 'theme', 'note'))
        ]);
    }

    public function raw($book, $theme = null, $note)
    {
        $path = $this->getNotePath(auth()->id(), $book, $theme, $note);
        
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }
        
        return response(Storage::disk('local')->get($path))
            ->header('Content-Type', 'text/markdown');
    }

    public function save(Request $request, $book, $theme = null, $note)
    {
        $request->validate(['content' => 'required|string']);
        
        $path = $this->getNotePath(auth()->id(), $book, $theme, $note);
        Storage::disk('local')->put($path, $request->content);
        
        return response()->json(['status' => 'success']);
    }

    public function delete($book, $theme = null, $note)
    {

        if (Storage::disk('local')->exists($note)) {
            Storage::disk('local')->delete($note);
        }

        return redirect()->route('books.show', ['book' => $book]);
    }
}