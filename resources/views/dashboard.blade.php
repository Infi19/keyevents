<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-island class="mb-4">
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

