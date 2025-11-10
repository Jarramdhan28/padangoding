<header x-cloak x-data="{ openNavMenu: false }"
    class="fixed bg-white top-0 left-0 right-0 z-50 border-b border-gray-100 py-1 md:py-2.5 px-2.5 md:px-4">
    <nav class="flex justify-between h-12 md:h-10 items-center mx-auto max-w-screen-xl">
        <x-template.nav-link @click="openNavMenu = !openNavMenu" class="md:hidden hover:bg-gray-100">
            <template x-if="!openNavMenu" x-transition>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M2 3.75A.75.75 0 0 1 2.75 3h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 8a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 8Zm0 4.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </template>

            <template x-if="openNavMenu" x-transition>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5">
                    <path
                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                </svg>
            </template>
        </x-template.nav-link>

        <!-- title -->
        <div>
            <h2 class="font-semibold text-lg">Pada<span class="text-blue-700">ngoding</span></h2>
        </div>

        <!-- menu dan navigasi mobile -->
        <div class="md:hidden flex items-center gap-0.5">
            @if (Auth::check())
                <div x-data="{ open: false }" class="ms-2 relative">
                    <img src="{{ asset('assets/images/no-user.png') }}" alt="" class="size-9 rounded-full p-0"
                        @click="open = !open">
                    <div x-show="open" class="absolute right-0 top-13 rounded-xl bg-white border border-gray-100 w-64"
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
                                <x-ui.badge variant="success" class="text-[9px]">User</x-ui.badge>
                            </div>
                        </div>
                        <ul class="pt-1">
                            <li>
                                <a class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                    <x-svg.user class="size-5 text-gray-600" />
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                    <x-svg.activity class="size-5 text-gray-600" />
                                    Aktivitas Saya
                                </a>
                            </li>
                            <li>
                                <a href="/ikan"
                                    class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                    <x-svg.rocket class="size-5 text-gray-600" />
                                    Daftar Creator
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="flex items-center gap-1.5 px-4 py-2 bg-red-50 text-sm hover:bg-red-100 rounded-b-lg">
                                    <x-svg.out class="size-5 text-red-600" />
                                    Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <x-template.nav-link class="p-0" href="{{ route('login') }}">
                    <img src="{{ asset('assets/images/user.png') }}" alt="" class="p-0 size-8 rounded-full">
                </x-template.nav-link>
            @endif
        </div>

        <!-- menu nav desktop -->
        <ul class="hidden md:flex space-x-1 items-center">
            <li>
                <x-template.nav-link>Tutorial</x-template.nav-link>
            </li>
            <li>
                <x-template.nav-link>Artikel</x-template.nav-link>
            </li>
            <li>
                <x-template.nav-link>Series</x-template.nav-link>
            </li>
            <li x-data="{ openDropdown: false }">
                <x-template.nav-link @click="openDropdown = !openDropdown"
                    class="flex items-center justify-between gap-0.5">
                    Kategori
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="size-4 mt-0.5">
                        <path fill-rule="evenodd"
                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </x-template.nav-link>

                <div x-show="openDropdown" @click.outside="openDropdown = false" x-transition
                    class="absolute right-40 top-16 rounded-lg bg-white border border-gray-200 w-96">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-1">Kategori Tutorial</h2>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="border border-gray-200 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <h2 class="font-semibold">Laravel</h2>
                                <p class="text-xs text-gray-500">Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                            <div class="border border-gray-200 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <h2 class="font-semibold">React</h2>
                                <p class="text-xs text-gray-500">Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-600 rounded-b-lg py-2.5 px-4 flex justify-between items-center">
                        <h2 class="text-white text-sm">Temukan Lebih Banyak</h2>

                        <a href="" class="bg-white hover:bg-gray-100 rounded-lg p-1 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="size-4">
                                <path fill-rule="evenodd"
                                    d="M2 8c0 .414.336.75.75.75h8.69l-1.22 1.22a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 1 0-1.06 1.06l1.22 1.22H2.75A.75.75 0 0 0 2 8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <x-template.nav-link>Tailwind UI</x-template.nav-link>
            </li>
            <li>
                <x-template.nav-link class="text-gray-300 text-2xl hover:bg-white">|</x-template.nav-link>
            </li>
            <li x-data="{ openSearch: false }">
                <x-template.nav-link class="border border-gray-200 hover:bg-gray-200 px-2"
                    @click="openSearch = !openSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </x-template.nav-link>
                <!-- Search menu -->
                <div x-show="openSearch" x-transition.scale
                    class="fixed inset-0 z-10 flex h-screen justify-center bg-white/30 backdrop-blur-xs">
                    <div class="relative bg-white h-max top-14 rounded-2xl border border-gray-200 w-full max-w-md m-2"
                        @click.outside="openSearch = false">
                        <div class="border-b border-gray-100 px-4 py-2 flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="size-5 text-gray-500">
                                <path fill-rule="evenodd"
                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <input type="text" placeholder="Search..."
                                class="w-full border-0 outline-0 focus:ring-0 focus:outline-0 text-sm text-gray-600">
                        </div>

                        <div class="flex justify-center items-center p-4">
                            <p class="text-sm text-gray-400">Data tidak ditemukan</p>
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
                                    <x-ui.badge variant="success" class="text-[9px]">User</x-ui.badge>
                                </div>
                            </div>
                            <ul class="pt-1">
                                <li>
                                    <a
                                        class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                        <x-svg.user class="size-5 text-gray-600" />
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                        <x-svg.activity class="size-5 text-gray-600" />
                                        Aktivitas Saya
                                    </a>
                                </li>
                                <li>
                                    @if (Auth::user()->hasRole('user'))
                                        <a href="/ikan"
                                            class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                            <x-svg.rocket class="size-5 text-gray-600" />
                                            Daftar Creator
                                        </a>
                                    @elseif (Auth::user()->hasRole('creator'))
                                        <a href="{{ route('creator.dashboard') }}"
                                            class="flex items-center gap-1.5 px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">
                                            <x-svg.rocket class="size-5 text-gray-600" />
                                            Dashboard Creator
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        class="flex items-center gap-1.5 px-4 py-2 bg-red-50 text-sm hover:bg-red-100 rounded-b-lg">
                                        <x-svg.out class="size-5 text-red-600" />
                                        Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <x-template.nav-link href="{{ route('login') }}"
                        class="bg-black text-white px-4 border ms-2 border-black hover:bg-gray-800 hover:text-white">
                        Masuk
                    </x-template.nav-link>
                @endif
            </li>
        </ul>

        <!-- menu nav mobile -->
        <ul x-data="{ openKategori: false }" x-show="openNavMenu" @click.outside="openNavMenu = false" x-transition
            class="absolute top-14 left-0 w-full bg-white md:hidden flex flex-col p-2 space-y-1">
            <li class="py-1 px-2 hover:bg-gray-50 rounded-xl">
                <x-template.nav-link href="#"
                    class="w-full flex justify-between items-center">Tutorial</x-template.nav-link>
            </li>
            <li class="py-1 px-2 hover:bg-gray-50 rounded-xl">
                <x-template.nav-link href="#"
                    class="w-full flex justify-between items-center">Artikel</x-template.nav-link>
            </li>
            <li class="py-1 px-2 hover:bg-gray-50 rounded-xl">
                <x-template.nav-link href="#"
                    class="w-full flex justify-between items-center">Series</x-template.nav-link>
            </li>
            <li class="py-1 px-2 hover:bg-gray-50 rounded-xl">
                <x-template.nav-link @click="openKategori = !openKategori"
                    class="w-full flex justify-between items-center">
                    Kategori
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="size-4 m-0 p-0">
                        <path fill-rule="evenodd"
                            d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </x-template.nav-link>
            </li>
            <div x-show="openKategori" x-collapse class="text-sm bg-gray-50/80 mx-4 rounded-xl">
                <div class="space-y-1 p-4">
                    <div class="border border-gray-100 rounded-xl p-2 bg-white hover:gray-200">
                        <h2 class="text-sm font-medium">Laravel</h2>
                        <p class="text-xs text-gray-500">Lorem ipsum dolor sit amet, consectetur</p>
                    </div>
                    <div class="border border-gray-100 rounded-xl p-2 bg-white hover:gray-200">
                        <h2 class="text-sm font-medium">React</h2>
                        <p class="text-xs text-gray-500">Lorem ipsum dolor sit amet, consectetur</p>
                    </div>
                </div>
                <div class="bg-blue-600 rounded-b-lg py-2.5 px-4 flex justify-between items-center">
                    <h2 class="text-white text-xs">Temukan Lebih Banyak</h2>

                    <a href="" class="bg-white hover:bg-gray-100 rounded-lg p-1 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="size-4">
                            <path fill-rule="evenodd"
                                d="M2 8c0 .414.336.75.75.75h8.69l-1.22 1.22a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 1 0-1.06 1.06l1.22 1.22H2.75A.75.75 0 0 0 2 8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            <li class="py-1 px-2 hover:bg-gray-50 rounded-xl">
                <x-template.nav-link href="#" class="w-full flex justify-between items-center">UI
                    Kits</x-template.nav-link>
            </li>
            <li class="py-2.5 px-2 hover:bg-gray-50 rounded-xl">
                <input type="search" placeholder="Search..."
                    class="border border-gray-200 rounded-xl w-full px-2.5 py-2 placeholder:text-sm">
            </li>
        </ul>
    </nav>
</header>
