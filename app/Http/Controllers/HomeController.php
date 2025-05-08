<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
// use App\Models\Event;
// use Carbon\Carbon;

// class HomeController extends Controller
// {
//     public function index()
//     {
//         // Get the current date
//         $currentDate = Carbon::now()->toDateString();

//         // Fetch events starting from the current day, sorted by event_date in ascending order
//         $events = Event::where('event_date', '>=', $currentDate)
//                        ->orderBy('event_date', 'asc')
//                        ->get();

//         // Pass the events to the view
//         return view('stud.home', compact('events'));
//     }
// }






use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get the current date.
        $currentDate = Carbon::now()->toDateString();
        $now = Carbon::now();
        Log::info("Current date: " . $currentDate);

        // Retrieve filter parameters from the query string.
        $filter = $request->query('filter');    // e.g., 'In-Person' or 'Virtual'
        $search = $request->query('search');    // Search term
        $eventDate = $request->query('event_date'); // Filter by specific date
        $status = $request->query('status', 'upcoming'); // Event status: upcoming, ongoing, past

        // SIMPLIFIED: Directly fetch all approved events regardless of date
        $eventsQuery = Event::where('status', 'approved');
        
        // Apply event status filter
        if ($status === 'upcoming') {
            $eventsQuery->where('event_date', '>', $now)->orderBy('event_date', 'asc');
        } elseif ($status === 'ongoing') {
            $eventsQuery->whereDate('event_date', $now)->orderBy('time_from_hour', 'asc')->orderBy('time_from_minute', 'asc');
        } elseif ($status === 'past') {
            $eventsQuery->where('event_date', '<', $now)->orderBy('event_date', 'desc');
        }
        
        // Apply filters if they exist
        if ($filter) {
            $eventsQuery->where('type', $filter);
        }
        
        // Apply search if it exists
        if ($search) {
            $eventsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('about', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%')
                      ->orWhere('venue', 'like', '%' . $search . '%');
            });
        }
        
        // Apply date filter if it exists
        if ($eventDate) {
            $eventsQuery->whereDate('event_date', $eventDate);
        }

        // Log the total count of events
        $allEvents = Event::all();
        Log::info("Total events in database: " . $allEvents->count());
        foreach ($allEvents as $event) {
            Log::info("Event ID: {$event->id}, Title: {$event->title}, Status: {$event->status}, Date: {$event->event_date} ");
        }

        // Get the approved events for display
        $approvedEvents = Event::where('status', 'approved')->get();
        Log::info("Approved events count: " . $approvedEvents->count());
        foreach ($approvedEvents as $event) {
            Log::info("Approved Event ID: {$event->id}, Title: {$event->title}, Date: {$event->event_date}");
        }

        // Execute the query to get paginated results.
        $events = $eventsQuery->paginate(6);
        Log::info("Events count being displayed: " . $events->count());

        // Get seat counts for each event
        $seatCounts = $this->getEventSeatCounts($events->pluck('id')->toArray());

        // Featured events for the homepage - just use the most recent 3 upcoming events
        $featuredEventsQuery = Event::where('event_date', '>=', $currentDate)
                              ->where('status', 'approved')
                              ->orderBy('event_date')
                              ->limit(3);
                              
        // Apply search to featured events if search is provided
        if ($search) {
            $featuredEventsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('about', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%')
                      ->orWhere('venue', 'like', '%' . $search . '%');
            });
        }
        
        $featuredEvents = $featuredEventsQuery->get();

        return view('stud.home', [
            'events' => $events,
            'featuredEvents' => $featuredEvents,
            'seatCounts' => $seatCounts,
            'filter' => $filter,
            'search' => $search,
            'event_date' => $eventDate,
            'status' => $status,
        ]);
    }

    private function getEventSeatCounts(array $eventIds)
    {
        $counts = [];

        try {
            // Get registration counts for each event
            $registrations = DB::table('subscribers')
                ->whereIn('event_id', $eventIds)
                ->select('event_id', DB::raw('count(*) as total'))
                ->groupBy('event_id')
                ->get();

            // Format results into an associative array
            foreach ($registrations as $registration) {
                $counts[$registration->event_id] = $registration->total;
            }
        } catch (\Exception $e) {
            Log::error("Error getting seat counts: " . $e->getMessage());
        }

        return $counts;
    }
}
