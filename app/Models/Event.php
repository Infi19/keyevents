<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   
    protected $fillable = [
        'title',
        'about',
        'image_path',
        'type',
        'category',
        'event_date',
        'time_from_hour',
        'time_from_minute',
        'time_from_period',
        'time_to_hour',
        'time_to_minute',
        'time_to_period',
        'status',
        'user_id',
        'rejection_reason',
        'seats_available',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
    
    /**
     * Get the user that owns the event (organizer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get all subscribers for this event
     */
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
