<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'Laravel') }}</title>
 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.bunny.net">
 <link
href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
rel="stylesheet" />
 <!-- Scripts -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
 <div class="min-h-screen">
 <!-- Header -->
 <header class="bg-white shadow">
 <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
 <div class="flex justify-between items-center">
 <h1 class="text-3xl font-bold text-gray-900">
 Laravel Livewire project
 </h1>
<div class="text-sm text-gray-600">
 Gestion des Articles
 </div>
 </div>
 </div>
 </header>
 <!-- Main Content -->
 <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
 @yield('content')
 </main>
 </div>
 @livewireScripts

 <!-- Alpine.js for modal interactions -->
 <script defer
src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>