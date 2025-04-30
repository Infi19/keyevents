<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Events -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Events</p>
                    <h3 class="text-2xl font-bold mt-1">156</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-green-500 font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    12% increase
                </span>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Users</p>
                    <h3 class="text-2xl font-bold mt-1">2,451</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-green-500 font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    8% increase
                </span>
            </div>
        </div>

        <!-- Registrations This Month -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Registrations This Month</p>
                    <h3 class="text-2xl font-bold mt-1">143</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-green-500 font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    15% increase
                </span>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pending Approvals</p>
                    <h3 class="text-2xl font-bold mt-1">8</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-red-500 font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                    3 new today
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Events (Takes up 2/3 of the space) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-lg text-gray-800">Recent Events</h3>
                    <a href="{{ route('admin.events') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organizer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Tech Summit 2023</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">CS Club</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Nov 15, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Leadership Workshop</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Business Society</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Oct 28, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Art Exhibition</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Fine Arts Club</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Oct 25, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Coding Competition</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">CS Club</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Oct 18, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Completed
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Career Fair</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Career Center</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Oct 12, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Completed
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Activities (Takes up 1/3 of the space) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 h-full">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800">Recent Activities</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <!-- Activity Item 1 -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">JD</div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">John Doe created a new event</p>
                                <p class="text-xs text-gray-500 mt-1">Tech Summit 2023</p>
                                <p class="text-xs text-gray-400 mt-1">10 minutes ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 2 -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm font-medium">AS</div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Alice Smith approved an event</p>
                                <p class="text-xs text-gray-500 mt-1">Leadership Workshop</p>
                                <p class="text-xs text-gray-400 mt-1">45 minutes ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center text-white text-sm font-medium">RJ</div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Robert Johnson registered</p>
                                <p class="text-xs text-gray-500 mt-1">New organizer account</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 4 -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center text-white text-sm font-medium">EW</div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Emily Williams submitted an event</p>
                                <p class="text-xs text-gray-500 mt-1">Art Exhibition for approval</p>
                                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 5 -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center text-white text-sm font-medium">MJ</div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Michael Johnson updated settings</p>
                                <p class="text-xs text-gray-500 mt-1">Changed registration deadline</p>
                                <p class="text-xs text-gray-400 mt-1">Yesterday at 4:30 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Assignment Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-semibold text-lg text-gray-800">Quick Role Assignment</h3>
            <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:underline">Manage All Users</a>
        </div>
        <div class="p-6">
            <form id="quick-role-form" method="POST" action="{{ route('admin.quick-role-update') }}">
                @csrf
                <div class="mb-4">
                    <div class="flex space-x-4">
                        <div class="w-full max-w-md">
                            <label for="user-email" class="block text-sm font-medium text-gray-700 mb-1">User Email</label>
                            <input type="email" id="user-email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Enter user email" required>
                        </div>
                        <div class="w-56">
                            <label for="role-select" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <select id="role-select" name="role" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="student">Student</option>
                                <option value="organizer">Organizer</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg">
                    Update Role
                </button>
            </form>
            
            @if(session('role-success'))
                <div class="mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                    <p>{{ session('role-success') }}</p>
                </div>
            @endif
            
            @if(session('role-error'))
                <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                    <p>{{ session('role-error') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout> 