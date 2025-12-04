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
        'article' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75a8.969 8.969 0 00-3 .512v14.25A8.987 8.987 0 006 18a8.967 8.967 0 006 2.292m0-14.25A8.967 8.967 0 0118 3.75a8.969 8.969 0 013 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 01-6 2.292m0-14.25v14.25" />
                    </svg>',
    ];
@endphp

<nav class="flex justify-between items-center h-16 md:h-14 my-2 px-4 border-b border-gray-50" x-data x-cloak>
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
    <div class="relative">
        <ul class="flex items-center gap-x-2">
            <li x-data="adminNotification" x-init="initData()">
                <button @click="openNotif = !openNotif" class="relative flex items-center p-2 rounded-xl"
                    x-bind:class="{
                        'bg-gray-100': openNotif,
                        'hover:bg-gray-50': !openNotif
                    }">
                    <x-svg.notification class="size-7 text-gray-500" />
                    <span class="absolute inset-0 object-right-top ml-5">
                        <div
                            class="inline-flex items-center px-1 border-1 border-white rounded-full text-[10px] font-semibold leading-4 bg-red-500 text-white">
                            <span x-text="unreadCount"></span>
                        </div>
                    </span>
                </button>
                <div x-show="openNotif" @click.outside="openNotif = false"
                    class="absolute right-12 top-14 bg-white border border-gray-100 w-80 rounded-md z-50">
                    <div class="flex items-center justify-between border-b border-gray-100 py-3 px-4">
                        <h1 class="font-medium">Notification</h1>
                        <button @click="$dispatch('update-notifications')"
                            class="rounded-lg hover:bg-gray-50 p-1.5 transition-colors ease-in-out duration-200">
                            <x-svg.refresh class="size-5 text-gray-500" />
                        </button>
                    </div>
                    <div class="space-y-4">
                        <template x-if="notifications.length === 0">
                            <div class="p-4 text-center text-sm text-gray-500">
                                Tidak ada notifikasi
                            </div>
                        </template>
                        <template x-for="notif in notifications" :key="notif.id"
                            @update-notifications.window="fetchNotifications()">
                            <div class="relative px-4 py-2 flex items-center gap-x-2 rounded-lg m-1 cursor-pointer transition-colors ease-in-out duration-200"
                                x-bind:class="{
                                    'bg-white hover:bg-gray-100/50': notif.read_at,
                                    'bg-gray-100/60 hover:bg-gray-100/70': !notif.read_at
                                }">
                                <template x-if="!notif.read_at">
                                    <span
                                        class="absolute left-5 top-4 w-1.5 h-1.5 bg-red-600 rounded-full ring-2 ring-white"></span>
                                </template>
                                <button
                                    @click="$delete({
                                        url: route('admin.notifications.destroy', notif.id),
                                        dispatch: 'update-notifications',
                                        toast: false
                                    })"
                                    class="absolute right-1 top-1 hover:bg-red-100 p-1 rounded-md transition-colors ease-in-out duration-200">
                                    <x-svg.delete class="size-4 text-red-300" />
                                </button>
                                <img src="{{ asset('assets/images/user.png') }}" alt=""
                                    class="w-10 rounded-full ">
                                <div
                                    @click="$submit({
                                        url: route('admin.notifications.markAsRead', notif.id),
                                        method: 'POST',
                                        dispatch: 'update-notifications',
                                        toast: false,
                                    })">
                                    <h2 class="text-sm mb-0.5">
                                        <span class="font-semibold hover:underline" x-text="notif.data.author"></span>,
                                        <span class="text-gray-500" x-text="notif.data.message"></span>
                                    </h2>
                                    <p class="text-xs text-gray-400" x-text="$timeAgoFormat(notif.created_at)">2 jam
                                        yang lalu</p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </li>
            <li x-data="{ openProfile: false }">
                <button @click="openProfile = !openProfile">
                    <img src="{{ asset('assets/images/user.png') }}" alt=""
                        class="w-16 md:w-11 rounded-full cursor-pointer">
                </button>
                <div x-show="openProfile"
                    class="absolute right-0 top-14 bg-white border border-gray-100 py-4 px-4 w-48 rounded-xl z-50"
                    @click.outside="openProfile = false">
                    <ul>
                        <li><a href="{{ route('logout') }}">Keluar</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
