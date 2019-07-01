<?php

namespace App\Listeners;


use App\Events\Registered;
use App\Mail\VerifyAccount;
use Illuminate\Support\Facades\Mail;

class VerifyAccountMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to($event->user)->send(new VerifyAccount($event->user));
    }
}
