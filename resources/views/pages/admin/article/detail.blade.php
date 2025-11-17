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
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-10" x-show="isLoaded">
                <div class="col-span-3 bg-gray-50/80 border border-gray-50 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex gap-1.5 items-center">
                            <span class="text-xs border border-gray-200 text-gray-600 px-1 rounded-sm"
                                x-text="article?.category?.name"></span>
                            <span
                                x-bind:class="article.status_color +
                                    ' text-xs px-1.5 rounded-sm'"
                                x-text="article.status_label">
                            </span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h2 x-text="article.title" class="text-2xl font-semibold"></h2>
                        <p x-text="article.description" class="text-sm text-gray-500"></p>
                    </div>
                    <div class="mb-4">
                        <img x-bind:src="article.thumbnail" alt="thumbail.jpg" class="rounded-lg w-full object-cover">
                    </div>
                    <div class="mb-4 flex gap-2 items-center justify-between border-y border-gray-100 py-1">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/images/no-user.png') }}" alt="profile" class="w-8">
                            <p x-text="article?.author?.name" class="text-sm text-gray-600"></p>
                            <span class="text-sm text-gray-400">•󠁏</span>
                            <span x-text="$longDateFormat(article.created_at)" class="text-sm text-gray-600"></span>
                        </div>
                        <div class="flex gap-1 items-center">
                            <x-svg.clock class="text-gray-600 size-4" />
                            <span class="text-sm text-gray-600"><span x-text="readTime.minutes"></span> min read</span>
                        </div>
                    </div>
                    <div>
                        <article x-html="article.content" class="prose max-w-none prose-sm"></article>
                    </div>
                </div>
                <div class="col-span-1" x-cloak>
                    <template x-if="isLoaded & article.status != 'approved'">
                        <div class="border border-gray-50 bg-gray-50/80 rounded-lg" x-cloak>
                            <form
                                @submit.prevent="$submit({
                                    url: route('admin.article.updateStatus', article.slug),
                                    method: 'POST',
                                    data: formStatus,
                                })">
                                <div class="space-y-1.5 p-3 border-b border-gray-50 bg-gray-100 rounded-t-lg">
                                    <x-ui.form.label class="font-medium">Komentar</x-ui.form.label>
                                </div>
                                <div class="p-3">
                                    <x-ui.form.textarea class="h-28 placeholder:text-gray-500/70"
                                        x-model="formStatus.comment"
                                        placeholder="berikan komentar jika ada yang perlu di perbaiki.." />
                                    <x-ui.form.error x-text="errors.comment" />
                                </div>
                                <div class="px-3 pb-3 flex justify-end items-center gap-2">
                                    <x-ui.button variant="danger" size="sm" @click="formStatus.status = 'rejected'"
                                        x-bind:disabled="loading" loadingText="Mengirim...">
                                        Tolak
                                    </x-ui.button>
                                    <x-ui.button size="sm" @click="formStatus.status = 'approved'"
                                        x-bind:disabled="loading" loadingText="Mengirim...">Setujui</x-ui.button>
                                </div>
                            </form>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
