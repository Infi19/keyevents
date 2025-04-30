@vite(['resources/css/app.css'])

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - EventHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-header></x-header>

    <div class="max-w-5xl mx-auto px-6 py-12">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Event Image -->
            <div class="h-72 bg-gray-200">
                @if($event->image_path)
                    <img class="w-full h-full object-cover" 
                         src="{{ asset('storage/' . $event->image_path) }}" 
                         alt="{{ $event->title }}"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                @else
                    <img class="w-full h-full object-cover" 
                         src="{{ asset('images/placeholder.jpg') }}" 
                         alt="Placeholder">
                @endif
            </div>
            
            <div class="p-8">
                <!-- Event Type Badge -->
                <div class="mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $event->type === 'In-Person' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        @if($event->type === 'In-Person')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            In-Person Event
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4v-4H5a2 2 0 01-2-2V5zm2-2a4 4 0 00-4 4v8a4 4 0 004 4h1v2l6-6h5a4 4 0 004-4V7a4 4 0 00-4-4H5z" clip-rule="evenodd" />
                            </svg>
                            Virtual Event
                        @endif
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 ml-2">
                        {{ $event->category }}
                    </span>
                </div>
                
                <!-- Event Title and Date -->
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                
                <div class="flex items-center text-gray-600 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('D, M j, Y') }} | 
                    {{ $event->time_from_hour }}:{{ str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_from_period }} to 
                    {{ $event->time_to_hour }}:{{ str_pad($event->time_to_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_to_period }}
                </div>
                
                <!-- Divider -->
                <div class="border-t border-gray-200 my-6"></div>
                
                <!-- About Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">About this event</h2>
                    <div class="text-gray-700 space-y-4">
                        <p>{{ $event->about }}</p>
                    </div>
                </div>
                
                <!-- Registration Section -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('info') }}</span>
                        </div>
                    @endif
                
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ready to attend?</h3>
                        <span class="text-gray-600">{{ $event->seats_available ?? 'Limited' }} seats available</span>
                    </div>
                    
                    @auth
                        @if(auth()->user()->isStudent())
                            @php
                                $isRegistered = App\Models\Subscriber::where('user_id', auth()->id())
                                    ->where('event_id', $event->id)
                                    ->exists();
                                
                                $registrationsCount = App\Models\Subscriber::where('event_id', $event->id)->count();
                                $isFull = $registrationsCount >= $event->seats_available;
                            @endphp
                            
                            @if($isRegistered)
                                <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-green-800">You're registered!</h3>
                                            <div class="mt-2 text-sm text-green-700">
                                                <p>You have successfully registered for this event. We look forward to seeing you there!</p>
                                            </div>
                                            <div class="mt-4">
                                                <form method="POST" action="{{ route('event.cancel', $event->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to cancel your registration?')">
                                                        Cancel Registration
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($isFull)
                                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">Event is full</h3>
                                            <div class="mt-2 text-sm text-yellow-700">
                                                <p>Sorry, all seats for this event have been reserved. Please check back later as spots may become available if other attendees cancel.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($event->status != 'approved')
                                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">Registration Not Available</h3>
                                            <div class="mt-2 text-sm text-yellow-700">
                                                <p>This event is not yet available for registration. Please check back later.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form method="POST" action="{{ route('event.register', $event->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-md transition-colors">
                                        Register for this event
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-blue-800">Admin/Organizer View</h3>
                                        <div class="mt-2 text-sm text-blue-700">
                                            <p>You are viewing this event as an admin or organizer. Registration is available for students only.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="mb-4 text-center">
                            <a href="{{ route('login') }}" class="w-full block bg-gray-800 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-md transition-colors">
                                Log in to register
                            </a>
                        </div>
                    @endauth
                    
                    <p class="text-sm text-gray-500 mt-4 text-center">
                        Registration is free and only takes a minute
                    </p>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>
