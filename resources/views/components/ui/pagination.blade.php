@props([
    'currentPage' => 'page.currentPage',
    'lastPage' => 'page.lastPage',
    'perPage' => 'page.perPage',
    'total' => 'page.total',
    'onPrev' => 'fetchResults(page.currentPage - 1)',
    'onNext' => 'fetchResults(page.currentPage + 1)',
])

<div x-cloak class="flex flex-col md:flex-row justify-between gap-4 mt-4 items-center" x-show="{{ $lastPage }} > 1">
    <span class="text-sm text-gray-600">
        Menampilkan
        <span x-text="({{ $perPage }} * ({{ $currentPage }} - 1)) + 1"></span>
        -
        <span x-text="Math.min({{ $currentPage }} * {{ $perPage }}, {{ $total }})"></span>
        data dari <span x-text="{{ $total }}"></span> data
    </span>

    <div class="space-x-2">
        <button @click="{{ $onPrev }}"
            class="p-2 bg-gray-200 border border-gray-300/50 hover:bg-gray-300/80 rounded disabled:opacity-40 disabled:cursor-not-allowed"
            :disabled="{{ $currentPage }} === 1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>

        <span class="text-sm text-gray-600">
            Page <span x-text="{{ $currentPage }}"></span>
            of <span x-text="{{ $lastPage }}"></span>
        </span>

        <button @click="{{ $onNext }}"
            class="p-2 bg-gray-200 border border-gray-300/50 hover:bg-gray-300/80 rounded disabled:opacity-40 disabled:cursor-not-allowed"
            :disabled="{{ $currentPage }} === {{ $lastPage }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>
</div>
