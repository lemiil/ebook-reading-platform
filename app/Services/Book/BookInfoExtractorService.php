<?php

namespace App\Services\Book;

use Kiwilan\Ebook\Ebook;

class BookInfoExtractorService
{
    public function getCoverBase64(string $filePath): ?string
    {
        try {
            $ebook = Ebook::read($filePath);
            $cover = $ebook->getCover();
            return $cover ? $cover->getContents(true) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
