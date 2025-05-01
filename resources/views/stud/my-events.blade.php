@vite(['resources/css/app.css'])

<x-student-layout>
    <div class="max-w-6xl">
        <h1 class="text-xl font-bold text-gray-900">My Events</h1>
        <p class="text-sm text-gray-600 mt-1 mb-6">View and manage your registered events</p>
        
        <!-- Tabs -->
        <div class="flex space-x-8 mb-6 border-b border-gray-200">
            <button class="text-blue-600 border-b-2 border-blue-600 pb-4 text-sm font-medium">Upcoming</button>
            <button class="text-gray-500 pb-4 text-sm font-medium">Past Events</button>
        </div>
        
        <!-- Events List -->
        @if(count($registrations) > 0)
            @foreach($registrations as $registration)
                @if($registration->event)
                    <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0 mr-4 w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-500">
                                @if($registration->event->image_path)
                                    <img src="{{ asset('storage/' . $registration->event->image_path) }}" alt="{{ $registration->event->title }}" class="w-12 h-12 rounded object-cover">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $registration->event->title }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $registration->event->event_date ? $registration->event->event_date->format('M d, Y') : 'Date TBD' }} • 
                                            {{ $registration->event->time_from_hour }}:{{ str_pad($registration->event->time_from_minute, 2, '0', STR_PAD_LEFT) }} 
                                            {{ $registration->event->time_from_period }}
                                        </p>
                                        <div class="mt-1 flex items-center">
                                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">{{ $registration->event->type }}</span>
                                            <span class="ml-2 text-xs text-gray-500">By {{ $registration->event->category }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($registration->event->event_date && $registration->event->event_date->gt(now()))
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Upcoming</span>
                                        @elseif($registration->attendance)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Attended</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Registered</span>
                                        @endif
                                        <button class="h-6 w-6 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No events found</h3>
                <p class="text-gray-600 mb-6">You haven't registered for any events yet.</p>
                <a href="{{ route('stud.home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700">
                    Browse Events
                </a>
            </div>
        @endif
    </div>
</x-student-layout> 