<?php

namespace App\Services;

use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReviewService
{
    public function getReviewsForBook(Book $book)
    {
        return $book->reviews()
            ->where('content', '!=', '')
            ->latest()
            ->paginate(5);
    }

    public function getReviewComments(Review $review)
    {
        return $review->comments()
            ->with(['user', 'children.user'])
            ->whereNull('parent_comment_id')
            ->latest()
            ->paginate(5);
    }

    public function storeReview(ReviewStoreRequest $request, Book $book)
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
        $this->recalculateBookRating($book);

        return $book;
    }

    public function updateReview(ReviewUpdateRequest $request, Review $review)
    {
        $user = Auth::user();

        if ($review->user_id !== $user->id) {
            throw ValidationException::withMessages([
                'user_id' => 'You are not authorized to update this review.',
            ]);
        }

        $review->update([
            'rating' => $request->rating,
            'content' => $request->toArray()['content'] ?? null,
        ]);

        return $review;
    }

    private function recalculateBookRating(Book $book)
    {
        $book->rating = $book->reviews()->count() > 0
            ? $book->reviews()->avg('rating')
            : 0;

        $book->save();
    }
}
