<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display the student dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get events the student has registered for
        $registeredEvents = Subscriber::where('user_id', $user->id)
            ->with('event')
            ->get();
        
        // Count upcoming events
        $upcomingCount = 0;
        foreach ($registeredEvents as $registration) {
            if ($registration->event && $registration->event->event_date && $registration->event->event_date->gt(now())) {
                $upcomingCount++;
            }
        }
        
        // Get upcoming events for display
        $upcomingEvents = Event::where('event_date', '>', now())
            ->whereIn('id', $registeredEvents->pluck('event_id'))
            ->orderBy('event_date')
            ->take(5)
            ->get();
        
        // Get certificates (in a real app, you'd have a Certificate model)
        // For now, we'll simulate with completed events
        $certificates = Subscriber::where('user_id', $user->id)
            ->where('attendance', true)
            ->with('event')
            ->get();
        
        // Get clubs/organizations following
        // For now, we'll simulate with a count of 4 as shown in the screenshot
        $clubsFollowing = 4;
        
        // Get recent notifications
        // In a real app, you'd query the notifications table
        // For now, we'll create simulated notifications
        $notifications = [
            [
                'title' => 'Reminder: Web Development Workshop tomorrow',
                'time' => '1 hour ago'
            ],
            [
                'title' => 'Your certificate for "AI Fundamentals" is ready',
                'time' => '2 days ago'
            ]
        ];
        
        return view('stud.dashboard', [
            'registeredEventsCount' => $registeredEvents->count(),
            'upcomingCount' => $upcomingCount,
            'certificatesCount' => $certificates->count(),
            'clubsFollowing' => $clubsFollowing,
            'upcomingEvents' => $upcomingEvents,
            'certificates' => $certificates,
            'notifications' => $notifications
        ]);
    }
    
    /**
     * Display all events registered by the student.
     *
     * @return \Illuminate\View\View
     */
    public function myEvents()
    {
        $user = Auth::user();
        
        // Get all events the student has registered for
        $registrations = Subscriber::where('user_id', $user->id)
            ->with('event')
            ->get();
            
        return view('stud.my-events', [
            'registrations' => $registrations
        ]);
    }
    
    /**
     * Display all certificates earned by the student.
     *
     * @return \Illuminate\View\View
     */
    public function certificates()
    {
        $user = Auth::user();
        
        // Get all certificates (completed events with attendance)
        $certificates = Subscriber::where('user_id', $user->id)
            ->where('attendance', true)
            ->with('event')
            ->get();
            
        return view('stud.certificates', [
            'certificates' => $certificates
        ]);
    }
    
    /**
     * Display notifications for the student.
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        $user = Auth::user();
        
        // In a real app, you'd query from a notifications table
        // For now, we'll generate sample notifications
        $notifications = [
            [
                'title' => 'Reminder: Web Development Workshop tomorrow',
                'message' => 'Don\'t forget your laptop and prepare your questions!',
                'time' => '1 hour ago',
                'type' => 'reminder',
                'is_read' => false
            ],
            [
                'title' => 'Your certificate for "AI Fundamentals" is ready',
                'message' => 'Your attendance has been verified and your certificate is now available for download.',
                'time' => '2 days ago',
                'type' => 'certificate',
                'is_read' => true
            ],
            [
                'title' => 'New event: Introduction to Blockchain Technology',
                'message' => 'A new event matching your interests has been added. Register before seats fill up!',
                'time' => '3 days ago',
                'type' => 'new_event',
                'is_read' => true
            ],
            [
                'title' => 'Your registration for "Data Science Workshop" is confirmed',
                'message' => 'Your spot has been reserved. Looking forward to seeing you there!',
                'time' => '1 week ago',
                'type' => 'confirmation',
                'is_read' => true
            ],
            [
                'title' => 'Feedback requested: Cybersecurity Seminar',
                'message' => 'Please share your feedback on the event you attended last week.',
                'time' => '2 weeks ago',
                'type' => 'feedback',
                'is_read' => true
            ]
        ];
        
        return view('stud.notifications', [
            'notifications' => $notifications
        ]);
    }
} 