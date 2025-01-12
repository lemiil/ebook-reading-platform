<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{

    public function index()
    {
        //todo реализовать с лейзи лоадингом и пагинацией
//        $reviews = Review::all();
//        return view('review.review-list', compact('reviews'));
    }

    public function show(Review $review)
    {
        //todo тоже самое
//        return view('review.review-show', compact('review'));
    }

    public function store(ReviewStoreRequest $request, Book $book)
    {
        $user = Auth::user();

        if ($book->reviews()->where('user_id', $user->id)->exists()) {
            throw ValidationException::withMessages([
                'user_id' => 'You have already reviewed this book.',
            ]);
        }

        $validatedData = $request->validated();
        $validatedData['user_id'] = $user->id;
        Review::create($validatedData);
        $this->recalculateBookRating($validatedData['book_id']);
        return redirect()->route('book.show', $validatedData['book_id']);
    }


// todo и это тоже сделать
//    public function update(Request $request, Review $review)
//    {
//        $user = Auth::user();
//
//        if ($review->user_id !== $user->id) {
//            return redirect()->route('reviews.index')->with('error', 'You are not authorized to update this review.');
//        }
//
//        $review->update([
//            'rating' => $validated['rating'],
//            'content' => $validated['content'] ?? null,
//        ]);
//
//        return redirect()->route('reviews.show', $review)->with('success', 'Review updated successfully.');
//    }

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
