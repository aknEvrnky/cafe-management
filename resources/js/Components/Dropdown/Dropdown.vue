<script>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

export default {
    name: "Dropdown",
    components: {
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        ChevronDownIcon,
    },
}
</script>

<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton class="menu-button">
                <slot name="header" />
            </MenuButton>
        </div>

        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <MenuItems class="menu-item">
                <div class="py-1">
                    <slot />
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<style scoped>
    .menu-button {
        @apply inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50;
    }

    .menu-item {
        @apply absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none;
    }
</style>
