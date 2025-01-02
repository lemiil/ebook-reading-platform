<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorReadController extends Controller
{

    protected Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function index(Author $author)
    {
        return view('author.author-page', $this->authorResponse($author));
    }

    protected function authorResponse(Author $author): array
    {
        return [
            'author_name' => $author->name,
            'author_description' => $author->description,
        ];
    }


}
