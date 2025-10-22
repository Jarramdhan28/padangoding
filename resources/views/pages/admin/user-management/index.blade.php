<x-admin-layout>
    @slot('title', 'Kelola Pengguna')
    <x-template.admin-header :items="['Kelola Pengguna']" icon="user" />

    <section class="mx-4 mt-1">
        <div class="mb-2">
            <h2 class="font-semibold text-2xl">Kelola Pengguna</h2>
            <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi id hic</p>
        </div>

        <div x-data="userManagement" x-init="initData" class="mt-2.5">
            <div class="flex justify-between items-center">
                <div>
                    <x-ui.search placeholder="Cari user.." model="search" on-input="fetchResults(1)" />
                </div>
            </div>

            <div class="mt-4 w-full rounded-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto md:overflow-visible">
                    <table class="w-full min-w-[600px] text-sm text-left" @user-table.window="fetchResults()">
                        <thead class="text-sm bg-gray-100 font-medium text-gray-700 whitespace-nowrap">
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 w-3">No</td>
                                <td class="px-6 py-2">Name</td>
                                <td class="px-6 py-2">Username</td>
                                <td class="px-6 py-2">Role</td>
                                <td class="px-6 py-2">Status</td>
                                <td class="px-6 py-2">Last Login</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <template x-for="(user, index) in results" :key="index">
                                <tr
                                    class="bg-white border-t border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-150">
                                    <td class="px-4 py-2 text-center"
                                        x-text="(page.currentPage - 1) * page.perPage + (index + 1)">
                                    </td>
                                    <td class="px-6 py-2 flex items-center gap-2">
                                        <img src="{{ asset('assets/images/user.png') }}" alt="user"
                                            class="w-9 rounded-full">
                                        <div>
                                            <p class="font-medium" x-text="user.name"></p>
                                            <p class="text-xs text-gray-500" x-text="user.email"></p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-2" x-text="user.username"></td>
                                    <td class="px-6 py-2">
                                        <x-ui.badge x-text="user.roles[0]">
                                            Admin
                                        </x-ui.badge>
                                    </td>
                                    <td class="px-6 py-2">
                                        <template x-if="user.email_verified_at != null">
                                            <x-ui.badge variant="success">
                                                Active
                                            </x-ui.badge>
                                        </template>
                                        <template x-if="user.email_verified_at == null">
                                            <x-ui.badge variant="danger">
                                                Inactive
                                            </x-ui.badge>
                                        </template>
                                    </td>
                                    <td class="px-6 py-2" x-text="$timeAgoFormat(user.last_login)"></td>
                                    <td class="px-6 py-2 text-center relative">
                                        <div x-data="{ openDropdown: false }" class="relative inline-block">
                                            <button @click="openDropdown = !openDropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                </svg>
                                            </button>

                                            <div x-show="openDropdown" @click.outside="openDropdown = false" x-cloak
                                                class="fixed right-12 bg-white rounded-lg shadow w-max p-1 z-50">
                                                <ul class="text-left">
                                                    <li class="px-4 py-2 rounded-lg hover:bg-gray-100 cursor-pointer"
                                                        @click="openModalSetRole(user)">
                                                        Set Role
                                                    </li>
                                                    <li class="px-4 py-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                                                        <button>Hapus Pengguna</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 mb-2">
                <x-ui.pagination current-page="page.currentPage" last-page="page.lastPage" per-page="page.perPage"
                    total="page.total" on-prev="fetchResults(page.currentPage - 1)"
                    on-next="fetchResults(page.currentPage + 1)" />
            </div>

            @include('pages.admin.user-management.modal-set-role')
        </div>
    </section>
</x-admin-layout>
