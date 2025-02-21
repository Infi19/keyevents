@vite(['resources/css/app.css'])

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Include Google Fonts for Raleway -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include Google Fonts for Teko -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        .h1class {
            font-family: 'Raleway', sans-serif; /* Apply Raleway font */
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="">
   
    <x-header></x-header>
  
    
    <div style="padding-top:30px " class="mr-4 ml-4 md:mr-40 md:ml-40">   
    
        {{-- DIV FOR UPCOMING EVENT --}}
        <div class="mb-10">
            <div class="flex">
                <h1 class="font-bold font-teko text-4xl text-custom-kcolor">UPCOMING</h1>
                <h1 class="font-bold font-teko text-4xl pl-1">EVENT</h1>
            </div>
            
            @if($upcomingEvent)
            <div class="w-full h-[525px] relative bg-slate-600 overflow-hidden shadow-md rounded-lg">
                <!-- Upcoming Event Image -->
                <a href="{{ route('stud.events.show', $upcomingEvent->id) }}">
                    @if($upcomingEvent->image_path)
                        <img class="w-full h-full object-cover aspect-[956/620]" 
                             src="{{ asset('storage/' . $upcomingEvent->image_path) }}" 
                             alt="{{ $upcomingEvent->title }}"
                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                    @else
                        <img class="w-full h-full object-cover" 
                             src="{{ asset('images/placeholder.jpg') }}" 
                             alt="Placeholder Image">
                    @endif
                </a>
        
                {{-- UPCOMING EVENT DETAILS DIV --}}
                <div class="w-[400px] h-[200px] absolute bottom-5 right-5 bg-black bg-opacity-75 p-6 text-white rounded-md">
                    <a href="{{ route('stud.events.show', $upcomingEvent->id) }}">
                        <h1 class="event_title text-left font-bold font-teko text-2xl m-0 p-0 leading-none">{{ $upcomingEvent->title }}</h1>
                    </a>
                    <p class="event_date text-gray-300 font-calibri font-normal m-0 p-0 leading-none mb-1">{{ $upcomingEvent->category }}</p>
                    <p class="event_date text-gray-300 font-calibri font-normal m-0 p-0 leading-none">
                        {{ \Carbon\Carbon::parse($upcomingEvent->event_date)->format('D, M j, Y') }} | 
                        {{ $upcomingEvent->time_from_hour }}:{{ str_pad($upcomingEvent->time_from_minute, 2, '0', STR_PAD_LEFT) }} {{ $upcomingEvent->time_from_period }} to 
                        {{ $upcomingEvent->time_to_hour }}:{{ str_pad($upcomingEvent->time_to_minute, 2, '0', STR_PAD_LEFT) }} {{ $upcomingEvent->time_to_period }}
                    </p>
                    <div class="event_type mt-16 flex items-center">
                        @if($upcomingEvent->type === 'In-Person')
                            <ion-icon name="person-outline" class="text-white text-xl mr-2"></ion-icon>
                            <p class="text-white font-calibri font-normal m-0 p-0 leading-none">In-Person Event</p>
                        @elseif($upcomingEvent->type === 'Virtual')
                            <ion-icon name="desktop-outline" class="text-white text-xl mr-2"></ion-icon>
                            <p class="text-white font-calibri font-normal m-0 p-0 leading-none">Virtual Event</p>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="w-full h-[525px] relative bg-slate-100 overflow-hidden shadow-md rounded-lg flex items-center justify-center">
                <p class="text-gray-500 text-xl">No upcoming events scheduled</p>
            </div>
            @endif
        </div>
        

        {{-- <div class="border-y border-gray-300 px-4 w-[700px] mx-auto text-center mb-10 static mt-20">
            <h1 class="h1class mt-5 mb-5 ">K  E  Y  E  V  E  N  T  S</h1>
            
        </div> --}}
        
        
        
        {{-- FILTER --}}
        {{-- <div class="     relative bottom-5">
            <div class="flex items-center w-[130px] h-[45px] bg-custom-kcolor absolute right-0 top-0 rounded">
                <div>
                <h1 class="font-bold font-calibri text-xl text-white mr-2 ml-4" >FILTER</h1>
                </div>
                <div>
                <ion-icon name="options" class="size-5 text-white ml-4"></ion-icon>
                </div>
            </div>
        </div> --}}



        <div class="flex  ">
            <a href="{{route('stud.home')}}" class="cursor-pointer">
                <h1 class="font-bold font-teko text-4xl pl-1">EVENTS</h1>
            </a>
        </div>

        <div class="relative bottom-10">
            <div class="flex items-center absolute right-0 -top-1">
                <x-drop-d class="mb-12"></x-drop-d>
            </div>
        </div>
        
        


        @if(request('filter') || request('category'))
        <p class="mb-4 ml-1">
            Filtered by:
            @if(request('filter'))
                <strong>Type: {{ request('filter') }}</strong>
            @endif
            @if(request('category'))
                @if(request('filter'))
                    and
                @endif
                <strong>Category: {{ request('category') }}</strong>
            @endif
        </p>
    @endif
    
    @if($events->isEmpty())
    <x-noResult />
    @else

        <!-- Events Grid -->
        <div class="events_box grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10  py-8">
            @foreach($events as $event)
                <div class="event_template p-0 bg-white flex flex-col items-start h-96 transition-transform transform hover:scale-105 hover:translate-y-1 shadow-md rounded-md">
                    <!-- Event Image -->
                    <a href="{{ route('stud.events.show', $event->id) }}" class="cursor-pointer">
                        <div class="event_image mt-4">
                            @if($event->image_path)
                                <img class="w-full h-auto object-cover" 
                                     src="{{ Storage::url($event->image_path) }}" 
                                     alt="{{ $event->title }}"
                                     onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            @else
                                <img class="w-full h-auto object-cover" 
                                     src="{{ asset('images/placeholder.jpg') }}" 
                                     alt="Placeholder">
                            @endif
                        </div>
                    </a>
        
                    <!-- Event Details -->
                    <div class="event_template_details px-4 mt-4 flex flex-col leading-none">
                        <a href="{{ route('stud.events.show', $event->id) }}" class="cursor-pointer">
                            <h1 class="event_title text-left font-bold font-teko text-2xl m-0 p-0 leading-none cursor-pointer">{{ $event->title }}</h1>
                        </a>
                        <p class="event_date text-gray-800 font-calibri font-normal m-0 p-0 leading-none mb-1">{{ $event->category }}</p>
                        <p class="event_date text-gray-800 font-calibri font-normal m-0 p-0 leading-none">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('D, M j, Y') }} | 
                            {{ $event->time_from_hour }}:{{ str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_from_period }} to 
                            {{ $event->time_to_hour }}:{{ str_pad($event->time_to_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_to_period }}
                        </p>
                    </div>
        
                    <!-- Event Type Section -->
                    <div class="event_type px-4 mt-auto mb-4 flex items-center w-full pt-3">
                        @if($event->type === 'In-Person')
                            <ion-icon name="person-outline" class="text-gray-600 text-xl mr-2"></ion-icon>
                            <p class="text-gray-600 font-calibri font-normal m-0 p-0 leading-none">In-Person Event</p>
                        @elseif($event->type === 'Virtual')
                            <ion-icon name="desktop-outline" class="text-gray-600 text-xl mr-2"></ion-icon>
                            <p class="text-gray-600 font-calibri font-normal m-0 p-0 leading-none">Virtual Event</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
    @endif
    
    <div class="mt-2 mb-10  ">
        {{ $events->appends(request()->query())->links('paginate') }}
    </div>
    
    
        
    </div>   
    <x-footer></x-footer>

 
</body>
</html>
