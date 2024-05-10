<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatedPkmProposal extends Notification
{
    use Queueable;

    private $proposal;

    /**
     * Create a new notification instance.
     */
    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $tanggal = $this->proposal->updated_at;
        $tanggalBaru = date("j F Y, \j\a\m H:i", strtotime($tanggal));
        return [
            'judul' => $this->proposal->judul,
            'nama' => $this->proposal->user->nama,
            'tanggal' => $tanggalBaru,
        ];
    }
}
