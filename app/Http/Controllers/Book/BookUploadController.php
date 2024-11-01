<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Models\Author;
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
        try {
            if ($request->hasFile('book')) {
                $firstFile = $request->file('book')[0];
                $filePath = $this->storeFile($firstFile);
                $bookData = $this->extractBookData($filePath);

                if ($request->has('author')) {
                    $authorName = $request->author;
                    $author = Author::where('name', $authorName)->first();

                    if ($author) {
                        $bookData['author_id'] = $author->id;
                    } else {
                        return redirect()->route('book.upload.view')->withErrors('Автор не найден: ' . $authorName);
                    }
                } else {
                    return redirect()->route('book.upload.view')->withErrors('Не указан автор.');
                }
                
                $book = Book::create($bookData);

                $book->files()->create([
                    'file_path' => $filePath,
                    'format' => $firstFile->getClientOriginalExtension(),
                ]);

                foreach (array_slice($request->file('book'), 1) as $file) {
                    $filePath = $this->storeFile($file);
                    $book->files()->create([
                        'file_path' => $filePath,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
                if ($request->has('genres')) {
                    $book->genres()->attach($request->genres);
                }
            }

            return redirect()->route('book.upload.view')->with('bookisuploaded', 'Книга успешно загружена. Вы молодец.');
        } catch (Exception $e) {
            return redirect()->route('book.upload.view')->withErrors('Ошибка при загрузке книги: ' . $e->getMessage());
        }
    }


    private function storeFile($file)
    {
        $directoryName = date("d-m-Y");
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;

        return $file->storeAs("public/books/$directoryName", $fileName);
    }

    private function extractBookData($path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return $extension === 'fb2' ? $this->extractFb2Data($path) : $this->extractOtherEbookData($path);
    }

    private function extractFb2Data($path)
    {
        $xml = XmlReader::make(Storage::path($path));

        $title = request()->input('title') ?? $this->parseXmlElement($xml->find('book-title'));
        $description = request()->input('description') ?? $this->parseXmlElement($xml->find('annotation')['p'] ?? null);
        $year = request()->input('year') ?? null;

        if (!$title) {
            throw new Exception('Отсутствует название или автор!');
        }
        return [
            'title' => $title,
            'description' => $description,
            'year' => $year
        ];
    }

    private function extractOtherEbookData($path)
    {
        $ebook = Ebook::read(Storage::path($path));

        $title = request()->input('title') ?? $ebook->getTitle();
        $description = request()->input('description') ?? $ebook->getDescription();
        $year = request()->input('year') ?? null;

        if (!$title) {
            throw new Exception('Отсутствует название или автор!');
        }

        return [
            'title' => $title,
            'description' => $description,
            'year' => $year,
        ];
    }


    private function parseXmlElement($element)
    {
        return is_array($element) ? implode(' ', $element) : $element;
    }
}
