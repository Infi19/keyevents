<x-app-layout>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    
    <!-- Hero Section -->
    <div class="bg-gray-900 text-white py-16 rounded-lg mb-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold mb-4">Discover Amazing College Events</h1>
                <p class="text-xl text-gray-300 mb-8">Join workshops, seminars, and cultural events. Connect with your college community.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="#events" class="bg-white text-gray-900 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium">Browse Events</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search Section -->
    <div class="max-w-7xl mx-auto py-8" id="events">
        <form action="{{ route('stud.home') }}" method="GET" class="mb-8">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <div class="w-full md:w-auto flex-grow">
                    <input 
                        type="text" 
                        name="search"
                        placeholder="Search events..." 
                        value="{{ request('search') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                <div class="flex flex-wrap gap-3">
                    <select name="filter" class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                        <option value="">Event Type</option>
                        <option value="In-Person" {{ request('filter') == 'In-Person' ? 'selected' : '' }}>In-Person</option>
                        <option value="Virtual" {{ request('filter') == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                    </select>
                    
                    <input type="date" name="event_date" value="{{ request('event_date') }}" class="border border-gray-300 rounded-lg px-4 py-2">
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Search
                    </button>
                </div>
            </div>
        </form>
        
        <!-- Search Results Counter -->
        @if(request('search') || request('filter') || request('event_date'))
        <div class="flex justify-between items-center mb-4 text-gray-600">
            <div>
                Found {{ $events->total() }} {{ Str::plural('event', $events->total()) }}
                @if(request('search')) containing "<span class="font-medium">{{ request('search') }}</span>"@endif
                @if(request('filter')) of type "<span class="font-medium">{{ request('filter') }}</span>"@endif
                @if(request('event_date')) on <span class="font-medium">{{ \Carbon\Carbon::parse(request('event_date'))->format('M d, Y') }}</span>@endif
            </div>
            <a href="{{ route('stud.home') }}" class="text-blue-600 hover:underline">Clear filters</a>
        </div>
        @endif
        
        <!-- Featured Events Section (optional) -->
        @if($featuredEvents->count() > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Featured Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredEvents as $featured)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow hover:shadow-md">
                    <div class="h-40 bg-gray-200 relative">
                        @if($featured->image_path)
                            <img 
                                class="w-full h-full object-cover" 
                                src="{{ asset('storage/' . $featured->image_path) }}" 
                                alt="{{ $featured->title }}"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                        @else
                            <img 
                                class="w-full h-full object-cover" 
                                src="{{ asset('images/placeholder.jpg') }}" 
                                alt="Placeholder">
                        @endif
                        <div class="absolute top-0 left-0 bg-blue-600 text-white text-xs font-bold px-3 py-1">
                            Featured
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-1">{{ $featured->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($featured->event_date)->format('M d, Y') }}</p>
                        <a href="{{ route('stud.events.show', $featured->id) }}" class="text-blue-600 text-sm font-medium hover:underline">Learn more →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Event Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <div class="flex gap-8">
                <a href="{{ route('stud.home', array_merge(request()->except('status', 'page'), ['status' => 'upcoming'])) }}" 
                   class="pb-4 {{ $status === 'upcoming' ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Upcoming
                </a>
                <a href="{{ route('stud.home', array_merge(request()->except('status', 'page'), ['status' => 'ongoing'])) }}" 
                   class="pb-4 {{ $status === 'ongoing' ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Ongoing
                </a>
                <a href="{{ route('stud.home', array_merge(request()->except('status', 'page'), ['status' => 'past'])) }}" 
                   class="pb-4 {{ $status === 'past' ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Past
                </a>
            </div>
        </div>
        
        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($events as $index => $event)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <!-- Event Image -->
                    <div class="h-48 bg-gray-600 relative">
                        @if($event->image_path)
                            <img 
                                class="w-full h-full object-cover" 
                                src="{{ asset('storage/' . $event->image_path) }}" 
                                alt="{{ $event->title }}"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                        @else
                            <img 
                                class="w-full h-full object-cover" 
                                src="{{ asset('images/placeholder.jpg') }}" 
                                alt="Placeholder">
                        @endif
                        
                        <!-- Event Category Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $index === 0 ? 'bg-yellow-100 text-yellow-800' : ($index === 1 ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ $event->category }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Event Content -->
                    <div class="p-5">
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ route('stud.events.show', $event->id) }}" class="text-gray-900 hover:text-blue-600">
                                {{ $event->title }}
                            </a>
                        </h3>
                        
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($event->about, 100) }}
                        </p>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                            <span class="mx-2">|</span>
                            {{ $event->time_from_hour }}:{{ str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_from_period }}
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <!-- Event Type -->
                            <div class="flex items-center text-sm">
                                @if($event->type === 'In-Person')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600">In-Person</span>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4v-4H5a2 2 0 01-2-2V5zm2-2a4 4 0 00-4 4v8a4 4 0 004 4h1v2l6-6h5a4 4 0 004-4V7a4 4 0 00-4-4H5z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600">Virtual</span>
                                @endif
                            </div>
                            
                            <!-- Seats Left -->
                            <span class="text-sm text-gray-500">
                                @php
                                    $bookedSeats = $seatCounts[$event->id] ?? 0;
                                    $availableSeats = max(0, $event->seats_available - $bookedSeats);
                                    $isPastEvent = \Carbon\Carbon::parse($event->event_date)->isPast();
                                @endphp
                                
                                @if($availableSeats > 0)
                                    {{ $availableSeats }} seats available
                                @else
                                    <span class="text-red-600">Fully booked</span>
                                @endif
                            </span>
                        </div>
                        
                        @if($isPastEvent)
                            <button class="block w-full mt-4 text-center bg-gray-800 opacity-50 cursor-not-allowed text-white font-medium py-2 px-4 rounded-md">Event has ended</button>
                        @else
                            <a href="{{ route('stud.events.show', $event->id) }}" class="block mt-4 text-center bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">Register</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No events found</h3>
                    <p class="text-gray-500">Try adjusting your search filters or check back later.</p>
                    <a href="{{ route('stud.home') }}" class="inline-block mt-4 text-blue-600 hover:underline">View all events</a>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($events->count() > 0)
        <div class="flex justify-center mb-16">
            {{ $events->appends(request()->query())->links('paginate') }}
        </div>
        @endif
    </div>
    
    <x-footer></x-footer>
    
    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</x-app-layout>
