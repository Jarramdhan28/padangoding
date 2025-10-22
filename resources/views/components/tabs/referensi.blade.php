<div class="flex items-center w-max p-0.5 rounded-lg gap-1 bg-gray-100">
    <x-tabs.link :href="route('category.index')" :active="request()->routeIs('category.*')">Kategori</x-tabs.link>
    <x-tabs.link :href="route('tag.index')" :active="request()->routeIs('tag.*')">Tag</x-tabs.link>
</div>
