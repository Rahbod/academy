<?php

namespace App\Observers;

use App\BookConcordance;
use Appnegar\Cms\Services\FileGeneratorService;

class BookConcordanceObserver
{
    /**
     * Handle the action "created" event.
     *
     * @param  \App\BookConcordance  $book_concordance
     * @return void
     */
    public function created(BookConcordance $book_concordance)
    {
        FileGeneratorService::createBookZipFile($book_concordance->book_id);
    }

    /**
     * Handle the action "updated" event.
     *
     * @param  \App\BookConcordance  $book_concordance
     * @return void
     */
    public function updated(BookConcordance $book_concordance)
    {
        FileGeneratorService::createBookZipFile($book_concordance->book_id);
    }

    /**
     * Handle the action "deleted" event.
     *
     * @param  \App\BookConcordance  $book_concordance
     * @return void
     */
    public function deleted(BookConcordance $book_concordance)
    {
    }

    /**
     * Handle the action "restored" event.
     *
     * @param  \App\BookConcordance  $book_concordance
     * @return void
     */
    public function restored(BookConcordance $book_concordance)
    {
        //
    }

    /**
     * Handle the action "force deleted" event.
     *
     * @param \App\BookConcordance $book_concordance
     * @return void
     */
    public function forceDeleted(BookConcordance $book_concordance)
    {

    }
}
