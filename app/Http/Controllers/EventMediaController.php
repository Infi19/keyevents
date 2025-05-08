<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EventMediaController extends Controller
{
    /**
     * Display a list of all events with media galleries for the current organizer.
     */
    public function overview()
    {
        $user = Auth::user();
        
        // Get all events that belong to the current user
        $events = Event::where('user_id', $user->id)
                    ->withCount('media')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        // Get total media count
        $totalMediaCount = EventMedia::whereHas('event', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        // Get media type counts
        $imageCount = EventMedia::whereHas('event', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('file_type', 'image')->count();
        
        $videoCount = EventMedia::whereHas('event', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('file_type', 'video')->count();
        
        return view('organizer.media.overview', compact('events', 'totalMediaCount', 'imageCount', 'videoCount'));
    }
    
    /**
     * Display the media gallery for an event.
     */
    public function index(Event $event)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get all media for the event
        $mediaItems = $event->media()->orderBy('created_at', 'desc')->get();
        
        // Count items by type
        $imageCounts = $mediaItems->where('file_type', 'image')->count();
        $videoCounts = $mediaItems->where('file_type', 'video')->count();
        
        return view('organizer.media.index', compact('event', 'mediaItems', 'imageCounts', 'videoCounts'));
    }
    
    /**
     * Show the form for uploading media to an event.
     */
    public function create(Event $event)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('organizer.media.create', compact('event'));
    }
    
    /**
     * Store media files for the event.
     */
    public function store(Request $request, Event $event)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate the request
        $request->validate([
            'media_files' => 'required|array',
            'media_files.*' => 'required|file|max:102400', // 100MB max file size
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
            'descriptions' => 'nullable|array',
            'descriptions.*' => 'nullable|string',
        ]);
        
        $uploadedFiles = [];
        
        // Process each uploaded file
        foreach ($request->file('media_files') as $key => $file) {
            // Determine file type based on mime type
            $mimeType = $file->getMimeType();
            $fileType = Str::startsWith($mimeType, 'image/') ? 'image' : 
                       (Str::startsWith($mimeType, 'video/') ? 'video' : 'other');
            
            // Only process images and videos
            if ($fileType === 'other') {
                continue;
            }
            
            // Generate a unique filename
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Store the file
            $filePath = $file->storeAs('event-media/' . $event->id, $filename, 'public');
            
            // Create media record
            $media = EventMedia::create([
                'event_id' => $event->id,
                'filename' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'file_type' => $fileType,
                'mime_type' => $mimeType,
                'title' => $request->input('titles.' . $key, null),
                'description' => $request->input('descriptions.' . $key, null),
                'size_in_bytes' => $file->getSize(),
            ]);
            
            $uploadedFiles[] = $media;
        }
        
        if (count($uploadedFiles) > 0) {
            return redirect()->route('organizer.event.media.index', $event)
                ->with('success', count($uploadedFiles) . ' media files uploaded successfully.');
        } else {
            return redirect()->route('organizer.event.media.create', $event)
                ->with('error', 'No valid media files were uploaded. Please upload image or video files.');
        }
    }
    
    /**
     * Show media file edit form.
     */
    public function edit(Event $event, EventMedia $media)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the media belongs to the event
        if ($media->event_id !== $event->id) {
            abort(404, 'Media not found for this event.');
        }
        
        return view('organizer.media.edit', compact('event', 'media'));
    }
    
    /**
     * Update media file details.
     */
    public function update(Request $request, Event $event, EventMedia $media)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the media belongs to the event
        if ($media->event_id !== $event->id) {
            abort(404, 'Media not found for this event.');
        }
        
        // Validate the request
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        // Update the media details
        $media->update($validated);
        
        return redirect()->route('organizer.event.media.index', $event)
            ->with('success', 'Media details updated successfully.');
    }
    
    /**
     * Delete media file.
     */
    public function destroy(Event $event, EventMedia $media)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the media belongs to the event
        if ($media->event_id !== $event->id) {
            abort(404, 'Media not found for this event.');
        }
        
        // Delete the file from storage
        Storage::disk('public')->delete($media->file_path);
        
        // Delete the media record
        $media->delete();
        
        return redirect()->route('organizer.event.media.index', $event)
            ->with('success', 'Media file deleted successfully.');
    }
    
    /**
     * Display a specific media item.
     */
    public function show(Event $event, EventMedia $media)
    {
        // Check if the event belongs to the current user or if the event is approved (public)
        if ($event->user_id !== Auth::id() && $event->status !== 'approved') {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the media belongs to the event
        if ($media->event_id !== $event->id) {
            abort(404, 'Media not found for this event.');
        }
        
        return view('organizer.media.show', compact('event', 'media'));
    }
}
