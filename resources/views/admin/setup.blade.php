<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold mb-2">Create New Event</h1>
                    <p class="text-gray-600">Fill out the form below to create a new event</p>
                </div>

                <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
                <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

                {{-- Preview Area - Simplified to avoid slot errors --}}
                <div class="absolute top-[400] right-44 hidden" id="preview-area">
                    <div class="rounded-md shadow-md overflow-hidden">
                        <img id="preview-image" class="w-full aspect-[956/620] object-cover rounded-t-md" alt="Preview"/>
                    </div>
                </div>
                {{-- Preview Area End --}}

                <form method="POST" action="{{ route('setup.submit') }}" enctype="multipart/form-data">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-12 px-6 lg:px-12 border-gray-300">
                        
                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="border-b pb-2">   
                                <h2 class="text-xl font-semibold text-gray-900 pt-5 pb-2">Set Up The Event</h2>
                                <p class="mt-1 text-sm text-gray-600">Get the word out! These details will be visible to everyone.</p>
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                              
                              <div class="sm:col-span-4">
                                <label for="title" class="block text-sm font-medium text-gray-900">Title*</label>
                                
                                {{-- TITLE FIELD --}}
                              <div class="mt-2">
                                <input 
                                    id="title" 
                                    name="title" 
                                    type="text" 
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-gray-900"
                                    value="{{ old('title') }}"
                                    required>
                            </div>
                        </div>
                            
                                {{-- ABOUT FIELD --}}
                              <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium text-gray-900">About*</label>
                                <div class="mt-2">
                                  <textarea name="about" id="about" rows="3" class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-gray-900"
                                  required>{{ old('about') }}</textarea>
                                </div>
                               
                                <p class="mt-3 text-sm text-gray-600">Let people know what they can expect at the event.</p>
                              </div>
                    
                              <div class="col-span-full">
                                <label class="block text-sm font-medium text-gray-900">Cover photo*</label>
                               
                                <div id="drag-drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/30 px-6 py-10">
                                  <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                      <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm text-gray-600">
                                      <label for="file_upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-0 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500">
                                        <span>Upload a file</span>
                                        <input id="file_upload" name="file_upload" type="file" class="sr-only" accept="image/*">
                                      </label>
                                      <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-600">PNG, JPG, JPEG up to 10MB</p>
                                    <p class="text-xs text-gray-600">Dimensions[956x620]</p>
                                  </div>
                                </div>
                                 
                                @error('file_upload')
                                    <span class="text-red-500 text-sm">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                          </div>
                      
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 border-b border-gray-900/10 pb-12">  
                            <div class="sm:col-span-2 sm:col-start-1">
                                <label for="type" class="block text-sm font-medium text-gray-900">Type</label>
                                <div class="mt-2">
                                    <select id="type" name="type" class="w-full rounded-md bg-gray-100 py-1.5 pl-3 pr-8 text-base text-gray-900 border border-gray-300" required>
                                        <option value="In-Person" {{ old('type') == 'In-Person' ? 'selected' : '' }}>In-Person</option>
                                        <option value="Virtual" {{ old('type') == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="category" class="block text-sm font-medium text-gray-900">Category</label>
                                <div class="mt-2">
                                    <select id="category" name="category" class="w-full rounded-md bg-gray-100 py-1.5 pl-3 pr-8 text-base text-gray-900 border border-gray-300" required>
                                        <option value="Seminars and Talks" {{ old('category', 'Seminars and Talks') == 'Seminars and Talks' ? 'selected' : '' }}>Seminars and Talks</option>
                                        <option value="Workshop" {{ old('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                        <option value="Exhibition" {{ old('category') == 'Exhibition' ? 'selected' : '' }}>Exhibition</option>
                                        <option value="Cultural Fest" {{ old('category') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                        <option value="Award Ceremonies" {{ old('category') == 'Award Ceremonies' ? 'selected' : '' }}>Award Ceremonies</option>
                                        <option value="Festivals" {{ old('category') == 'Festivals' ? 'selected' : '' }}>Festivals</option>
                                        <option value="Annual Day" {{ old('category') == 'Annual Day' ? 'selected' : '' }}>Annual Day</option>
                                        <option value="Sports Competition" {{ old('category') == 'Sports Competition' ? 'selected' : '' }}>Sports Competition</option>
                                        <option value="Technical Competition" {{ old('category') == 'Technical Competition' ? 'selected' : '' }}>Technical Competition</option>
                                        <option value="Competition" {{ old('category') == 'Competition' ? 'selected' : '' }}>Competition</option>
                                        <option value="Hackathon" {{ old('category') == 'Hackathon' ? 'selected' : '' }}>Hackathon</option>
                                        <option value="Esports/Gaming" {{ old('category') == 'Esports/Gaming' ? 'selected' : '' }}>Esports/Gaming</option>
                                        <option value="Quizzes" {{ old('category') == 'Quizzes' ? 'selected' : '' }}>Quizzes</option>
                                        <option value="Community Service" {{ old('category') == 'Community Service' ? 'selected' : '' }}>Community Service</option>
                                        <option value="Awareness Campaigns" {{ old('category') == 'Awareness Campaigns' ? 'selected' : '' }}>Awareness Campaigns</option>
                                        <option value="Drama and Theater" {{ old('category') == 'Drama and Theater' ? 'selected' : '' }}>Drama and Theater</option>
                                        <option value="Art and Craft" {{ old('category') == 'Art and Craft' ? 'selected' : '' }}>Art and Craft</option>
                                        <option value="Carnivals and Fairs" {{ old('category') == 'Carnivals and Fairs' ? 'selected' : '' }}>Carnivals and Fairs</option>
                                        <option value="Photography and Videography" {{ old('category') == 'Photography and Videography' ? 'selected' : '' }}>Photography and Videography</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="event_date" class="block text-sm font-medium text-gray-900">Date*</label>
                                <div class="mt-2">
                                    <input type="date" name="event_date" id="event_date" autocomplete="off" class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-900 border border-gray-300"
                                    value="{{ old('event_date') }}"
                                    required>
                                </div>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="seats_available" class="block text-sm font-medium text-gray-900">Seats Available*</label>
                                <div class="mt-2">
                                    <input type="number" name="seats_available" id="seats_available" min="1" max="1000" class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-900 border border-gray-300"
                                    value="{{ old('seats_available') }}"
                                    placeholder="Number of slots"
                                    required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Maximum number of students who can register</p>
                            </div>
                        </div>
                        
                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="sm:col-span-2">
                                <label for="time_from" class="block text-sm font-medium text-gray-900">Timing</label>
                                <div class="mt-2 flex space-x-4">
                                    <!-- Time From -->
                                    <div class="w-1/2">
                                        <label for="time_from" class="block text-sm font-normal text-gray-900">From</label>
                                        <div class="flex space-x-2">
                                            <!-- Hour -->
                                            <select name="time_from_hour" id="time_from_hour" class="w-1/3 block rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300" required>
                                                <option value="" disabled selected>Select Hour</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                            
                                            <!-- Minute -->
                                            <select name="time_from_minute" id="time_from_minute" class="w-1/3 block rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300" required>
                                                <option value="" disabled selected>Select Minute</option>
                                                @for ($i = 0; $i < 60; $i++)
                                                    <option value="{{ $i }}" {{ old('time_from_minute') == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                            
                                            <!-- AM/PM -->
                                            <select name="time_from_period" id="time_from_period" class="w-1/3 block rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-900 border border-gray-300" required>
                                                <option value="" disabled selected>Select AM/PM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                        @error('time_from_hour')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                            
                                    <!-- Time To -->
                                    <div class="w-1/2">
                                        <label for="time_to" class="block text-sm font-normal text-gray-900">To</label>
                                        <div class="flex space-x-2">
                                            <!-- Hour -->
                                            <select name="time_to_hour" id="time_to_hour" class="w-1/3 block rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300" required>
                                                <option value="" disabled selected>Select Hour</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                            
                                            <!-- Minute -->
                                            <select name="time_to_minute" id="time_to_minute" class="w-1/3 block rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300" required>
                                                <option value="" disabled selected>Select Minute</option>
                                                @for ($i = 0; $i < 60; $i++)
                                                    <option value="{{ $i }}" {{ old('time_to_minute') == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                            
                                            <!-- AM/PM -->
                                            <select name="time_to_period" id="time_to_period" class="w-1/3 block rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-900 border border-gray-300" required>
                                                <option value="" disabled selected>Select AM/PM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                        @error('time_to_hour')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="mt-6 flex items-center justify-center gap-x-6">
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-900">Cancel</a>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </div>
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    const dragDropArea = document.getElementById('drag-drop-area');
                    const fileInput = document.getElementById('file_upload');
                    const previewArea = document.getElementById('preview-area');
                    const previewImage = document.getElementById('preview-image');
                    const svgIcon = document.querySelector('#drag-drop-area svg');

                    // Check if previewImage exists
                    if (!previewImage) {
                        console.error('Preview image element not found!');
                        return; // Exit early if previewImage is missing
                    }

                    // Handle SVG hover to change border color
                    svgIcon.addEventListener('mouseenter', () => {
                        dragDropArea.classList.add('border-indigo-600'); // Apply border color change
                    });

                    svgIcon.addEventListener('mouseleave', () => {
                        dragDropArea.classList.remove('border-indigo-600'); // Revert border color
                    });

                    // Handle dragover event to show that a file can be dropped
                    dragDropArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        dragDropArea.classList.add('border-indigo-600'); // Change the border to indicate drop area
                    });

                    // Handle dragleave event to revert the border when dragging stops
                    dragDropArea.addEventListener('dragleave', () => {
                        dragDropArea.classList.remove('border-indigo-600');
                    });

                    // Handle drop event to process the dropped files
                    dragDropArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        dragDropArea.classList.remove('border-indigo-600'); // Revert the border

                        const files = event.dataTransfer.files; // Get the dropped files
                        if (files.length > 0) {
                            handleFile(files[0]);
                        }
                    });

                    // Handle file selection via file input (when file is manually selected)
                    fileInput.addEventListener('change', () => {
                        const files = fileInput.files;
                        if (files.length > 0) {
                            handleFile(files[0]);
                        }
                    });

                    // Function to handle file (common for both drag/drop and manual selection)
                    function handleFile(file) {
                        // Check if the file is an image (PNG, JPG, JPEG)
                        if (file && file.type.startsWith('image/')) {
                            // Display the preview area
                            previewArea.classList.remove('hidden');

                            // Create a URL for the image and set it as the preview
                            const imageUrl = URL.createObjectURL(file);
                            previewImage.src = imageUrl; // Set the image source

                            // Manually trigger the file input change event to set the file in the input (for form submission)
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file); // Add the file to the DataTransfer object
                            fileInput.files = dataTransfer.files; // Assign the new FileList to the input
                        } else {
                            // If the file is not an image, hide the preview
                            previewArea.classList.add('hidden');
                            alert('Please upload an image file (PNG, JPG, JPEG).');
                            
                            // Clear the file input
                            fileInput.value = '';
                        }
                    }
                });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>