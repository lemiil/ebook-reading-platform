<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookInfoReadController extends Controller
{
    public function show(Book $book)
    {
        $bookData = (new BookResource($book))->toArray(request());

        return view('book.book-show', compact('bookData'));
    }

    public function index()
    {
//        todo реализовать
//        $booksData = BookResource::collection(Book::with(['authors', 'genres', 'tags', 'files', 'reviews'])->get())
//            ->toArray(request());
//
//        return view('book.book-list', compact('booksData'));
    }
}
