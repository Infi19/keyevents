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
        <!-- Admin Sidebar -->
        <div class="flex">
            <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-md z-10">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-6 border-b">
                    <h1 class="text-xl font-bold">EventHub</h1>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-6">
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.events') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.events*') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.users*') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.clubs') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.clubs*') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Clubs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.announcements') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.announcements*') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                Announcements
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.settings*') ? 'sidebar-active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- User Profile -->
                <div class="absolute bottom-0 w-full border-t p-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-800">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <div class="flex items-center">
                                <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Admin User' }}</p>
                                <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Admin</span>
                            </div>
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
                <!-- Page Header -->
                @isset($header)
                    <header class="mb-6">
                        {{ $header }}
                    </header>
                @endisset
                
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html> 