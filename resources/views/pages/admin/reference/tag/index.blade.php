<x-admin-layout>
    @slot('title', 'Tag')
    <x-template.admin-header :items="['Referensi', '/', 'Tag']" icon="referensi" />

    <section class="mx-4 mt-1">
        <div class="mb-2">
            <h2 class="font-semibold text-2xl">Referensi</h2>
            <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi id hic</p>
        </div>

        <x-tabs.referensi />

        <div x-data="adminTag" x-init="initData" class="mt-2.5" x-clock>
            <div class="flex justify-between items-center">
                <div>
                    <x-ui.search placeholder="Cari tag.." model="search" on-input="fetchResults(1)" />
                </div>
                <div>
                    <x-ui.button x-on:click="openCreateModal" variant="primary">Tambah Tag</x-ui.button>
                </div>
            </div>

            <div class="mt-4">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <template x-for="tag in results" @card-tag.window="fetchResults()">
                        <div
                            class="flex justify-between items-center bg-white border border-gray-100/70 rounded-lg p-2 hover:bg-gray-50 transition ease-in-out">
                            <p x-text="tag.name" class="text-sm"></p>

                            <div class="relative inline-block" x-data="{ openDropdown: false }">
                                <button @click="openDropdown = !openDropdown" class="hover:bg-gray-100 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </button>

                                <div x-show="openDropdown" @click.outside="openDropdown = false"
                                    class="absolute left-1/2 top-full transform -translate-x-1/2 mt-2 bg-white w-28 border border-gray-100 flex flex-col rounded-lg shadow-md z-50">
                                    <button @click="openDeleteModal(tag)"
                                        class="flex gap-1.5 items-center text-red-700 text-start text-sm border-b border-gray-100 rounded-t-lg p-2 hover:bg-gray-100">
                                        <x-svg.delete />
                                        Hapus
                                    </button>
                                    <button @click="openEditModal(tag)"
                                        class="flex gap-1.5 items-center text-start text-sm text-gray-600 p-2 hover:bg-gray-100 rounded-b-lg">
                                        <x-svg.edit />
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="mt-6 mb-2">
                <x-ui.pagination current-page="page.currentPage" last-page="page.lastPage" per-page="page.perPage"
                    total="page.total" on-prev="fetchResults(page.currentPage - 1)"
                    on-next="fetchResults(page.currentPage + 1)" />
            </div>

            <x-ui.modal.delete modal="deleteData.modal" name="deleteData.data.name"
                onDelete="$delete({ url: deleteData.url, dispatch: 'card-tag',modalClose: 'deleteData.modal'})" />
            @include('pages.admin.reference.tag.modal-form')
        </div>
    </section>
</x-admin-layout>
