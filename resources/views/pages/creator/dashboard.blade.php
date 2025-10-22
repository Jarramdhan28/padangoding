<x-creator-layout>
    @slot('title', 'Dashboard')

    <section class="mt-20 mx-auto max-w-screen-xl">
        <div>
            <h1 class="text-gray-500 text-sm">Creator Dashboard</h1>
            <p class="text-2xl font-semibold">Hallo, {{ Auth::user()->name }}</p>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="border border-gray-200 rounded-xl p-4 shadow-xs">
                <p class="mb-1 text-3xl font-semibold">34</p>
                <h2 class="font-semibold">Publish</h2>
                <p class="text-gray-600 text-sm">Lorem ipsum, dolor sit amet consectetur</p>
            </div>
            <div class="border border-gray-200 rounded-xl p-4 shadow-xs">
                <p class="mb-1 text-3xl font-semibold">2</p>
                <h2 class="font-semibold">Mengunggu Pesetujuan</h2>
                <p class="text-gray-600 text-sm">Lorem ipsum, dolor sit amet consectetur</p>
            </div>
            <div class="border border-gray-200 rounded-xl p-4 shadow-xs">
                <p class="mb-1 text-3xl font-semibold">10<span class="text-sm font-medium">K</span></p>
                <h2 class="font-semibold">Likes</h2>
                <p class="text-gray-600 text-sm">Lorem ipsum, dolor sit amet consectetur</p>
            </div>
        </div>

        <div class="mt-4">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold">Artikel Terbaru</h2>
                <div class="rounded-xl bg-gray-100 p-1 flex">
                    <a
                        class="bg-white rounded-lg text-sm font-medium px-3 py-1 flex items-center border border-gray-50 shadow">Publish</a>
                    <a class="px-3 text-sm py-1">Menunggu</a>
                </div>
            </div>
            <div class="mt-2 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="border border-gray-200 rounded-2xl p-2">
                    <div>
                        <img src="{{ asset('assets/images/no-thumb.png') }}" alt="image-article"
                            class="rounded-xl border border-gray-100">
                    </div>
                    <div class="p-2">
                        <h1 class="font-semibold">Membuat Resource Controller Pada Laravel 12</h1>
                        <p class="text-sm text-gray-500">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Voluptatum..</p>
                    </div>
                    <div class="px-2 pb-2">
                        <span class="text-xs border border-gray-200 text-gray-600 px-1 rounded-sm">Laravel</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-creator-layout>
