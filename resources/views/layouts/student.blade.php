<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EventHub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    <style>
        .sidebar-active {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(59, 130, 246);
            border-left: 3px solid rgb(59, 130, 246);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Student Sidebar -->
        <div class="flex">
            <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-md z-10">
                <!-- Logo -->
                <div class="flex items-center h-16 px-6 border-b">
                    <h1 class="text-xl font-bold">EventHub</h1>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-6">
                    <ul>
                        <li>
                            <a href="{{ route('stud.home') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('stud.home') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('my.events') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('my.events') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                My Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('certificates') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('certificates') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Certificates
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('notifications') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('notifications') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Notifications
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('profile.edit') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- User Profile -->
                <div class="absolute bottom-0 w-full border-t p-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-800">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ Auth::user()->name ?? 'John Doe' }}</p>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-xs text-gray-500 hover:underline">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="ml-64 flex-1 p-8">
                <!-- User Header -->
                <div class="flex justify-end mb-6">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'John Doe' }}</span>
                        <div class="ml-2 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-800">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                    </div>
                </div>
                
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html> 