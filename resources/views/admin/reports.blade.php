@vite(['resources/css/app.css'])

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard - EventHub</title>
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
                <h1 class="text-2xl font-bold text-gray-900">Reports Dashboard</h1>
                <p class="text-gray-600">Analytics and insights about events and user activity</p>
            </div>
            
            <div class="p-6">
                <!-- Date Range Filter -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <div>
                        <select class="border border-gray-300 rounded-lg px-4 py-2 bg-white">
                            <option value="7days">Last 7 days</option>
                            <option value="30days">Last 30 days</option>
                            <option value="90days">Last 90 days</option>
                            <option value="year">Last year</option>
                            <option value="custom">Custom range</option>
                        </select>
                    </div>
                    
                    <div>
                        <button class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-lg">
                            Export Report
                        </button>
                    </div>
                </div>
                
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Total Users</h3>
                            <div class="p-2 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-baseline">
                            <p class="text-3xl font-bold text-gray-900">1,234</p>
                            <p class="ml-2 text-sm text-green-600">
                                +12.5%
                            </p>
                        </div>
                    </div>
                    
                    <!-- Total Events -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Total Events</h3>
                            <div class="p-2 bg-purple-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-baseline">
                            <p class="text-3xl font-bold text-gray-900">86</p>
                            <p class="ml-2 text-sm text-green-600">
                                +5.2%
                            </p>
                        </div>
                    </div>
                    
                    <!-- Event Registrations -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Registrations</h3>
                            <div class="p-2 bg-green-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-baseline">
                            <p class="text-3xl font-bold text-gray-900">3,426</p>
                            <p class="ml-2 text-sm text-green-600">
                                +18.3%
                            </p>
                        </div>
                    </div>
                    
                    <!-- Active Users -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Active Users</h3>
                            <div class="p-2 bg-orange-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-baseline">
                            <p class="text-3xl font-bold text-gray-900">586</p>
                            <p class="ml-2 text-sm text-red-600">
                                -2.1%
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Popular Events Table -->
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Most Popular Events</h2>
                <div class="overflow-x-auto mb-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registrations</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance Rate</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample Data -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Web Development Workshop</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Workshop
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Apr 25, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    156
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    92%
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Annual Cultural Fest</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Cultural
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    May 10, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    412
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    88%
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">AI & Future Tech Seminar</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Seminar
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    May 15, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    283
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    75%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- User Growth Chart Placeholder -->
                <h2 class="text-xl font-semibold text-gray-900 mb-4">User Growth</h2>
                <div class="bg-gray-100 border border-gray-200 rounded-lg p-6 flex items-center justify-center h-72 mb-6">
                    <p class="text-gray-500">User Growth Chart Placeholder</p>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html> 