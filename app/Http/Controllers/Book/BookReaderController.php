<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tizis\FB2\FB2Controller;
use Kiwilan\Ebook\Ebook;


class BookReaderController extends Controller
{
    public function index()
    {
//        $ebook = Ebook::read('C:\Users\gaval\Downloads\avidreaders.ru__trinadcatyy-3(1).epub');
        $file = file_get_contents('C:\Users\gaval\Downloads\33859.fb2');
        $item = new FB2Controller($file);
        $item->withNotes();
        $item->startParse();
        $chapters = $item->getBook()->getChapters();

        return view('reader.reader', compact('chapters'));
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
