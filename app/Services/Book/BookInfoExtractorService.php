<?php

namespace App\Services\Book;

use App\Models\Book;
use Kiwilan\Ebook\Ebook;

class BookInfoExtractorService
{

    public function extractBookInfo(Book $book)
    {
        $coverBASE64 = null;

        if ($book->files->firstWhere('format', 'fb2') == null) {
            $reader = false;
        } else {
            $reader = true;
        }

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
            'authors' => $book->authors()->pluck('name'),
            'genres' => $book->genres()->pluck('name') ?: null,
            'year' => $book->year ?? null,
            'formats' => $book->files()->pluck('format'),
            'reader' => $reader,
            'tags' => $book->tags()->pluck('name') ?: null,
            'coverBASE64' => $coverBASE64,
            'cover' => $book->cover_path ?? null,
            'description' => $book->description ?? null,
            'reviews' => $book->reviews() ?: null,
        ];
    }

}
