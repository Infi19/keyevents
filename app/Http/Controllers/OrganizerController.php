<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrganizerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get stats from session or generate new ones
        if (session()->has('dashboard_stats')) {
            $stats = session('dashboard_stats');
            session()->forget('dashboard_stats'); // Clear after use
        } else {
            // Create stats if accessing the dashboard directly
            $stats = [
                'active_events' => Event::where('user_id', $user->id)->where('status', 'approved')->count(),
                'total_registrations' => Subscriber::whereHas('event', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
                'total_participants' => Subscriber::whereHas('event', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
                'upcoming_events' => Event::where('user_id', $user->id)
                                    ->where('event_date', '>=', now())
                                    ->count(),
                'average_rating' => 4.8, // Placeholder, you would calculate this from an actual ratings table
                'media_uploads' => \App\Models\EventMedia::whereHas('event', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
            ];
        }
        
        // Get upcoming events
        $upcomingEvents = Event::where('user_id', $user->id)
                            ->where('event_date', '>=', now())
                            ->orderBy('event_date', 'asc')
                            ->take(5)
                            ->get();
        
        // Get recent feedback
        $recentFeedback = [
            [
                'user' => 'John Doe',
                'rating' => 5,
                'comment' => 'Great workshop! Learned a lot about web development.',
                'days_ago' => 2
            ]
        ]; // Placeholder, you would get this from an actual feedback table
        
        return view('organizer.dashboard', compact('stats', 'upcomingEvents', 'recentFeedback'));
    }
    
    public function myEvents(Request $request)
    {
        $user = Auth::user();
        
        // Start building the query for events
        $eventsQuery = Event::where('user_id', $user->id);
        
        // Apply filters
        if ($request->filled('status')) {
            $eventsQuery->where('status', $request->status);
        }
        
        if ($request->filled('date')) {
            if ($request->date === 'upcoming') {
                $eventsQuery->where('event_date', '>=', now());
            } elseif ($request->date === 'past') {
                $eventsQuery->where('event_date', '<', now());
            }
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $eventsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('about', 'like', '%' . $search . '%');
            });
        }
        
        // Get the filtered events with count of subscribers (not registrations)
        $events = $eventsQuery->withCount('subscribers as registrations_count')
                    ->orderBy('event_date', 'desc')
                    ->paginate(10)
                    ->withQueryString();
        
        // Get events statistics
        $stats = [
            'total' => Event::where('user_id', $user->id)->count(),
            'approved' => Event::where('user_id', $user->id)->where('status', 'approved')->count(),
            'pending' => Event::where('user_id', $user->id)->where('status', 'pending')->count(),
            'rejected' => Event::where('user_id', $user->id)->where('status', 'rejected')->count(),
            'upcoming' => Event::where('user_id', $user->id)
                            ->where('event_date', '>=', now())
                            ->where('status', 'approved')
                            ->count(),
            'past' => Event::where('user_id', $user->id)
                        ->where('event_date', '<', now())
                        ->where('status', 'approved')
                        ->count(),
        ];
        
        return view('organizer.my-events', compact('events', 'stats'));
    }
    
    /**
     * Show the list of events with registration statistics for the organizer
     */
    public function registrations(Request $request)
    {
        $user = Auth::user();
        
        // Start building the query for events
        $eventsQuery = Event::where('user_id', $user->id);
        
        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->search;
            $eventsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('about', 'like', '%' . $search . '%');
            });
        }
        
        // Use withCount to count subscribers (registrations)
        $events = $eventsQuery->withCount('subscribers as registrations_count')
                    ->orderBy('registrations_count', 'desc')
                    ->paginate(10)
                    ->withQueryString();
        
        // Get registration statistics
        $totalRegistrations = Subscriber::whereHas('event', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        $upcomingEventsWithRegistrations = Event::where('user_id', $user->id)
                                            ->where('event_date', '>=', now())
                                            ->withCount('subscribers as registrations_count')
                                            ->having('registrations_count', '>', 0)
                                            ->count();
        
        $stats = [
            'total_registrations' => $totalRegistrations,
            'upcoming_events_with_registrations' => $upcomingEventsWithRegistrations,
            'average_registrations_per_event' => $events->count() > 0 
                ? round($totalRegistrations / $events->count(), 1) 
                : 0,
        ];
        
        return view('organizer.registrations', compact('events', 'stats'));
    }
    
    /**
     * Show the registrations for a specific event
     */
    public function eventRegistrations(Event $event)
    {
        // Make sure the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get registrations with user data (using subscribers table)
        $registrations = Subscriber::with('user')
                            ->where('event_id', $event->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);
        
        // Count directly to verify
        $registrationCount = Subscriber::where('event_id', $event->id)->count();
        
        // Debug information to display on the page temporarily
        $debug = [
            'event_id' => $event->id,
            'direct_count' => $registrationCount,
            'paginated_count' => $registrations->total(),
            'model_used' => 'Subscriber',
        ];
        
        return view('organizer.event-registrations', compact('event', 'registrations', 'debug'));
    }
    
    /**
     * Show the form for editing an event
     */
    public function edit(Event $event)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('organizer.events.edit', compact('event'));
    }
    
    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'about' => 'required|string',
            'category' => 'required|string',
            'type' => 'required|string',
            'event_date' => 'required|date',
            'seats_available' => 'required|integer|min:1',
        ]);
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image_path'] = $imagePath;
        }
        
        // Update the event
        $event->update($validated);
        
        return redirect()->route('organizer.my-events')
            ->with('success', 'Event updated successfully.');
    }
    
    /**
     * Delete the specified event
     */
    public function destroy(Event $event)
    {
        // Check if the event belongs to the current user
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the event has subscribers/registrations
        if ($event->subscribers()->count() > 0) {
            return redirect()->route('organizer.my-events')
                ->with('error', 'Cannot delete event with registrations. Please contact admin for assistance.');
        }
        
        // Delete the event image if it exists
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        
        // Delete the event
        $event->delete();
        
        return redirect()->route('organizer.my-events')
            ->with('success', 'Event deleted successfully.');
    }
} 