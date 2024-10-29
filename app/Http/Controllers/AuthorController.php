<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorStoreRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        return view('author/author-upload');
    }

    public function store(AuthorStoreRequest $request) {
        Author::create($request->validated());
        return redirect()->route('author.upload.view')->with('success', 'Author created successfully.');
    }
}
