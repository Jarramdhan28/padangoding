@props([
    'href' => null,
    'variant' => 'primary',
    'type' => 'submit',
])

@php
    $baseClasses = 'px-3 py-2 text-sm focus:outline-none rounded-lg focus:z-10 focus:ring-4 transition';
    $variants = [
        'primary' => 'bg-black text-white border border-black hover:bg-gray-800',
        'outline' => 'border border-gray-300 hover:bg-gray-100 hover:text-gray-600 focus:ring-gray-100',
        'danger' => 'bg-red-600 border border-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $isLink = isset($href) || $attributes->has('x-bind:href');
@endphp

@if ($isLink)
    <a {{ $attributes->merge(['href' => $href, 'class' => "$baseClasses $variantClass"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => "$baseClasses $variantClass"]) }}>
        {{ $slot }}
    </button>
@endif
