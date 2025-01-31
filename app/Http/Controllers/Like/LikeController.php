<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Review $review)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

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

}
