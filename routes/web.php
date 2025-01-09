<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookReaderController;
use App\Http\Controllers\Book\BookUploadController;
use App\Http\Controllers\Book\BookInfoReadController;
use App\Http\Controllers\Book\FileController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

// Main
Route::view('/', 'main')->name('main');

// Book upload view
Route::get('/book/upload', [BookUploadController::class, 'index'])->name('book.upload.view');

// Author and Book upload post
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/author/upload', [AuthorController::class, 'store'])->name('author.upload');
    Route::post('/book/upload', [BookUploadController::class, 'store'])->name('book.upload');
});

//// Book
Route::prefix('books')->group(function () {
    Route::get('/', [BookInfoReadController::class, 'index'])->name('book.list');
    Route::get('/{book}', [BookInfoReadController::class, 'show'])->name('book.show');
});
// Book Download
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('book/download/{format}/{bookId}', [FileController::class, 'download'])->name('book.download');
});

// Reader
Route::get('/read/{bookId}', [BookReaderController::class, 'show'])->name('book.reader');

// User page
//Route::get('/user/{user}', [ProfileController::class, 'pageShow'])->name('user.read');

//// Author

Route::prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('author.list');
    Route::get('/{author}', [AuthorController::class, 'show'])->name('author.show');
});
Route::view('/author/upload', 'author.author-show')->name('author.upload.view');


// Settings page
Route::middleware(['auth'])->group(function () {
    Route::get('user/settings', [SettingsController::class, 'settings'])->name('user.settings');

    Route::middleware(['verified'])->group(function () {
        Route::patch('user/settings', [SettingsController::class, 'update'])->name('user.settings.update');
    });
});


// Profile page
Route::get('user/{userId}', [ProfileController::class, 'index'])->name('user.profile');

// Review
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('review/upload', [ReviewController::class, 'store'])->name('review.upload');
});

Route::get('review/{reviewId}', [ReviewController::class, 'index'])->name('review.index');

// Comment
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('comment/{reviewId}/{userId}', [CommentController::class, 'store'])->name('comment.upload');
});

// Auth
require __DIR__ . '/auth.php';
