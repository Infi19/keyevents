<x-student-layout>
    <!-- No extra container with padding needed since the layout already provides it -->
    <!-- Banner Image -->
    <div class="w-full h-48 bg-gray-600 rounded-md flex items-center justify-center mb-6">
        @if($event->image_path)
            <img class="w-full h-full object-cover rounded-md" 
                 src="{{ asset('storage/' . $event->image_path) }}" 
                 alt="{{ $event->title }}"
                 onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
        @else
            <div class="text-white text-center">
                Web Development Workshop Banner Image
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Content Area (2/3 width) -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-md shadow-sm p-6 mb-6">
                <!-- Event Title and Categories -->
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-block px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ $event->type }}</span>
                    <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $event->category }}</span>
                </div>
                
                <!-- About Event Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">About Event</h2>
                    <p class="text-gray-700">{{ $event->about }}</p>
                </div>
                
                <!-- Location Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Location</h2>
                    <div class="bg-gray-100 h-40 rounded-md mb-2 flex items-center justify-center">
                        Google Maps Integration
                    </div>
                    <p class="text-gray-700">Main Seminar Hall, Computer Science Department</p>
                </div>
                
                <!-- Organizer Section -->
                <div>
                    <h2 class="text-lg font-semibold mb-3">Organizer</h2>
                    <div class="flex items-center">
                        <div class="h-12 w-12 bg-gray-200 rounded-full mr-3 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Tech+Club&background=random" alt="Organizer" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <p class="font-medium">Tech Club</p>
                            <p class="text-sm text-gray-600">Computer Science Department</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar (1/3 width) -->
        <div>
            <div class="bg-white rounded-md shadow-sm p-6 mb-6">
                <!-- Date and Time -->
                <div class="mb-4">
                    <div class="flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>
                            {{ $event->time_from_hour }}:{{ str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_from_period }} - 
                            {{ $event->time_to_hour }}:{{ str_pad($event->time_to_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_to_period }}
                        </span>
                    </div>
                </div>
                
                <!-- Seats Remaining -->
                <div class="flex items-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>{{ $availableSeats }} seats remaining</span>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-3">
                    @auth
                        @if(auth()->user()->isStudent())
                            @php
                                $isRegistered = App\Models\Subscriber::where('user_id', auth()->id())
                                    ->where('event_id', $event->id)
                                    ->exists();
                                
                                $isFull = $availableSeats <= 0;
                                $isPastEvent = \Carbon\Carbon::parse($event->event_date)->isPast();
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
                                            <div class="mt-4">
                                                <form method="POST" action="{{ route('event.cancel', $event->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none" onclick="return confirm('Are you sure you want to cancel your registration?')">
                                                        Cancel Registration
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($isPastEvent)
                                <button class="w-full bg-gray-800 opacity-50 cursor-not-allowed text-white font-medium py-3 px-4 rounded-md">
                                    Event has ended
                                </button>
                            @elseif($isFull)
                                <button class="w-full bg-gray-800 opacity-50 cursor-not-allowed text-white font-medium py-3 px-4 rounded-md">
                                    No Seats Available
                                </button>
                            @elseif($event->status != 'approved')
                                <button class="w-full bg-gray-800 opacity-50 cursor-not-allowed text-white font-medium py-3 px-4 rounded-md">
                                    Registration Unavailable
                                </button>
                            @else
                                <form method="POST" action="{{ route('event.register', $event->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md transition-colors">
                                        Register Now
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="text-center text-sm text-gray-600">
                                Registration available to students only
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md text-center">
                            Login to Register
                        </a>
                    @endauth

                    <div class="flex items-center justify-between space-x-3">
                        <button class="flex-1 flex items-center justify-center py-2 px-3 border border-gray-300 rounded-md hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Share
                        </button>
                        @if($event->brochure_path)
                            <a href="{{ asset('storage/' . $event->brochure_path) }}" target="_blank" class="flex-1 flex items-center justify-center py-2 px-3 border border-gray-300 rounded-md hover:bg-gray-50 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                View Brochure
                            </a>
                        @else
                            <button disabled class="flex-1 flex items-center justify-center py-2 px-3 border border-gray-300 rounded-md opacity-50 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                No Brochure
                            </button>
                        @endif
                    </div>
                    
                    <!-- Media Gallery Link -->
                    <a href="{{ route('stud.event.media', $event->id) }}" class="mt-3 flex items-center justify-center py-2 px-3 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md hover:bg-indigo-100 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        View Media Gallery
                    </a>
                </div>

                <div class="mt-6 text-center text-sm text-gray-500">
                    Registration closes in 5 days
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
