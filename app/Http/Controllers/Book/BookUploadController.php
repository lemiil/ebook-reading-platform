<?php

namespace App\Http\Controllers\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\Storage;
use Kiwilan\Ebook\Ebook;
use Kiwilan\XmlReader\XmlReader;


class BookUploadController extends Controller
{
    public function index()
    {
        return view("book/book-upload");
    }

    public function store(BookStoreRequest $request)
    {
        $directoryName = date("d-m-Y");

        try {
            $path = $this->storeFile($request, $directoryName);

            $bookData = $this->extractBookData($path);

            Book::create($bookData);

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

        if ($extension === 'fb2') {
            return $this->extractFb2Data($path);
        } else {
            return $this->extractEpubData($path);
        }
    }

    private function extractFb2Data($path)
    {
        $xml = XmlReader::make(Storage::path($path));

        if (request()->has('author')) {
            $author = request()->input('author');
        }
        else {
            $author = $this->parseAuthor($xml->find('first-name'), $xml->find('last-name'));
        }
        if (request()->has('title')) {
            $title = request()->input('title');
        }
        else {
            $title = $this->parseXmlElement($xml->find('book-title'));
        }

        if (!$title || !$author) {
            throw new Exception('Отсутствует название или автор!');
        }
        if (request()->has('description')) {
            $description = request()->input('description');
        }
        else {
            $description = $this->parseXmlElement($xml->find('annotation')['p'] ?? null);
        }
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
        if (request()->has('title')) {
            $title = request()->input('title');
        }
        else {
            $title = $ebook->getTitle();
        }
        if (request()->has('author')) {
            $author = request()->input('author');
        }
        else {
            $author = $ebook->getAuthorMain();
        }
        if (request()->has('description')) {
            $description = request()->input('description');
        }
        else {
            $description = $ebook->getDescription();
        }
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

        $author = trim("$firstName $lastName");

        return $author ?: null;
    }

    private function parseXmlElement($element)
    {
        return is_array($element) ? implode(' ', $element) : $element;
    }
}
