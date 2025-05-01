@vite(['resources/css/app.css'])

<x-student-layout>
    <!-- Dashboard Header -->
    <div class="max-w-6xl">
        <h1 class="text-xl font-bold text-gray-900">My Dashboard</h1>
        <p class="text-sm text-gray-600 mt-1 mb-6">Track your registered events and activities</p>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Registered Events -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-lg">Registered Events</h3>
                        <div class="mt-2 text-2xl font-bold">{{ $registeredEventsCount ?? 0 }}</div>
                        <div class="text-xs text-gray-600 mt-1">{{ $upcomingCount ?? 0 }} upcoming</div>
                    </div>
                    <div class="text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Certificates -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-lg">Certificates</h3>
                        <div class="mt-2 text-2xl font-bold">{{ $certificatesCount ?? 0 }}</div>
                        <div class="text-xs text-gray-600 mt-1">Available to download</div>
                    </div>
                    <div class="text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Clubs Following -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-lg">Clubs Following</h3>
                        <div class="mt-2 text-2xl font-bold">{{ $clubsFollowing ?? 0 }}</div>
                        <div class="text-xs text-gray-600 mt-1">Active subscriptions</div>
                    </div>
                    <div class="text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Upcoming Events</h2>
        
        @if(isset($upcomingEvents) && count($upcomingEvents) > 0)
            @foreach($upcomingEvents as $event)
                <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4 w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-500">
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-12 h-12 rounded object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $event->event_date ? $event->event_date->format('M d, Y') : 'Date TBD' }} • 
                                        {{ $event->time_from_hour }}:{{ str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) }} 
                                        {{ $event->time_from_period }}
                                    </p>
                                    <div class="mt-1 flex items-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">{{ $event->type }}</span>
                                        <span class="ml-2 text-xs text-gray-500">By {{ $event->category }}</span>
                                    </div>
                                </div>
                                <button class="h-6 w-6 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white p-8 rounded-lg shadow-sm text-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No upcoming events</h3>
                <p class="text-gray-600 mb-6">You haven't registered for any upcoming events.</p>
                <a href="{{ route('stud.home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700">
                    Browse Events
                </a>
            </div>
        @endif
        
        <!-- Two Columns: Recent Certificates and Notifications -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Recent Certificates -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Certificates</h2>
                @if(isset($certificates) && $certificates->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm">
                        @foreach($certificates as $certificate)
                            @if($certificate->event)
                                <div class="p-4 border-b border-gray-100">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="font-medium text-gray-900">{{ $certificate->event->title }}</h3>
                                            <p class="text-xs text-gray-500 mt-1">Completed on {{ $certificate->updated_at ? $certificate->updated_at->format('M d, Y') : 'N/A' }}</p>
                                        </div>
                                        <button class="text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <p class="text-gray-600">No certificates available yet</p>
                    </div>
                @endif
            </div>
            
            <!-- Notifications -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Notifications</h2>
                @if(isset($notifications) && count($notifications) > 0)
                    <div class="bg-white rounded-lg shadow-sm">
                        @foreach($notifications as $notification)
                            <div class="p-4 border-b border-gray-100">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-500 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $notification['title'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $notification['time'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <p class="text-gray-600">No notifications available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-student-layout> 