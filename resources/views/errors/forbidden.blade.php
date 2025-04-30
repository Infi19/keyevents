@vite(['resources/css/app.css'])

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - EventHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-header></x-header>

    <div class="max-w-5xl mx-auto px-6 py-16 text-center">
        <div class="bg-white p-12 rounded-lg shadow-sm">
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-4V8a3 3 0 00-3-3H6a3 3 0 00-3 3v1m4-2h16a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-1" />
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Access Denied</h1>
            
            <p class="text-lg text-gray-600 mb-8">
                Sorry, you don't have permission to access this page. This area is restricted to users with higher privileges.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('stud.home') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg">
                    Go to Homepage
                </a>
                
                <a href="javascript:history.back()" class="border border-gray-300 bg-white text-gray-800 hover:bg-gray-50 font-medium px-6 py-3 rounded-lg">
                    Go Back
                </a>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html> 