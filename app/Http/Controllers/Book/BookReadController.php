<?php

namespace App\Http\Controllers\Book;

use App\Models\Book;

use App\Services\Book\BookInfoExtractorService;
use Kiwilan\Ebook\Ebook;

use App\Http\Controllers\Controller;


class BookReadController extends Controller
{
    protected BookInfoExtractorService $bookInfoExtractorService;

    protected Book $book;

    public function __construct(Book $book, BookInfoExtractorService $bookInfoExtractorService)
    {
        $this->book = $book;
        $this->bookInfoExtractorService = $bookInfoExtractorService;
    }

    public function pageShow(Book $book)
    {
        return view('book.book-page', $this->bookResponse($book));
    }

    protected function bookResponse(Book $book): array
    {
        return $this->bookInfoExtractorService->extractBookInfo($book);
    }


}
