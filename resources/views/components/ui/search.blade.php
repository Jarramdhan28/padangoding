@props([
    'placeholder' => 'Cari data...',
    'model' => 'search',
    'onInput' => '',
])

<div class="relative w-full">
    <div class="flex items-center border border-gray-200/50 rounded-lg bg-gray-50 px-2">
        <div class="text-gray-400 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        <input type="search" x-model.debounce.1000ms="{{ $model }}" @input="{{ $onInput }}"
            class="w-full bg-transparent rounded-lg px-3 border-0 text-sm text-gray-600 placeholder:text-xs focus:outline-none focus:ring-0"
            placeholder="{{ $placeholder }}">
    </div>
</div>
