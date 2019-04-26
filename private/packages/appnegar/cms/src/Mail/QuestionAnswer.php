<?php

namespace Appnegar\Cms\Mail;

use App\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionAnswer extends Mailable
{
    use Queueable, SerializesModels;

    public $question;

    /**
     * Create a new message instance.
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question=$question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@mohaqeq.org')
            ->subject(__('questions.messages.receipt_answer'))
            ->view('appnegar::mail.answer_question')->with(['question'=>$this->question]);
    }
}
