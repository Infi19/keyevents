
<body>
<x-header></x-header>


    <div class="event_detail py-8 px-4">
        <h1 class="text-3xl font-semibold">{{ $event->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $event->category }}</p>
        <p class="text-gray-800 mt-2">
            {{ \Carbon\Carbon::parse($event->event_date)->format('D, M j, Y') }} |
            {{ $event->time_from_hour }}:{{ str_pad($event->time_from_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_from_period }} to 
            {{ $event->time_to_hour }}:{{ str_pad($event->time_to_minute, 2, '0', STR_PAD_LEFT) }} {{ $event->time_to_period }}
        </p>
        <div class="event_image mt-4">
            <img class="w-full h-auto object-cover" src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}">
        </div>
        <div class="event_description mt-4">
            <p>{{ $event->about }}</p>
        </div>
    </div>

<x-footer></x-footer>
</body>
