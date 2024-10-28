<?php

use App\Http\Controllers\Book\BookUploadController;
use App\Http\Controllers\Book\BookReadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'main');


Route::get(
   '/book/{book?}',
    [BookReadController::class, 'pageShow']
)->name('book');

//Route::middleware(['auth'])->group(function () {
    Route::get(
        '/bookupload',
        [BookUploadController::class, 'index']
    )->name('book.upload.view');

    Route::post(
        '/bookupload',
        [BookUploadController::class, 'store']
    )->name('book.upload');
//});


require __DIR__ . '/auth.php';
