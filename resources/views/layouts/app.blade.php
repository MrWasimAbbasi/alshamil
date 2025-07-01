<head>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- if using Vite --}}
    @livewireStyles
</head>
<body>
{{ $slot ?? '' }}
@livewireScripts
</body>
