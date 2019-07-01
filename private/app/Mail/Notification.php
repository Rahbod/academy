<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $content;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @param $title
     * @param $content
     * @param $email
     * @internal param $videos
     */
    public function __construct($title, $content, $email)
    {
        $this->title = $title;
        $this->content = $content;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('main_template.pages.email.notification')->with([
            'title' => $this->title,
            'content' => $this->content,
            'email' => $this->email,
        ])->from('info@profsadvice.com')->subject($this->title);
    }
}
