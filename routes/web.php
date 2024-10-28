<?php

use App\Http\Controllers\Book\BookUploadController;
use App\Http\Controllers\Book\BookReadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'main');



//Route::middleware(['auth'])->group(function () {
    Route::get(
        '/book/upload',
        [BookUploadController::class, 'index']
    )->name('book.upload.view');

    Route::post(
        '/book/upload',
        [BookUploadController::class, 'store']
    )->name('book.upload');
//});

Route::get(
    '/book/{book?}',
    [BookReadController::class, 'pageShow']
)->name('book');


require __DIR__ . '/auth.php';
