<?php

namespace Modules\AdminAuth\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
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
