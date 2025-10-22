@php
    $iconMapping = [
        'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>',
        'referensi' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 17.25v-.228a4.5 4.5 0 00-.12-1.03l-2.268-9.64A3.375 3.375 0 0016.077 3.75H7.923a3.375 3.375 0 00-3.285 2.602l-2.268 9.64a4.5 4.5 0 00-.12 1.03v.228M21.75 17.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3m19.5 0a3 3 0 00-3-3H5.25a3 3 0 00-3 3" />
                    </svg>',
        'users' =>
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"><path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>',
        'user' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>',
    ];
@endphp

<nav class="flex justify-between items-center h-16 md:h-14 px-4 border-b border-gray-100 md:border-0">
    <div class="text-xs w-full">
        <nav class="flex items-center gap-4 flex-wrap">
            <div class="lg:hidden">
                <button @click="openSidebar = !openSidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
            </div>
            <ol class="hidden lg:flex items-center space-x-1 flex-wrap">
                @foreach ($items as $index => $item)
                    <li class="flex items-center">
                        @if ($index === 0)
                            {!! $iconMapping[$icon] !!}
                        @endif

                        <span class="ms-2 text-sm text-gray-700 hover:text-green-900">
                            {{ $item }}
                        </span>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
    <div x-data="{ open: false }" class="relative">
        <img src="{{ asset('assets/images/user.png') }}" alt="" class="w-8" @click="open = !open">
        <div x-show="open" class="absolute right-0 top-10  bg-white border border-gray-100 py-4 px-4 w-40 rounded-xl"
            @click.outside="open = false">
            <ul>
                <li><a href="{{ route('logout') }}">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>
