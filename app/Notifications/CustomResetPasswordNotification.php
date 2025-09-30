<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;


    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Permintaan Reset Kata Sandi - SIGARDA')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Anda menerima email ini karena kami menerima permintaan reset kata sandi untuk akun Anda di **SIGARDA (Sistem Informasi Gerbang Arsip Digital)**.')
            ->action('Reset Kata Sandi', $url)
            ->line('Tautan reset kata sandi ini hanya berlaku selama 60 menit.')
            ->line('Jika Anda tidak meminta reset kata sandi, abaikan email ini dan tidak ada tindakan lebih lanjut yang diperlukan.')
            ->salutation('Hormat kami, Tim SIGARDA');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
