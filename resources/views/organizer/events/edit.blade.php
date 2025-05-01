@extends('layouts.organizer')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('organizer.my-events') }}" class="flex items-center text-blue-600 hover:text-blue-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to My Events
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold">Edit Event</h1>
            <p class="text-gray-600 mt-1">Update your event details</p>
        </div>

        <form method="POST" action="{{ route('organizer.events.update', $event->id) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title*</label>
                    <input 
                        id="title" 
                        name="title" 
                        type="text" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('title', $event->title) }}"
                        required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category*</label>
                    <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="Seminars and Talks" {{ old('category', $event->category) == 'Seminars and Talks' ? 'selected' : '' }}>Seminars and Talks</option>
                        <option value="Workshop" {{ old('category', $event->category) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="Exhibition" {{ old('category', $event->category) == 'Exhibition' ? 'selected' : '' }}>Exhibition</option>
                        <option value="Cultural Fest" {{ old('category', $event->category) == 'Cultural Fest' ? 'selected' : '' }}>Cultural Fest</option>
                        <option value="Award Ceremonies" {{ old('category', $event->category) == 'Award Ceremonies' ? 'selected' : '' }}>Award Ceremonies</option>
                        <option value="Festivals" {{ old('category', $event->category) == 'Festivals' ? 'selected' : '' }}>Festivals</option>
                        <option value="Annual Day" {{ old('category', $event->category) == 'Annual Day' ? 'selected' : '' }}>Annual Day</option>
                        <option value="Sports Competition" {{ old('category', $event->category) == 'Sports Competition' ? 'selected' : '' }}>Sports Competition</option>
                        <option value="Technical Competition" {{ old('category', $event->category) == 'Technical Competition' ? 'selected' : '' }}>Technical Competition</option>
                        <option value="Competition" {{ old('category', $event->category) == 'Competition' ? 'selected' : '' }}>Competition</option>
                        <option value="Hackathon" {{ old('category', $event->category) == 'Hackathon' ? 'selected' : '' }}>Hackathon</option>
                        <option value="Esports/Gaming" {{ old('category', $event->category) == 'Esports/Gaming' ? 'selected' : '' }}>Esports/Gaming</option>
                        <option value="Quizzes" {{ old('category', $event->category) == 'Quizzes' ? 'selected' : '' }}>Quizzes</option>
                        <option value="Community Service" {{ old('category', $event->category) == 'Community Service' ? 'selected' : '' }}>Community Service</option>
                        <option value="Awareness Campaigns" {{ old('category', $event->category) == 'Awareness Campaigns' ? 'selected' : '' }}>Awareness Campaigns</option>
                        <option value="Drama and Theater" {{ old('category', $event->category) == 'Drama and Theater' ? 'selected' : '' }}>Drama and Theater</option>
                        <option value="Art and Craft" {{ old('category', $event->category) == 'Art and Craft' ? 'selected' : '' }}>Art and Craft</option>
                        <option value="Carnivals and Fairs" {{ old('category', $event->category) == 'Carnivals and Fairs' ? 'selected' : '' }}>Carnivals and Fairs</option>
                        <option value="Photography and Videography" {{ old('category', $event->category) == 'Photography and Videography' ? 'selected' : '' }}>Photography and Videography</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Event Type*</label>
                    <select id="type" name="type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="In-Person" {{ old('type', $event->type) == 'In-Person' ? 'selected' : '' }}>In-Person</option>
                        <option value="Virtual" {{ old('type', $event->type) == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                    </select>
                </div>

                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Event Date*</label>
                    <input 
                        type="date" 
                        id="event_date" 
                        name="event_date" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}"
                        required>
                </div>
            </div>

            <div class="mb-6">
                <label for="seats_available" class="block text-sm font-medium text-gray-700 mb-1">Seats Available*</label>
                <input 
                    type="number" 
                    id="seats_available" 
                    name="seats_available" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('seats_available', $event->seats_available) }}"
                    min="1"
                    required>
            </div>

            <div class="mb-6">
                <label for="about" class="block text-sm font-medium text-gray-700 mb-1">Event Description*</label>
                <textarea 
                    id="about" 
                    name="about" 
                    rows="5" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    required>{{ old('about', $event->about) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Image</label>
                
                <div class="mb-4">
                    @if($event->image_path)
                        <div class="mb-2">
                            <p class="text-sm text-gray-600">Current image:</p>
                            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="h-40 object-cover rounded-md mt-1">
                        </div>
                    @endif
                    
                    <p class="text-sm text-gray-600">Upload a new image to replace the current one (optional):</p>
                </div>
                
                <div class="border-2 border-dashed border-gray-300 rounded-md p-6 flex justify-center items-center">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="mt-2 flex justify-center">
                            <label for="image" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload image</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6 flex justify-end space-x-3">
                <a href="{{ route('organizer.my-events') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition focus:outline-none">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition focus:outline-none">
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview image before upload
    const imageInput = document.getElementById('image');
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'h-40 object-cover rounded-md mt-2';
                
                // Remove any previous preview
                const parent = imageInput.closest('div').parentElement;
                const existingPreview = parent.querySelector('.preview-image');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                // Add the new preview
                const previewContainer = document.createElement('div');
                previewContainer.className = 'preview-image mt-4';
                previewContainer.appendChild(img);
                
                // Add a label
                const label = document.createElement('p');
                label.className = 'text-sm text-gray-600 mt-1';
                label.textContent = 'New image preview:';
                previewContainer.insertBefore(label, img);
                
                parent.appendChild(previewContainer);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection 