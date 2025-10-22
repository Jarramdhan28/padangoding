<div x-show="setRole.modal" class="fixed inset-0 z-50 flex items-center justify-center bg-white/20 backdrop-blur-xs">
    <div class="relative bg-white rounded-2xl border border-gray-200 shadow-sm w-full max-w-md p-1 m-2">
        <div class="relative border border-gray-100 rounded-2xl">
            <x-loading.modal />

            <button x-on:click="setRole.modal = false"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-1 rounded-lg transition">
                <x-svg.x class="size-5" />
            </button>

            <div class="px-5 py-3 border-b border-gray-100">
                <h3 class="text-xl font-semibold">Set Role</h3>
                <p class="text-sm text-gray-500">Silahkan set role dengan benar</p>
            </div>

            <form
                @submit.prevent="$submit({
                    url: setRole.url,
                    method: 'POST',
                    data: setRole.data,
                    dispatch: 'user-table',
                    modalClose: 'setRole.modal'
                })">
                <div class="px-5 py-3">
                    <div class="space-y-1">
                        <x-ui.form.label>Role</x-ui.form.label>
                        <x-ui.form.select x-model="setRole.data.role_id">
                            <template x-for="role in roleList">
                                <option x-text="role.name" x-bind:value="role.uuid"></option>
                            </template>
                        </x-ui.form.select>
                        <x-ui.form.error x-text="errors.name" />
                    </div>
                </div>
                <div class="gap-2 border-t border-gray-100 flex justify-between px-5 py-3">
                    <x-ui.button x-on:click="setRole.modal = false" type="button"
                        variant="outline">Kembali</x-ui.button>
                    <x-ui.button type="submit">Simpan</x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>
