<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $media->title ?? $media->filename }}
            </h2>
            <div>
                <a href="{{ route('organizer.event.media.edit', [$event, $media]) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('organizer.event.media.destroy', [$event, $media]) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this media?')">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Media Display -->
                        <div class="md:col-span-2">
                            <div class="bg-gray-100 rounded-lg overflow-hidden">
                                @if($media->file_type == 'image')
                                    <img src="{{ asset('storage/' . $media->file_path) }}" 
                                        alt="{{ $media->title ?? $media->filename }}" 
                                        class="w-full h-auto object-contain">
                                @elseif($media->file_type == 'video')
                                    <video class="w-full" controls controlsList="nodownload">
                                        <source src="{{ asset('storage/' . $media->file_path) }}" type="{{ $media->mime_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        </div>

                        <!-- Media Information -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Media Information</h3>
                                
                                <dl class="grid grid-cols-1 gap-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">File Name</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $media->filename }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">File Type</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ strtoupper($media->file_type) }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">MIME Type</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $media->mime_type }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Size</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ round($media->size_in_bytes / (1024 * 1024), 2) }} MB</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Uploaded</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $media->created_at->format('F j, Y, g:i a') }}</dd>
                                    </div>
                                    
                                    @if($media->title)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Title</dt>
                                            <dd class="mt-1 text-sm text-gray-900">{{ $media->title }}</dd>
                                        </div>
                                    @endif
                                    
                                    @if($media->description)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                                            <dd class="mt-1 text-sm text-gray-900">{{ $media->description }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Event Information</h3>
                                
                                <dl class="grid grid-cols-1 gap-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Event</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $event->title }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $event->event_date->format('F j, Y') }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                                        <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $event->status }}</dd>
                                    </div>
                                </dl>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                                
                                <div class="space-y-3">
                                    <a href="{{ asset('storage/' . $media->file_path) }}" 
                                       download="{{ $media->filename }}"
                                       class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                        <i class="fas fa-download mr-2"></i> Download File
                                    </a>
                                    
                                    <a href="{{ route('organizer.event.media.edit', [$event, $media]) }}" 
                                       class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-center">
                                        <i class="fas fa-edit mr-2"></i> Edit Details
                                    </a>
                                    
                                    <form action="{{ route('organizer.event.media.destroy', [$event, $media]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center"
                                                onclick="return confirm('Are you sure you want to delete this media?')">
                                            <i class="fas fa-trash mr-2"></i> Delete Media
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 flex justify-between">
                <a href="{{ route('organizer.event.media.index', $event) }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Media Gallery
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 