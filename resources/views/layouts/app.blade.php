<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Madrasah Diniyah') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden; /* Mencegah scroll horizontal karena ornamen hero */
        }
        h1, h2, h3, h4, .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="antialiased text-gray-900 bg-[#FDFDFD]">
    
    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>