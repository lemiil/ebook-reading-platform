<?php

namespace App\Services\Book;

use App\Models\Book;
use Tizis\FB2\FB2Controller;

class BookReaderService
{

    public function readBook($id)
    {
        $book = Book::with('files')->find($id);

        if (!$book) {
            abort(404, 'Книга не найдена');
        }

        $fb2File = $book->files->firstWhere('format', 'fb2');
        $pdfFile = $book->files->firstWhere('format', 'pdf');

        if (!$fb2File && !$pdfFile) {
            abort(404, 'Файл книги не найден');
        }

        if ($fb2File) {
            $path = storage_path('app/' . $fb2File->file_path);
            if (!file_exists($path)) {
                abort(404, 'Файл не существует');
            }

            $file = file_get_contents($path);
            $item = new FB2Controller($file);
            $item->withNotes();
            $item->startParse();

            return $item->getBook()->getChapters();
        }

        return route('main') . '/storage/' . substr($pdfFile->file_path, 7);
    }


}

