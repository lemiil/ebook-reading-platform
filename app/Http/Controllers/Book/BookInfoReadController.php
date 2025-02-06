<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookInfoReadController extends Controller
{
    public function show(Book $book)
    {
        if (auth()->check()) {
            $user = auth()->user();
        }
        $userReview = null;
        if ($user) {
            $userReview = $book->reviews()->where('user_id', $user->id)->first();
            if ($userReview) {
                $userReview->toArray();
            }
        }
        $bookData = (new BookResource($book))->toArray(request());
        $reviewIds = collect($bookData['reviews'])->pluck('id');

        return view('book.book-show', compact('bookData', 'userReview', 'reviewIds'));
    }

    public function index()
    {
        $books = Book::paginate(36);
        return view('book.book-index', compact('books'));
    }
}
