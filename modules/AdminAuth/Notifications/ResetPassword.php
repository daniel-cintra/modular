<?php

namespace Modules\AdminAuth\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    /**
     * Create a notification instance.
     *
     * @param  string  $token
     */
    public function __construct(public $token) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(mixed $notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(mixed $notifiable)
    {
        $params = [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ];

        return (new MailMessage)->markdown(
            'admin-auth::emails.reset-password',
            [
                'url' => url(route('adminAuth.resetPasswordForm', $params, false)),
            ]
        );
    }
}
