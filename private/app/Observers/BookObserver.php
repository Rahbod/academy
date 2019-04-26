<?php

namespace App\Observers;

use App\Book;
use Appnegar\Cms\Services\FileGeneratorService;

class BookObserver
{
    /**
     * Handle the action "created" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function created(Book $book)
    {
        FileGeneratorService::createBookZipFile($book->id);
    }

    /**
     * Handle the action "updated" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function updated(Book $book)
    {
        FileGeneratorService::createBookZipFile($book->id);
    }

    /**
     * Handle the action "deleted" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function deleted(Book $book)
    {
        \Storage::delete('book/zip_file/'.$book->id.'.zip');
    }

    /**
     * Handle the action "restored" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function restored(Book $book)
    {
        //
    }

    /**
     * Handle the action "force deleted" event.
     *
     * @param \App\Book $book
     * @return void
     */
    public function forceDeleted(Book $book)
    {

    }

}
