@vite(['resources/css/app.css'])

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Management - EventHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50">
    <x-header></x-header>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                <p class="text-gray-600">Manage users and their roles within the platform</p>
            </div>
            
            <!-- Success message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-6 mt-6">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <div class="p-6">
                <!-- User Search & Filter -->
                <div class="flex flex-wrap gap-4 mb-6">
                    <div class="w-full md:w-64">
                        <input type="text" id="search-input" placeholder="Search users..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <select id="role-filter" class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="organizer">Organizer</option>
                            <option value="student">Student</option>
                        </select>
                    </div>

                    <div>
                        <select id="status-filter" class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="banned">Banned</option>
                        </select>
                    </div>
                    
                    <div class="ml-auto">
                        <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg inline-block">
                            Add New User
                        </a>
                    </div>
                </div>
                
                <!-- Users Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select data-user-id="{{ $user->id }}" class="role-select px-2 py-1 text-xs rounded-full border 
                                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 border-red-300' : 
                                              ($user->role === 'organizer' ? 'bg-blue-100 text-blue-800 border-blue-300' : 
                                              'bg-green-100 text-green-800 border-green-300') }}">
                                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                            <option value="organizer" {{ $user->role === 'organizer' ? 'selected' : '' }}>Organizer</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ isset($user->banned_at) ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ isset($user->banned_at) ? 'Banned' : 'Active' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button data-user-id="{{ $user->id }}" class="save-role hidden text-blue-600 hover:text-blue-900">Save</button>
                                            
                                            <form method="POST" action="{{ route('admin.users.toggle-ban', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-{{ isset($user->banned_at) ? 'green' : 'red' }}-600 hover:text-{{ isset($user->banned_at) ? 'green' : 'red' }}-900">
                                                    {{ isset($user->banned_at) ? 'Unban' : 'Ban' }}
                                                </button>
                                            </form>
                                            
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Example -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-500">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ $users->count() }}</span> users
                    </div>
                    <div class="flex space-x-1">
                        <button class="border border-gray-300 rounded-md px-3 py-1 bg-white text-gray-500">Previous</button>
                        <button class="border border-gray-300 rounded-md px-3 py-1 bg-white text-gray-500">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <!-- JavaScript for Role Management -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show save button when role is changed
            const roleSelects = document.querySelectorAll('.role-select');
            roleSelects.forEach(select => {
                select.addEventListener('change', function() {
                    const userId = this.getAttribute('data-user-id');
                    const saveButton = document.querySelector(`.save-role[data-user-id="${userId}"]`);
                    saveButton.classList.remove('hidden');
                    
                    // Update select styling based on selected role
                    const selectedRole = this.value;
                    this.className = 'role-select px-2 py-1 text-xs rounded-full border ';
                    if (selectedRole === 'admin') {
                        this.className += 'bg-red-100 text-red-800 border-red-300';
                    } else if (selectedRole === 'organizer') {
                        this.className += 'bg-blue-100 text-blue-800 border-blue-300';
                    } else {
                        this.className += 'bg-green-100 text-green-800 border-green-300';
                    }
                });
            });
            
            // Save role changes
            const saveButtons = document.querySelectorAll('.save-role');
            saveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const roleSelect = document.querySelector(`.role-select[data-user-id="${userId}"]`);
                    const newRole = roleSelect.value;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Create form and submit it
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/users/${userId}/role`;
                    form.style.display = 'none';
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PATCH';
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    
                    const roleInput = document.createElement('input');
                    roleInput.type = 'hidden';
                    roleInput.name = 'role';
                    roleInput.value = newRole;
                    
                    form.appendChild(methodInput);
                    form.appendChild(csrfInput);
                    form.appendChild(roleInput);
                    document.body.appendChild(form);
                    
                    form.submit();
                });
            });
            
            // Search and filter functionality
            const searchInput = document.getElementById('search-input');
            const roleFilter = document.getElementById('role-filter');
            const statusFilter = document.getElementById('status-filter');
            
            const filterTable = () => {
                const searchTerm = searchInput.value.toLowerCase();
                const roleValue = roleFilter.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();
                
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const role = row.querySelector('td:nth-child(3) select').value.toLowerCase();
                    const statusText = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
                    
                    const nameMatch = name.includes(searchTerm) || email.includes(searchTerm);
                    const roleMatch = roleValue === '' || role === roleValue;
                    const statusMatch = statusValue === '' || 
                                      (statusValue === 'active' && statusText === 'active') || 
                                      (statusValue === 'banned' && statusText === 'banned');
                    
                    if (nameMatch && roleMatch && statusMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            };
            
            searchInput.addEventListener('input', filterTable);
            roleFilter.addEventListener('change', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });
    </script>
</body>
</html> 