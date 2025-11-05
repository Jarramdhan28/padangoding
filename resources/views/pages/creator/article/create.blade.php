<x-creator-layout>
    @slot('title', 'Dashboard')

    <section class="mt-20 mb-20 mx-auto max-w-screen-md px-4">
        <div x-data="articleCreate" x-init="initdata()">
            <x-ui.back />
            <div class="mb-4">
                <p class="text-gray-500 text-xs">Creator Dashboard</p>
                <h1 class="text-2xl font-semibold" x-text="isEditMode ?  'Edit Artikel' : 'Tambah Artikel'"></h1>
                <p class="text-sm font-gray-600">Silahkan lengkapi data dengan benar dan tepat</p>
            </div>
            <div class="bg-gray-50 rounded-2xl w-full p-4">
                <div>
                    <div x-show="loadingPage" x-transition.opacity
                        class="inset-0 flex flex-col items-center h-[650px] justify-center z-30 pointer-events-auto">
                        <div class="w-8 h-8 border-4 border-green-300 border-t-green-600 rounded-full animate-spin">
                        </div>
                    </div>
                </div>
                <form
                    @submit.prevent="$submit({
                        url: form.url,
                        method: form.method,
                        data: form.data,
                    })"
                    x-show="!loadingPage">
                    <div class="mb-2">
                        <div class="space-y-1">
                            <x-ui.form.label>Thumbnail</x-ui.form.label>
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-white border border-gray-200 px-4 py-2 h-26 w-32 rounded-lg text-gray-400 hover:bg-gray-50 cursor-pointer transition-all ease-in-out duration-150">
                                    <label class="flex justify-center items-center h-full">
                                        +
                                        <input type="file" accept="image/*" class="hidden"
                                            @change="form.data.thumbnail = $event.target.files[0]; previewImage($event)">
                                    </label>
                                </div>
                                <div>
                                    <template x-if="previewThumbnail">
                                        <img x-bind:src="previewThumbnail" alt="thumbnail" class="h-26 rounded-lg">
                                    </template>
                                </div>
                            </div>
                            <x-ui.form.error x-text="errors.thumbnail" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                        <div class="space-y-1">
                            <x-ui.form.label>Judul*</x-ui.form.label>
                            <x-ui.form.input type="text" x-model="form.data.title"
                                placeholder="Masukan judul artikel" />
                            <x-ui.form.error x-text="errors.title" />
                        </div>
                        <div class="space-y-1">
                            <x-ui.form.label>Kategori*</x-ui.form.label>
                            <x-ui.form.select x-model="form.data.category_id">
                                <option value="">Pilih Kategori</option>
                                <template x-for="category in $store.categories.list" :key="category.id">
                                    <option x-bind:value="category.id" x-text="category.name"></option>
                                </template>
                            </x-ui.form.select>
                            <x-ui.form.error x-text="errors.category_id" />
                        </div>
                    </div>
                    <div class="mb-2">
                        <x-ui.form.label>Deskripsi</x-ui.form.label>
                        <x-ui.form.textarea x-model="form.data.description"
                            placeholder="Masukan deskripsi di sini"></x-ui.form.textarea>
                        <x-ui.form.error x-text="errors.description" />
                    </div>
                    <div class="mb-2">
                        <x-ui.form.label>Konten*</x-ui.form.label>
                        <div id="content"
                            style="font-size: 14px; height: 350px; font-family: 'Mona Sans', sans-serif;"
                            class="h-32 bg-white text-sm rounded-b-lg"></div>
                        <input type="hidden" name="content" x-model="form.data.content">
                        <x-ui.form.error x-text="errors.content" />
                    </div>
                    <div class="flex justify-end items-center gap-2">
                        <x-ui.button @click="form.data.status = 'draft'"
                            class="bg-white disabled:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            variant="outline" x-bind:disabled="loading">
                            <p x-show="!loading">Simpan Draft</p>
                            <div x-show="loading" class="w-[89px] flex justify-center items-center">
                                <x-ui.form.loader />
                            </div>
                        </x-ui.button>
                        <x-ui.button @click="form.data.status = 'review'" variant="primary" x-bind:disabled="loading"
                            class="disabled:bg-gray-800 disabled:opacity-50 disabled:cursor-not-allowed">
                            <p x-show="!loading">Kirim</p>
                            <div x-show="loading" class="w-9 flex justify-center items-center">
                                <x-ui.form.loader />
                            </div>
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-creator-layout>
