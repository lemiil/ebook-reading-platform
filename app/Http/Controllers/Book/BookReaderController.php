<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kiwilan\Ebook\Ebook;
use function MongoDB\BSON\toJSON;

class BookReaderController extends Controller
{
    public function index()
    {
//        $ebook = Ebook::read('C:\Users\gaval\Downloads\avidreaders.ru__trinadcatyy-3(1).epub');
        $ebook = Ebook::read('C:\Users\gaval\Downloads\London_Martin-Iden.ABA6eQ.33859.fb2\33859.fb2');
        $book = $ebook->getParser()?->getFb2()->getParser()->getBody();
        $bookCopy = $book;
        $chapters = array_shift($bookCopy);

        return view('reader.reader', compact('book', 'chapters'));
//        dd($epub->getParser()->getBody());

    }
    //эта херота эт епаб полагаю? нужно оставлять комментарии в коде емае

//    public function index()
//    {
//        $ebook = Ebook::read('C:\Code\webDevBack\ebook-reading-platform\storage\app\public\books\20-11-2024\673e0af880f8b.epub');
//        $archive = $ebook->getArchive();
//
//        $metadataXml = $archive->find('metadata.xml'); // First ArchiveItem with `metadata.xml` in their path
//        $content = $archive->getContents($metadataXml);
//        dd($content);
//
//    }
//}
}
