<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookInfoReadController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::query()
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%");
                });
            })
            ->limit(20)
            ->get();

        return response()->json($books);
    }


    public function show(Book $book)
    {
        if (auth()->check()) {
            $user = auth()->user();
        }
        $userReview = null;
        if (isset($user)) {
            $userReview = $book->reviews()->where('user_id', $user->id)->first();
            if ($userReview) {
                $userReview->toArray();
            }
        }
        $bookData = (new BookResource($book))->toArray(request());
        $reviewIds = collect($bookData['reviews'])->pluck('id');

        return view('book.book-show', compact('bookData', 'userReview', 'reviewIds'));
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'rating');
        $order = $request->boolean('order', false) ? 'asc' : 'desc';

        $query = Book::query();

        switch ($sort) {
            case 'popular':
                $query->orderBy('views', $order);
                break;
            case 'rating':
                $query->orderBy('rating', $order);
                break;
            case 'title':
                $query->orderBy('title', $order);
                break;
            default:
                $query->orderBy('created_at', $order);
                break;
        }

        $books = $query->paginate(36);

        return view('book.book-index', compact('books', 'sort', 'order'));
    }
}
