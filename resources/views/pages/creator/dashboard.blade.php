<x-creator-layout>
    @slot('title', 'Dashboard')

    <section class="mt-20 mx-auto max-w-screen-xl px-4">
        <div>
            <h1 class="text-gray-500 text-xs">Creator Dashboard</h1>
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
                <div class="rounded-xl bg-gray-100 p-1 flex">
                    <a
                        class="bg-white rounded-lg text-sm font-medium px-3 py-1 flex items-center border border-gray-50 shadow">Artikel</a>
                    <a class="px-3 text-sm py-1">Series</a>
                </div>
                <div class="">
                    <div x-data="{
                        open: false,
                        selected: 'Publish',
                        options: ['Publish', 'Draft', 'Menunggu'],
                        toggle() { this.open = !this.open },
                        selectOption(fruit) {
                            this.selected = fruit;
                            this.open = false;
                        }
                    }" class="relative w-32 text-sm" @click.away="open = false">
                        <div @click="toggle()"
                            class="flex justify-between items-center bg-white px-3 py-2 rounded-lg cursor-pointer border border-gray-200">
                            <span x-text="selected" class="text-gray-800 font-medium"></span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-400 transform transition-transform duration-200"
                                :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-10 mt-2 w-full bg-white rounded-lg shadow-xl overflow-hidden border border-gray-200">
                            <ul>
                                <template x-for="option in options" :key="option">
                                    <li @click="selectOption(option)"
                                        :class="{
                                            'bg-gray-50 text-gray-600 font-semibold': option ===
                                                selected,
                                            'text-gray-800 hover:bg-gray-50': option !== selected
                                        }"
                                        class="flex justify-between items-center px-4 py-2 cursor-pointer transition-colors duration-150">
                                        <span x-text="option"></span>
                                        <svg x-show="option === selected" xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="border border-gray-200 rounded-2xl">
                    <div class="p-2">
                        <img src="{{ asset('assets/images/no-thumb.png') }}" alt="image-article"
                            class="rounded-xl border border-gray-100 h-44 object-cover w-full">
                    </div>
                    <div class="px-4 pt-1 pb-2.5">
                        <h1 class="font-semibold">Membuat Resource Controller Pada Laravel 12</h1>
                        <p class="text-sm text-gray-500">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Voluptatum..</p>
                    </div>
                    <div class="bg-gray-50 px-4 py-1.5 flex justify-between items-center rounded-b-2xl">
                        <span class="text-xs border border-gray-200 text-gray-600 px-1 rounded-sm">Laravel</span>
                        <div x-data="{ openDropdown: false }" class="relative inline-block" x-cloak>
                            <button class="hover:bg-gray-100 p-1 rounded-lg bg-white"
                                @click="openDropdown = !openDropdown">
                                <x-svg.dot-3 />
                            </button>

                            <div x-show="openDropdown" @click.outside="openDropdown = false"
                                class="absolute top-0 right-8 transform mt-2 bg-white w-28 border border-gray-100 flex flex-col rounded-lg shadow-md z-50">
                                <button
                                    class="flex gap-1.5 items-center text-red-700 text-start text-sm border-b border-gray-100 rounded-t-lg p-2 hover:bg-gray-100">
                                    <x-svg.delete />
                                    Hapus
                                </button>
                                <button
                                    class="flex gap-1.5 items-center text-start text-sm text-gray-600 p-2 hover:bg-gray-100 rounded-b-lg">
                                    <x-svg.edit />
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-creator-layout>
