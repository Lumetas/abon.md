<div class="space-y-4">
    @if(count($themes) > 0)
        @foreach($themes as $theme => $notes)
            <div class="border rounded-lg overflow-hidden">
                <div class="flex justify-between items-center bg-gray-50 p-3">
                    <h3 class="font-semibold">{{ $theme }}</h3>
                    <form action="{{ route('books.themes.destroy', ['book' => $book, 'theme' => $theme]) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                            Delete Theme
                        </button>
                    </form>
                </div>

                <div class="p-3 space-y-2">
                    @foreach($notes as $note)
                        <div class="flex justify-between items-center group">
                            <button data-open-tab
                                    data-book="{{ $book }}"
                                    data-theme="{{ $theme }}"
                                    data-note="{{ $note }}"
                                    class="text-left text-blue-600 hover:underline truncate flex-1">
                                {{ $note }}
                            </button>
                            <form method="POST"
                                  action="{{ route('notes.destroy', ['book' => $book, 'theme' => $theme, 'note' => $note]) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                    ×
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="p-3 bg-gray-50 border-t">
                    <div class="flex">
                        <input type="text"
                               id="new-note-{{ $theme }}"
                               placeholder="New note name"
                               class="form-input flex-1 rounded-r-none">
                        <button onclick="createNote('{{ $book }}', '{{ $theme }}')"
                                class="btn btn-primary rounded-l-none">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-4 text-gray-500">
            No themes found. Create your first theme!
        </div>
    @endif
</div>

<script>
function createNote(book, theme) {
    const input = document.getElementById(`new-note-${theme}`);
    const noteName = input.value.trim();

    if (!noteName) {
        alert('Please enter a note name');
        return;
    }

    // Open in new tab (will trigger creation)
    window.open(`/book/${book}/${theme}/${noteName}/create`, '_blank');
    input.value = '';
}
</script>
