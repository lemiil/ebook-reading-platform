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

            $extension = $request->file('book')->getClientOriginalExtension();
            if ($extension == "epub") {
                $fileNameWithEx = time() . '.' . $extension;
                $path = $request->file('book')->storeAs("/books/$directoryName", $fileNameWithEx, 'public');
            }
            else {
                $path = $request->file('book')->store("public/books/$directoryName");
            }

            if ($extension === 'fb2') {
                $xml = XmlReader::make(Storage::path($path));

                $firstName = $xml->find('first-name');
                $lastName = $xml->find('last-name');

                $firstName = is_array($firstName) ? implode(' ', $firstName) : ($firstName ?? '');
                $lastName = is_array($lastName) ? implode(' ', $lastName) : ($lastName ?? '');

                $author = trim($firstName . ' ' . $lastName);

                if (empty($author)) {
                    $author = 'Unknown';
                }

                $annotation = $xml->find('annotation')['p'] ?? null;
                $description = is_array($annotation) ? implode(' ', $annotation) : $annotation;

                Book::create([
                    'title' => is_array($xml->find('book-title')) ? implode(' ', $xml->find('book-title')) : $xml->find('book-title'),
                    'author' => $author,
                    'description' => $description ?: null,
                    'format' => 'fb2',
                    'path' => $path,
                ]);
            }

            else {
                $ebook = Ebook::read(Storage::path($path));

                Book::create([
                    "title" => $ebook->getTitle(),
                    "author" => $ebook->getAuthorMain(),
                    "path" => $path,
                    "format" => $ebook->getFormat(),
                    "description" => $ebook->getDescription(),
                ]);
            }

            return redirect(route('book.upload.view'))->with('bookisuploaded', 'true');
        } catch (Exception $e) {
            return redirect(route('book.upload.view'))->withErrors('Ошибка при загрузке книги: ' . $e->getMessage());
        }
    }
}
