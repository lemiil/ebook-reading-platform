<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, Review $review)
    {
        $user = Auth::user();
        $validatedData = $request->validated();

        try {
            $review->comments()->create([
                'user_id' => $user->id,
                'review_id' => $validatedData['review_id'],
                'parent_comment_id' => $validatedData['parent_comment_id'] ?? null,
                'content' => $validatedData['content'],
            ]);
            return redirect()->route('review.show', $validatedData['review_id'])
                ->with('success', 'Комментарий добавлен!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
