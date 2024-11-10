<?php

namespace App\Services\Book;

use Exception;
use Illuminate\Support\Facades\Storage;
use Kiwilan\Ebook\Ebook;
use Kiwilan\XmlReader\XmlReader;
use Mews\Purifier\Purifier;

class BookDataExtractorService
{
    public function extractData(string $path, $request): array
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return $extension === 'fb2'
            ? $this->extractFb2Data($path, $request)
            : $this->extractOtherEbookData($path, $request);
    }

    private function extractFb2Data(string $path, $request): array
    {
        $xml = XmlReader::make(Storage::path($path));

        $title = $request->input('title') ?? $this->parseXmlElement($xml->find('book-title'));
        $description = $request->input('description') ?? $this->parseXmlElement($xml->find('annotation')['p'] ?? null);
        $year = $request->input('year') ?? null;

        if (!$title) {
            throw new Exception('Отсутствует название или автор!');
        }

        return [
            'title' => $title,
            'description' => $description,
            'year' => $year,
        ];
    }

    private function extractOtherEbookData(string $path, $request): array
    {
        $ebook = Ebook::read(Storage::path($path));

        $title = $request->input('title') ?? $ebook->getTitle();
        $description = $request->input('description') ?? $ebook->getDescription();
        $year = $request->input('year') ?? null;

        if (!$title) {
            throw new Exception('Отсутствует название или автор!');
        }

        return [
            'title' => $title,
            'description' => $description,
            'year' => $year,
        ];
    }

    private function parseXmlElement($element): ?string
    {
        return is_array($element) ? implode(' ', $element) : $element;
    }
}

