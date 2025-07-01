<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Price Configurator App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CDN (optional, skip if already using Vite) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Livewire styles --}}
    @livewireStyles

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind Config (Optional Enhancement) --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#2563eb', // Tailwind blue-600
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-white text-gray-900 font-sans">

{{-- Navbar --}}
<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-primary">🧮 Price Configurator App</h1>
    </div>
</header>

{{-- Main Content --}}
<main class="py-10 px-4">
    <div class="max-w-4xl mx-auto space-y-6 bg-white shadow-xl rounded-2xl p-8">
        {{ $slot }}
    </div>
</main>
{{-- Footer --}}
<footer class="text-center py-6 text-sm text-gray-500">
    © {{ date('Y') }} Price Configurator App. Built with ❤️ + Livewire.
    <a href="https://github.com/MrWasimAbbasi" target="_blank" class="text-primary hover:underline font-medium">GitHub</a>
</footer>


@livewireScripts
</body>
</html>
