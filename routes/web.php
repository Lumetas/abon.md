<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckNoteAccess;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Группа аутентифицированных маршрутов
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Профиль пользователя (из Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Книги
    Route::resource('books', BookController::class);
    Route::post('/books/{book}/themes', [BookController::class, 'addTheme'])->name('books.themes.store');
    Route::delete('/books/{book}/themes/{theme}', [BookController::class, 'deleteTheme'])->name('books.themes.destroy');

    // Заметки (с проверкой доступа)
    Route::middleware(CheckNoteAccess::class)->group(function () {
        Route::get('/book/{book}/{theme}/{note}', [NoteController::class, 'show'])
            ->where('note', '.*?(\.md)?$')
            ->name('notes.show');

        Route::get('/book/{book}/{theme}/{note}/raw', [NoteController::class, 'raw'])
            ->where('note', '.*?(\.md)?$')
            ->name('notes.raw');

        Route::post('/book/{book}/{theme}/{note}', [NoteController::class, 'save'])
            ->where('note', '.*?(\.md)?$')
            ->name('notes.save');

        Route::delete('/book/{book}/{theme}/{note}', [NoteController::class, 'delete'])
            ->where('note', '.*?(\.md)?$')
            ->name('notes.delete');
    });
});

// Маршруты аутентификации Breeze (должны быть в конце)
require __DIR__ . '/auth.php';