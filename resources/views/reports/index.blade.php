@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.organizer')

@section('title', 'Event Reports')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Event Reports</h1>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Generate Event Report</h2>
        <p class="mb-4 text-gray-600">
            Select an event to generate a detailed report using Gemini AI. The report will be formatted according to 
            the standard event report template and can be customized before generating the final PDF.
        </p>
        
        @if($events->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            No events found. Please create an event first.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($events as $event)
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-40 bg-gray-200 flex items-center justify-center">
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-gray-400 flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="mt-2">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium text-lg mb-1 truncate">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($event->about, 100) }}
                            </p>
                            <a href="{{ route('reports.create', $event->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors text-center">
                                Generate Report
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection 