<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            Feedback Viewer
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-lg text-gray-800">User Feedback</h3>
            <p class="text-gray-600">View and analyze feedback submitted by users for events</p>
        </div>
        
        <div class="p-6">
            <!-- Filters -->
            <div class="mb-6 flex flex-wrap gap-4 items-end">
                <div>
                    <label for="event-filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Event</label>
                    <select id="event-filter" class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                        <option value="">All Events</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="rating-filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Rating</label>
                    <select id="rating-filter" class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                        <option value="">All Ratings</option>
                        <option value="5">★★★★★ (5 Stars)</option>
                        <option value="4">★★★★☆ (4 Stars)</option>
                        <option value="3">★★★☆☆ (3 Stars)</option>
                        <option value="2">★★☆☆☆ (2 Stars)</option>
                        <option value="1">★☆☆☆☆ (1 Star)</option>
                    </select>
                </div>
                
                <div>
                    <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Date</label>
                    <select id="date-filter" class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                
                <div class="ml-auto">
                    <button id="export-csv" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg">
                        Export to CSV
                    </button>
                </div>
            </div>
            
            <!-- Feedback Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Feedback</p>
                            <p class="text-xl font-bold">{{ count($feedback) ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Average Rating</p>
                            <p class="text-xl font-bold">4.2</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Positive Feedback</p>
                            <p class="text-xl font-bold">76%</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Negative Feedback</p>
                            <p class="text-xl font-bold">24%</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feedback List -->
            <div class="overflow-x-auto">
                <table id="feedback-table" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($feedback as $item)
                            <tr data-event-id="{{ $item->event_id }}" data-rating="{{ $item->rating }}" data-date="{{ $item->created_at->format('Y-m-d') }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $item->event->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $item->user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-yellow-500">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $item->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-md">{{ $item->comment }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No feedback found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $feedback->links('paginate') }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eventFilter = document.getElementById('event-filter');
            const ratingFilter = document.getElementById('rating-filter');
            const dateFilter = document.getElementById('date-filter');
            const feedbackRows = document.querySelectorAll('#feedback-table tbody tr');
            
            // Filter feedback based on selected criteria
            function filterFeedback() {
                const eventValue = eventFilter.value;
                const ratingValue = ratingFilter.value;
                const dateValue = dateFilter.value;
                
                feedbackRows.forEach(row => {
                    if (row.querySelector('td') === null) return; // Skip "No feedback found" row
                    
                    const eventId = row.getAttribute('data-event-id');
                    const rating = row.getAttribute('data-rating');
                    const date = row.getAttribute('data-date');
                    
                    // Date filtering logic
                    let dateMatch = true;
                    if (dateValue) {
                        const feedbackDate = new Date(date);
                        const today = new Date();
                        const daysDiff = Math.floor((today - feedbackDate) / (1000 * 60 * 60 * 24));
                        
                        if (dateValue === 'today' && daysDiff > 0) {
                            dateMatch = false;
                        } else if (dateValue === 'week' && daysDiff > 7) {
                            dateMatch = false;
                        } else if (dateValue === 'month' && daysDiff > 30) {
                            dateMatch = false;
                        } else if (dateValue === 'year' && daysDiff > 365) {
                            dateMatch = false;
                        }
                    }
                    
                    // Check if row matches all filters
                    const eventMatch = !eventValue || eventId === eventValue;
                    const ratingMatch = !ratingValue || rating === ratingValue;
                    
                    if (eventMatch && ratingMatch && dateMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            // Add event listeners to filters
            eventFilter.addEventListener('change', filterFeedback);
            ratingFilter.addEventListener('change', filterFeedback);
            dateFilter.addEventListener('change', filterFeedback);
            
            // Export to CSV functionality
            document.getElementById('export-csv').addEventListener('click', function() {
                // Get visible rows
                const visibleRows = Array.from(feedbackRows).filter(row => row.style.display !== 'none' && row.querySelector('td') !== null);
                
                if (visibleRows.length === 0) {
                    alert('No data to export');
                    return;
                }
                
                // Create CSV content
                let csvContent = 'Event,User,Rating,Comment,Date\n';
                
                visibleRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const eventName = cells[0].textContent.trim().replace(/,/g, ' ');
                    const userName = cells[1].textContent.trim().replace(/,/g, ' ');
                    const rating = row.getAttribute('data-rating');
                    const comment = cells[3].textContent.trim().replace(/,/g, ' ').replace(/\n/g, ' ');
                    const date = cells[4].textContent.trim();
                    
                    csvContent += `"${eventName}","${userName}",${rating},"${comment}","${date}"\n`;
                });
                
                // Create download link
                const encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
                const link = document.createElement('a');
                link.setAttribute('href', encodedUri);
                link.setAttribute('download', 'feedback_export.csv');
                document.body.appendChild(link);
                
                // Trigger download
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
</x-admin-layout> 