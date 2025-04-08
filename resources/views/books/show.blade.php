@extends('layouts.app')

@section('title', $book)
@section('header', $book)

@section('content')
<div class="book-container">
    <!-- Кнопки действий -->
    <div class="book-actions mb-4">
        <button onclick="location.href='{{ route('books.index') }}'" class="btn btn-secondary">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($themes as $theme)
                    <div class="theme-card">
                        <div class="theme-header">
                            <h3>{{ $theme }}</h3>
                            <form action="{{ route('books.themes.destroy', ['book' => $book, 'theme' => $theme]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon" title="Delete theme">delete</button>
                            </form>
                        </div>
                        <div class="theme-notes">
                            @foreach(Storage::disk('local')->files("vaults/".auth()->id()."/{$book}/{$theme}") as $note)
                                @if(Str::endsWith($note, '.md'))
                                    <a href="{{ route('notes.show', [
                                    'book' => $book, 
                                    'theme' => $theme, 
                                    'note' => basename($note, '.md')]) }}"
                                       class="note-link">
                                        {{ basename($note, '.md') }}
                                    </a><br>
                                @endif
                            @endforeach
                        </div><br>
                        <input placeholder="New note name" id="note-name-{{ $theme }}" class="form-input" type="text">
                        <button 
                        onclick="window.location.href = generateUrl(`{{ route('notes.show', [
                        'book' => $book, 
                        'theme' => $theme, 
                        'note' => '%note%']) }}`, document.getElementById('note-name-{{ $theme }}').value)"
                        class="btn btn-primary">create</button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Заметки без темы -->
    <div class="section">
        <h3 class="section-title">Notes without Theme</h3>
        @if(count($notes) > 0)
            <div class="notes-grid">
                @foreach($notes as $note)
                    <a href="{{ route('notes.show', ['book' => $book, 'note' => $note]) }}"
                       class="note-card">
                        {{ $note }}
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-muted">No notes yet in this book</p>
        @endif
    </div>
</div>
@endsection