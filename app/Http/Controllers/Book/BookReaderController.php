<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Book\BookReaderService;

class BookReaderController extends Controller
{
    protected BookReaderService $bookReaderService;

    public function __construct(Book $book, BookReaderService $BookReaderService)
    {
        $this->bookReaderService = $BookReaderService;
    }

    public function show($bookId)
    {
        try {
            $chapters = $this->bookContentResponse($bookId);
            return view('reader.reader', compact('chapters'));
        } catch (\Exception $e) {
            return redirect()
                ->route('book.read', ['book' => $bookId])
                ->withErrors(['error' => 'Данная книга не поддерживает функционал читалки!']);

        }
    }

    public function bookContentResponse($id)
    {
        return $this->bookReaderService->readBook($id);
    }

}
