<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ReviewStoreRequest $request)
    {
        $userId = Auth::id();
        $validatedData = $request->validated();
        $validatedData['user_id'] = $userId;
        Review::create($validatedData);
        $this->recalculateBookRating($validatedData['book_id']);
        return redirect()->route('book.read', $validatedData['book_id']);
    }

    private function recalculateBookRating($bookId)
    {
        $book = Book::findOrFail($bookId);
        if ($book->reviews()->count() > 0) {
            $book->rating = $book->reviews()->avg('rating');
        } else {
            $book->rating = 0;
        }
        $book->save();
    }
}
