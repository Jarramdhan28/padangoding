@props(['Active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-2 text-md p-2.5 rounded-lg hover:bg-gray-200/70 group bg-gray-200/60'
            : 'flex items-center gap-2 text-md p-2.5 rounded-lg hover:bg-gray-200/50 group';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }} href="#">
    {{ $slot }}
</a>
