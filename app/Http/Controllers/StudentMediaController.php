<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Support\Facades\Auth;

class StudentMediaController extends Controller
{
    /**
     * Display the media gallery for an event.
     */
    public function show(Event $event)
    {
        // Only allow viewing media for approved events
        if ($event->status !== 'approved') {
            abort(404, 'Event not found.');
        }
        
        // Get all media for the event
        $mediaItems = $event->media()->orderBy('created_at', 'desc')->get();
        
        // Count items by type
        $imageCount = $mediaItems->where('file_type', 'image')->count();
        $videoCount = $mediaItems->where('file_type', 'video')->count();
        
        return view('stud.media.show', compact('event', 'mediaItems', 'imageCount', 'videoCount'));
    }

    /**
     * View a specific media item
     */
    public function viewMedia(Event $event, EventMedia $media)
    {
        // Only allow viewing media for approved events
        if ($event->status !== 'approved') {
            abort(404, 'Event not found.');
        }
        
        // Check if the media belongs to the event
        if ($media->event_id !== $event->id) {
            abort(404, 'Media not found for this event.');
        }
        
        return view('stud.media.view', compact('event', 'media'));
    }
} 