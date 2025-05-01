<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get stats
        $stats = [
            'active_events' => Event::where('user_id', $user->id)->where('status', 'approved')->count(),
            'total_registrations' => Registration::whereHas('event', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count(),
            'upcoming_events' => Event::where('user_id', $user->id)
                                    ->where('event_date', '>=', now())
                                    ->count(),
            'average_rating' => 4.8, // Placeholder, you would calculate this from an actual ratings table
            'media_uploads' => 234, // Placeholder, you would count this from an actual media table
        ];
        
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
} 