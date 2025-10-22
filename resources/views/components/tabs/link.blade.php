@props(['Active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-2 text-sm px-6 shadow-xs py-1 rounded-lg bg-white hover:bg-gray-50 transition-all duration-300 ease-in-out'
            : 'flex items-center gap-2 text-sm px-6 py-1 rounded-lg hover:bg-gray-200/70 transition-all duration-300 ease-in-out';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }} href="#">
    {{ $slot }}
</a>
