<meta name="viewport" content="width=device-width, initial-scale=1.0">
<x-header></x-header>

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
            <tr class="border-t">
                <td class="px-4 py-2">Apple MacBook Pro 17"</td>
                <td class="px-4 py-2">Silver</td>
                <td class="px-4 py-2">Laptop</td>
                
                <td class="px-4 py-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-green-600 hover:underline">Add to Gallery</a>
                </td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">Microsoft Surface Pro</td>
                <td class="px-4 py-2">White</td>
                <td class="px-4 py-2">Laptop PC</td>
                
                <td class="px-4 py-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-green-600 hover:underline">Add to Gallery</a>
                </td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">Magic Mouse 2</td>
                <td class="px-4 py-2">Black</td>
                <td class="px-4 py-2">Accessories</td>
               
                <td class="px-4 py-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-green-600 hover:underline">Add to Gallery</a>
                </td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">Google Pixel Phone</td>
                <td class="px-4 py-2">Gray</td>
                <td class="px-4 py-2">Phone</td>
               
                <td class="px-4 py-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-green-600 hover:underline">Add to Gallery</a>
                </td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">Apple Watch 5</td>
                <td class="px-4 py-2">Red</td>
                <td class="px-4 py-2">Wearables</td>
               
                <td class="px-4 py-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="text-green-600 hover:underline">Add to Gallery</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</x-island>
<x-footer></x-footer>

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
