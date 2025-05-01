@vite(['resources/css/app.css'])

<x-student-layout>
    <div class="max-w-6xl">
        <h1 class="text-xl font-bold text-gray-900">Notifications</h1>
        <p class="text-sm text-gray-600 mt-1 mb-6">Stay updated with the latest events and announcements</p>
        
        <!-- Notifications List -->
        @if(isset($notifications) && count($notifications) > 0)
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $notification['title'] ?? $notification['message'] ?? 'Notification' }}</p>
                                        <p class="text-sm text-gray-500 mt-1">{{ $notification['time'] ?? $notification['created_at'] ?? 'Just now' }}</p>
                                    </div>
                                    <button class="h-6 w-6 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No notifications yet</h3>
                <p class="text-gray-600 mb-6">You don't have any notifications at this time. When you receive updates, they'll appear here.</p>
            </div>
        @endif
        
        <!-- Notification Settings -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Notification Preferences</h2>
            
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium">Email Notifications</p>
                            <p class="text-sm text-gray-500">Receive email alerts for important updates</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
                
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium">Event Reminders</p>
                            <p class="text-sm text-gray-500">Get notifications before your registered events</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium">New Event Announcements</p>
                            <p class="text-sm text-gray-500">Be notified when new events are added</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout> 