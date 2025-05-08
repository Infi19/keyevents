@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.organizer')

@section('title', 'Preview Report')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/github-markdown-css/github-markdown.css">
<style>
    .editor-toolbar button {
        color: #5a5a5a;
    }
    .CodeMirror {
        min-height: 500px;
        border-color: #e5e7eb;
        border-radius: 0.375rem;
    }
    .editor-preview {
        background: #fff;
    }
    .editor-preview-side {
        border-color: #e5e7eb;
    }
    .markdown-body {
        padding: 2rem;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Preview Report: {{ $event->title }}</h1>
        <a href="{{ route('reports.create', $event->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Edit
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Report Preview</h2>
        <p class="mb-4 text-gray-600">
            You can edit the content below as needed. The report content has been generated using Gemini AI based on the details you provided.
            Click "Generate PDF" when you're satisfied with the content.
        </p>
        
        <form action="{{ route('reports.generate', $event->id) }}" method="POST">
            @csrf
            
            <input type="hidden" name="report_title" value="{{ $validatedData['report_title'] ?? '' }}">
            
            @if(isset($validatedData['include_photos']) && $validatedData['include_photos'])
                <input type="hidden" name="include_photos" value="1">
                @if(isset($validatedData['selected_photos']) && is_array($validatedData['selected_photos']))
                    @foreach($validatedData['selected_photos'] as $photoId)
                        <input type="hidden" name="selected_photos[]" value="{{ $photoId }}">
                    @endforeach
                @endif
            @endif
            
            <input type="hidden" name="coordinator_name" value="{{ $validatedData['coordinator_name'] ?? '' }}">
            <input type="hidden" name="head_of_department" value="{{ $validatedData['head_of_department'] ?? '' }}">
            <input type="hidden" name="principal_name" value="{{ $validatedData['principal_name'] ?? '' }}">
            
            <div class="mb-6">
                <label for="report_content" class="block text-sm font-medium text-gray-700 mb-1">Report Content</label>
                <textarea id="report_content" name="report_content" class="hidden">{{ $reportContent }}</textarea>
                <div id="markdown-editor"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex justify-center">
                    <button type="button" id="preview_button" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-6 rounded-md inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd" />
                        </svg>
                        Preview
                    </button>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                        </svg>
                        Generate PDF
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div id="preview_modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">PDF Preview</h3>
                    <button id="close_preview" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div id="preview_content" class="markdown-body">
                    <!-- Preview content will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize EasyMDE
        const easyMDE = new EasyMDE({
            element: document.getElementById('report_content'),
            spellChecker: false,
            autosave: {
                enabled: true,
                delay: 1000,
                uniqueId: 'report_editor_{{ $event->id }}'
            },
            toolbar: [
                'bold', 'italic', 'heading', '|',
                'unordered-list', 'ordered-list', '|',
                'link', 'image', '|',
                'preview', 'side-by-side', 'fullscreen', '|',
                'guide'
            ]
        });
        
        // Preview button functionality
        const previewButton = document.getElementById('preview_button');
        const previewModal = document.getElementById('preview_modal');
        const closePreview = document.getElementById('close_preview');
        const previewContent = document.getElementById('preview_content');
        
        previewButton.addEventListener('click', function() {
            const markdownContent = easyMDE.value();
            previewContent.innerHTML = marked.parse(markdownContent);
            previewModal.classList.remove('hidden');
        });
        
        closePreview.addEventListener('click', function() {
            previewModal.classList.add('hidden');
        });
        
        // Close modal when clicking outside
        previewModal.addEventListener('click', function(event) {
            if (event.target === previewModal) {
                previewModal.classList.add('hidden');
            }
        });
    });
</script>
@endpush
@endsection 