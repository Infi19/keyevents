<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Media Gallery: {{ $event->title }}
            </h2>
            <a href="{{ route('organizer.event.media.create', $event) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i> Add Media
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Media Gallery Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-bold text-blue-800">Total Media</h3>
                            <p class="text-2xl font-bold">{{ count($mediaItems) }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-bold text-green-800">Images</h3>
                            <p class="text-2xl font-bold">{{ $imageCounts }}</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-bold text-purple-800">Videos</h3>
                            <p class="text-2xl font-bold">{{ $videoCounts }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-bold text-yellow-800">Event Status</h3>
                            <p class="text-xl font-bold capitalize">{{ $event->status }}</p>
                        </div>
                    </div>

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

                    <!-- Media Gallery -->
                    @if(count($mediaItems) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($mediaItems as $media)
                                <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                                    <div class="relative media-container" style="height: 200px;">
                                        @if($media->file_type == 'image')
                                            <img src="{{ asset('storage/' . $media->file_path) }}" 
                                                alt="{{ $media->title ?? $media->filename }}" 
                                                class="w-full h-full object-cover">
                                        @elseif($media->file_type == 'video')
                                            <video class="w-full h-full object-cover" controls>
                                                <source src="{{ asset('storage/' . $media->file_path) }}" type="{{ $media->mime_type }}">
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white opacity-70" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute top-2 right-2 bg-gray-800 bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                            {{ strtoupper($media->file_type) }}
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold truncate">{{ $media->title ?? $media->filename }}</h3>
                                        <p class="text-gray-600 text-sm mb-2">
                                            {{ \Carbon\Carbon::parse($media->created_at)->format('M d, Y') }} • 
                                            {{ round($media->size_in_bytes / (1024 * 1024), 2) }} MB
                                        </p>
                                        
                                        @if($media->description)
                                            <p class="text-gray-700 text-sm mb-3 line-clamp-2">{{ $media->description }}</p>
                                        @endif

                                        <div class="flex justify-between mt-2">
                                            <a href="{{ route('organizer.event.media.show', [$event, $media]) }}" 
                                               class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-eye mr-1"></i> View
                                            </a>
                                            <a href="{{ route('organizer.event.media.edit', [$event, $media]) }}" 
                                               class="text-yellow-500 hover:text-yellow-700">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('organizer.event.media.destroy', [$event, $media]) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this media?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No media files</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by uploading images or videos for this event.</p>
                            <div class="mt-6">
                                <a href="{{ route('organizer.event.media.create', $event) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Media
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="mt-4 flex justify-between">
                <a href="{{ route('organizer.my-events') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Events
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 