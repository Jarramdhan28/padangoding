<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} - Padangoding
        @else
            Padangoding
        @endisset
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- chopper css -->
    <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Global CSS -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{ $slot }}
</head>
