<script>
import {MenuItem} from "@headlessui/vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "DropdownItem",
    components: {
        MenuItem,
        Link,
    },
    props: {
        url: {
            type: String,
            required: true,
        },
        method: {
            type: String,
            default: 'GET',
        },
        data: {
            type: Object,
            default: () => ({}),
        },
    },
    computed: {
        getMethod() {
            return this.method.toLowerCase();
        },
    }
}
</script>

<template>
    <MenuItem v-slot="{ active }">
        <Link v-if="getMethod === 'get'" :href="url" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">
            <slot />
        </Link>
        <Link v-else :method="getMethod" :href="url" :data="data" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">
            <slot />
        </Link>
    </MenuItem>
</template>
