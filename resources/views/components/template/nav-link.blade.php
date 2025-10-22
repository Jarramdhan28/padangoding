@props(['Active', 'href'])

@php
    $classes =
        $active ?? false
            ? 'text-sm px-2 py-2 rounded-lg hover:text-gray-950 text-gray-600 transition-all duration-500 ease-in-out group bg-green-100/50'
            : 'text-sm px-2 py-2 rounded-lg hover:text-gray-950 text-gray-600 transition-all duration-500 ease-in-out group';
@endphp

@isset($href)
    <a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }} href="#">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endisset
