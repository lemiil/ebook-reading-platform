<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Review $review)
    {
        $user = Auth::user();

        try {
            if ($user->hasLiked($review)) {
                $user->unlike($review);
                return response()->json(['message' => 'Unliked'], 200);
            } else {
                $user->like($review);
                return response()->json(['message' => 'Liked'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function status(Request $request)
    {
        $user = Auth::user();

        $reviewIds = $request->input('review_ids');

        $likedReviews = $user->likes()->withType(Review::class)->whereIn('likeable_id', $reviewIds)->pluck('likeable_id')->toArray();

        return response()->json([
            'likedReviews' => $likedReviews
        ]);
    }

}
