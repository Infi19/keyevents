<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'attendance',
    ];

    /**
     * Get the user associated with the subscription
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event associated with the subscription
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
