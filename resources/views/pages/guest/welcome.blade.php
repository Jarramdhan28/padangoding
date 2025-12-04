<x-guest-layout>
    @slot('title', 'Home')

    <section class="mt-56 flex justify-center">
        <div class="mx-auto max-w-screen-md py-1 md:py-2.5 px-2.5 md:px-4">
            <div class="text-center">
                <div class="w-max m-auto border border-gray-100 px-6 py-0.5 text-sm text-gray-600 rounded-full">
                    <p class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                        padangoding
                    </p>
                </div>
                <h2 class="font-medium text-7xl mb-2">Temukan solusi anda sekarang juga</h2>
                <h2 class="text-gray-600">
                    Artikel, tutorial, dan screencast interaktif untuk membantumu jadi developer handal.
                </h2>
            </div>
            <div class="flex justify-center mt-4">
                <x-ui.button href="#" variant="primary">
                    Jelajahi Sekarang
                </x-ui.button>
            </div>
        </div>
    </section>
</x-guest-layout>
