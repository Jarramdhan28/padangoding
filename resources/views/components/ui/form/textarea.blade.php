@props(['disabled' => false, 'value' => ''])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border bg-white border-gray-300 rounded-lg px-3 py-2 w-full text-sm focus:ring-gray-300 placeholder:text-xs text-gray-700 outline-0',
]) !!}>{{ $value }}</textarea>
