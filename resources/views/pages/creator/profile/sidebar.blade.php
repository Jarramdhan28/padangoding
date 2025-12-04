<aside class="w-full md:w-60 md:border-r border-gray-50 px-3 py-4">
    <ul class="grid grid-cols-2 md:grid-cols-1 w-full gap-1">
        <li>
            <a href="{{ route('creator.profile.index') }}"
                class="block px-4 py-2.5 rounded-lg hover:bg-gray-100/80 text-sm transition-colors ease-in-out duration-300 {{ request()->routeIs('creator.profile.index') ? 'bg-gray-100/60' : 'hover:bg-gray-100/50' }}">
                Informasi Pribadi
            </a>
        </li>
        <li>
            <a href="{{ route('creator.profile.accountSettings') }}"
                class="block px-4 py-2.5 rounded-lg hover:bg-gray-100/80 text-sm transition-colors ease-in-out duration-300 {{ request()->routeIs('creator.profile.accountSettings') ? 'bg-gray-100/60' : 'hover:bg-gray-100/50' }}"">
                Pengaturan Akun
            </a>
        </li>
    </ul>
</aside>
