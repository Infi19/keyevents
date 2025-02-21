<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event;
use Carbon\Carbon;

class NewEventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    /**
     * Create a new notification instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
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
        return (new MailMessage)
            ->subject('New Event: ' . $this->event->title)
            ->greeting('Hello!')
            ->line('A new event has been scheduled.')
            ->line('Event Details:')
            ->line('Title: ' . $this->event->title)
            ->line('Date: ' . $this->event->event_date->format('D, M j, Y'))
            ->line('Time: ' . $this->event->time_from_hour . ':' . 
                str_pad($this->event->time_from_minute, 2, '0', STR_PAD_LEFT) . ' ' . 
                $this->event->time_from_period . ' to ' . 
                $this->event->time_to_hour . ':' . 
                str_pad($this->event->time_to_minute, 2, '0', STR_PAD_LEFT) . ' ' . 
                $this->event->time_to_period)
            ->line('Type: ' . $this->event->type)
            ->line('Category: ' . $this->event->category)
            ->action('View Event Details', url('/event/' . $this->event->id))
            ->line('Thank you for using our application!');
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
