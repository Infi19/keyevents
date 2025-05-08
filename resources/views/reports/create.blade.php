@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.organizer')

@section('title', 'Generate Event Report')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Generate Report: {{ $event->title }}</h1>
        <a href="{{ route('reports.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Reports
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Event Information</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 mb-1">Event Title</p>
                    <p class="text-gray-800">{{ $event->title }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 mb-1">Date</p>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 mb-1">Time</p>
                    <p class="text-gray-800">
                        {{ $event->time_from_hour }}:{{ $event->time_from_minute }} {{ $event->time_from_period }} 
                        to 
                        {{ $event->time_to_hour }}:{{ $event->time_to_minute }} {{ $event->time_to_period }}
                    </p>
                </div>
            </div>
            
            <div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 mb-1">Type</p>
                    <p class="text-gray-800">{{ $event->type ?? 'Not specified' }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 mb-1">Category</p>
                    <p class="text-gray-800">{{ $event->category ?? 'Not specified' }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 mb-1">About</p>
                    <p class="text-gray-800 line-clamp-3">{{ $event->about ?? 'No description available' }}</p>
                </div>
            </div>
        </div>
        
        <form action="{{ route('reports.preview', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <h3 class="text-lg font-medium text-gray-800 mb-4">Report Details</h3>
            
            <div class="mb-4">
                <label for="report_title" class="block text-sm font-medium text-gray-700 mb-1">Report Title (Optional)</label>
                <input type="text" name="report_title" id="report_title" value="{{ old('report_title', $event->title) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Leave blank to use the event title</p>
            </div>
            
            <div class="mb-4">
                <label for="report_description" class="block text-sm font-medium text-gray-700 mb-1">Additional Description for Report</label>
                <textarea name="report_description" id="report_description" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ old('report_description', $event->about) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Provide additional details about the event for Gemini AI to include in the report</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <div class="mb-4">
                        <label for="venue" class="block text-sm font-medium text-gray-700 mb-1">Venue</label>
                        <input type="text" name="venue" id="venue" value="{{ old('venue', 'Mokshagundm Visvesvaraya Hall, Keystone School of Engineering') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="resource_person" class="block text-sm font-medium text-gray-700 mb-1">Resource Person/Speaker</label>
                        <input type="text" name="resource_person" id="resource_person" value="{{ old('resource_person', 'Dr. Deepak Mane') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="resource_person_details" class="block text-sm font-medium text-gray-700 mb-1">Resource Person Details</label>
                        <input type="text" name="resource_person_details" id="resource_person_details" 
                            value="{{ old('resource_person_details', 'Associate Professor & Asst. Head Admin Dept. of Comp, VIT, Pune') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="attendees_count" class="block text-sm font-medium text-gray-700 mb-1">Number of Attendees</label>
                        <input type="number" name="attendees_count" id="attendees_count" value="{{ old('attendees_count', 160) }}" min="0" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>
                
                <div>
                    <div class="mb-4">
                        <label for="coordinator_name" class="block text-sm font-medium text-gray-700 mb-1">Program Coordinator</label>
                        <input type="text" name="coordinator_name" id="coordinator_name" value="{{ old('coordinator_name', 'Prof. Manjiri Raut') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="head_of_department" class="block text-sm font-medium text-gray-700 mb-1">Head of Department</label>
                        <input type="text" name="head_of_department" id="head_of_department" value="{{ old('head_of_department', 'Prof. Sagar Rajebhosale') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="principal_name" class="block text-sm font-medium text-gray-700 mb-1">Principal</label>
                        <input type="text" name="principal_name" id="principal_name" value="{{ old('principal_name', 'Dr. Sandeep Kadam') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="include_photos" id="include_photos" value="1" {{ old('include_photos') ? 'checked' : '' }} 
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="include_photos" class="ml-2 block text-sm text-gray-700">Include event photos in the report</label>
                </div>
                
                @if($event->media->count() > 0)
                    <div class="mt-4" id="photos_container" style="{{ old('include_photos') ? '' : 'display: none;' }}">
                        <p class="text-sm font-medium text-gray-700 mb-2">Select photos to include:</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($event->media as $media)
                                @if(in_array(strtolower(pathinfo($media->file_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                    <div class="relative border rounded-lg p-1">
                                        <input type="checkbox" name="selected_photos[]" id="photo_{{ $media->id }}" value="{{ $media->id }}" 
                                            class="absolute top-2 left-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 z-10">
                                        <label for="photo_{{ $media->id }}" class="cursor-pointer">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->title ?? 'Event photo' }}" 
                                                class="w-full h-32 object-cover rounded">
                                            <p class="mt-1 text-xs text-gray-500 truncate">{{ $media->title ?? 'Photo ' . $loop->iteration }}</p>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="mt-2 text-sm text-gray-500">No photos available for this event.</p>
                @endif
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                    Generate Report
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const includePhotosCheckbox = document.getElementById('include_photos');
        const photosContainer = document.getElementById('photos_container');
        
        if (includePhotosCheckbox && photosContainer) {
            includePhotosCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    photosContainer.style.display = 'block';
                } else {
                    photosContainer.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush
@endsection 