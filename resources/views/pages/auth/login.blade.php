<x-auth-layout>
    @slot('title', 'Login page')

    <section class="flex justify-center items-center h-screen">
        <div x-data="login"
            class="border border-gray-200 bg-white rounded-2xl max-w-md w-full py-8 md:px-4 md:py-16 m-4">
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
            <h2 class="text-lg font-semibold text-center">Masuk</h2>
            <p class="text-center text-sm text-gray-700">Silahkan masukan email dan password anda</p>

            <div class="mt-4 px-6">
                <form
                    @submit.prevent="$submit({
                        url: '{{ route('login.store') }}',
                        method: 'POST',
                        data: form.data,
                    })"
                    class="space-y-2">
                    <div>
                        <x-ui.form.label class="mb-1">Email</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.email" type="email" placeholder="Masukan Email" />
                        <x-ui.form.error x-text="errors.email" />
                    </div>
                    <div>
                        <x-ui.form.label class="mb-1">Kata Sandi</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.password" type="password"
                            placeholder="Masukan Kata Sandi" />
                        <x-ui.form.error x-text="errors.password" />
                    </div>
                    <div class="flex justify-between items-center pb-2">
                        <div class="flex items-center gap-1">
                            <x-ui.form.checkbox name="" id="remember-me" class="accent-black" />
                            <x-ui.form.label for="remember-me">Ingat Saya</x-ui.form.label>
                        </div>
                        <a class="text-sm underline text-gray-700">Lupa Kata Sandi?</a>
                    </div>
                    <div>
                        <x-ui.button class="w-full" variant="primary">
                            Masuk
                        </x-ui.button>
                    </div>
                </form>
            </div>

            <div class="mt-4">
                <p class="text-sm text-center">
                    <span>Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-gray-700 underline">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </section>
</x-auth-layout>
