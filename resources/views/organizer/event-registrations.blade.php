@extends('layouts.organizer')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('organizer.registrations') }}" class="flex items-center text-blue-600 hover:text-blue-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to All Registrations
        </a>
    </div>

    <!-- Event Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="h-16 w-16 rounded-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    @endif
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h1>
                    <div class="mt-1 flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $event->event_date->format('F d, Y') }} at {{ $event->event_date->format('h:i A') }}
                    </div>
                    <div class="mt-1 flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $event->location }}
                    </div>
                </div>
            </div>
            
            <div class="mt-6 md:mt-0 flex items-center">
                <div class="rounded-md bg-blue-50 px-4 py-2 text-center">
                    <span class="text-sm font-medium text-blue-700">Status</span>
                    <div class="text-2xl font-bold text-blue-800">
                        {{ $registrations->total() }} {{ Str::plural('Registration', $registrations->total()) }}
                    </div>
                </div>
                <div class="ml-4">
                    <div class="inline-flex shadow-sm rounded-md">
                        <a href="{{ route('stud.events.show', $event->id) }}" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-l-md border hover:bg-gray-50">
                            View Event
                        </a>
                        <a href="#" class="px-4 py-2 bg-blue-50 text-blue-700 text-sm font-medium rounded-r-md border border-l-0 border-blue-200 hover:bg-blue-100">
                            Export Registrations
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Debug Information - Remove after fixing -->
        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-100 rounded-md">
            <h3 class="text-sm font-medium text-yellow-800">Debug Information</h3>
            <div class="mt-2 text-xs text-yellow-700">
                <p>Event ID: {{ $debug['event_id'] }}</p>
                <p>Direct Registration Count: {{ $debug['direct_count'] }}</p>
                <p>Paginated Registration Count: {{ $debug['paginated_count'] }}</p>
                <p>Model Used: {{ $debug['model_used'] }}</p>
            </div>
        </div>
    </div>

    <!-- Registrations List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-medium text-gray-900">Registered Participants</h2>
        </div>
        
        @if($registrations->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($registrations as $registration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            @if($registration->user->profile_photo_path)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $registration->user->profile_photo_path) }}" alt="">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $registration->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $registration->user->student_id ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $registration->user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $registration->created_at->format('M d, Y') }}
                                    <span class="block text-xs text-gray-400">{{ $registration->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900">Contact</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Remove</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t">
                {{ $registrations->links() }}
            </div>
        @else
            <div class="p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No registrations yet</h3>
                <p class="mt-1 text-sm text-gray-500">This event doesn't have any registrations yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection 