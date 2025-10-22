@props(['disabled' => false, 'checked' => false])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {{ $checked ? 'checked' : '' }} {!! $attributes->merge([
    'class' => 'border border-gray-300 text-sm placeholder:text-xs text-gray-700 outline-0',
]) !!}>
