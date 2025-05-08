<x-student-layout>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-900">{{ $media->title ?? $media->filename }}</h1>
            <a href="{{ route('stud.event.media', $event->id) }}" class="text-gray-600 hover:text-gray-900">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Gallery
                </span>
            </a>
        </div>
        <p class="text-gray-600 mt-2">Event: <a href="{{ route('stud.events.show', $event->id) }}" class="text-blue-600 hover:underline">{{ $event->title }}</a></p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <!-- Media Display -->
        <div class="mb-6">
            @if($media->file_type == 'image')
                <div class="max-w-3xl mx-auto">
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->title ?? $media->filename }}" class="w-full h-auto rounded-lg">
                </div>
            @else
                <div class="max-w-3xl mx-auto">
                    <video controls class="w-full h-auto rounded-lg">
                        <source src="{{ asset('storage/' . $media->file_path) }}" type="{{ $media->mime_type }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
        </div>

        <!-- Media Details -->
        <div class="max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold mb-2">{{ $media->title ?? $media->filename }}</h2>
            
            @if($media->description)
                <div class="mb-4">
                    <p class="text-gray-700">{{ $media->description }}</p>
                </div>
            @endif
            
            <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ \Carbon\Carbon::parse($media->created_at)->format('F d, Y') }}
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ $media->file_type == 'image' ? 'Image' : 'Video' }}
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                    </svg>
                    {{ round($media->size_in_bytes / 1024 / 1024, 2) }} MB
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation between media -->
    <div class="flex justify-between items-center">
        @php
            $previousMedia = $event->media()->where('id', '<', $media->id)->orderBy('id', 'desc')->first();
            $nextMedia = $event->media()->where('id', '>', $media->id)->orderBy('id')->first();
        @endphp

        @if($previousMedia)
            <a href="{{ route('stud.event.media.view', ['event' => $event->id, 'media' => $previousMedia->id]) }}" class="bg-white hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-md flex items-center shadow-sm border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Previous
            </a>
        @else
            <div></div>
        @endif

        @if($nextMedia)
            <a href="{{ route('stud.event.media.view', ['event' => $event->id, 'media' => $nextMedia->id]) }}" class="bg-white hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-md flex items-center shadow-sm border border-gray-200">
                Next
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        @else
            <div></div>
        @endif
    </div>
</x-student-layout> 