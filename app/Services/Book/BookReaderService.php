<?php

namespace App\Services\Book;

use App\Models\Book;
use Tizis\FB2\FB2Controller;

class BookReaderService
{

    public function readBook($id)
    {
        $book = Book::with('files')->find($id);
        $path = base_path('storage/app/' . $book->files->firstWhere('format', 'fb2')->file_path);
        $file = file_get_contents($path);
        $item = new FB2Controller($file);
        $item->withNotes();
        $item->startParse();
        $chapters = $item->getBook()->getChapters();
        return $chapters;
    }

}

