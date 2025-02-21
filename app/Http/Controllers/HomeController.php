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

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get the current date.
        $currentDate = Carbon::now()->toDateString();

        // Retrieve filter parameters from the query string.
        $filter   = $request->query('filter');    // e.g., 'In-Person' or 'Virtual'
        $category = $request->query('category');    // e.g., 'Seminars and Talks', 'Workshop', etc.

        // Fetch the upcoming event (ignoring any filters)
        $upcomingEvent = Event::where('event_date', '>=', $currentDate)
                              ->orderBy('event_date', 'asc')
                              ->first();

        // Build a query for upcoming events to be filtered.
        $eventsQuery = Event::where('event_date', '>=', $currentDate);
        if ($filter) {
            $eventsQuery->where('type', $filter);
        }
        if ($category) {
            $eventsQuery->where('category', $category);
        }
        if ($upcomingEvent) {
            $eventsQuery->where('id', '!=', $upcomingEvent->id);
        }
        $events = $eventsQuery->orderBy('event_date', 'asc')->paginate(6);

        // Fallback: if no upcoming events match the filters (and there's no upcoming event),
        // you might show past events. Adjust this fallback logic if needed.
        if ($upcomingEvent === null && $events->isEmpty()) {
            $events = Event::where('event_date', '<=', $currentDate)
                           ->orderBy('event_date', 'desc')
                           ->paginate(6);
        }

        return view('stud.home', compact('upcomingEvent', 'events', 'filter', 'category'));
    }
}
