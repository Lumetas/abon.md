@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Ваш контент dashboard -->
        <div class="bg-toolbar-background rounded-lg p-6 border border-muted">
            <h3 class="text-lg font-semibold mb-4">Quick Stats</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-background p-4 rounded border border-muted">
                    <p class="text-muted text-sm">Total Books</p>
                    <p class="text-2xl font-bold">{{ count($books) }}</p>
                </div>
                <!-- <div class="bg-background p-4 rounded border border-muted">
                    <p class="text-muted text-sm">Total Notes</p>
                    <p class="text-2xl font-bold">{{ auth()->user()->notes()->count() }}</p>
                </div> -->
            </div>
        </div>


    </div>
@endsection
