<x-creator-layout>
    @slot('title', 'Dashboard')

    <section class="mt-20 mb-20 mx-auto max-w-screen-md px-4">
        <div x-data="detailArticle()" x-init="initData()">
            <x-ui.back />
            <div class="mb-5">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex gap-1.5 items-center">
                        <span class="text-xs border border-gray-200 text-gray-600 px-1 rounded-sm"
                            x-text="article?.category?.name"></span>
                        <span class="text-sm text-gray-400">•󠁏</span>
                        <span x-text="$longDateFormat(article.created_at)" class="text-sm text-gray-600"></span>
                    </div>
                    <div class="flex gap-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-sm text-gray-600"><span x-text="readTime.minutes"></span> min read</span>
                    </div>
                </div>
                <h1 class="text-3xl font-bold mb-1" x-text="article.title"></h1>
                <p class="text-sm text-gray-600 italic" x-text="article.description"></p>
            </div>
            <div class="mb-4">
                <img x-bind:src="article.thumbnail" alt="thumbail.jpg" class="rounded-lg w-full h-[400px] object-cover">
            </div>
            <div>
                <article x-html="article.content" class="prose max-w-none prose-sm"></article>
            </div>
        </div>
    </section>
</x-creator-layout>
