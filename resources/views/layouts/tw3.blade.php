@props(['displayStyle' => 'popover'])
<!DOCTYPE html>
<html lang="en" 
    x-cloak
    x-data="{darkMode: localStorage.getItem('dark') === 'true'}"
    x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
    x-bind:class="{'dark': darkMode}"
>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tailwind 3 Tables</title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />

    @vite(['resources/js/app.js', 'resources/css/tailwind3.css'])

    @stack('styles')
        <style>
            [x-cloak] { display: none !important; }
        </style>
</head>

<body class="dark:bg-gray-900 dark:text-white" >

    <div>
    <div class="mb-8 text-center">
        <button x-cloak x-on:click="darkMode = !darkMode;">
            <span x-show="!darkMode" class="w-8 h-8 p-2 ml-3 text-gray-700 transition bg-gray-100 rounded-md cursor-pointer hover:bg-gray-200">Dark</span>
            <span x-show="darkMode" class="w-8 h-8 p-2 ml-3 text-gray-100 transition bg-gray-700 rounded-md cursor-pointer dark:hover:bg-gray-600">Light</span>
        </button>
    </div>

        <div class="pb-6 mx-auto space-y-10 w-full px-8">
            {{ $slot }}
        </div>
        @livewireScriptConfig 
        @stack('scripts')
    
    </div>
</body>

</html>
