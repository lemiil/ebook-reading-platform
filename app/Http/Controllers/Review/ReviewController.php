<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ReviewResource;
use App\Models\Book;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Book $book)
    {
        $reviews = $this->reviewService->getReviewsForBook($book);

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
        $comments = $this->reviewService->getReviewComments($review);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => CommentResource::collection($comments),
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
            'review' => new ReviewResource($review),
            'comments' => CommentResource::collection($comments),
        ]);
    }

    public function store(ReviewStoreRequest $request, Book $book)
    {
        $this->reviewService->storeReview($request, $book);
        return redirect()->route('book.show', $book->id);
    }

    public function update(ReviewUpdateRequest $request, Review $review)
    {
        $review = $this->reviewService->updateReview($request, $review);
        return redirect()->route('main')->with('success', 'Review updated successfully.');
    }
}
