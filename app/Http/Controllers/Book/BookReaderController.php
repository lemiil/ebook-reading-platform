<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Book\BookReaderService;

class BookReaderController extends Controller
{
    protected BookReaderService $bookReaderService;

    public function __construct(BookReaderService $BookReaderService)
    {
        $this->bookReaderService = $BookReaderService;
    }

    public function show($bookId)
    {
        try {
            $content = $this->bookContentResponse($bookId);
            $title = Book::find($bookId)?->title;

            if (is_string($content)) {
                return redirect()->away($content);
            }

            return view('reader.reader', compact('content', 'title'));
        } catch (\Exception $e) {
            return redirect()
                ->route('book.show', ['book' => $bookId])
                ->withErrors(['error' => 'Данная книга не поддерживает функционал читалки!']);

        }
    }

    public function bookContentResponse($id)
    {
        return $this->bookReaderService->readBook($id);
    }

}
