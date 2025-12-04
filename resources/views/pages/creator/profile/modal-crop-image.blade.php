<div x-show="modalCropImage" class="fixed inset-0 z-50 flex items-center justify-center bg-white/20 backdrop-blur-xs">
    <div class="relative bg-white rounded-2xl border border-gray-200 shadow-sm w-full max-w-md p-1 m-2">
        <div class="relative border border-gray-100 rounded-2xl">
            <x-loading.modal />

            <button x-on:click="modalCropImage = false"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-1 rounded-lg transition">
                <x-svg.x class="size-5" />
            </button>

            <div class="px-5 py-3 border-b border-gray-100">
                <h3 class="text-xl font-semibold">Crop Profile</h3>
                <p class="text-sm text-gray-500">Silahkan sesuaikan profile yang ingin di upload</p>
            </div>

            <div class="border-t border-gray-100">
                <img x-bind:src="imagePreview" x-ref="profileImage" alt="image preview"
                    class="w-full max-h-[500px] object-contain mx-auto rounded-lg">
            </div>

            <div class="flex justify-end">
                <x-ui.button size="sm" class="m-3" @click="uploadProfileImage()">
                    Crop & Upload
                </x-ui.button>
            </div>
        </div>
    </div>
</div>
