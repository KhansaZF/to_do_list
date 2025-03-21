<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-cover bg-center" 
          style="background-image: url('{{ asset('storage/images/register.jpg') }}');">

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-[#B1E4EA] via-[#85A1AE] to-[#EDF8F9] bg-opacity-80 backdrop-blur-md">
            <!-- Logo -->
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#85A1AE]" />
                </a>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/40 shadow-lg rounded-lg backdrop-blur-md border border-[#85A1AE]">
                {{ $slot }}
            </div>
        </div>

    </body>
</html>
