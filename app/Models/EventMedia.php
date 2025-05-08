<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventMedia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'filename',
        'file_path',
        'file_type',
        'mime_type',
        'title',
        'description',
        'size_in_bytes',
    ];

    /**
     * Get the event that owns the media.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
