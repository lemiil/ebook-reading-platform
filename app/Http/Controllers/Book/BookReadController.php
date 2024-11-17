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
        $coverBASE64 = null;

        try {
            $path = base_path('storage/app/' . $book->files->firstWhere('format', 'epub')->file_path);
        } catch (\Exception $e) {
            $path = null;
        }

        if ($path) {
            $ebook = Ebook::read($path);
            $cover = $ebook->getCover();
            if ($cover) {
                $coverBASE64 = $cover->getContents(true);
            }
        }

        return [
            'title' => $book->title,
            'author' => $book->author()->first()?->name ?? null,
            'genres' => $book->genres()->pluck('name') ?: null,
            'year' => $book->year ?? null,
            'tags' => $book->tags()->pluck('name') ?: null,
            'coverBASE64' => $coverBASE64,
            'cover' => $book->cover()->first()?->file_path ?? null,
            'description' => $book->description ?? null,
        ];
    }


}
