@props(['disabled' => false, 'checked' => false])

<input {{ $disabled ? 'disabled' : '' }} {{ $checked ? 'checked' : '' }} {!! $attributes->merge([
    'class' =>
        'border bg-white border-gray-300 rounded-lg px-3 py-2 w-full text-sm focus:ring-gray-400 placeholder:text-xs text-gray-700 outline-0',
]) !!}>
