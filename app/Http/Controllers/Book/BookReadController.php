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
        $path = base_path('storage/app/' . $book->files->firstWhere('format', 'epub')->file_path);
        if ($path) {
            $ebook = Ebook::read($path);
        }
        $cover = $ebook->getCover();
        dd($cover);
//
//        return $cover->getPath();

//        return view('book.book-page', $this->bookResponse($book));
    }

    protected function bookResponse(Book $book): array
    {
        $path = base_path('storage/app/' . $book->files->firstWhere('format', 'epub')->file_path);
        if ($path) {
            $ebook = Ebook::read($path);
        }
        return [
            'title' => $book->title,
            'description' => $book->description,
        ];
    }

}
