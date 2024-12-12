<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassword extends Notifications
{
    use Queueable;

    public function __construct(protected $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Permintaan riset password')
        ->greeting('Halo, '.$notifiable->nama )
        ->action('Riset_password', url('/riset-password?token='.$this->token));
    }
}