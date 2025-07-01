<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Price Configurator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css') {{-- optional if using Vite --}}
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
<div class="min-h-screen py-8 px-4 max-w-7xl mx-auto">
    {{ $slot }}
</div>

@livewireScripts
</body>
</html>
