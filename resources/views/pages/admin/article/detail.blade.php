<x-admin-layout>
    @slot('title', 'Article')
    <x-template.admin-header :items="['Article', '/', 'Detail']" icon="article" />

    <section class="mx-4 mt-1">
        <x-ui.back />
        <div class="mb-4">
            <h2 class="font-semibold text-2xl">Review Article</h2>
            <p class="text-sm text-gray-600">Silahkan riview Article dan Approve jika sesuai ketentuan</p>
        </div>

        <div x-data="adminDetailArticle()" x-init="initData()">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div class="col-span-3 bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex gap-1.5 items-center">
                            <span class="text-xs border border-gray-200 text-gray-600 px-1 rounded-sm"
                                x-text="article?.category?.name"></span>
                            <span class="text-sm text-gray-400">•󠁏</span>
                            <span x-text="$longDateFormat(article.created_at)" class="text-sm text-gray-600"></span>
                        </div>
                        <div class="flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-sm text-gray-600"><span x-text="readTime.minutes"></span> min read</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h2 x-text="article.title" class="text-2xl font-semibold"></h2>
                        <p x-text="article.description" class="text-sm text-gray-500"></p>
                    </div>
                    <div class="mb-4">
                        <img x-bind:src="article.thumbnail" alt="thumbail.jpg" class="rounded-lg w-full object-cover">
                    </div>
                    <div>
                        <article x-html="article.content" class="prose max-w-none prose-sm"></article>
                    </div>
                </div>
                <div class="col-span-1">
                    ikan
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
