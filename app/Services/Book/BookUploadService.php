<?php

namespace App\Services\Book;

use App\Http\Requests\Book\BookStoreRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BookUploadService
{
    protected $dataExtractor;

    public function __construct(BookDataExtractorService $dataExtractor)
    {
        $this->dataExtractor = $dataExtractor;
    }

    public function uploadBook(BookStoreRequest $request)
    {
        $files = $request->file('book');
        if (empty($files)) {
            throw new Exception('Файлы для загрузки не найдены.');
        }

        $filePath = $this->storeFile($files[array_key_first($files)]);
        $bookData = $this->dataExtractor->extractData($filePath, $request);
        $this->deleteFirstFile($filePath);

        $book = Book::create($bookData);

        $this->storeCover($book, $request);
        $this->storeAllFiles($book, $files);
        $this->attachGenres($book, $request);
        $this->attachTags($book, $request);
        $this->attachAuthors($book, $request);

        return $book;
    }

    private function storeAllFiles($book, $files)
    {
        foreach ($files as $file) {
            $filePath = $this->storeFile($file);
            $book->files()->create([
                'file_path' => $filePath,
                'format' => $file->getClientOriginalExtension(),
            ]);
            $book->save();
        }
    }

    private function storeCover($book, $request)
    {
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $path = $this->storeFileWithPath($cover, 'covers');
            $book->cover_path = $path;
            $book->save();
        }
    }

    private function storeFile(UploadedFile $file, $directory = 'books'): string
    {
        $path = $this->storeFileWithPath($file, $directory);
        return "public/$path";
    }

    private function storeFileWithPath(UploadedFile $file, $directory): string
    {
        $directoryName = date("d-m-Y");
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storePubliclyAs("public/$directory/$directoryName", $fileName);
        return "$directory/$directoryName/$fileName";
    }

    private function deleteFirstFile(string $filePath): void
    {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        } else {
            throw new Exception("Файл $filePath не найден для удаления.");
        }
    }

    private function attachGenres($book, $request)
    {
        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
        }
    }

    private function attachTags($book, $request)
    {
        if ($request->has('tags')) {
            $tags = $request->tags;
            foreach ($tags as $tag) {
                $existingTag = Tag::firstOrCreate(['name' => $tag]);
                $book->tags()->attach($existingTag->id);
            }
        }
    }

    private function attachAuthors($book, $request)
    {
        $authors = $request->authors;
        foreach ($authors as $authorId) {
            $author = Author::find($authorId);
            if ($author) {
                $book->authors()->attach($author->id);
            }
        }
    }
}
