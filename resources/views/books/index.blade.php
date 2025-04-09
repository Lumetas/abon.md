@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="header1">My Books</h1><br>
    <style>
        .btn100{
            width:100px;
        }
    </style>
    <table class="books-list spaced-table">

    <tbody>
        @foreach($books as $book)
        <tr>
            <td><a href="{{ route('books.show', $book) }}"><button class="btn btn-primary">{{ $book }}</button></a></td>
            <td class="actions">
                <div class="btn-group">
                    
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table><br>
    <form action="{{ route('books.store') }}" method="POST" class="new-book-form">
        @csrf
        <input class="form-input" type="text" name="name" placeholder="New book name" required>
        <button type="submit" class="btn btn-primary">Create Book</button>
    </form>
</div>
@endsection
