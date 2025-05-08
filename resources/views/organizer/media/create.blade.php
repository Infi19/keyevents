<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Upload Media for: {{ $event->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('organizer.event.media.store', $event) }}" enctype="multipart/form-data">
                        @csrf

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="mb-6">
                            <label for="media_files" class="block text-sm font-medium text-gray-700 mb-2">
                                Media Files (Images & Videos)
                            </label>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="media_files" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload files</span>
                                            <input id="media_files" name="media_files[]" type="file" class="sr-only" multiple accept="image/*,video/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF, MP4, MOV up to 100MB
                                    </p>
                                </div>
                            </div>
                            
                            <div id="preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                <!-- Preview will be dynamically populated by JavaScript -->
                            </div>
                            
                            @error('media_files')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @error('media_files.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="media-details" class="mb-6">
                            <!-- Media details form will be dynamically populated by JavaScript -->
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a href="{{ route('organizer.event.media.index', $event) }}" class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Media Gallery
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-cloud-upload-alt mr-2"></i> Upload Media
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Function to handle file selection and preview
        document.getElementById('media_files').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            const mediaDetails = document.getElementById('media-details');
            
            // Clear previous previews and details
            preview.innerHTML = '';
            mediaDetails.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach((file, index) => {
                    // Create preview card
                    const card = document.createElement('div');
                    card.className = 'border rounded-lg overflow-hidden bg-gray-50';
                    
                    const isImage = file.type.startsWith('image/');
                    const isVideo = file.type.startsWith('video/');
                    
                    if (isImage || isVideo) {
                        // Create preview element (image or video)
                        const previewContainer = document.createElement('div');
                        previewContainer.className = 'h-32 bg-gray-200 relative';
                        
                        if (isImage) {
                            const img = document.createElement('img');
                            img.className = 'w-full h-full object-cover';
                            img.file = file;
                            
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                img.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                            
                            previewContainer.appendChild(img);
                            
                            // Type indicator
                            const typeIndicator = document.createElement('div');
                            typeIndicator.className = 'absolute top-2 right-2 bg-gray-800 bg-opacity-50 text-white text-xs px-2 py-1 rounded';
                            typeIndicator.innerText = 'IMAGE';
                            previewContainer.appendChild(typeIndicator);
                            
                        } else if (isVideo) {
                            const video = document.createElement('video');
                            video.className = 'w-full h-full object-cover';
                            video.controls = false;
                            
                            const source = document.createElement('source');
                            source.file = file;
                            
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                source.src = e.target.result;
                                video.load();
                            };
                            reader.readAsDataURL(file);
                            
                            video.appendChild(source);
                            previewContainer.appendChild(video);
                            
                            // Play icon overlay
                            const playIcon = document.createElement('div');
                            playIcon.className = 'absolute inset-0 flex items-center justify-center';
                            playIcon.innerHTML = `
                                <svg class="w-12 h-12 text-white opacity-70" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            `;
                            previewContainer.appendChild(playIcon);
                            
                            // Type indicator
                            const typeIndicator = document.createElement('div');
                            typeIndicator.className = 'absolute top-2 right-2 bg-gray-800 bg-opacity-50 text-white text-xs px-2 py-1 rounded';
                            typeIndicator.innerText = 'VIDEO';
                            previewContainer.appendChild(typeIndicator);
                        }
                        
                        // Info area under preview
                        const infoContainer = document.createElement('div');
                        infoContainer.className = 'p-2';
                        
                        const filename = document.createElement('p');
                        filename.className = 'text-sm font-medium truncate';
                        filename.innerText = file.name;
                        
                        const filesize = document.createElement('p');
                        filesize.className = 'text-xs text-gray-500';
                        filesize.innerText = `${(file.size / (1024 * 1024)).toFixed(2)} MB`;
                        
                        infoContainer.appendChild(filename);
                        infoContainer.appendChild(filesize);
                        
                        // Assemble card
                        card.appendChild(previewContainer);
                        card.appendChild(infoContainer);
                        preview.appendChild(card);
                        
                        // Create details fields for this file
                        const detailsContainer = document.createElement('div');
                        detailsContainer.className = 'bg-gray-50 p-4 rounded-lg mb-4';
                        
                        const detailsHeader = document.createElement('h3');
                        detailsHeader.className = 'text-lg font-medium text-gray-900 mb-3';
                        detailsHeader.innerText = `Details for ${file.name}`;
                        
                        const titleLabel = document.createElement('label');
                        titleLabel.className = 'block text-sm font-medium text-gray-700 mb-1';
                        titleLabel.innerText = 'Title (optional)';
                        
                        const titleInput = document.createElement('input');
                        titleInput.type = 'text';
                        titleInput.name = `titles[${index}]`;
                        titleInput.className = 'shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md mb-3';
                        titleInput.placeholder = 'Enter a title for this media';
                        
                        const descLabel = document.createElement('label');
                        descLabel.className = 'block text-sm font-medium text-gray-700 mb-1';
                        descLabel.innerText = 'Description (optional)';
                        
                        const descInput = document.createElement('textarea');
                        descInput.name = `descriptions[${index}]`;
                        descInput.className = 'shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md';
                        descInput.rows = 3;
                        descInput.placeholder = 'Enter a description for this media';
                        
                        detailsContainer.appendChild(detailsHeader);
                        detailsContainer.appendChild(titleLabel);
                        detailsContainer.appendChild(titleInput);
                        detailsContainer.appendChild(descLabel);
                        detailsContainer.appendChild(descInput);
                        
                        mediaDetails.appendChild(detailsContainer);
                    }
                });
            }
        });
        
        // Enable drag and drop upload
        const dropArea = document.querySelector('.border-dashed');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('border-blue-500');
            dropArea.classList.add('bg-blue-50');
        }
        
        function unhighlight() {
            dropArea.classList.remove('border-blue-500');
            dropArea.classList.remove('bg-blue-50');
        }
        
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const fileInput = document.getElementById('media_files');
            
            fileInput.files = files;
            
            // Trigger change event
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    </script>
    @endpush
</x-app-layout> 