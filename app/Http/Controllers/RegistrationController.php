<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    /**
     * Register current user for an event
     */
    public function register($eventId)
    {
        // Start transaction
        DB::beginTransaction();
        
        try {
            // Get the event
            $event = Event::findOrFail($eventId);
            
            // Check if event is approved
            if ($event->status !== 'approved') {
                return redirect()->back()->with('error', 'This event is not available for registration at this time.');
            }
            
            // Check if event date is in the past
            if (Carbon::parse($event->event_date)->isPast()) {
                return redirect()->back()->with('error', 'Registration is closed for past events.');
            }
            
            // Get the user
            $user = Auth::user();
            
            // Check if already registered
            $alreadyRegistered = Subscriber::where('user_id', $user->id)
                ->where('event_id', $event->id)
                ->exists();
                
            if ($alreadyRegistered) {
                return redirect()->back()->with('info', 'You are already registered for this event.');
            }
            
            // Get latest count of registrations
            $registeredCount = Subscriber::where('event_id', $event->id)->count();
            $availableSeats = max(0, $event->seats_available - $registeredCount);
            
            // Check if seats are still available
            if ($availableSeats <= 0) {
                return redirect()->back()->with('error', 'Sorry, this event is fully booked. All seats have been reserved.');
            }
            
            // Create registration
            Subscriber::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'status' => 'confirmed',
                'attendance' => false
            ]);
            
            DB::commit();
            
            return redirect()->route('stud.registrations')->with('success', 'Successfully registered for the event!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    /**
     * Cancel registration
     */
    public function cancel($eventId)
    {
        try {
            // Get the user
            $user = Auth::user();
            
            // Find registration
            $registration = Subscriber::where('user_id', $user->id)
                ->where('event_id', $eventId)
                ->first();
                
            if (!$registration) {
                return redirect()->back()->with('error', 'You are not registered for this event.');
            }
            
            // Delete registration
            $registration->delete();
            
            return redirect()->route('stud.registrations')->with('success', 'Registration cancelled successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    /**
     * Show user's registrations
     */
    public function myRegistrations()
    {
        $user = Auth::user();
        
        // Get registrations with event details
        $registrations = Subscriber::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
            
        return view('stud.registrations', compact('registrations'));
    }
} 