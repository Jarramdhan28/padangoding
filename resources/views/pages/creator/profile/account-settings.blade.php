<x-creator-layout>
    @slot('title', 'Profile')

    <section class="mt-20 mx-auto max-w-screen-lg px-2 md:px-4" x-data x-cloak>
        <div>
            <p class="text-gray-500 text-xs">Creator</p>
            <h1 class="text-2xl font-semibold">Profile Saya</h1>
        </div>

        <div class="flex md:flex-row flex-col mt-2 bg-white mb-2 rounded-xl gap-x-6 md:h-[600px] p-2 md:p-4">
            @include('pages.creator.profile.sidebar')
            <main x-data="creatorProfile" x-init="initData" class="p-4 w-full">
                <h1 class="text-xl font-medium">Pengaturan Akun</h1>
                <p class="text-sm text-gray-500">Silahkan Update Profile anda dengan benar</p>
            </main>
        </div>
    </section>
</x-creator-layout>
