<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown/Dropdown.vue";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import {ChevronDownIcon} from "@heroicons/vue/20/solid/index.js";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800"
                >
                    Yonetim Paneli
                </h2>
                <Dropdown>
                    <template v-slot:header>
                        {{ $page.props.auth.user.name }}
                        <ChevronDownIcon class="-mr-1 size-5 text-gray-400" aria-hidden="true" />
                    </template>

                    <template v-slot:default>
                        <DropdownItem url="/user/profile">
                            Profil
                        </DropdownItem>
                        <DropdownItem :url="route('logout')" method="POST">
                            Cikis Yap
                        </DropdownItem>
                    </template>
                </Dropdown>

            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
