<x-auth-layout>
    @slot('title', 'Register')

    <section class="flex justify-center items-center h-screen">
        <div x-data="register"
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
            <h2 class="text-lg font-semibold text-center">Daftar</h2>
            <p class="text-center text-sm text-gray-700">Silahkan masukan email dan password anda</p>

            <div class="mt-4 px-6">
                <form class="space-y-2"
                    @submit.prevent="$submit({
                        url: form.url,
                        method: form.method,
                        data: form.data,
                        redirect: '{{ route('verification.notice') }}'
                    })">
                    <div>
                        <x-ui.form.label class="mb-1">Nama Lengkap</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.name" type="text" placeholder="Masukan nama lengkap" />
                        <x-ui.form.error x-text="errors.name" />
                    </div>
                    <div>
                        <x-ui.form.label class="mb-1">Username</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.username" type="text" placeholder="Masukan username" />
                        <x-ui.form.error x-text="errors.username" />
                    </div>
                    <div>
                        <x-ui.form.label class="mb-1">Email</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.email" type="text" placeholder="Masukan Email" />
                        <x-ui.form.error x-text="errors.email" />
                    </div>
                    <div>
                        <x-ui.form.label class="mb-1">Kata Sandi</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.password" type="password"
                            placeholder="Masukan Kata Sandi" />
                        <x-ui.form.error x-text="errors.password" />
                    </div>
                    <div>
                        <x-ui.form.label class="mb-1">Konfirmasi Kata Sandi</x-ui.form.label>
                        <x-ui.form.input x-model="form.data.password_confirmation" type="password"
                            placeholder="Masukan Konfirmasi Kata Sandi" />
                        <x-ui.form.error x-text="errors.password_confirmation" />
                    </div>
                    <div class="mt-4">
                        <x-ui.button class="w-full" variant="primary">
                            Daftar
                        </x-ui.button>
                    </div>
                </form>
            </div>

            <div class="mt-4">
                <p class="text-sm text-center">
                    <span>Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-gray-700 underline">Masuk Sekarang</a>
                </p>
            </div>
        </div>
    </section>
</x-auth-layout>
