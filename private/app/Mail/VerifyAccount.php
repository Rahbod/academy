<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class VerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = URL::signedRoute('verify_account', ['verify_email_link' => $this->user->verify_email_link,'lang'=>session('lang')]);
        return $this->markdown('main_template.pages.email.activation')
            ->with([
                'greeting' => trans('notifications.greeting') . ' ' . $this->user->username,
                'introLines' => trans('notifications.verify-account.intro'),
                'outroLines' => trans('notifications.verify-account.outro'),
                'level' => 'success',
                'actionText' => trans('notifications.verify-account.action'),
                'actionUrl' => url($url),
                'siteName' => trans('messages.global.site-name'),
                'activation' => trans('notifications.verify-account.subject'),
            ])
            ->from('info@profsadvice.com')
            ->subject(trans('notifications.verify-account.action'));


    }
}
