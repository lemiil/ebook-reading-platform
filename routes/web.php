<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookUploadController;
use App\Http\Controllers\Book\BookReadController;
use App\Livewire\ShowAuthors;
use Illuminate\Support\Facades\Route;

Route::view('/', 'main');

Route::get(
    '/author/upload',
    [AuthorController::class, 'index']
)->name('author.upload.view');

//Route::middleware(['auth'])->group(function () {
Route::post(
    '/author/upload',
    [AuthorController::class, 'store']
)->name('author.upload');
//});

Route::get(
    '/book/upload',
    [BookUploadController::class, 'index']
)->name('book.upload.view');
//Route::middleware(['auth'])->group(function () {
Route::post(
    '/book/upload',
    [BookUploadController::class, 'store']
)->name('book.upload');
//});

Route::get(
    '/book/{book?}',
    [BookReadController::class, 'pageShow']
)->name('book');

Route::get('/show/authors', ShowAuthors::class);

require __DIR__ . '/auth.php';
