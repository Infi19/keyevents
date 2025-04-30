<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Organizer Dashboard') }}
            </h2>
            <a href="{{ route('setup.form') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-island class="mb-4">
                    @if(auth()->user()->isOrganizer())
                    <!-- Organizer Dashboard -->
                    <div class="p-6">
                        <!-- Stats Overview -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <!-- Total Events -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Total Events</p>
                                        <h3 class="text-2xl font-bold mt-1">{{ $stats['total_events'] ?? 0 }}</h3>
                                    </div>
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Approved Events -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Approved Events</p>
                                        <h3 class="text-2xl font-bold mt-1">{{ $stats['approved_events'] ?? 0 }}</h3>
                                    </div>
                                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Events -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Pending Events</p>
                                        <h3 class="text-2xl font-bold mt-1">{{ $stats['pending_events'] ?? 0 }}</h3>
                                    </div>
                                    <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Participants -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Total Participants</p>
                                        <h3 class="text-2xl font-bold mt-1">{{ $stats['total_participants'] ?? 0 }}</h3>
                                    </div>
                                    <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-8">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="font-semibold text-lg text-gray-800">Quick Actions</h3>
                            </div>
                            <div class="p-6 flex flex-wrap gap-4">
                                <a href="{{ route('setup.form') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Create New Event
                                </a>
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    View Registrations
                                </a>
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Export Reports
                                </a>
                            </div>
                        </div>

                        <!-- Recent Events Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-8">
                            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                                <h3 class="font-semibold text-lg text-gray-800">Recent Events</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @if(isset($stats['recent_events']) && count($stats['recent_events']) > 0)
                                            @foreach($stats['recent_events'] as $event)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="font-medium text-gray-900">{{ $event->title }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $event->event_date ? $event->event_date->format('M d, Y') : 'N/A' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($event->status == 'approved')
                                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Approved
                                                            </span>
                                                        @elseif($event->status == 'pending')
                                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Pending
                                                            </span>
                                                        @elseif($event->status == 'rejected')
                                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Rejected
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                {{ $event->status ?? 'Unknown' }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="flex space-x-2">
                                                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                            <a href="#" class="text-green-600 hover:text-green-900">View Registrations</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                    No events found
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="mb-4">
                        <!-- Search Input -->
                        <input
                            type="text"
                            id="searchInput"
                            class="w-full max-w-xs p-2 border border-gray-300 rounded-md"
                            placeholder="Search..."
                            onkeyup="searchTable()"
                        />
                    </div>
                    
                    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                        <table id="sortableTable" class="min-w-full table-auto" data-sort-order="asc">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-left cursor-pointer" onclick="sortTable(0, false)">Title</th>
                                    <th class="px-4 py-2 text-left cursor-pointer" onclick="sortTable(1, false)">Type</th>
                                    <th class="px-4 py-2 text-left cursor-pointer" onclick="sortTable(2, false)">Category</th>
                                    <th class="px-4 py-2 text-left">Edit</th>
                                    <th class="px-4 py-2 text-left">Delete</th>
                                    <th class="px-4 py-2 text-left">Add to Gallery</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $event->title }}</td>
                                        <td class="px-4 py-2">{{ $event->type }}</td>
                                        <td class="px-4 py-2">{{ $event->category }}</td>
                                        
                                        <td class="px-4 py-2">
                                            {{-- <a href="{{ route('events.edit', $event->id) }}" class="text-blue-600 hover:underline">Edit</a> --}}
                                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                                        </td>
                                        <td class="px-4 py-2">
                                            <form href="#" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="#" class="text-green-600 hover:underline">Add to Gallery</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="mt-6 mb-10  ">
                        {{ $events->appends(request()->query())->links('paginate') }}
                    </div>
                    @endif
                    </x-island>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // Sorting function for ascending and descending order
    function sortTable(columnIndex, isNumeric) {
        const table = document.getElementById("sortableTable");
        const rows = Array.from(table.rows).slice(1); // Skip header row
        const isAscending = table.getAttribute("data-sort-order") === "asc";

        rows.sort((rowA, rowB) => {
            const cellA = rowA.cells[columnIndex].textContent.trim();
            const cellB = rowB.cells[columnIndex].textContent.trim();

            if (isNumeric) {
                return isAscending
                    ? parseFloat(cellA) - parseFloat(cellB)
                    : parseFloat(cellB) - parseFloat(cellA);
            } else {
                return isAscending
                    ? cellA.localeCompare(cellB)
                    : cellB.localeCompare(cellA);
            }
        });

        // Clear table and append sorted rows
        rows.forEach(row => table.appendChild(row));

        // Toggle sort order for the next click
        table.setAttribute("data-sort-order", isAscending ? "desc" : "asc");
    }

    // Search function to filter rows based on user input
    function searchTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("sortableTable");
        const rows = Array.from(table.rows).slice(1); // Skip header row
        
        rows.forEach(row => {
            let textContent = '';
            // Concatenate all cell texts in the row for search comparison
            Array.from(row.cells).forEach(cell => {
                textContent += cell.textContent.trim().toLowerCase() + ' ';
            });

            // If the row text contains the search term, show it, otherwise hide it
            if (textContent.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

