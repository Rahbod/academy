<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyAccountNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'title' => trans('notifications.verify-account.success_title'),
            'content' => (trans('notifications.verify-account.success_content'))
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications.verify-account.success_title'))
            ->from('info@profsadvice.com')
            ->line(trans('notifications.verify-account.success_content'))
            ->action('پنل کاربری', url('/profile'));
    }

    public function toArray($notifiable)
    {
        return [
            'title' => trans('notifications.verify-account.success_title'),
            'content' => (trans('notifications.verify-account.success_content'))
        ];
    }
}
