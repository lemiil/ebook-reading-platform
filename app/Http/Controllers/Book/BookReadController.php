<?php

namespace App\Http\Controllers\Book;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Kiwilan\Ebook\Ebook;
use Kiwilan\XmlReader\XmlReader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookReadController extends Controller
{

    protected Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    public function pageShow(Book $book)
    {
        return view('book/book-page', $this->bookResponse($book));
    }

    protected function bookResponse(Book $book): array
    {
        return [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
        ];
    }

}
