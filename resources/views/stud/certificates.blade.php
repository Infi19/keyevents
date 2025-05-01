@vite(['resources/css/app.css'])

<x-student-layout>
    <div class="max-w-6xl">
        <h1 class="text-xl font-bold text-gray-900">Certificates</h1>
        <p class="text-sm text-gray-600 mt-1 mb-6">View and download your earned certificates</p>
        
        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input type="text" placeholder="Search certificates..." class="w-full bg-white border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
        
        @if(count($certificates) > 0)
            <!-- Certificates List -->
            <div class="space-y-4">
                @foreach($certificates as $certificate)
                    @if($certificate->event)
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                                            <path d="M3 8a2 2 0 012-2h2.93a.5.5 0 01.5.5v.5H6a2 2 0 00-2 2v2.93a.5.5 0 01-.5.5H3V8zm10.5-3a.5.5 0 01.5-.5h1.93a.5.5 0 01.5.5v8.93a.5.5 0 01-.5.5h-.5V9a2 2 0 00-2-2H9.5V5.5a.5.5 0 01.5-.5h3.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $certificate->event->title }}</h3>
                                        <p class="text-sm text-gray-600">Completed on {{ $certificate->updated_at ? $certificate->updated_at->format('M d, Y') : 'N/A' }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Certificate ID: #{{ str_pad($certificate->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No certificates found</h3>
                <p class="text-gray-600 mb-6">You haven't earned any certificates yet. Attend events to earn certificates.</p>
                <a href="{{ route('stud.home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700">
                    Browse Events
                </a>
            </div>
        @endif
    </div>
</x-student-layout> 