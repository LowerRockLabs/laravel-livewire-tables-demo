@props(['displayStyle' => 'popover'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bootstrap 5 Livewire Tables</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
        [x-cloak] {
            display: none !important;
        }

        .bg-gray {
            background-color: grey;
        }

        .bg-white {
            background-color: white;
        }
    </style>
    @vite(['resources/js/app.js'])

</head>

<body>
    <div class="container-fluid">
        <div class="px-4 my-5 text-center">
            <img class="mx-auto mb-4 d-block" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57" />
                <p class="lead">
                    Bootstrap 5 Implementation - 
                    <a href="https://gist.github.com/rappasoft/948adf542307b8f620d53c7c7e735d3c" target="_blank">
                        Gist
                    </a>
                </p>
        </div>

        <div>
            <div wire:key="otherComponent">
                <livewire:other-component />
            </div>
        <div>

        {{ $slot }}

        </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @stack('scripts')
        @livewireScriptConfig 

    </div>

</body>

</html>
