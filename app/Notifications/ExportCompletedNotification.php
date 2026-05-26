<?php

namespace App\Notifications;

use Filament\Actions\Exports\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExportCompletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Export $export) {}

    /**
     * @return array<string>
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Guest export complete')
            ->line("Your guest export has completed with {$this->export->successful_rows} rows exported.")
            ->action('Open Admin Panel', url('/admin'))
            ->line('The download link is available in the notifications bell in the admin panel.');
    }
}
