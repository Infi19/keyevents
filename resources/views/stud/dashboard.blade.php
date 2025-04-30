@vite(['resources/css/app.css'])

<x-app-layout>
    <div class="flex">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-white shadow-md h-screen fixed left-0 top-0 pt-16">
            <div class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('stud.home') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-gray-800">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my.events') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-800">My Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('certificates') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-800">Certificates</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notifications') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="text-gray-800">Notifications</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-gray-800">Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 flex-1 p-8">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">My Dashboard</h1>
                <p class="text-sm text-gray-600 mb-8">Track your registered events and activities</p>
                
                <!-- Stats Cards Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Registered Events Card -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-medium text-gray-700">Registered Events</h3>
                                <p class="text-3xl font-bold mt-2">{{ $registeredEventsCount }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ $upcomingCount }} upcoming</p>
                            </div>
                            <div class="p-2 bg-gray-100 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Certificates Card -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-medium text-gray-700">Certificates</h3>
                                <p class="text-3xl font-bold mt-2">{{ $certificatesCount }}</p>
                                <p class="text-xs text-gray-600 mt-1">Available to download</p>
                            </div>
                            <div class="p-2 bg-gray-100 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Clubs Following Card -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-medium text-gray-700">Clubs Following</h3>
                                <p class="text-3xl font-bold mt-2">{{ $clubsFollowing }}</p>
                                <p class="text-xs text-gray-600 mt-1">Active subscriptions</p>
                            </div>
                            <div class="p-2 bg-gray-100 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Upcoming Events Section -->
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Upcoming Events</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
                    @if(count($upcomingEvents) > 0)
                        @foreach($upcomingEvents as $event)
                        <div class="border-b last:border-0 border-gray-200">
                            <div class="flex items-center p-5">
                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-sm font-medium text-gray-500 mr-4">
                                    @if($event->image_path)
                                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-12 h-12 rounded object-cover">
                                    @else
                                        {{ substr($event->title, 0, 2) }}
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $event->event_date ? $event->event_date->format('M d, Y') . ' • ' . $event->time_from_hour . ':' . 
                                        str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) . ' ' . $event->time_from_period : 'Date TBD' }}
                                    </p>
                                    <div class="mt-1 flex items-center">
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $event->type }}</span>
                                        <span class="ml-2 text-xs text-gray-500">By {{ $event->category }}</span>
                                    </div>
                                </div>
                                <div>
                                    <button class="p-1 text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-5 text-center text-gray-500">
                            No upcoming events found. Register for events to see them here.
                        </div>
                    @endif
                </div>
                
                <!-- Two-column layout for Certificates and Notifications -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Recent Certificates -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Certificates</h2>
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            @if(count($certificates) > 0)
                                @foreach($certificates->take(3) as $certificate)
                                <div class="p-5 border-b last:border-0 border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-800">{{ $certificate->event->title ?? 'Unknown Event' }}</h3>
                                            <p class="text-xs text-gray-500 mt-1">Completed on {{ $certificate->updated_at ? $certificate->updated_at->format('M d, Y') : 'N/A' }}</p>
                                        </div>
                                        <a href="#" class="text-blue-600 hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="p-5 text-center text-gray-500">
                                    No certificates yet. Complete events to earn certificates.
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Notifications -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Notifications</h2>
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            @if(count($notifications) > 0)
                                @foreach($notifications as $notification)
                                <div class="p-5 border-b last:border-0 border-gray-200">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-800">{{ $notification['title'] }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $notification['time'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="p-5 text-center text-gray-500">
                                    No notifications at this time.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 