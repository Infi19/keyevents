<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    protected $geminiService;
    
    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }
    
    /**
     * Display the report generation form
     */
    public function index()
    {
        $events = Event::where('status', 'approved')
                        ->where('user_id', auth()->id())
                        ->orderBy('event_date', 'desc')
                        ->get();
        
        return view('reports.index', compact('events'));
    }
    
    /**
     * Display report generation form for a specific event
     */
    public function create($eventId)
    {
        $event = Event::where('user_id', auth()->id())
                     ->with('media')
                     ->findOrFail($eventId);
        
        return view('reports.create', compact('event'));
    }
    
    /**
     * Preview the generated report
     */
    public function preview(Request $request, $eventId)
    {
        $event = Event::where('user_id', auth()->id())
                     ->with('media')
                     ->findOrFail($eventId);
        
        $validatedData = $request->validate([
            'report_title' => 'nullable|string|max:255',
            'report_description' => 'nullable|string|max:2000',
            'include_photos' => 'nullable|boolean',
            'selected_photos' => 'nullable|array',
            'selected_photos.*' => 'exists:event_media,id',
            'coordinator_name' => 'nullable|string|max:255',
            'head_of_department' => 'nullable|string|max:255',
            'principal_name' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'attendees_count' => 'nullable|integer|min:0',
            'resource_person' => 'nullable|string|max:255',
            'resource_person_details' => 'nullable|string|max:1000',
        ]);
        
        // Generate report content using Gemini AI
        $reportContent = $this->geminiService->generateEventReport($event, $validatedData);
        
        return view('reports.preview', compact('event', 'reportContent', 'validatedData'));
    }
    
    /**
     * Generate and download PDF report
     */
    public function generate(Request $request, $eventId)
    {
        $event = Event::where('user_id', auth()->id())
                     ->with('media')
                     ->findOrFail($eventId);
        
        $validatedData = $request->validate([
            'report_content' => 'required|string',
            'report_title' => 'nullable|string|max:255',
            'include_photos' => 'nullable|boolean',
            'selected_photos' => 'nullable|array',
            'selected_photos.*' => 'exists:event_media,id',
            'coordinator_name' => 'nullable|string|max:255',
            'head_of_department' => 'nullable|string|max:255',
            'principal_name' => 'nullable|string|max:255',
        ]);
        
        $reportTitle = $validatedData['report_title'] ?? $event->title;
        $reportContent = $validatedData['report_content'];
        
        // Get selected photos if any
        $photos = [];
        if (isset($validatedData['include_photos']) && $validatedData['include_photos'] && 
            isset($validatedData['selected_photos']) && count($validatedData['selected_photos']) > 0) {
            $photos = EventMedia::whereIn('id', $validatedData['selected_photos'])->get();
        }
        
        // Generate PDF
        $pdf = PDF::loadView('reports.pdf', [
            'event' => $event,
            'title' => $reportTitle,
            'content' => $reportContent,
            'photos' => $photos,
            'coordinator' => $validatedData['coordinator_name'] ?? null,
            'hod' => $validatedData['head_of_department'] ?? null, 
            'principal' => $validatedData['principal_name'] ?? null,
        ]);
        
        return $pdf->download($event->title . '-report.pdf');
    }
} 