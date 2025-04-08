@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="header1">My Books</h1>
    <style>
        .btn100{
            width:100px;
        }
    </style>
    <div class="books-list">
        @foreach($books as $book)
            <div class="book-card">
                <h2>{{ $book }}</h2>
                <a href="{{ route('books.show', $book) }}" ><button class="btn btn-primary btn100">Open</button></a><br><br>
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn100">Delete</button><br><br>
                </form>
            </div>
        @endforeach
    </div>
    
    <form action="{{ route('books.store') }}" method="POST" class="new-book-form">
        @csrf
        <input class="form-input" type="text" name="name" placeholder="New book name" required>
        <button type="submit" class="btn btn-primary">Create Book</button>
    </form>
</div>
@endsection
