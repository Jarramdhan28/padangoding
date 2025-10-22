@props([
    'variant' => 'primary',
])

@php
    $baseClasses = 'inline-block text-xs px-2.5 py-0.5 rounded-full transition ease-in-out duration-150';
    $variants = [
        'primary' => 'border border-gray-300 text-gray-600 bg-gray-50',
        'success' => 'bg-green-50 border border-green-500 text-green-500',
        'danger' => 'bg-red-50 border border-red-500 text-red-500',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp
<span {{ $attributes->merge(['class' => "$baseClasses $variantClass"]) }}>
    {{ $slot }}
</span>
