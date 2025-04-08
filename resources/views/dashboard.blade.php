<x-layouts.dashboard header="Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Ваш контент dashboard -->
        <div class="bg-toolbar-background rounded-lg p-6 border border-muted">
            <h3 class="text-lg font-semibold mb-4">Quick Stats</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-background p-4 rounded border border-muted">
                    <p class="text-muted text-sm">Total Books</p>
                    <p class="text-2xl font-bold">{{ auth()->user()->books()->count() }}</p>
                </div>
                <div class="bg-background p-4 rounded border border-muted">
                    <p class="text-muted text-sm">Total Notes</p>
                    <p class="text-2xl font-bold">{{ auth()->user()->notes()->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Books -->
        <div class="bg-toolbar-background rounded-lg p-6 border border-muted">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Recent Books</h3>
                <a href="{{ route('books.index') }}" class="text-sm text-primary hover:underline">View All</a>
            </div>
            
            @if($books->isEmpty())
                <p class="text-muted">No books yet</p>
            @else
                <ul class="space-y-2">
                    @foreach($books as $book)
                        <li class="flex justify-between items-center bg-background p-3 rounded border border-muted">
                            <a href="{{ route('books.show', $book) }}" class="text-primary hover:underline">
                                {{ $book->name }}
                            </a>
                            <span class="text-sm text-muted">{{ $book->notes_count }} notes</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Recent Notes -->
        <div class="col-span-full bg-toolbar-background rounded-lg p-6 border border-muted">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Recent Notes</h3>
                <a href="{{ route('notes.index') }}" class="text-sm text-primary hover:underline">View All</a>
            </div>
            
            @if($recentNotes->isEmpty())
                <p class="text-muted">No notes yet</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-background border border-muted">
                        <thead>
                            <tr class="border-b border-muted">
                                <th class="px-4 py-2 text-left text-sm text-muted">Book</th>
                                <th class="px-4 py-2 text-left text-sm text-muted">Title</th>
                                <th class="px-4 py-2 text-left text-sm text-muted">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentNotes as $note)
                                <tr class="border-b border-muted hover:bg-toolbar-background">
                                    <td class="px-4 py-2">{{ $note->book->name }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ $note->path() }}" class="text-primary hover:underline">
                                            {{ $note->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-muted">{{ $note->updated_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    </x-layouts.dashboard>