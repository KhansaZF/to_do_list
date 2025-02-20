<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-900 text-gray-200">

    <!-- Hero Section -->
    <section class="relative flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-700 via-teal-500 to-blue-900">
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Floating Animations -->
        <div class="absolute top-10 left-10 w-16 h-16 bg-white bg-opacity-20 rounded-full animate-bounce"></div>
        <div class="absolute bottom-10 right-10 w-20 h-20 bg-white bg-opacity-20 rounded-full animate-pulse"></div>
        <div class="absolute top-1/4 left-1/3 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-spin"></div>
        <div class="absolute bottom-1/3 right-1/4 w-14 h-14 bg-white bg-opacity-15 rounded-full animate-bounce"></div>

        <div class="relative z-10 text-center text-white px-4 flex flex-col items-center">
            <h1 class="text-6xl font-extrabold leading-tight transition duration-300 hover:scale-105 hover:text-teal-300">
                Boost Your Productivity khansaaaaaaaaaaaaaaaaaa
            </h1>
            <p class="mt-4 text-lg text-gray-100">
                Stay organized and achieve more with your personalized To-Do List.
            </p>

            @if(Auth::check())
                <p class="mt-6 text-2xl font-semibold animate-pulse">
                    Welcome, <span class="text-teal-300 font-bold">{{ Auth::user()->name }}</span>!
                </p>
                <a href="{{ route('todo.index') }}" class="mt-4 px-8 py-4 bg-teal-600 text-white text-xl font-bold rounded-full 
                hover:bg-teal-700 hover:scale-105 transition-all duration-300 shadow-lg">
                    Go to Your Tasks
                </a>
            @else
                <div class="mt-6 flex space-x-4 justify-center">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white text-lg font-bold rounded-full 
                    hover:bg-blue-700 hover:scale-105 transition-all duration-300 shadow-lg">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-teal-600 text-white text-lg font-bold rounded-full 
                    hover:bg-teal-700 hover:scale-105 transition-all duration-300 shadow-lg">Register</a>
                </div>
            @endif
        </div>
    </section>

</body>
</html>
