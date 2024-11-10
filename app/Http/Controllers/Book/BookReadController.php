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
        return view('book.book-page', $this->bookResponse($book));
    }

    protected function bookResponse(Book $book): array
    {
        try {
            $path = base_path('storage/app/' . $book->files->firstWhere('format', 'epub')->file_path) ?? null;
        } catch (\Exception $e) {
            $path = null;
        }
        if ($path) {
            $ebook = Ebook::read($path);
            $cover = $ebook->getCover();
            $cover = $cover->getContents(true);
        }
        return [
            'title' => $book->title,
            'cover' => $cover ?? null,
            'description' => $book->description,
        ];
    }

}
