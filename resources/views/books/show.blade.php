@extends('layouts.app')

@section('title', $book)
@section('header', $book)

@section('content')
<div class="book-container">
    <!-- Кнопки действий -->
    <div class="book-actions mb-4">
        <button onclick="location.href='{{ route('books.index') }}'" class="btn btn-danger">
            Back to Books
        </button><br><br>
        <form action="{{ route('books.themes.store', $book) }}" method="POST" class="inline-form">
            @csrf
            <input type="text" name="name" placeholder="New theme name" required class="form-input">
            <button type="submit" class="btn btn-primary">Add Theme</button>
        </form>
    </div>
    <script>
        function generateUrl(url, name){
            return url.replace("%note%", name);
        }
    </script>
    <!-- Список тем -->
    @if(count($themes) > 0)
    <div class="section">
        <h2 class="section-title">Themes:</h2>
        <div class="space-y-4">
            @foreach($themes as $theme)
            <table class="spaced-table mb-3">
            <tbody>

                        <tr>
                            <td>
                                <h3 class="text-lg font-bold">{{ $theme }}</h3>     
                            </td>
                            <td>
                                <form action="{{ route('books.themes.destroy', ['book' => $book, 'theme' => $theme]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 btn btn-danger hover:text-red-700" title="Delete theme">Delete theme
                                </button>
                                </form>
                            </td>
                        </tr>
                    

                            @foreach(Storage::disk('local')->files("vaults/".auth()->id()."/{$book}/{$theme}") as $note)
                                @if(Str::endsWith($note, '.md'))
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-2">
                                            <a href="{{ route('notes.show', [
                                                'book' => $book, 
                                                'theme' => $theme, 
                                                'note' => basename($note, '.md')]) }}"
                                               class="text-blue-600 hover:text-blue-800 hover:underline flex items-center">
                                                <button class="btn btn-primary">{{ basename($note, '.md') }}</button>
                                            </a>
                                        </td>
                                        <td class="text-right px-2 py-2 text-gray-400 text-sm">
                                            <form method="post" action="{{ route('notes.delete', ['book' => $book, 'theme' => $theme, "note" => $note]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                    <tr>
                        <td>
                                                    <input placeholder="Note name" 
                               id="note-name-{{ $theme }}" 
                               class="border table-input rounded px-3 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:border-blue-500" 
                               type="text">
                        </td>

                        <td>
                            <button onclick="window.location.href = generateUrl(`{{ route('notes.show', [
                                'book' => $book, 
                                'theme' => $theme, 
                                'note' => '%note%']) }}`, document.getElementById('note-name-{{ $theme }}').value)"
                                class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                                Create
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table><br><br>
            @endforeach
        </div>
    </div>
@endif
</div>
@endsection