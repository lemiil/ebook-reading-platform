<?php


namespace App\Services\Book;

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

    public function uploadBook($request)
    {
        $firstFile = $request->file('book')[0];
        $filePath = $this->storeFile($firstFile);
        $bookData = $this->dataExtractor->extractData($filePath, $request);

        $authorName = $request->author;
        $author = Author::where('name', $authorName)->first();

        if (!$author) {
            throw new Exception('Автор не найден: ' . $authorName);
        }

        $bookData['author_id'] = $author->id;

        $book = Book::create($bookData);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');

            $directoryName = date("d-m-Y");
            $extension = $cover->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $cover->move(public_path('covers/' . $directoryName), $fileName);
            $path = 'covers/' . $directoryName . '/' . $fileName;
            $book->cover()->create([
                'file_path' => $path,
            ]);
        }


        $book->files()->create([
            'file_path' => $filePath,
            'format' => $firstFile->getClientOriginalExtension(),
        ]);
        if ($request->file('book') >= 2) {
            foreach (array_slice($request->file('book'), 1) as $file) {
                $filePath = $this->storeFile($file);
                $book->files()->create([
                    'file_path' => $filePath,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
            return $book;
        }
        if ($request->has('tags')) {
            $tags = json_decode($request->tags);
            foreach ($tags as $tag) {
                $existingTag = Tag::firstOrCreate(['name' => $tag]);
                $book->tags()->attach($existingTag->id);
            }
        }
    }


    private function storeFile(UploadedFile $file): string
    {
        $directoryName = date("d-m-Y");
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;
        $file->move(public_path('books/' . $directoryName), $fileName);
        $path = "public/books/$directoryName/$fileName";

        return $path;
    }
}
