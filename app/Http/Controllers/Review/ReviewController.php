<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ReviewResource;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Review;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{

    public function index(Book $book)
    {
        $reviews = $book->reviews()
            ->where('content', '!=', '')
            ->latest()
            ->paginate(5);

        if (request()->ajax()) {
            $reviews->getCollection()->transform(function ($review) {
                return [
                    'id' => $review->id,
                    'content' => $review->content,
                    'rating' => $review->rating,
                    'created_at' => $review->created_at->format('d.m.Y'),
                    'updated_at' => $review->updated_at->format('d.m.Y'),
                    'name' => $review->user->name ?? null,
                    'likes' => $review->likers()->count(),
                ];
            });

            return response()->json($reviews);
        }

        return view('review.review-index', compact('reviews'));
    }


    public function show(Review $review)
    {
        $comments = $review->comments()
            ->with(['user', 'children.user'])
            ->whereNull('parent_comment_id')
            ->latest()
            ->paginate(5);

        $reviewResource = new ReviewResource($review);
        $commentsResource = CommentResource::collection($comments);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $commentsResource,
                'meta' => [
                    'total' => $comments->total(),
                    'per_page' => $comments->perPage(),
                    'current_page' => $comments->currentPage(),
                    'next_page' => $comments->nextPageUrl(),
                    'last_page' => $comments->lastPage(),
                ],
            ]);
        }

        return view('review.review-show', [
            'review' => $reviewResource->resolve(),
            'comments' => $commentsResource,
        ]);
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

    public function update(ReviewUpdateRequest $request)
    {
        $user = Auth::user();

        $review = Review::findOrFail($_GET['review_id']);

        if ($review->user_id !== $user->id) {
            return redirect()->route('reviews.index')->with('error', 'You are not authorized to update this review.');
        }

        $review->update([
            'rating' => $request->rating,
            'content' => $request->toArray()['content'] ?? null,
        ]);

        return redirect()->route('main', $review)->with('success', 'Review updated successfully.');
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
