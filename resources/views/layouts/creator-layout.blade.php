<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-html.head>
    @slot('title', $title)
</x-html.head>

<body class="font-mona">
    <x-template.creator-navbar />
    {{ $slot }}
    <x-html.script />
</body>

</html>
