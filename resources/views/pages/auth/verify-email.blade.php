<x-creator-layout>
    @slot('title', 'Login page')

    <section class="flex justify-center items-center h-screen">
        <div class="border border-gray-200 bg-white rounded-2xl max-w-md w-full py-8 md:px-5 md:py-16 m-4">
            <div class="flex justify-center items-center mb-3">
                <a href="{{ route('landing-page') }}">
                    <div class="border border-gray-200 rounded-md p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-li nejoin="round"
                                d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>
                </a>
            </div>

            <h2 class="text-lg font-semibold text-center">Verifikasi Email</h2>
            <p class="text-center text-sm text-gray-700">Silahkan Cek Email yang anda masukan dan lakukan verifikasi
                untuk mengaktikfkan akun anda.</p>

            <div class="text-center text-sm text-gray-700 mt-4 flex justify-center gap-1">
                <p>Belum menerima email?</p>
                <form x-data
                    @submit.prevent="$submit({
                        url: '{{ route('verification.send') }}',
                        method: 'POST',
                        data: {},
                    })">
                    <button type="submit" class="underline">Kirim ulang</button>
                </form>
            </div>
        </div>
    </section>
</x-creator-layout>
