<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookReaderController;
use App\Http\Controllers\Book\BookUploadController;
use App\Http\Controllers\Book\BookInfoReadController;
use App\Http\Controllers\Book\FileController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Like\LikeController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\Stats\StatsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

// Main
Route::view('/', 'main')->name('main');

// Book upload view

// Book
Route::prefix('books')->as('book.')->group(function () {

    Route::get('/upload', [BookUploadController::class, 'show'])->name('upload.index');
    Route::middleware(['auth', 'verified', 'throttle:global'])->group(function () {
        Route::post('/upload', [BookUploadController::class, 'store'])->name('upload');
    });

    Route::get('/{book}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/lib', [BookInfoReadController::class, 'index'])->name('index');
    Route::get('/search', [BookInfoReadController::class, 'search'])->name('search');
    Route::get('/{book}', [BookInfoReadController::class, 'show'])->name('show');

    Route::middleware(['auth', 'verified', 'throttle:global'])->group(function () {
        Route::get('/download/{format}/{bookId}', [FileController::class, 'download'])->name('download');
    });
});

// Author
Route::prefix('authors')->group(function () {
    Route::view('/upload', 'author.author-upload')->name('author.upload.view');
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/upload', [AuthorController::class, 'store'])->name('author.upload');
    });

    Route::get('/', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/{author}', [AuthorController::class, 'show'])->name('author.show');
});

// Reader
Route::get('/read/{bookId}', [BookReaderController::class, 'show'])->name('book.reader');

// Settings page
Route::middleware(['auth'])->group(function () {
    Route::get('user/settings', [SettingsController::class, 'settings'])->name('user.settings');

    Route::middleware(['verified'])->group(function () {
        Route::patch('user/settings', [SettingsController::class, 'update'])->name('user.settings.update');
    });
});


// Profile page
Route::get('users/{user}', [ProfileController::class, 'index'])->name('profile');

// Review
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('reviews/upload', [ReviewController::class, 'store'])->name('review.upload');
    Route::patch('reviews/update', [ReviewController::class, 'update'])->name('review.update');
});
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('review.show');

// Comment
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('reviews/{review}/comments/upload', [CommentController::class, 'store'])->name('comment.upload');
});


// Like
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/like/review/{review}', [LikeController::class, 'like']);
    Route::post('/user/reviews/likes', [LikeController::class, 'status']);
});

// Stats
Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');

// About
Route::view('/about', 'about.about')->name('about');


// Auth
require __DIR__ . '/auth.php';
