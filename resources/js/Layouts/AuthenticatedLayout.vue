<template>
    <!-- Page Heading -->
    <header
        class="bg-white shadow"
    >
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <button class="hidden lg:block" @click="toggleNaw()">
                    <component :is="showNav ? 'Bars3CenterLeftIcon' : 'Bars3Icon'" class="block h-8 w-8 mr-4 text-blue-400 cursor-pointer"/>
                </button>
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
            <slot name="header" />
        </div>
    </header>

    <!-- Page Content -->
    <main class="grid grid-cols-7 relative">
        <Navigation :open="showNav" class="col-span-1"/>
        <div class="grow container mx-auto px-4 py-6 lg:px-12"
             :class="{'col-span-6' : showNav, 'col-span-7' : !showNav}">
            <slot/>
        </div>
    </main>
</template>

<script>
import Navigation from "@/Components/Navigation/Navigation.vue";
import Dropdown from "@/Components/Dropdown/Dropdown.vue";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import {Bars3CenterLeftIcon, Bars3Icon, ChevronDownIcon} from "@heroicons/vue/20/solid/index.js";

export default {
    name: 'AuthenticatedLayout',
    components: {
        ChevronDownIcon,
        Bars3CenterLeftIcon,
        Bars3Icon,
        DropdownItem,
        Dropdown,
        Navigation
    },
    data() {
        return {
            showNav: false,
        }
    },
    methods: {
        toggleNaw() {
            this.showNav = !this.showNav;
        }
    }
};
</script>
