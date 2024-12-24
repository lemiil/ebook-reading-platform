<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class FileController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function download($format, $bookId)
    {
        try {
            $book = Book::with('files')->find($bookId);
            $filePath = base_path('storage/app/' . $book->files->firstWhere('format', $format)->file_path);

            if (file_exists($filePath)) {
                return response()->download($filePath);
            }

            abort(404);
        } catch (\Exception $exception) {
            abort(404);
        }

    }
}
