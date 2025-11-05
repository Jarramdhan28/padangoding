<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-html.head>
    @slot('title', $title)
</x-html.head>

<body class="font-mona">
    {{ $slot }}

    <x-html.script />
</body>

</html>
