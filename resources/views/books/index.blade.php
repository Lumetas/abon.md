<x-layouts.dashboard header="My Books">
    <div class="py-6">
        @foreach($books as $book)
            <div class="mb-4 p-4 bg-white shadow rounded-lg">
                <h3 class="text-lg font-medium">{{ $book->name }}</h3>
            </div>
        @endforeach
    </div>
</x-layouts.dashboard>