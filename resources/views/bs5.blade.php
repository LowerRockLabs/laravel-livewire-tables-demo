<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bootstrap 5 Livewire Tables</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha256-wLz3iY/cO4e6vKZ4zRmo4+9XDpMcgKOvv/zEU3OMlRo=" crossorigin="anonymous">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <livewire:styles />
    @stack('styles')

    <style>
        .bg-gray {
            background-color: grey;
        }

        .bg-white {
            background-color: white;
        }
    </style>


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    @include('includes.buttons')

    <div class="px-4 my-5 text-center">
        <img class="mx-auto mb-4 d-block" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg"
            alt="" width="72" height="57">
        <p class="lead">Bootstrap 5 Implementation - <a
                href="https://gist.github.com/rappasoft/948adf542307b8f620d53c7c7e735d3c" target="_blank">Gist</a></p>
    </div>

    <div class="container">
        <livewire:users-table theme="bootstrap-5" />
    </div>


    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha256-m81NDyncZVbr7v9E6qCWXwx/cwjuWDlHCMzi9pjMobA=" crossorigin="anonymous"></script>


    <livewire:scripts />

    @stack('scripts')

</body>

</html>
