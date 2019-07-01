<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * The "user" of the notification.
     *
     * @var Model
     */
    public $user;


    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => trans('notifications.password-reset.action'),
            'content' => (trans('notifications.password-reset.intro'))
        ];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $mail_message = (new MailMessage)
            ->greeting(trans('notifications.greeting') . ' ' . $this->user->name ?? $this->user->username)
            ->from('info@profsadvice.com')
            ->subject(trans('notifications.password-reset.action'))
            ->line(trans('notifications.password-reset.intro'))
            ->action(trans('notifications.password-reset.action'),
                url(config('app.url') . route('password.reset', ['lang' => session('lang'), $this->token], false)))
            ->line(trans('notifications.password-reset.outro'));

//        dd($mail_message);
        return $mail_message;
    }
}
