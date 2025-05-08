@vite(['resources/css/app.css'])

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="flex justify-between items-center bg-light py-4 px-6 border-b border-blue-gray w-full">
    <!-- Logo -->
    <a href="{{ route('stud.home') }}" class="text-xl font-bold text-primary">KeyEvents</a>

    <!-- Navigation Links -->
    <div class="flex space-x-8">
        <a href="{{ route('stud.home') }}" class="text-text hover:text-primary">Events</a>
        
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-text hover:text-primary">Admin Dashboard</a>
            @elseif(auth()->user()->isOrganizer())
                <a href="{{ route('dashboard') }}" class="text-text hover:text-primary">Organizer Dashboard</a>
            @elseif(auth()->user()->isStudent())
                <a href="{{ route('stud.dashboard') }}" class="text-text hover:text-primary">My Dashboard</a>
            @endif
            
            @if(auth()->user()->isAdmin())
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-text hover:text-primary flex items-center">
                        Admin
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-light rounded-md shadow-lg z-10">
                        <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-sm text-text hover:bg-blue-gray">User Management</a>
                        <a href="{{ route('admin.reports') }}" class="block px-4 py-2 text-sm text-text hover:bg-blue-gray">Reports</a>
                        <a href="{{ route('admin.edit') }}" class="block px-4 py-2 text-sm text-text hover:bg-blue-gray">Edit</a>
                    </div>
                </div>
            @endif
        @endauth
    </div>

    <!-- Auth Buttons -->
    <div class="flex items-center space-x-4">
        @auth
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center text-text focus:outline-none">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-light rounded-md shadow-lg z-10">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-text hover:bg-blue-gray">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-text hover:bg-blue-gray">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="text-text hover:text-primary">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-primary hover:bg-dark text-light py-2 px-4 rounded-md">Register</a>
            @endif
        @endauth
    </div>
</div>




