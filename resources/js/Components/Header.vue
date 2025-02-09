<template>
    <Head :title="title" />

    <header class="flex justify-between items-end py-4 mb-8">
        <div>
            <Link v-if="returnLinkTitle && returnLinkUrl" :href="returnLinkUrl" class="inline-flex items-center text-gray-500 mb-3 hover:underline underline-offset-4">
                <ChevronLeftIcon class="h-3 w-3 mr-1" />
                {{ returnLinkTitle }}
            </Link>
            <h1 class="text-2xl font-semibold text-gray-900">
                {{ title}}
            </h1>
        </div>
        <div>
            <Dropdown v-if="dropdownText" width="56">
                <template v-slot:header>
                    <span class="inline-flex items-center rounded-md">
                        {{ dropdownText }}
                        <ChevronDownIcon class="h-4 w-4 ml-2 -mr-1" aria-hidden="true" />
                    </span>
                </template>

                <template v-slot:default v-if="$slots['dropdown-content']">
                    <slot name="dropdown-content" />
                </template>
            </Dropdown>
        </div>
    </header>
</template>

<script>
import {ChevronDownIcon, ChevronLeftIcon} from "@heroicons/vue/24/outline";
import {Head} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown/Dropdown.vue";

export default {
    name: "Header",
    components: {
        Dropdown,
        ChevronDownIcon,
        ChevronLeftIcon,
        Head,
        Link,
    },
    props: {
        title: {
            type: String,
            required: true,
        },
        returnLinkTitle: {
            type: String,
            required: false,
        },
        returnLinkUrl: {
            type: String,
            required: false,
        },
        dropdownText: {
            type: String,
            required: false,
        },
    },
}
</script>
