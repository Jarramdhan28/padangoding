<x-creator-layout>
    @slot('title', 'Profile')

    <section class="mt-20 mx-auto max-w-screen-lg px-4" x-data x-cloak>
        <div>
            <p class="text-gray-500 text-xs">Creator</p>
            <h1 class="text-2xl font-semibold">Profile Saya</h1>
        </div>

        <div class="flex md:flex-row flex-col mt-2 bg-white mb-2 rounded-xl gap-x-6 md:h-[600px] p-2 md:p-4">
            @include('pages.creator.profile.sidebar')
            <main x-data="creatorProfile" x-init="initData" class="relative p-4 w-full" x-cloak>
                <div x-show="loadingPage" x-transition
                    class="absolute z-30 inset-0 bg-white/90 flex items-center justify-center rounded-2xl">
                    <div class="w-8 h-8 border-3 border-gray-300 border-t-gray-600 rounded-full animate-spin"></div>
                </div>
                <div x-show="!loadingPage">
                    <h1 class="text-xl font-medium">Informasi Pribadi</h1>
                    <p class="text-sm text-gray-500">Silahkan Update Profile anda dengan benar</p>

                    <div class="mt-5 flex items-center gap-x-2" @profile-updated.window="getProfileData()">
                        <img src="{{ asset('assets/images/no-user.png') }}" alt="" class="w-16 rounde-full">
                        <div class="flex items-center gap-x-1">
                            <div>
                                <label for="upload-profile"
                                    class="px-2.5 py-1.5 text-xs border border-gray-300 hover:bg-gray-100 hover:text-gray-600 focus:ring-gray-100 focus:outline-none rounded-md focus:z-10 focus:ring-4 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                    Ubah Profile
                                </label>
                                <input id="upload-profile" type="file" class="hidden" accept="image/png, image/jpg"
                                    @change="uploadProfile" />
                            </div>
                            @include('pages.creator.profile.modal-crop-image')
                            <x-ui.button size="sm" variant="danger">
                                <x-svg.delete class="size-4" />
                            </x-ui.button>
                        </div>
                    </div>

                    <div class="mt-3 w-ful">
                        <form
                            @submit.prevent="$submit({
                                url: route('creator.profile.update'),
                                method: 'PUT',
                                data: form.data,
                                dispatch: 'profile-updated'
                            })"
                            class="space-y-2">
                            <div>
                                <x-ui.form.label class="font-medium">Nama Lengkap</x-ui.form.label>
                                <x-ui.form.input x-model="form.data.name" type="text" placeholder="Masukkan Username"
                                    class="mt-1 w-full" />
                                <x-ui.form.error x-text="errors.name" />
                            </div>
                            <div>
                                <x-ui.form.label class="font-medium">Username</x-ui.form.label>
                                <x-ui.form.input x-model="form.data.username" type="text"
                                    placeholder="Masukkan Username" class="mt-1 w-full" />
                                <x-ui.form.error x-text="errors.username" />
                            </div>
                            <div>
                                <x-ui.form.label class="font-medium">Email</x-ui.form.label>
                                <x-ui.form.input x-model="form.data.email" type="text"
                                    placeholder="Masukkan Username" class="mt-1 w-full" />
                                <x-ui.form.error x-text="errors.email" />
                            </div>
                            <div>
                                <x-ui.form.label class="font-medium">Bio</x-ui.form.label>
                                <x-ui.form.textarea x-model="form.data.bio" placeholder="Masukkan Bio"
                                    class="mt-1 w-full" rows="4" />
                                <x-ui.form.error x-text="errors.bio" />
                            </div>
                            <div class="flex">
                                <x-ui.button type="submit" size="sm">
                                    Simpan
                                </x-ui.button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </section>
</x-creator-layout>
