<x-admin-layout>
    @slot('title', 'Article')
    <x-template.admin-header :items="['Article']" icon="article" />

    <section class="mx-4 mt-1">
        <div class="mb-2">
            <h2 class="font-semibold text-2xl">Article List</h2>
            <p class="text-sm text-gray-600">Silahkan lakukan review article yang tersedia</p>
        </div>

        <div x-data="adminArticle" x-init="initData" class="mt-2.5" x-cloak>
            <div class="flex justify-between items-center">
                <div>
                    <x-ui.search placeholder="Cari article..." model="search" on-input="fetchResults(1)" />
                </div>
                <div class="relative">
                    <div @click="filterData.open = !filterData.open"
                        class="flex justify-between items-center w-36 bg-white px-3 py-2 rounded-lg cursor-pointer border border-gray-200">
                        <span x-text="filterData.selected" class="capitalize text-gray-800 text-sm"></span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400 transform transition-transform duration-200"
                            :class="{ 'rotate-180': filterData.open }" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div x-cloak x-show="filterData.open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute z-10 mt-2 w-full bg-white rounded-lg shadow-xl overflow-hidden border border-gray-200">
                        <ul>
                            <template x-for="option in filterData.options" :key="option">
                                <li @click="selectedStatus(option)"
                                    :class="{
                                        'bg-gray-50 text-gray-600 font-semibold': option ===
                                            filterData.selected,
                                        'text-gray-800 hover:bg-gray-50': option !== filterData.selected
                                    }"
                                    class="flex justify-between items-center px-4 py-1.5 cursor-pointer transition-colors duration-150">
                                    <span x-text="option" class="capitalize text-sm"></span>
                                    <svg x-show="option === filterData.selected" xmlns="http://www.w3.org/2000/svg"
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

            <div class="mt-4 w-full rounded-xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto md:overflow-visible" x-cloak x-show="isLoaded">
                    <table class="w-full min-w-[600px] text-sm text-left" @article-table.window="fetchResults()">
                        <thead class="text-sm bg-gray-50 font-medium text-gray-700 whitespace-nowrap">
                            <tr class="border-b border-gray-100" x-cloak>
                                <td class="px-4 py-2 w-3">No</td>
                                <td class="px-6 py-2">Judul</td>
                                <td class="px-6 py-2">Kategori</td>
                                <td class="px-6 py-2">Status</td>
                                <td class="px-6 py-2">Publish</td>
                                <td class="px-6 py-2">Penulis</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <template x-for="(article, index) in results" :key="index">
                                <tr
                                    class="bg-white border-t border-gray-100 hover:bg-gray-50/60 transition-all ease-in-out duration-150">
                                    <td class="px-4 py-2 text-center"
                                        x-text="(page.currentPage - 1) * page.perPage + (index + 1)">
                                    </td>
                                    <td class="px-6 py-2 w-96"
                                        x-text="article.title.slice(0, 40) + (article.title.length > 40 ? '...' : '')">
                                    </td>
                                    <td class="px-6 py-2" x-text="article?.category?.name"></td>
                                    <td class="px-6 py-2">
                                        <span
                                            x-bind:class="article.status_color +
                                                ' text-xs px-1.5 rounded-sm'"
                                            x-text="article.status_label">
                                        </span>
                                    </td>
                                    <td class="px-6 py-2">
                                        <x-ui.badge variant="primary" x-text="article.is_publish"></x-ui.badge>
                                    </td>
                                    <td class="px-6 py-2" x-text="article?.author?.name"></td>
                                    <td class="px-6 py-2 text-center">
                                        <x-ui.button x-bind:href="route('admin.article.detailArticle', article.slug)"
                                            variant="outline" class="flex items-center gap-x-1 w-max">
                                            <x-svg.eye class="size-4" />
                                        </x-ui.button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 mb-2">
                <x-ui.pagination current-page="page.currentPage" last-page="page.lastPage" per-page="page.perPage"
                    total="page.total" on-prev="fetchResults(page.currentPage - 1)"
                    on-next="fetchResults(page.currentPage + 1)" />
            </div>
        </div>
    </section>
</x-admin-layout>
