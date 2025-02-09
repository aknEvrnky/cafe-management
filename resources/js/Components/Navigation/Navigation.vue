<script>
import {TransitionRoot} from "@headlessui/vue";
import NavigationLink from "@/Components/Navigation/NavigationLink.vue";

export default {
    name: "Navigation",
    components: {NavigationLink, TransitionRoot},
    props: {
        open: {
            type: Boolean,
            required: true
        }
    }
}
</script>

<template>
    <TransitionRoot
        as="div"
        class="p-4 bg-gray-50 sticky nav-main mt-[1px]"
        :show="open"
        enter="transition-opacity duration-150 transition-width"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-150 transition-width"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
        <div class="">
            <ul class="text-gray-700 grid divide-y divide-solid">
                <li class="block py-2">
                    <NavigationLink :href="route('dashboard')" :active="route().current('dashboard')">Ana Sayfa</NavigationLink>
                </li>
                <li class="block py-2">
                    <NavigationLink :href="route('product-categories.index')" :active="route().current('product-categories.index')">Ürün Kategorileri</NavigationLink>
                </li>
            </ul>
        </div>
    </TransitionRoot>
</template>

<style scoped>
.nav-main {
    height: 100%;
    min-height: 100vh;
}
</style>
