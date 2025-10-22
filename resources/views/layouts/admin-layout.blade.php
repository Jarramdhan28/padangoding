<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-html.head>
    @slot('title', $title)
</x-html.head>

<body class="font-mona" x-data="{ openSidebar: false }" x-cloak>
    <!-- sidebar component -->
    <x-template.sidebar />
    <!-- overlay blur when opening sidebar in mobile  -->
    <div x-show="openSidebar" x-transition.opacity x-cloak @click="openSidebar = false"
        class="fixed inset-0 bg-white/30 backdrop-blur-xs z-30 lg:hidden"></div>
    <!-- main content -->
    <main class="lg:ml-60 h-auto" @click.outside="openSidebar = false">
        {{ $slot }}
    </main>
</body>

</html>
