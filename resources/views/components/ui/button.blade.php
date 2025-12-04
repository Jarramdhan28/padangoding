@props([
    'href' => null,
    'variant' => 'primary',
    'type' => 'submit',
    'size' => 'md',
])

@php
    $baseClasses =
        'focus:outline-none rounded-md focus:z-10 focus:ring-4 transition disabled:opacity-50 disabled:cursor-not-allowed';
    $variants = [
        'primary' => 'bg-black text-white border border-black hover:bg-gray-800',
        'outline' => 'border border-gray-300 hover:bg-gray-100 hover:text-gray-600 focus:ring-gray-100',
        'danger' => 'bg-red-600 border border-red-600 text-white hover:bg-red-700',
    ];
    $sizes = [
        'sm' => 'px-2.5 py-1.5 text-xs',
        'md' => 'px-3 py-2 text-sm',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $isLink = isset($href) || $attributes->has('x-bind:href');
@endphp

@if ($isLink)
    <a {{ $attributes->merge(['href' => $href, 'class' => "$baseClasses $sizeClass $variantClass"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => "$baseClasses $sizeClass $variantClass"]) }}>
        {{ $slot }}
    </button>
@endif
