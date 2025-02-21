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
            ]);

            $imagePath = null;
            if ($request->hasFile('file_upload')) {
                $imagePath = $request->file('file_upload')->store('event-images', 'public');
                
                // For debugging
                Log::info('Image uploaded to: ' . $imagePath);
            }

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
            ]);

            // Add debugging
            Log::info('Created event with image path: ' . $imagePath);

            // Send notifications to all users
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new NewEventNotification($event));
            }

            DB::commit();
            
            return redirect()->route('dashboard')->with('success', 'Event created successfully!');

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
    
    // Return the view with the event data
    return view('stud.events.show', compact('event'));
    }
    
        // In your EventController

    public function dashboard()
    {
        $events = Event::paginate(10);  // Get all events
        return view('dashboard', compact('events'));  // Pass the events to the dashboard view
    }


}
