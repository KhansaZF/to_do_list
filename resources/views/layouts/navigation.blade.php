<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#45444C]">
    <nav class="bg-[#45444C] text-gray-300 shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo & Menu -->
            <div class="flex items-center space-x-4">
                
                
                
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold hover:text-gray-700">Dashboard</a>
                <a href="{{ route('todo.index') }}" class="text-lg font-semibold hover:text-gray-700">To-Do List</a>
            </div>

            <!-- Dropdown User -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 hover:text-gray-700 focus:outline-none">
                    <span class="text-lg font-semibold">{{ Auth::user()->name }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white text-gray-900 rounded-md shadow-lg py-2">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>