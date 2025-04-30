@vite(['resources/css/app.css'])

<x-app-layout>
    <div class="flex">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-white shadow-md h-screen fixed left-0 top-0 pt-16">
            <div class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('stud.home') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-gray-800">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my.events') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-800">My Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('certificates') }}" class="flex items-center px-4 py-3 bg-blue-50 border-l-4 border-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-blue-600 font-medium">Certificates</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notifications') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="text-gray-800">Notifications</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-gray-800">Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 flex-1 p-8">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-900 mb-8">My Certificates</h1>
                
                <!-- Search & Filter -->
                <div class="mb-6 flex flex-wrap gap-4">
                    <div class="w-full md:w-64">
                        <input type="text" placeholder="Search certificates..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <select class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                            <option value="">All Events</option>
                            <option value="technical">Technical</option>
                            <option value="workshop">Workshop</option>
                            <option value="seminar">Seminar</option>
                        </select>
                    </div>
                    <div>
                        <select class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                            <option value="">All Time</option>
                            <option value="month">Past Month</option>
                            <option value="year">Past Year</option>
                        </select>
                    </div>
                </div>
                
                @if(count($certificates) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($certificates as $certificate)
                        @if($certificate->event)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="p-1 bg-gradient-to-r from-blue-500 to-purple-600"></div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $certificate->event->title }}</h3>
                                            <p class="text-sm text-gray-500 mt-1">{{ $certificate->event->event_date ? $certificate->event->event_date->format('M d, Y') : 'Date not available' }}</p>
                                        </div>
                                        <div class="p-2 bg-blue-100 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4">
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs text-gray-500">Certificate ID: #{{ str_pad($certificate->id, 6, '0', STR_PAD_LEFT) }}</p>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center">
                                                <span class="text-sm font-medium">Download</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @else
                <div class="bg-white rounded-lg shadow overflow-hidden p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No certificates found</h3>
                    <p class="text-gray-500 mb-6">You haven't earned any certificates yet. Attend events to earn certificates.</p>
                    <a href="{{ route('stud.home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Browse Events
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout> 