<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Author\AuthorReadController;
use App\Http\Controllers\Book\BookReaderController;
use App\Http\Controllers\Book\BookUploadController;
use App\Http\Controllers\Book\BookInfoReadController;
use App\Http\Controllers\Book\FileController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

// Main
Route::view('/', 'main')->name('main');


// Author upload view
Route::get('/author/upload', [AuthorController::class, 'index'])->name('author.upload.view');

// Book upload view
Route::get('/book/upload', [BookUploadController::class, 'index'])->name('book.upload.view');

// Author and Book upload post
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/author/upload', [AuthorController::class, 'store'])->name('author.upload');
    Route::post('/book/upload', [BookUploadController::class, 'store'])->name('book.upload');
});

// Book page
Route::get('/book/{book}', [BookInfoReadController::class, 'index'])->name('book.read');

// Book download
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('book/download/{format}/{bookId}', [FileController::class, 'download'])->name('book.download');
});

// Reader
Route::get('/read/{bookId}', [BookReaderController::class, 'index'])->name('book.reader');

// User page
//Route::get('/user/{user}', [ProfileController::class, 'pageShow'])->name('user.read');

// Author page
Route::get('/author/{author}', [AuthorReadController::class, 'index'])->name('author.read');

Route::middleware(['auth'])->group(function () {
    Route::get('user/settings', [SettingsController::class, 'settings'])->name('user.settings');

    Route::middleware(['verified'])->group(function () {
        Route::patch('user/settings', [SettingsController::class, 'update'])->name('user.settings.update');
    });
});


// Profile page
Route::get('user/{userId}', [ProfileController::class, 'index'])->name('user.profile');

// Settings page


// Auth
require __DIR__ . '/auth.php';
