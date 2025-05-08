<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Key Events</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .nav-link {
            padding: 1.25rem 1rem;
            font-weight: 500;
            color: #4B5563;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover, .nav-link.active {
            color: #1F2937;
            border-bottom-color: #4F46E5;
        }
        
        .main-header {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #E5E7EB;
        }
    </style>
</head>
<body class="font-sans antialiased h-full">
    <div class="min-h-screen bg-gray-50">
        <!-- Main Header -->
        <header class="bg-white fixed top-0 left-0 right-0 z-50 main-header">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between">
                    <!-- Logo and Navigation Links -->
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex items-center mr-8">
                            <img src="{{ asset('images/kslogo.png') }}" alt="College Logo" class="h-10 w-auto mr-2">
                            <div class="text-lg font-semibold text-gray-900">Key Events</div>
                        </div>
                        
                        <!-- Navigation Links - Desktop -->
                        <div class="hidden md:flex">
                            <a href="{{ route('organizer.dashboard') }}" class="nav-link {{ request()->routeIs('organizer.dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('setup.form') }}" class="nav-link {{ request()->routeIs('setup.form') ? 'active' : '' }}">Create Event</a>
                            <a href="{{ route('organizer.my-events') }}" class="nav-link {{ request()->routeIs('organizer.my-events') ? 'active' : '' }}">My Events</a>
                            <a href="{{ route('organizer.registrations') }}" class="nav-link {{ request()->routeIs('organizer.registrations*') ? 'active' : '' }}">Registrations</a>
                            <a href="{{ route('organizer.media.overview') }}" class="nav-link {{ request()->routeIs('organizer.media*') || request()->routeIs('organizer.event.media*') ? 'active' : '' }}">Media Gallery</a>
                            <a href="#" class="nav-link">Certificates</a>
                            <a href="#" class="nav-link">Settings</a>
                        </div>
                    </div>
                    
                    <!-- Auth Buttons - Desktop -->
                    <div class="hidden md:flex items-center">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                                <div class="mr-2 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="mr-1 text-gray-700">Tech Club Organizer</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg z-10">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button type="button" class="mobile-menu-button text-gray-600" x-data="{}" @click="$dispatch('toggle-mobile-menu')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Mobile Menu -->
        <div class="md:hidden fixed top-16 left-0 right-0 z-40 bg-white shadow-lg" 
             x-data="{ isOpen: false }" 
             x-show="isOpen" 
             @toggle-mobile-menu.window="isOpen = !isOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             style="display: none;">
            <div class="py-2">
                <a href="{{ route('organizer.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('organizer.dashboard') ? 'bg-gray-100' : '' }}">Dashboard</a>
                <a href="{{ route('setup.form') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('setup.form') ? 'bg-gray-100' : '' }}">Create Event</a>
                <a href="{{ route('organizer.my-events') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('organizer.my-events') ? 'bg-gray-100' : '' }}">My Events</a>
                <a href="{{ route('organizer.registrations') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('organizer.registrations*') ? 'bg-gray-100' : '' }}">Registrations</a>
                <a href="{{ route('organizer.media.overview') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('organizer.media*') || request()->routeIs('organizer.event.media*') ? 'bg-gray-100' : '' }}">Media Gallery</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Certificates</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</button>
                </form>
            </div>
        </div>
        
        <!-- Spacer to prevent content from being hidden under fixed header -->
        <div class="h-16"></div>
        
        <!-- Main Content -->
        <main class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            @yield('content')
        </main>
    </div>
    
    <!-- Alpine.js (for dropdowns and mobile menu) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html> 