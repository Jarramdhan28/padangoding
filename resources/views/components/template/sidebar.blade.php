<aside :class="{ 'block': openSidebar, 'hidden': !openSidebar }" x-cloak x-transition
    class="fixed top-0 left-0 z-40 w-56 md:w-60 h-screen bg-white pb-4 lg:block transition-all">
    <div class="m-2 border border-gray-100 h-full bg-gray-50 rounded-2xl shadow-xs">
        <div class="flex items-center gap-2 px-4 h-16 md:h-14 border-b border-gray-100">
            <a href="{{ route('admin.dashboard') }}">
                <div class="border border-gray-200 rounded-md p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25Z" />
                    </svg>
                </div>
            </a>
            <div>
                <h2 class="text-sm font-semibold">Padangoding</h2>
                <p class="text-[10px] text-gray-500">By: Zaicode</p>
            </div>
        </div>
        <ul class="space-y-2 py-3 px-4 text-sm">
            <li>
                <x-template.side-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>
                    Dashboard
                </x-template.side-link>
            </li>
            <li>
                <x-template.side-link :href="route('category.index')" :active="request()->routeIs('category.*', 'tag.*')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 17.25v-.228a4.5 4.5 0 00-.12-1.03l-2.268-9.64A3.375 3.375 0 0016.077 3.75H7.923a3.375 3.375 0 00-3.285 2.602l-2.268 9.64a4.5 4.5 0 00-.12 1.03v.228M21.75 17.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3m19.5 0a3 3 0 00-3-3H5.25a3 3 0 00-3 3" />
                    </svg>
                    Referensi
                </x-template.side-link>
            </li>
            <li>
                <x-template.side-link :href="route('article')" :active="request()->routeIs('article')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75a8.969 8.969 0 00-3 .512v14.25A8.987 8.987 0 006 18a8.967 8.967 0 006 2.292m0-14.25A8.967 8.967 0 0118 3.75a8.969 8.969 0 013 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 01-6 2.292m0-14.25v14.25" />
                    </svg>
                    Article
                </x-template.side-link>
            </li>
            <li>
                <x-template.side-link :href="route('user-management.index')" :active="request()->routeIs('user-management.*')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>

                    Kelola Pengguna
                </x-template.side-link>
            </li>
        </ul>
    </div>
</aside>
