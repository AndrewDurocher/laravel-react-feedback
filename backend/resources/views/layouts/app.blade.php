<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LilYPad POS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gradient-to-r from-green-600 to-green-700 shadow-lg">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center">
                <div class="text-4xl mr-3">🐸</div>
                <div>
                    <h1 class="text-3xl font-bold text-white">LilYPad POS</h1>
                    <p class="text-green-100">Customer Feedback System</p>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white shadow-inner">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-gray-500">
                &copy; {{ date('Y') }} LilYPad POS. All rights reserved.
            </div>
        </footer>
    </div>
    
    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>