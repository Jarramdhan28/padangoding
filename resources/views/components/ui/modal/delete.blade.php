@props([
    'modal' => '',
    'title' => 'Hapus Data',
    'message' => 'Apakah anda yakin ingin menghapus data ini?',
    'name' => '',
    'onDelete' => '',
])

<div x-cloak x-show="{{ $modal }}" x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-white/20 backdrop-blur-xs">
    <div x-transition class="relative bg-white rounded-2xl border border-gray-200 shadow-sm w-full max-w-md p-1 m-2">
        <div class="relative border border-gray-100 rounded-2xl">
            <x-loading.modal />

            <div class="p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $title }}</h2>
                <p class="text-gray-600 text-sm">{{ $message }}</p>
                <p x-text="{{ $name }}"></p>
            </div>

            <div class="border-t border-gray-100 px-6 py-3 flex justify-between gap-3">
                <x-ui.button type="button" @click="{{ $modal }} = false" variant="outline">Batal</x-ui.button>
                <x-ui.button type="submit" @click="{{ $onDelete }}" variant="danger">Hapus</x-ui.button>
            </div>
        </div>
    </div>
</div>
