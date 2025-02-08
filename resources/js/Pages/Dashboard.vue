<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown/Dropdown.vue";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import {ChevronDownIcon, Bars3CenterLeftIcon, Bars3Icon} from "@heroicons/vue/20/solid/index.js";

export default {
    name: 'Dashboard',
    components: {
        AuthenticatedLayout,
        Head,
        Dropdown,
        DropdownItem,
        ChevronDownIcon,
        Bars3CenterLeftIcon,
        Bars3Icon,
    },
}
</script>

<template>

    <AuthenticatedLayout>
        <Head title="Dashboard" />

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
