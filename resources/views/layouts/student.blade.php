<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Key Events') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Main Header - Desktop Only -->
        <header class="bg-white shadow fixed top-0 left-0 right-0 z-50 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <img src="{{ asset('images/kslogo.png') }}" alt="College Logo" class="h-10 w-auto mr-2">
                        <h1 class="text-xl font-bold">Key Events</h1>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="flex space-x-8">
                        <a href="{{ route('stud.home') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('stud.home') ? 'bg-gray-100' : '' }}">Home</a>
                        <a href="{{ route('my.events') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('my.events') ? 'bg-gray-100' : '' }}">My Events</a>
                        <a href="{{ route('certificates') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('certificates') ? 'bg-gray-100' : '' }}">Certificates</a>
                    </div>
                    
                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                                    <div class="mr-2 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-800">
                                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
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
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gray-800 hover:bg-gray-700 text-white py-2 px-4 rounded-md">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Mobile Menu -->
        <div class="md:hidden fixed top-0 left-0 right-0 z-50" x-data="{ open: false }">
            <div class="px-4 py-3 bg-white shadow">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('images/kslogo.png') }}" alt="College Logo" class="h-8 w-auto mr-2">
                        <h1 class="text-lg font-bold">Key Events</h1>
                    </div>
                    <button @click="open = !open" class="text-gray-500 focus:outline-none">
                        <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div x-show="open" class="bg-white shadow-lg">
                <a href="{{ route('stud.home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('stud.home') ? 'bg-gray-100' : '' }}">Home</a>
                <a href="{{ route('my.events') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('my.events') ? 'bg-gray-100' : '' }}">My Events</a>
                <a href="{{ route('certificates') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('certificates') ? 'bg-gray-100' : '' }}">Certificates</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('profile.edit') ? 'bg-gray-100' : '' }}">Profile</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Register</a>
                    @endif
                @endauth
            </div>
        </div>
        
        <!-- Spacer to prevent content from being hidden under fixed header -->
        <div class="h-16"></div>
        
        <!-- Main Content -->
        <main class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            {{ $slot }}
        </main>
    </div>
    
    <!-- Alpine.js (for dropdowns and mobile menu) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html> 