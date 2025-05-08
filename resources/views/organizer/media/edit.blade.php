<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Media: {{ $media->title ?? $media->filename }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Media Preview -->
                        <div class="md:col-span-1">
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
                            
                            <!-- Media Information -->
                            <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">File Information</h3>
                                
                                <dl class="grid grid-cols-1 gap-y-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">File Name</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $media->filename }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">File Type</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ strtoupper($media->file_type) }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Size</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ round($media->size_in_bytes / (1024 * 1024), 2) }} MB</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Uploaded</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $media->created_at->format('F j, Y') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        
                        <!-- Edit Form -->
                        <div class="md:col-span-2">
                            <form method="POST" action="{{ route('organizer.event.media.update', [$event, $media]) }}">
                                @csrf
                                @method('PUT')
                                
                                @if(session('success'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                        <span class="block sm:inline">{{ session('success') }}</span>
                                    </div>
                                @endif
                                
                                <div class="mb-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                        Title
                                    </label>
                                    <input type="text" 
                                           name="title" 
                                           id="title" 
                                           value="{{ old('title', $media->title) }}" 
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                           placeholder="Enter a title for this media">
                                    @error('title')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description
                                    </label>
                                    <textarea id="description" 
                                              name="description" 
                                              rows="6" 
                                              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                              placeholder="Enter a description for this media">{{ old('description', $media->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex items-center justify-between mt-8">
                                    <div>
                                        <a href="{{ route('organizer.event.media.index', $event) }}" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-arrow-left mr-2"></i> Back to Media Gallery
                                        </a>
                                    </div>
                                    <div class="flex space-x-3">
                                        <a href="{{ route('organizer.event.media.show', [$event, $media]) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <i class="fas fa-eye mr-2"></i> View
                                        </a>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <i class="fas fa-save mr-2"></i> Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 