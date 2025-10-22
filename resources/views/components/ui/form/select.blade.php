@props(['disabled' => false, 'multiple' => false])

<select {{ $disabled ? 'disabled' : '' }} {{ $multiple ? 'multiple' : '' }} {!! $attributes->merge([
    'class' => 'border border-gray-300 rounded-lg px-3 py-2 w-full text-sm placeholder:text-xs text-gray-700 outline-0',
]) !!}>
    {{ $slot }}
</select>
