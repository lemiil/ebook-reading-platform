<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Models\Book;
use App\Models\Genre;
use Exception;
use Illuminate\Support\Facades\Storage;
use Kiwilan\Ebook\Ebook;
use Kiwilan\XmlReader\XmlReader;

class BookUploadController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view("book/book-upload", compact('genres'));
    }

    public function store(BookStoreRequest $request)
    {
        $directoryName = date("d-m-Y");

        try {
            $path = $this->storeFile($request, $directoryName);
            $bookData = $this->extractBookData($path);

            $book = Book::create($bookData);
            if ($request->has('genres')) {
                $book->genres()->attach($request->genres);
            }
            return redirect()->route('book.upload.view')->with('bookisuploaded', 'true');
        } catch (Exception $e) {
            return redirect()->route('book.upload.view')->withErrors('Ошибка при загрузке книги: ' . $e->getMessage());
        }
    }

    private function storeFile($request, $directoryName)
    {
        $file = $request->file('book');
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;

        return $file->storeAs("public/books/$directoryName", $fileName);
    }

    private function extractBookData($path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return $extension === 'fb2' ? $this->extractFb2Data($path) : $this->extractEpubData($path);
    }

    private function extractFb2Data($path)
    {
        $xml = XmlReader::make(Storage::path($path));

        $author = request()->input('author') ?? $this->parseAuthor($xml->find('first-name'), $xml->find('last-name'));
        $title = request()->input('title') ?? $this->parseXmlElement($xml->find('book-title'));

        if (!$title || !$author) {
            throw new Exception('Отсутствует название или автор!');
        }

        $description = request()->input('description') ?? $this->parseXmlElement($xml->find('annotation')['p'] ?? null);

        return [
            'title' => $title,
            'author' => $author,
            'description' => $description ?: null,
            'format' => 'fb2',
            'path' => $path,
        ];
    }

    private function extractEpubData($path)
    {
        $ebook = Ebook::read(Storage::path($path));

        $title = request()->input('title') ?? $ebook->getTitle();
        $author = request()->input('author') ?? $ebook->getAuthorMain();
        $description = request()->input('description') ?? $ebook->getDescription();

        if (!$title || !$author) {
            throw new Exception('Отсутствует название или автор!');
        }

        return [
            'title' => $title,
            'author' => $author,
            'path' => $path,
            'format' => $ebook->getFormat(),
            'description' => $description,
        ];
    }

    private function parseAuthor($firstName, $lastName)
    {
        $firstName = is_array($firstName) ? implode(' ', $firstName) : ($firstName ?? '');
        $lastName = is_array($lastName) ? implode(' ', $lastName) : ($lastName ?? '');

        return trim("$firstName $lastName") ?: null;
    }

    private function parseXmlElement($element)
    {
        return is_array($element) ? implode(' ', $element) : $element;
    }
}
