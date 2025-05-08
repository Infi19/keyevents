<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    
    <!-- Custom Styles for Sidebar -->
    <style>
        .sidebar {
            transition: width 0.3s ease-in-out;
            overflow: hidden;
            position: fixed;
            height: 100vh;
            z-index: 20;
        }
        
        .sidebar-collapsed {
            width: 5rem; /* Space for icons only */
        }
        
        .sidebar-expanded {
            width: 16rem; /* w-64 = 16rem */
        }
        
        .content-wrapper {
            transition: margin-left 0.3s ease-in-out;
        }
        
        .main-content-expanded {
            margin-left: 5rem; /* Match with sidebar-collapsed width */
        }
        
        .main-content-normal {
            margin-left: 16rem; /* w-64 = 16rem */
        }
        
        .sidebar-toggle {
            transition: transform 0.3s ease-in-out;
        }
        
        .sidebar-toggle-rotated {
            transform: rotate(180deg);
        }
        
        /* For sidebar collapsed state */
        .nav-item-text {
            transition: opacity 0.2s ease;
            white-space: nowrap;
        }
        
        .sidebar-collapsed .nav-item-text {
            opacity: 0;
            display: none;
        }
        
        .sidebar-collapsed .nav-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .sidebar-collapsed .nav-item {
            justify-content: center;
            width: 100%;
            padding: 0.75rem 0;
            margin-left: 0 !important;
        }
        
        .sidebar-collapsed .menu-icon {
            margin-right: 0 !important;
        }
        
        /* Center the logo and toggle in collapsed state */
        .sidebar-collapsed .sidebar-header h1 {
            display: none;
        }
        
        .sidebar-collapsed .sidebar-header {
            justify-content: center;
            padding: 1rem 0;
        }
        
        @media (max-width: 768px) {
            .sidebar-expanded {
                width: 16rem;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            }
            
            .sidebar-collapsed {
                width: 5rem;
            }
            
            .main-content-normal {
                margin-left: 0;
            }
            
            .main-content-expanded {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex relative">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar sidebar-expanded bg-white border-r border-gray-200 h-screen">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center sidebar-header">
                <div class="flex items-center">
                    <img src="{{ asset('images/kslogo.png') }}" alt="College Logo" class="h-10 w-auto mr-2">
                    <h1 class="text-xl font-bold">Key Events</h1>
                </div>
                <button id="sidebar-toggle" class="sidebar-toggle p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
            
            <nav class="mt-6">
                <div class="px-4 space-y-1 nav-content">
                    <a href="{{ route('organizer.dashboard') }}" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('organizer.dashboard') ? 'bg-gray-100' : '' }}" data-page-title="Dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="nav-item-text">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('setup.form') }}" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('setup.form') ? 'bg-gray-100' : '' }}" data-page-title="Create Event">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="nav-item-text">Create Event</span>
                    </a>
                    
                    <a href="{{ route('organizer.my-events') }}" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('organizer.my-events') ? 'bg-gray-100' : '' }}" data-page-title="My Events">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="nav-item-text">My Events</span>
                    </a>
                    
                    <a href="{{ route('organizer.registrations') }}" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('organizer.registrations*') ? 'bg-gray-100' : '' }}" data-page-title="Registrations">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="nav-item-text">Registrations</span>
                    </a>
                    
                    <a href="#" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md" data-page-title="Media Gallery">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="nav-item-text">Media Gallery</span>
                    </a>
                    
                    <a href="#" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md" data-page-title="Certificates">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="nav-item-text">Certificates</span>
                    </a>
                    
                    <a href="#" class="nav-item flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md" data-page-title="Settings">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="nav-item-text">Settings</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 content-wrapper main-content-normal">
            <!-- Top Bar -->
            <div class="bg-white border-b border-gray-200 px-6 py-3 flex justify-between items-center sticky top-0 z-10">
                <!-- Replace dynamic page title with Key Events name -->
                <h2 class="text-xl font-semibold text-gray-800">Key Events</h2>
                
                <div class="flex items-center">
                    <span class="mr-2">Tech Club Organizer</span>
                    <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const toggleIcon = sidebarToggle.querySelector('svg');
            
            // Check for saved sidebar state
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            
            // Set initial state based on saved preference
            if (sidebarCollapsed) {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('main-content-normal');
                mainContent.classList.add('main-content-expanded');
                toggleIcon.classList.add('sidebar-toggle-rotated');
            }
            
            // Add tooltips to menu items for collapsed sidebar
            const menuItems = document.querySelectorAll('.nav-item');
            menuItems.forEach(item => {
                const title = item.getAttribute('data-page-title');
                if (title) {
                    item.setAttribute('title', title);
                }
            });
            
            sidebarToggle.addEventListener('click', function() {
                // Toggle sidebar classes
                sidebar.classList.toggle('sidebar-collapsed');
                sidebar.classList.toggle('sidebar-expanded');
                
                // Toggle main content classes
                mainContent.classList.toggle('main-content-normal');
                mainContent.classList.toggle('main-content-expanded');
                
                // Toggle button icon rotation
                toggleIcon.classList.toggle('sidebar-toggle-rotated');
                
                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('sidebar-collapsed'));
            });
            
            // Handle responsive behavior
            function handleResize() {
                if (window.innerWidth < 768) { // Mobile breakpoint
                    if (!sidebar.classList.contains('sidebar-collapsed')) {
                        // On mobile, if sidebar is shown, don't apply margin to main content
                        mainContent.classList.remove('main-content-normal');
                        mainContent.classList.add('main-content-expanded');
                    }
                } else {
                    // On desktop, if sidebar is expanded, apply margin to main content
                    if (!sidebar.classList.contains('sidebar-collapsed')) {
                        mainContent.classList.add('main-content-normal');
                        mainContent.classList.remove('main-content-expanded');
                    }
                }
            }
            
            // Set initial responsive state
            handleResize();
            
            // Listen for window resize events
            window.addEventListener('resize', handleResize);
        });
    </script>
</body>
</html> 