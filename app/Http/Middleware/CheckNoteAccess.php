<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;

class CheckNoteAccess
{
    public function handle($request, Closure $next)
    {
        $userId = $request->user()->id;
        $path = "vaults/{$userId}/{$request->book}";
        
        if (!Storage::disk('local')->exists($path)) {
            abort(403, 'Book not found');
        }
        
        if ($request->theme && !Storage::disk('local')->exists("{$path}/{$request->theme}")) {
            abort(403, 'Theme not found');
        }
        
        return $next($request);
    }
}