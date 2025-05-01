<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewEventNotification;
use App\Models\User;
use Illuminate\Validation\ValidationException;


class EventController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Starting event creation process');
        Log::info('Request data:', $request->all());

        try {
            DB::beginTransaction();
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'about' => 'required|string',
                'file_upload' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
                'type' => 'required|string|in:In-Person,Virtual',
                'category' => 'required|string',
                'event_date' => 'required|date',
                'time_from_hour' => 'required|integer|min:1|max:12',
                'time_from_minute' => 'required|integer|min:0|max:59',
                'time_from_period' => 'required|string|in:AM,PM',
                'time_to_hour' => 'required|integer|min:1|max:12',
                'time_to_minute' => 'required|integer|min:0|max:59',
                'time_to_period' => 'required|string|in:AM,PM',
                'seats_available' => 'required|integer|min:1|max:1000',
            ]);

            $imagePath = null;
            if ($request->hasFile('file_upload')) {
                $imagePath = $request->file('file_upload')->store('event-images', 'public');
                
                // For debugging
                Log::info('Image uploaded to: ' . $imagePath);
            }
            
            // Get the current user ID or null if not authenticated
            $userId = auth()->check() ? auth()->id() : null;
            
            // Determine the status based on user role
            $status = 'pending';
            if (auth()->user()->isAdmin()) {
                // Admins can create pre-approved events
                $status = 'approved';
            }

            try {
                $event = Event::create([
                    'title' => $validated['title'],
                    'about' => $validated['about'],
                    'image_path' => $imagePath,
                    'type' => $validated['type'],
                    'category' => $validated['category'],
                    'event_date' => $validated['event_date'],
                    'time_from_hour' => $validated['time_from_hour'],
                    'time_from_minute' => $validated['time_from_minute'],
                    'time_from_period' => $validated['time_from_period'],
                    'time_to_hour' => $validated['time_to_hour'],
                    'time_to_minute' => $validated['time_to_minute'],
                    'time_to_period' => $validated['time_to_period'],
                    'user_id' => $userId,
                    'status' => $status,
                    'seats_available' => $validated['seats_available'],
                ]);
            } catch (\Exception $e) {
                // If user_id column doesn't exist, create event without it
                Log::error('Error creating event with user_id: ' . $e->getMessage());
                $event = Event::create([
                    'title' => $validated['title'],
                    'about' => $validated['about'],
                    'image_path' => $imagePath,
                    'type' => $validated['type'],
                    'category' => $validated['category'],
                    'event_date' => $validated['event_date'],
                    'time_from_hour' => $validated['time_from_hour'],
                    'time_from_minute' => $validated['time_from_minute'],
                    'time_from_period' => $validated['time_from_period'],
                    'time_to_hour' => $validated['time_to_hour'],
                    'time_to_minute' => $validated['time_to_minute'],
                    'time_to_period' => $validated['time_to_period'],
                    'status' => $status,
                    'seats_available' => $validated['seats_available'],
                ]);
            }

            // Add debugging
            Log::info('Created event with image path: ' . $imagePath);

            // Send notifications to all users
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new NewEventNotification($event));
            }

            DB::commit();
            
            // Customize success message and redirect based on user role
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Event created and automatically approved!');
            } else {
                return redirect()->route('dashboard')->with('success', 'Event created successfully! Waiting for admin approval.');
            }

        } catch (ValidationException $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating event: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()
                ->withErrors(['error' => 'Failed to create event. ' . $e->getMessage()])
                ->withInput();
        }
    }
    
    
    public function show($id)
    {   
        // Retrieve the event using the ID
        $event = Event::findOrFail($id);
        
        // Calculate available seats
        $totalSeats = $event->seats_available;
        $bookedSeats = \App\Models\Subscriber::where('event_id', $event->id)->count();
        $availableSeats = max(0, $totalSeats - $bookedSeats);
        
        // Return the view with the event data
        return view('stud.events.show', compact('event', 'availableSeats', 'bookedSeats'));
    }
    
    public function dashboard()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'organizer') {
            return redirect()->route('organizer.dashboard');
        } else {
            return redirect()->route('stud.dashboard');
        }
    }
}
