<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorStoreRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store(AuthorStoreRequest $request)
    {
        Author::create($request->validated());
        return redirect()->route('author.upload.view')->with('success', 'Author created successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $authors = Author::where('name', 'LIKE', '%' . $query . '%')
            ->limit(10)
            ->get(['id', 'name']);

        return response()->json($authors);
    }

    public function show(Author $author)
    {
        $authorData = (new AuthorResource($author))->toArray(request());

        return view('author.author-show', compact('authorData'));
    }
}
