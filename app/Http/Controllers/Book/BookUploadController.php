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

        $author = $this->parseAuthor($xml->find('first-name'), $xml->find('last-name'));
        $title = $this->parseXmlElement($xml->find('book-title'));

        if (!$title || !$author) {
            throw new Exception('Не удалось найти необходимые метаданные: отсутствует название или автор');
        }

        $annotation = $this->parseXmlElement($xml->find('annotation')['p'] ?? null);

        return [
            'title' => $title,
            'author' => $author,
            'description' => $annotation ?: null,
            'format' => 'fb2',
            'path' => $path,
        ];
    }

    private function extractEpubData($path)
    {
        $ebook = Ebook::read(Storage::path($path));

        $title = $ebook->getTitle();
        $author = $ebook->getAuthorMain();

        if (!$title || !$author) {
            throw new Exception('Не удалось найти необходимые метаданные: отсутствует название или автор');
        }

        return [
            'title' => $title,
            'author' => $author,
            'path' => $path,
            'format' => $ebook->getFormat(),
            'description' => $ebook->getDescription(),
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
