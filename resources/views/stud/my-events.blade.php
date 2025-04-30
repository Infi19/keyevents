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
                        <a href="{{ route('my.events') }}" class="flex items-center px-4 py-3 bg-blue-50 border-l-4 border-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-blue-600 font-medium">My Events</span>
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
                <h1 class="text-2xl font-bold text-gray-900 mb-8">My Events</h1>
                
                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="flex -mb-px space-x-8">
                        <a href="#" class="border-b-2 border-blue-500 text-blue-600 py-4 px-1 text-sm font-medium">Upcoming</a>
                        <a href="#" class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">Past Events</a>
                    </nav>
                </div>
                
                <!-- Events List -->
                <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
                    @if(count($registrations) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($registrations as $registration)
                                        @if($registration->event)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                                                            @if($registration->event->image_path)
                                                                <img src="{{ asset('storage/' . $registration->event->image_path) }}" alt="{{ $registration->event->title }}" class="h-10 w-10 rounded-md object-cover">
                                                            @else
                                                                {{ substr($registration->event->title, 0, 2) }}
                                                            @endif
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $registration->event->title }}</div>
                                                            <div class="text-xs text-gray-500">{{ $registration->event->category }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $registration->event->event_date ? $registration->event->event_date->format('M d, Y') : 'Date TBD' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $registration->event->time_from_hour }}:{{ str_pad($registration->event->time_from_minute, 2, '0', STR_PAD_LEFT) }} 
                                                        {{ $registration->event->time_from_period }} - 
                                                        {{ $registration->event->time_to_hour }}:{{ str_pad($registration->event->time_to_minute, 2, '0', STR_PAD_LEFT) }} 
                                                        {{ $registration->event->time_to_period }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $registration->event->type }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($registration->event->event_date && $registration->event->event_date->gt(now()))
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Upcoming
                                                        </span>
                                                    @elseif($registration->attendance)
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Attended
                                                        </span>
                                                    @else
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Registered
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex justify-end space-x-3">
                                                        <a href="#" class="text-blue-600 hover:text-blue-900">View Details</a>
                                                        @if($registration->event->event_date && $registration->event->event_date->gt(now()))
                                                            <a href="#" class="text-blue-600 hover:text-blue-900">QR Code</a>
                                                        @endif
                                                        @if($registration->attendance)
                                                            <a href="#" class="text-blue-600 hover:text-blue-900">Certificate</a>
                                                            <a href="#" class="text-purple-600 hover:text-purple-900">Feedback</a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No events found</h3>
                            <p class="text-gray-500 mb-6">You haven't registered for any events yet.</p>
                            <a href="{{ route('stud.home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Browse Events
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 