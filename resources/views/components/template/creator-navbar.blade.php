<header x-cloak x-data="{ openNavMenu: false }"
    class="fixed bg-white top-0 left-0 right-0 z-50 border-b border-gray-100 py-1 md:py-2.5 px-2.5 md:px-4">
    <nav class="flex justify-between h-12 md:h-10 items-center mx-auto max-w-screen-xl">
        <!-- title -->
        <div class="flex gap-4">
            <div class="flex">
                <a href="{{ route('creator.dashboard') }}">
                    <h2 class="font-semibold text-lg">Pada<span class="text-blue-700">ngoding</span></h2>
                </a>
                <x-ui.badge class="text-[8px] h-max">Creator</x-ui.badge>
            </div>
        </div>
        <!-- nav menu -->
        <ul class="flex gap-2 items-center">
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
            </li>
            <li x-data="{ open: false, loading: false }">
                <div class="relative">
                    <x-ui.button type="submit" variant="outline" class="flex items-center gap-1 text-xs"
                        @click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="size-4 text-gray-700">
                            <path
                                d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                        </svg>
                        <span class="hidden md:flex">Menulis</span>
                    </x-ui.button>
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 top-13 rounded-xl bg-white border border-gray-100 w-64">
                        <div class="grid grid-cols-2 text-sm">
                            <a href="{{ route('creator.article.create') }}"
                                class="rounded-l-xl p-2 text-center hover:bg-gray-50 border-r border-gray-100">
                                Artikel
                            </a>
                            <a class="rounded-r-xl p-2 text-center hover:bg-gray-50">
                                Series
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                @if (Auth::check())
                    <div x-data="{ open: false }" class="ms-1 relative">
                        <img src="{{ asset('assets/images/no-user.png') }}" alt=""
                            class="size-9 object-cover rounded-full" @click="open = !open">
                        <div x-show="open"
                            class="absolute right-0 top-13 rounded-xl bg-white border border-gray-100 w-64"
                            @click.outside="open = false">
                            <div class="flex justify-between p-4 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('assets/images/no-user.png') }}" alt="profile"
                                        class="size-9 object-cover rounded-full">
                                    <div>
                                        <h2 class="text-sm font-medium">{{ Auth::user()->name }}</h2>
                                        <p class="text-xs text-gray-400"><span>@</span>{{ Auth::user()->username }}
                                        </p>
                                    </div>
                                </div>
                                <div class="h-max">
                                    <x-ui.badge variant="success" class="text-[9px]">Creator</x-ui.badge>
                                </div>
                            </div>
                            <ul class="p-1">
                                <li>
                                    <a href="{{ route('creator.dashboard') }}"
                                        class="flex items-center gap-1.5 px-2 py-2.5 text-sm text-gray-500 hover:text-gray-950 hover:bg-gray-50 rounded-xl transition-colors ease-in-out duration-300">
                                        <x-svg.activity class="size-5 text-gray-600" />
                                        Dashboard
                                    </a>
                                </li>
                                <li class="border-b border-gray-100 pb-1">
                                    <a href="{{ route('creator.profile.index') }}"
                                        class="px-2 py-2.5 flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-950 hover:bg-gray-50 rounded-xl transition-colors ease-in-out duration-300">
                                        <x-svg.user class="size-5 text-gray-600" />
                                        Profile Saya
                                    </a>
                                </li>
                                <li class="pt-1">
                                    <a href="{{ route('creator.article.index') }}"
                                        class="flex items-center gap-1.5 px-2 py-2.5 text-sm text-gray-500 hover:text-gray-950 hover:bg-gray-50 rounded-xl transition-colors ease-in-out duration-300">
                                        <x-svg.doc class="size-5 text-gray-600" />
                                        Artikel Saya
                                    </a>
                                </li>
                                <li class="border-b border-gray-100 pb-1">
                                    <a
                                        class="flex items-center gap-1.5 px-2 py-2.5 text-sm text-gray-500 hover:text-gray-950 hover:bg-gray-50 rounded-xl transition-colors ease-in-out duration-300">
                                        <x-svg.docs class="size-5 text-gray-600" />
                                        Series Saya
                                    </a>
                                </li>
                                <li class="pt-1">
                                    <a href="{{ route('logout') }}"
                                        class="flex items-center gap-1.5 px-2 py-2.5 text-sm hover:bg-red-100 text-red-600 rounded-xl transition-colors ease-in-out duration-300">
                                        <x-svg.out class="size-5 text-red-600" />
                                        Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <x-template.nav-link href="{{ route('login') }}"
                        class="bg-black text-white px-4 border border-black hover:bg-gray-800 hover:text-white">
                        Masuk
                    </x-template.nav-link>
                @endif
            </li>
        </ul>
    </nav>
</header>
