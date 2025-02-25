<template>
    <!-- Page Heading -->
    <header
        class="bg-white shadow"
    >
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <button class="hidden lg:block" @click="toggleNav()">
                        <component :is="showNav ? 'Bars3CenterLeftIcon' : 'Bars3Icon'" class="block h-8 w-8 mr-4 text-blue-400 cursor-pointer"/>
                    </button>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        <Link :href="route('dashboard')">
                            Yönetim Paneli
                        </Link>
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <Dropdown>
                        <template v-slot:header>
                            <div class="inline-flex rounded-md">
                                {{ $currentCafe().attributes.title }}

                                <TwoWayArrow class="ml-2 -mr-0.5 h-4 w-4" />
                            </div>
                        </template>

                        <template v-slot:default>
                            <div class="w-56">
                                <!-- Cafe Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Kafe Yönetimi
                                </div>

                                <!-- Cafe Settings -->
                                <DropdownItem :url="route('cafes.edit-current-cafe')">
                                    Kafe Ayarları
                                </DropdownItem>

                                <DropdownItem :url="route('cafes.create')">
                                    Yeni Kafe Oluştur
                                </DropdownItem>

                                <!-- Cafe Switcher -->
                                <template v-if="$cafes().length > 1">
                                    <div class="border-t border-gray-200" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Kafe Değiştir
                                    </div>

                                    <template v-for="cafe in $cafes()">
                                        <DropdownItem :url="route('cafes.switch')" method="put" :data="{cafe_id: cafe.id}">
                                            <div class="flex items-center">
                                                <ApproveTick v-if="cafe.id === $page.props.auth.user.attributes.current_cafe_id" class="mr-2 h-5 w-5 text-green-400" />

                                                <div>{{ cafe.attributes.title }}</div>
                                            </div>
                                        </DropdownItem>
                                    </template>
                                </template>
                            </div>
                        </template>
                    </Dropdown>

                    <Dropdown>
                        <template v-slot:header>
                            {{ $page.props.auth.user.attributes.full_name }}
                            <ChevronDownIcon class="-mr-1 size-5 text-gray-400" aria-hidden="true" />
                        </template>

                        <template v-slot:default>
                            <DropdownItem url="/user/profile">
                                Profil
                            </DropdownItem>
                            <DropdownItem :url="route('logout')" method="POST">
                                Çıkış Yap
                            </DropdownItem>
                        </template>
                    </Dropdown>
                </div>
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
import TwoWayArrow from "@/Components/SVG/TwoWayArrow.vue";
import ApproveTick from "@/Components/SVG/ApproveTick.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'AuthenticatedLayout',
    components: {
        ApproveTick,
        TwoWayArrow,
        ChevronDownIcon,
        Bars3CenterLeftIcon,
        Bars3Icon,
        DropdownItem,
        Dropdown,
        Navigation,
        Link,
    },
    data() {
        return {
            showNav: false,
        };
    },
    created() {
        // get it from local storage
        this.showNav = localStorage.getItem('showNav') === 'true';
    },
    methods: {
        toggleNav() {
            this.showNav = !this.showNav;

            localStorage.setItem('showNav', this.showNav);
        }
    }
};
</script>
