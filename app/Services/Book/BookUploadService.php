<?php


namespace App\Services\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Exception;
use Illuminate\Http\UploadedFile;

class BookUploadService
{
    protected $dataExtractor;

    public function __construct(BookDataExtractorService $dataExtractor)
    {
        $this->dataExtractor = $dataExtractor;
    }

    public function uploadBook($request)
    {
        $files = $request->file('book');
        if (empty($files)) {
            throw new Exception('Файлы для загрузки не найдены.');
        }

        $filePath = $this->storeFile($files[0]);
        $bookData = $this->dataExtractor->extractData($filePath, $request);
        $author = Author::firstWhere('name', $request->author);

        if (!$author) {
            throw new Exception('Автор не найден: ' . $request->author);
        }

        $bookData['author_id'] = $author->id;
        $book = Book::create($bookData);

        if ($request->hasFile('cover')) {
            $this->storeCover($request->file('cover'), $book);
        }

        foreach ($files as $index => $file) {
            if ($index > 0 || $files[0]) { // Сохраняем все файлы, включая первый
                $filePath = $this->storeFile($file);
                $book->files()->create([
                    'file_path' => $filePath,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        $this->attachGenres($book, $request);
        $this->attachTags($book, $request);

        return $book;
    }

    private function storeCover(UploadedFile $cover, $book)
    {
        $path = $this->storeFileWithPath($cover, 'covers');
        $book->cover()->create(['file_path' => $path]);
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

    private function attachGenres($book, $request)
    {
        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
        }
    }

    private function attachTags($book, $request)
    {
        if ($request->has('tags')) {
            $tags = json_decode($request->tags, true);
            foreach ($tags as $tag) {
                $existingTag = Tag::firstOrCreate(['name' => $tag]);
                $book->tags()->attach($existingTag->id);
            }
        }
    }
}
