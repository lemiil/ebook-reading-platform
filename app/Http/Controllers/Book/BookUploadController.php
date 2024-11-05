<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Models\Genre;
use App\Services\Book\BookUploadService;
use Exception;

class BookUploadController extends Controller
{
    protected $bookUploadService;

    public function __construct(BookUploadService $bookUploadService)
    {
        $this->bookUploadService = $bookUploadService;
    }

    public function index()
    {
        $genres = Genre::all();
        return view("book/book-upload", compact('genres'));
    }

    public function store(BookStoreRequest $request)
    {
        try {
            if ($request->hasFile('book')) {
                $this->bookUploadService->uploadBook($request);
            }
            return redirect()->route('book.upload.view')->with('bookisuploaded', 'Книга успешно загружена. Вы молодец.');
        } catch (Exception $e) {
            return redirect()->route('book.upload.view')->withErrors('Ошибка при загрузке книги: ' . $e->getMessage());
        }
    }
}
