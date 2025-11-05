<x-creator-layout>
    @slot('title', 'Artikel')

    <section class="mt-20 mx-auto max-w-screen-xl px-4">
        <div>
            <p class="text-gray-500 text-xs">Creator Dashboard</p>
            <h1 class="text-2xl font-semibold">Artikel Saya</h1>
        </div>

        <div x-data="articleHandler()" x-init="initData()">
            <div class="mb-6">
                <div class="flex justify-end">
                    <div class="w-52">
                        <x-ui.search placeholder="Cari article.." model="search" on-input="fetchArticles()" />
                    </div>
                </div>
            </div>

            <template x-if="!loading && results.length === 0">
                <p class="text-center text-gray-500 text-sm mt-4" x-cloak>Article tidak ditemukan</p>
            </template>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <template x-for="article in results">
                    <div class="bg-white rounded-lg p-2 border border-gray-100 shadow-xs flex gap-3">
                        <div class="w-64">
                            <img x-bind:src="article.thumbnail" alt="thumbnail"
                                class="w-full h-26 object-cover rounded-lg">
                        </div>
                        <div class="w-full flex flex-col justify-between">
                            <div class="flex justify-between gap-2 w-full">
                                <div class="flex flex-col justify-between gap-1">
                                    <div>
                                        <span class="text-xs border border-gray-200 text-gray-600 px-1 rounded-sm"
                                            x-text="article.category.name"></span>
                                        <span
                                            x-bind:class="article.status_color +
                                                ' text-xs px-1.5 rounded-sm'"
                                            x-text="article.status_label">
                                        </span>
                                        <h1 class="font-medium"
                                            x-text="article.title.slice(0, 35) + (article.title.length > 35 ? '...' : '')">
                                        </h1>
                                    </div>
                                </div>
                                <div x-data="{ openDropdown: false }" x-cloak class="relative inline-block">
                                    <button class="hover:bg-gray-100 p-1 h-max rounded-lg bg-white"
                                        @click="openDropdown = !openDropdown">
                                        <x-svg.dot-3 />
                                    </button>
                                    <div x-show="openDropdown"
                                        class="absolute transform z-50 right-0 bg-white shadow-sm w-32 rounded-lg"
                                        @click.outside="openDropdown = false">
                                        <ul class="border border-gray-100 m-0.5 rounded-lg">
                                            <li
                                                class="p-2 text-sm border-b border-gray-100 cursor-pointer hover:bg-gray-50 rounded-t-lg ease-in-out duration-100 transition">
                                                <a x-bind:href="route('creator.article.detailPage', article.slug)"
                                                    class="flex gap-2 items-center text-sm text-gray-600">
                                                    <x-svg.eye class="size-4 text-gray-400" />
                                                    Lihat
                                                </a>
                                            </li>
                                            <li
                                                class="p-2 text-sm border-b border-gray-100 cursor-pointer hover:bg-gray-50 ease-in-out duration-100 transition">
                                                <a x-bind:href="route('creator.article.editPage', article.slug)"
                                                    class="flex gap-2 items-center text-sm text-gray-600">
                                                    <x-svg.edit class="size-4 text-gray-400" />
                                                    Edit
                                                </a>
                                            </li>
                                            <li
                                                class="p-2 text-sm cursor-pointer hover:bg-red-50 rounded-b-lg ease-in-out duration-100 transition">
                                                <a class="flex gap-2 items-center text-sm text-red-600">
                                                    <x-svg.delete class="text-red-400 size-4" />
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 justify-between w-full pe-2 mt-2">
                                <template x-if="article.status == 'aproved'">
                                    <div class="flex items-center gap-1">
                                        <label
                                            class="relative inline-block h-4 w-8 cursor-pointer rounded-full bg-gray-300 transition [-webkit-tap-highlight-color:_transparent] has-[:checked]:bg-green-600">
                                            <input class="peer sr-only" id="is_profile" type="checkbox"
                                                x-model="article.is_publish" />
                                            <span
                                                class="absolute inset-y-0 start-0.5 my-[2px] size-3 rounded-full bg-gray-300 ring-[4px] ring-inset ring-white transition-all peer-checked:start-6 peer-checked:w-1 peer-checked:bg-white peer-checked:ring-transparent"></span>
                                        </label>
                                        <span class="text-xs"
                                            x-text="article.is_publish ? 'Publish' : 'Not Published'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="mt-6 mb-2">
                <x-ui.pagination current-page="page.currentPage" last-page="page.lastPage" per-page="page.perPage"
                    total="page.total" on-prev="fetchArticles(page.currentPage - 1)"
                    on-next="fetchArticles(page.currentPage + 1)" />
            </div>
        </div>
    </section>
</x-creator-layout>
