<?php

namespace Appnegar\Cms\Services;

use App\Book;
use ZipArchive;

class FileGeneratorService{

    /**
     * @param $book_id
     * @return bool
     */
    public static function createBookZipFile($book_id){
        $book = Book::with('concordances')->find($book_id);

        $content = view("appnegar::zip.book")->with(['book' => $book])->render();

        $zip = new ZipArchive;
        $path=public_path('storage/book/zip_file/' . $book->id . '.zip');
        $res = $zip->open($path, ZipArchive::CREATE);
        if ($res === true) {
            $zip->addFromString($book->id . '.htm', $content);
            $zip->close();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}