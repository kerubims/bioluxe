<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ProductionBatch;

class HarvestReminderNotification extends Notification
{
    use Queueable;

    protected $batch;
    protected $daysRemaining;

    /**
     * Create a new notification instance.
     */
    public function __construct(ProductionBatch $batch, $daysRemaining)
    {
        $this->batch = $batch;
        $this->daysRemaining = $daysRemaining;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Hanya simpan ke database untuk in-app notification
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $dayText = $this->daysRemaining == 0 ? 'HARI INI' : $this->daysRemaining . ' hari lagi';
        
        return [
            'batch_id' => $this->batch->id,
            'batch_number' => $this->batch->batch_number,
            'title' => 'Peringatan Masa Panen',
            'message' => "Batch {$this->batch->batch_number} diprediksi panen {$dayText}.",
            'link' => route('production-batches.show', $this->batch->id)
        ];
    }
}
