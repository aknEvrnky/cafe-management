<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: 'NavigationLink',
    components: {
        Link,
    },
    props: {
        href: {
            type: String,
            required: true,
        },
        active: {
            type: Boolean,
        },
    },
    computed: {
        classes() {
            return this.active
                ? 'flex items-center pl-2 p-1 border-l-2 border-blue-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
                : 'flex items-center pl-2 p-1 border-l-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
        },
    },
}

</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
