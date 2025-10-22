<div x-show="form.modal" class="fixed inset-0 z-50 flex items-center justify-center bg-white/20 backdrop-blur-xs">
    <div class="relative bg-white rounded-2xl border border-gray-200 shadow-sm w-full max-w-md p-1 m-2">
        <div class="relative border border-gray-100 rounded-2xl">
            <x-loading.modal />

            <button x-on:click="closeFormModal"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-1 rounded-lg transition">
                <x-svg.x class="size-5" />
            </button>

            <div class="px-5 py-3 border-b border-gray-100">
                <h3 class="text-xl font-semibold" x-text="form.isEdit ? 'Edit Kategori' : 'Tambah Kategori'"></h3>
                <p class="text-sm text-gray-500">Silahkan masukan data</p>
            </div>

            <form
                @submit.prevent="$submit({
                        url: form.url,
                        method: form.method,
                        data: form.data,
                        dispatch: 'card-category',
                        modalClose: 'form.modal'
                    })">
                <div class="px-5 py-3">
                    <div class="space-y-1">
                        <x-ui.form.label>Nama Kategori*</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.name" type="text" placeholder="Masukan nama kategori" />
                        <x-ui.form.error x-text="errors.name" />
                    </div>

                    <div class="space-y-1">
                        <x-ui.form.label>Icon</x-ui.form.label>
                        <div class="flex items-center gap-2">
                            <template x-if="previewUrl">
                                <img x-bind:src="previewUrl" alt="Preview"
                                    class="w-16 h-16 object-cover rounded-lg shadow">
                            </template>
                            <label
                                class="border border-gray-200 px-4 py-2 rounded-lg text-gray-400 hover:bg-gray-100 cursor-pointer">
                                +
                                <input type="file" accept="image/*" class="hidden"
                                    @change="form.data.icon = $event.target.files[0]; previewImage($event)">
                            </label>
                        </div>
                        <x-ui.form.error x-text="errors.icon" />
                    </div>
                </div>
                <div class="gap-2 border-t border-gray-100 flex justify-between px-5 py-3">
                    <x-ui.button x-on:click="closeFormModal" type="button" variant="outline">Kembali</x-ui.button>
                    <x-ui.button type="submit" x-text="form.isEdit ? 'Update' : 'Simpan'"></x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>
